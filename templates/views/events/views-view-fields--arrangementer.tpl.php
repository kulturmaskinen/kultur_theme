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

    if ($id === 'field_rum_og_sted' && $fields['field_rum_og_sted']->content != '<div class="field-content"></div>') {
        preg_match('/(.*?)<\/div><\/div>/', $fields['field_rum_og_sted']->content, $matches);

        $field->content = $matches[0] . '</a></div>';
    }
    if ($id === 'field_location_name_line' && $fields['field_rum_og_sted']->content != '<div class="field-content"></div>') {
        unset($field->content);
    }

    if ($id == 'title') {
        print '<div class="subheading">';
    }
    if ($id == 'field_event_category') {
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

    if ($id != 'field_event_category') {
        print $field->wrapper_prefix;
        print $field->label_html;
        if (isset($field->content)) {
            print $field->content;
        }
        print $field->wrapper_suffix;
    }


    if ($id == 'view_node') {
        print "</div>";
    }
}

 /*
     * Add wrapper based on event kategory
     * external event types: kultunaut.dk
     */
    $wrapper = entity_metadata_wrapper('node', $row->nid);
    $is_extern = $wrapper->field_fra_kultunaut->value(); //this field is not contained in the view $row result
    if ($is_extern == true) {
        print '<div title="' . t('Arrangør: Ekstern') . '" class="ribbon ribbon-external" >EX</div>';
    }
    else {
        print '<div title="' . t('Arrangør : Kulturmaskinen') . '" class="ribbon ribbon-internal" >KM</div>';
    }