<?php 

namespace Drupal\okta_ajax\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Drupal\okta_ajax\ApiService;
use Drupal\Core\Url ;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Drupal\taxonomy\Entity\Term;
use Drupal\Core\Config\FileStorage;

use MicrosoftAzure\Storage\Table\TableRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
use MicrosoftAzure\Storage\Table\Models\Entity;

use DateTime;

/**
 * Handle login requests with Ajax
 */
class OktaLoginController {

	/**
     * Okta API Service
     * 
     * @var \Drupal\okta\ajax\ApiService
     */
	protected $_apiService;

	/**
	 * Azure Table Service
	 *
	 * @var \MicrosoftAzure\Storage\Table\TableRestProxy
	 */
	private $_azureTableClient;
	
	//todo: use DI for any services needed in the class
	public function _construct(ApiService $apiService) {
		$this->_apiService = $apiService;
		$key = \Drupal::config('okta_ajax.settings')->get('azure_key');
	  	$account = \Drupal::config('okta_ajax.settings')->get('azure_account');
	  	$connectionString = 'DefaultEndpointsProtocol=https;AccountName='.$account.';AccountKey='.$key.';EndpointSuffix=core.windows.net';
	  	$this->_azureTableClient = TableRestProxy::createTableService($connectionString);
	}

  public function getPaths() {
	$front = \Drupal::urlGenerator()->generateFromRoute('<front>', [], ['absolute' => TRUE]);
	$account_path = \Drupal::config('okta_ajax.settings')->get('account_path');
	$account_link = $account_path?$account_path:$front.'account';
	$profile_path = \Drupal::config('okta_ajax.settings')->get('profile_path');
	$profile_link = $profile_path?$profile_path:$front.'profile';
	return ['account'=>$account_link, 'profile' => $profile_link];
  }

  public function _azureClient(){
  	if(!$this->_azureTableClient) {
  		$key = \Drupal::config('okta_ajax.settings')->get('azure_key');
	  	$account = \Drupal::config('okta_ajax.settings')->get('azure_account');
	  	$connectionString = 'DefaultEndpointsProtocol=https;AccountName='.$account.';AccountKey='.$key.';EndpointSuffix=core.windows.net';
	  	$this->_azureTableClient = TableRestProxy::createTableService($connectionString);
  	}
  	return $this->_azureTableClient;
  }

  public function azureUpdateAccess($username) {
  	$newRow = new Entity();
  	$newRow->setPartitionKey('last_access');
  	$newRow->setRowKey($username);
  	$newRow->addProperty('last_login', 'Edm.DateTime', new DateTime() );
  	$this->_azureClient()->insertOrMergeEntity('userEmailPreferences', $newRow);
  }

  public function azureUpdateEmailPreferences($username, $preferences) {
  	$newRow = new Entity();
  	$newRow->setPartitionKey('email_preferences');
  	$newRow->setRowKey($username);
  	foreach($preferences as $k=>$v) {
  		$newRow->addProperty($k, 'Edm.String', $v);
  	}
  	$this->_azureClient()->insertOrMergeEntity('userEmailPreferences', $newRow);
  }

  public function azureGetEmailPreferences($username) {
  	try {
  		$res = $this->_azureClient()->getEntity('userEmailPreferences','email_preferences',$username);
  	} catch (ServiceException $e) {
  		return array();
  	}
  	if(!$res){
  		throw new Exception("Unable to retrieve preferences");
  	}
  	$entity = $res->getEntity();
  	if(!$entity){
  		throw new Exception("Unable to retrieve preferences");
  	}
  	$eProps = $entity->getProperties();
	$props = array();
	foreach($eProps as $name => $property ) {
		$props[$name] = $property->getValue();
	}
	return $props;
  }

