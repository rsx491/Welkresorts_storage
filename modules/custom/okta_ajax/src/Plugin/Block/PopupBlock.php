<?php

namespace Drupal\okta_ajax\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;

use Drupal\Core\Cache\UncacheableDependencyTrait;



/**
 * Provides a block for  Okta authentication via ajax
 *
 * @Block(
 *   id = "okta_ajax_popup_block",
 *   admin_label = @Translation("Okta Popup Button"),
 * )
 */
class PopupBlock extends BlockBase {
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
      '#theme' => 'okta_ajax_popup',
      '#attached' => array(
        'library' => array('okta_ajax/okta_widget'),
       ),
     );
  }

  public function getCacheMaxAge() {
    return 0;
  }

}
