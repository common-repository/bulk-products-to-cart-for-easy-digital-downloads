<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://profiles.wordpress.org/himanshud
 * @since      1.0.0
 *
 * @package    Bulk_Products_To_Cart_For_Edd
 * @subpackage Bulk_Products_To_Cart_For_Edd/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Bulk_Products_To_Cart_For_Edd
 * @subpackage Bulk_Products_To_Cart_For_Edd/includes
 * @author     Himanshu Dhakan <himanshudhakan9@gmail.com>
 */
class Bulk_Products_To_Cart_For_Edd {

	/**
	 * The instances of classes.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $classes    The instances of all classes.
	 */
	protected $classes;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'BPTCFEDD_VERSION' ) ) {
			$this->version = BPTCFEDD_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'bulk-products-to-cart-for-edd';

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Defines core functions available on both the front-end and admin.
	 * - Bulk_Products_To_Cart_For_Edd_i18n. Defines internationalization functionality.
	 * - Bulk_Products_To_Cart_For_Edd_Init. Defines initialization functionality.
	 * - Bulk_Products_To_Cart_For_Edd_Admin. Defines all hooks for the admin area.
	 * - Bulk_Products_To_Cart_For_Edd_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The core functions available on both the front-end and admin of the plugin.
		 */
		require_once BPTCFEDD_INC_DIR_PATH . 'bptcfedd-functions.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once BPTCFEDD_INC_DIR_PATH . 'class-bptcfedd-i18n.php';

		/**
		 * The class responsible for defining all actions for initialization of the plugin.
		 */
		require_once BPTCFEDD_INC_DIR_PATH . 'class-bptcfedd-init.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once BPTCFEDD_ADMIN_DIR_PATH . 'class-bptcfedd-admin.php';

		/**
		 * The class responsible for defining all settings of this plugin.
		 */
		require_once BPTCFEDD_ADMIN_DIR_PATH . 'class-bptcfedd-admin-settings.php';

		/**
		 * The class responsible for defining all actions for display table.
		 */
		require_once BPTCFEDD_PUBLIC_DIR_PATH . 'class-bptcfedd-product-table.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the plugin.
		 */
		require_once BPTCFEDD_PUBLIC_DIR_PATH . 'class-bptcfedd-public.php';

		/**
		 * The class responsible for defining all shortcodes of the plugin.
		 */
		require_once BPTCFEDD_PUBLIC_DIR_PATH . 'class-bptcfedd-shortcodes.php';

		$plugin_i18n       = new Bptcfedd_I18n();
		$plugin_init       = new Bptcfedd_Init();
		$plugin_admin      = new Bptcfedd_Admin( $this->get_plugin_name(), $this->get_version() );
		$plugin_settings   = new Bptcfedd_Admin_Settings();
		$plugin_public     = new Bptcfedd_Public( $this->get_plugin_name(), $this->get_version() );
		$plugin_shortcodes = new Bptcfedd_Shortcodes( $this->get_plugin_name(), $this->get_version() );

		$this->classes['i18n']       = $plugin_i18n;
		$this->classes['init']       = $plugin_init;
		$this->classes['admin']      = $plugin_admin;
		$this->classes['settings']   = $plugin_settings;
		$this->classes['public']     = $plugin_public;
		$this->classes['shortcodes'] = $plugin_shortcodes;

	}

	/**
	 * Register all of the hooks of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_hooks() {

		if ( ! empty( $this->classes ) ) {

			foreach ( $this->classes as $key => $object ) {

				if ( method_exists( $object, 'add_hooks' ) ) {

					$object->add_hooks();

				}
			}
		}

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {

		$this->load_dependencies();
		$this->define_hooks();

	}

	/**
	 * Deactivate this plugin if EDD is not activate.
	 *
	 * @since    1.0.0
	 */
	public function bptcfedd_deactivate() {

		if ( ! function_exists( 'deactivate_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		add_action( 'admin_notices', array( $this, 'bptcfedd_edd_check_notice' ) );
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
			$_GET['deactivate'] = true;
		}
		deactivate_plugins( BPTCFEDD_FILE, true );

	}

	/**
	 * Display notice if EDD is not activate.
	 *
	 * @since    1.0.0
	 */
	public function bptcfedd_edd_check_notice() {

		$plugin_name = sprintf( '<strong>%s</strong>', esc_html( 'Bulk Products to Cart for Easy Digital Downloads' ) );
		$message     = esc_html( 'plugin requires Easy Digital Downloads in order to work. So please ensure that Easy Digital Downloads is installed and activated.' );
		$notice      = sprintf( '%s %s', $plugin_name, $message );

		?>
		<div class="error notice is-dismissible">
			<p>
			<?php 
			echo wp_kses( 
				$notice, 
			 	array(
		        	'strong' => array(),
		    	)
			);
    		?>
    		</p>
		</div>
		<?php
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