  //get favorite locations from azure and compare to drupal vocab terms
  public function getEmailPreferences($username) {
  	$azureProps = [];
  	try {
  		$azureProps = $this->azureGetEmailPreferences($username);
  	} catch ( Exception $e) {
  		\Drupal::logger('okta_ajax')->notice("User ".$username." does not have email preferences saved yet. - ".$e->getMessage());
  	}
  	$vid = 'favorite_locations';
  	$terms =\Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree($vid);
  	$preferences = ['locations'=>[],'opt_in'=>(isset($azureProps['opt_in'])? boolval($azureProps['opt_in']) : false ) ];
  	$preferences['aProps'] = $azureProps;
  	foreach($terms as $term) {
  		$term_name = str_replace(" ","_",$term->name);
  		$is_true = (isset($azureProps[$term_name]) && boolval($azureProps[$term_name]) ) ? true : false;
  		$preferences['locations'][] = ['name'=>$term->name, 'tid'=>$term->tid,'parent'=>$term->parents[0], 'val' => $is_true];
  	}
  	\Drupal::logger('okta_ajax')->notice("Preferences: ".print_r($preferences,true));
  	return $preferences;
  }

  //ajax endpoint for settings a users email preferences
  public function returnUpdateEmailPreferences() {
  	$token = \Drupal::request()->request->get('token');
  	if(!$token) {
  		return new JsonResponse('Missing or invalid token');
  	}
  	$opt_in = \Drupal::request()->request->get('opt_in');
  	$q_fields = \Drupal::request()->request->all();
  	$pref_fields = [];
	foreach($q_fields as $k=>$v) {
		if($k=='token' || $k=='opt_in') continue;
		$pref_fields[$k] = $v;
	}
	$res = $this->updateEmailPreferences($token, boolval($opt_in), $pref_fields);
	return new JsonResponse($res);
  }

  public function updateEmailPreferences($token, $opt_in, $preferences){
  	//first get username from token to make sure only own user can modify their details
  	$introspected = $this->introspect($token, 1);
  	if(!$introspected || !$introspected->username) {
  		return ['error'=>"Could not get user session"];
  	}
  	$preferences['opt_in'] = $opt_in ? 'true' : '';
  	\Drupal::logger('okta_ajax')->notice("Updating preferences for ".$introspected->username." : ".print_r($preferences,true));
  	return $this->azureUpdateEmailPreferences($introspected->username, $preferences);
  }

  public function azureTest() {
  	$dump = [];
  	$user = 'ryan.sellars@welkgroup.com';
  	$dump[] = $this->azureUpdateAccess($user);
  	$dump[] = $this->azureGetEmailPreferences($user);
  	$props = [
  		'email_subscription'=> '1',
  		'Lake_Tahoe' => '1',
  		'San_Diego' => '1'
  	];
  	$dump[] = $this->azureUpdateEmailPreferences($user, $props);
  	$dump[] = $this->azureGetEmailPreferences($user);
	
  	return $dump;
  	
  }



  //check if there is a user token currently in the session
  public function isLoggedIn() {
	$tempstore = \Drupal::service('tempstore.private')->get('okta_ajax');
	$token = $tempstore->get('token');
	return $token;
  }

  public function getToken() {
	return new JsonResponse( $this->isLoggedIn() );
  }

  public function returnLogout(){
	  $this->logOut();
	  return new JsonResponse(['success'=>true] );
  }

  public function logOut() {
	$tempstore = \Drupal::service('tempstore.private')->get('okta_ajax');
	$token = $tempstore->delete('token');
  }

  public function returnSwitchButton() {
	  $token = $this->isLoggedIn();
	  $account_path = \Drupal::config('okta_ajax.settings')->get('account_path');
	  $front = \Drupal::urlGenerator()->generateFromRoute('<front>', [], ['absolute' => TRUE]);
	$account_link = $account_path?$account_path:$front.'account';
	$profile_path = \Drupal::config('okta_ajax.settings')->get('profile_path');
	$profile_link = $profile_path?$profile_path:$front.'profile';
	if($token) {
		$response = new RedirectResponse( $profile_link, 302);
	} else {
		$response = new RedirectResponse( $account_link , 302);
	}
	return $response;

  }

  public function returnProcessLogin() {
	\Drupal::logger('okta_ajax')->notice("API endpoint for login: ".print_r(\Drupal::request()->request->all(),true) );
	$username = \Drupal::request()->request->get('username');
    $password = \Drupal::request()->request->get('password');
    return new JsonResponse( $this->processAuthnLogin($username,$password) );
  }

