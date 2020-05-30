<?php

namespace Drupal\okta_ajax\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Admin form for Okta settings.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * Module Handler.
   *
   * @var \Drupal\Core\Extension\ModuleHandlerInterface
   */
  private $moduleHandler;

  /**
   * Settings constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   Config Factory.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler.
   */
  public function __construct(ConfigFactoryInterface $config_factory,
                              ModuleHandlerInterface $module_handler) {
    parent::__construct($config_factory);
    $this->moduleHandler = $module_handler;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('module_handler')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'okta_ajax_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'okta_ajax.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormTitle() {
    return 'Okta Ajax Settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('okta_ajax.settings');

    $form['okta_ajax'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('OKTA API Settings'),
    ];
    $form['okta_text'] = [
	   '#type' => 'fieldset',
	   '#title' => $this->t('Header Labels'),
    ];
    $form['okta_azure'] = [
      '#type' => 'fieldset',
      '#title' => 'Azure API Settings'
    ];

    $form['okta_ajax']['account_path']=['#type'=>'textfield','#title'=>$this->t('Path to login page'),'#default_value'=>$config->get('account_path')];
    $form['okta_text']['account_title']=['#type'=>'textfield','#title'=>$this->t('Title for sign in page'),'#default_value'=>$config->get('account_title')];
    $form['okta_text']['account_description']=['#type'=>'textfield','#title'=>$this->t('Description for sign in page'),'#default_value'=>$config->get('account_description')];
    $form['okta_ajax']['profile_path']=['#type'=>'textfield','#title'=>$this->t('Path to profile page'),'#default_value'=>$config->get('profile_path')];
    $form['okta_text']['profile_title']=['#type'=>'textfield','#title'=>$this->t('Title for profile page'),'#default_value'=>$config->get('profile_title')];
    $form['okta_text']['profile_description']=['#type'=>'textfield','#title'=>$this->t('Description for profile page'),'#default_value'=>$config->get('profile_description')];


    $form['okta_ajax']['okta_api_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('API Token'),
      '#description' => $this->t('The API token to use.'),
      '#default_value' => $config->get('okta_api_key'),
    ];

    $form['okta_ajax']['okta_client_id'] = ['#type'=>'textfield','#title'=>$this->t('Client ID'),'#default_value'=>$config->get('okta_client_id')];

    $form['okta_ajax']['okta_client_secret'] = ['#type'=>'textfield','#title'=>$this->t('Client Secret'),'#default_value'=>$config->get('okta_client_secret')];


    $form['okta_ajax']['organisation_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your Okta organisation'),
      '#description' => $this->t('The the organisation you have set up in Okta'),
      '#default_value' => $config->get('organisation_url'),
    ];

    $form['okta_ajax']['okta_domain'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your Okta domain'),
      '#description' => $this->t('The the domain your organisation uses to log into Okta'),
      '#default_value' => $config->get('okta_domain'),
    ];

    $form['okta_ajax']['default_group_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Default group ID'),
      '#description' => $this->t('The default group id to add the user to in Okta'),
      '#default_value' => $config->get('default_group_id'),
    ];

    $form['okta_text']['overview_header'] = [
      '#type' => 'textfield',
      '#title'=>$this->t('Account Overview Header'),'#default_value'=>$config->get('overview_header')];
    $form['okta_text']['overview_subtext'] = [
      '#type' => 'textfield',
      '#title'=>$this->t('Account Overview Sub Text'),'#default_value'=>$config->get('overview_subtext')];
    $form['okta_text']['overview_guest_header'] = [
      '#type' => 'textfield',
      '#title'=>$this->t('Account Overview Guest Information'),'#default_value'=>$config->get('overview_guest_header')];
    $form['okta_text']['manage_header'] = [
      '#type' => 'textfield',
      '#title'=>$this->t('Manage Profile Header'),'#default_value'=>$config->get('manage_header')];
    $form['okta_text']['manage_subtext'] = [
      '#type' => 'textfield',
      '#title'=>$this->t('Manage Profile Sub Text'),'#default_value'=>$config->get('manage_subtext')];
    $form['okta_text']['manage_guest_header'] = [
      '#type' => 'textfield',
      '#title'=>$this->t('Profile Guest Info Section'),'#default_value'=>$config->get('manage_guest_header')];
    $form['okta_text']['manage_signin_header'] = [
      '#type' => 'textfield',
      '#title'=>$this->t('Profile Sign-In Section'),'#default_value'=>$config->get('manage_signin_header')];
    $form['okta_text']['manage_email_header'] = [
      '#type' => 'textfield',
      '#title'=>$this->t('Profile Email Section'),'#default_value'=>$config->get('manage_email_header')];

    $form['okta_azure']['azure_key'] = [
      '#type' => 'textfield',
      '#title'=>$this->t('Account Key'),'#default_value'=>$config->get('azure_key')];
    $form['okta_azure']['azure_account'] = [
      '#type' => 'textfield',
      '#title'=>$this->t('Account Name'),'#default_value'=>$config->get('azure_account')];


    // Add checkbox to handle okta preview (oktapreview.com) domain.
    /*$form['okta_ajax']['preview_domain'] = [
      '#type' => 'checkbox',
      '#title' => 'Use Okta preview domain',
      '#description' => $this->t('If checked, API will use the Okta preview (oktapreview.com) domain.'),
      '#return_value' => TRUE,
      '#default_value' => $config->get('preview_domain'),
    ];
    */


    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('okta_ajax.settings')
    ->set('account_title', $form_state->getValue('account_title'))
    ->set('account_description', $form_state->getValue('account_description'))
    ->set('profile_title', $form_state->getValue('profile_title'))
    ->set('profile_description', $form_state->getValue('profile_description'))
      ->set('account_path', $form_state->getValue('account_path'))
      ->set('profile_path', $form_state->getValue('profile_path'))
      ->set('okta_api_key', $form_state->getValue('okta_api_key'))
      ->set('default_group_id', $form_state->getValue('default_group_id'))
      ->set('organisation_url', $form_state->getValue('organisation_url'))
      ->set('okta_domain', $form_state->getValue('okta_domain'))
      ->set('preview_domain', $form_state->getValue('preview_domain'))
	   ->set('okta_client_id', $form_state->getValue('okta_client_id'))
	   ->set('okta_client_secret', $form_state->getValue('okta_client_secret'))
    ->set('overview_header', $form_state->getValue('overview_header'))
    ->set('overview_subtext', $form_state->getValue('overview_subtext'))
    ->set('overview_guest_header', $form_state->getValue('overview_guest_header'))
    ->set('manage_header', $form_state->getValue('manage_header'))
    ->set('manage_subtext', $form_state->getValue('manage_subtext'))
    ->set('manage_guest_header', $form_state->getValue('manage_guest_header'))
    ->set('manage_signin_header', $form_state->getValue('manage_signin_header'))
    ->set('manage_email_header', $form_state->getValue('manage_email_header'))
    ->set('azure_key', $form_state->getValue('azure_key'))
    ->set('azure_account', $form_state->getValue('azure_account'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
