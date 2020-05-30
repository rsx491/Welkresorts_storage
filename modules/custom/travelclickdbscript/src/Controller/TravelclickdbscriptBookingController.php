<?php

namespace Drupal\travelclickdbscript\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Database\Statement;
use Drupal\node\Entity\Node;
use Symfony\Component\HttpFoundation\Response;
use Drupal\Component\Serialization\Json;
use Drupal\paragraphs\Entity\Paragraph;
use \Drupal\file\Entity\File;
use Drupal\taxonomy\Entity\Term;

use \Drupal\file\Entity\File;
/**
 * Handle travelclick api requests for booking/availability
*/
class TravelclickdbscriptBookingController {

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
	
		
	public function getRooms( $hotelC ) {
		//print($hotelC);exit;
		$url = $this->api_base.'/entity/v1/hotel/'.$hotelC.'/info/rooms?lang=en';
		$token = $this->getToken();
			$response = \Drupal::httpClient()->get($url, ['headers'=>['authorization'=>'Bearer '.$token]])->getBody()->getContents();
		return json_decode($response);
	}
     

	public function cmsupdate($hotelcode){ 
	   
		$hotelC=$hotelcode;
		$bookingController = new TravelclickdbscriptBookingController();
		try {
			
			$booking = $bookingController->getRooms($hotelC);
			$json  = json_encode($booking);
			$booking_array = json_decode($json, true);
			$room_array_meesage = $bookingController->createrooms($hotelC,$booking_array);
			echo $room_array_meesage ;
		}
			//catch exception
		catch(Exception $e) {
			watchdog_exception('travelclick not responded', $e);
		}
		//$booking ="test";
		if( isset($booking) ) {
			$items = array('booking'=>$room_array_meesage);
		} else {
			$items = array('Error'=>'No search parameters set', 'q'=>$query);
               }
		return array(
		  '#items' => $items,
		  '#theme' => 'room_details_booking',
		);
	
	}
	public function createrooms($hotelC,$booking_array){ 
		$roomTypes=$booking_array['guestRooms'];
		
		foreach($roomTypes as $roomTypeskey =>$roomTypesvalue){
			 $node;
			 $target_id_bed=array();
			 $revision_id_bed=array();
			 $target_id_occupancy=array();
			 $revision_id_occupancy=array();
			 $target_id=$hotelC;
			 if(isset($target_id)){
			 $contact_tid = db_select('taxonomy_term__field_resort_code', 'f')
											->fields('f', array('entity_id'))
											->condition('field_resort_code_value', $target_id)
											->execute()
											->fetchField();
			$destination_tid = db_select('taxonomy_term__field_resort_id', 'f')
											->fields('f', array('entity_id'))
											->condition('field_resort_id_value', $target_id)
											->execute()
											->fetchField();								
			 }
			//Contact no
			if((isset($contact_tid))){
				$term = Term::load($contact_tid);
				$term_array=$term->toArray();
				
				$term_name=$term_array['name'][0]['value'];
				$term_name=str_replace('-', ' ', $term_name);
			}
			else{
				$contact_tid ="";
				$term_name="";
			}
			//end of contact no
			foreach($roomTypes[$roomTypeskey]['roomFeatures'] as $amenitieskey =>$amenitiesval){
				   
				 if ($amenitiesval['type'] == "Beds"){
					 
				   $paragraph_bed = Paragraph::create([
					  'type' => 'room_bed_details_',
					  'field_room_details_bed_text' => $amenitiesval['amenityName'],
					  'field_room_details_bed_value' => $amenitiesval['quantity'],
					 
					]);
					 //$paragraph_bed->isNew();
					 $paragraph_bed->save();
					 array_push($target_id_bed,$paragraph_bed->id());
					 array_push($revision_id_bed,$paragraph_bed->getRevisionId());
					//$node->field_room_bed_details->appendItem($paragraph_bed);
				}
				else if ($amenitiesval['type'] == "Size" || $amenitiesval['type'] == "Occupancy"){
					
				  $paragraph_occupancy = Paragraph::create([
					  'type' => 'room_features',
					  'field_measurement_' => $amenitiesval['amenityName'],
					  'field_measurement_value' => $amenitiesval['quantity'],
					 
					]);
					 //$paragraph_bed->isNew();
					 $paragraph_occupancy->save();
					 array_push($target_id_occupancy,$paragraph_occupancy->id());
					 array_push($revision_id_occupancy,$paragraph_occupancy->getRevisionId());
				}	
				 
				
			}
			
		   if ($roomTypesvalue['maxOccupancy'] == 4){
			  $selectlistvalue= 1;
			}
			else if ($roomTypesvalue['maxOccupancy'] == 6){
			 $selectlistvalue= 2;
			}
			else if ($roomTypesvalue['maxOccupancy'] == 8){
			  $selectlistvalue= 3;
			}	
			//Logo Image
		   $file_image='modules/custom/travelclickdbscript/img/welk-logo-header-dark.png';             
		   $file_content = file_get_contents($file_image);
		   $directory = 'public://Image/';
		   file_prepare_directory($directory, FILE_CREATE_DIRECTORY);
		   $file_image = file_save_data($file_content, $directory . basename($file_image),FILE_EXISTS_REPLACE);
		   
		  $node = Node::create([
					  'type'        => 'room_details',
					  'title'       => $roomTypesvalue['roomTypeName'],
					  'field_listing_page_title' =>$roomTypesvalue['roomTypeName'],
					  'field_room_type_code' =>$roomTypesvalue['id'],
					  'field_room_details_description' =>$roomTypesvalue['description'],
					  'field_number_of_bedrooms' =>$selectlistvalue,
					  'field_contact_number' =>$contact_tid,
					  'field_logo_image' => array('target_id' =>$file_image->id(),'alt'=>$term_name),
					  'field_destination' => $destination_tid,
					  'uid' => 1,
					  
			]);
			
			$data_save=$node->save();
			
			$nid = $node->id();
			$node_p = Node::load($nid);
			$target_revision_id_array_bed=array_combine($target_id_bed,$revision_id_bed); 
			$target_revision_id_array_occupancy=array_combine($target_id_occupancy,$revision_id_occupancy); 
			
			foreach ($target_revision_id_array_bed as $key=>$value) {
			
				$node_p->field_room_bed_details[] = [
				  'target_id' => $key,
				  'target_revision_id' => $value,
				  
				];
			}
			foreach ($target_revision_id_array_occupancy as $key=>$value) {
				$node_p->field_room_features[] = [
				  'target_id' => $key,
				  'target_revision_id' => $value,
				  
				];
				
			}
			$node_a=$node_p->toArray();
			$paragraph_save= $node_p->save();
			
			
		
		}
		if($data_save== "1" && $paragraph_save== "2" ){
		$return_data_val= " <h2>Data Import is Done successfully for fields and amenities both. Please, check the same. </h2>";
		
		}
		elseif($data_save== "1" && $paragraph_save!= "2" ){
			$return_data_val= " <h2>Data Import is Done successfully for fields. There is some problem in amenities. Please, check the same. </h2>";
		}
		else{
			$return_data_val= " <h2> Data is not imported. There is some problem in getting it Imported. Please, check for the same in error log.</h2> ";
		}
	
		return $return_data_val;
	}

} 