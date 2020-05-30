<?php

namespace Drupal\travelclick\Plugin\WebformHandler;
 
use Drupal\Core\Form\FormStateInterface;
use Drupal\webform\Plugin\WebformHandlerBase;
use Drupal\webform\WebformSubmissionInterface;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Drupal\Core\TempStore\PrivateTempStoreFactory;
/**
* Form submission handler.
*
* @WebformHandler(
*   id = "travelclick",
*   label = @Translation("Booking form"),
*   category = @Translation("Form Handler"),
*   description = @Translation("Sends submission data"),
*   cardinality = \Drupal\webform\Plugin\WebformHandlerInterface::CARDINALITY_SINGLE,
*   results = \Drupal\webform\Plugin\WebformHandlerInterface::RESULTS_PROCESSED,
* )
*/

class bookingformhandler extends WebformHandlerBase {
	

 /**
  * {@inheritdoc}
  */
 public function defaultConfiguration() {
   return [];
 }

 /**
  * {@inheritdoc}
  */
 public function submitForm(array &$form, FormStateInterface $form_state, WebformSubmissionInterface $webform_submission) {

   // Configure the slack settings and pull an array of the webform data
   $values = $webform_submission->getData();
   //$_SESSION['travelclick']['value1'] = $values;
   //print'<pre>';print_r($values);exit;
   $webform_submission->setSticky(!$webform_submission->isSticky())->save();
   $sid = $webform_submission->id();
   $webform = $this->getWebform();
   $wid = $webform->id();
   
   // The submission URL of the form
   //$submission_url = Url::fromRoute('entity.webform_submission.canonical', ['webform' => $wid, 'webform_submission' => $sid], ['absolute' => TRUE])->toString();

   // Set the form name for the output message depending on which form has been submitted
   if ($wid == 'contact') {
     $type = 'Contact';
   }
   elseif ($wid == 'feedback'){
     $type = 'Feedback';
   }

 //  $output = strip_tags($values['name']) . " has made a new submission to the " . $type . " Webform. Click <$submission_url | here> to view.";

   // This will send your message to Slack.
   

   return true;
 }
}