  public function processOAuthLogin() {
    $username = \Drupal::request()->request->get('username');
    $password = \Drupal::request()->request->get('password');

    $basic_auth = 'MG9hbjN2a3YwYkxDNFZNbGYwaDc6TGFzX0hTeTIzMERUZTcyTm5zQ1Y3cnJ6SVNsZC05NzBIdVNULVRHdQ==';
    $endpoint = 'https://welkexternal.oktapreview.com/oauth2/default/v1/';
    try {
    $response = \Drupal::httpClient()->post( $endpoint.'token' ,  [
      'verify' => true,
      'form_params' => [ 'grant_type' => 'password', 'username'=>$username,'password'=>$password,'scope'=>'openid'],
      'headers' => [
        'content-type' => 'application/x-www-form-urlencoded',
        'Authorization' => 'Basic '.$basic_auth,
        'accept' => 'application/json'
      ],
    ])->getBody()->getContents();
    } catch (RequestException $e) {
      return ['error' => 'Exception occured during request', 'data' => $e->hasResponse() ? $e->getResponse() : '' ];
    }


    $res = json_decode($response);

    if( $res && is_object($res) && isset($res->access_token) ) {
      return $res;
    } else {
       return [ 'error' => 'Did not receive an access token' , 'res' => $res, 'body' => $response ];
    }

  }

  public function processAuthnLogin($username, $password) {
    
	$data = [ 'username' => $username, 'password' => $password, 'options' => [
		'multiOptionalFactorEnroll' => true,
		'warnBeforePasswordExpired' => true
	]];
	\Drupal::logger('okta_ajax')->notice("Received Authn Login for ".$username);
	$api_token = '00Btn6pySOrS38s9mGYxmGq7Ls40Xv4g_Cw4_ce8Wn';
	$endpoint = 'https://welkexternal.oktapreview.com/api/v1/';
	$opts = [
		'verify' => true,
		'json' => $data,
		'headers' => [
		  'Authorization'=>'SSWS '.$api_token,
		  'accept' => 'application/json'
		],
	];
	\Drupal::logger('okta_ajax')->notice("Authn opts: ".json_encode($opts) );
    try {
    	$response = \Drupal::httpClient()->post( $endpoint.'authn' , $opts )->getBody()->getContents();
    } catch (RequestException $e) {
      return ['error' => 'Exception occured during request', 'data' => $e->hasResponse() ? $e->getResponse() : '' ];
    }


    $res = json_decode($response);

    if( $res && is_object($res) && isset($res->_embedded) ) {
      return $res;
    } else {
       return [ 'error' => 'Did not receive an access token' , 'res' => $res, 'body' => $response ];
    }

  }

  public function returnRegister() {
	\Drupal::logger('okta_ajax')->notice("API endpoint for registration: ".print_r(\Drupal::request()->request->all(),true) );
	$username = \Drupal::request()->request->get('username');
	$password = \Drupal::request()->request->get('password');
	$first = \Drupal::request()->request->get('first');
	$last = \Drupal::request()->request->get('last');
	return new JsonResponse( $this->processRegistration($username, $password, $first, $last) );
  }

  public function processRegistration($username, $password, $first_name, $last_name) {
	  
	$api_token = '00Btn6pySOrS38s9mGYxmGq7Ls40Xv4g_Cw4_ce8Wn';
	$endpoint = 'https://welkexternal.oktapreview.com/api/v1/';
	$data = [
		'profile' => [
			'firstName' => $first_name,
			'lastName' => $last_name,
			'email' => $username,
			'login' => $username
		],
		'credentials' => [
			'password' => ['value'=> $password ]
		]
	];
	$opts = [
		'verify' => true,
		'json' => $data,
		'headers' => [
		  'Authorization'=>'SSWS '.$api_token,
		  'accept' => 'application/json'
		],
	];
	\Drupal::logger('okta_ajax')->notice("Received registration request for: ".json_encode($opts) );
	try {
		$response = \Drupal::httpClient()->post( $endpoint.'users?activate=false' , $opts  )->getBody()->getContents();
		} catch (RequestException $e) {
		  return ['error' => 'Request Exception occured during request', 'data' => $e->hasResponse() ? $e->getResponse() : '' ];
		} catch (Exception $e) {
			return ['error' => 'Unknown Exception occured during request', 'data' => $e->getMessage() ];
		}
		return json_decode($response);
  }

  public function returnRequestPassword() {
	  $username = \Drupal::request()->request->get('username');
	  return new JsonResponse( $this->requestPassword($username, true) );
  }

