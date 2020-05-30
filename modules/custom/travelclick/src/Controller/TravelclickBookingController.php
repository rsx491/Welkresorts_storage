<?php


namespace Drupal\travelclick\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Database\Statement;
use Drupal\node\Entity\Node;
use Symfony\Component\HttpFoundation\Response;
use Drupal\Component\Serialization\Json;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Url;
use MicrosoftAzure\Storage\Table\TableRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
use MicrosoftAzure\Storage\Table\Models\Entity;
use MicrosoftAzure\Storage\Table\Models\QueryEntitiesOptions;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Render\Renderer;
use Drupal\Component\Render\FormattableMarkup;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;
use MicrosoftAzure\Storage\Table\Models\EdmType;
/**
 * Handle travelclick api requests for booking/availability
*/
class TravelclickBookingController {

	private $token;
	private $api_base = 'https://api-staging.travelclick.com/';

	private function getToken() {
		if( $this->token) {
			return $this->token; 
		}

		//TODO:: pull in api key + secret from an admin configuratio screen
		$client_id = '17xx9bj83kywdndja00f4j9zb0iy5md346t1';
		$secret = 's2aoyrwoxn32dkd7v6k43drwn7b46jkc';
		$auth_basic = 'Basic MTd4eDliajgza3l3ZG5kamEwMGY0ajl6YjBpeTVtZDM0NnQxOnMyYW95cndveG4zMmRrZDd2Nms0M2Ryd243YjQ2amtj';
		$response = \Drupal::httpClient()->post( $this->api_base.'swagger-ui/auth', [
			'verify' => false,
			'headers' => [
				'authorization' => $auth_basic,
				'content-type' => 'application/json',
				'referer'	=> 'https://api-staging.travelclick.com/swagger-ui/?urls.primaryName=Staging%20-%20Shop%20V1',
				'origin'	=> 'https://api-staging.travelclick.com'
			]
		])->getBody()->getContents();

		$res = json_decode($response);
		//dpm($res);
		if( $res && is_object($res) && isset($res->access_token) ) {
			$this->token = $res->access_token;
			return $res->access_token;
		} else {
			throw new Exception("Unable to receive token: ".$response);
		}
  	}
	
	private function getbookingToken() {
		if( $this->token) {
			return $this->token; 
		}
		//TODO:: pull in api key + secret from an admin configuratio screen
		$client_id = '17xx9bj83kywdndja00f4j9zb0iy5md346t1';
		$secret = 's2aoyrwoxn32dkd7v6k43drwn7b46jkc';
		$auth_basic = 'Basic MTd4eDliajgza3l3ZG5kamEwMGY0ajl6YjBpeTVtZDM0NnQxOnMyYW95cndveG4zMmRrZDd2Nms0M2Ryd243YjQ2amtj';
		$response = \Drupal::httpClient()->post( $this->api_base.'swagger-ui/auth', [
			'verify' => false,
			'headers' => [
				'authorization' => $auth_basic,
				'content-type' => 'application/json',
				'referer'	=> 'https://api-staging.travelclick.com/swagger-ui/?urls.primaryName=Staging%20-%20Book%20V1',
				'origin'	=> 'https://api-staging.travelclick.com'
			]
		])->getBody()->getContents();

		$res = json_decode($response);
		
		if( $res && is_object($res) && isset($res->access_token) ) {
			$this->token = $res->access_token;
			return $res->access_token;
		} else {
			throw new Exception("Unable to receive token: ".$response);
		}
  	}
	public function getRooms( $hotelCode ) {
		$url = $this->api_base.'/entity/v1/hotel/'.$hotelCode.'/info/rooms?lang=en';
		$token = $this->getToken();
			$response = \Drupal::httpClient()->get($url, ['headers'=>['authorization'=>'Bearer '.$token]])->getBody()->getContents();
		return json_decode($response);
	}
     public function searchAvailability( $hotelCode, $dateIn, $dateOut, $rooms, $adults) {
			$api_base = 'https://api-staging.travelclick.com/';
			$url = $api_base.'shop/v1/hotel/'.$hotelCode.'/avail';
			$query = array(
				'dateIn' => $dateIn,
				'dateOut' => $dateOut,
				'rooms' => $rooms,
				'adults' => $adults,
				'discountCode'=>$discountCode,
				'isAvailableOnly' => 'true',
				'isAltHotelsReq' => 'false'
				 );
			//if( !is_null($optionals) && !empty($optionals) ) {
				//foreach( $optionals as $k=>$v ) {
				//	$query[$k] = $v;
				//}
			//}

			$token = $this->getToken();

				try {
					$response = \Drupal::httpClient()->get( $url , [
						'query' => $query,
						'timeout' =>10000,
						'headers' => [
							'authorization' => 'Bearer '.$token,
							'accept'	=> 'application/json',
						],
					]);
						// This is the Part I don't understand.
					if ($response->getStatusCode() == 200) {
						$data = $response->getBody()->getContents();
						if (empty($data)) {
							return FALSE;
						}
					}
					elseif($response->getStatusCode() == 403) {
						$data = $response->getBody()->getContents();
						if (empty($data)) {
							return FALSE;
						}
					}
					elseif($response->getStatusCode() == 500) {
						$data = $response->getBody()->getContents();
						if (empty($data)) {
							return FALSE;
						}
					}
					else{
						$data = "Something went wrong!!!";
					}
				}
				catch (RequestException $e) {
					watchdog_exception('travelclick', $e);
				}

			return json_decode($data);

  	}
	public function offerupgrade( $hotelCode, $dateIn, $dateOut, $room, $adult) {
		$api_base = 'https://api-staging.travelclick.com/';
		$url = $api_base.'shop/v1/hotel/'.$hotelCode.'/avail';
		$query = array(
			'dateIn' => $dateIn,
			'dateOut' => $dateOut,
			'rooms' => $room,
			'adults' => $adult,
			'isAvailableOnly' => 'true',
			'isAltHotelsReq' => 'false'
			 );
		$token = $this->getToken();

		try {
				$response = \Drupal::httpClient()->get( $url , [
					'timeout' => 800,
					'query' => $query,
					'headers' => [
						'authorization' => 'Bearer '.$token,
						'accept'	=> 'application/json',
					],
				]);
				
			$code = json_decode($response->getStatusCode());
			if ($code == 200) {
			  	$data = $response->getBody()->getContents();
				return json_decode($data);
			}
			elseif($code == 403) {
				$data = $response->getBody()->getContents();
				return json_decode($data);
			}
			elseif($code == 500) {
				$data = $response->getBody()->getContents();
				return json_decode($data);
			}
			elseif($code == 503) {
				$data = $response->getBody()->getContents();
				return json_decode($data);
			}
			elseif($code == 504) {
				$data = $response->getBody()->getContents();
				return json_decode($data);
			}
			else{
				$data = "Something went wrong!!!";
				return $data;
			}
		}
		catch (GuzzleException $error) {
			$response = $error->getMessage();
			\Drupal::logger('reservation confirmed - offerUpgrade')->notice($response);
			// Logs an error
			\Drupal::logger('reservation confirmed - offerUpgrade')->error($response);
			 throw $error;
		}
	}
	public function retrive_reservation($hotelCode, $unique_id, $surname) {
		$api_base = 'https://api-staging.travelclick.com/';
		$url = $api_base.'book/v1/hotel/'.$hotelCode.'/reservation/'.$unique_id;
		$query = array(
			//'reservationCode' => $unique_id,
			'surName' => $surname
			);
		$token = $this->getToken();
		try {
				$response = \Drupal::httpClient()->get( $url , [
					'timeout' => 800,
					'query' => $query,
					'headers' => [
						'authorization' => 'Bearer '.$token,
						'accept'	=> 'application/json',
					],
				]);
			$code = json_decode($response->getStatusCode());
			if ($code == 200) {
			  	$data = $response->getBody()->getContents();
				return json_decode($data);
			}
			elseif($code == 403) {
				$data = $response->getBody()->getContents();
				return json_decode($data);
			}
			elseif($code == 500) {
				$data = $response->getBody()->getContents();
				return json_decode($data);
			}
			elseif($code == 503) {
				$data = $response->getBody()->getContents();
				return json_decode($data);
			}
			elseif($code == 504) {
				$data = $response->getBody()->getContents();
				return json_decode($data);
			}
			else{
				$data = "Something went wrong!!!";
				return $data;
			}
		}
		catch (GuzzleException $error) {
			$response = $error->getMessage();
			\Drupal::logger('reservation - retrive_reservation')->notice($response);
			// Logs an error
			\Drupal::logger('reservation - retrive_reservation')->error($response);
			 throw $error;
		}
		return json_decode($data);

	}
	
