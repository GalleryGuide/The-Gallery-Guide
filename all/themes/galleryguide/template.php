<?php

// $Id: template.php,v 1.17.2.1 2009/02/13 06:47:44 johnalbin Exp $

/**
 * @file
 * Contains theme override functions and preprocess functions for the theme.
 *
 * ABOUT THE TEMPLATE.PHP FILE
 *
 *   The template.php file is one of the most useful files when creating or
 *   modifying Drupal themes. You can add new regions for block content, modify
 *   or override Drupal's theme functions, intercept or make additional
 *   variables available to your theme, and create custom PHP logic. For more
 *   information, please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/theme-guide
 *
 * OVERRIDING THEME FUNCTIONS
 *
 *   The Drupal theme system uses special theme functions to generate HTML
 *   output automatically. Often we wish to customize this HTML output. To do
 *   this, we have to override the theme function. You have to first find the
 *   theme function that generates the output, and then "catch" it and modify it
 *   here. The easiest way to do it is to copy the original function in its
 *   entirety and paste it here, changing the prefix from theme_ to STARTERKIT_.
 *   For example:
 *
 *     original: theme_breadcrumb()
 *     theme override: STARTERKIT_breadcrumb()
 *
 *   where STARTERKIT is the name of your sub-theme. For example, the
 *   zen_classic theme would define a zen_classic_breadcrumb() function.
 *
 *   If you would like to override any of the theme functions used in Zen core,
 *   you should first look at how Zen core implements those functions:
 *     theme_breadcrumbs()      in zen/template.php
 *     theme_menu_item_link()   in zen/template.php
 *     theme_menu_local_tasks() in zen/template.php
 *
 *   For more information, please visit the Theme Developer's Guide on
 *   Drupal.org: http://drupal.org/node/173880
 *
 * CREATE OR MODIFY VARIABLES FOR YOUR THEME
 *
 *   Each tpl.php template file has several variables which hold various pieces
 *   of content. You can modify those variables (or add new ones) before they
 *   are used in the template files by using preprocess functions.
 *
 *   This makes THEME_preprocess_HOOK() functions the most powerful functions
 *   available to themers.
 *
 *   It works by having one preprocess function for each template file or its
 *   derivatives (called template suggestions). For example:
 *     THEME_preprocess_page    alters the variables for page.tpl.php
 *     THEME_preprocess_node    alters the variables for node.tpl.php or
 *                              for node-forum.tpl.php
 *     THEME_preprocess_comment alters the variables for comment.tpl.php
 *     THEME_preprocess_block   alters the variables for block.tpl.php
 *
 *   For more information on preprocess functions and template suggestions,
 *   please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/node/223440
 *   and http://drupal.org/node/190815#template-suggestions
 */
/*
 * Add any conditional stylesheets you will need for this sub-theme.
 *
 * To add stylesheets that ALWAYS need to be included, you should add them to
 * your .info file instead. Only use this section if you are including
 * stylesheets based on certain conditions.
 */
/* -- Delete this line if you want to use and modify this code
  // Example: optionally add a fixed width CSS file.
  if (theme_get_setting('galleryguide_fixed')) {
  drupal_add_css(path_to_theme() . '/layout-fixed.css', 'theme', 'all');
  }
  // */

/**
 * Implementation of HOOK_theme().
 */
function galleryguide_theme(&$existing, $type, $theme, $path) {
  $hooks = zen_theme($existing, $type, $theme, $path);

  $hooks['comment_form'] = array(
    'arguments' => array('form' => NULL),
    // Note: by uncommenting the following line, you can also use a
    // template file named comment-form.tpl.php to control the
    // output of the form.
    //'template' => 'comment-form'
  );
  $hooks['user_login'] = array('template' => 'user-login', 'arguments' => array('form' => NULL));


  // Add your theme hooks like this:
  /*
    $hooks['hook_name_here'] = array( // Details go here );
   */
  // @TODO: Needs detailed comments. Patches welcome!
  return $hooks;
}

