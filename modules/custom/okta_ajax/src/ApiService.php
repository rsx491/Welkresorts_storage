<?php

namespace Drupal\okta_ajax;

use Drupal\Core\Session\AccountProxy;
use Symfony\Component\HttpFoundation\JsonResponse;
use \GuzzleHttp\Exception\RequestException;

//use Okta\ClientBuilder;
/*
 Note: Okta\ClientBuilder requires a newer version of yaml than the current Drupal allows. The currently used functions are using pure REST alternatives until that conflict is fixed.
*/



/**
 * Okta API Service
 * 
 * expose okta api functions, authentication and oauth helpers for other drupal classes
 * refer to https://packagist.org/packages/okta/sdk
 */
class ApiService {

    /**
     * Okta sdk client
     * 
     * @var \Okta\ClientBuilder
     */
    private $_client;

    /**
     * Current signed in drupal user
     * 
     * @var\Drupal\Core\Session\AccountProxy
     */
    private $_currentUser;

    private $_apiToken;
    private $_domain;
    

    /**
     * Constructor for okta_ajax ApiService 
     * 
     * @param \Drupal\Core\Session\AccountProxy $currentUser injected current drupal user if there is one
     */
    public function __construct(AccountProxy $currentUser) {
        $this->_currentUser = $currentUser;
        $this->_apiToken = \Drupal::config('okta_ajax.settings')->get('okta_api_key');
        $this->_domain = \Drupal::config('okta_ajax.settings')->get('okta_domain');
        /*$this->_client = (new ClientBuilder())
            ->setToken('okta_api_key')
            ->setOrganizationUrl('https://'.$domain.'oktapreview.com')
            ->setHttpClient( \Drupal::httpClient() )
            ->build();*/
    }

    /**
     * Returns the current Okta client instance
     * @return \OktaClientBuilder
     */
    public function getClient() {
        return $this->_client;
    }

    /**
     * Find a user by their okta id
     * 
     * @param string $id Okta User ID
     * @return \Okta\Users\User a User object or null
     */
    public function getUserById( $id ) {
        throw new Exception("Currently disabled");
        /*$user = new \Okta\Users\User();
        $foundUser = $user->get( $id );
        return $foundUser;*/
    }

    /**
     * Find a user by their email
     * 
     * @param string $email Okta User Email
     * @return \Okta\Users\User a User object or null
     */
    public function getUserByEmail( $email ) {
        $endpoint = 'https://'.$this->_domain.'.oktapreview.com/api/v1/';
        
        try {
            $response = \Drupal::httpClient()->get( $endpoint.'users/'.$email ,  [
                'verify' => true,
                'headers' => [
                  'content-type' => 'application/json',
                  'Authorization'=>'SSWS '.$this->_apiToken,
                  'accept' => 'application/json'
                ],
              ])->getBody()->getContents();
            $user = json_decode($response);
            return ($user) ? $user : false;
        } catch(RequestException $e) {
            return false;
        }
        /*
        $user = new \Okta\Users\User();
        $foundUser = $user->get( $email );
        return $foundUser; */
    }

    /**
     * Get users
     * 
     * @param array $query Optional. options to filter the response. Null for all users
     * @return Collection Collection of users
     */
    public function getUsers( $query ) {
        //$users = (new \Okta\Okta)->getUsers( $query );
    }