  Public function reservationdetails(){
	//Session
	$sessionController	= new TravelclickBookingController();
	$session_details 	= $sessionController->sessiondetails();
	$tagetID 			= $session_details->get('tid_val');
	$hotelCode 			= $session_details->get('hotel_code');
	$guestdetails       = $session_details->get('guestdetails');
	$roomcode_rate      = $session_details->get('room_code_rate_code');
	$booking_detail     = $session_details->get('booking_details');
	$room               =  substr($session_details->get('room'), 0,1); 
	$guest              =  (int) filter_var($session_details->get('guests'), FILTER_SANITIZE_NUMBER_INT);
	$checkindate        = date('Y-m-d', strtotime($session_details->get('checkin_date')));
	$checkoutdate       = date('Y-m-d', strtotime($session_details->get('checkout_date')));
	$surname            = 'Click';//$guestdetails['guest_last_name'];
	//TODO:: request search results from controller module
    $query				= \Drupal::request()->query->all();
    //$room 				= 2; //substr($roomguest[0], 0,1); //only do one room for testing purposes so we dont have to use multi-room api
    //$guest  			= 4;
    //$hotelCode 			= 99939; //TODO:: get hotel code from Destination form entry
    //$tagetID			= 7;
	$theme_path = drupal_get_path('theme', 'welkresorts');
	$path = \Drupal::request()->getSchemeAndHttpHost().base_path();
	/** Azure connection **/
	$key = "0wKvm82qfHR7TREINfZN9LCuCLV28nonuDkOAvz4ri9uOJ7dDhxqo4BuU7Bbs//V3p0NVX4cqxZGBrFf7ieg0g==";
    //$account = \Drupal::config('okta_ajax.settings')->get('azure_account');
    $account = "welkresortsdevdata001";
    $connectionString = 'DefaultEndpointsProtocol=https;AccountName='.$account.';AccountKey='.$key.';EndpointSuffix=core.windows.net';
    $azure = TableRestProxy::createTableService($connectionString);
	
	
	$results_aminities 		= 	db_select('node__field_amenities_activities_desti', 'aad')
								->fields('aad', array('entity_id'))
								->condition('bundle', 'amenities_activities')
								->condition('field_amenities_activities_desti_target_id', $tagetID, '=')
								->execute()->fetchAll();
  
	$results_room_details	= 	db_select('node__field_destination','fd')
								->fields('fd', array('entity_id'))
								->condition('bundle', 'room_details')
								->condition('field_destination_target_id', $tagetID, '=')
								->execute()->fetchAll();
  
  	$results_local_area_blog = 	db_select('node__field_local_area_destination', 'lad')
								->fields('lad', array('entity_id'))
								->condition('bundle', 'local_area')
								->condition('field_local_area_destination_target_id', $tagetID, '=')
								->execute()->fetchAll();
	$rate_details = [];	
	$booking_details = [];
	$itenary_details = [];
	$retrive_res = [];
	$booking_detail_data = array();
	$html = [];
	$tbl_booking = 'roomBookingDetail';
	$tbl_itinery = 'itinerary';
	$view_room_code = [];
	foreach($roomcode_rate as $value){

	/* Select Queries for b room booking details */
	try {
      $bookin_details_datas = $azure->getEntity($tbl_booking,'booking_details',$value['room_CID']);
	  //$booking_detail_data[] = array('booking_detail_data'=>$bookin_details_datas);
    } catch (ServiceException $e) {     
    }
	
	$entity = $bookin_details_datas->getEntity();

  /** $booking_detail_data[] = $entity->getPropertyValue("room_booking_id");
   $booking_detail_data[] = $entity->getPropertyValue("room_name");
   $booking_detail_data[] = $entity->getPropertyValue("rate_plan_name");
   $booking_detail_data[] = $entity->getPropertyValue("room_type_code");
   $booking_detail_data[] = $entity->getPropertyValue("room_count");
   $booking_detail_data[] = $entity->getPropertyValue("room_total_before_tax");
   $booking_detail_data[] = $entity->getPropertyValue("total_duration");
   $booking_detail_data[] = $entity->getPropertyValue("currency");
   $booking_detail_data[] = $entity->getPropertyValue("rate_details_data");
   $booking_detail_data[] = $entity->getPropertyValue("rate_details_plan");
   $booking_detail_data[] = $entity->getPropertyValue("total_amout");
   $booking_detail_data[] = $entity->getPropertyValue("rate_plan_code");
   $booking_detail_data[] = $entity->getPropertyValue("rate_plan_type");
   $booking_detail_data[] = $entity->getPropertyValue("currency_code");
**/
	$rate_detail_data = json_decode($entity->getPropertyValue("rate_details_data"), true);
	$rate_detail_plan = json_decode($entity->getPropertyValue("rate_per_day"), true);

	$theme_path = drupal_get_path('theme', 'welkresorts');
	
	$data_value = array();
	
	
	foreach($rate_detail_plan as $rate_date_key=>$rate_date_value){
		$data_html = array();
				foreach($rate_date_value as $key=>$value){
					$data_html[] = '<td></td><td>'.date("D,M d Y",$key).'</td>								
					<td>'.$value.'</td>';
				}
				
				$data_value[] = '<tr>'.implode('</tr><tr> ', $data_html).'</tr>';
				
		}
				$rate_data = implode('',$data_value);
				
				
				
				
	$room_total = $entity->getPropertyValue("room_total");
	$room_total_resort_fee = $entity->getPropertyValue("room_total_resort_fee");
	$total_room_amount = array();			
	$total_room_amount[] = $room_total + $room_total_resort_fee;
	$total_amount_after_cal = implode('',$total_room_amount);
	
	$view_room_code[] = $entity->getPropertyValue("room_type_code");
	
	$html[] .= '
                    <p class="mt-1"><strong>'.$entity->getPropertyValue("room_type_name").'</strong></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
							<span>'
								.$entity->getPropertyValue("rate_plan_name").'<br />
										Details: <a title="Change Room" data-toggle="modal" data-target="#viewRooms'.$entity->getPropertyValue("room_type_code").'" class="change-room-link"
										href="#">Room</a>
										| 
										<a title="Change Room" data-toggle="modal" data-target="#changeRoom'.$entity->getPropertyValue("room_booking_id").'" class="change-room-link"
										href="#">Rate Details</a> 
										<!-- Modal for rate-->
										<div class="modal fade room-gallery" id="changeRoom'.$entity->getPropertyValue("room_booking_id").'" tabindex="-1" role="dialog" aria-labelledby="bookingRoom"
										 aria-hidden="true">
											<div class="modal-dialog modal-lg " role="document">
												<div class="modal-content ">
												   <div class="modal-header d-block container">
													  <h2 class="modal-title  text-center" id="exampleModalLongTitle">'.$entity->getPropertyValue("room_type_name").'</h2>
													  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
														 <span aria-hidden="true">&times;</span>
													  </button>
													</div>
													<div class="modal-body container">
													  <!--tabs - photo & 3d tour -->
													<div class="row">
														<div class="col-6">
														
														
													<h4>Overview</h4>
													<br /><p>'.$entity->getPropertyValue("rate_overview").'</p>
													<h4>Deposit Policy</h4>
													<br /><p>'.$entity->getPropertyValue("deposit_policy").'</p>
													<h4>Cancellation Policy </h4>
													<br /><p>'.$entity->getPropertyValue("cancellation_policy").'</p>
															
														
														
											</div>
														
												<div class="col-6">
																<h4 class="text-center mb-4">Price Breakdown</h4>
																<table class="table text-right price-table-breakdown">
																	<thead>
																		<tr>
																			
																				<th>&nbsp;</th>
																				<th><strong>1 Room(s) for'.$rate_detail_plan_value['no_night'].'Night(s)</strong></th>
																				<th><strong>Prices in '.$entity->getPropertyValue("currency").'</strong></th>
																			
																		</tr>
																	</thead>
																	<tbody>'																		
																	.$rate_data.
																	'</tbody>
																</table>	
																<table class="table text-right price-table-breakdown">
																	<tbody>
																		<tr>
																			<td>&nbsp;</td>
																			<td>Resort Fees <img src="'.$path.'/'.$theme_path.'/dest/images/info-icon-grey.svg" /></td>
																			<td>'.$entity->getPropertyValue("currency_code").''.$entity->getPropertyValue("room_total_resort_fee").'</td>
																		</tr>
																		<tr>
																			<td>&nbsp;</td>
																			<td><strong>Total</strong></td>
																			<td><strong>'.$entity->getPropertyValue("currency_code").''.$total_amount_after_cal.'</strong></td>
																		</tr>
																	</tbody>
																</table>
															</div>		
													</div>
													  <!--tabs - photo & 3d tour -->
												</div>
												   <div class="modal-footer container">
													  <!--<button type="button" class="btn btn-primary medium">Select Rate</button>-->
													  <button type="button" class="btn btn-secondary medium" data-dismiss="modal">Close</button>
												   </div>
												</div>
											</div>
										</div>
								   </span>
								</div>
								<div>
								   <p class="p-0 m-0"><strong>'.$entity->getPropertyValue("currency_code").''.$entity->getPropertyValue("room_total_before_tax").'</strong></p>
								   <span class="small">'.$entity->getPropertyValue("currency").' For '.$entity->getPropertyValue("total_duration").'Nights</span>
							</span>
                        </div>
                     </div>';
                  
		
		//retrive reservation
		$retrive_reservation 	= new TravelclickBookingController();
		//$retrive_res[] 	= $retrive_reservation->retrive_reservation($hotelCode,$value['room_CID'],$surname);
        //$retrive_res[] = array('retrive_res'=>$retriveResponse);
	}

	/* Select Queries for  room booking details based on itinery */
	
	try {
      $bookin_details_itinery = $azure->getEntity($tbl_itinery,'itinery_details',$booking_detail['itenary_ID']);
	  //$booking_detail_data[] = array('booking_detail_data'=>$bookin_details_datas);
    } catch (ServiceException $e) {
      
    }	
	$itinery = $bookin_details_itinery->getEntity();
	if(!empty($itinery)){
		$data .=	'<div class="confirm-room-details default-style">
				<em>OPTIONAL</em>
				<p class="mt-1"><strong>Vacation Guard</strong></p>
				<div class="form-check">';
				if($itinery->getPropertyValue("vacation_guard_flag") == '1'){
		$data .=	'<input class="form-check-input" type="checkbox" checked id="defaultCheck3">';
				}else{
		$data .=	'<input class="form-check-input" type="checkbox" value="" id="defaultCheck3">';
				}
		$data .=	'<label class="form-check-label" for="defaultCheck3">
					   &nbsp;&nbsp;Yes, add travel protection $99.00 per room.
					   &nbsp;&nbsp;<a href="#">Learn More</a>.
					</label>
				</div>
			</div>
			<!--table-->
			<table class="table text-right">
				<tbody>
					<tr>
					   <td>Resort Fees <img src="'.$path.'/'.$theme_path.'/dest/images/info-icon-grey.svg" /></td>
					   <td><strong>'.$itinery->getPropertyValue("total_resort_fee").' '.$itinery->getPropertyValue("currency").'</strong></td>
					</tr>
					<tr>
					   <td>Taxes</td>
					   <td><strong>$'.$itinery->getPropertyValue("total_tax").' '.$itinery->getPropertyValue("currency").'</strong></td>
					</tr>
					<tr>
					   <td><strong>Total</strong></td>
					   <td><strong>$'.$itinery->getPropertyValue("total_amount").' '.$itinery->getPropertyValue("currency").'</strong></td>
					</tr>
					<tr>
					   <td><strong>Total Due Today</strong></td>
					   <td><strong>$'.$itinery->getPropertyValue("total_amount_paid").''.$itinery->getPropertyValue("currency").'</strong></td>
					</tr>
				</tbody>
			</table>';
	}	
	$results = [
				'amenities'=>$results_aminities,
				'room_details'=>$results_room_details,
				'blog_details'=>$results_local_area_blog
			];
			
	/*offerUpgrade*/
	//$bookingController 	= new TravelclickBookingController();
	//$offerupgrade 		= $bookingController->offerupgrade($hotelCode,$checkindate,$checkoutdate,$room,$guest);

	// confirmation header
	$headerController 	= new TravelclickBookingController();
	$header_block_val 	= $headerController->getheader2Details();
	$header_query_val 	= $headerController->getheader1Details($tagetID);
		
	//var_dump($offerupgrade);
/**	$Ugrade_room_code = [];
	foreach($roomcode_rate as $selectedroom_value){
		foreach($offerupgrade->roomStays as $key=>$value ){
			foreach($value->roomTypes as $roomtype_key=>$roomtype_value ){
				if( $roomtype_value->roomTypeCode == $selectedroom_value['roomcode'] )
				{
					foreach($roomtype_value->roomUpgradeOptions as $roomUpgradeTypeCode_value){	
							$Ugrade_room_code[] = array('UGRC'=>$roomUpgradeTypeCode_value->roomTypeCode,'UGRPC'=>$selectedroom_value['roomplan_code'],'UGRR'=>$selectedroom_value['roomrate'],'RCID'=>$selectedroom_value['room_CID'],'SRC'=>$selectedroom_value['roomcode'],'IsModifable'=>$selectedroom_value['isModifable']);	
					}
				}
			}
		}
	}
**/
	/*to check whether user is logged in or not */
	$tempstore = \Drupal::service('tempstore.private')->get('okta_ajax');
	$okta_token = $tempstore->get('token');
 
 
	/** Get reservation details from cms **/ 
	$booking_block = \Drupal\block\Entity\Block::load('reservationconfirmed');
	$booking_uuid = $booking_block->getPlugin()->getDerivativeId();
	$booking_block_content = \Drupal::service('entity.repository')->loadEntityByUuid('block_content', $booking_uuid);
	$amenities_activities_title = $booking_block_content->field_amenities_activities_title->value;
	$amenities_description = $booking_block_content->field_amenities_description->value;
	$blog_link = $booking_block_content->field_b;
	$explore_amenities = $booking_block_content->field_explore_amenities->value;
	$guest_description = $booking_block_content->field_guest_description->value;
	$guest_link = $booking_block_content->field_guest_link;
	$guest_title = $booking_block_content->field_guest_title->value;
	$reservation_title = $booking_block_content->field_reservation_title->value;
	$review_changed_reservation = $booking_block_content->field_review_changed_reservation->value;
	$thank_you = $booking_block_content->	field_thank_you->value;
	$thank_you_description = $booking_block_content->field_thank_you_description->value;	
	$travel_inspiration_title = $booking_block_content->field_travel_inspiration_title->value;
	$user_signup_note = $booking_block_content->field_user_signup_note->value;
	
	//if( isset($offerupgrade) ) {
		$items = array('offerupgrade'=>$offerupgrade,'offerdata'=>$Ugrade_room_code,'nodeID'=>$results,'guest'=>$guestdetails,
			'roomcode_rate'=>$roomcode_rate,'room_details'=>$roomcode_rate,
			'header_query_val'=>$header_query_val,'header_block_val'=>$header_block_val,
			'booking_details_data'=>$booking_detail,'rate_plan_details'=>$rate_plan_details,
			'tid'=>$tagetID,'view_room_code_data'=>$view_room_code,
			'isUserloggedIn'=>$okta_token,'ismodifable'=>$retrive_res,'booking_room_detail_data'=>$html,'extension_booking_room_detail_data'=>$data,
			'amenities_activities_title'=>$amenities_activities_title,'amenities_description'=>$amenities_description,'blog_link'=>$blog_link,'explore_amenities'=>$explore_amenities,'guest_description'=>$guest_description,
			'guest_link'=>$guest_link,'guest_title'=>$guest_title,'reservation_title'=>$reservation_title,
			'review_changed_reservation'=>$review_changed_reservation,'thank_you'=>$thank_you,'thank_you_description'=>$thank_you_description,
			'travel_inspiration_title'=>$travel_inspiration_title,'user_signup_note'=>$user_signup_note
		);
   // } else {
	//	$items = array('Error'=>'No search parameters set', 'q'=>$query);
   // }
    return array(
      '#items' => $items,
      '#theme' => 'reservation_details',
    );
  }
  
public function selectrateplan( $hotelCode, $roomTypeCode, $dateIn, $dateOut, $rooms, $adults,$ratePlanCode = NULL,$type = NULL) {
	$api_base = 'https://api-staging.travelclick.com/';
	$url = $api_base.'shop/v1/hotel/'.$hotelCode.'/avail';
	$query = array(
		'dateIn' => $dateIn,
		'dateOut' => $dateOut,
		'rooms' => $rooms,
		'adults' => $adults,
		'roomTypeCode' => $roomTypeCode,
		'ratePlanCode' => $ratePlanCode,
		'ratePlanType' => $type,
		'isAvailableOnly' => 'true',
		'isAltHotelsReq' => 'false'
		);
	$token = $this->getToken();
	try {
		$response = \Drupal::httpClient()->get( $url , [
			'query' => $query,
			'headers' => [
				'authorization' => 'Bearer '.$token,
				'accept'	=> 'application/json',
			],
		]);
			// This is the Part I don't understand.
		if ($response->getStatusCode() == 200) {
			$data = $response->getBody()->getContents();
			if (empty($data)) {
				return FALSE;
			}
		}
		elseif($response->getStatusCode() == 403) {
			$data = $response->getBody()->getContents();
			if (empty($data)) {
				return FALSE;
			}
		}
		elseif($response->getStatusCode() == 500) {
			$data = $response->getBody()->getContents();
			if (empty($data)) {
				return FALSE;
			}
		}
		else{
			$data = "Something went wrong!!!";
		}
	}
	catch (RequestException $e) {
		watchdog_exception('travelclick', $e);
	}
	return json_decode($data);

}
public function selectRate(){
	// Session Request
	$session_val = \Drupal::request()->getSession();
	//Session
	$sessionController = new TravelclickBookingController();
	$session_details= $sessionController->sessiondetails();

	//TODO:: request search results from controller module
    $query = \Drupal::request()->query->all();
    $room =  substr($session_details->get('room'), 0,1); 
	$guest =  (int) filter_var($session_details->get('guests'), FILTER_SANITIZE_NUMBER_INT);
	$checkindate = date('Y-m-d', strtotime($session_details->get('checkin_date')));
	$checkoutdate = date('Y-m-d', strtotime($session_details->get('checkout_date')));
	$items = array();
	$tagetID =$session_details->get('tid_val');
	$hotelCode = $session_details->get('hotel_code'); //get hotel code from Destination form entry
	$roomTypeCode = $session_details->get('roomdetails')[1]; //TODO:: get roomTypeCode from session
	$flag = $session_val->get('clicked');
	$leadrates = array();
	$ratePlans = array();
	$dealleadrates = array();
	$packageTypes = array();
	$roomName = '';
	$number_of_guest = '';
	$room_image_target_path = '';
	// Query to get entity ID of bundle room details
	$room_node_id = db_select('node__field_room_type_code', 'rtc')
	->fields('rtc', array('entity_id'))
	->condition('bundle', 'room_details')
	->condition('field_room_type_code_value', $roomTypeCode, '=') //TODO: get roomtypecode from session
	->execute()->fetchField();
	if(isset($room_node_id)){
		$room_detail = Node::load($room_node_id);
		/*$field_listing_page_title = $room_detail->get('field_listing_page_title')->getString();
		$field_listing_page_subtitle = $room_detail->get('field_listing_page_subtitle')->getString();
		$roomName = $field_listing_page_title.' at '. $field_listing_page_subtitle; // Room Name as Title*/
		$roomName = $session_details->get('roomdetails')[0]; // Room Name as Title
		$field_room_details_guest_capacity = $room_detail->get('field_room_details_guest_capacit')->getString(); // Number of guest capacity
		$field_room_detail_capacity_text = $room_detail->get('field_room_detail_capacity_text')->getString(); // Text of guest
		$number_of_guest = $field_room_details_guest_capacity.' '.$field_room_detail_capacity_text;
		// Room Image
		$field_listing_page_image = $room_detail->get('field_listing_page_image')->getValue();
		$imagefileTargetId = $field_listing_page_image[0]['target_id'];
		$room_image = new TravelclickBookingController();	
		$room_image_target_path= $room_image->Imageurl($imagefileTargetId);  // Room Image path
	}

	// Room
	$bookingController = new TravelclickBookingController();
	$getheader1details = $bookingController->getheader1Details($tagetID);
	$getheader2details = $bookingController->getheader2Details();
	
	//$booking = $bookingController->selectrateplan($hotelCode,$roomTypeCode,'2019-10-14','2019-10-17',$room,$guest);
	//trigger exception in a "try" block
	try {
		$booking = $bookingController->selectrateplan($hotelCode, $roomTypeCode, $checkindate, $checkoutdate, $room, $guest);
	}
	//catch exception
	catch(Exception $e) {
		watchdog_exception('travelclick not responded', $e);
	}
	if( isset($booking) ) {
		// Standard Rate Plan - To get minimum rate
		$ratePlans = $booking->roomStays[0]->ratePlans;
		$minRatePlan = 0;
		if(!empty($ratePlans)){
			foreach($ratePlans as $rateplan){
				$leadrates[] = $rateplan->leadRate;
			}
			$leadrates = array_unique($leadrates);
			$minRatePlan = min($leadrates); // Minimum Rate
		}
		// Deal & Packages Plan - To get minimum rate
		$packageTypes = $booking->roomStays[0]->packageTypes;
		$minDealPlan = 0;
		if(!empty($packageTypes)){
			foreach($packageTypes as $packageType){
				$dealleadrates[] = $packageType->leadRate;
			}
			$dealleadrates = array_unique($dealleadrates);
			$minDealPlan = min($dealleadrates); // Minimum Rate
		}
		$path = \Drupal::request()->getSchemeAndHttpHost().base_path(); // Base URL Path
		// Get the amount case rewards - Standard Plan
		$datewiserate = array();
		$todalratedatewise = 0;
		$awardRates = array();
		$nightlyRates = $booking->roomStays[0]->roomTypes[0]->nightlyRates;
		if(!empty($ratePlans)){
			foreach($ratePlans as $rate){
				$plancode = $rate->ratePlanCode;
				if($rate->ratePlanType == 'Regular'){
					foreach($nightlyRates as $night){
						$nightplancode = $night->ratePlanCode;
						if($nightplancode === $plancode){
							$datewiserate[$night->date] = $night->amtTotal;
							$todalratedatewise = array_sum($datewiserate);
							$totalrateafterper = ($todalratedatewise * 15)/100;
							$totalrateafterper = round($totalrateafterper); // Round figure rate
						}
					}
				}
				$awardRates[$plancode] = $totalrateafterper;
			}
		}

		// Items identify
		$items = array('booking'=>$booking, 'header1' => $getheader1details, 'header2' => $getheader2details, 'sessionDetails' => $session_details, 'standardMinRate' => $minRatePlan, 'dealMinRate' => $minDealPlan, 'path' => $path, 'room_image_target_path' => $room_image_target_path, 'roomName' => $roomName, 'number_of_guest' => $number_of_guest, 'roomCount' => $room, 'awardRates' => $awardRates, 'flag' => $flag);
		//print '<pre>';print_r($session_details);die;
    } else {
		$items = array('Error'=>'No search parameters set', 'q'=>$query);
	}
	//print '<pre>';print_r($items);die;
    return array(
      '#items' => $items,
      '#theme' => 'select_rate',
    );
  }
    Public function sessiondetails(){

		$session_val = \Drupal::request()->getSession();

		$tid =db_select('taxonomy_term_field_data', 'f')
										->fields('f', array('tid'))
										->condition('vid', 'destinations')
										->condition('name', $session_val->get('booking_destination'))
										->execute()
										->fetchField();
		$hotel_code = db_select('taxonomy_term__field_resort_id', 'f')
												->fields('f', array('field_resort_id_value'))
												->condition('bundle', 'destinations')
												->condition('entity_id', $tid)
												->execute()
												->fetchField();	
	#											->fetchField();	
		$guest_details = [
							'guest_first_name'=>'Steve',
							'guest_last_name'=>'Stevenson',
							'guest_email'=>'steve.stevenson@gmail.com',
							'guest_phone_no'=>'619.111-1111',
							'payment'=>[
											'card_type'=>'visa',
											'card_no'=>'8066',
											'card_exp'=>'12/2022',
											'total_charge'=>'$200.00 USD'
										]
						];
		$booking_details = [
					'resort_name'=>'Sirena Del Mar',
					//'check_in'=> date("D,M d Y", strtotime('2019-11-25')),
					//'check_out'=> date("D,M d Y", strtotime('2019-11-27')),
					//'no_room'=>'2',
					//'no_adult'=>'4',
					'Guestbook'=>'1',
					'vacation_guard'=>'1',
					'itenary_ID'=>'12345678',
					'check_in'=>date("D,M d Y", strtotime($session_val->get('checkin_date'))),
					'check_out'=>date("D,M d Y", strtotime($session_val->get('checkout_date'))),
					'no_room'=>$session_val->get('room'),
					'no_adult'=>$session_val->get('guests'),
					
				];
		$room_code_rate_code = [
					[
						'roomcode' => 425039,
						'roomname'=> 'this is demo',
						'roomplan_code' => 2143631,
						'roomrate'=> 220.10,
						'room_CID'=> 472316283,
						'isModifable'=>1
					
					],
					[
						'roomcode' => 425041,
						'roomname'=> 'this is demo',
						'roomplan_code' => 7865437,
						'roomrate'=> 312,
						'room_CID'=> 472316284,
						'isModifable'=>0
						
					],
				];
				
		$session_val->set('tid_val', $tid);	
		$session_val->set('hotel_code', $hotel_code);
		$session_val->set('guestdetails', $guest_details);
		$session_val->set('room_code_rate_code', $room_code_rate_code);
		$session_val->set('booking_details', $booking_details);
		$session_set_value = array('booking_destination' => $session_val->get('booking_destination'), 'booking_rooms_guests' => $session_val->get('booking_rooms_guests'), 'booking_dates' => $session_val->get('booking_dates'),'checkin_date' => $session_val->get('checkin_date'),'checkout_date' => $session_val->get('checkout_date'),'room' => $session_val->get('room'),'guests' => $session_val->get('guests'),'tid_val' => $session_val->get('tid_val'),'hotel_code' => $session_val->get('hotel_code'));

		return $session_val;
	}
	Public function Imageurl( $fid ){
		$target_id = $fid;//The file ID   
		$file = \Drupal\file\Entity\File::load($target_id);
		$path = $file->getFileUri();
		
		return $path;
	}
  
