<?php

/**
 * sextou-theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package sextou-theme
 */

if (!defined('_S_VERSION')) {
  // Replace the version number of the theme on each release.
  define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sextou_theme_setup()
{
  /*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on sextou-theme, use a find and replace
		* to change 'sextou-theme' to the name of your theme in all the template files.
		*/
  load_theme_textdomain('sextou-theme', get_template_directory() . '/languages');

  // Add default posts and comments RSS feed links to head.
  add_theme_support('automatic-feed-links');

  /*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
  add_theme_support('title-tag');

  /*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
  add_theme_support('post-thumbnails');

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus(
    array(
      'menu-1' => esc_html__('Primary', 'sextou-theme'),
    )
  );

  /*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
  add_theme_support(
    'html5',
    array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
      'style',
      'script',
    )
  );

  // Set up the WordPress core custom background feature.
  add_theme_support(
    'custom-background',
    apply_filters(
      'sextou_theme_custom_background_args',
      array(
        'default-color' => 'ffffff',
        'default-image' => '',
      )
    )
  );

  // Add theme support for selective refresh for widgets.
  add_theme_support('customize-selective-refresh-widgets');

  /**
   * Add support for core custom logo.
   *
   * @link https://codex.wordpress.org/Theme_Logo
   */
  add_theme_support(
    'custom-logo',
    array(
      'height'      => 250,
      'width'       => 250,
      'flex-width'  => true,
      'flex-height' => true,
    )
  );
}
add_action('after_setup_theme', 'sextou_theme_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sextou_theme_content_width()
{
  $GLOBALS['content_width'] = apply_filters('sextou_theme_content_width', 640);
}
add_action('after_setup_theme', 'sextou_theme_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sextou_theme_widgets_init()
{
  register_sidebar(
    array(
      'name'          => esc_html__('Sidebar', 'sextou-theme'),
      'id'            => 'sidebar-1',
      'description'   => esc_html__('Add widgets here.', 'sextou-theme'),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
    )
  );
}
add_action('widgets_init', 'sextou_theme_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function sextou_theme_scripts()
{
  wp_enqueue_style('sextou-theme-style', get_stylesheet_uri(), array(), _S_VERSION);
  wp_style_add_data('sextou-theme-style', 'rtl', 'replace');

  wp_enqueue_script('sextou-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

  if (is_singular() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }
}
add_action('wp_enqueue_scripts', 'sextou_theme_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
  require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Remove default Post type from admin sidebar
 */
function remove_default_post_type()
{
  remove_menu_page('edit.php');
}

/**
 * Register Event post type
 */
function register_edit_types()
{

  $labels = array(
    'name' => _x('Eventos', 'Post Type General Name', 'events'),
    'singular_name' => _x('Evento', 'Post Type Singular Name', 'event'),
    'menu_name' => __('Eventos', 'eventos'),
    'parent_item_colon' => __('Evento Pai', 'eventos'),
    'all_items' => __('Todos os Eventos', 'eventos'),
    'view_item' => __('Ver Evento', 'eventos'),
    'add_new_item' => __('Adicionar novo Evento', 'eventos'),
    'add_new' => __('Adicionar novo', 'eventos'),
    'edit_item' => __('Editar Evento', 'eventos'),
    'update_item' => __('Atualizar Evento', 'eventos'),
    'search_items' => __('Buscar Evento', 'eventos'),
    'not_found' => __('Não encontrado', 'eventos'),
    'not_found_in_trash' => __('Não encontrado na lixeira', 'eventos'),
  );

  $args = array(
    'label' => __('eventos', 'eventos'),
    'description' => __('Eventos criados na plataforma', 'eventos'),
    'labels' => $labels,
    'supports' => array(
      'title',
      'editor',
      'author',
      'thumbnail',
      'comments',
      'revisions',
      'custom-fields',
    ),
    'taxonomies' => array('events-metadata'),
    'hierarchical' => false,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_nav_menus' => true,
    'show_in_admin_bar' => true,
    'menu_position' => 5,
    'can_export' => true,
    'has_archive' => true,
    'exclude_from_search' => false,
    'publicly_queryable' => true,
    'capability_type' => 'post',
    'show_in_rest' => true,
    'supports' => array('title')
  );

  register_post_type('events', $args);
}

/**
 * Register Event Metadata Taxonomy
 */
function register_event_metadata()
{

  $metadata = "Metadado";
  $metadata_plural = $metadata . "s";

  $labels = array(
    'name' => 'Eventos Metadata',
    'singular_name' => $metadata,
    'menu_name' => $metadata_plural,
    'all_items' => "Todos os $metadata_plural",
    'edit_item' => "Editar $metadata",
    'view_item' => "Ver $metadata",
    'update_item' => "Atualizar $metadata",
    'add_new_item' => "Adicionar novo $metadata",
    'new_item_name' => "Novo $metadata",
    'search_items' => "Buscar $metadata_plural",
    'popular_items' => "$metadata_plural populares",
    'separate_items_with_commas' => "Separe $metadata_plural por vírgula",
    'add_or_remove_items' => "Adicionar ou Remover $metadata",
    'choose_from_most_used' => "Escolha dentre os $metadata_plural mais usados",
    'not_found' => "Nenhum $metadata encontrado",
    'no_terms' => "Nehum $metadata",
    'items_list_navigation' => "$metadata_plural list navigation",
    'items_list' => "$metadata_plural list",
  );

  $args = array(
    'hierarchical' => true,
    'labels' => $labels,
    'public' => true,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'event_metadata'),
    'show_in_rest' => true,
  );

  register_taxonomy('event_metadata', 'events', $args);
}

add_action('admin_menu', 'remove_default_post_type');

add_action('init', 'register_edit_types');

add_action('init', 'register_event_metadata');

// function add_pages_to_dropdown($pages, $r)
// {
//   if (!isset($r['name']))
//     return $pages;

//   if ('page_on_front' == $r['name']) {
//     $args = array(
//       'post_type' => 'events'
//     );

//     $portfolios = get_posts($args);
//     $pages = array_merge($pages, $portfolios);
//   }

//   return $pages;
// }
// add_filter('get_pages', 'add_pages_to_dropdown', 10, 2);

function get_user_rsvp($user_id, $event_id)
{
  $rsvp_data = get_user_meta($user_id, 'event_rsvp_data', true);

  // If no data exists, initialize an empty array.
  if (empty($rsvp_data) || !is_array($rsvp_data)) {
    $rsvp_data = array();
  }

  $event_status = isset($rsvp_data[$event_id]) ? $rsvp_data[$event_id] : 'not_attending';

  return $event_status;
}

/**
 * Function to update or retrieve RSVP status for a user and an event.
 *
 * @param int $user_id  The ID of the user.
 * @param int $event_id The ID of the event.
 * @param string $status The RSVP status ('attending', 'maybe', 'not_attending').
 *
 * @return void
 */
function set_user_event_rsvp($user_id, $event_id, $status)
{

  $rsvp_data = get_user_rsvp($user_id, $event_id);

  // If no data exists, initialize an empty array.
  if (empty($rsvp_data) || !is_array($rsvp_data)) {
    $rsvp_data = array();
  }

  $rsvp_data[$event_id] = $status;
  update_user_meta($user_id, 'event_rsvp_data', $rsvp_data);

  return;

  // If $status is provided, update the RSVP status for the event.
  // if ($status !== null) {
  //   $rsvp_data[$event_id] = $status;
  //   update_user_meta($user_id, 'event_rsvp_data', $rsvp_data);
  // }

  // else {
  //   // Retrieve the RSVP status for the event or default to 'not_attending'.
  //   $event_status = isset($rsvp_data[$event_id]) ? $rsvp_data[$event_id] : 'not_attending';
  //   return $event_status;
  // }
}

function inject_external_css()
{

  // Fetch the CSS content
  $external_css_content = file_get_contents(get_template_directory() . '/custom.css');

  if ($external_css_content) {
    echo '<style type="text/css">' . $external_css_content . '</style>';
  }
}

add_action('wp_head', 'inject_external_css');
