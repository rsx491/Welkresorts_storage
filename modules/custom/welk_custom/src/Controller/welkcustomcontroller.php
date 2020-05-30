<?php

namespace Drupal\welk_custom\Controller;

use Symfony\Component\HttpFoundation;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Database\Statement;
use Drupal\node\Entity\Node;
use Symfony\Component\HttpFoundation\Response;
use Drupal\Component\Serialization\Json;
use MicrosoftAzure\Storage\Table\TableRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
use MicrosoftAzure\Storage\Table\Models\Entity;
use MicrosoftAzure\Storage\Table\Models\QueryEntitiesOptions;
use MicrosoftAzure\Storage\Table\Models\EdmType;
use Drupal\okta_ajax\Controller\OktaLoginController;
use Drupal\okta_ajax\ApiService;
/**
 * Handle travelclick api requests for booking/availability
*/
class welkcustomcontroller {

	public function cookiesval(){
		$query = \Drupal::request()->query->all();
		//$ip_address = \Drupal::request()->getClientIp();
		//$ip = $_SERVER['REMOTE_ADDR'];
		//$bookingController = new welkcustomcontroller();
		//$booking = $bookingController->getUserIP();
		$localIP = getHostByName(getHostName());
	    $tempstore = \Drupal::service('tempstore.private')->get('okta_ajax');
	    $token = $tempstore->get('token');
		if($token){
			$userController = new OktaLoginController();
			$user_details = $userController->introspect($token, 2);
			$okta_id=$user_details->email;
	    }
		else{
			\Drupal::logger('welk_custom')->notice("Okta user is not login");
		}
	   $conn = new welkcustomcontroller();
	   $db_connection= $conn->azure_db_connection();
      //create new cookie details entry
	  if($db_connection){
	  try {
        if(isset($okta_id)){		  
		  $tbl_cookies = 'UserCookiesConsent';
		  $un_id = uniqid();
		  
		  $newRow = new Entity();
		  $newRow->setPartitionKey('Cookies_consent');
		  $newRow->setRowKey($un_id);
		  $newRow->addProperty('Ipaddress', 'Edm.String', $localIP );
		  $newRow->addProperty('OktaID', 'Edm.String', $okta_id );
		  $newRow->addProperty('Consent_flag', 'Edm.Int32', 1);
		  $db_connection->insertOrMergeEntity($tbl_cookies, $newRow);
		  $guests_row = $newRow;
		  //print($guests_row);exit;
		  \Drupal::logger('welk_custom')->info('insted data into table UserCookiesConsent');
		}
		else{
			$tbl_cookies = 'UserCookiesConsent';
		  $un_id = uniqid();
		  
		  $newRow = new Entity();
		  $newRow->setPartitionKey('Cookies_consent');
		  $newRow->setRowKey($un_id);
		  $newRow->addProperty('Ipaddress', 'Edm.String', $localIP );
		  $newRow->addProperty('Consent_flag', 'Edm.Int32', 1);
		  $db_connection->insertOrMergeEntity($tbl_cookies, $newRow);
		  $guests_row = $newRow;
		  //print($guests_row);exit;
		  \Drupal::logger('welk_custom')->info('insted data into table UserCookiesConsent');
		}
	  }
	  catch (\Exception $error) {
				//print $error;die;
				watchdog_exception('Table entry', $error, $error);
			}
	  }
		return new Response($localIP);
	}
	public function azure_db_connection(){
		$key = "0wKvm82qfHR7TREINfZN9LCuCLV28nonuDkOAvz4ri9uOJ7dDhxqo4BuU7Bbs//V3p0NVX4cqxZGBrFf7ieg0g==";
		//$account = \Drupal::config('okta_ajax.settings')->get('azure_account');
		$account = "welkresortsdevdata001";
		$connectionString = 'DefaultEndpointsProtocol=https;AccountName='.$account.';AccountKey='.$key.';EndpointSuffix=core.windows.net';
		$azure = TableRestProxy::createTableService($connectionString);
		return $azure;
	}
	

} 