	Public function selectroom(){
		
		$query = \Drupal::request()->query->all();
		
		//$room = 1; //substr($roomguest[0], 0,1); //only do one room for testing purposes so we dont have to use multi-room api
		//$guest = 2;
		$sessionController = new TravelclickBookingController();
		$session_details= $sessionController->sessiondetails();
		$room =  substr($session_details->get('room'), 0,1); 
		//$guest = substr($session_details->get('guests'), 0,1);
		$guest_details=$session_details->get('guests');
		$guest=trim(str_replace('Guests', '', $guest_details));
		$checkindate = date('Y-m-d', strtotime($session_details->get('checkin_date')));
		$checkoutdate = date('Y-m-d', strtotime($session_details->get('checkout_date')));
		$discountcode=$session_details->get('promo_code');
		$tagetID =$session_details->get('tid_val');
		$hotelCode = $session_details->get('hotel_code');
		
		$headerController = new TravelclickBookingController();
		$header_block_val = $headerController->getheader2Details();
		$header_query_val= $headerController->getheader1Details($tagetID);
		$bookingController = new TravelclickBookingController();
		try {
			if(isset($room) && isset($guest) && isset($checkindate) && isset($checkoutdate) && isset($tagetID) && isset($hotelCode) && isset($discountcode)){
				$booking = $bookingController->searchAvailability($hotelCode,$checkindate,$checkoutdate,$room,$guest,$discountcode);
				
			}
			else if(isset($room) && isset($guest) && isset($checkindate) && isset($checkoutdate) && isset($tagetID) && isset($hotelCode)){
				$booking = $bookingController->searchAvailability($hotelCode,$checkindate,$checkoutdate,$room,$guest);
				
			}
		}
			//catch exception
		catch(Exception $e) {
			watchdog_exception('travelclick not responded', $e);
		}
		//$booking ="test";
		if( isset($booking) ) {
			$items = array('booking'=>$booking,'header_query_val'=>$header_query_val,'header_block_val'=>$header_block_val,'session_details'=>$session_details);
		} else {
			$items = array('Error'=>'No search parameters set', 'q'=>$query);
               }
		return array(
		  '#items' => $items,
		  '#theme' => 'select_room',
		);
							  
	}

