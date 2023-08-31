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



// function get_user_rsvp($user_id, $event_id)
// {
//   $rsvp_data = get_user_meta($user_id, 'event_rsvp_data', true);

//   // If no data exists, initialize an empty array.
//   if (empty($rsvp_data) || !is_array($rsvp_data)) {
//     $rsvp_data = array();
//   }

//   $event_status = isset($rsvp_data[$event_id]) ? $rsvp_data[$event_id] : 'not_attending';

//   return $event_status;
// }

// /**
//  * Function to update or retrieve RSVP status for a user and an event.
//  *
//  * @param int $user_id  The ID of the user.
//  * @param int $event_id The ID of the event.
//  * @param string $status The RSVP status ('attending', 'maybe', 'not_attending').
//  *
//  * @return void
//  */
// function set_user_event_rsvp($user_id, $event_id, $status)
// {

//   $rsvp_data = get_user_rsvp($user_id, $event_id);

//   // If no data exists, initialize an empty array.
//   if (empty($rsvp_data) || !is_array($rsvp_data)) {
//     $rsvp_data = array();
//   }

//   $rsvp_data[$event_id] = $status;
//   update_user_meta($user_id, 'event_rsvp_data', $rsvp_data);

//   return;

//   // If $status is provided, update the RSVP status for the event.
//   // if ($status !== null) {
//   //   $rsvp_data[$event_id] = $status;
//   //   update_user_meta($user_id, 'event_rsvp_data', $rsvp_data);
//   // }

//   // else {
//   //   // Retrieve the RSVP status for the event or default to 'not_attending'.
//   //   $event_status = isset($rsvp_data[$event_id]) ? $rsvp_data[$event_id] : 'not_attending';
//   //   return $event_status;
//   // }
// }
