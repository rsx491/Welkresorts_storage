<?php

namespace Drupal\travelclick\Plugin\Block;

use Drupal\Core\Access\AccessResults;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Routing;

use Drupal\travelclick\Controller\TravelclickBookingController;

/**
 * A block to show booking availability results
 *
 * @Block(
 *   id = "travelclick_availability_block",
 *   admin_label = @Translation("TravelClick Booking Results"),
 * )
 */
class AvailableBlock extends BlockBase {
/**
 * {@inheritdoc}
 */
  public function build() {
	  //print"hi";exit;
    //TODO:: request search results from controller module
    $query = \Drupal::request()->query->all();
    if( !isset($query['check_in_check_out']) ) {
		//print"hi";exit;
    $dates = explode(' - ', $query['check_in_check_out'] );
    $dateIn = explode('/', $dates[0]);
    $dateOut = explode('/', $dates[1]);
    $roomguest = explode(':  ', $query['rooms_guests'] );
    $room = 1; //substr($roomguest[0], 0,1); //only do one room for testing purposes so we dont have to use multi-room api
    $guest = substr($roomguest[1], 0,1);
    $guest = 2;
    $hotel = '8890'; //TODO:: get hotel code from Destination form entry
    $optionals = array(); //can put additional api query parameters here if we add an advanced search later
    $bookingController = new TravelclickBookingController();
    //$booking = $bookingController->searchAvailability($hotel, $dateIn[2].'-'.$dateIn[0].'-'.$dateIn[1], $dateOut[2].'-'.$dateOut[0].'-'.$dateOut[1], $room, $guest, $optionals);
    $booking = $bookingController->searchAvailability($hotel, '2019-10-14', '2019-10-17', $room, $guest);
	//print'<pre>';print_r($booking);exit;
    $roomsList = $bookingController->getRooms($hotel);
    $rooms = array();
    foreach($roomsList as $r){ $rooms[$r->id] = $r; }
    $items = array('booking'=>$booking, 'rooms'=>$rooms);
    } else {
		//print"hello";exit;
	$items = array('Error'=>'No search parameters set', 'q'=>$query);
    }

    return array(
      '#items' => $items,
      '#theme' => 'travelclick_booking',
      '#attached' => array( //don't need a custom library at the moment
        //'library' => array('travelclick_booking/travelclick_booking'),
      ),
    );
  }

}
