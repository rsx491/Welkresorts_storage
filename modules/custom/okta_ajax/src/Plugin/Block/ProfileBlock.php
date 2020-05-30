<?php

namespace Drupal\okta_ajax\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;

use Drupal\Core\Cache\UncacheableDependencyTrait;

//use Drupal\okta_ajax\Controller\OktaLoginController;

//use Okta\Exception as OktaException;
//use Okta\Resource\Authentication;

/**
 * Provides a block for  Okta authentication via ajax
 *
 * @Block(
 *   id = "okta_ajax_profile_block",
 *   admin_label = @Translation("User Profile with Okta"),
 * )
 */
class ProfileBlock extends BlockBase {
/**
 * {@inheritdoc}
 */

  use UncacheableDependencyTrait;
  
  public function build() {
    $items = array();
    //$oc = new OktaLoginController();
    //$oc->checkRegistrationHook();
    return array(
      '#items' => $items,
      '#theme' => 'okta_ajax_profile',
      '#attached' => array(
        'library' => array('okta_ajax/okta_widget'),
       ),
     );
  }

  public function getCacheMaxAge() {
    return 0;
  }

}
