<?php

namespace Drupal\travelclick\Form;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use CommerceGuys\Addressing\AddressFormat\AddressField;
use Drupal\travelclick\Controller\TravelclickBookingController;
use Drupal\okta_ajax\Controller\OktaLoginController;
use Drupal\okta_ajax\ApiService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Drupal\Component\Render\FormattableMarkup;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;
use MicrosoftAzure\Storage\Table\TableRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
use MicrosoftAzure\Storage\Table\Models\Entity;
use MicrosoftAzure\Storage\Table\Models\QueryEntitiesOptions;
use DateTime;

class BookingForm extends FormBase {
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
			'verify' => true,
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

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'booking_form';
  }

  /**
   * Form constructor.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   The form structure.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $sessionController = new TravelclickBookingController();
    $session_details = $sessionController->sessiondetails();
    $room = substr($session_details->get('room'), 0,1); 
    //$guest = substr($session_details->get('guests'), 0,1);
    $guest_details = $session_details->get('guests');
    $guest = trim(str_replace('Guests', '', $guest_details));
    $checkindate = date('Y-m-d', strtotime($session_details->get('checkin_date')));
    $checkoutdate = date('Y-m-d', strtotime($session_details->get('checkout_date')));
    $discountcode = $session_details->get('promo_code');
    $tagetID = $session_details->get('tid_val');
    $hotelCode = $session_details->get('hotel_code');
    //print_r($session_details); exit;
    $headerController = new TravelclickBookingController();
    $header_block_val = $headerController->getheader2Details();
    $header_query_val = $headerController->getheader1Details($tagetID);
    //Values to be used on the form page
    $form['header_query_val'] = $header_query_val;
    $form['header_block_val'] = $header_block_val;
    $form['session_details'] = $session_details;
    $form['booking_info'] = $session_details->get('booking_details');
    /*to get the logged in user's details */
    $tempstore = \Drupal::service('tempstore.private')->get('okta_ajax');
    $token = $tempstore->get('token');
    $userController = new OktaLoginController();
    $user_details = $userController->introspect($token, 2);

    $reservation_details = $session_details->get('rateplandata');
    $test = '{
  "reservationResponses": [
    {
      "hotelCode": 99939,
      "languageCode": "EN_US",
      "uniqueId": "472321904",
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
          "start": "2019-12-26",
          "end": "2019-12-28",
          "duration": 2
        }
      },
      "resGuests": [
        {
          "uniqueId": {},
          "profile": {
            "shareAllMarketInd": "1",
            "customer": {
              "givenName": "traveler",
              "surName": "Click",
              "telephone": [],
              "email": "travelclick@welk.com",
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
              "ratePlanCode": "3435189",
              "ratePlanType": "Regular",
              "ratePlanName": "Resort Credit Offer",
              "rateExternalCode": "RCD",
              "pmsRateExternalCode": "RCD"
            }
          ],
          "roomRates": [
            {
              "roomTypeCode": "425045",
              "roomTypeName": "2 Bedroom Villa at Resort Villas",
              "numberOfUnits": 1,
              "rates": [
                {
                  "effectiveDate": "2019-12-26",
                  "grossAmountBeforeTax": 509,
                  "discount": 0,
                  "discountIndicator": false,
                  "amountBeforeTax": 509
                },
                {
                  "effectiveDate": "2019-12-27",
                  "grossAmountBeforeTax": 539,
                  "discount": 0,
                  "discountIndicator": false,
                  "amountBeforeTax": 539
                }
              ],
              "mainImage": {
                "type": "main-image",
                "source": "/assets/hotel/99939/media/room/main-image/lwrv_main_enhanced_enhanced.jpg",
                "sortOrder": 0
              },
              "roomExternalCode": "R2BDR",
              "pmsRoomExternalCode": "R2BDR"
            }
          ],
          "depositPayments": {
            "depositAmt": "1175.04"
          },
          "total": {
            "grossAmountBeforeTax": 1048,
            "discount": 0,
            "discountIndicator": false,
            "amountBeforeTax": 1048,
            "amountAfterTax": 1175.04,
            "grossAmountBeforeTaxRoom": 1048,
            "discountRoom": 0,
            "discountIndicatorRoom": false,
            "amountBeforeTaxRoom": 1048,
            "amountAfterTaxRoom": 1175.04,
            "grossAmountBeforeTaxServ": 0,
            "discountServ": 0,
            "discountIndicatorServ": false,
            "amountBeforeTaxServ": 0,
            "taxAmountTotal": 127.04,
            "taxAmountTotalServ": 0,
            "pkgIncTaxAmountTotal": 0
          },
          "taxes": {
            "resortFee": 43.2,
            "serviceCharge": 0
          }
        }
      ],
      "services": [],
      "reservationStatus": "P",
      "policies": {
        "cancellationPolicies": [
          {
            "nonRefundable": false,
            "policyCode": "923736",
            "policyType": "Cancellation",
            "policyDescription": "A 72-Hour Cancellation Policy applies; reservations cancelled within 72 hours of day of arrival will be charged the full amount of their stay.",
            "endDate": "2024-12-31",
            "startDate": "2018-08-29",
            "acceptTender": "",
            "cancellationPenalty": [
              {
                "checkInDate": "2019-12-26",
                "deadLineDate": "2019-12-23",
                "deadLineHour": "16",
                "deadLineDurationHours": "72"
              }
            ]
          }
        ],
        "guaranteePolicies": [
          {
            "policyCode": "494732",
            "policyType": "Deposit",
            "policyDescription": "A credit or debit card is required at the time of booking. A prepayment of one room night is required to secure your reservation. At time of check in, a USD 25.00 per night hold will be applied for any incidentals.",
            "endDate": "2022-12-31",
            "startDate": "1900-09-30",
            "acceptTenderCode": "8",
            "acceptTender": "Credit Card, Alternate Payments",
            "paymntCardTypeList": [
              "15",
              "63",
              "92",
              "145"
            ]
          }
        ],
        "textualPolicies": [
          {
            "policyType": "Terms & Conditions",
            "policyDescription": "Rates subject to change. Complimentary parking available. Hotel/Resort Policies: There is a Credit Card required for this reservation. If you use a debit/credit card to check in, a hold may be placed on your card account for the full anticipated amount to be owed to the hotel, including estimated incidentals, through your date of check-out and such hold may not be released for 72 hours from the date of check-out or longer at the discretion of your card issuer. Check in time is: 4:00pm (PST/PDT) Check out time is: 10:00am (PST/PDT) An hourly fee may be assessed for guests occupying the room beyond check out time. Taxes: Rates do not include transient occupancy tax, state or federal sales tax, and are subject to change prior to arrival without notice. 8.00% per room, per night. Resort Fee: A $20 per day resort fee will charged at time of arrival. The resort fee includes: in-room enhanced wireless internet, fitness center access, access to recreation facilities, tennis facility usage with racquet rental, Mountain and Boulder Springs water-slide access, inter-resort shuttle service, use of barbecue grills, and Sports Yard access. Additional Policies and Regulations: Daily housekeeping services are not provided as the resort is a vacation ownership resort. Daily housekeeping service is available for additional fee and can be arranged at time of arrival through the front desk. Pets are not allowed. Service animals are allowed when accompanying a person with disabilities, as required by the Americans with Disabilities Act (ADA). Comfort animals are not protected under this law and are not allowed at this resort. A $400 fee may be charged for violation of this policy, in addition to any damages assessed by the property by the animal. All Welk Resorts are non-smoking resorts. Smoking in the guest room or villa will be subjected to a $250 cleaning fee. Please smoke only in designated outdoor smoking areas."
          },
          {
            "policyType": "Privacy Policy",
            "policyDescription": "At Welk Resorts, we are dedicated to protecting your privacy and safeguarding your personally identifiable information. Welk Resorts’ mission is to consistently exceed our guests’ expectations in terms of the products and services we provide to our owners, business and leisure travelers. We strive to create an experience that is responsive to our guests’ needs by using the information you entrust us with responsibly. Welk Resorts is committed to respecting your privacy and adhering to the principles of applicable data protection and privacy laws throughout the world. Please visit https://welkresorts.com/privacy/ to read our complete privacy statement."
          }
        ]
      },
      "itineraryId": "60657829",
      "id": 0,
      "isMerchandisedBooking": false,
      "merchandisedCurrencyExchgRate": 1,
      "isPeStrikeThroughEnabled": true,
      "merchandisedPromoData": {},
      "deviceSessionId": null,
      "sessionId": null,
      "hotelInfo": {
        "hotelSettings": {
          "enableFlexibleTaxes": false
        }
      }
    },
    {
      "hotelCode": 99939,
      "languageCode": "EN_US",
      "uniqueId": "472317789",
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
          "start": "2019-12-26",
          "end": "2019-12-28",
          "duration": 2
        }
      },
      "resGuests": [
        {
          "uniqueId": {},
          "profile": {
            "shareAllMarketInd": "1",
            "customer": {
              "givenName": "traveler",
              "surName": "Click",
              "telephone": [],
              "email": "travelclick@welk.com",
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
              "ratePlanCode": "3435189",
              "ratePlanType": "Regular",
              "ratePlanName": "Resort Credit Offer",
              "rateExternalCode": "RCD",
              "pmsRateExternalCode": "RCD"
            }
          ],
          "roomRates": [
            {
              "roomTypeCode": "425045",
              "roomTypeName": "2 Bedroom Villa at Resort Villas",
              "numberOfUnits": 1,
              "rates": [
                {
                  "effectiveDate": "2019-12-26",
                  "grossAmountBeforeTax": 509,
                  "discount": 0,
                  "discountIndicator": false,
                  "amountBeforeTax": 509
                },
                {
                  "effectiveDate": "2019-12-27",
                  "grossAmountBeforeTax": 539,
                  "discount": 0,
                  "discountIndicator": false,
                  "amountBeforeTax": 539
                }
              ],
              "mainImage": {
                "type": "main-image",
                "source": "/assets/hotel/99939/media/room/main-image/lwrv_main_enhanced_enhanced.jpg",
                "sortOrder": 0
              },
              "roomExternalCode": "R2BDR",
              "pmsRoomExternalCode": "R2BDR"
            }
          ],
          "depositPayments": {
            "depositAmt": "1175.04"
          },
          "total": {
            "grossAmountBeforeTax": 1048,
            "discount": 0,
            "discountIndicator": false,
            "amountBeforeTax": 1048,
            "amountAfterTax": 1175.04,
            "grossAmountBeforeTaxRoom": 1048,
            "discountRoom": 0,
            "discountIndicatorRoom": false,
            "amountBeforeTaxRoom": 1048,
            "amountAfterTaxRoom": 1175.04,
            "grossAmountBeforeTaxServ": 0,
            "discountServ": 0,
            "discountIndicatorServ": false,
            "amountBeforeTaxServ": 0,
            "taxAmountTotal": 127.04,
            "taxAmountTotalServ": 0,
            "pkgIncTaxAmountTotal": 0
          },
          "taxes": {
            "resortFee": 43.2,
            "serviceCharge": 0
          }
        }
      ],
      "services": [],
      "reservationStatus": "P",
      "policies": {
        "cancellationPolicies": [
          {
            "nonRefundable": false,
            "policyCode": "923736",
            "policyType": "Cancellation",
            "policyDescription": "A 72-Hour Cancellation Policy applies; reservations cancelled within 72 hours of day of arrival will be charged the full amount of their stay.",
            "endDate": "2024-12-31",
            "startDate": "2018-08-29",
            "acceptTender": "",
            "cancellationPenalty": [
              {
                "checkInDate": "2019-12-26",
                "deadLineDate": "2019-12-23",
                "deadLineHour": "16",
                "deadLineDurationHours": "72"
              }
            ]
          }
        ],
        "guaranteePolicies": [
          {
            "policyCode": "494732",
            "policyType": "Deposit",
            "policyDescription": "A credit or debit card is required at the time of booking. A prepayment of one room night is required to secure your reservation. At time of check in, a USD 25.00 per night hold will be applied for any incidentals.",
            "endDate": "2022-12-31",
            "startDate": "1900-09-30",
            "acceptTenderCode": "8",
            "acceptTender": "Credit Card, Alternate Payments",
            "paymntCardTypeList": [
              "15",
              "63",
              "92",
              "145"
            ]
          }
        ],
        "textualPolicies": [
          {
            "policyType": "Terms & Conditions",
            "policyDescription": "Rates subject to change. Complimentary parking available. Hotel/Resort Policies: There is a Credit Card required for this reservation. If you use a debit/credit card to check in, a hold may be placed on your card account for the full anticipated amount to be owed to the hotel, including estimated incidentals, through your date of check-out and such hold may not be released for 72 hours from the date of check-out or longer at the discretion of your card issuer. Check in time is: 4:00pm (PST/PDT) Check out time is: 10:00am (PST/PDT) An hourly fee may be assessed for guests occupying the room beyond check out time. Taxes: Rates do not include transient occupancy tax, state or federal sales tax, and are subject to change prior to arrival without notice. 8.00% per room, per night. Resort Fee: A $20 per day resort fee will charged at time of arrival. The resort fee includes: in-room enhanced wireless internet, fitness center access, access to recreation facilities, tennis facility usage with racquet rental, Mountain and Boulder Springs water-slide access, inter-resort shuttle service, use of barbecue grills, and Sports Yard access. Additional Policies and Regulations: Daily housekeeping services are not provided as the resort is a vacation ownership resort. Daily housekeeping service is available for additional fee and can be arranged at time of arrival through the front desk. Pets are not allowed. Service animals are allowed when accompanying a person with disabilities, as required by the Americans with Disabilities Act (ADA). Comfort animals are not protected under this law and are not allowed at this resort. A $400 fee may be charged for violation of this policy, in addition to any damages assessed by the property by the animal. All Welk Resorts are non-smoking resorts. Smoking in the guest room or villa will be subjected to a $250 cleaning fee. Please smoke only in designated outdoor smoking areas."
          },
          {
            "policyType": "Privacy Policy",
            "policyDescription": "At Welk Resorts, we are dedicated to protecting your privacy and safeguarding your personally identifiable information. Welk Resorts’ mission is to consistently exceed our guests’ expectations in terms of the products and services we provide to our owners, business and leisure travelers. We strive to create an experience that is responsive to our guests’ needs by using the information you entrust us with responsibly. Welk Resorts is committed to respecting your privacy and adhering to the principles of applicable data protection and privacy laws throughout the world. Please visit https://welkresorts.com/privacy/ to read our complete privacy statement."
          }
        ]
      },
      "itineraryId": "60657829",
      "id": 0,
      "isMerchandisedBooking": false,
      "merchandisedCurrencyExchgRate": 1,
      "isPeStrikeThroughEnabled": true,
      "merchandisedPromoData": {},
      "deviceSessionId": null,
      "sessionId": null,
      "hotelInfo": {
        "hotelSettings": {
          "enableFlexibleTaxes": false
        }
      }
    }
  ],
  "languageCode": "EN_US",
  "itineraryId": "60657829",
  "itineraryTotals": {
    "itineraryRoomSubTotal": 2096,
    "itineraryResortFeeTotal": 86.4,
    "itineraryServiceChargeTotal": 0,
    "itineraryRoomTotalTaxes": 254.08,
    "itineraryRoomGrandTotal": 2350.08,
    "itineraryInTotalExclusiveResortFeeTotal": 0,
    "itineraryInTotalExclusiveServiceChargeTotal": 0,
    "itineraryInTotalExclusiveTaxTotal": 0,
    "itineraryOutTotalExclusiveResortFeeTotal": 0,
    "itineraryOutTotalExclusiveServiceChargeTotal": 0,
    "itineraryOutTotalExclusiveTaxTotal": 0,
    "itineraryOutTotalInclusiveResortFeeTotal": 0,
    "itineraryOutTotalInclusiveServiceChargeTotal": 0,
    "itineraryOutTotalInclusiveTaxTotal": 0,
    "itineraryTaxAmountTotalServ": 0,
    "itineraryPkgIncTaxAmountTotal": 0
  },
  "itineraryPaymentInfo": {
    "itineraryDepositAmt": 2350.08
  },
  "chinaDomain": false
}';
    $reservation_details = json_decode($test);
    $form['num_rooms'] = sizeof($reservation_details->reservationResponses)-1;
    $form['itinerary_amount_details'] = $reservation_details->itineraryTotals;
    $form['amount_to_be_paid'] = $reservation_details->itineraryPaymentInfo->itineraryDepositAmt;
    $booking_details = array();
    /* Select Queries for b room booking details */
    $azure = $sessionController->db_connection();
    $tbl_booking = 'roomBookingDetail';
    $tbl_itinery = 'itinerary';
    foreach($reservation_details->reservationResponses as $num=>$room) {
      $booking_details[$num]['booking_id'] = $room->uniqueId;
      $booking_details[$num]['duration'] = $room->resGlobalInfo->timeSpan->duration;
      $booking_details[$num]['room_code'] = $room->roomStays[0]->roomRates[0]->roomTypeCode;
      $booking_details[$num]['room_name'] = $room->roomStays[0]->roomRates[0]->roomTypeName;
      $booking_details[$num]['rate_code'] = $room->roomStays[0]->ratePlans[0]->ratePlanCode;
      $booking_details[$num]['rate_name'] = $room->roomStays[0]->ratePlans[0]->ratePlanName;
      $booking_details[$num]['room_rate'] = $room->roomStays[0]->total->amountBeforeTax;
      //Fetching details from the azure DB
      try {
        //$bookin_details_datas = $azure->getEntity($tbl_booking,'booking_details',$room->uniqueId);
        $bookin_details_datas = $azure->getEntity($tbl_booking,'booking_details',472316283);
      //$booking_detail_data[] = array('booking_detail_data'=>$bookin_details_datas);
      } catch (ServiceException $e) {     
      }
      $entity = $bookin_details_datas->getEntity();
      $booking_details[$num]['currency'] = $entity->getPropertyValue("currency");
      $booking_details[$num]['currency_code'] = $entity->getPropertyValue("currency_code");
      $booking_details[$num]['rate_overview'] = $entity->getPropertyValue("rate_overview");
      $booking_details[$num]['deposit_policy'] = $entity->getPropertyValue("deposit_policy");
      $booking_details[$num]['cancellation_policy'] = $entity->getPropertyValue("cancellation_policy");
      $booking_details[$num]['resort_fee'] = $entity->getPropertyValue("room_total_resort_fee");
      $rate_plan = json_decode($entity->getPropertyValue("rate_per_day"), true);
      foreach($rate_plan as $rate_date_key=>$rate_date_value){
        $data_html = array();
            foreach($rate_date_value as $key=>$value){
              $data_html[] = '<td></td><td>'.date("D,M d Y",$key).'</td>								
              <td>'.$value.'</td>';
            }
            $data_value[] = '<tr>'.implode('</tr><tr> ', $data_html).'</tr>';
        }
      $booking_details[$num]['rate_per_day'] = implode('',$data_value);
    }
    $form['booking_details'] = $booking_details;
