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
/**
 * Handle travelclick api requests for booking/availability
*/
class TravelclickdbscriptBookingController {

	

	public function cmsupdate($hotelcode){ 
	   
		$hotelC=$hotelcode;
		$bookingController = new TravelclickdbscriptBookingController();
		try {
			
			//$booking = $bookingController->getRooms($hotelC);
			//$json  = json_encode($booking);
			//$booking_array = json_decode($json, true);
			$room_array_meesage = $bookingController->createrooms();
			echo $room_array_meesage ;
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
		  
		);
	}
	public function createrooms(){ 

	$booking_array='{
  "hotelCode": 99939,
  "languageCode": "EN_US",
  "guestRooms": [
    {
      "id": 425041,
      "roomTypeName": "1 Bedroom Villa with Jacuzzi at Villas on the Green",
      "roomExternalCode": "V1BDJ",
      "pmsRoomExternalCode": "V1BDJ",
      "maxOccupancy": 4,
      "maxAdultOccupancy": 4,
      "maxChildOccupancy": 4,
      "description": "h",
      "roomFeatures": [
        {
          "amenityName": "People",
          "quantity": 4,
          "type": "Occupancy"
        },
        {
          "amenityName": "King Bed",
          "quantity": 1,
          "type": "Beds",
          "amenityCode": "119"
        },
        {
          "amenityName": "Sofa Bed",
          "quantity": 1,
          "type": "Beds",
          "amenityCode": "217"
        },
        {
          "amenityName": "Sq ft / 76 Sq m",
          "quantity": 820,
          "type": "Size"
        }
      ],
      "amenities": [
        {
          "amenityName": "Air Conditioned",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "10"
        },
        {
          "amenityName": "Alarm Clock",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "12"
        },
        {
          "amenityName": "Balcony",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "17"
        },
        {
          "amenityName": "Bathtub",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "20"
        },
        {
          "amenityName": "Coffeemaker",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "51"
        },
        {
          "amenityName": "Complimentary Internet Access",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "67502"
        },
        {
          "amenityName": "Connecting Rooms",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "55"
        },
        {
          "amenityName": "Cordless Telephone",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "58"
        },
        {
          "amenityName": "Fire Alarm with Light",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "89"
        },
        {
          "amenityName": "Fireplace",
          "sortOrder": 3,
          "isPremiumAmenity": true,
          "amenityCode": "90"
        },
        {
          "amenityName": "Grab Bars in Bathrooms",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "102"
        },
        {
          "amenityName": "Hairdryer In Room",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "106"
        },
        {
          "amenityName": "High Speed Internet",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "127731"
        },
        {
          "amenityName": "Iron",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "113"
        },
        {
          "amenityName": "Ironing Board",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "114"
        },
        {
          "amenityName": "Jacuzzi",
          "sortOrder": 2,
          "isPremiumAmenity": true,
          "amenityCode": "127736"
        },
        {
          "amenityName": "Kitchen",
          "sortOrder": 4,
          "isPremiumAmenity": true,
          "amenityCode": "121"
        },
        {
          "amenityName": "Microwave",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "137"
        },
        {
          "amenityName": "Personal Refrigerator",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "186"
        },
        {
          "amenityName": "Radio",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "184"
        },
        {
          "amenityName": "Shower",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "204"
        },
        {
          "amenityName": "Sitting Area",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "210"
        },
        {
          "amenityName": "Telephone",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "225"
        },
        {
          "amenityName": "Toilet",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "235"
        },
        {
          "amenityName": "TV",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "240"
        }
      ],
      "sortOrder": 4,
      "mainImage": null,
      "media": [],
      "roomUpgradeOptions": [
        {
          "offerType": "alwaysOffer",
          "roomTypeCode": "425043",
          "sortOrder": 1
        },
        {
          "offerType": "alwaysOffer",
          "roomTypeCode": "425044",
          "sortOrder": 2
        },
        {
          "offerType": "offerAlternate",
          "roomTypeCode": "425045",
          "sortOrder": 1
        },
        {
          "offerType": "offerAlternate",
          "roomTypeCode": "425046",
          "sortOrder": 2
        }
      ],
      "availableInventoryThreshold": 0,
      "displayUrgencyMessage": false
    },
    {
      "id": 425040,
      "roomTypeName": "1 Bedroom Villa at Villas on the Green",
      "roomExternalCode": "V1BDR",
      "pmsRoomExternalCode": "V1BDR",
      "maxOccupancy": 4,
      "maxAdultOccupancy": 4,
      "maxChildOccupancy": 4,
      "description": "Villas on the Greens 820 sq. ft villa offering a master bedroom with a king size bed, bathroom accessible via hallway between bedroom &amp; living/dining room, living/dining room with queen sleeper sofa, and full kitchen with cook and dishware. Two televisions with expanded cable and DVD. Washer/dryer. Patio or balcony. Free Internet access.",
      "roomFeatures": [
        {
          "amenityName": "People",
          "quantity": 4,
          "type": "Occupancy"
        },
        {
          "amenityName": "King Bed",
          "quantity": 1,
          "type": "Beds",
          "amenityCode": "119"
        },
        {
          "amenityName": "Sofa Bed",
          "quantity": 1,
          "type": "Beds",
          "amenityCode": "217"
        },
        {
          "amenityName": "Sq ft / 76 Sq m",
          "quantity": 820,
          "type": "Size"
        }
      ],
      "amenities": [
        {
          "amenityName": "Air Conditioned",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "10"
        },
        {
          "amenityName": "Alarm Clock",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "12"
        },
        {
          "amenityName": "Balcony",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "17"
        },
        {
          "amenityName": "Bathtub",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "20"
        },
        {
          "amenityName": "Coffeemaker",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "51"
        },
        {
          "amenityName": "Connecting Rooms",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "55"
        },
        {
          "amenityName": "Cordless Telephone",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "58"
        },
        {
          "amenityName": "Fire Alarm with Light",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "89"
        },
        {
          "amenityName": "Hairdryer In Room",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "106"
        },
        {
          "amenityName": "High Speed Internet",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "127731"
        },
        {
          "amenityName": "Iron",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "113"
        },
        {
          "amenityName": "Ironing Board",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "114"
        },
        {
          "amenityName": "Kitchen",
          "sortOrder": 2,
          "isPremiumAmenity": true,
          "amenityCode": "121"
        },
        {
          "amenityName": "Microwave",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "137"
        },
        {
          "amenityName": "Personal Refrigerator",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "186"
        },
        {
          "amenityName": "Radio",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "184"
        },
        {
          "amenityName": "Shower",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "204"
        },
        {
          "amenityName": "Sitting Area",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "210"
        },
        {
          "amenityName": "Telephone",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "225"
        },
        {
          "amenityName": "Toilet",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "235"
        },
        {
          "amenityName": "TV",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "240"
        }
      ],
      "sortOrder": 3,
      "mainImage": null,
      "media": [],
      "roomUpgradeOptions": [
        {
          "offerType": "alwaysOffer",
          "roomTypeCode": "425041",
          "sortOrder": 1
        },
        {
          "offerType": "alwaysOffer",
          "roomTypeCode": "425043",
          "sortOrder": 2
        },
        {
          "offerType": "offerAlternate",
          "roomTypeCode": "425044",
          "sortOrder": 2
        },
        {
          "offerType": "offerAlternate",
          "roomTypeCode": "425045",
          "sortOrder": 1
        }
      ],
      "availableInventoryThreshold": 0,
      "displayUrgencyMessage": false
    },
    {
      "id": 425043,
      "roomTypeName": "1 Bedroom Villa at Mountain Villas",
      "roomExternalCode": "M1BDJ",
      "pmsRoomExternalCode": "M1BDJ",
      "maxOccupancy": 4,
      "maxAdultOccupancy": 4,
      "maxChildOccupancy": 4,
      "description": "Mountain Villas 851 sq. ft. villa. Interior includes use of granite, custom mountain style lighting fixtures, stone floors, exposed beams, and stainless steel appliances. Master bedroom with pillow top king and fireplace. Living/Dining Room with a fireplace over which there is an LCD TV, queen sleep sofa, full kitchen with cook and dishware, and washer/dryer. Bathroom features two sinks and a spacious walk in shower with two adjustable shower heads and overhead rain shower head. One balcony or patio. Free Internet access.",
      "roomFeatures": [
        {
          "amenityName": "People",
          "quantity": 4,
          "type": "Occupancy"
        },
        {
          "amenityName": "King Bed",
          "quantity": 1,
          "type": "Beds",
          "amenityCode": "119"
        },
        {
          "amenityName": "Sofa Bed",
          "quantity": 1,
          "type": "Beds",
          "amenityCode": "217"
        },
        {
          "amenityName": "Sq ft / 79 Sq m",
          "quantity": 851,
          "type": "Size"
        }
      ],
      "amenities": [
        {
          "amenityName": "Air Conditioned",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "10"
        },
        {
          "amenityName": "Alarm Clock",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "12"
        },
        {
          "amenityName": "Balcony",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "17"
        },
        {
          "amenityName": "Bathtub",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "20"
        },
        {
          "amenityName": "Coffeemaker",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "51"
        },
        {
          "amenityName": "Complimentary Internet Access",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "67502"
        },
        {
          "amenityName": "Connecting Rooms",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "55"
        },
        {
          "amenityName": "Cordless Telephone",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "58"
        },
        {
          "amenityName": "Fire Alarm with Light",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "89"
        },
        {
          "amenityName": "Fireplace",
          "sortOrder": 3,
          "isPremiumAmenity": true,
          "amenityCode": "90"
        },
        {
          "amenityName": "Grab Bars in Bathrooms",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "102"
        },
        {
          "amenityName": "Grecian Tub",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "103"
        },
        {
          "amenityName": "Hairdryer In Room",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "106"
        },
        {
          "amenityName": "High Speed Internet",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "127731"
        },
        {
          "amenityName": "Iron",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "113"
        },
        {
          "amenityName": "Ironing Board",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "114"
        },
        {
          "amenityName": "Jacuzzi",
          "sortOrder": 2,
          "isPremiumAmenity": true,
          "amenityCode": "127736"
        },
        {
          "amenityName": "Kitchen",
          "sortOrder": 4,
          "isPremiumAmenity": true,
          "amenityCode": "121"
        },
        {
          "amenityName": "Microwave",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "137"
        },
        {
          "amenityName": "Mountain View",
          "sortOrder": 1,
          "isPremiumAmenity": true,
          "amenityCode": "145"
        },
        {
          "amenityName": "Personal Refrigerator",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "186"
        },
        {
          "amenityName": "Radio",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "184"
        },
        {
          "amenityName": "Shower",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "204"
        },
        {
          "amenityName": "Sitting Area",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "210"
        },
        {
          "amenityName": "Smoke Detectors",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "216"
        },
        {
          "amenityName": "Telephone",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "225"
        },
        {
          "amenityName": "Terrace",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "231"
        },
        {
          "amenityName": "Toilet",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "235"
        },
        {
          "amenityName": "TV",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "240"
        },
        {
          "amenityName": "WC",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "253"
        }
      ],
      "sortOrder": 5,
      "mainImage": null,
      "media": [],
      "roomUpgradeOptions": [
        {
          "offerType": "alwaysOffer",
          "roomTypeCode": "425044",
          "sortOrder": 1
        },
        {
          "offerType": "alwaysOffer",
          "roomTypeCode": "425045",
          "sortOrder": 2
        },
        {
          "offerType": "offerAlternate",
          "roomTypeCode": "425046",
          "sortOrder": 1
        }
      ],
      "availableInventoryThreshold": 0,
      "displayUrgencyMessage": false
    },
    {
      "id": 425042,
      "roomTypeName": "1 Bedroom Suite at Mountain Villas",
      "roomExternalCode": "MLUXS",
      "pmsRoomExternalCode": "MLUXS",
      "maxOccupancy": 4,
      "maxAdultOccupancy": 4,
      "maxChildOccupancy": 3,
      "description": "Mountain Villas 584 sq ft villa. Living/dining area with queen sleeper sofa, wall mounted LCD TV, Stereo system and DVD player. Kitchen with dishwasher, microwave, stove, refrigerator, cook and dishware, and washer/dryer. Master bedroom with King bed &amp; wall mounted LCD TV. Private patio/balcony. Granite counter tops, stone floors, exposed beams, wall mounted LCD TV screens, free Internet access, and custom comforters.",
      "roomFeatures": [
        {
          "amenityName": "People",
          "quantity": 4,
          "type": "Occupancy"
        },
        {
          "amenityName": "King Bed",
          "quantity": 1,
          "type": "Beds",
          "amenityCode": "119"
        },
        {
          "amenityName": "Sofa Bed",
          "quantity": 1,
          "type": "Beds",
          "amenityCode": "217"
        },
        {
          "amenityName": "Sq ft / 54 Sq m",
          "quantity": 584,
          "type": "Size"
        }
      ],
      "amenities": [
        {
          "amenityName": "Air Conditioned",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "10"
        },
        {
          "amenityName": "Alarm Clock",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "12"
        },
        {
          "amenityName": "Balcony",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "17"
        },
        {
          "amenityName": "Bathtub",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "20"
        },
        {
          "amenityName": "Coffeemaker",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "51"
        },
        {
          "amenityName": "Complimentary Internet Access",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "67502"
        },
        {
          "amenityName": "Cordless Telephone",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "58"
        },
        {
          "amenityName": "Fire Alarm with Light",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "89"
        },
        {
          "amenityName": "Grab Bars in Bathrooms",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "102"
        },
        {
          "amenityName": "Hairdryer In Room",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "106"
        },
        {
          "amenityName": "High Speed Internet",
          "sortOrder": 4,
          "isPremiumAmenity": true,
          "amenityCode": "127731"
        },
        {
          "amenityName": "Iron",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "113"
        },
        {
          "amenityName": "Ironing Board",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "114"
        },
        {
          "amenityName": "Kitchenette",
          "sortOrder": 1,
          "isPremiumAmenity": true,
          "amenityCode": "120"
        },
        {
          "amenityName": "Large Suite",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "128"
        },
        {
          "amenityName": "Microwave",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "137"
        },
        {
          "amenityName": "Mountain View",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "145"
        },
        {
          "amenityName": "Personal Refrigerator",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "186"
        },
        {
          "amenityName": "Radio",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "184"
        },
        {
          "amenityName": "Shower",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "204"
        },
        {
          "amenityName": "Sitting Area",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "210"
        },
        {
          "amenityName": "Telephone",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "225"
        },
        {
          "amenityName": "Toilet",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "235"
        },
        {
          "amenityName": "TV",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "240"
        }
      ],
      "sortOrder": 2,
      "mainImage": null,
      "media": [],
      "roomUpgradeOptions": [
        {
          "offerType": "offerAlternate",
          "roomTypeCode": "425040",
          "sortOrder": 1
        },
        {
          "offerType": "alwaysOffer",
          "roomTypeCode": "425041",
          "sortOrder": 2
        },
        {
          "offerType": "alwaysOffer",
          "roomTypeCode": "425043",
          "sortOrder": 1
        },
        {
          "offerType": "offerAlternate",
          "roomTypeCode": "425044",
          "sortOrder": 2
        }
      ],
      "availableInventoryThreshold": 0,
      "displayUrgencyMessage": false
    },
    {
      "id": 425039,
      "roomTypeName": "1 Bedroom Suite at Villas on the Green",
      "roomExternalCode": "VLUXS",
      "pmsRoomExternalCode": "VLUXS",
      "maxOccupancy": 4,
      "maxAdultOccupancy": 4,
      "maxChildOccupancy": 3,
      "description": "Villas on the Greens 585 sq. ft villa offering a master bedroom with king bed, bathroom accessible via hallway between bedroom &amp; living/dining room, living/dining room with queen sleeper sofa and mini kitchen with cook and dishware. Two televisions with expanded cable and DVD. Patio or balcony. Free WiFi Internet access.",
      "roomFeatures": [
        {
          "amenityName": "People",
          "quantity": 4,
          "type": "Occupancy"
        },
        {
          "amenityName": "King Bed",
          "quantity": 1,
          "type": "Beds",
          "amenityCode": "119"
        },
        {
          "amenityName": "Sofa Bed",
          "quantity": 1,
          "type": "Beds",
          "amenityCode": "217"
        },
        {
          "amenityName": "Sq ft / 54 Sq m",
          "quantity": 585,
          "type": "Size"
        }
      ],
      "amenities": [
        {
          "amenityName": "Air Conditioned",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "10"
        },
        {
          "amenityName": "Alarm Clock",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "12"
        },
        {
          "amenityName": "Balcony",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "17"
        },
        {
          "amenityName": "Coffeemaker",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "51"
        },
        {
          "amenityName": "Complimentary Internet Access",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "67502"
        },
        {
          "amenityName": "Cordless Telephone",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "58"
        },
        {
          "amenityName": "Fire Alarm with Light",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "89"
        },
        {
          "amenityName": "Grab Bars in Bathrooms",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "102"
        },
        {
          "amenityName": "Hairdryer In Room",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "106"
        },
        {
          "amenityName": "High Speed Internet",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "127731"
        },
        {
          "amenityName": "Iron",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "113"
        },
        {
          "amenityName": "Ironing Board",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "114"
        },
        {
          "amenityName": "Kitchenette",
          "sortOrder": 2,
          "isPremiumAmenity": true,
          "amenityCode": "120"
        },
        {
          "amenityName": "Microwave",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "137"
        },
        {
          "amenityName": "Personal Refrigerator",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "186"
        },
        {
          "amenityName": "Radio",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "184"
        },
        {
          "amenityName": "Shower",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "204"
        },
        {
          "amenityName": "Sitting Area",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "210"
        },
        {
          "amenityName": "Smoke Detectors",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "216"
        },
        {
          "amenityName": "Telephone",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "225"
        },
        {
          "amenityName": "Toilet",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "235"
        },
        {
          "amenityName": "TV",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "240"
        }
      ],
      "sortOrder": 1,
      "mainImage": null,
      "media": [],
      "roomUpgradeOptions": [
        {
          "offerType": "alwaysOffer",
          "roomTypeCode": "425040",
          "sortOrder": 2
        },
        {
          "offerType": "offerAlternate",
          "roomTypeCode": "425041",
          "sortOrder": 2
        },
        {
          "offerType": "alwaysOffer",
          "roomTypeCode": "425042",
          "sortOrder": 1
        },
        {
          "offerType": "offerAlternate",
          "roomTypeCode": "425043",
          "sortOrder": 1
        }
      ],
      "availableInventoryThreshold": 0,
      "displayUrgencyMessage": false
    },
    {
      "id": 425045,
      "roomTypeName": "2 Bedroom Villa at Resort Villas",
      "roomExternalCode": "R2BDR",
      "pmsRoomExternalCode": "R2BDR",
      "maxOccupancy": 6,
      "maxAdultOccupancy": 6,
      "maxChildOccupancy": 5,
      "description": "g.",
      "roomFeatures": [
        {
          "amenityName": "People",
          "quantity": 6,
          "type": "Occupancy"
        },
        {
          "amenityName": "Double Bed",
          "quantity": 2,
          "type": "Beds",
          "amenityCode": "69"
        },
        {
          "amenityName": "King Bed",
          "quantity": 1,
          "type": "Beds",
          "amenityCode": "119"
        },
        {
          "amenityName": "Sofa Bed",
          "quantity": 1,
          "type": "Beds",
          "amenityCode": "217"
        },
        {
          "amenityName": "Sq ft / 127 Sq m",
          "quantity": 1370,
          "type": "Size"
        }
      ],
      "amenities": [
        {
          "amenityName": "2 Bedroom Suite",
          "sortOrder": 2,
          "isPremiumAmenity": true,
          "amenityCode": "2"
        },
        {
          "amenityName": "Air Conditioned",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "10"
        },
        {
          "amenityName": "Balcony",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "17"
        },
        {
          "amenityName": "Bathtub",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "20"
        },
        {
          "amenityName": "Coffeemaker",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "51"
        },
        {
          "amenityName": "Complimentary Internet Access",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "67502"
        },
        {
          "amenityName": "Cordless Telephone",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "58"
        },
        {
          "amenityName": "Fire Alarm with Light",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "89"
        },
        {
          "amenityName": "Garden View",
          "sortOrder": 1,
          "isPremiumAmenity": true,
          "amenityCode": "98"
        },
        {
          "amenityName": "Hairdryer In Room",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "106"
        },
        {
          "amenityName": "High Speed Internet",
          "sortOrder": 4,
          "isPremiumAmenity": true,
          "amenityCode": "127731"
        },
        {
          "amenityName": "Iron",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "113"
        },
        {
          "amenityName": "Kitchen",
          "sortOrder": 3,
          "isPremiumAmenity": true,
          "amenityCode": "121"
        },
        {
          "amenityName": "Microwave",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "137"
        },
        {
          "amenityName": "Personal Refrigerator",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "186"
        },
        {
          "amenityName": "Radio",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "184"
        },
        {
          "amenityName": "Shower",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "204"
        },
        {
          "amenityName": "Sitting Area",
          "sortOrder": 5,
          "isPremiumAmenity": true,
          "amenityCode": "210"
        },
        {
          "amenityName": "Smoke Detectors",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "216"
        },
        {
          "amenityName": "Telephone",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "225"
        },
        {
          "amenityName": "Terrace",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "231"
        },
        {
          "amenityName": "Toilet",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "235"
        },
        {
          "amenityName": "TV",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "240"
        },
        {
          "amenityName": "Vaulted Ceiling",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "246"
        },
        {
          "amenityName": "WC",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "253"
        }
      ],
      "sortOrder": 6,
      "mainImage": null,
      "media": [],
      "roomUpgradeOptions": [
        {
          "offerType": "alwaysOffer",
          "roomTypeCode": "425044",
          "sortOrder": 1
        },
        {
          "offerType": "alwaysOffer",
          "roomTypeCode": "425046",
          "sortOrder": 2
        }
      ],
      "availableInventoryThreshold": 0,
      "displayUrgencyMessage": false
    },
    {
      "id": 425044,
      "roomTypeName": "2 Bedroom Villa at Mountain Villas",
      "roomExternalCode": "M2BDR",
      "pmsRoomExternalCode": null,
      "maxOccupancy": 6,
      "maxAdultOccupancy": 6,
      "maxChildOccupancy": 5,
      "description": "Two Bedroom Mountain Villas 1,449 sq. ft. Living room with golf course view, gas fireplace, queen sofa sleeper, cable TV, Bose Wave system with Docking station, DVD, and Arcadia doors to a private 248 sq. ft. patio/balcony. Fully equipped kitchen with cook and dishware, dishwasher, microwave stove, refrigerator, washer/dryer. Master bedroom with king bed, golf course view, gas fireplace, wall safe, and cable TV. Master bath with garden soaking tub, walk-in glass shower with two head shower, and double sink vanity. Some two bedrooms are a lockoff configuration.",
      "roomFeatures": [
        {
          "amenityName": "People",
          "quantity": 6,
          "type": "Occupancy"
        },
        {
          "amenityName": "King Bed",
          "quantity": 2,
          "type": "Beds",
          "amenityCode": "119"
        },
        {
          "amenityName": "Sofa Bed",
          "quantity": 1,
          "type": "Beds",
          "amenityCode": "217"
        }
      ],
      "amenities": [
        {
          "amenityName": "2 Bedroom Suite",
          "sortOrder": 1,
          "isPremiumAmenity": true,
          "amenityCode": "2"
        },
        {
          "amenityName": "Air Conditioned",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "10"
        },
        {
          "amenityName": "Alarm Clock",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "12"
        },
        {
          "amenityName": "Balcony",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "17"
        },
        {
          "amenityName": "Bathtub",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "20"
        },
        {
          "amenityName": "Coffeemaker",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "51"
        },
        {
          "amenityName": "Complimentary Internet Access",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "67502"
        },
        {
          "amenityName": "Connecting Rooms",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "55"
        },
        {
          "amenityName": "Cordless Telephone",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "58"
        },
        {
          "amenityName": "Fire Alarm with Light",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "89"
        },
        {
          "amenityName": "Fireplace",
          "sortOrder": 4,
          "isPremiumAmenity": true,
          "amenityCode": "90"
        },
        {
          "amenityName": "Grecian Tub",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "103"
        },
        {
          "amenityName": "Hairdryer In Room",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "106"
        },
        {
          "amenityName": "High Speed Internet",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "127731"
        },
        {
          "amenityName": "Iron",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "113"
        },
        {
          "amenityName": "Ironing Board",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "114"
        },
        {
          "amenityName": "Jacuzzi",
          "sortOrder": 3,
          "isPremiumAmenity": true,
          "amenityCode": "127736"
        },
        {
          "amenityName": "Kitchen",
          "sortOrder": 5,
          "isPremiumAmenity": true,
          "amenityCode": "121"
        },
        {
          "amenityName": "Microwave",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "137"
        },
        {
          "amenityName": "Mountain View",
          "sortOrder": 2,
          "isPremiumAmenity": true,
          "amenityCode": "145"
        },
        {
          "amenityName": "Personal Refrigerator",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "186"
        },
        {
          "amenityName": "Radio",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "184"
        },
        {
          "amenityName": "Shower",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "204"
        },
        {
          "amenityName": "Sitting Area",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "210"
        },
        {
          "amenityName": "Smoke Detectors",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "216"
        },
        {
          "amenityName": "Telephone",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "225"
        },
        {
          "amenityName": "Terrace",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "231"
        },
        {
          "amenityName": "Toilet",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "235"
        },
        {
          "amenityName": "TV",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "240"
        },
        {
          "amenityName": "WC",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "253"
        }
      ],
      "sortOrder": 7,
      "mainImage": null,
      "media": [],
      "roomUpgradeOptions": [
        {
          "offerType": "alwaysOffer",
          "roomTypeCode": "425046",
          "sortOrder": 1
        }
      ],
      "availableInventoryThreshold": 0,
      "displayUrgencyMessage": false
    },
    {
      "id": 425046,
      "roomTypeName": "3 Bedroom Villa at Mountain Villas",
      "roomExternalCode": "M3BDR",
      "pmsRoomExternalCode": "M3BDR",
      "maxOccupancy": 8,
      "maxAdultOccupancy": 8,
      "maxChildOccupancy": 7,
      "description": "Mountain Villas 1,598 sq. ft. Living room with golf course view, gas fireplace, queen sofa sleeper, recessed LCD TV, Bose Surround Sound system and DVD player, and private 248 sq. ft. patio/balcony. Fully equipped Kitchen with cook and dishware, dishwasher, microwave, stove, refrigerator, breakfast counter and built in work area, and washer/dryer. Master bedroom with double French door entry, king bed, golf course view, wall mounted LCD TV, gas fireplace, window seat, wall safe and balcony/patio access. Master bath with garden soaking tub, walk-in glass shower with two head shower, and double sink vanity. Two guest bedrooms, one with king bed and other with two queen beds.",
      "roomFeatures": [
        {
          "amenityName": "People",
          "quantity": 8,
          "type": "Occupancy"
        },
        {
          "amenityName": "King Bed",
          "quantity": 2,
          "type": "Beds",
          "amenityCode": "119"
        },
        {
          "amenityName": "Queen Bed",
          "quantity": 2,
          "type": "Beds",
          "amenityCode": "182"
        },
        {
          "amenityName": "Sofa Bed",
          "quantity": 1,
          "type": "Beds",
          "amenityCode": "217"
        },
        {
          "amenityName": "Sq ft / 148 Sq m",
          "quantity": 1598,
          "type": "Size"
        }
      ],
      "amenities": [
        {
          "amenityName": "Air Conditioned",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "10"
        },
        {
          "amenityName": "Alarm Clock",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "12"
        },
        {
          "amenityName": "Balcony",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "17"
        },
        {
          "amenityName": "Bathtub",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "20"
        },
        {
          "amenityName": "Coffeemaker",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "51"
        },
        {
          "amenityName": "Complimentary Internet Access",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "67502"
        },
        {
          "amenityName": "Cordless Telephone",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "58"
        },
        {
          "amenityName": "Fire Alarm with Light",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "89"
        },
        {
          "amenityName": "Fireplace",
          "sortOrder": 3,
          "isPremiumAmenity": true,
          "amenityCode": "90"
        },
        {
          "amenityName": "Grab Bars in Bathrooms",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "102"
        },
        {
          "amenityName": "Grecian Tub",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "103"
        },
        {
          "amenityName": "Hairdryer In Room",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "106"
        },
        {
          "amenityName": "High Speed Internet",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "127731"
        },
        {
          "amenityName": "Iron",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "113"
        },
        {
          "amenityName": "Ironing Board",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "114"
        },
        {
          "amenityName": "Jacuzzi",
          "sortOrder": 4,
          "isPremiumAmenity": true,
          "amenityCode": "127736"
        },
        {
          "amenityName": "Kitchen",
          "sortOrder": 5,
          "isPremiumAmenity": true,
          "amenityCode": "121"
        },
        {
          "amenityName": "Microwave",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "137"
        },
        {
          "amenityName": "Mountain View",
          "sortOrder": 2,
          "isPremiumAmenity": true,
          "amenityCode": "145"
        },
        {
          "amenityName": "Personal Refrigerator",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "186"
        },
        {
          "amenityName": "Radio",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "184"
        },
        {
          "amenityName": "Shower",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "204"
        },
        {
          "amenityName": "Sitting Area",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "210"
        },
        {
          "amenityName": "Smoke Detectors",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "216"
        },
        {
          "amenityName": "Telephone",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "225"
        },
        {
          "amenityName": "Terrace",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "231"
        },
        {
          "amenityName": "Toilet",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "235"
        },
        {
          "amenityName": "TV",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "240"
        },
        {
          "amenityName": "WC",
          "sortOrder": 0,
          "isPremiumAmenity": false,
          "amenityCode": "253"
        }
      ],
      "sortOrder": 8,
      "mainImage": null,
      "media": [],
      "roomUpgradeOptions": [],
      "availableInventoryThreshold": 0,
      "displayUrgencyMessage": false
    }
  ],
  "roomCategories": []
	}';
	
	//$roomTypes=$booking_array['guestRooms'];
	$json  = json_decode($booking_array);
	$json1  = json_encode($json);
    $booking_array_test = json_decode($json1, true);
	
	$roomTypes=$booking_array_test['guestRooms'];
	foreach($roomTypes as $roomTypeskey =>$roomTypesvalue){
		 $node;
		 $target_id_bed=array();
	     $revision_id_bed=array();
	     $target_id_occupancy=array();
	     $revision_id_occupancy=array();
		 $target_id=99939;
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