  public function requestPassword($username, $sendEmail) {
	$api_token = \Drupal::config('okta_ajax.settings')->get('okta_api_key'); 
	$endpoint = 'https://welkexternal.oktapreview.com/api/v1/';
	\Drupal::logger('okta_ajax')->notice("Requesting password reset for: ".json_encode($data) );
	try {
		//first get id from username..
		$response = \Drupal::httpClient()->get( $endpoint.'users/'.$username ,  [
			'verify' => true,
			'headers' => [
			  'content-type' => 'application/json',
			  'Authorization'=>'SSWS '.$api_token,
			  'accept' => 'application/json'
			],
		  ])->getBody()->getContents();
		$user = json_decode($response);
		$id = $user->id;
		$response = \Drupal::httpClient()->post( $endpoint.'users/'.$id.'/lifecycle/reset_password?sendEmail='.($sendEmail?'true':'false') ,  [
		  'verify' => true,
		  'headers' => [
			'content-type' => 'application/json',
			'Authorization'=>'SSWS '.$api_token,
			'accept' => 'application/json'
		  ],
		])->getBody()->getContents();
	} catch (RequestException $e) {
		  return ['error' => 'Exception occured during request', 'data' => $e->hasResponse() ? $e->getResponse() : '' ];
	}
	return json_decode($response);
  }


  //update password with an OpenID token
  public function returnPasswordChange() {
	$token = \Drupal::request()->request->get('token');
	$old = \Drupal::request()->request->get('current_password');
	$new = \Drupal::request()->request->get('new_password');
	if( !$token || !$old || !$new ) {
		return new JsonResponse(['error'=>'Requires a current token, and the current and new passwords']);
	}
	return new JsonResponse( $this->updatePassword($token, $old, $new) );
  }

  public function updatePassword($token, $old, $new) {
		$client_id = \Drupal::config('okta_ajax.settings')->get('okta_client_id');
		$client_secret = \Drupal::config('okta_ajax.settings')->get('okta_client_secret');
		$api_token = '00Btn6pySOrS38s9mGYxmGq7Ls40Xv4g_Cw4_ce8Wn'; //TODO:: encrypted token should be loaded from config
		$base = 'https://welkexternal.oktapreview.com/';
		$introspected = $this->introspect($token, 2);
		if(!$introspected){ return ['error'=>'Unable to inspect token'] ; }
		if(is_array($introspected)  ){
			return $introspected;
		}
		if(!$introspected->active) {
			return ['error'=>'This session has timed out. Please login again'];
		}
		\Drupal::logger('okta_ajax')->notice("User [".$introspected->username."] is requesting password change");
		//get user id
		$response = \Drupal::httpClient()->get($base.'api/v1/users/'.urlencode($introspected->username), [
			'headers'=>['Accept'=>'application/json','Content-Type'=>'application/json','Authorization'=>'SSWS '.$api_token]
		])->getBody()->getContents();
		$user = json_decode($response);
		if(!$user){
			return ['error'=>'Unable to fetch user profile from the token username'];
		}
		$json_payload = [
			'oldPassword' => ['value'=>$old], 
			'newPassword' => ['value'=>$new]
		];
		//call change password api
		$response = \Drupal::httpClient()->post($base.'api/v1/users/'.$user->id.'/credentials/change_password', [
			'json' => $json_payload,
			 'headers'=>['Accept'=>'application/json','Content-Type'=>'application/json','Authorization'=>'SSWS '.$api_token]
			])->getBody()->getContents();
		\Drupal::logger('okta_ajax')->notice("User [".$introspected->username."] submitted password change: ".$response);
		$res = json_decode($response);
		return $res;
  }