//print_r($booking_details); exit;
    //Form elements
    $form['first_name'] = array(
      '#type' => 'textfield',
      '#title' => t('FIRST NAME:'),
      '#required' => TRUE,
      '#default_value' => ($user_details->active)?$user_details->given_name:NULL,
    );
    $form['last_name'] = array(
        '#type' => 'textfield',
        '#title' => t('LAST NAME:'),
        '#required' => TRUE,
        '#default_value' => ($user_details->active)?$user_details->family_name:NULL,
      );
    $form['email'] = array(
      '#type' => 'email',
      '#title' => t('EMAIL:'),
      '#required' => TRUE,
      '#default_value' => ($user_details->active)?$user_details->email:NULL,
    );
    $form['phone'] = array (
      '#type' => 'tel',
      '#title' => t('PHONE:'),
      '#required' => TRUE,
    );
    /*$form['home_address'] = array (
      '#type' => 'address',
      '#title' => t('COUNTRY/REGION'),
      '#required' => TRUE,
    );*/
    // Create our contact information section.
    /*$form['site_location'] = [
      '#type' => 'details',
      '#title' => t('Site Location'),
      '#open' => TRUE,
    ];
  
    $form['site_location']['address'] = [
      '#type' => 'fieldset',
      '#title' => t('Address'),
    ];*/
  
    // Create the address field.
    $form['site_address'] = [
      '#type' => 'address',
      '#default_value' => \Drupal::config('system.site')->get('site_address') ?? [
        'country_code' => 'US',
      ],
      '#used_fields' => [
        AddressField::ADDRESS_LINE1,
        AddressField::ADDRESS_LINE2,
        AddressField::ADMINISTRATIVE_AREA,
        AddressField::LOCALITY,
        AddressField::POSTAL_CODE,
      ],
      //'#available_countries' => ['US'],
    ];
    $form['name_card'] = array(
      '#type' => 'textfield',
      '#title' => t('NAME ON CARD:'),
      '#required' => TRUE,
    );
    $form['card_number'] = array(
      '#type' => 'password',
      '#title' => t('CARD NUMBER:'),
      '#required' => TRUE,
    );
    $months = array(
                '1' => "January",
                '2' => "February",
                '3' => "March",
                '4' => "April",
                '5' => "May",
                '6' => "June",
                '7' => "July",
                '8' => "August",
                '9' => "September",
                '10' => "October",
                '11' => "November",
                '12' => "December"
              );
    $form['expiration_month'] = array(
      '#type' => 'select',
      '#title' => t('EXPIRATION MONTH:'),
      '#options' => $months,
      '#required' => TRUE,
    );
    $years = array(
                '2019' => '2019',
                '2020' => '2020',
                '2021' => '2021',
                '2022' => '2022',
                '2023' => '2023',
                '2024' => '2024',
                '2025' => '2025',
                '2026' => '2026',
                '2027' => '2027',
                '2028' => '2028',
              );
    $form['expiration_year'] = array(
      '#type' => 'select',
      '#title' => t('EXPIRATION YEAR:'),
      '#options' => $years,
      '#required' => TRUE,
    );
    $form['cvv'] = array(
      '#type' => 'password',
      '#title' => t('CVV NUMBER:'),
      '#required' => TRUE,
    );
    $form['billing'] = array(
      '#type' => 'radios',
      '#title' => t('CARD NUMBER:'),
      '#options' => array(
                      t('Same as Home Addresss'),
                      t('Enter a Different Billing Address'),
                    )
    );
    $form['billing_address'] = [
      '#type' => 'address',
      '#default_value' => \Drupal::config('system.site')->get('billing_address') ?? [
        'country_code' => 'US',
      ],
      '#used_fields' => [
        AddressField::ADDRESS_LINE1,
        AddressField::ADDRESS_LINE2,
        AddressField::ADMINISTRATIVE_AREA,
        AddressField::LOCALITY,
        AddressField::POSTAL_CODE,
      ],
    ];
    $cashback_val = 0.05*$reservation_details->itineraryTotals->itineraryRoomSubTotal;
    $cashreward_val = 0.15*$reservation_details->itineraryTotals->itineraryRoomSubTotal;
    $form['cash_reward'] = array(
      '#type' => 'checkbox',
      '#title' => "Yes, enroll in The Guestbook <img src='dest/images/info-icon-grey.svg' /> now for
      your choice of: <strong>".$booking_details[0]['currency_code'].$cashback_val." Cash Back</strong>, or <strong>".$booking_details[0]['currency_code'].$cashback_val." Charitable
         Donation</strong>, or <strong>".$booking_details[0]['currency_code'].$cashreward_val." Cash Rewards</strong> (see <a href='#'
         class='change-room-link'>Terms of Use</a>)."
    );
    $form['subscription'] = array(
      '#type' => 'checkbox',
      '#title' => "Yes, opt me in to receive emails about <strong>Welk exclusive offers, insider tips,
      and more</strong>."
    );
    $form['tnc'] = array(
      '#type' => 'checkbox',
      '#title' => "Yes, I have read and agree to the <a href='#' class='change-room-link'>Terms &
      Conditions</a> and <a href='#' class='change-room-link'>Privacy Policy</a>."
    );
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Book Reservation'),
      '#button_type' => 'primary',
    );
    $form['#theme'] = 'resort_booking_form';
    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    //parent::submitForm($form, $form_state);
    //$instance = TravelclickBookingController::paymentinformation();
    $session = \Drupal::request()->getSession();
    $session->set('clicked', NULL); // unset session variable
    $azureEntry = $this->bookingdetailsentry($form, $form_state);
    $finalHoldCall = $this->finalHoldReservationCall($form, $form_state);
    $holdresponse = json_decode($finalHoldCall);
    if(isset($holdresponse[reservationResponses])) {
      $reservationCall = $this->reservationCall($form, $form_state);
    }else {
      
    }
    //$paymentInfo = $this->paymentinformation($form, $form_state);
    
    //parent::submitForm($form, $form_state);
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  public function preparebody($form, $form_state) {
    $newsessionController = new TravelclickBookingController();
    $newsession_details = $newsessionController->sessiondetails();
    $bookingDetails = array();
    $selectRateResponse = $newsession_details->get('rateplandata');
    foreach($selectRateResponse['reservationResponses'] as $num=>$room) {
      $bookingDetails['hotel_code'] = $room->hotelCode;
      $selectRateResponse['reservationResponses'][$num]->resGuests[0]->profile->customer->givenName = $form_state->getValue('first_name');
      $selectRateResponse['reservationResponses'][$num]->resGuests[0]->profile->customer->surName = $form_state->getValue('last_name');
      $selectRateResponse['reservationResponses'][$num]->resGuests[0]->profile->customer->email = $form_state->getValue('email');
    }
    $finalHoldReq = array();
    $finalHoldReq['hotelCode'] = $newsession_details->get('hotel_code');
    $finalHoldReq['languageCode'] = $selectRateResponse['languageCode'];
    $finalHoldReq['itineraryId'] = $selectRateResponse['itineraryId'];
    $finalHoldReq['reservationRequestParams'] = $selectRateResponse['reservationResponses'];
    $bookingDetails['request_body'] = json_encode($finalHoldReq);
    return $bookingDetails;
  }

  public function finalHoldReservationCall($form, $form_state){
    $bookingDetails = preparebody($form, $form_state);
    $api_base = $this->api_base;
    $url = $api_base.'book/v1/hotel/'.$bookingDetails['hotel_code'].'/hold-reservation/multi-room';
    $token = $this->getToken();
		try {
			$response = \Drupal::httpClient()->post( $url , [
				'body' =>$bookingDetails['request_body'],
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
    return $data;
  }

  public function reservationCall($form, $form_state){
    $bookingDetails = preparebody($form, $form_state);
    $api_base = $this->api_base;
    $url = $api_base.'book/v1/hotel/'.$bookingDetails['hotel_code'].'/reservation/multi-room';
    $token = $this->getToken();
		try {
			$response = \Drupal::httpClient()->post( $url , [
				'body' =>$bookingDetails['request_body'],
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
    return $data;
  }

  public function bookingdetailsentry($form, $form_state){
    $messenger = \Drupal::messenger();
    $email = $form_state->getValue('email');
    /*
    //Fetch existing Okta user or create a new one based on the email submitted
    $okta_api = \Drupal::service('okta_ajax.api');
    $okta_user = false;
    try { $okta_user = $okta_api->getUserByEmail( $email);  
    } catch ( Exception $e ) { }
    
    if(!$okta_user) {
      //create user if one doesn't exist and send email with password
      $pwd = $okta_api->generateStrongPassword(9, false, 'lud');
      $okta_user = $okta_api->createUser($form_state->getValue('email'), $pwd, $form_state->getValue('first_name'), $form_state->getValue('last_name') );
      if( !$okta_user) { 
        throw new Exception("Unable to save user"); 
      } else {
        \Drupal::logger('okta_ajax')->notice("Created okta user ( ".$email." ) id: ".$okta_user->id." during booking submission"); 
        $messenger->addMessage("Registered new user ".$email." / ".$pwd); 
      }
    } else {
      \Drupal::logger('okta_ajax')->notice("Submitted booking for existing Okta user ( ".$email." ) id: ".$okta_user->id);
    }    
    */
    //Save form to Azure table as a demonstration. This should be moved to another class or service with each itinerary object containing its own schema and validation

    //$key = \Drupal::config('okta_ajax.settings')->get('azure_key');
    $key = "0wKvm82qfHR7TREINfZN9LCuCLV28nonuDkOAvz4ri9uOJ7dDhxqo4BuU7Bbs//V3p0NVX4cqxZGBrFf7ieg0g==";
    //$account = \Drupal::config('okta_ajax.settings')->get('azure_account');
    $account = "welkresortsdevdata001";
    $connectionString = 'DefaultEndpointsProtocol=https;AccountName='.$account.';AccountKey='.$key.';EndpointSuffix=core.windows.net';
    $azure = TableRestProxy::createTableService($connectionString);

    $tbl_guests = 'guestDetails';
    $tbl_itin = 'itineraries';
    $tbl_room = 'roomBookingDetails';

    //check if user already has row in guest details
    $guests_row = false;
    try {
      $guests_row = $azure->getEntity($tbl_guests,'guest_details',$email);
    } catch (ServiceException $e) {
      
    }
    if( !$guests_row) {
      //create new guest details
      $newRow = new Entity();
      $newRow->setPartitionKey('guest_details');
      $newRow->setRowKey($email);
      $newRow->addProperty('first_name', 'Edm.String', $form_state->getValue('first_name') );
      $newRow->addProperty('last_name', 'Edm.String', $form_state->getValue('last_name') );
      $newRow->addProperty('subscription', 'Edm.Boolean', ($form_state->getValue('subscription')?true:false) );
      $azure->insertOrMergeEntity($tbl_guests, $newRow);
      $guests_row = $newRow;
    }

    //TODO:: where to get the actual reservation details?
    $sessionController  = new TravelclickBookingController();
    $sess  = $sessionController->sessiondetails();
    $booking_details = $sess->get('booking_details');
    $it_id = uniqid();
    $itin = new Entity();
    $itin->setPartitionKey($email);
    $itin->setRowKey($it_id);
    $itin->addProperty('check_in_date','Edm.DateTime', new DateTime($sess->get('checkin_date')) );
    $itin->addProperty('check_out_date','Edm.DateTime', new DateTime($sess->get('checkout_date')) );
    //$itin->addProperty('hotel_code','Edm.String', $sess->get('hotel_code') );
    $itin->addProperty('hotel_code','Edm.String', 'WLK99939' );
    //$itin->addProperty('adults','Edm.Int32', $sess->get('guests'));
    $itin->addProperty('adults','Edm.Int32', 2);
    //set empty properties that will need to be filled in correctly later
    //TODO:: correctly load these values in from session/booking data
    $empty_props = ['rooms','duration','currency','total_savings','total_resort_fee','total_tax','total_amount_before_tax','total_amount','total_amount_paid','status','guestbook_flag','tnc_flag','vacation_guard_flag'];
    foreach($empty_props as $v){
      $itin->addProperty($v, 'Edm.String', '');
    }
    $azure->insertOrMergeEntity($tbl_itin, $itin);
    $messenger->addMessage("Created a new itinerary id: ".$it_id." for ".$sess->get('checkin_date')." to ".$sess->get('checkout_date'));

    //create room booking entries tied to this itinerary
    foreach($booking_details['room_details'] as $v) {
      $rm_id = uniqid();
      $room = new Entity();
      $room->setPartitionKey($it_id);
      $room->setRowKey($rm_id);
      //convert to json any non-string values, like the rate_details arrays and add them as a property
      foreach($v as $field=>$data) {
        if( !is_string($data) ) {
          $data = json_encode($data);
        }
        $room->addProperty($field, 'Edm.String', $data);
      }
      $messenger->addMessage("Saved details for room [".$v['room_name']."] ");
      $azure->insertOrMergeEntity($tbl_room, $room);
    }


    
    $messenger->addMessage("Saved booking details");
    $all = $messenger->all();
    return new JsonResponse($all);
  }

  public function paymentinformation($form, $form_state){
		
    $card_name =                $form_state->getValue('name_card');
    $card_number=               $form_state->getValue('card_number');  
    $card_expiration_month=     $form_state->getValue('expiration_month');
    $card_expiration_year=      $form_state->getValue('expiration_year');
    $card_cvv_number=           $form_state->getValue('cvv');
    $billing_address =          $form_state->getValue('billing_address');
    $billing_address_country=   $billing_address['country_code'];
    $billing_address_street_ln1=$billing_address['address_line1'];
    $billing_address_street_ln2=$billing_address['address_line2'];
    $billing_address_city=      $billing_address['locality'];
    $billing_address_state=     $billing_address['administrative_area'];
    $billing_address_zipcode=   $billing_address['postal_code'];

		$api_base = 'https://s4paymentservices-dev.azurewebsites.net/';
		$shif4_url = $api_base.'api/PaymentService/PaymentInformation';
		//shift4 body
		$body = '{
			"i4go_cardnumber": "'.$card_number.'", 
			"i4go_expirationmonth" : "'.$card_expiration_month.'",
			"i4go_expirationyear" : "'.$card_expiration_year.'",
			"i4go_cvv2code" : "'.$card_cvv_number.'",
			"i4go_postalcode": "'.$billing_address_zipcode.'",
			"i4go_streetaddress":"'.$billing_address_street_ln1.'"
		}';
		
		try
		{
			$response = \Drupal::httpClient()->post( $shif4_url , [
				'body' =>$body,
				'headers' => [
				
					'Content-Type' => 'application/json',
				],
			]);
			$data = $response->getBody()->getContents();
			//if (empty($data)) {

				$obj = json_decode($data);
				$invoiceNumber = $obj->otn->invoice;
				$reference =  $obj->otn->reference;
				$uniqueId = $obj->i4go_uniqueid;

				$this->SalePurchase($invoiceNumber,$reference,$uniqueId);
				$this->invoice($invoiceNumber);
				$this->refund($invoiceNumber,$uniqueId);
				$this->deleteInvoice($invoiceNumber);
				//return FALSE;
			//}
		}
		catch (GuzzleException $error) {
			$response = $error->getMessage();
			\Drupal::logger('Pay reservation')->notice($response);
			// Logs an error
			\Drupal::logger('Pay reservation')->error($response);
			 throw $error;
		}	
  }
  
  public function SalePurchase($invoiceNumber, $reference, $uniqueId)
	{
		$api_base = 'https://s4paymentservices-dev.azurewebsites.net/';
		$shif4_url = $api_base.'api/PaymentService/SalePurchase';
		//shift4 body
		$body = '{
					"amount": {
						"tax" : "1",
						"total": "111.45"
					},
					"clerk":{
						"numberId":1
					},
					"transaction":{
						"invoice": "'.$invoiceNumber.'",
						"purchaseCard":{
							"customerReference": "'.$reference.'",
							"destinationPostalCode": "65000",
							"productDescriptors":"Reservation"
						},
						"hotel":{
							"arrivalDateTime":"2019-11-16T08:26:49-8:00",
							"departureDateTime":"2019-11-17T08:26:49-8:00",
							"roomRates":[{
								"nights":1,
								"rate":"111.45"
							}]
						}
					},
					"card":{
						"present": "N",
						"token":{
							"value":"'.$uniqueId.'"
						}
					}
				}';

		try
		{
			$response = \Drupal::httpClient()->post( $shif4_url , [
				'timeout' => 60000,
				'body' =>$body,
				'headers' => [
				
					'Content-Type' => 'application/json',
				],
			]);
			$data = $response->getBody()->getContents();
			if (empty($data)) {
				return FALSE;
			}
		}
		catch (GuzzleException $error) {
			$response = $error->getMessage();
			\Drupal::logger('Pay reservation')->notice($response);
			// Logs an error
			\Drupal::logger('Pay reservation')->error($response);
			 throw $error;
		}	
  }
  
  //GET api/PaymentService/Invoice/{invoiceNumber}
	public function invoice($invoiceNumber)
	{
		$api_base = 'https://s4paymentservices-dev.azurewebsites.net/';
		$shif4_url = $api_base.'api/PaymentService/Invoice/'.$invoiceNumber;		
		try {
			$response = \Drupal::httpClient()->get( $shif4_url , [
				'timeout' => 800,
				
				'headers' => [
				
					'accept'	=> 'application/json',
				],
			]);
			$data = $response->getBody()->getContents();
			if (empty($data)) {
				return FALSE;
			}
		}
		catch (GuzzleException $error) {
			$response = $error->getMessage();
			\Drupal::logger('Pay reservation')->notice($response);
			// Logs an error
			\Drupal::logger('Pay reservation')->error($response);
			 throw $error;
		}	
  }
  
  //POST api/PaymentService/Refund 
	public function refund($invoiceNumber,$uniqueId)
	{
		$api_base = 'https://s4paymentservices-dev.azurewebsites.net/';
		$shif4_url = $api_base.'api/PaymentService/Refund';

		$body = '{
			"amount": {
				
				"total": "112.61"
			},
			"clerk":{
				"numberId":1
			},
			"transaction":{
				"invoice": "'.$invoiceNumber.'"
				
			},
			"card":{
				"present": "N",
				"token":{
					"serialNumber":0,
					"value":"'.$uniqueId.'"
				}
			}
		}';

		try
		{
			$response = \Drupal::httpClient()->post( $shif4_url , [
				'timeout' => 60000,
				'body' =>$body,
				'headers' => [
				
					'Content-Type' => 'application/json',
				],
			]);
			$data = $response->getBody()->getContents();
			if (empty($data)) {
				return FALSE;
			}
		}
		catch (GuzzleException $error) {
			$response = $error->getMessage();
			\Drupal::logger('Pay reservation')->notice($response);
			// Logs an error
			\Drupal::logger('Pay reservation')->error($response);
			throw $error;
		}	
  }
  
  public function deleteInvoice($invoiceNumber)
	{
		$api_base = 'https://s4paymentservices-dev.azurewebsites.net/';
		$shif4_url = $api_base.'api/PaymentService/Void/'.$invoiceNumber;

		try {
			$response = \Drupal::httpClient()->delete( $shif4_url , [
				'timeout' => 800,
				
				'headers' => [
				
					'accept'	=> 'application/json',
				],
			]);
			$data = $response->getBody()->getContents();
			if (empty($data)) {
				return FALSE;
			}
		}
		catch (GuzzleException $error) {
			$response = $error->getMessage();
			\Drupal::logger('Pay reservation')->notice($response);
			// Logs an error
			\Drupal::logger('Pay reservation')->error($response);
			 throw $error;
		}	
	}

}