/**
 * Theme the output of the comment_form.
 *
 * @param $form
 *   The form that  is to be themed.
 */
function galleryguide_comment_form($form) {

  // Rename some of the form element labels.
//   $form['submit']['#value'] = "Add my comment";

  $form['subject']['#size'] = 40;

  $form['comment_filter']['comment']['#cols'] = 38;




  // Remove the preview button
  $form['preview'] = NULL;

  return drupal_render($form);
}

/**
 * Override or insert variables into all templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered (name of the .tpl.php file.)
 */
/* -- Delete this line if you want to use this function
  function galleryguide_preprocess(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
  }
  // */

/**
 * Override or insert variables into the page templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
function galleryguide_preprocess_page(&$variables) {
  if($variables['node']->type == "exhibition"
    || $variables['node']->type == "gallery"
    || $variables['node']->type == "artist")
    $variables['template_files'][] = 'page-node-exhibition';
}

// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
function galleryguide_preprocess_node(&$vars, $hook) {
  if($vars['node']->type == 'artist') {
    $field_date = $vars['node']->field_born[0];

    if($field_date['value']) {
      
      $vars['born'] = substr($field_date['value'],0,4);
      
      if($field_date['value2'] != $field_date['value']) {
        $vars['died'] = substr($field_date['value2'],0,4);
      }

    }
  }
}

/**
 * Override or insert variables into the comment templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
function galleryguide_preprocess_comment(&$vars, $hook) {
  $vars['edit-subject']['#size'] = 40;
}

// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
  function galleryguide_preprocess_block(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
  }
  // */