    /**
     * Create a new user
     * 
     * @param string $email Unique email address
     * @param string $pass password 8+ characters with 1 lower case, 1 uppercase and a digit. can't contain any string from the email address
     * @param string $first First Name
     * @param string $last Last Name
     * @param array $recoveryQuestions optional pair of question/answer 
     * @param array $groupIds optional list of Okta group ids to add this user to
     * @return \Okta\Users\User the newly created User object
     */
    public function _createUser( $email, $pass, $first, $last, $recoveryQuestions, $groupIds ) {
        if(!$email || !$pass || !$first || !$last ) {
            throw new Exception("Email, password, first name and last name are required");
        }
        throw new Exception("This function is disabled");
        /*
        $user = new \Okta\Users\User();
        $profile = new \Okta\Users\Profile();

        $profile->setFirstName($first)
            ->setLastName($last)
            ->setLogin($email)
            ->setEmail($email);
        $user->setProfile($profile);

        $credentials = new \Okta\Users\Credentials();

        $password = new \Okta\Users\Password();
        $password->setPassword($pass);

        


        $provider = new \Okta\Users\Provider();
        $provider->setName('OKTA')
            ->setType('OKTA');


        $credentials->setPassword($password);

        if($recoveryQuestions && !empty($recoveryQuestions) ){
            $recoveryQuestion = new \Okta\Users\RecoveryQuestion();
            $recoveryQuestion->setQuestion($recoveryQuestions[0])
                ->setAnswer($recoveryQuestions[1]);
            $credentials->setRecoveryQuestion($recoveryQuestion);
        }
        
        $credentials->setProvider($provider);


        $user->setCredentials($credentials);

        if($groupIds && !empty($groupIds) ) {
            $user->setGroupIds($groupIds);
        }

        $user->create();

        return $user;
        */
    }

    public function createUser($username, $password, $first_name, $last_name) {
    
        $api_token = \Drupal::config('okta_ajax.settings')->get('okta_api_key');
        $endpoint = 'https://'.\Drupal::config('okta_ajax.settings')->get('okta_domain').'.oktapreview.com/api/v1/';
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
        \Drupal::logger('okta_ajax')->notice("Manually creating okta user for: ".json_encode($data['profile']) );
        try {
            $response = \Drupal::httpClient()->post( $endpoint.'users?activate=false' , $opts  )->getBody()->getContents();
        } catch (RequestException $e) {
          return ['error' => 'Request Exception occured during request', 'data' => $e->hasResponse() ? $e->getResponse() : '' ];
        } catch (Exception $e) {
            return ['error' => 'Unknown Exception occured during request', 'data' => $e->getMessage() ];
        }
        return json_decode($response);
  }

    /**
     * Update the profile of an existing user
     * Does not remove unspecified fields, just updates the ones provided. For changing credentials or non-profile details use other api calls
     * 
     * @param string|\Okta\Users\User email or User object
     * @param array $profileChanges a set of key/values for profile fields that should be updated
     * @return \Okta\Users\User user object after saving profile changes
     */
    public function updateUser( $emailOrUser, $profileChanges ) {
        throw new Exception("Currently disabled");
        /*
        $user = $emailUser;
        if(is_string($emailUser)){
            $user = $this->getUserByEmail($emailUser);
        }
        if(!$user){
            throw new Exception("Invalid user");
        }
        $profile = $user->getProfile();
        foreach($profileChanges as $k=>$v ) {
            $profile->{$k} = $v;
        }
        $user->setProfile($profile);
        $user->save();
        return $user;
        */
    }

    /**
     * Sends a password reset email
     * use this instead of User->resetPassword in order to have the email sent automatically
     * 
     * @param string|\Okta\Users\User either the email of the User or the User object
     * @param bool $sendEmail send the reset email automatically or don't. default is true
     * @return Object current user from response to Okta api or an error response
     */
    public function forgotPassword( $emailUser, $sendEmail = true ) {
        $user = $emailUser;
        if(is_string($emailUser)){
            $user = $this->getUserByEmail($emailUser);
        }
        if(!$user){
            throw new Exception("Invalid user");
        }
        $id = $user->getId();
        if(!$id){
            throw new Exception("Invalid user id");
        }
        //TODO:: ideally would use Okta/sdk but need to override their reset password function to include the sendEmail param
        $api_token = \Drupal::config('okta_ajax.settings')->get('okta_api_key');
        $endpoint = 'https://'.\Drupal::config('okta_ajax.settings')->get('okta_domain').'.oktapreview.com/api/v1/';
        \Drupal::logger('okta_ajax')->notice("Requesting password reset for: ".$id );
        
        $response = \Drupal::httpClient()->post( $endpoint.'users/'.$id.'/lifecycle/reset_password?sendEmail='.($sendEmail?'true':'false') ,  [
        'verify' => true,
        'headers' => [
            'content-type' => 'application/json',
            'Authorization'=>'SSWS '.$api_token,
            'accept' => 'application/json'
        ],
        ])->getBody()->getContents();
        
        return json_decode($response);

    }

