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
  drupal_add_css('//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', array(
      'type' => 'external'
  ));
  $path = drupal_get_path_alias();
  $front = "front";
  if (drupal_match_path($path, $front)) {
    $node = node_load_by_title('forside baggrund', 'background');
  }
    if (drupal_match_path($path, '*')) {
    $node = node_load_by_title('noder', 'background');
  }

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

/**
* Implements theme_menu_tree().
*
* Addes wrapper clases for the default menu.
*/
function kultur_theme_menu_tree__main_menu($vars) {
$form = drupal_get_form('search_block_form');

return '
<nav class="navbar navbar-default">
<div>
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
<button data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>                  
<span class="fa-stack fa-lg" style="margin-top: 8px; margin-left:0.8em;">
<a href="/">
<i class="fa fa-circle fa-stack-2x"></i>
<i class="fa fa-home fa-stack-1x fa-inverse"></i>
</a>
</span>
</div>

<!-- Collect the nav links, forms, and other content for toggling -->
<div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse">          
<ul class="nav navbar-nav" style="margin: 0 0 0 1em;">' . $vars['tree'] . ''
. '</ul><div class="navbar-form navbar-right">' . drupal_render($form) . '</div>';
}
