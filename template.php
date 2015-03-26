<?php
/**
 * Helper function; Load node by title
 */
function node_load_by_title($title, $node_type) {
  $query = new EntityFieldQuery();
  $entities = $query->entityCondition('entity_type', 'node')
      ->propertyCondition('type', $node_type)
      ->propertyCondition('title', $title)
      ->propertyCondition('status', 1)
      ->range(0, 1)
      ->execute();
  if (!empty($entities)) {
    $load = array_keys($entities['node']);
    return node_load(array_shift($load));
  }
}

function kultur_theme_preprocess_html(&$vars) {
  $path = drupal_get_path_alias();
  $front = "front";
  if (drupal_match_path($path, $front)) {
  $node = node_load_by_title('forside baggrund', 'background');
  if (!empty($node) && !empty($node->field_min_1600px) && !empty($node->field_min_1200px)) {
    $bg1200 = file_create_url($node->field_min_1200px[LANGUAGE_NONE][0]['uri']);
    $bg1600 = file_create_url($node->field_min_1600px[LANGUAGE_NONE][0]['uri']);
    
      drupal_add_css(
          '@media screen and (max-width: 1200px) { body { background-size: 100% 100%; background-repeat: no-repeat; background-image:url(' . $bg1200 . ');} }', 'inline'
      );
      drupal_add_css(
          '@media screen and (min-width: 1200px) { body { background-size: 100% 100%; background-repeat: no-repeat; background-image:url(' . $bg1600 . ');} }', 'inline'
      );
    }
  }
}
