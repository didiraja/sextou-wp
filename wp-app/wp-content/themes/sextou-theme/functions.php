<?php

function order_categories($post)
{
  $all_categories = get_the_terms($post->ID, 'category');

  $cat_region = array_filter($all_categories, function ($category) {
    return $category->parent == 30;
  });
  $cat_district = array_filter($all_categories, function ($category) {
    return $category->parent == 31;
  });
  $cat_vibe = array_filter($all_categories, function ($category) {
    return $category->parent == 32;
  });

  return array_merge($cat_region, $cat_district, $cat_vibe);
}

function sextou_posts_output($post)
{
  $event_date = get_field('event_date', $post->ID, false);
  $formatted_date = date('c', strtotime($event_date));
  $post_slug = basename(get_permalink($post->ID));

  return array(
    // 'debug' => $post,
    // 'cat_debug' => $all_categories,
    'id' => $post->ID,
    'slug' => $post_slug,
    'title' => $post->post_title,
    'event_date' => $formatted_date,
    'categories' => order_categories($post),
    'cover' => wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium_large')[0],
    'free' => get_field('free', $post->ID),
    'tickets' => get_field('tickets', $post->ID),
    'description' => $post->post_content,
  );
}

// @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @
// @ @ @ @ CHANGE POST LABEL @ @ @ @ 
// @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @
// 
add_action('init', 'revcon_change_post_object');

function revcon_change_post_object()
{
  $get_post_type = get_post_type_object('post');
  $labels = $get_post_type->labels;
  $labels->name = 'Eventos';
  $labels->singular_name = 'Evento';
  $labels->add_new = 'Novo Evento';
  $labels->add_new_item = 'Novo Evento';
  $labels->edit_item = 'Editar Evento';
  $labels->new_item = 'Evento';
  $labels->view_item = 'Ver Evento';
  $labels->search_items = 'Buscar Evento';
  $labels->not_found = 'Nenhum Evento encontrado';
  $labels->not_found_in_trash = 'Nenhum Evento encontrado na Lixeira';
  $labels->all_items = 'Todos os Eventos';
  $labels->menu_name = 'Eventos';
  $labels->name_admin_bar = 'Evento';
  $get_post_type->menu_icon = 'dashicons-calendar-alt';
}

// @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @
// @ @ @ SEXTOU - MAIN ENDPOINT @ @ @ @ 
// @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @
// 
add_action('rest_api_init', 'create_main_endpoint');

/**
 * http://sextou.local/wp-api/sextou/v1/events?after=2023-01-01&before=2023-01-22
 * 
 * @param "/events"
 * 
 * @param after
 * @param before
 * @param page
 * @param per_page
 */
function create_main_endpoint()
{
  register_rest_route('sextou/v1', 'events', array(
    'methods' => 'GET',
    'callback' => 'main_endpoint_callback',
    'args' => array(
      'before' => array(
        'validate_callback' => function ($param, $request, $key) {
          return strtotime($param) !== false;
        },
      ),
      'after' => array(
        'validate_callback' => function ($param, $request, $key) {
          return strtotime($param) !== false;
        },
      ),
    ),
  ));
}

// @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @
// @ @ @ @ @ ENDPOINT OUTPUT @ @ @ @ @
// @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @
// 
function main_endpoint_callback(WP_REST_Request $request)
{
  $before = $request->get_param('before');
  $after = $request->get_param('after');

  $page = $request->get_param('page') ?: 1;
  $per_page = $request->get_param('per_page') ?: 8;

  // output if NO before & after params
  if (empty($before) && empty($after)) {
    return new WP_Error(
      'missing_parameters',
      'before or after parameters are required',
      array('status' => 400)
    );
  }

  $meta_query = array();

  if (!empty($before) && !empty($after)) {
    $meta_query[] = array(
      'key' => 'event_date',
      'compare' => 'BETWEEN',
      'value' => array($after, $before),
      'type' => 'DATE'
    );
  }

  // if only before filled
  if (!empty($before)) {
    $meta_query[] = array(
      'key' => 'event_date',
      'compare' => '<=',
      'value' => $before,
      'type' => 'DATE'
    );
  }

  // if only after filled
  if (!empty($after)) {
    $meta_query[] = array(
      'key' => 'event_date',
      'compare' => '>=',
      'value' => $after,
      'type' => 'DATE'
    );
  }

  // Find posts to iterate. Ordered by date from meta_key.
  $query = new WP_Query(array(
    'meta_query' => $meta_query,
    'paged' => $page,
    'posts_per_page' => $per_page,
    'orderby' => 'meta_value',
    'meta_key' => 'event_date',
    'order' => 'ASC'
  ));

  $posts = $query->posts;
  $all_posts = array();

  // create output object from posts
  foreach ($posts as $post) {

    $item = sextou_posts_output($post);
    $all_posts[] = $item;
  }

  // Final Output, now including date beyond posts itself
  $output = array(
    'total_posts' => $query->found_posts,
    'posts' => $all_posts,
  );

  return $output;
}