	public function getheader1Details($tagetID = NULL){

		$header_1_details = array();
		$ratePageTitle = '';
		$overviewRate = '';
		$depositPolicy = '';
		$cancelPolicy = '';
		
		$results_room_details = db_select('node__field_destination','fd')
										->fields('fd', array('entity_id'))
										->condition('bundle', 'resort_destinations')
										->condition('field_destination_target_id', $tagetID, '=')
										->execute()->fetchAll(); 
		
		if(isset($results_room_details) && !empty($results_room_details)) {	
			$results_room_details_array= (array)$results_room_details[0];
			$nid= $results_room_details_array['entity_id'];
			//print $nid; die('ddd');
			if(isset($nid)){
				$address_val = db_select('node__field_description_address', 'f')
										->fields('f', array('field_description_address_value'))
										->condition('bundle', 'resort_destinations')
										->condition('entity_id', $nid)
										->execute()
										->fetchField();
				$resort_name = db_select('node__field_logo_image', 'f')
										->fields('f', array('field_logo_image_alt'))
										->condition('bundle', 'resort_destinations')
										->condition('entity_id', $nid)
										->execute()
										->fetchField();
								/*Resort Logo*/
				$resort_logo_tid = db_select('node__field_logo_image', 'f')
										->fields('f', array('field_logo_image_target_id'))
										->condition('bundle', 'resort_destinations')
										->condition('entity_id', $nid)
										->execute()
										->fetchField();

				
				/*Resort_tripadvisor_image*/
				
				$resort_tripadvisor_logo_tid = db_select('node__field_tripadvisor_image', 'f')
										->fields('f', array('field_tripadvisor_image_target_id'))
										->condition('bundle', 'resort_destinations')
										->condition('entity_id', $nid)
										->execute()
										->fetchField();
				$contact_tid = db_select('node__field_contact_number', 'f')
										->fields('f', array('field_contact_number_target_id'))
										->condition('bundle', 'resort_destinations')
										->condition('entity_id', $nid)
										->execute()
										->fetchField();
				$contact_no = db_select('taxonomy_term__field_contact_number', 'f')
										->fields('f', array('field_contact_number_value'))
										->condition('bundle', 'resort_contact_number')
										->condition('entity_id', $contact_tid)
										->execute()
										->fetchField();
				$resortController_image = new TravelclickBookingController();	
				$resort_logo= $resortController_image->Imageurl($resort_logo_tid);
				$resort_tripadvisor_logo = $resortController_image->Imageurl($resort_tripadvisor_logo_tid);
				
				$header_1_details = array('h1_address' => $address_val, 'h1_resortname' => $resort_name, 'h1_contact' => $contact_no,'resort_logo' => $resort_logo,'resort_tripadvisor_image' => $resort_tripadvisor_logo);
				return $header_1_details;
			}
		}
	}
	public function getheader2Details(){
		$header_2_details = array();
		$block = \Drupal\block\Entity\Block::load('centralcontactnumber');
		$uuid = $block->getPlugin()->getDerivativeId();
		$block_content = \Drupal::service('entity.repository')->loadEntityByUuid('block_content', $uuid);
		if ($block_content) {
			$field_value = $block_content->field_c->value;
			$central_number = $field_value;
		}
			
		$booking_block = \Drupal\block\Entity\Block::load('reservationbooking');
		$booking_uuid = $booking_block->getPlugin()->getDerivativeId();
		
		$booking_block_content = \Drupal::service('entity.repository')->loadEntityByUuid('block_content', $booking_uuid);
		if ($booking_block_content) {
			$booking_logo_image_target_id =$booking_block_content->field_header_logo_image->target_id;
			if(isset($booking_logo_image_target_id)){
				$bookingController_image = new TravelclickBookingController();	
				$booking_logo_image_target_path= $bookingController_image->Imageurl($booking_logo_image_target_id);
			}
			$booking_tripadvisor_logo_target_id =$booking_block_content->field_tripadvisor_logo->target_id;
			if(isset($booking_tripadvisor_logo_target_id)){
				$bookingController_trip = new TravelclickBookingController();
				$booking_tripadvisor_logo_target_path= $bookingController_trip->Imageurl($booking_tripadvisor_logo_target_id);
			}
			$footer_link =$booking_block_content->field_footer_link->uri;
			$footer_title =$booking_block_content->field_footer_link->title;
			$header_link=$booking_block_content->field_header_sign_in_link->uri;
			$header_title=$booking_block_content->field_header_sign_in_link->title;
			// Rate Page details
			$ratePageTitle = $booking_block_content->field_rate_heading->value;
		}
		
		$header_2_details = array('cNumber' => $central_number, 'bookingLogo' => $booking_logo_image_target_path, 'tripadvisorLogo' => $booking_tripadvisor_logo_target_path, 'footerLink' => $footer_link, 'footerTitle' => $footer_title, 'headerLink' => $header_link, 'headerTitle' => $header_title, 'ratePageTitle' => $ratePageTitle);
		return 	$header_2_details;
	}
	public function rateDetail(){
		//Session
		$sessionController = new TravelclickBookingController();
		$session_details= $sessionController->sessiondetails();

		//TODO:: request search results from controller module
		$query = \Drupal::request()->query->all();
		$room =  substr($session_details->get('room'), 0,1); 
		$guest =  (int) filter_var($session_details->get('guests'), FILTER_SANITIZE_NUMBER_INT);
		$checkindate = date('Y-m-d', strtotime($session_details->get('checkin_date')));
		$checkoutdate = date('Y-m-d', strtotime($session_details->get('checkout_date')));
		$roomCounter = $session_details->get('no_of_roomcount');
		$items = array();
		$tagetID =$session_details->get('tid_val');
		$hotelCode = $session_details->get('hotel_code'); //get hotel code from Destination form entry
		// Get the number of nights between checkin and checkout date
		$start_ts = strtotime($checkindate); 
		$end_ts = strtotime($checkoutdate); 
		$diff = $end_ts - $start_ts; 
		$numberOfNights = round($diff / 86400); // this calculates the diff between two dates, which is the number of nights
		// Get Resort Fee message
		$booking_block = \Drupal\block\Entity\Block::load('reservationbooking');
		$booking_uuid = $booking_block->getPlugin()->getDerivativeId();
		$booking_block_content = \Drupal::service('entity.repository')->loadEntityByUuid('block_content', $booking_uuid);
		$fee_message = $booking_block_content->field_resort_fee_standard_rates->value;
		// Get default Resort fee per day
		$fee_per_day = $booking_block_content->field_resort_fee->value;
		$perNightResortFees = $numberOfNights * $fee_per_day;
		// Get rateplan code from URL parameter
		$codePlan = \Drupal::request()->query->get('code'); // Rateplancode
		if(isset($codePlan)){
			$bookingController = new TravelclickBookingController();
			$roomTypeCode = $session_details->get('roomdetails')[1]; //TODO:: get roomTypeCode from session
			//$ratedetails = $bookingController->selectrateplan($hotelCode, $roomTypeCode, $checkindate, $checkoutdate, $room, $guest, $codePlan);
			//print 'HC'.$hotelCode.'RTC'.$roomTypeCode.'ci'.$checkindate.'co'.$checkoutdate.'room'.$room.'guest'.$guest.'cp'.$codePlan;die;
			//print '<pre>';
			//print_r($ratedetails);die;

			try {
				$ratedetails = $bookingController->selectrateplan($hotelCode, $roomTypeCode, $checkindate, $checkoutdate, $room, $guest, $codePlan);
			}
			//catch exception
			catch(Exception $e) {
				watchdog_exception('travelclick not responded', $e);
			}
			if( isset($ratedetails) ) {
				$rateitems = array('ratedetails'=>$ratedetails);
				// Rate Heading
				$ratePlanName = $rateitems['ratedetails']->roomStays[0]->ratePlans[0]->ratePlanName;
				// Rate Plan Type
				$ratePlanType= $rateitems['ratedetails']->roomStays[0]->ratePlans[0]->ratePlanType;
				// Rate Overview
				$rateOverview = $rateitems['ratedetails']->roomStays[0]->ratePlans[0]->ratePlanDescription;
				// Deposit Policy
				$guaranteePolicy = $rateitems['ratedetails']->roomStays[0]->ratePlans[0]->guaranteePolicy->policyType;
				if($guaranteePolicy == 'Deposit'){
					$depositPolicy = $rateitems['ratedetails']->roomStays[0]->ratePlans[0]->guaranteePolicy->policyDescription;
				}
				// Cancellation Policy
				$cancellationPolicy = $rateitems['ratedetails']->roomStays[0]->ratePlans[0]->cancellationPolicy->policyDescription;
				// Nightly Rates
				$nightlyRates = $rateitems['ratedetails']->roomStays[0]->roomTypes[0]->nightlyRates;
				$signlerate = 0;
				if(!empty($nightlyRates)){
					foreach($nightlyRates as $nightrate){
						$signlerate = $nightrate->amtTotal + $signlerate;
					}
				}
				// Total Amount
				$total = $signlerate + $perNightResortFees;
			} else {
				$rateitems = array('Error'=>'No search parameters set', 'q'=>$query);
			}
		}	
		//$rateCode = $rateitems['ratedetails']->roomStays[0]->ratePlans[0]->ratePlanCode;
		$theme_path = drupal_get_path('theme', 'welkresorts');
		$html ='';
		$html .= '<div class="modal fade" id="changeRoom" tabindex="-1" role="dialog" aria-labelledby="bookingRoom" aria-hidden="true">
		<div class="modal-dialog modal-lg " role="document">
		   <div class="modal-content">
		   <div class="modal-header d-block container">
		<h2 class="modal-title  text-center" id="exampleModalLongTitle">'.$ratePlanName.'</h2>
		<a class="close" data-dismiss="modal" aria-label="Close">
		   <span aria-hidden="true">&times;</span>
		</a>
	 </div>
	 <div class="modal-body container">
		<!--tabs - photo & 3d tour -->
		<div class="row">
		<div class="col-12 col-lg-6 col-xl-6">';
		$html .= '<div class="rates-overview"><h4>Rate Overview</h4><p>'
			  .$rateOverview.
			  '</p></div>';
		$html .='<div class="rates-overview"><h4>Deposit Policy</h4><p>'
			  .$depositPolicy.'</p></div>';
		$html .='<div class="rates-overview"><h4>Cancellation Policy</h4><p>'
				.$cancellationPolicy.
				'</p></div></div>';
		$html .='<div class="col-12 col-lg-6 col-xl-6">
			  <h4 class="text-center mb-4">Price Breakdown</h4>
			  <table class="table text-right price-table-breakdown">
				 <thead>
					<tr>
					   <th>&nbsp;</th>
					   <th><strong>1 Room(s) for '.$numberOfNights.' Night(s)</strong></th>
					   <th><strong>Prices in USD</strong></th>
					</tr>
				 </thead>
				 <tbody>';
		if(!empty($nightlyRates)){
			foreach($nightlyRates as $nightlyRate){
				$date = $nightlyRate->date;
				$amtTotal = $nightlyRate->amtTotal;
				$timestamp = strtotime($date);
				$format = date('D, M d Y',$timestamp); // 'D, M d Y' Example :- Wed, Oct 09 2019 
		$html .= '<tr>
				   <td>&nbsp;</td>
				   <td>'.$format.'</td>
				   <td>$'.$amtTotal.'</td>
				</tr>';
			}
		}

		$html .=	'<tr>
					   <td>&nbsp;</td>
					   <td><span class="best-rates" data-toggle="tooltip" data-placement="right" title="" data-original-title="'.strip_tags($fee_message).'">Resort Fees <img src="'.$theme_path.'/dest/images/info-icon-grey.svg" /></span></td>
					   <td>$'.$perNightResortFees.'</td>
					</tr>
					<tr>
					   <td>&nbsp;</td>
					   <td><strong>Total</strong></td>
					   <td><strong>$'.$total.'</strong></td>
					</tr>
				 </tbody>
			  </table>
		   </div>
		</div>
		<!--tabs - photo & 3d tour -->
	 </div>';
	$html .= '<div class="modal-footer container">
				<a title="Select Room" class="btn btn-primary medium selectrate" href="#" rateplancode = '.$codePlan.' rateplantype = "'.$ratePlanType.'" rateplanname = "'.$ratePlanName.'" totalRoomCount="'.$room.'" roomCounter="'.$roomCounter.'">Select Rate</a>
				<a class="btn btn-secondary medium" data-dismiss="modal">Close</a>
	 		</div>
	 	</div>
	 </div>
  </div>';

		//print '<pre>';print_r($items);die;
		$build[] = array(
			'#type' => 'markup',
			'#markup' => $html,
		);
		//The Ajax call. This will render only the TWIG template.
		return new Response(render($build));
	}
	public function dealPackage(){
		//Session
		$sessionController = new TravelclickBookingController();
		$session_details= $sessionController->sessiondetails();

		//TODO:: request search results from controller module
		$query = \Drupal::request()->query->all();
		$room =  substr($session_details->get('room'), 0,1); 
		$guest =  (int) filter_var($session_details->get('guests'), FILTER_SANITIZE_NUMBER_INT);
		$checkindate = date('Y-m-d', strtotime($session_details->get('checkin_date')));
		$checkoutdate = date('Y-m-d', strtotime($session_details->get('checkout_date')));
		$roomCounter = $session_details->get('no_of_roomcount');
		$items = array();
		$tagetID =$session_details->get('tid_val');
		$hotelCode = $session_details->get('hotel_code'); //get hotel code from Destination form entry
		// Get the number of nights between checkin and checkout date
		$start_ts = strtotime($checkindate); 
		$end_ts = strtotime($checkoutdate); 
		$diff = $end_ts - $start_ts; 
		$numberOfNights = round($diff / 86400); // this calculates the diff between two dates, which is the number of nights
		// Get Resort Fee message
		$booking_block = \Drupal\block\Entity\Block::load('reservationbooking');
		$booking_uuid = $booking_block->getPlugin()->getDerivativeId();
		$booking_block_content = \Drupal::service('entity.repository')->loadEntityByUuid('block_content', $booking_uuid);
		$fee_message = $booking_block_content->field_resort_fee_deal_packages->value;
		// Get default Resort fee per day
		$fee_per_day = $booking_block_content->field_resort_fee->value;
		$perNightResortFees = $numberOfNights * $fee_per_day;
		// Get rateplan code from URL parameter
		$dealPackageCode = \Drupal::request()->query->get('code'); // Rateplancode
		$dealType = 'Package';
		if(isset($dealPackageCode)){
			$bookingController = new TravelclickBookingController();
			$roomTypeCode = $session_details->get('roomdetails')[1]; //TODO:: get roomTypeCode from session
			//$ratedetails = $bookingController->selectrateplan($hotelCode, $roomTypeCode, $checkindate, $checkoutdate, $room, $guest, $dealPackageCode);
			//print 'HC'.$hotelCode.'RTC'.$roomTypeCode.'ci'.$checkindate.'co'.$checkoutdate.'room'.$room.'guest'.$guest.'cp'.$dealPackageCode;die;
			//print '<pre>';
			//print_r($ratedetails);die;

			try {
				$dealpackages = $bookingController->selectrateplan($hotelCode, $roomTypeCode, $checkindate, $checkoutdate, $room, $guest, $dealPackageCode,$dealType);
			}
			//catch exception
			catch(Exception $e) {
				watchdog_exception('travelclick not responded', $e);
			}
			if( isset($dealpackages) ) {
				//print '<pre>'; print_r($dealpackages);die;
				$dealitems = array('dealpackages'=>$dealpackages);
				// Rate Heading
				$ratePlanName = $dealitems['dealpackages']->roomStays[0]->ratePlans[0]->ratePlanName;
				// Rate Overview
				$rateOverview = $dealitems['dealpackages']->roomStays[0]->ratePlans[0]->ratePlanDescription;
				// Deposit Policy
				$guaranteePolicy = $dealitems['dealpackages']->roomStays[0]->ratePlans[0]->guaranteePolicy->policyType;
				if($guaranteePolicy == 'Deposit'){
					$depositPolicy = $dealitems['dealpackages']->roomStays[0]->ratePlans[0]->guaranteePolicy->policyDescription;
				}
				// Cancellation Policy
				$cancellationPolicy = $dealitems['dealpackages']->roomStays[0]->ratePlans[0]->cancellationPolicy->policyDescription;
				// Nightly Rates
				$nightlyRates = $dealitems['dealpackages']->roomStays[0]->roomTypes[0]->nightlyRates;
				$signlerate = 0;
				if(!empty($nightlyRates)){
					foreach($nightlyRates as $nightrate){
						$signlerate = $nightrate->amtTotal + $signlerate;
					}
				}
				// Total Amount
				$total = $signlerate + $perNightResortFees;
			} else {
				$rateitems = array('Error'=>'No search parameters set', 'q'=>$query);
			}
		}	
		//$rateCode = $rateitems['ratedetails']->roomStays[0]->ratePlans[0]->ratePlanCode;
		$theme_path = drupal_get_path('theme', 'welkresorts');
		$html ='';
		$html .= '<div class="modal fade" id="changeRoom1" tabindex="-1" role="dialog" aria-labelledby="bookingRoom" aria-hidden="true">
		<div class="modal-dialog modal-lg " role="document">
		<div class="modal-content">
		<div class="modal-header d-block container">
		<h2 class="modal-title  text-center" id="exampleModalLongTitle">'.$ratePlanName.'</h2>
		<a class="close" data-dismiss="modal" aria-label="Close">
		   <span aria-hidden="true"></span>
		</a>
	 </div>
	 <div class="modal-body container">
		<!--tabs - photo & 3d tour -->
		<div class="row">
		<div class="col-12 col-lg-6 col-xl-6">';
		$html .= '<div class="deals-overview"><h4>Rate Overview</h4><p>'
			  .$rateOverview.
			  '</p>';
		$html .='<h4>Deposit Policy</h4><p>'
			  .$depositPolicy.'</p>';
		$html .='<h4>Cancellation Policy</h4><p>'
		.$cancellationPolicy.
		'</p> </div></div>';
		$html .='<div class="col-12 col-lg-6 col-xl-6">
			  <h4 class="text-center mb-4">Price Breakdown</h4>
			  <table class="table text-right price-table-breakdown">
				 <thead>
					<tr>
					   <th>&nbsp;</th>
					   <th><strong>1 Room(s) for '.$numberOfNights.' Night(s)</strong></th>
					   <th><strong>Prices in USD</strong></th>
					</tr>
				 </thead>
				 <tbody>';
		if(!empty($nightlyRates)){
			foreach($nightlyRates as $nightlyRate){
				$date = $nightlyRate->date;
				$amtTotal = $nightlyRate->amtTotal;
				$timestamp = strtotime($date);
				$format = date('D, M d Y',$timestamp); // 'D, M d Y' Example :- Wed, Oct 09 2019 
		$html .= '<tr>
				   <td>&nbsp;</td>
				   <td>'.$format.'</td>
				   <td>$'.$amtTotal.'</td>
				</tr>';
			}
		}

		$html .=	'<tr>
					   <td>&nbsp;</td>
					   <td><span class="best-rates" data-toggle="tooltip" data-placement="right" title="" data-original-title="'.strip_tags($fee_message).'">Resort Fees <img src="'.$theme_path.'/dest/images/info-icon-grey.svg" /></span></td>
					   <td>$'.$perNightResortFees.'</td>
					</tr>
					<tr>
					   <td>&nbsp;</td>
					   <td><strong>Total</strong></td>
					   <td><strong>$'.$total.'</strong></td>
					</tr>
				 </tbody>
			  </table>
		   </div>
		</div>
		<!--tabs - photo & 3d tour -->
	 </div>
	 <div class="modal-footer container">
	 	<a title="Select Room" class="btn btn-primary medium selectdeal" href="#" rateplancode = '.$dealPackageCode.' rateplantype = "'.$dealType.'" rateplanname = "'.$ratePlanName.'" totalRoomCount="'.$room.'" roomCounter="'.$roomCounter.'">Select Rate</a>
		 <a class="btn btn-secondary medium" data-dismiss="modal">Close</a>			
		
	 </div> 
	 </div>
	 </div></div>';

		//print '<pre>';print_r($items);die;
		$build[] = array(
			'#type' => 'markup',
			'#markup' => $html,
		);
		//The Ajax call. This will render only the TWIG template.
		return new Response(render($build));
	}
	public function rateRedirect(){
		// Session Request
		$session_val = \Drupal::request()->getSession();
		//Session
		$sessionController = new TravelclickBookingController();
		$session_details= $sessionController->sessiondetails();

		// Session variables
		$rateplandata = array();
		$ratePlanCode = \Drupal::request()->query->get('code'); // Rate Plan code
		$ratePlanType = \Drupal::request()->query->get('rtype'); // Rate Plan Type
		$ratePlanname = \Drupal::request()->query->get('rname'); // Rate Plan Name
		$roomcount = \Drupal::request()->query->get('rcount'); // Room Count
		//$roomcount = $roomcount-1;
		$checkindate = date('Y-m-d', strtotime($session_details->get('checkin_date'))); // CheckIn date
		$checkoutdate = date('Y-m-d', strtotime($session_details->get('checkout_date'))); // Checkout date
    	$room =  substr($session_details->get('room'), 0,1); // room count
		$guestCount = (int) filter_var($session_details->get('guests'), FILTER_SANITIZE_NUMBER_INT); // guest count
		
		// Get list of dates between checkin and checkout dates
		$date_from = strtotime($checkindate); // Convert date to a UNIX timestamp  
		$date_to = strtotime($checkoutdate); // Convert date to a UNIX timestamp  
		$betweenDates = array();
		
		// Loop from the start date to end date and output all dates in between  
		for ($i=$date_from; $i<=$date_to; $i+=86400) {  
			$betweenDates[] = date("Y-m-d", $i);  
		}
		$hotelCode = $session_details->get('hotel_code'); //get hotel code from Destination form entry
		$roomTypeCode = $session_details->get('roomdetails')[1]; //TODO:: get roomTypeCode from session
		$roomTypeName = $session_details->get('roomdetails')[0]; // @TODO get roomTypeName from session

		// Get Policy descriptions from /avail API for insert into tables
		if(isset($ratePlanCode)){
			$bookingController = new TravelclickBookingController();
			try {
				$ratedetails = $bookingController->selectrateplan($hotelCode, $roomTypeCode, $checkindate, $checkoutdate, $room, $guestCount, $ratePlanCode);
			}
			//catch exception
			catch(Exception $e) {
				watchdog_exception('travelclick avail api is not responded', $e);
			}
			if( isset($ratedetails) ) {
				$rateitems = array('ratedetails'=>$ratedetails);
				// Rate Overview
				$rateOverview = $rateitems['ratedetails']->roomStays[0]->ratePlans[0]->ratePlanDescription;
				$currencyCode = $ratedetails->currencyCode;
			}
		}
		// Get response from session on next visit in ratepage from room page while multibooking
		$getResponseSession = $session_details->get('multiresponse'); //get hotel code from Destination form entry
		$getresponse = $getResponseSession['getresponse'];
		$getResponseSessionInJson = json_encode($getresponse, true);
		$requestString = substr($getResponseSessionInJson, 1, -1); // Remove square brackets
		//echo json_last_error_msg();
		$getItinirary = $getResponseSession['itinerary_id'];

		// Hold Reservation API call
		$api_base = $this->api_base;
		$url = $api_base.'book/v1/hotel/'.$hotelCode.'/hold-reservation/multi-room';
		$effectiveDate = array();
		$holdbody = '';
		$holdbody .= '{
			"hotelCode": '.$hotelCode.', 
			"languageCode": "EN_US",';
		if(isset($getItinirary) && $getItinirary !=''){
			$holdbody .= '"itineraryId": '.$getItinirary.',';
		}
		$holdbody .='"reservationRequestParams": [
				{
					"hotelCode": '.$hotelCode.', 
					"languageCode": "EN_US", 
					"currency": "USD", 
					"posSource": {
						"requestorIds": [ ], 
						"companyName": {
							"companyShortName": "Web4_Desktop", 
							"code": ""
						}
					}, 
					"resGlobalInfo": {
						"timeSpan": {
							"start": "'.$checkindate.'", 
							"end": "'.$checkoutdate.'"
						}, 
						"guestCounts": [
							{
								"ageQualifyingCode": "10", 
								"count": '.$guestCount.'
							}, 
							{
								"ageQualifyingCode": "8", 
								"count": 0
							}, 
							{
								"ageQualifyingCode": "7", 
								"count": 0
							}
						], 
						"rooms": 1
					}, 
					"roomStays": [
						{
							"ratePlans": [
								{
									"ratePlanCode": "'.$ratePlanCode.'", 
									"ratePlanType": "'.$ratePlanType.'"
								}
							], 
							"roomRates": [
								{
									"numberOfUnits": 1, 
									"roomTypeCode": "'.$roomTypeCode.'"
								}
							]
						}
					], 
					"advertisementId": null, 
					"promotionId": null, 
					"countryCode": null, 
					"secondarySubChannel": "Web4_Desktop", 
					"id": 0, 
					"selected": true, 
					"roomData": {
						"adults": '.$guestCount.', 
						"children": 0, 
						"infants": 0, 
						"noOfNights": 0
					}, 
					"services": [ ], 
					"total": {
						"amountBeforeTax": null, 
						"amountAfterTax": null
					}, 
					"roomRates": [
						{
							"roomTypeCode": "'.$roomTypeCode.'", 
							"roomTypeName": "'.$roomTypeName.'", 
							"numberOfUnits": 1, 
							"rates": [';
			foreach($betweenDates as $getdate){
				$effectiveDate[] = '{
					"effectiveDate": "'.$getdate.'", 
					"unitMultiplier": 1, 
					"base": { }
				}';
			}
			$holdbody .= implode( ', ', $effectiveDate );
			$holdbody .=	']
						}
					]
				}';
	if(isset($getresponse) && !empty($getresponse)){
		$holdbody .= ','.$requestString;
	}
	$holdbody .=	']
		}';
	//print $holdbody;die;
		$token = $this->getToken();	
		try {
			$response = \Drupal::httpClient()->post( $url , [
				'body' =>$holdbody,
				'headers' => [
					'Authorization' => 'Bearer '.$token,
					'Content-Type' => 'application/json',
				],
			]);
			$data = $response->getBody()->getContents();
			if (empty($data)) {
				return FALSE;
			}
		}
		catch (GuzzleException $error) {
			//if ($error->hasResponse()) {
				// Get the original response
				$data = $error->getResponse();
				// Get the info returned from the remote server.
				$response_info = $data->getBody()->getContents();
				// Using FormattableMarkup allows for the use of <pre/> tags, giving a more readable log item.
				$message = new FormattableMarkup('TravelClick API error. Error details are as follows:<pre>@response</pre>', ['@response' => print_r(json_decode($response_info), TRUE)]);
				// Log the error
				watchdog_exception('Remote API Connection', $error, $message);
				return new Response(render($response_info));
			//}
		  }
		  