  //a logged in user can update their profile by sending their current token and new profile fields
  public function updateProfile() {
    $token = \Drupal::request()->request->get('token');

    $client_id = \Drupal::config('okta_ajax.settings')->get('okta_client_id');
    $client_secret = \Drupal::config('okta_ajax.settings')->get('okta_client_secret');
    $api_token = '00Btn6pySOrS38s9mGYxmGq7Ls40Xv4g_Cw4_ce8Wn';
    $base = 'https://welkexternal.oktapreview.com/';
    //introspect first to get client id, and then use api token to update their profile
    $response = \Drupal::httpClient()->post($base.'oauth2/default/v1/introspect',
	[ 'verify'=>true,'form_params'=>['token'=>$token,'client_id'=>$client_id,'client_secret'=>$client_secret],
		'headers'=>['content-type'=>'application/x-www-form-urlencoded','accept'=>'application/json']
	])->getBody()->getContents();
	\Drupal::logger('okta_ajax')->notice("Introspect for update profile: ".$response);
    $tempstore = \Drupal::service('tempstore.private')->get('okta_ajax');
    $token_d = json_decode($response);
	if(!$response || !$token_d){ $tempstore->delete('token'); return new JsonResponse(['error'=>'Could not introspect token to get user id']); }
	if(!$token_d->active){
                $tempstore->delete('token');
		return new JsonResponse(['error'=>'This session is not active']);
	}
    $tempstore->set('token', $token);
    //get user id from api first since token does not contain it
    $response = \Drupal::httpClient()->get($base.'api/v1/users/'.urlencode($token_d->username), [
	'headers'=>['Accept'=>'application/json','Content-Type'=>'application/json','Authorization'=>'SSWS '.$api_token]
	])->getBody()->getContents();
    \Drupal::logger('okta_ajax')->notice("Fetched user profile: ".$response);
    $user = json_decode($response);
	$profile_fields = [];
	$q_fields = \Drupal::request()->request->all();
	foreach($q_fields as $k=>$v) {
		if($k=='token') continue;
		$profile_fields[$k] = $v;
	}
	if(empty($profile_fields)){
		return new JsonResponse(['error'=>'No profile fields were sent to be updated']);
	}

    //now update call
    $response = \Drupal::httpClient()->post($base.'/api/v1/users/'.$user->id, [
	'json' => ['profile'=>$profile_fields],
	 'headers'=>['Accept'=>'application/json','Content-Type'=>'application/json','Authorization'=>'SSWS '.$api_token]
	])->getBody()->getContents();
    \Drupal::logger('okta_ajax')->notice("Update response: ".$response);
    return new JsonResponse( json_decode($response) );
  }

  /**
	 * Find a user by their OpenID Token
	 * expects 'token' in http request
	 * 
	 * @return \Okta\Users\User a User object or null
	 */
  public function getProfileWithToken() {
	$token = \Drupal::request()->request->get('token');
	if(!$token) {
		return new JSONResponse( ['error'=>'Requires an active token']);
	}
	//TODO:: Fix OktaSDK to use Api Service
	$client_id = \Drupal::config('okta_ajax.settings')->get('okta_client_id');
	$client_secret = \Drupal::config('okta_ajax.settings')->get('okta_client_secret');
	$domain = \Drupal::config('okta_ajax.settings')->get('okta_domain');
	$endpoint = 'https://'.$domain.'.oktapreview.com/oauth2/default/v1/introspect';
	/** Get the cancel description from reservation booking block */
	$booking_block = \Drupal\block\Entity\Block::load('reservationbooking');
	$booking_uuid = $booking_block->getPlugin()->getDerivativeId();
	$booking_block_content = \Drupal::service('entity.repository')->loadEntityByUuid('block_content', $booking_uuid);
	if($booking_block_content){
		$desc = $booking_block_content->field_cancel_popup_description->value;
	}	
	//TODO:: api token from config
	$api_token = \Drupal::config('okta_ajax.settings')->get('okta_api_key');
	//$api_token = '00Btn6pySOrS38s9mGYxmGq7Ls40Xv4g_Cw4_ce8Wn';
	for($i=0;$i<2;$i++){
		$response = \Drupal::httpClient()->post( $endpoint, [
			'verify' => true,
			'form_params' => [
				'token' => $token,
				'client_id' => $client_id,
				'client_secret' => $client_secret
			],
			'headers' => [
				'content-type' => 'application/x-www-form-urlencoded',
				'accept' => 'application/json'
			]
		])->getBody()->getContents();
		$introspected = json_decode($response);
		if($introspected && $introspected->active) {
			$isFinished=true; break;
		}
		sleep(15);
	}
	\Drupal::logger('okta_ajax')->notice("Introspect results: ".$response);
	if(!$introspected){
		return new JSONResponse( ['error'=>'could not inspect this token']);
	} else if ( property_exists($introspected,'error') && $introspected->error) {
		return new JSONResponse( ['error'=>$introspected->error ] );
	} else if( !$introspected->active  || !$introspected->username ) {
		return new JSONResponse( ['error'=>'No active session found']);
	}
	$base = 'https://welkexternal.oktapreview.com/';
	$response = \Drupal::httpClient()->get($base.'/api/v1/users/'.$introspected->username, [
		 'headers'=>['Accept'=>'application/json','Content-Type'=>'application/json','Authorization'=>'SSWS '.$api_token]
	])->getBody()->getContents();
	\Drupal::logger('okta_ajax')->notice("Fetched user profile: ".$response);

	$user = json_decode($response);
	if(isset($desc) && $desc !=''){
		$user->cancel_desc = $desc;
	}
	try {
		$user->email_preferences = $this->getEmailPreferences($introspected->username);
		//$user_tmp = (array)$user;
		//$user_tmp['email_preferences'] = $this->getEmailPreferences($introspected->username);
		//$user = (object)$user_tmp;
	} catch (Exception $e) {
		\Drupal::logger('okta_ajax')->notice("Could not fetch email preferences");
	}
	return new JSONResponse( $user );
  }