// @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @
// @ @ @ SEXTOU - SINGLE ENDPOINT @ @ @ @ 
// @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @
// 
/**
 * http://sextou.local/wp-api/sextou/v1/event/1234
 * 
 * @param "/event"
 * 
 * @param id
 */

add_action('rest_api_init', 'register_event_endpoint');

function register_event_endpoint() {
  register_rest_route('sextou/v1', '/event/(?P<id>[a-zA-Z0-9-]+)', array(
    'methods' => 'GET',
    'callback' => 'get_event_by_id_or_slug', // Updated callback function name
  ));
}

function get_event_by_id_or_slug($request) { // Updated function name
  $event_id_or_slug = $request['id']; // Updated parameter name

  // Check if the parameter contains any numbers (int)
  preg_match('/\d+/', $event_id_or_slug, $matches);
  $event_id = !empty($matches) ? absint($matches[0]) : null;
  
  if (is_int($event_id)) {
    // If the parameter contains a number, use get_post to retrieve the post by ID
    $post = get_post($event_id);
  } else {
    // If the parameter does not contain numbers, use get_page_by_path to retrieve the post by slug
    $post = get_page_by_path($event_id_or_slug, OBJECT, 'post');
  }

  if (empty($post)) {
    return new WP_Error('event_not_found', 'Event not found with the specified ID or slug.', array('status' => 404));
  }

  $post_slug = basename(get_permalink($post->ID));
  $output = array_merge(
    array('slug' => $post_slug),
    sextou_posts_output($post)
  );

  return $output;
}


// @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @
// @ @ SEXTOU - CATEGORY ENDPOINT @ @ @
// @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @
// 
add_action('rest_api_init', 'create_category_endpoint');

/**
 * http://sextou.local/wp-api/sextou/v1/category/centro
 * 
 * @param "/category"
 * 
 * @param slug
 */
function create_category_endpoint()
{
  register_rest_route('sextou/v1', 'category/(?P<slug>[\w-]+)', array(
    'methods' => 'GET',
    'callback' => 'category_endpoint_callback',
  ));
}

// @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @
// @ @ @ @ @ ENDPOINT OUTPUT @ @ @ @ @
// @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @
// 
function category_endpoint_callback(WP_REST_Request $request)
{
  $category_slug = $request->get_param('slug');

  $page = $request->get_param('page') ?: 1;
  $per_page = $request->get_param('per_page') ?: 8;

  // output if param is a NUMBER
  if (is_numeric($category_slug)) {
    return new WP_Error(
      'wrong_parameter',
      'category slug accepts just strings',
      array('status' => 400)
    );
  }

  $category = get_term_by('slug', $category_slug, 'category');

  if (!$category) {
    return new WP_Error(
      'category_not_found',
      'category not found',
      array('status' => 404)
    );
  }

  $meta_query = array();

  $meta_query =  array(
    'relation' => 'AND',
    $meta_query,
    array(
      'key' => 'event_date',
      'value' => date('Ymd'),
      'compare' => '>=',
      'type' => 'DATE'
    )
  );

  // Find posts to iterate. Ordered by date from meta_key.
  $query = new WP_Query(array(
    'category_name' => $category_slug,
    'meta_query' => $meta_query,
    'paged' => $page,
    'posts_per_page' => $per_page,
    'orderby' => 'meta_value',
    'meta_key' => 'event_date',
    'order' => 'ASC'
  ));

  $posts = $query->posts;
  $all_posts = array();

  // create output object from posts
  foreach ($posts as $post) {

    $item = sextou_posts_output($post);
    $all_posts[] = $item;
  }

  // Final Output, now including total items beyond posts itself
  $output = array(
    'id' => $category->term_id,
    'slug' => $category->slug,
    'name' => $category->name,
    'total_posts' => $query->found_posts,
    'posts' => $all_posts,
  );

  return $output;
}

// // @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @
// // @ @ @ @ PRIVATE AFTER TODAY @ @ @ @
// // @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @ @
// // 
// add_action('daily_status_change', 'change_status_to_private');

// wp_schedule_event(time(), 'daily', 'daily_status_change');

// function change_status_to_private()
// {
//   $args = array(
//     'post_type' => 'post',
//     'post_status' => 'publish',
//     'meta_query' => array(
//       array(
//         'key' => 'event_date',
//         'value' => date('Ymd'),
//         'compare' => '<'
//       )
//     ),
//     'posts_per_page' => -1
//   );
//   $posts = get_posts($args);
//   foreach ($posts as $post) {
//     $update = array(
//       'ID' => $post->ID,
//       'post_status' => 'private'
//     );
//     wp_update_post($update);
//   }
// }