function galleryguide_also_liked($node) {
  $nodes_i_liked = array();
  $users = db_query('SELECT * FROM {votingapi_vote}
                       WHERE value > 50 and content_id = %d', $node->nid);

  while($data = db_fetch_object($users)) {
    $user = $data->uid;
    $alsoliked = db_query(' SELECT * FROM {votingapi_vote}
                                WHERE value > 50 and uid = %d', $user);

    while($liked = db_fetch_object($alsoliked)) {
      if($liked->content_id != $node->nid) {
        $nodes_i_liked[] = $liked->content_id;
      }
    }
  }
  $nodes_i_liked = array_unique($nodes_i_liked);

  foreach($nodes_i_liked as $value) {
    $node_liked = node_load($value);
    $block_content .= '<div class="link">' . l($node_liked->title, $node_liked->path) . '</div>';
  }

  $display_content .= $block_content;
  return $display_content;
}

function galleryguide_recommendations() {

  // find nodes i liked
  global $user;
  $thisuser = $user->uid;
  $nodes_i_rated = array();
  $nodes_i_liked = array();
  $others_who_liked = array();
  $nodes_they_liked = array();

  $i_liked = db_query('SELECT content_id, value FROM {votingapi_vote} WHERE uid = %d', $thisuser);

  while($liked = db_fetch_object($i_liked)) {
    $nodes_i_rated[] = $liked->content_id;
    if($liked->value > 50)
      $nodes_i_liked[] = $liked->content_id;
  }

  // for each node i liked, find other people who liked it
  foreach($nodes_i_liked as $value) {
    $other_users = db_query('SELECT uid FROM {votingapi_vote} WHERE VALUE > 50 AND content_id = %d', $value);
    while($users = db_fetch_object($other_users)) {
      $others_who_liked[] = $users->uid;
    }
  }

  // remove duplicates and me from the list of users
  $others_who_liked = array_unique($others_who_liked);
  $others_who_liked = array_diff($others_who_liked, array($thisuser));

  // find the nodes they liked
  foreach($others_who_liked as $value) {
    $they_liked = db_query('SELECT content_id FROM {votingapi_vote} WHERE value > 50 AND uid = %d', $value);
    while($nodes = db_fetch_object($they_liked)) {
      $nodes_they_liked[] = $nodes->content_id;
    }
  }

  // remove the nodes I liked from the list
  $nodes_they_liked = array_diff($nodes_they_liked, $nodes_i_rated);

  // remove duplicates from the list
  $nodes_they_liked = array_unique($nodes_they_liked);

  // output the list of nodes
  $display_content = '';
  foreach($nodes_they_liked as $value) {
    $node_liked = node_load($value);
    $display_content .= '<div class="link">' . l($node_liked->title, $node_liked->path) . '</div>';
  }

  return $display_content;
}

// split out taxonomy terms by vocabulary
function galleryguide_print_terms($node) {
  $vocabularies = taxonomy_get_vocabularies();
  $output = '<ul>';
  foreach($vocabularies as $vocabulary) {
    if($vocabularies) {
      $terms = taxonomy_node_get_terms_by_vocabulary($node, $vocabulary->vid);
      if($terms) {
        $links = array();
        $output .= '<li>' . $vocabulary->name . ': ';
        foreach($terms as $term) {
          $targ = strtolower($vocabulary->name);
          $targ .='/';
          $targ .= strtolower(str_replace(' ', '-', $term->name));

          $links[] = l($term->name, $targ, array('rel' => 'tag', 'title' => strip_tags($term->description)));
        }
        $output .= implode(', ', $links);
        $output .= '</li>';
      }
    }
  }
  $output .= '</ul>';
  return $output;
}

function galleryguide_show_tags($node) {
  $output = '';
  $vocabulary = 3;
  $terms = taxonomy_node_get_terms_by_vocabulary($node, $vocabulary);
  if($terms) {
    $links = array();
    foreach($terms as $term) {
      $level = rand(1, 6);
      $class = "tagadelic level$level";

      $targ = 'tags/';
      $targ .= strtolower(str_replace(' ', '-', $term->name));
      $links[] = l($term->name, $targ, array('attributes' => array('rel' => 'tag', 'class' => $class)));
    }
    $output .= implode(' ', $links);
    $output .= '</li>';
  }
  return $output;
}

function galleryguide_show_artists($node) {
  $output = '';
  $vocabulary = 2;
  $terms = taxonomy_node_get_terms_by_vocabulary($node, $vocabulary);
  if($terms) {
    $links = array();
    foreach($terms as $term) {

      $targ = 'artists/';
      $targ .= strtolower(str_replace(' ', '-', $term->name));
      $links[] = l($term->name, $targ, array('attributes' => array('rel' => 'tag')));
    }
    $output .= implode(' ', $links);
    $output .= '</li>';
  }
  return $output;
}

/**
 * Implementation of hook_form_alter()
 * This hook is used to alter the domain form before rendering so that
 * unwanted details are hidden from the user
 */
function galleryguide_form_alter($form_id, &$form) {
  if($form_id == "node-form") {
    // the following hides the unwanted details from the user
    // so that the user has to fill only the necessary details
    $form['author']['#type'] = 'hidden';
    $form['options']['#type'] = 'hidden';
    $form['comment_settings']['#type'] = 'hidden';
    $form['menu']['#type'] = 'hidden';
    $form['path']['#type'] = 'hidden';

    //  $form['form_info'] = array(
    //    '#value' => '<pre>'. print_r($form, TRUE) .'</pre>'
    //  );
  }
  $form['edit-subject']['#size'] = "40";
  $form['subject']['#size'] = "40";
}

function galleryguide_nearest($node) {
  $thisnode = $node->nid;
  $latlon_query = " SELECT latitude, longitude FROM `drupal_location` WHERE lid IN (
                     SELECT lid FROM drupal_location_instance WHERE nid = $thisnode)";
  $results = db_query($latlon_query);
  while($data = db_fetch_array($results)) {
    $latitude = $data['latitude'];
    $longitude = $data['longitude'];
  }
  $display_content = '';



  $query = "SELECT nid,((ACOS(SIN($latitude * PI() / 180) *
SIN(latitude * PI() / 180) + COS($latitude * PI() / 180) *
COS(latitude * PI() / 180) * COS(($longitude - longitude) * PI() / 180))
 * 180 / PI()) * 60 * 1.1515)