		//Response
		$jsontoArray = (array) json_decode($data);
		$getResponseInarray = $jsontoArray['reservationResponses'];
		$languageCode = $jsontoArray['languageCode'];
		$itineraryId = $jsontoArray['itineraryId'];
		$multiresponse = array('getresponse' => $getResponseInarray, 'itinerary_id' => $itineraryId);
		$session_val->set('multiresponse', $multiresponse); // multiresponse set in session
		$session_val->set('rateplandata', $jsontoArray);
		$session_val->set('no_of_roomcount', $roomcount);
		// To make entry for itinerary tables
		if($roomcount == $room){ //Check last seclect rate
			$saving = 0;				 
			$get_client_ip = \Drupal::request()->getClientIp();  // Get IP address
			$entry = array();
			$itneryId = $jsontoArray['itineraryId'];
			$email = $get_client_ip;
			$duration = $jsontoArray['reservationResponses'][0]->resGlobalInfo->timeSpan->duration;
			$currency = $currencyCode;
			foreach($jsontoArray['reservationResponses'] as $reservationResponses){
				$saving += $reservationResponses->roomStays[0]->total->discount;
			}
			$total_savings = $saving; // @TODO: get sum of all discount
			$total_resort_fee = $jsontoArray['itineraryTotals']->itineraryResortFeeTotal;
			$total_tax = $jsontoArray['itineraryTotals']->itineraryRoomTotalTaxes;
			$total_amount_before_tax = $jsontoArray['itineraryTotals']->itineraryRoomSubTotal;
			$total_amount = $jsontoArray['itineraryTotals']->itineraryRoomGrandTotal;
			$total_amount_paid = $jsontoArray['itineraryPaymentInfo']->itineraryDepositAmt;
			$status = 'Hold';
			$guestbook_flag = 0;
			$tnc_flag = 0;
			$vacation_guard_flag = 0;
			$entry = array(
				'itneryId' => $itneryId,
				'email' => $email,
				'check_in_date' => $date_from,
				'check_out_date' => $date_to,
				'hotel_code' => $hotelCode,
				'adults' => $guestCount,
				'rooms' => $room,
				'duration' => $duration,
				'currency' => $currency,
				'total_savings' => $total_savings,															
				'total_resort_fee' => $total_resort_fee,
				'total_tax' => $total_tax,
				'total_amount_before_tax' => $total_amount_before_tax,
				'total_amount' => $total_amount,
				'total_amount_paid' => $total_amount_paid,
				'status' => $status,
				'guestbook_flag' => $guestbook_flag,
				'tnc_flag' => $tnc_flag,
				'vacation_guard_flag' => $vacation_guard_flag
			);
			//call function itinerary_details
			$itinerary_details = new TravelclickBookingController();
			$result = $itinerary_details->itinerary_details($entry);
		}
		// To make entry for Room booking details
		$room_entry = array();
		$ratesbefore = array();
		$room_booking_id = $jsontoArray['reservationResponses'][0]->uniqueId;
		$room_itinerary_id =$jsontoArray['itineraryId'];
		$room_type_code = $roomTypeCode;
		$rate_plan_code = $ratePlanCode;
		$room_type_name = $roomTypeName;
		$rate_plan_type = $ratePlanType;
		$rate_plan_name = $ratePlanname;
		$status = 'Hold';
		$room_total_resort_fee = $jsontoArray['reservationResponses'][0]->roomStays[0]->taxes->resortFee;
		$savings = $jsontoArray['reservationResponses'][0]->roomStays[0]->total->discount;
		$room_total_tax = $jsontoArray['reservationResponses'][0]->roomStays[0]->total->taxAmountTotal;
		$room_total_before_tax = $jsontoArray['reservationResponses'][0]->roomStays[0]->total->amountBeforeTax;
		$room_total = $jsontoArray['reservationResponses'][0]->roomStays[0]->total->amountAfterTax;
		$rate_overview = isset($rateOverview) ? $rateOverview : '';
		$deposit_policy = $jsontoArray['reservationResponses'][0]->policies->guaranteePolicies[0]->policyDescription;
		$cancellation_policy = $jsontoArray['reservationResponses'][0]->policies->cancellationPolicies[0]->policyDescription;
		$amountBeforeTaxes = $jsontoArray['reservationResponses'][0]->roomStays[0]->roomRates[0]->rates;
		foreach($amountBeforeTaxes as $amountBeforeTax){
			// $ratesbefore[$amountBeforeTax->effectiveDate] =  $amountBeforeTax->amountBeforeTax;
			$ratesbefore[] =  array(strtotime($amountBeforeTax->effectiveDate) => $amountBeforeTax->amountBeforeTax);
		}
		$rate_per_day = strval(json_encode($ratesbefore));
		$deadLineDate = $jsontoArray['reservationResponses'][0]->policies->cancellationPolicies[0]->cancellationPenalty[0]->deadLineDate;
		$room_cancel_deadline = strtotime($deadLineDate);
		$duration = $jsontoArray['reservationResponses'][0]->resGlobalInfo->timeSpan->duration;
		$room_entry = array(
			'room_booking_id' => $room_booking_id,
			'itinerary_id' => $room_itinerary_id,
			'room_type_code' => $room_type_code,
			'rate_plan_code' => $rate_plan_code,
			'room_type_name' => $room_type_name,
			'rate_plan_type' => $rate_plan_type,
			'rate_plan_name' => $rate_plan_name,
			'status' => $status,
			'room_total_resort_fee' => $room_total_resort_fee,
			'savings' => $savings,
			'room_total_tax' => $room_total_tax,
			'room_total_before_tax' => $room_total_before_tax,
			'room_total' => $room_total,
			'rate_overview' => $rate_overview,
			'deposit_policy' => $deposit_policy,
			'cancellation_policy' => $cancellation_policy,
			'rate_per_day' => $rate_per_day,
			'room_cancel_deadline' => $room_cancel_deadline,
			'no_rooms' => $room,
			'total_duration' => $duration				
		);
		//call function room_booking_details
		$room_booking_details = new TravelclickBookingController();
		$roomresult = $room_booking_details->room_booking_details($room_entry);

