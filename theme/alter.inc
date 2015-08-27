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
