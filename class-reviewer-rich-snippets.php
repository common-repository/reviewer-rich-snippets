<?php

// Global namespace helper function for easier access
namespace {
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	if ( ! function_exists( 'Reviewer_Rich_Snippets' ) ) {

		/**
		 * The main function responsible for returning the Reviewer object.
		 *
		 * Use this function like you would a global variable, except without needing to declare the global.
		 *
		 * Example: <?php Reviewer_Rich_Snippets()->method_name(); ?>
		 *
		 * @since 1.0.0
		 *
		 * @return  object  Reviewer class object.
		 */
		function Reviewer_Rich_Snippets() {

			return \Reviewer_Rich_Snippets\Reviewer_Rich_Snippets::instance();

		}


	}

}


namespace Reviewer_Rich_Snippets {

	/**
	 * Main plugin class.
	 *
	 * Main class initializes the plugin.
	 * If you'd like to call the plugin instance, use Reviewer_Rich_Snippets().
	 *
	 * @since  1.0.0
	 * @author Jeroen Sormani
	 */
	class Reviewer_Rich_Snippets {


		/**
		 * @since 1.0.0
		 * @var string $version Plugin version number.
		 */
		public $version = '1.0.0';


		/**
		 * @since 1.0.0
		 * @var string $file Plugin file path.
		 */
		public $file = REVIEWER_RICH_SNIPPETS_FILE;


		/**
		 * Instance of Reviewer Rich Snippets.
		 *
		 * @since 1.0.0
		 * @access private
		 * @var object $instance The instance of Reviewer.
		 */
		private static $instance;


		/**
		 * Construct.
		 *
		 * Initialize the class and plugin.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {}


		/**
		 * Instance.
		 *
		 * An global instance of the class. Used to retrieve the instance
		 * to use on other files/plugins/themes.
		 *
		 * @since 1.0.0
		 * @return  object  Instance of the class.
		 */
		public static function instance() {

			if ( is_null( self::$instance ) ) :
				self::$instance = new self();
			endif;

			return self::$instance;

		}


		/**
		 * Init.
		 *
		 * Initialize plugin parts.
		 *
		 * @since 1.0.0
		 */
		public function init() {

			if ( ! function_exists( 'Reviewer' ) ) {
				return;
			}

			$this->includes();

			// Load textdomain
			$this->load_textdomain();

			do_action( 'reviewer_rich_snippets_init' );

		}


		/**
		 * Include files.
		 *
		 * Including files manually till there's a good solution for autoloading.
		 *
		 * @since 1.0.0
		 */
		private function includes() {

			// Functions
			require_once plugin_dir_path( $this->file ) . 'includes/template-functions.php';

		}


		/**
		 * Textdomain.
		 *
		 * Load the textdomain based on WP language.
		 *
		 * @since 1.0.0
		 */
		public function load_textdomain() {

			$locale = apply_filters( 'plugin_locale', get_locale(), 'reviewer-rich-snippets' );

			// Load textdomain
			load_textdomain( 'reviewer-rich-snippets', WP_LANG_DIR . '/reviewer-rich-snippets/reviewer-rich-snippets-' . $locale . '.mo' );
			load_plugin_textdomain( 'reviewer-rich-snippets', false, basename( dirname( __FILE__ ) ) . '/languages' );

		}


	}

	// Initialize plugin
	add_action( 'plugins_loaded', array( Reviewer_Rich_Snippets(), 'init' ), 20 );
//	Reviewer_Rich_Snippets()->init();

}
