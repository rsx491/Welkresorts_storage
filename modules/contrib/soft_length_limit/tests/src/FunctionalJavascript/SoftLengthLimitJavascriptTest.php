<?php

namespace Drupal\Tests\soft_length_limit\FunctionalJavascript;

use Drupal\Core\Entity\Entity\EntityFormDisplay;
use Drupal\Core\Session\AccountInterface;
use Drupal\entity_test\Entity\EntityTest;
use Drupal\field\Entity\FieldConfig;
use Drupal\field\Entity\FieldStorageConfig;
use Drupal\FunctionalJavascriptTests\WebDriverTestBase;

/**
 * Tests soft length limit JavaScript behavior for text fields.
 */
class SoftLengthLimitJavascriptTest extends WebDriverTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'node',
    'field',
    'entity_test',
    'soft_length_limit',
    'text',
  ];

  /**
   * Tests that the soft length limit widget works.
   */
  public function testSoftLengthLimitWithStyleSelect() {
    $this->setupContentType();
    $entity = EntityTest::create(['type' => 'entity_test', 'name' => 'Test Soft Length Limit.']);
    $entity->save();

    $admin = $this->drupalCreateUser(['administer entity_test content']);
    $this->drupalLogin($admin);
    $this->drupalGet($entity->toUrl('edit-form'));

    $page = $this->getSession()->getPage();
    $foo_field = $page->findField('Foo');
    $foo_field->focus();
    $foo_field->setValue('text');
    $tooltip_text = $page->find('css', '.soft-length-limit-tooltip')->getText();

    $foo_field->focus();
    $this->assertEquals('4/20', $tooltip_text);
  }

  /**
   * Tests that the soft length limit widget works.
   */
  public function testSoftLengthLimitWithoutStyleSelect() {
    $this->setupContentType(FALSE);
    $entity = EntityTest::create(['type' => 'entity_test', 'name' => 'Test Soft Length Limit.']);
    $entity->save();

    $admin = $this->drupalCreateUser(['administer entity_test content']);
    $this->drupalLogin($admin);
    $this->drupalGet($entity->toUrl('edit-form'));

    $page = $this->getSession()->getPage();
    $foo_field = $page->findField('Foo');
    $foo_field->focus();
    $foo_field->setValue('text');
    $tooltip_text = $page->find('css', '.soft-length-limit-tooltip')->getText();

    $foo_field->focus();
    $this->assertEquals('Suggested minimum number of characters is 10, current count is 4. Content limited to 20 characters. Remaining: 16.',
      $tooltip_text);
  }

  /**
   * {@inheritdoc}
   */
  protected function drupalLogin(AccountInterface $account) {
    // This is a clone of the UiHelperTrait::drupalLogin() method,
    // which seems to make the test fail no matter what, when asserting the
    // user session.
    if ($this->loggedInUser) {
      $this->drupalLogout();
    }

    $this->drupalGet('user/login');
    $this->submitForm([
      'name' => $account->getAccountName(),
      'pass' => $account->passRaw,
    ], t('Log in'));

    // @see ::drupalUserIsLoggedIn()
    $account->sessionId = $this->getSession()->getCookie(\Drupal::service('session_configuration')->getOptions(\Drupal::request())['name']);
    $this->loggedInUser = $account;
    $this->container->get('current_user')->setAccount($account);
  }

  /**
   * Sets up the entity_test entity type with a field using soft_length_limit.
   *
   * @param bool $style_select
   *   Whether to use style_select option of soft_length_limit.
   *
   * @throws \Drupal\Core\Entity\EntityStorageException
   */
  private function setupContentType($style_select = TRUE): void {
    FieldStorageConfig::create([
      'type'        => 'text_long',
      'entity_type' => 'entity_test',
      'field_name'  => 'foo',
    ])->save();
    FieldConfig::create([
      'entity_type' => 'entity_test',
      'bundle'      => 'entity_test',
      'field_name'  => 'foo',
      'label'       => 'Foo',
      'description' => 'Description of a text field',
    ])->save();
    $widget = [
      'type'                 => 'text_textarea',
      'third_party_settings' => [
        'soft_length_limit' => [
          'max_limit'     => 20,
          'minimum_limit' => 10,
          'style_select'  => $style_select,
        ],
      ],
    ];
    EntityFormDisplay::load('entity_test.entity_test.default')
      ->setComponent('foo', $widget)
      ->save();
  }

}
