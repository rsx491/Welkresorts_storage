<?php

namespace Drupal\okta_ajax\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;

//use Okta\Exception as OktaException;
//use Okta\Resource\Authentication;

/**
 * Provides a block for  Okta authentication via ajax
 *
 * @Block(
 *   id = "okta_ajax_block",
 *   admin_label = @Translation("Okta Ajax Widget"),
 * )
 */
class AuthBlock extends BlockBase {
/**
 * {@inheritdoc}
 */
  public function build() {
    $items = array();
    return array(
      '#items' => $items,
      '#theme' => 'okta_ajax_auth',
      '#attached' => array(
        'library' => array('okta_ajax/okta_ajax'),
       ),
     );
  }

}
