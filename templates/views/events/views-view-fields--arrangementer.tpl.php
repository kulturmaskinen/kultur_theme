<?php
/**
 * @file views-view-fields.tpl.php
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */

foreach ($fields as $id => $field) {
  
  if($id == 'title') {
    print '<div class="subheading">';
  }
  if($id == 'field_event_category') {
    print $field->wrapper_prefix;
    print $field->label_html;
    print '<span class="view-btn btn btn-info">';
    print $field->content;
    print '</span>';
    print $field->wrapper_suffix;    
  }
  
  if (!empty($field->separator)) {
    print $field->separator;
  }
  
  if($id != 'field_event_category') {
    print $field->wrapper_prefix;
    print $field->label_html;
    print $field->content;
    print $field->wrapper_suffix;
  }
  
  if($id == 'field_dato') {
    print "</div>";
  }
}
