<?php

function kultur_theme_views_load_more_pager($vars) {
  global $pager_page_array, $pager_total;

  $tags = $vars['tags'];
  $element = $vars['element'];
  $parameters = $vars['parameters'];

  $pager_classes = array('pager', 'pager-load-more');

  $li_next = theme('pager_next',
    array(
      'text' => (isset($tags[3]) ? $tags[3] : t($vars['more_button_text'])),
      'element' => $element,
      'interval' => 1,
      'parameters' => $parameters,
    )
  );
  if (empty($li_next)) {
    $li_next = empty($vars['more_button_empty_text']) ? '&nbsp;' : t($vars['more_button_empty_text']);
    $pager_classes[] = 'pager-load-more-empty';
  }
  // Compatibility with tao theme's pager
  elseif (is_array($li_next) && isset($li_next['title'], $li_next['href'], $li_next['attributes'], $li_next['query'])) {
    $li_next = l($li_next['title'], $li_next['href'], array('attributes' => $li_next['attributes'], 'query' => $li_next['query']));
  }

  if (isset($_REQUEST['page']) && $_REQUEST['page'] >= 1) {
    $access_id = $_REQUEST['access_id'];
    $query_p = array("access_id[0]" => $access_id[0], "page" => 0);
    $li_p = l(t("Vis færre"), "", array('query' => $query_p));
    $items[] = array(
        'class' => array('pager-previous'),
        'data' => $li_p,
    );
  }

  if ($pager_total[$element] > 1) {
    $items[] = array(
      'class' => array('pager-next'),
      'data' => $li_next,
    );
    return theme('item_list',
      array(
        'items' => $items,
        'title' => NULL,
        'type' => 'ul',
        'attributes' => array('class' => $pager_classes),
      )
    );
  }
}

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
    if(drupal_is_front_page())
    {
    $meta_description = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(     
      'content' => 'Kulturmaskinen er byens kulturelle legeplads, med fantastiske muligheder for kulturelle arrangementer indendørs og i "Farvergården", der er specialindrettet til udendørs kulturbegivenheder.',
      'name' =>  'description',
    )
  );
      drupal_add_html_head($meta_description, 'meta_description');  
    } 
    
  drupal_add_css('//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', array(
      'type' => 'external'
  ));
  drupal_add_js(drupal_get_path('theme', 'kultur_theme') . '/js/jquery.mobile-events.min.js');
  $path = drupal_get_path_alias();
  $front = "*";
  $events = "arrangementer/*";
  $news = "nyheder/*";
  $locations = "rum-og-steder-liste";
  $locations1 = "*/magasinet*";
  $locations2 = "*/mødelokaler*";
  $locations3 = "*/rosenbæk-huset*";
  $locations4 = "*/amfiscenen*";
  $locations5 = "*/store-sal*";
  $locations6 = "*/farvergården*";
  $cafe = "statisk/café*";
  $workplace = "statisk/værksteder";
  $workplace1 = "*/tekstilværkstedet*";
  $workplace2 = "*/lerværkstedet*";
  $workplace3 = "*/mediegrafisk-værksted*";
  $om = "statisk/kulturmaskinen";
  
  $fastLiveFilter = "arrangementer/*\nnyheder/*";
  if (drupal_match_path($path, $fastLiveFilter)) {
    drupal_add_js(drupal_get_path('theme', 'kultur_theme') . '/js/jquery.fastLiveFilter.min.js', array('weight' => 999));
  }

  if (drupal_match_path($path, $events)) {
    $node = node_load_by_title('arrangementer baggrund', 'background');
  }
  elseif (drupal_match_path($path, $workplace)) {
    $node = node_load_by_title('værksteder baggrund', 'background');
  }
  elseif (drupal_match_path($path, $workplace1)) {
    $node = node_load_by_title('tekstilværkstedet baggrund', 'background');
  }
  elseif (drupal_match_path($path, $workplace2)) {
    $node = node_load_by_title('lerværkstedet baggrund', 'background');
  }
  elseif (drupal_match_path($path, $workplace3)) {
    $node = node_load_by_title('mediegrafisk baggrund', 'background');
  }
  elseif (drupal_match_path($path, $news)) {
    $node = node_load_by_title('nyheder baggrund', 'background');
  }
  elseif (drupal_match_path($path, $locations)) {
    $node = node_load_by_title('lokaler baggrund', 'background');
  }
  elseif (drupal_match_path($path, $locations1)) {
    $node = node_load_by_title('magasinet baggrund', 'background');
  }
  elseif (drupal_match_path($path, $locations2)) {
    $node = node_load_by_title('mødelokaler baggrund', 'background');
  }
  elseif (drupal_match_path($path, $locations3)) {
    $node = node_load_by_title('rosenbæk baggrund', 'background');
  }
  elseif (drupal_match_path($path, $locations4)) {
    $node = node_load_by_title('amfiscenen baggrund', 'background');
  }
  elseif (drupal_match_path($path, $locations5)) {
    $node = node_load_by_title('store-sal baggrund', 'background');
  }
  elseif (drupal_match_path($path, $locations6)) {
    $node = node_load_by_title('farvergården baggrund', 'background');
  }
  elseif (drupal_match_path($path, $cafe)) {
    $node = node_load_by_title('café baggrund', 'background');
  }
  elseif (drupal_match_path($path, $om)) {
    $node = node_load_by_title('om kulturmaskinen baggrund', 'background');
  }
  elseif (drupal_match_path($path, $front)) { 
    $node = node_load_by_title('forside baggrund', 'background');
  }
  
  if (!empty($node) && !empty($node->field_min_1600px) && !empty($node->field_min_1200px)) {
    $bg1200 = file_create_url($node->field_min_1200px[LANGUAGE_NONE][0]['uri']);
    $bg1600 = file_create_url($node->field_min_1600px[LANGUAGE_NONE][0]['uri']);

    drupal_add_css(
        '@media screen and (max-width: 1200px) { body { -webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover;
  background-size: cover; background-repeat: no-repeat; background-position:center center; background-attachment: fixed; background-image:url(' . $bg1200 . ');} }', 'inline'
    );
    drupal_add_css(
        '@media screen and (min-width: 1200px) { body { -webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover;
  background-size: cover; background-repeat: no-repeat; background-position:center center; background-attachment: fixed; background-image:url(' . $bg1600 . ');} }', 'inline'
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

 if (stripos($vars['tree'], 'home')) {
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
  } else {
    return '
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" style="width:90%;background-color:#DDDDDD;" data-target="#bs-example-navbar-collapse-4">
        Undermenu <span class="caret"></span>
      </button>
      <a class="navbar-brand" href="#"></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-4">
      <ul class="nav navbar-nav">
        <li class="dropdown">
  <ul class="dropdown-menu">
    ' . $vars['tree'] . ''
        . '
  </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>';
  }
}