AS distance FROM drupal_location
LEFT JOIN drupal_location_instance on drupal_location. lid = drupal_location_instance.lid
ORDER BY distance ASC LIMIT 1,10";

  $galleries = db_query($query);
  for($i = 0; $i < 10; $i++) {
    $data = db_fetch_array($galleries);
    $gallery = node_load($data['nid']);
    $display_content .= '<div class="link">' . l($gallery->title, $gallery->path) . '</div>';
  }

  return $display_content;
}

/*
  function galleryguide_links($links = array(), $delimiter = ' | ') {
  /**
 *
 * catches the theme_links function
 */

// Uncomment the following line to see the links and the indexes
// print '<pre>' . print_r($links, TRUE) . '</pre>';
/*
  $ordered_links = array();

  // Indexes of links we want to force order for
  // Links accounted for here will be in order in this array

  $in_order = array('exhibition_field_exhib_gallery', 'event_field_exhib_gallery',
  'forum_field_discussion_subject');

  // Move links we care about to $ordered_links array
  //   Will be added in order index is found in $in_order array

  foreach ( $in_order as $index )
  {
  // Make sure the link exists
  if( isset($links[$index]) )
  {
  $ordered_links[] = $links[$index];
  unset($links[$index]);
  }
  }

  // Add any links not accounted for at end

  foreach ( $links as $link ) {
  $ordered_links[] = $link;
  }

  // Not really a best practice but it avoid copying
  // the code in theme_links

  return theme_links($ordered_links, $delimiter);
  }
 */
//variable_set('drupal_http_request_fails',FALSE);

function _phptemplate_variables($hook, $vars = array()) {
  switch($hook) { // what function is active?
    case 'page': // page is where menu comes into play
      // set the primary links
      $vars['primary_links'] = menutrails_primary_links(1);
      // you may want to also override secondary_links
      $vars['secondary_links'] = menutrails_primary_links(2);
      break;
  }
}

function galleryguide_menu_item_link($link) {
  if(empty($link['localized_options'])) {
    $link['localized_options'] = array();
  }

  // This is the new code I added to make MenuTrails behave
  if($link['in_active_trail']) {
    if(empty($link['localized_options']['attributes']['class'])) {
      $link['localized_options']['attributes']['class'] = 'active';
    }
    else {
      $link['localized_options']['attributes']['class'] .= ' active';
    }
  }
  // end new code

  return l($link['title'], $link['href'], $link['localized_options']);
}

function galleryguide_user_login_block() {
  $form = array(
    '#action' => url($_GET['q'], array('query' => drupal_get_destination())),
    '#id' => 'user-login-form',
    '#validate' => user_login_default_validators(),
    '#submit' => array('user_login_submit'),
  );
  $form['name'] = array('#type' => 'textfield',
    '#title' => t('Username'),
    '#maxlength' => USERNAME_MAX_LENGTH,
    '#size' => 15,
    '#required' => TRUE,
  );
  $form['pass'] = array('#type' => 'password',
    '#title' => t('Password'),
    '#maxlength' => 60,
    '#size' => 15,
    '#required' => TRUE,
  );
  $form['submit'] = array('#type' => 'submit',
    '#value' => t('Log in'),
  );
  $items = array();
  if(variable_get('user_register', 1)) {
    $items[] = t('Get recommendations and discover more by creating an account.');
    $items[] = l(t('Create new account'), 'user/register', array('attributes' => array('title' => t('Create a new user account.'))));
  }
  $items[] = l(t('Request new password'), 'user/password', array('attributes' => array('title' => t('Request new password via e-mail.'))));
  $form['links'] = array('#value' => theme('item_list', $items));
  return $form;
}

