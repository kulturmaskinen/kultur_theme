<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Implements hook_form_alter().
 */
function kultur_theme_form_alter(array &$form, array &$form_state = array(), $form_id = NULL) {
  switch ($form_id) {
    case 'search_form':
      $form['#attributes']['class'][] = "well";
      break;

    case 'views_exposed_form':
      $form['field_dato_value']['value']['#attributes']['placeholder'] = t('Søg fra dato..');
      break;
  }
}
/*
 * Make pdf open in new window.
 */
function kultur_theme_file_link($variables) {
  $file = $variables['file'];
  $icon_directory = $variables['icon_directory'];

  $url = file_create_url($file->uri);
  $icon = theme('file_icon', array('file' => $file, 'icon_directory' => $icon_directory));

  // Set options as per anchor format described at
  // http://microformats.org/wiki/file-format-examples
  $options = array(
      'attributes' => array(
          'type' => $file->filemime . '; length=' . $file->filesize,
      ),
  );

  // Use the description as the link text if available.
  if (empty($file->description)) {
    $link_text = $file->filename;
  } else {
    $link_text = $file->description;
    $options['attributes']['title'] = check_plain($file->filename);
  }

  //open files of particular mime types in new window
  $new_window_mimetypes = array('application/pdf', 'text/plain');
  if (in_array($file->filemime, $new_window_mimetypes)) {
    $options['attributes']['target'] = '_blank';
  }
  
  return '<span class="file">' . $icon . ' ' . l($link_text, $url, $options) . '</span>';

}