  public function returnIntrospect() {
  	//return new JsonResponse($this->azureTest());
  	

	$token = \Drupal::request()->request->get('token');
	$retry_max = \Drupal::request()->request->get("retry_max");
	if(!$retry_max){ 
		$retry_max = 2; 
	}
	else {
		$retry_max = intval($retry_max);
	}
	if(!$token){
		return new JsonResponse(['error'=>'Requires a token to inspect']);
	}
	return new JsonResponse( $this->introspect($token, $retry_max) );
  }
  
  public function introspect($token, $retry_max=2) {
	
	//retry a few times because it can take a few moments for okta to return correctly after creating a new session
	
    $client_id = '0oamyegepiWpbi9Ec0h7';
    $client_secret = 'QqaeKK-UR5rWOxp6abIyG0GqbBptJ3tgVg68qlYn';
    $endpoint = 'https://welkexternal.oktapreview.com/oauth2/default/v1/introspect';
	$tempstore = \Drupal::service('tempstore.private')->get('okta_ajax');
	\Drupal::logger('okta_ajax')->notice("Introspect, current tempstore: ".$tempstore->get('token'));
	$retries = 0; $finished = false;
	$res = null;
	while($retries < $retry_max && !$finished) {
		try {
		$response = \Drupal::httpClient()->post( $endpoint, [
			'verify' => true,
			'form_params' => [
				'token' => $token,
				'client_id' => $client_id,
				'client_secret' => $client_secret
			],
			'headers' => [
				'content-type' => 'application/x-www-form-urlencoded',
				'accept' => 'application/json'
			]
		])->getBody()->getContents();
		} catch (RequestException $e) {
			$tempstore->delete('token');
			return ['error'=>'Did not receive valid response', 'e' => $e->getResponse() ];
		}
		$retries++;
		$res = json_decode($response);
		if($res && $res->active) {
			$finished = true;
		}
		if(!$finished){
			sleep(10);
		}
	}
    if(!$finished){
		\Drupal::logger('okta_ajax')->notice("Introspect could not get an active session back from users token");
		return ['error'=>'Did not get active session', 'e' => $response ];
	}
	$tempstore->set('token', $token);
	\Drupal::logger('okta_ajax')->notice("Introspect, set token current tempstore: ".$tempstore->get('token'));
    if($res && $res->username) {
    	
		$this->azureUpdateAccess($res->username);

	}

    return $res;
  }
  /** Implement function changeReservation */
  public function changeReservation() {
	// Session Request
	$session_val = \Drupal::request()->getSession();
	$flag  = \Drupal::request()->query->get('flag');;
	$session_val->set('clicked', $flag); // flag set in session
	// $session_val->get('flag');
	return new Response(render($session_val->get('clicked')));
  }
  /** Implement function changeReservation */
  public function cancelReservation() {
	// Session Request
	$session_val = \Drupal::request()->getSession();
	$bookId  = \Drupal::request()->query->get('bookId');
	$hCode = \Drupal::request()->query->get('hotelCode');
	$session_val->set('bookId', $bookId); // booking Id set in session
	$session_val->set('hCode', $hCode); // booking Id set in session
	// $session_val->get('flag');
	return new Response(render($session_val->get('bookId')));
  }

}