/**
 * Implements hook_preprocess_node().
 *
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
function kultur_theme_preprocess_node(&$variables, $hook) {
    // Add latto_event_location and latto_place2book_tickets to variables (only for ding_event node template)
  if (isset($variables['content']['field_place2book_tickets']['#bundle']) && $variables['content']['field_place2book_tickets']['#bundle'] == 'events') {
    $event_location = 'location';
    if (!empty($variables['content']['field_rum_og_sted'][0]['#address']['name_line'])) {
      $event_location = $variables['content']['field_rum_og_sted'][0]['#address']['name_line'] . ', ' . $variables['content']['field_rum_og_sted'][0]['#address']['thoroughfare'] . '<br> ' . $variables['content']['field_rum_og_sted'][0]['#address']['postal_code'] . ' ' . $variables['content']['field_rum_og_sted'][0]['#address']['locality'];
      hide($variables['content']['field_location']);
 }
    else {
      /**
       *  @TODO: the full address wil have to be retrieved from the database
       */
      $event_location = $variables['content']['field_location'][0]['#address']['name_line'] . ', ' . $variables['content']['field_location'][0]['#address']['thoroughfare'] . '<br> ' . $variables['content']['field_location'][0]['#address']['postal_code'] . ' ' . $variables['content']['field_location'][0]['#address']['locality'];  
    }
    $variables['kultur_theme_event_location'] = $event_location;

    // Set a flag for existence of field_place2book_tickets
    $variables['kultur_theme_place2book_tickets'] = (isset($variables['content']['field_place2book_tickets'])) ? 1: 0;
  }
  
  //added open graph meta tags for facebook.
  $site_name = variable_get('site_name');
  $og_title = $variables['node']->title . ($site_name ? ' | ' . $site_name : '');
  if ($variables['type'] == 'news' || $variables['type'] == 'page') {
    $og_description = isset($variables['node']->field_lead[LANGUAGE_NONE][0]) ? drupal_substr(check_plain(strip_tags($variables['node']->field_lead[LANGUAGE_NONE][0]['safe_value'])), 0, 100) . '..' : '';
    $og_image = isset($variables['node']->field_title_image[LANGUAGE_NONE][0]) ? file_create_url($variables['node']->field_title_image[LANGUAGE_NONE][0]['uri'], array('absolute' => TRUE)) : '';
  
    drupal_add_html_head(array(
    '#tag' => 'meta',
    '#attributes' => array(
      'property' => 'og:title',
      'content' => $og_title,
    ),
      ), 'node_' . $variables['node']->nid . '_og_title');
  drupal_add_html_head(array(
    '#tag' => 'meta',
    '#attributes' => array(
      'property' => 'og:description',
      'content' => $og_description,
    ),
      ), 'node_' . $variables['node']->nid . '_og_description');

  drupal_add_html_head(array(
    '#tag' => 'meta',
    '#attributes' => array(
      'property' => 'og:image',
      'content' => $og_image,
    ),
      ), 'node_' . $variables['node']->nid . '_og_image');
  }
  // Add ddbasic_byline to variables
  $variables['kultur_theme_byline'] = t('By: ');
  
  /**
   * @TODO Use date-formats defined in the backend, do not hardcode formats...
   *       ever
   */
  // Add updated to variables.
  $variables['kultur_theme_updated'] = t('Updated: !datetime', array('!datetime' => format_date($variables['node']->changed, 'custom', 'l j. F Y')));

  // Modified submitted variable
  if ($variables['display_submitted']) {
    $variables['submitted'] = t('Submitted: !datetime', array('!datetime' => format_date($variables['created'], 'custom', 'l j. F Y')));
  }
  
}
/**
 * Implements hook_preprocess_panels_pane().
*
*/
function kultur_theme_preprocess_panels_pane(&$vars) {
  // Suggestions base on sub-type.
  $vars['theme_hook_suggestions'][] = 'panels_pane__' . str_replace('-', '__', $vars['pane']->subtype);

  // Suggestions on panel pane
  $vars['theme_hook_suggestions'][] = 'panels_pane__' . $vars['pane']->panel;
    }