    /**
     * Call introspect on an id_token returned from OAuth login
     * 
     * @param string $token the id_token received aftering logging in via OAuth
     * @return object The details included in the token, including if it is active and some user info
     */
    public function introspect( $token ) {
        $client_id = \Drupal::config('okta_ajax.settings')->get('okta_client_id');
        $client_secret = \Drupal::config('okta_ajax.settings')->get('okta_client_secret');
        $domain = \Drupal::config('okta_ajax.settings')->get('okta_domain');
        $endpoint = 'https://'.$domain.'.oktapreview.com/oauth2/default/v1/introspect';
        
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
        
        $res = json_decode($response);
        return $res;
      }


    /**
     * Create new session for a user with email + password
     * 
     * @param string|\Okta\Users\User $emailOrUser the login email or user object
     * @param string $password users password
     * @return object response from auth with session . see https://developer.okta.com/docs/reference/api/authn/#primary-authentication-with-trusted-application
     */
    public function loginWithPassword( $emailOrUser, $password ) {
        $username = $emailOrUser;
        if(!is_string($emailOrUser)){
            $username = $emailOrUser->getProfile()->getEmail();
        }
        $data = [ 'username' => $username, 'password' => $password, 'options' => [
            'multiOptionalFactorEnroll' => true,
            'warnBeforePasswordExpired' => true
        ]];
        \Drupal::logger('okta_ajax')->notice("Received Authn Login for ".$username);
        $domain = \Drupal::config('okta_ajax.settings')->get('okta_domain');
        $api_token = \Drupal::config('okta_ajax.settings')->get('okta_api_key');
        $endpoint = 'https://'.$domain.'.oktapreview.com/api/v1/';
        $opts = [
            'verify' => true,
            'json' => $data,
            'headers' => [
              'Authorization'=>'SSWS '.$api_token,
              'accept' => 'application/json'
            ],
        ];
        
        $response = \Drupal::httpClient()->post( $endpoint.'authn' , $opts )->getBody()->getContents();
        
        $res = json_decode($response);
    
        return $res;
    }

    // https://gist.github.com/tylerhall/521810
    // Generates a strong password of N length containing at least one lower case letter,
    // one uppercase letter, one digit, and one special character. The remaining characters
    // in the password are chosen at random from those four sets.
    //
    // The available characters in each set are user friendly - there are no ambiguous
    // characters such as i, l, 1, o, 0, etc. This, coupled with the $add_dashes option,
    // makes it much easier for users to manually type or speak their passwords.
    //
    // Note: the $add_dashes option will increase the length of the password by
    // floor(sqrt(N)) characters.
    public function generateStrongPassword($length = 9, $add_dashes = false, $available_sets = 'luds')
    {
        $sets = array();
        if(strpos($available_sets, 'l') !== false)
            $sets[] = 'abcdefghjkmnpqrstuvwxyz';
        if(strpos($available_sets, 'u') !== false)
            $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
        if(strpos($available_sets, 'd') !== false)
            $sets[] = '23456789';
        if(strpos($available_sets, 's') !== false)
            $sets[] = '!@#$%&*?';
        $all = '';
        $password = '';
        foreach($sets as $set)
        {
            $password .= $set[array_rand(str_split($set))];
            $all .= $set;
        }
        $all = str_split($all);
        for($i = 0; $i < $length - count($sets); $i++)
            $password .= $all[array_rand($all)];
        $password = str_shuffle($password);
        if(!$add_dashes)
            return $password;
        $dash_len = floor(sqrt($length));
        $dash_str = '';
        while(strlen($password) > $dash_len)
        {
            $dash_str .= substr($password, 0, $dash_len) . '-';
            $password = substr($password, $dash_len);
        }
        $dash_str .= $password;
        return $dash_str;
    }
}