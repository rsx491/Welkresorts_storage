<?php

/**
 * @file
 * Hooks and documentation related to paragraphs module.
 */

/**
 * @addtogroup hooks
 * @{
 */

/**
 * Alter the information provided in
 * \Drupal\paragraphs\Annotation\ParagraphsBehavior.
 *
 * @param $paragraphs_behavior
 *   The array of paragraphs behavior plugins, keyed on the
 *   machine-readable plugin name.
 */
function hook_paragraphs_behavior_info_alter(&$paragraphs_behavior) {
  // Set a new label for the my_layout plugin instead of the one
  // provided in the annotation.
  $paragraphs_behavior['my_layout']['label'] = t('New label');
}

/**
 * Alter paragraphs widget.
 *
 * @param array $widget_actions
 *   Array with actions and dropdown widget actions.
 * @param array $context
 *   An associative array containing the following key-value pairs:
 *   - form: The form structure to which widgets are being attached. This may be
 *     a full form structure, or a sub-element of a larger form.
 *   - widget: The widget plugin instance.
 *   - items: The field values, as a
 *     \Drupal\Core\Field\FieldItemListInterface object.
 *   - delta: The order of this item in the array of subelements (0, 1, 2, etc).
 *   - element: A form element array containing basic properties for the widget.
 *   - form_state: The current state of the form.
 *   - paragraphs_entity: the paragraphs entity for this widget. Might be
 *     unsaved, if we have just added a new item to the widget.
 *   - is_translating: Boolean if the widget is translating.
 *   - allow_reference_changes: Boolean if changes to structure are OK.
 */
function hook_paragraphs_widget_actions_alter(array &$widget_actions, array &$context) {
}
/****** Applied below Patch **********/
 /**
 * Perform alterations on a paragraphs entity subform.
 *
 * Modules can implement hook_form_paragraphs_subform_alter() to change a
 * paragraphs entity subform in the entity reference widgets.
 *
 * In addition to hook_form_paragraphs_subform_alter(), there are more specific
 * form hooks available. This allows targeting of a specific widget type and/or
 * paragraphs type form directly. Within each module, the alter hooks are
 * called in the following order:
 * - hook_form_paragraphs_subform_alter()
 * - hook_form_paragraphs_subform_TYPE_alter()
 *   With TYPE being the paragraphs type of the paragraphs entity.
 * - hook_form_paragraphs_subform_WIDGET_alter()
 *   With WIDGET being 'classic' or 'experimental'.
 * - hook_form_paragraphs_subform_WIDGET_TYPE_alter()
 *   With WIDGET being 'classic' or 'experimental' and TYPE being the
 *   paragraphs type of the paragraphs entity.
 *
 * @param array $subform
 *   Nested array of form elements for the paragraphs entity subform in the
 *   widget.
 * @param \Drupal\Core\Form\FormStateInterface $form_state
 *   The current state of the form. The arguments that
 *   \Drupal::formBuilder()->getForm() was originally called with are available
 *   in the array $form_state->getBuildInfo()['args'].
 * @param int $delta
 *   The order of this item in the array of sub-elements (0, 1, 2, etc.).
 *
 * @see hook_form_paragraphs_subform_TYPE_alter()
 * @see hook_form_paragraphs_subform_WIDGET_alter()
 * @see hook_form_paragraphs_subform_WIDGET_TYPE_alter()
 */
function hook_form_paragraphs_subform_alter(array &$subform, \Drupal\Core\Form\FormStateInterface $form_state, $delta) {
  $paragraph = $form_state->get('paragraph');
}

/**
 * Perform alterations on a paragraphs entity subform.
 *
 * Modules can implement hook_form_paragraphs_subform_TYPE_alter() to change
 * a paragraphs entity subform in the entity reference widgets for a specific
 * paragraphs type.
 *
 * @param array $subform
 *   Nested array of form elements for the paragraphs entity subform in the
 *   widget.
 * @param \Drupal\Core\Form\FormStateInterface $form_state
 *   The current state of the form. The arguments that
 *   \Drupal::formBuilder()->getForm() was originally called with are available
 *   in the array $form_state->getBuildInfo()['args'].
 * @param int $delta
 *   The order of this item in the array of sub-elements (0, 1, 2, etc.).
 *
 * @see hook_form_paragraphs_subform_alter()
 * @see hook_form_paragraphs_subform_WIDGET_alter()
 * @see hook_form_paragraphs_subform_WIDGET_TYPE_alter()
 */
function hook_form_paragraphs_subform_TYPE_alter(array &$subform, \Drupal\Core\Form\FormStateInterface $form_state, $delta) {
  $paragraph = $form_state->get('paragraph');
}

/**
 * Perform alterations on a paragraphs entity subform.
 *
 * Modules can implement hook_form_paragraphs_subform_WIDGET_alter() to change
 * a paragraphs entity subform in a specific entity reference widget.
 *
 * @param array $subform
 *   Nested array of form elements for the paragraphs entity subform in the
 *   widget.
 * @param \Drupal\Core\Form\FormStateInterface $form_state
 *   The current state of the form. The arguments that
 *   \Drupal::formBuilder()->getForm() was originally called with are available
 *   in the array $form_state->getBuildInfo()['args'].
 * @param int $delta
 *   The order of this item in the array of sub-elements (0, 1, 2, etc.).
 *
 * @see hook_form_paragraphs_subform_alter()
 * @see hook_form_paragraphs_subform_TYPE_alter()
 * @see hook_form_paragraphs_subform_WIDGET_TYPE_alter()
 */
function hook_form_paragraphs_subform_WIDGET_alter(array &$subform, \Drupal\Core\Form\FormStateInterface $form_state, $delta) {
  $paragraph = $form_state->get('paragraph');
}

/**
 * Perform alterations on a paragraphs entity subform.
 *
 * Modules can implement hook_form_paragraphs_subform_WIDGET_TYPE_alter() to
 * change a paragraphs entity subform in a specific entity reference widget for
 * and a specific paragraphs type.
 *
 * @param array $subform
 *   Nested array of form elements for the paragraphs entity subform in the
 *   widget.
 * @param \Drupal\Core\Form\FormStateInterface $form_state
 *   The current state of the form. The arguments that
 *   \Drupal::formBuilder()->getForm() was originally called with are available
 *   in the array $form_state->getBuildInfo()['args'].
 * @param int $delta
 *   The order of this item in the array of sub-elements (0, 1, 2, etc.).
 *
 * @see hook_form_paragraphs_subform_alter()
 * @see hook_form_paragraphs_subform_TYPE_alter()
 * @see hook_form_paragraphs_subform_WIDGET_alter()
 */
function hook_form_paragraphs_subform_WIDGET_TYPE_alter(array &$subform, \Drupal\Core\Form\FormStateInterface $form_state, $delta) {
  $paragraph = $form_state->get('paragraph');
}

/**
 * @} End of "addtogroup hooks".
 */