		//The Ajax call. This will render only the TWIG template.
		return new Response(render($data));
	}
	public function packageRedirect(){
		// Session Request
		$session_val = \Drupal::request()->getSession();

		//Session
		$sessionController = new TravelclickBookingController();
		$session_details= $sessionController->sessiondetails();

		// Session variables
		$rateplandata = array();
		$ratePlanCode = \Drupal::request()->query->get('code'); // Rate Plan code
		$ratePlanType = \Drupal::request()->query->get('rtype'); // Rate Plan Type
		$ratePlanname = \Drupal::request()->query->get('rname'); // Rate Plan Name
		$roomcount = \Drupal::request()->query->get('rcount'); // Room Count
		$checkindate = date('Y-m-d', strtotime($session_details->get('checkin_date'))); // CheckIn date
		$checkoutdate = date('Y-m-d', strtotime($session_details->get('checkout_date'))); // Checkout date
    	$room =  substr($session_details->get('room'), 0,1); // room count
		$guestCount = (int) filter_var($session_details->get('guests'), FILTER_SANITIZE_NUMBER_INT); // guest count
		
		// Get list of dates between checkin and checkout dates
		$date_from = strtotime($checkindate); // Convert date to a UNIX timestamp  
		$date_to = strtotime($checkoutdate); // Convert date to a UNIX timestamp  
		$betweenDates = array();
		
		// Loop from the start date to end date and output all dates in between  
		for ($i=$date_from; $i<=$date_to; $i+=86400) {  
			$betweenDates[] = date("Y-m-d", $i);  
		}
		$hotelCode = $session_details->get('hotel_code'); //get hotel code from Destination form entry
		$roomTypeCode = $session_details->get('roomdetails')[1]; //TODO:: get roomTypeCode from session
		$roomTypeName = $session_details->get('roomdetails')[0]; // @TODO get from session

		// Get Policy descriptions from /avail API for insert into tables
		if(isset($ratePlanCode)){
			$bookingController = new TravelclickBookingController();
			try {
				$ratedetails = $bookingController->selectrateplan($hotelCode, $roomTypeCode, $checkindate, $checkoutdate, $room, $guestCount, $ratePlanCode,$ratePlanType);
			}
			//catch exception
			catch(Exception $e) {
				watchdog_exception('travelclick avail api is not responded', $e);
			}
			if( isset($ratedetails) ) {
				$rateitems = array('ratedetails'=>$ratedetails);
				// Rate Overview
				$rateOverview = $rateitems['ratedetails']->roomStays[0]->ratePlans[0]->ratePlanDescription;
				$currencyCode = $ratedetails->currencyCode;
			}
		}
		// Get response from session on next visit in ratepage from room page while multibooking
		$getResponseSession = $session_details->get('multiresponse'); //get hotel code from Destination form entry
		$getresponse = $getResponseSession['getresponse'];
		$getResponseSessionInJson = json_encode($getresponse, true);
		$requestString = substr($getResponseSessionInJson, 1, -1); // Remove square brackets
		//echo json_last_error_msg();
		$getItinirary = $getResponseSession['itinerary_id'];

		// Hold Reservation API call
		$api_base = $this->api_base;
		$url = $api_base.'book/v1/hotel/'.$hotelCode.'/hold-reservation/multi-room';
		$effectiveDate = array();
		$holdbody = '';
		$holdbody .= '{
			"hotelCode": '.$hotelCode.', 
			"languageCode": "EN_US",';
		if(isset($getItinirary) && $getItinirary !=''){
			$holdbody .= '"itineraryId": '.$getItinirary.',';
		}	 
		$holdbody .='"reservationRequestParams": [
				{
					"hotelCode": '.$hotelCode.', 
					"languageCode": "EN_US", 
					"currency": "USD", 
					"posSource": {
						"requestorIds": [ ], 
						"companyName": {
							"companyShortName": "Web4_Desktop", 
							"code": ""
						}
					}, 
					"resGlobalInfo": {
						"timeSpan": {
							"start": "'.$checkindate.'", 
							"end": "'.$checkoutdate.'"
						}, 
						"guestCounts": [
							{
								"ageQualifyingCode": "10", 
								"count": '.$guestCount.'
							}, 
							{
								"ageQualifyingCode": "8", 
								"count": 0
							}, 
							{
								"ageQualifyingCode": "7", 
								"count": 0
							}
						], 
						"rooms": 1
					}, 
					"roomStays": [
						{
							"ratePlans": [
								{
									"ratePlanCode": "'.$ratePlanCode.'", 
									"ratePlanType": "'.$ratePlanType.'"
								}
							], 
							"roomRates": [
								{
									"numberOfUnits": 1, 
									"roomTypeCode": "'.$roomTypeCode.'"
								}
							]
						}
					], 
					"advertisementId": null, 
					"promotionId": null, 
					"countryCode": null, 
					"secondarySubChannel": "Web4_Desktop", 
					"id": 0, 
					"selected": true, 
					"roomData": {
						"adults": '.$guestCount.', 
						"children": 0, 
						"infants": 0, 
						"noOfNights": 0
					}, 
					"services": [ ], 
					"total": {
						"amountBeforeTax": null, 
						"amountAfterTax": null
					}, 
					"roomRates": [
						{
							"roomTypeCode": "'.$roomTypeCode.'", 
							"roomTypeName": "'.$roomTypeName.'", 
							"numberOfUnits": 1, 
							"rates": [';
			foreach($betweenDates as $getdate){
				$effectiveDate[] = '{
					"effectiveDate": "'.$getdate.'", 
					"unitMultiplier": 1, 
					"base": { }
				}';
			}
			$holdbody .= implode( ', ', $effectiveDate );
			$holdbody .=	']
						}
					]
				}';
		if(isset($getresponse) && !empty($getresponse)){
			$holdbody .= ','.$requestString;
		}
		$holdbody .=']
		}';
		//print $holdbody;die;
		$token = $this->getToken();	
		try {
			$response = \Drupal::httpClient()->post( $url , [
				'body' =>$holdbody,
				'headers' => [
					'Authorization' => 'Bearer '.$token,
					'Content-Type' => 'application/json',
				],
			]);
			$data = $response->getBody()->getContents();
			if (empty($data)) {
				return FALSE;
			}
		}
		catch (GuzzleException $error) {
			//if ($error->hasResponse()) {
				// Get the original response
				$data = $error->getResponse();
				// Get the info returned from the remote server.
				$response_info = $data->getBody()->getContents();
				// Using FormattableMarkup allows for the use of <pre/> tags, giving a more readable log item.
				$message = new FormattableMarkup('TravelClick API error. Error details are as follows:<pre>@response</pre>', ['@response' => print_r(json_decode($response_info), TRUE)]);
				// Log the error
				watchdog_exception('Remote API Connection', $error, $message);
				return new Response(render($response_info));
			//}
		  }
		  
		//Response
		$jsontoArray = (array) json_decode($data);
		//$rateplandata = [$ratePlanCode, $ratePlanType, $ratePlanname,$jsontoArray];
		$getResponseInarray = $jsontoArray['reservationResponses'];
		$languageCode = $jsontoArray['languageCode'];
		$itineraryId = $jsontoArray['itineraryId'];
		$multiresponse = array('getresponse' => $getResponseInarray, 'itinerary_id' => $itineraryId);
		$session_val->set('multiresponse', $multiresponse); // multiresponse set in session
		$session_val->set('rateplandata', $jsontoArray);
		$session_val->set('no_of_roomcount', $roomcount);
		// To make entry for itinerary tables
		if($roomcount == $room){ //Check last seclect rate
			$saving = 0;				 
			$get_client_ip = \Drupal::request()->getClientIp();  // Get IP address
			$entry = array();
			$itneryId = $jsontoArray['itineraryId'];
			$email = $get_client_ip;
			$duration = $jsontoArray['reservationResponses'][0]->resGlobalInfo->timeSpan->duration;
			$currency = $currencyCode;
			foreach($jsontoArray['reservationResponses'] as $reservationResponses){
				$saving += $reservationResponses->roomStays[0]->total->discount;
			}
			$total_savings = $saving; // @TODO: get sum of all discount
			$total_resort_fee = $jsontoArray['itineraryTotals']->itineraryResortFeeTotal;
			$total_tax = $jsontoArray['itineraryTotals']->itineraryRoomTotalTaxes;
			$total_amount_before_tax = $jsontoArray['itineraryTotals']->itineraryRoomSubTotal;
			$total_amount = $jsontoArray['itineraryTotals']->itineraryRoomGrandTotal;
			$total_amount_paid = $jsontoArray['itineraryPaymentInfo']->itineraryDepositAmt;
			$status = 'Hold';
			$guestbook_flag = 0;
			$tnc_flag = 0;
			$vacation_guard_flag = 0;
			$entry = array(
				'itneryId' => $itneryId,
				'email' => $email,
				'check_in_date' => $date_from,
				'check_out_date' => $date_to,
				'hotel_code' => $hotelCode,
				'adults' => $guestCount,
				'rooms' => $room,
				'duration' => $duration,
				'currency' => $currency,
				'total_savings' => $total_savings,															
				'total_resort_fee' => $total_resort_fee,
				'total_tax' => $total_tax,
				'total_amount_before_tax' => $total_amount_before_tax,
				'total_amount' => $total_amount,
				'total_amount_paid' => $total_amount_paid,
				'status' => $status,
				'guestbook_flag' => $guestbook_flag,
				'tnc_flag' => $tnc_flag,
				'vacation_guard_flag' => $vacation_guard_flag
			);
			//call function itinerary_details
			$itinerary_details = new TravelclickBookingController();
			$result = $itinerary_details->itinerary_details($entry);
		}
		// To make entry for Room booking details
		$room_entry = array();
		$ratesbefore = array();
		$room_booking_id = $jsontoArray['reservationResponses'][0]->uniqueId;
		$room_itinerary_id =$jsontoArray['itineraryId'];
		$room_type_code = $roomTypeCode;
		$rate_plan_code = $ratePlanCode;
		$room_type_name = $roomTypeName;
		$rate_plan_type = $ratePlanType;
		$rate_plan_name = $ratePlanname;
		$status = 'Hold';
		$room_total_resort_fee = $jsontoArray['reservationResponses'][0]->roomStays[0]->taxes->resortFee;
		$savings = $jsontoArray['reservationResponses'][0]->roomStays[0]->total->discount;
		$room_total_tax = $jsontoArray['reservationResponses'][0]->roomStays[0]->total->taxAmountTotal;
		$room_total_before_tax = $jsontoArray['reservationResponses'][0]->roomStays[0]->total->amountBeforeTax;
		$room_total = $jsontoArray['reservationResponses'][0]->roomStays[0]->total->amountAfterTax;
		$rate_overview = isset($rateOverview) ? strip_tags($rateOverview) : '';
		$deposit_policy = $jsontoArray['reservationResponses'][0]->policies->guaranteePolicies[0]->policyDescription;
		$cancellation_policy = $jsontoArray['reservationResponses'][0]->policies->cancellationPolicies[0]->policyDescription;
		$amountBeforeTaxes = $jsontoArray['reservationResponses'][0]->roomStays[0]->roomRates[0]->rates;
		foreach($amountBeforeTaxes as $amountBeforeTax){
			//$ratesbefore[$amountBeforeTax->effectiveDate] =  $amountBeforeTax->amountBeforeTax;
			$ratesbefore[] =  array(strtotime($amountBeforeTax->effectiveDate) => $amountBeforeTax->amountBeforeTax);
		}
		$rate_per_day = strval(json_encode($ratesbefore));
		$deadLineDate = $jsontoArray['reservationResponses'][0]->policies->cancellationPolicies[0]->cancellationPenalty[0]->deadLineDate;
		$room_cancel_deadline = strtotime($deadLineDate);
		$duration = $jsontoArray['reservationResponses'][0]->resGlobalInfo->timeSpan->duration;
		$room_entry = array(
			'room_booking_id' => $room_booking_id,
			'itinerary_id' => $room_itinerary_id,
			'room_type_code' => $room_type_code,
			'rate_plan_code' => $rate_plan_code,
			'room_type_name' => $room_type_name,
			'rate_plan_type' => $rate_plan_type,
			'rate_plan_name' => $rate_plan_name,
			'status' => $status,
			'room_total_resort_fee' => $room_total_resort_fee,
			'savings' => $savings,
			'room_total_tax' => $room_total_tax,
			'room_total_before_tax' => $room_total_before_tax,
			'room_total' => $room_total,
			'rate_overview' => $rate_overview,
			'deposit_policy' => $deposit_policy,
			'cancellation_policy' => $cancellation_policy,
			'rate_per_day' => $rate_per_day,
			'room_cancel_deadline' => $room_cancel_deadline,
			'no_rooms' => $room,
			'total_duration' => $duration
		);
		//call function room_booking_details
		$room_booking_details = new TravelclickBookingController();
		$roomresult = $room_booking_details->room_booking_details($room_entry);

		//The Ajax call. This will render only the TWIG template.
		return new Response(render($data));
	}
		
	/*Reservation comparison*/
	public function comparison( $hotelCode, $dateIn, $dateOut, $rooms, $adults) {
		$api_base = 'https://api-staging.travelclick.com/';
		$url = $api_base.'shop/v1/hotel/'.$hotelCode.'/avail';
		$query = array(
			'dateIn' => $dateIn,
			'dateOut' => $dateOut,
			'rooms' => $rooms,
			'adults' => $adults,
			'isAvailableOnly' => 'true',
			'isAltHotelsReq' => 'false'
			 );
		$token = $this->getToken();
		try {
				$response = \Drupal::httpClient()->get( $url , [
					'timeout' => 800,
					'query' => $query,
					'headers' => [
						'authorization' => 'Bearer '.$token,
						'accept'	=> 'application/json',
					],
				]);
			$code = json_decode($response->getStatusCode());
			if ($code == 200) {
			  	$data = $response->getBody()->getContents();
				return json_decode($data);
			}
			elseif($code == 403) {
				$data = $response->getBody()->getContents();
				return json_decode($data);
			}
			elseif($code == 500) {
				$data = $response->getBody()->getContents();
				return json_decode($data);
			}
			elseif($code == 503) {
				$data = $response->getBody()->getContents();
				return json_decode($data);
			}
			elseif($code == 504) {
				$data = $response->getBody()->getContents();
				return json_decode($data);
			}
			else{
				$data = "Something went wrong!!!";
				return $data;
			}
		}
		catch (GuzzleException $error) {
			$response = $error->getMessage();
			\Drupal::logger('reservation confirmed - comarision_page')->notice($response);
			// Logs an error
			\Drupal::logger('reservation confirmed - comarision_page')->error($response);
			 throw $error;
		}
		return json_decode($data);
	}
	private function putbookingToken() {
		if( $this->token) {
			return $this->token; 
		}
		//TODO:: pull in api key + secret from an admin configuratio screen
		$client_id = '17xx9bj83kywdndja00f4j9zb0iy5md346t1';
		$secret = 's2aoyrwoxn32dkd7v6k43drwn7b46jkc';
		$auth_basic = 'Basic MTd4eDliajgza3l3ZG5kamEwMGY0ajl6YjBpeTVtZDM0NnQxOnMyYW95cndveG4zMmRrZDd2Nms0M2Ryd243YjQ2amtj';
		$response = \Drupal::httpClient()->put( $this->api_base.'swagger-ui/auth', [
		//$response = \Drupal::httpClient()->createRequest('PUT', $this->api_base.'swagger-ui/auth',[
			'verify' => false,
			'headers' => [
				'authorization' => $auth_basic,
				'content-type' => 'application/json',
				'referer'	=> 'https://api-staging.travelclick.com/swagger-ui/?urls.primaryName=Staging%20-%20Book%20V1',
				'origin'	=> 'https://api-staging.travelclick.com'
			]
		])->getBody()->getContents();

		$res = json_decode($response);
		
		if( $res && is_object($res) && isset($res->access_token) ) {
			$this->token = $res->access_token;
			return $res->access_token;
		} else {
			throw new Exception("Unable to receive token: ".$response);
		}
  	}
    //Hold modify reservation
	public function hold_modify_reservation($reserved_Hotel_id,$reserved_room_unique_id,$upgrad_room_code,$upgrad_room_duration,$reserved_room_rate_plan,$upgrad_room_name){
		
		//foreach($retriveResponse as $retriveResponse_key=>$retriveResponse_value){
			//var_dump($requestbody_value);
		//}
		$api_base = 'https://api-staging.travelclick.com/';
		$url = $api_base.'book/v1/hotel/'.$reserved_Hotel_id.'/hold-reservation/'.$reserved_room_unique_id;
		$query ='';
		$query .= '{
					  "hotelCode": 99939,
					  "uniqueId": "472316283",
					  "posSource": {
						"bookingChannel": {
						  "code": "12",
						  "companyShortName": "WEB4",
						  "type": "22",
						  "division": "14"
						},
						"requestorIds": [],
						"companyName": {
						  "companyShortName": "Web4_Desktop"
						}
					  },
					  "resGlobalInfo": {
						"comments": [
						  {}
						],
						"guestCounts": [
						  {
							"ageQualifyingCode": "10",
							"count": "2"
						  },
						  {
							"ageQualifyingCode": "8",
							"count": "0"
						  },
						  {
							"ageQualifyingCode": "7",
							"count": "0"
						  }
						],
						"guaranteesAccepted": [
						  {
							"variantId": 0,
							"paymentCard": {
							  "cardHolderInfoRequired": false
							},
							"alternatePayment": {},
							"loyaltyRedemption": [],
							"primaryBookingRequest": false
						  }
						],
						"timeSpan": {
						  "start": "2019-11-25",
						  "end": "2019-11-27",
						  "duration": 2
						}
					  },
					  "resGuests": [
						{
						  "uniqueId": {},
						  "profile": {
							"shareAllMarketInd": "1",
							"customer": {
							  "namePrefix": "N/A",
							  "givenName": "TavelClick",
							  "surName": "Click",
							  "telephone": [
								{
								  "phoneUseType": "1"
								},
								{
								  "phoneUseType": "2"
								}
							  ],
							  "email": "raviranj@hcl.com",
							  "address": []
							},
							"consents": [
							  {
								"id": 1,
								"consentInd": "0",
								"consentText": null
							  }
							]
						  }
						}
					  ],
					  "roomStays": [
						{
						  "ratePlans": [
							{
							  "ratePlanCode": "2143631",
							  "ratePlanType": "Regular",
							  "ratePlanName": "Advance Purchase Rate",
							  "rateExternalCode": "APR",
							  "pmsRateExternalCode": "APR"
							}
						  ],
						  "roomRates": [
							{
							  "roomTypeCode": "425039",
							  "roomTypeName": "1 Bedroom Suite at Villas on the Green",
							  "numberOfUnits": 1,
							  "rates": [
								{
								  "effectiveDate": "2019-11-25",
								  "grossAmountBeforeTax": 164.25,
								  "discount": 0,
								  "discountIndicator": false,
								  "amountBeforeTax": 164.25
								},
								{
								  "effectiveDate": "2019-11-26",
								  "grossAmountBeforeTax": 209.25,
								  "discount": 0,
								  "discountIndicator": false,
								  "amountBeforeTax": 209.25
								}
							  ],
							  "mainImage": {
								"type": "main-image",
								"source": "/assets/hotel/99939/media/room/main-image/vogl_main_enhanced_enhanced.jpg",
								"sortOrder": 0
							  },
							  "roomExternalCode": "VLUXS",
							  "pmsRoomExternalCode": "VLUXS"
							}
						  ]
						}
					  ]
		}';
		$token = $this->putbookingToken();
		try {
			$response = \Drupal::httpClient()->get( $url , [
				'timeout' => 800,
				'query' => $query,
				'headers' => [
					'authorization' => 'Bearer '.$token,
					'accept'	=> 'application/json',
				],
			]);
			$code = json_decode($response->getStatusCode());
			if ($code == 200) {
			  	$data = $response->getBody()->getContents();
				return json_decode($data);
			}
			elseif($code == 403) {
				$data = $response->getBody()->getContents();
				return json_decode($data);
			}
			elseif($code == 500) {
				$data = $response->getBody()->getContents();
				return json_decode($data);
			}
			elseif($code == 503) {
				$data = $response->getBody()->getContents();
				return json_decode($data);
			}
			elseif($code == 504) {
				$data = $response->getBody()->getContents();
				return json_decode($data);
			}
			else{
				$data = "Something went wrong!!!";
				return $data;
			}
		}
		catch (GuzzleException $error) {
			$response = $error->getMessage();
			\Drupal::logger('reservation confirmed - offerUpgrade')->notice($response);
			// Logs an error
			\Drupal::logger('reservation confirmed - offerUpgrade')->error($response);
			 throw $error;
		}
		return json_decode($data);

	}
	Public function reservationcomparison(){
	//Session
	$sessionController	= new TravelclickBookingController();
	$session_details 	= $sessionController->sessiondetails();
	//$tagetID 			= $session_details->get('tid_val');
	//$hotelCode 	    = $session_details->get('hotel_code');
	$reservation_other_details = $session_details->get('other_details');
	$booking_detail    = $session_details->get('booking_details');
	$roomcode_rate      = $session_details->get('room_code_rate_code');
	$guestdetails       = $session_details->get('guestdetails');
	//$rooms =  substr($session_details->get('room'), 0,1); 
	//$guests =  (int) filter_var($session_details->get('guests'), FILTER_SANITIZE_NUMBER_INT);
	//$checkindate = date('Y-m-d', strtotime($session_details->get('checkin_date')));
	//$checkoutdate = date('Y-m-d', strtotime($session_details->get('checkout_date')));
	//TODO:: request search results from controller module
    $query				= \Drupal::request()->query->all();
    $rooms 				= 2;
	$guests             = 4;
    $hotelCode 			= 99939; //TODO:: get hotel code from Destination form entry
	$checkindate = '2019-11-25';
	$checkoutdate = '2019-11-27';
    $tagetID			= 7;
	$surname            = 'Click';//$guestdetails['guest_last_name'];
	$theme_path = drupal_get_path('theme', 'welkresorts');
	$path = \Drupal::request()->getSchemeAndHttpHost().base_path();
	/** Azure connection **/
	$key = "0wKvm82qfHR7TREINfZN9LCuCLV28nonuDkOAvz4ri9uOJ7dDhxqo4BuU7Bbs//V3p0NVX4cqxZGBrFf7ieg0g==";
    //$account = \Drupal::config('okta_ajax.settings')->get('azure_account');
    $account = "welkresortsdevdata001";
    $connectionString = 'DefaultEndpointsProtocol=https;AccountName='.$account.';AccountKey='.$key.';EndpointSuffix=core.windows.net';
    $azure = TableRestProxy::createTableService($connectionString);
	
	/*upgraderoom details*/
    $itenary_id         = $_REQUEST['Rid'];
	$reserved_room_unique_id = $_REQUEST['booked_room_CID'];
	$reserverd_room_code = $_REQUEST['SRC'];
	$reserved_room_rate_plan = $_REQUEST['brpc'];
	$reserved_roome_rate_type = $_REQUEST['rptype'];
	$reserved_roome_rate_name = $_REQUEST['rpname'];
	$upgrad_room_code   = $_REQUEST['urtc'];
	$upgrad_room_name   = $_REQUEST['urn'];
	$upgrad_room_duration   = $_REQUEST['urduration'];
	$upgrad_room_rate   = $_REQUEST['urr'];
	$reserved_Hotel_id	= $_REQUEST['hotelcode'];
	$reserved_hotel_check_in = $_REQUEST['checkin'];
	$reserved_hotel_check_out = $_REQUEST['checkout'];
	$Diff_room_total_before_tax	= $_REQUEST['Diff_room_total_before_tax'];
	$Diff_room_room_total_tax = $_REQUEST['Diff_room_room_total_tax'];
	$Diff_room_room_total = $_REQUEST['Diff_room_room_total'];
	$booking_type_data = $_REQUEST['booking_type_data'];
	$path = \Drupal::request()->getSchemeAndHttpHost().base_path(); // Base URL Path
	$booked_room_CID = array();
	$booked_roomcode = array();
	$booked_roomplan_code = array();
	$booked_roomname = array();
	/*booked confirmation ID after modify*/
	foreach($roomcode_rate as $roomcode_rate_key=>$roomcode_rate_value){
		$booked_room_CID[] = $roomcode_rate_value['room_CID'];
		$booked_roomcode[] = $roomcode_rate_value['roomcode'];
		$booked_roomname[] = $roomcode_rate_value['roomname'];
		$booked_roomplan_code[] = $roomcode_rate_value['roomplan_code'];
	}
	$booked_modify_itenary_ID = $booking_detail['itenary_ID'];//12345678;//$booking_detail['itenary_ID'];
	$booked_modify_unique_ID = $booked_room_CID[0];//472316283;//$booked_room_CID[0];
	$modified_room_code = $booked_roomcode[0];//425040;//$booked_roomcode[0];
	$modified_rate_plan_code = $booked_roomplan_code[0];//2143631;//$booked_roomplan_code[0];
	$modified_room_duration = 2;			
	
	// Get Resort Fee 
	$booking_block = \Drupal\block\Entity\Block::load('reservationbooking');
	$booking_uuid = $booking_block->getPlugin()->getDerivativeId();
	$booking_block_content = \Drupal::service('entity.repository')->loadEntityByUuid('block_content', $booking_uuid);
	$resort_fee = $booking_block_content->field_resort_fee->value;

	/*session set for payment details of upgraded room*/
	
	$session_val = \Drupal::request()->getSession();
	$session_val->set('diff_room_total_before_tax', $Diff_room_total_before_tax);	
	$session_val->set('diff_room_room_total_tax', $Diff_room_room_total_tax);
	$session_val->set('diff_room_room_total', $Diff_room_room_total);
	$session_val->set('booking_type_data', $booking_type_data);
	$session_val->set('reserverd_room_code', $reserverd_room_code);
	$session_val->set('reserved_room_rate_plan', $reserved_room_rate_plan);
	$session_val->set('reserved_roome_rate_type', $reserved_roome_rate_type);
	$session_val->set('reserved_roome_rate_name', $reserved_roome_rate_name);
	$session_val->set('upgrad_room_code', $upgrad_room_code);
	$session_val->set('upgrad_room_name', $upgrad_room_name);
	
	$rate_details = [];	
	$booking_details = [];
	$itenary_details = [];
	$tbl_booking = 'roomBookingDetail';
	$tbl_itinery = 'itinerary';
	/* Select Queries for room booking details */
	try {
		if($booking_type_data == 'upgrade'){
			$bookin_details_datas = $azure->getEntity($tbl_booking,'booking_details',$reserved_room_unique_id);
		}else{
			$bookin_details_datas = $azure->getEntity($tbl_booking,'booking_details',$booked_modify_unique_ID);		
		}
	  //$booking_detail_data[] = array('booking_detail_data'=>$bookin_details_datas);
    } catch (ServiceException $e) {
      
    }
	
	$entity = $bookin_details_datas->getEntity();

	$rate_detail_data = json_decode($entity->getPropertyValue("rate_details_data"), true);
	$rate_detail_plan = json_decode($entity->getPropertyValue("rate_per_day"), true);

	$theme_path = drupal_get_path('theme', 'welkresorts');
	$data_value = array();

	
	foreach($rate_detail_plan as $rate_date_key=>$rate_date_value){
		$data_html = array();
				foreach($rate_date_value as $key=>$value){
					$data_html[] = '<td></td><td>'.date("D,M d Y",$key).'</td>								
					<td>'.$value.'</td>';
				}
				
				$data_value[] = '<tr>'.implode('</tr><tr> ', $data_html).'</tr>';
				
		}
				$rate_data = implode('',$data_value);
																
	$room_total = $entity->getPropertyValue("room_total");
	$room_total_resort_fee = $entity->getPropertyValue("room_total_resort_fee");
	$total_room_amount = array();			
	$total_room_amount[] = $room_total + $room_total_resort_fee;
	$total_amount_after_cal = implode('',$total_room_amount);
	$html[] .= '
                     <p class="mt-1"><strong>'.$entity->getPropertyValue("room_type_name").'</strong></p>
                     <div class="d-flex justify-content-between align-items-center">
                        <div>
							<span>'
								.$entity->getPropertyValue("rate_plan_name").'<br />
										<a title="Change Room" data-toggle="modal" data-target="#changeRoom'.$entity->getPropertyValue("room_booking_id").'" class="change-room-link"
										href="#">Rate Details</a> 
										<!-- Modal for rate-->
										<div class="modal fade" id="changeRoom'.$entity->getPropertyValue("room_booking_id").'" tabindex="-1" role="dialog" aria-labelledby="bookingRoom"
										 aria-hidden="true">
											<div class="modal-dialog modal-lg " role="document">
												<div class="modal-content ">
												   <div class="modal-header d-block container">
													  <h2 class="modal-title  text-center" id="exampleModalLongTitle">'.$entity->getPropertyValue("room_type_name").'</h2>
													  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
														 <span aria-hidden="true">&times;</span>
													  </button>
													</div>
													<div class="modal-body container">
													  <!--tabs - photo & 3d tour -->
													<div class="row">
														<div class="col-6">
														
														
													<h4>Overview</h4>
													<br /><p>'.$entity->getPropertyValue("rate_overview").'</p>
													<h4>Deposit Policy</h4>
													<br /><p>'.$entity->getPropertyValue("deposit_policy").'</p>
													<h4>Cancellation Policy </h4>
													<br /><p>'.$entity->getPropertyValue("cancellation_policy").'</p>
															
														
														
											</div>
														
												<div class="col-6">
																<h4 class="text-center mb-4">Price Breakdown</h4>
																<table class="table text-right price-table-breakdown">
																	<thead>
																		<tr>
																			
																				<th>&nbsp;</th>
																				<th><strong>1 Room(s) for'.$rate_detail_plan_value['no_night'].'Night(s)</strong></th>
																				<th><strong>Prices in '.$entity->getPropertyValue("currency").'</strong></th>
																			
																		</tr>
																	</thead>
																	<tbody>'																		
																	.$rate_data.
																	'</tbody>
																</table>	
																<table class="table text-right price-table-breakdown">
																	<tbody>
																		<tr>
																			<td>&nbsp;</td>
																			<td>Resort Fees <img src="'.$path.'/'.$theme_path.'/dest/images/info-icon-grey.svg" /></td>
																			<td>'.$entity->getPropertyValue("currency_code").''.$entity->getPropertyValue("room_total_resort_fee").'</td>
																		</tr>
																		<tr>
																			<td>&nbsp;</td>
																			<td><strong>Total</strong></td>
																			<td><strong>'.$entity->getPropertyValue("currency_code").''.$total_amount_after_cal.'</strong></td>
																		</tr>
																	</tbody>
																</table>
															</div>		
													</div>
													  <!--tabs - photo & 3d tour -->
												</div>
												   <div class="modal-footer container">
													  <!--<button type="button" class="btn btn-primary medium">Select Rate</button>-->
													  <button type="button" class="btn btn-secondary medium" data-dismiss="modal">Close</button>
												   </div>
												</div>
											</div>
										</div>
								   </span>
								</div>
								<div>
								   <p class="p-0 m-0"><strong>'.$entity->getPropertyValue("currency_code").''.$entity->getPropertyValue("room_total_before_tax").'</strong></p>
								   <span>'.$entity->getPropertyValue("currency").' For '.$entity->getPropertyValue("total_duration").'Nights</span>
							</span>
                        </div>
                     </div>';
    
	/* Select Queries for  room booking details based on itinery */
	
	try {
		if($booking_type_data == 'upgrade'){
			$bookin_details_itinery = $azure->getEntity($tbl_itinery,'itinery_details',$itenary_id);
		}else{
			$bookin_details_itinery = $azure->getEntity($tbl_itinery,'itinery_details',$booked_modify_itenary_ID);
		}
		//$booking_detail_data[] = array('booking_detail_data'=>$bookin_details_datas);
    } catch (ServiceException $e) {
      
    }	
	$itinery = $bookin_details_itinery->getEntity();
	if(!empty($itinery)){

			
		$data .=	'<!--table-->
						<table class="table text-right">
							<tbody>
								<tr>
								   <td>Resort Fees <img src="'.$path.'/'.$theme_path.'/dest/images/info-icon-grey.svg" /></td>
								   <td><strong>'.$itinery->getPropertyValue("total_resort_fee").' '.$itinery->getPropertyValue("currency").'</strong></td>
								</tr>
								<tr>
								   <td>Taxes</td>
								   <td><strong>$'.$itinery->getPropertyValue("total_tax").' '.$itinery->getPropertyValue("currency").'</strong></td>
								</tr>
								<tr>
								   <td><strong>Total</strong></td>
								   <td><strong>$'.$itinery->getPropertyValue("total_amount").' '.$itinery->getPropertyValue("currency").'</strong></td>
								</tr>
								<tr>
								   <td><strong>Total Due Today</strong></td>
								   <td><strong>$'.$itinery->getPropertyValue("total_amount_paid").''.$itinery->getPropertyValue("currency").'</strong></td>
								</tr>
							</tbody>
						</table>';
	}	
	
	// upgraded room array
	/*$comparision 	= new TravelclickBookingController();
	if($booking_type_data == 'upgrade'){
		$room_comparision 	= $comparision->comparison( $reserved_Hotel_id, $reserved_hotel_check_in, $reserved_hotel_check_out, $rooms, $guests);
	}else{
		$room_comparision 	= $comparision->comparison($hotelCode,$checkindate,$checkoutdate, $rooms, $guests);
	}
	*/
	
	//holdmodify for test
	//$hold_modify_reservation 	= new TravelclickBookingController();
	//$holdReservationModify 	= $hold_modify_reservation->HoldMODIFYReservationCall($reserved_Hotel_id,$reserved_room_unique_id,$upgrad_room_code,$upgrad_room_name,$booking_type_data,$hotelCode,$booked_modify_unique_ID,$booked_roomcode,$booked_roomname);

	

	
	
	//retrive reservation
	/*$retrive_reservation 	= new TravelclickBookingController();
	if($booking_type_data == 'upgrade'){
		$retriveResponse 	= $retrive_reservation->retrive_reservation($reserved_Hotel_id,$reserved_room_unique_id,$surname);
	}else{
		$retriveResponse 	= $retrive_reservation->retrive_reservation($hotelCode,$booked_modify_unique_ID,$surname);
	}
	*/
	//hold reservation
	//$hold_reservation 	= new TravelclickBookingController();
	//if($booking_type_data == 'upgrade'){
		//$holdReservation 	= $hold_reservation->hold_modify_reservation($reserved_Hotel_id,$reserved_room_unique_id,$upgrad_room_code,$upgrad_room_duration,$reserved_room_rate_plan,$upgrad_room_name);
	//}else{
		//$holdReservation 	= $hold_reservation->hold_modify_reservation($hotelCode,$booked_modify_unique_ID,$booked_roomcode,$booked_roomname);
	//}
	// confirmation header
	$headerController 	= new TravelclickBookingController();
	$header_block_val 	= $headerController->getheader2Details();
	$header_query_val 	= $headerController->getheader1Details($tagetID);
	
	//if( isset($booking_detail["itenary_ID"]) ) {
		//if($booking_type_data == 'upgrade'){
			$items = array('upgraded_room'=>$room_comparision,'upgrade_room_type_code'=>$upgrad_room_code,'rate_plan_code'=>$reserved_room_rate_plan,'resort_fee'=>$resort_fee,'duration'=>$upgrad_room_duration,'header_query_val'=>$header_query_val,'header_block_val'=>$header_block_val,'booking_details_data'=>$booking_detail,'tid'=>$tagetID,'booking_room_detail_data'=>$html,'extension_booking_room_detail_data'=>$data);
		//}else{
			$items = array('upgraded_room'=>$room_comparision,'upgrade_room_type_code'=>$modified_room_code,'rate_plan_code'=>$modified_rate_plan_code,'resort_fee'=>$resort_fee,'duration'=>$modified_room_duration,'header_query_val'=>$header_query_val,'header_block_val'=>$header_block_val,'booking_details_data'=>$booking_detail,'tid'=>$tagetID,'booking_room_detail_data'=>$html,'extension_booking_room_detail_data'=>$data);
		//}
	//} else {
	//$items = array('Error'=>'No search parameters set', 'q'=>$query);
	//}
    return array(
      '#items' => $items,
      '#theme' => 'reservation_comparison',
    );
  }

  public function roomredirect(){
		$query = \Drupal::request()->query->all();
		$roomdetails=array();
		$title=\Drupal::request()->get('title');
		$roomtypecode=\Drupal::request()->get('roomtypecode');
		$roomdetails = [$title,$roomtypecode];
		$session_val = \Drupal::request()->getSession();
		$session_val->set('roomdetails', $roomdetails);
		//print'<pre>';print_r($roomdetails);exit;
		$build[] = array(
			'#type' => 'markup',
			'#markup' => 'Hello World!',
		);
		//The Ajax call. This will render only the TWIG template.
		return new Response(render($build));
	}
	public function calendardates( $hotelCode, $dateIn, $dateOut, $rooms, $adults) {
			$api_base = 'https://api-staging.travelclick.com/';
			$url = $api_base.'shop/v1/hotel/'.$hotelCode.'/basicavail';
			$query = array(
				'dateIn' => $dateIn,
				'dateOut' => $dateOut,
				'rooms' => $rooms,
				'adults' => $adults,
				'isAvailableOnly' => 'true',
				'isAltHotelsReq' => 'false'
				 );
				 
			 $token = $this->getToken();

				try {
					$response = \Drupal::httpClient()->get( $url , [
						'query' => $query,
						'timeout' =>10000,
						'headers' => [
							'authorization' => 'Bearer '.$token,
							'accept'	=> 'application/json',
						],
					]);
					
						// This is the Part I don't understand.
					if ($response->getStatusCode() == 200) {
						$data = $response->getBody()->getContents();
						if (empty($data)) {
							return FALSE;
						}
					}
					elseif($response->getStatusCode() == 403) {
						$data = $response->getBody()->getContents();
						if (empty($data)) {
							return FALSE;
						}
					}
					elseif($response->getStatusCode() == 500) {
						$data = $response->getBody()->getContents();
						if (empty($data)) {
							return FALSE;
						}
					}
					else{
						$data = "Something went wrong!!!";
					}
				}
				catch (RequestException $e) {
					watchdog_exception('travelclick', $e);
				}

			return json_decode($data);

  	}
	public function calendar(){
		$query = \Drupal::request()->query->all();
		$hotelCode=\Drupal::request()->get('hotelCode');
		$dateIn=\Drupal::request()->get('dateIn');
		$dateOut=\Drupal::request()->get('dateOut');
		$rooms=\Drupal::request()->get('rooms');
		$adults=\Drupal::request()->get('adults');
		$bookingController = new TravelclickBookingController();
		try {
			if(isset($adults) && isset($dateIn) && isset($dateOut) && isset($rooms) && isset($hotelCode)){
				$booking = $bookingController->calendardates($hotelCode,$dateIn,$dateOut,$rooms,$adults);
				$booking_json=json_encode($booking);
			}
		}
			//catch exception
		catch(Exception $e) {
			watchdog_exception('travelclick not responded', $e);
		}
		//print'<pre>';print_r($booking);exit;
		$build[] = array(
			'#type' => 'markup',
			'#markup' => 'Hello World!',
		);
		//The Ajax call. This will render only the TWIG template.
		return new Response($booking_json);
	}
	/**
	 * Call function itinerary_details() to insert or Update records. 
	 */
	public function itinerary_details(array $entry){
		$conn = new TravelclickBookingController();
		// Session
		$session_details= $conn->sessiondetails();
		$targetID = $session_details->get('tid_val');
		$getheader1details = $conn->getheader1Details($targetID);
		$hotelname = $getheader1details['h1_resortname']; // hotel Name
		$hoteladdress = $getheader1details['h1_address']; // hotel address

		$db_connection= $conn->db_connection();
		$return_value = false;
		if($db_connection){
			$itneryId = $entry['itneryId'];
			$email = $entry['email'];
			$check_in_date = $entry['check_in_date'];
			$check_out_date = $entry['check_out_date'];
			$hotel_code = $entry['hotel_code'];
			$adults = $entry['adults'];
			$rooms = $entry['rooms'];
			$duration = $entry['duration'];
			$currency = $entry['currency'];
			$total_savings = sprintf("%.2f", $entry['total_savings']);
			$total_resort_fee = sprintf("%.2f", $entry['total_resort_fee']);
			$total_tax = sprintf("%.2f", $entry['total_tax']);
			$total_amount_before_tax = sprintf("%.2f", $entry['total_amount_before_tax']);
			$total_amount = sprintf("%.2f", $entry['total_amount']);
			$total_amount_paid = sprintf("%.2f", $entry['total_amount_paid']);
			$status = $entry['status'];
			$guestbook_flag = $entry['guestbook_flag'];
			$tnc_flag = $entry['tnc_flag'];
			//$vacation_guard_flag = $entry['vacation_guard_flag'];
			try {
				/*
				$return_value = db_insert('itinerary_details')
				->fields(
					array(
						'itinerary_id' => $itneryId,
						'email_id' => $email,
						'check_in_date' => $check_in_date,
						'check_out_date' => $check_out_date,
						'hotel_code' => $hotel_code,
						'adults' => $adults,
						'rooms' => $rooms,
						'duration' => $duration,
						'currency' => $currency,
						'total_resort_fee' => $total_resort_fee,
						'total_tax' => $total_tax,
						'total_amount_before_tax' => $total_amount_before_tax,
						'total_amount' => $total_amount,
						'total_amount_paid' => $total_amount_paid,
						'status' => $status,
						'guestbook_flag' => $guestbook_flag,
						'tnc_flag' => $tnc_flag,
					)
				)->execute();
				*/
				$itinerary = new Entity();
				$itinerary->setPartitionKey('itinerary_details');
				$itinerary->setRowKey(strval($itneryId));
				$itinerary->addProperty('itinerary_id', 'Edm.Int32', $itneryId);
				$itinerary->addProperty('email_id', 'Edm.String', $email);
				$itinerary->addProperty('check_in_date', 'Edm.Int32', $check_in_date);
				$itinerary->addProperty('check_out_date', 'Edm.Int32', $check_out_date);
				$itinerary->addProperty('hotel_code', 'Edm.Int32', $hotel_code);
				$itinerary->addProperty('adults', 'Edm.Int32', $adults);
				$itinerary->addProperty('rooms', 'Edm.Int32', $rooms);
				$itinerary->addProperty('duration', 'Edm.Int32', $duration);
				$itinerary->addProperty('currency', 'Edm.String', $currency);
				$itinerary->addProperty('total_savings', 'Edm.Double', $total_savings);
				$itinerary->addProperty('total_resort_fee', 'Edm.Double', $total_resort_fee);
				$itinerary->addProperty('total_tax', 'Edm.Double', $total_tax);
				$itinerary->addProperty('total_amount_before_tax', 'Edm.Double', $total_amount_before_tax);
				$itinerary->addProperty('total_amount', 'Edm.Double', $total_amount);
				$itinerary->addProperty('total_amount_paid', 'Edm.Double', $total_amount_paid);
				$itinerary->addProperty('status', 'Edm.String', $status);
				$itinerary->addProperty('guestbook_flag', 'Edm.Boolean', false);
				$itinerary->addProperty('tnc_flag', 'Edm.Boolean', false);
				$itinerary->addProperty('vacation_guard_flag', 'Edm.Boolean', false);
				$itinerary->addProperty('hotel_name', 'Edm.String', $hotelname);
				$itinerary->addProperty('hotel_address', 'Edm.String', $hoteladdress);
				$itinerary->addProperty('destination_term_id', 'Edm.Int32', $targetID);
				// $itinerary->addProperty('shift4_unique_id', 'Edm.String', NULL);
				// $itinerary->addProperty('shift4_invoice_number', 'Edm.Int32', NULL);
				$db_connection->insertOrMergeEntity('itinerary', $itinerary);
				$return_value = $itinerary;
				// Logs a info
				\Drupal::logger('travelclick')->info('insted data into table itinerary_details');
			}
			catch (\Exception $error) {
				watchdog_exception('Table entry', $error, 'Insert failed in table itinerary_details');
			}
			return $return_value ?? NULL;
		}
															 
	}
	/**
	 * Call function room_booking_details() to insert or Update records. 
	 */
	public function room_booking_details(array $entry){
		$conn = new TravelclickBookingController();
		$db_connection= $conn->db_connection();
		$return_value = false;
		if($db_connection){
			$room_booking_id = $entry['room_booking_id'];
			$itinerary_id = $entry['itinerary_id'];
			$room_type_code = $entry['room_type_code'];
			$rate_plan_code = $entry['rate_plan_code'];
			$room_type_name = $entry['room_type_name'];
			$rate_plan_type = $entry['rate_plan_type'];
			$rate_plan_name = $entry['rate_plan_name'];
			$status = $entry['status'];
			$room_total_resort_fee = sprintf("%.2f", $entry['room_total_resort_fee']);
			$savings = sprintf("%.2f", $entry['savings']);
			$room_total_tax = sprintf("%.2f", $entry['room_total_tax']);
			$room_total_before_tax = sprintf("%.2f", $entry['room_total_before_tax']);
			$room_total =  sprintf("%.2f", $entry['room_total']);
			$rate_overview = $entry['rate_overview'];
			$deposit_policy = $entry['deposit_policy'];
			$cancellation_policy = $entry['cancellation_policy'];
			$rate_per_day = $entry['rate_per_day'];
			$room_cancel_deadline = $entry['room_cancel_deadline'];
			$no_rooms = $entry['no_rooms'];
			$total_duration = $entry['total_duration'];
			try {
				/*
				$return_value = db_insert('room_booking_details')
				->fields(
					array(
						'room_booking_id' => $room_booking_id,
						'itinerary_id' => $itinerary_id,
						'room_type_code' => $room_type_code,
						'rate_plan_code' => $rate_plan_code,
						'room_type_name' => $room_type_name,
						'rate_plan_type' => $rate_plan_type,
						'rate_plan_name' => $rate_plan_name,
						'status' => $status,
						'room_total_resort_fee' => $room_total_resort_fee,
						'savings' => $savings,
						'room_total_tax' => $room_total_tax,
						'room_total_before_tax' => $room_total_before_tax,
						'room_total' => $room_total,
						'rate_overview' => $rate_overview,
						'deposit_policy' => $deposit_policy,
						'cancellation_policy' => $cancellation_policy,
						'rate_per_day' => $rate_per_day,
						'room_cancel_deadline' => $room_cancel_deadline,
					)
				)->execute();
				*/
				$room = new Entity();
				$room->setPartitionKey('booking_details');
				$room->setRowKey(strval($room_booking_id));
				$room->addProperty('room_booking_id', 'Edm.Int32', $room_booking_id);
				$room->addProperty('itinerary_id', 'Edm.Int32', $itinerary_id);
				$room->addProperty('room_type_code', 'Edm.Int32', $room_type_code);
				$room->addProperty('rate_plan_code', 'Edm.Int32', $rate_plan_code);
				$room->addProperty('rate_plan_type', 'Edm.String', $rate_plan_type);
				$room->addProperty('rate_plan_name', 'Edm.String', $rate_plan_name);
				$room->addProperty('status', 'Edm.String', $status);
				$room->addProperty('room_total_resort_fee', 'Edm.Double', $room_total_resort_fee);
				$room->addProperty('room_total_tax', 'Edm.Double', $room_total_tax);
				$room->addProperty('room_total_before_tax', 'Edm.Double', $room_total_before_tax);
				$room->addProperty('room_total', 'Edm.Double', $room_total);
				$room->addProperty('rate_overview', 'Edm.String', $rate_overview);
				$room->addProperty('deposit_policy', 'Edm.String', $deposit_policy);
				$room->addProperty('cancellation_policy', 'Edm.String', $cancellation_policy);
				$room->addProperty('rate_per_day', 'Edm.String', $rate_per_day);
				$room->addProperty('room_cancel_deadline', 'Edm.Int32', $room_cancel_deadline);
				$room->addProperty('room_type_name', 'Edm.String', $room_type_name);
				$room->addProperty('savings', 'Edm.Double', $savings);
				$room->addProperty('total_duration', 'Edm.Int32', $total_duration);
				$room->addProperty('no_night', 'Edm.Int32', $total_duration);
				$room->addProperty('no_rooms', 'Edm.Int32', $no_rooms);
				$room->addProperty('currency_code', 'Edm.String', '$');
				// $room->addProperty('rate_details_data', 'Edm.String', 'test');
				// $room->addProperty('rate_details_plan', 'Edm.String', 'test');
				$db_connection->insertOrMergeEntity('roomBookingDetail', $room);
				$return_value = $room;
				// Logs a info
				\Drupal::logger('travelclick')->info('insted data into table room_booking_details');
			}
			catch (\Exception $error) {
				//print $error;die;
				watchdog_exception('Table entry', $error, $error);
			}
			return $return_value ?? NULL;
		}
															 
	}
	
		
	/*session unset of variables*/
	public function reservationSessionOut(){
		global $base_url;
		$session_val = \Drupal::request()->getSession();
		$session_val->remove('Diff_room_total_before_tax');	
		$session_val->remove('Diff_room_room_total_tax');
		$session_val->remove('Diff_room_room_total');
		$session_val->remove('booking_type_data');
		$session_val->remove('reserverd_room_code');
		$session_val->remove('reserved_room_rate_plan');
		$session_val->remove('reserved_roome_rate_type');
		$session_val->remove('reserved_roome_rate_name');
		$session_val->remove('upgrad_room_code');
		$session_val->remove('upgrad_room_name');
		$session_val->remove('tid_val');	
		$session_val->remove('hotel_code');
		$session_val->remove('guestdetails');
		$session_val->remove('room_code_rate_code');
		$session_val->remove('booking_details');
		$session_val->remove('code');
		$session_val->remove('rtype');
		$session_val->remove('rname');
		$session_val->remove('rcount');
		$session_val->remove('checkin_date');
		$session_val->remove('checkout_date');
		$session_val->remove('room');
		$session_val->remove('guests');
		$session_val->remove('booking_destination');
		$session_val->remove('clicked');
		
		return new RedirectResponse(\Drupal::url('<front>', [], ['absolute' => TRUE]));

	}
	public function db_connection(){
		$key = "0wKvm82qfHR7TREINfZN9LCuCLV28nonuDkOAvz4ri9uOJ7dDhxqo4BuU7Bbs//V3p0NVX4cqxZGBrFf7ieg0g==";
		//$account = \Drupal::config('okta_ajax.settings')->get('azure_account');
		$account = "welkresortsdevdata001";
		$connectionString = 'DefaultEndpointsProtocol=https;AccountName='.$account.';AccountKey='.$key.';EndpointSuffix=core.windows.net';
		$azure = TableRestProxy::createTableService($connectionString);
		return $azure;
	}
} 