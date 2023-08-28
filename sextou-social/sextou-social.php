<?php

/**
 * Sextou! Social
 *
 * @package       SEXTOUSOC
 * @author        Didico
 * @version       1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:   Sextou! Social
 * Plugin URI:    https://sextou.rio/
 * Description:   Funções Social para Sextou!
 * Version:       1.0.0
 * Author:        Didico
 * Author URI:    github.com/didiraja
 * Text Domain:   sextou-social
 * Domain Path:   /languages
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

/**
 * HELPER COMMENT START
 * 
 * This file contains the main information about the plugin.
 * It is used to register all components necessary to run the plugin.
 * 
 * The comment above contains all information about the plugin 
 * that are used by WordPress to differenciate the plugin and register it properly.
 * It also contains further PHPDocs parameter for a better documentation
 * 
 * The function SEXTOUSOC() is the main function that you will be able to 
 * use throughout your plugin to extend the logic. Further information
 * about that is available within the sub classes.
 * 
 * HELPER COMMENT END
 */

// Plugin name
define('SEXTOUSOC_NAME',      'Sextou! Social');

// Plugin version
define('SEXTOUSOC_VERSION',    '1.0.0');

// Plugin Root File
define('SEXTOUSOC_PLUGIN_FILE',  __FILE__);

// Plugin base
define('SEXTOUSOC_PLUGIN_BASE',  plugin_basename(SEXTOUSOC_PLUGIN_FILE));

// Plugin Folder Path
define('SEXTOUSOC_PLUGIN_DIR',  plugin_dir_path(SEXTOUSOC_PLUGIN_FILE));

// Plugin Folder URL
define('SEXTOUSOC_PLUGIN_URL',  plugin_dir_url(SEXTOUSOC_PLUGIN_FILE));

/**
 * Load the main class for the core functionality
 */
require_once SEXTOUSOC_PLUGIN_DIR . 'core/class-sextou-social.php';

/**
 * The main function to load the only instance
 * of our master class.
 *
 * @author  Didico
 * @since   1.0.0
 * @return  object|Sextou_Social
 */
function SEXTOUSOC()
{
  return Sextou_Social::instance();
}

SEXTOUSOC();

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