function galleryguide_preprocess_search_theme_form(&$vars, $hook) {

  echo '<pre>';
  print_r($vars['form']);
  echo '</pre>';
  die;
}

function galleryguide_preprocess_search_results(&$variables) {

  $variables['search_results'] = '';

  // get a list of node types
  $nodeTypes = node_get_types();

  // loop through results, group by type
  $resultTypes = array();
  foreach($variables['results'] as $result) {
    $resultTypes[$result['node']->type][] = $result;
  }

  unset($resultTypes['feed_item']);


  // create fieldsets for each type
  foreach($resultTypes as $resultType => $resultTypeResults) {
    $value = "";
    // loop through entries
    foreach($resultTypeResults as $result) {
      $value .= theme('search_result', $result, $variables['type']);
    }

    // add fieldset
    $variables['search_results'] .= theme('fieldset', array(
      '#title' => $nodeTypes[$resultType]->name,
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
      '#value' => $value,
      )
    );
  }

  $variables['pager'] = theme('pager', NULL, 10, 0);
  // Provide alternate search results template.
  $variables['template_files'][] = 'search-results-' . $variables['type'];
}

/**
 * function for pulling out the necessary variables in the search results to display thumbnails images alongside the search results
 */
function galleryguide_preprocess_search_result(&$vars, $hook) {
  $n = node_load($vars['result']['node']->nid);
  $n && ($vars['node'] = $n);
}

function galleryguide_user_picture($account, $size = '50x50') {

  if(!variable_get('user_pictures', 0)) {
    return '';
  }

  // Default to a certain size
  if(arg(0) == 'user' && is_numeric(arg(1))) {
    $size = '100x100';
  }

  if($account->picture && file_exists($account->picture)) {
    switch($size) {
      case '100x100':
        $maxsize_icon = array('w' => 100, 'h' => 100);
        $info = image_get_info($account->picture);
        if($info['height'] < $maxsize_icon['h']) {
          $maxsize_icon['h'] = $info['height'];
        }
        if($info['width'] < $maxsize_icon['w']) {
          $maxsize_icon['w'] = $info['width'];
        }
        $newpicture = dirname($account->picture) . '/picture-'
          . $account->uid . '.' . $info['extension'];
        if(!file_exists($newpicture) ||
          (filectime($newpicture) < filectime($account->picture))) {
          image_scale($account->picture, $newpicture, $maxsize_icon['w'], $maxsize_icon['h']);
        }
        $picture = file_create_url($newpicture);
        break;

      case '50x50':
        $maxsize_tile = array('w' => 50, 'h' => 50);
        $info = image_get_info($account->picture);
        $newpicture = dirname($account->picture) . '/picture-'
          . $account->uid . '-small' . '.' . $info['extension'];
        if(!file_exists($newpicture) ||
          (filectime($newpicture) < filectime($account->picture))) {
          image_scale($account->picture, $newpicture, $newpicture, $maxsize_tile['w'], $maxsize_tile['h']);
        }
        $picture = file_create_url($newpicture);
        break;

      default:
        $picture = file_create_url($account->picture);
        break;
    }
  }
  else {
    $picture = variable_get('user_picture_default', '');
  }

  if(isset($picture)) {
    $alt = t('@user\'s picture', array('@user' => $account->name ? $account->name :
        variable_get('anonymous', 'Anonymous')));
    $picture = theme('image', $picture, $alt, $alt, '', false);
    if(!empty($account->uid) && user_access('access user profiles')) {
      $picture = l($picture, "user/$account->uid", array('html' => TRUE));
    }

    return $picture;
  }
}

function galleryguide_tagadelic_weighted($terms) {
  $output = '';
  foreach($terms as $term) {
    $output .= l($term->name, 'tags/' . strtolower(str_replace(' ', '-', $term->name)), array('attributes' => array('class' => "tagadelic level$term->weight", 'rel' => 'tag'))) . " \n";
  }
  return $output;
}