/**
 * Implementing the ticketsinfo theme function (support for ding_place2book module)
 *
 * @TODO: Markup should not be hardcode into theme function as it makes it very
 *        hard to override.
 *
 */
function kultur_theme_place2book_ticketsinfo($variables) {
      $output = '';
  $place2book_id = $variables['place2book_id'];
  $url = $variables['url'];
  $type = $variables['type'];

  switch ($type) {
    case 'event-over':
      $output = '<div class="btn-warning btn-large">' . t('The event has already taken place') . '</div>';
      break;
    case 'closed-admission':
      $output = '<div class="btn-warning btn-large">' . t('The event is closed for admission') . '</div>';
      break;
    case 'sale-not-started':
      $output = '<div class="btn-warning btn-large">' . t('Ticket sale has not yet started for this event') . '</div>';
      break;
    case 'sale-not-started':
      $output = '<div class="btn-warning btn-large">' . t('Ticket sale has not yet started for this event') . '</div>';
      break;
    case 'no-tickets-left':
      $output = '<div class="btn-warning btn-large">' . t('Sold out') . '</div>';
      break;
    case 'order-link':
      $output = l(t('Book a ticket'), $url, array('attributes' => array('class' => array('btn', 'btn-primary', 'btn-large') , 'target' => '_blank')));
      break;
    default:
      $output = '';
      break;
  }

  return $output;
}

function kultur_theme_menu_link(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
    // Prevent dropdown functions from being added to management menu so it
    // does not affect the navbar module.
    if (($element['#original_link']['menu_name'] == 'management') && (module_exists('navbar'))) {
      $sub_menu = drupal_render($element['#below']);
    }
    else{
    unset($element['#below']['#theme_wrappers']);
    $sub_menu = '<ul class="dropdown-menu">' . drupal_render($element['#below']) . '</ul>';
    $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle disabled';
    $element['#localized_options']['attributes']['data-toggle'] = 'dropdown';
$element['#localized_options']['attributes']['data-hover'] = 'dropdown';
$element['#localized_options']['attributes']['data-delay'] = '100';
$element['#localized_options']['attributes']['data-close-others'] = 'false';

    // Check if this element is nested within another
    if ((!empty($element['#original_link']['depth'])) && ($element['#original_link']['depth'] > 1)) {
      // Generate as dropdown submenu
      $element['#attributes']['class'][] = 'dropdown-submenu';
  $element['#localized_options']['attributes']['tabindex'][] = '-1';

    }
    else {
      // Generate as standard dropdown
      $element['#attributes']['class'][] = 'dropdown';
      $element['#localized_options']['html'] = TRUE;
      $element['#title'] .= '<span class="caret"></span>';
    }
  }
  // Set dropdown trigger element to # to prevent inadvertant page loading with submenu click
   $element['#localized_options']['attributes']['data-target'] = '#';
  }
  // On primary navigation menu, class 'active' is not set on active menu item.
  // @see https://drupal.org/node/1896674
  if (($element['#href'] == $_GET['q'] || ($element['#href'] == '<front>' && drupal_is_front_page())) && (empty($element['#localized_options']['language']))) {
    $element['#attributes']['class'][] = 'active';
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}
/*
 * theme hook overwrite for theme_date_nav_title() in the date module.
 * Allows us to change the date format of the calendar title from hardcoded default.
 */
function kultur_theme_date_nav_title($params) {
switch($params['granularity'])
{
    case 'month':
    {
        $params['format'] = 'F Y';
        $output = ucfirst(theme_date_nav_title($params));
        break;
    }
    case 'week':
    {
        $params['format'] = "W";
        $output = theme_date_nav_title($params);
        break;
    }
    case 'day':
    {
        $params['format'] = "l";
        $output = theme_date_nav_title($params);
        
        $params['format'] = "j";
        $output .= " d. " .theme_date_nav_title($params);
        
         $params['format'] = "F";
        $output .= ". ". theme_date_nav_title($params);
        break;
    }
    default:
    {
        $output = theme_date_nav_title($params);
        break;
    }
}
 return $output;
}
/**
 * Declare various hook_*_alter() hooks.
 *
 * hook_*_alter() implementations must live (via include) inside this file so
 * they are properly detected when drupal_alter() is invoked.
 */
bootstrap_include('kultur_theme', 'theme/alter.inc');