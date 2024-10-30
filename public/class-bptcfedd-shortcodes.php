<?php
/**
 * The shortcodes functionality of the plugin.
 *
 * @link       https://profiles.wordpress.org/himanshud
 * @since      1.0.0
 *
 * @package    Bulk_Products_To_Cart_For_Edd
 * @subpackage Bulk_Products_To_Cart_For_Edd/public
 */

/**
 * The shortcodes functionality of the plugin.
 *
 * @package    Bulk_Products_To_Cart_For_Edd
 * @subpackage Bulk_Products_To_Cart_For_Edd/public
 * @author     Himanshu Dhakan <himanshudhakan9@gmail.com>
 */
class Bptcfedd_Shortcodes {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    string $plugin_name       The name of the plugin.
	 * @param    string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Display product table
	 *
	 * @since    1.0.0
	 * @param    array $atts    The shortcode attitudes.
	 */
	public function bptcfedd_table_shortcode( $atts ) {

		global $bptcfedd_tatts,$table_id,$bptcfedd_table;
		$bptcfedd_tatts = $atts;

		$atts = shortcode_atts(
			array(
				'id' => '',
			),
			$atts,
			'bptcfedd_table'
		);

		if ( empty( $atts['id'] ) ) {
			return;
		}
		
		$table_id       = intval( $atts['id'] );
		$get_table      = get_post( $table_id );
		if ( empty( $get_table ) ||
				'publish' != $get_table->post_status ||
					'bptcfedd_tables' != $get_table->post_type ) {
			return;
		}
		$bptcfedd_table = new Bptcfedd_Product_Table( $table_id );

		ob_start();

		bptcfedd_get_template( 'shortcodes/bptcfedd-table.php', BPTCFEDD_PUBLIC_TEMPLATE_PATH );

		return ob_get_clean();

	}

	/**
	 * Add all hooks
	 *
	 * @since   1.0.0
	 */
	public function add_hooks() {

		add_shortcode( 'bptcfedd_table', array( $this, 'bptcfedd_table_shortcode' ) );

	}

}
