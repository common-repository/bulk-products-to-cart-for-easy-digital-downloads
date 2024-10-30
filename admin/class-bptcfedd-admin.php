<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://profiles.wordpress.org/himanshud
 * @since      1.0.0
 *
 * @package    Bulk_Products_To_Cart_For_Edd
 * @subpackage Bulk_Products_To_Cart_For_Edd/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * @package    Bulk_Products_To_Cart_For_Edd
 * @subpackage Bulk_Products_To_Cart_For_Edd/admin
 * @author     Himanshu Dhakan <himanshudhakan9@gmail.com>
 */
class Bptcfedd_Admin {

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
	 * The array of allowed screens ids to enqueue scripts.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      array    $allowed_screen_id    The array of screens ids.
	 */
	public $allowed_screen_id;

	/**
	 * The array of post types to enqueue scripts.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      array    $allowed_post_types    The array of post types.
	 */
	public $allowed_post_types;

	/**
	 * The object of settings calss.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      object    $bptcfedd_settings    The object of settings calss.
	 */
	public $bptcfedd_settings;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since   1.0.0
	 * @param   string $plugin_name       The name of this plugin.
	 * @param   string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name        = $plugin_name;
		$this->version            = $version;
		$this->allowed_screen_id  = array(
			'bptcfedd_tables_page_bptcfedd_settings',
		);
		$this->allowed_post_types = array(
			'bptcfedd_tables',
		);
		$this->bptcfedd_settings  = new Bptcfedd_Admin_Settings();

	}

	/**
	 * Add settings page to admin dashboard.
	 *
	 * @since   1.0.0
	 */
	public function bptcfedd_add_admin_page() {

		add_submenu_page(
			'edit.php?post_type=bptcfedd_tables',
			__( 'EDD Product Table Settings', 'bptcfedd' ),
			__( 'Settings', 'bptcfedd' ),
			'manage_options',
			'bptcfedd_settings',
			array( $this, 'bptcfedd_add_admin_page_callback' )
		);

	}

	/**
	 * Add scripts for admin.
	 *
	 * @since   1.0.0
	 * @param   string $hook_suffix    The current page/screen id.
	 */
	public function bptcfedd_enqueue_scripts( $hook_suffix ) {

		$post_type = get_post_type();
		wp_register_script( 'bptcfedd-select-script', BPTCFEDD_LIBS_DIR_URL . 'js/select2.min.js', array( 'jquery' ), BPTCFEDD_VERSION, true );
		wp_register_script( 'bptcfedd-admin-script', BPTCFEDD_ADMIN_DIR_URL . 'js/admin.js', array( 'jquery', 'wp-color-picker', 'wp-i18n' ), BPTCFEDD_VERSION, true );

		if ( in_array( $hook_suffix, $this->allowed_screen_id, true ) ||
				in_array( $post_type, $this->allowed_post_types, true ) ) {

			$bptcfedd_admin_obj = array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'ajax-nonce' ),
			);

			wp_enqueue_script( 'bptcfedd-select-script' );
			wp_enqueue_script( 'bptcfedd-admin-script' );
			wp_localize_script( 'bptcfedd-admin-script', 'bptcfedd_admin_obj', $bptcfedd_admin_obj );
		}

	}

	/**
	 * Add styles for admin.
	 *
	 * @since   1.0.0
	 * @param   string $hook_suffix    The current page/screen id.
	 */
	public function bptcfedd_enqueue_styles( $hook_suffix ) {

		$post_type = get_post_type();
		wp_register_style( 'bptcfedd-select-style', BPTCFEDD_LIBS_DIR_URL . 'css/select2.min.css', array(), BPTCFEDD_VERSION );
		wp_register_style( 'bptcfedd-admin-style', BPTCFEDD_ADMIN_DIR_URL . 'css/admin.css', array(), BPTCFEDD_VERSION );

		if ( in_array( $hook_suffix, $this->allowed_screen_id, true ) || in_array( $post_type, $this->allowed_post_types, true ) ) {
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'bptcfedd-select-style' );
			wp_enqueue_style( 'bptcfedd-admin-style' );
		}

	}

	/**
	 * Add settings page callback.
	 *
	 * @since   1.0.0
	 */
	public function bptcfedd_add_admin_page_callback() {

		global $bptcfedd_settings;
		$bptcfedd_settings = $this->bptcfedd_settings;

		bptcfedd_get_template( 'bptcfedd-admin-settings.php', BPTCFEDD_ADMIN_TEMPLATE_PATH );

	}

	/**
	 * Add meta boxes to bptcfedd_tables post type.
	 *
	 * @since   1.0.0
	 * @param   string $post_type    The current post type.
	 */
	public function bptcfedd_add_meta_boxes( $post_type ) {

		if ( 'bptcfedd_tables' == $post_type ) {
			add_meta_box(
				'bptcfedd_table_columns',
				__( 'Columns', 'bptcfedd' ),
				array( $this, 'bptcfedd_columns_meta_box_content' ),
				$post_type,
				'advanced',
				'high'
			);
			add_meta_box(
				'bptcfedd_table_conditions',
				__( 'Conditions', 'bptcfedd' ),
				array( $this, 'bptcfedd_conditions_meta_box_content' ),
				$post_type,
				'advanced',
				'high'
			);
		}

	}

	/**
	 * Render columns meta box content.
	 *
	 * @since   1.0.0
	 * @param   WP_Post $post    The post object.
	 */
	public function bptcfedd_columns_meta_box_content( $post ) {

		bptcfedd_get_template( 'metaboxes/bptcfedd-metabox-columns.php', BPTCFEDD_ADMIN_TEMPLATE_PATH );

	}

	/**
	 * Render conditions meta box content.
	 *
	 * @since   1.0.0
	 * @param   WP_Post $post    The post object.
	 */
	public function bptcfedd_conditions_meta_box_content( $post ) {

		bptcfedd_get_template( 'metaboxes/bptcfedd-metabox-conditions.php', BPTCFEDD_ADMIN_TEMPLATE_PATH );

	}

	/**
	 * Search downloads by keyword.
	 *
	 * @since   1.0.0
	 */
	public function bptcfedd_search_downloads_callback() {

		$respons = array();

		if ( ! isset( $_POST['nonce'] ) ) {
			return;
		}

		$nonce = bptcfedd_sanitize_text_field( $_POST['nonce'] );
		if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) {
			return;
		}

		if ( isset( $_POST['search_text'] ) && ! empty( $_POST['search_text'] ) ) {

			$search_text     = bptcfedd_sanitize_text_field( $_POST['search_text'] );
			$respons['data'] = bptcfedd_search_downloads( 'title', $search_text );

		}

		wp_send_json( $respons );
	}

	/**
	 * Save table post meta data
	 *
	 * @since   1.0.0
	 * @param   int     $table_id    The post id.
	 * @param   WP_Post $download    The post object.
	 */
	public function bptcfedd_save_metadata( $table_id, $download ) {

		if ( ! isset( $_POST['bptcfedd_table_meta_nonce'] ) ) {
			return;
		}

		$nonce = bptcfedd_sanitize_text_field( $_POST['bptcfedd_table_meta_nonce'] );
		if ( ! wp_verify_nonce( $_POST['bptcfedd_table_meta_nonce'], 'bptcfedd_table_meta' ) ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $table_id ) ) {
			return;
		}

		if ( isset( $_POST['bptcfedd_columns'] ) ) {
			$sani_bptcfedd_columns = bptcfedd_sanitize_text_field( $_POST['bptcfedd_columns'] );
			update_post_meta( $table_id, 'bptcfedd_columns', $sani_bptcfedd_columns );
		}

		if ( isset( $_POST['bptcfedd_conditions'] ) ) {
			$sani_bptcfedd_conditions = bptcfedd_sanitize_text_field( $_POST['bptcfedd_conditions'] );
			update_post_meta( $table_id, 'bptcfedd_conditions', $sani_bptcfedd_conditions );
		}

	}

	/**
	 * Add custom column to admin list table
	 *
	 * @since   1.0.0
	 * @param   array $columns    The array of columns.
	 */
	public function bptcfedd_custom_posttype_columns( $columns ) {

		$date = $columns['date'];
		unset( $columns['date'] );
		$columns['shortcode'] = __( 'Shortcode', 'bptcfedd' );
		$columns['date']      = $date;

		return $columns;

	}

	/**
	 * Add custom column content
	 *
	 * @since   1.0.0
	 * @param   string $column     The column name.
	 * @param   int    $post_id    The id of current post.
	 */
	public function bptcfedd_custom_posttype( $column, $post_id ) {

		switch ( $column ) {

			case 'shortcode':
				$inp_val = sprintf( '[bptcfedd_table id="%d"]', $post_id );
				?>
				<div class="bptcfedd-shortcode-wrap">
					<input type="text" class="bptcfedd-shortcode" value="<?php echo esc_attr( $inp_val ); ?>">
					<div class="bptcfedd-shortcode-copy-wrap">
						<span class="bptcfedd-shortcode-copy-text buttons">
							<button type="button" class="button bptcfedd-shortcode-copy-btn"><?php esc_html_e( 'Copy', 'bptcfedd' ); ?></button>
						</span>
					</div>
				</div>
				<?php
				break;

		}

	}

	/**
	 * Add custom action links on plugi listing
	 *
	 * @since  1.0
	 * @param  array $actions    The array of actions.
	 * @return array    $actions    The array of actions.
	 */
	public function bptcfedd_action_links( $actions ) {

		$settings_url        = add_query_arg(
			array(
				'post_type' => 'bptcfedd_tables',
				'page'      => 'bptcfedd_settings',
			),
			admin_url( 'edit.php' )
		);
		$actions['settings'] = '<a href="' . esc_url( $settings_url ) . '">' . esc_html__( 'Settings', 'bptcfedd' ) . '</a>';

		return $actions;

	}

	/**
	 * Add all hooks
	 *
	 * @since   1.0.0
	 */
	public function add_hooks() {

		add_action( 'admin_menu', array( $this, 'bptcfedd_add_admin_page' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'bptcfedd_enqueue_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'bptcfedd_enqueue_styles' ) );
		add_action( 'add_meta_boxes', array( $this, 'bptcfedd_add_meta_boxes' ) );
		add_action( 'save_post_bptcfedd_tables', array( $this, 'bptcfedd_save_metadata' ), 10, 2 );
		add_action( 'wp_ajax_bptcfedd_search_downloads', array( $this, 'bptcfedd_search_downloads_callback' ) );
		add_filter( 'manage_bptcfedd_tables_posts_columns', array( $this, 'bptcfedd_custom_posttype_columns' ) );
		add_action( 'manage_bptcfedd_tables_posts_custom_column', array( $this, 'bptcfedd_custom_posttype' ), 10, 2 );
		add_filter( 'plugin_action_links_bulk-products-to-cart-for-edd/bulk-products-to-cart-for-edd.php', array( $this, 'bptcfedd_action_links' ), 10 );

	}

}
