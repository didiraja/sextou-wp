<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * HELPER COMMENT START
 * 
 * This is the main class that is responsible for registering
 * the core functions, including the files and setting up all features. 
 * 
 * To add a new class, here's what you need to do: 
 * 1. Add your new class within the following folder: core/includes/classes
 * 2. Create a new variable you want to assign the class to (as e.g. public $helpers)
 * 3. Assign the class within the instance() function ( as e.g. self::$instance->helpers = new Sextou_Social_Helpers();)
 * 4. Register the class you added to core/includes/classes within the includes() function
 * 
 * HELPER COMMENT END
 */

if ( ! class_exists( 'Sextou_Social' ) ) :

	/**
	 * Main Sextou_Social Class.
	 *
	 * @package		SEXTOUSOC
	 * @subpackage	Classes/Sextou_Social
	 * @since		1.0.0
	 * @author		Didico
	 */
	final class Sextou_Social {

		/**
		 * The real instance
		 *
		 * @access	private
		 * @since	1.0.0
		 * @var		object|Sextou_Social
		 */
		private static $instance;

		/**
		 * SEXTOUSOC helpers object.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @var		object|Sextou_Social_Helpers
		 */
		public $helpers;

		/**
		 * SEXTOUSOC settings object.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @var		object|Sextou_Social_Settings
		 */
		public $settings;

		/**
		 * Throw error on object clone.
		 *
		 * Cloning instances of the class is forbidden.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @return	void
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to clone this class.', 'sextou-social' ), '1.0.0' );
		}

		/**
		 * Disable unserializing of the class.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @return	void
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to unserialize this class.', 'sextou-social' ), '1.0.0' );
		}

		/**
		 * Main Sextou_Social Instance.
		 *
		 * Insures that only one instance of Sextou_Social exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @access		public
		 * @since		1.0.0
		 * @static
		 * @return		object|Sextou_Social	The one true Sextou_Social
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Sextou_Social ) ) {
				self::$instance					= new Sextou_Social;
				self::$instance->base_hooks();
				self::$instance->includes();
				self::$instance->helpers		= new Sextou_Social_Helpers();
				self::$instance->settings		= new Sextou_Social_Settings();

				//Fire the plugin logic
				new Sextou_Social_Run();

				/**
				 * Fire a custom action to allow dependencies
				 * after the successful plugin setup
				 */
				do_action( 'SEXTOUSOC/plugin_loaded' );
			}

			return self::$instance;
		}

		/**
		 * Include required files.
		 *
		 * @access  private
		 * @since   1.0.0
		 * @return  void
		 */
		private function includes() {
			require_once SEXTOUSOC_PLUGIN_DIR . 'core/includes/classes/class-sextou-social-helpers.php';
			require_once SEXTOUSOC_PLUGIN_DIR . 'core/includes/classes/class-sextou-social-settings.php';

			require_once SEXTOUSOC_PLUGIN_DIR . 'core/includes/classes/class-sextou-social-run.php';
		}

		/**
		 * Add base hooks for the core functionality
		 *
		 * @access  private
		 * @since   1.0.0
		 * @return  void
		 */
		private function base_hooks() {
			add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
		}

		/**
		 * Loads the plugin language files.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @return  void
		 */
		public function load_textdomain() {
			load_plugin_textdomain( 'sextou-social', FALSE, dirname( plugin_basename( SEXTOUSOC_PLUGIN_FILE ) ) . '/languages/' );
		}

	}

endif; // End if class_exists check.