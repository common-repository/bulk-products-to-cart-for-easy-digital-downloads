<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://profiles.wordpress.org/himanshud
 * @since      1.0.0
 *
 * @package    Bulk_Products_To_Cart_For_Edd
 * @subpackage Bulk_Products_To_Cart_For_Edd/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * @package    Bulk_Products_To_Cart_For_Edd
 * @subpackage Bulk_Products_To_Cart_For_Edd/public
 * @author     Himanshu Dhakan <himanshudhakan9@gmail.com>
 */
class Bptcfedd_Public {

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
	 * Add scripts for front.
	 *
	 * @since   1.0.0
	 */
	public function bptcfedd_enqueue_scripts() {

		wp_enqueue_script( 'bptcfedd-public-script', BPTCFEDD_PUBLIC_DIR_URL . 'js/bptcfedd-public.js', array( 'jquery' ), BPTCFEDD_VERSION, true );

		$addtocart_success_html = '<span class="edd-cart-added-alert" style="/* display: none; */"><svg class="edd-icon edd-icon-check" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" aria-hidden="true"><path d="M26.11 8.844c0 .39-.157.78-.44 1.062L12.234 23.344c-.28.28-.672.438-1.062.438s-.78-.156-1.06-.438l-7.782-7.78c-.28-.282-.438-.673-.438-1.063s.156-.78.438-1.06l2.125-2.126c.28-.28.672-.438 1.062-.438s.78.156 1.062.438l4.594 4.61L21.42 5.656c.282-.28.673-.438 1.063-.438s.78.155 1.062.437l2.125 2.125c.28.28.438.672.438 1.062z"></path></svg>Added to cart</span>';

		$bptcfedd_public_obj = array(
			'ajaxurl'                => admin_url( 'admin-ajax.php' ),
			'addtocart_success_html' => $addtocart_success_html,
		);

		wp_localize_script( 'bptcfedd-public-script', 'bptcfedd_public_obj', $bptcfedd_public_obj );

	}

	/**
	 * Add styles for front.
	 *
	 * @since   1.0.0
	 */
	public function bptcfedd_enqueue_styles() {

		wp_enqueue_style( 'bptcfedd-public-style', BPTCFEDD_PUBLIC_DIR_URL . 'css/bptcfedd-public.css', array(), BPTCFEDD_VERSION );

	}

	/**
	 * Add to cart products in bulk.
	 *
	 * @since   1.0.0
	 */
	public function bptcfedd_alladdtocart_callback() {

		$response            = array();
		$response['success'] = false;
		$data                = bptcfedd_sanitize_text_field( $_POST );

		if ( isset( $data['bptcfedd_checkbox'] ) && ! empty( $data['bptcfedd_checkbox'] ) ) {

			$ids = $data['bptcfedd_checkbox'];
			foreach ( $ids as $key => $id ) {
				edd_add_to_cart( $id );
			}
			$response['success'] = true;

		}

		wp_send_json( $response );
	}

	/**
	 * Add style for table in head.
	 *
	 * @since   1.0.0
	 */
	public function bptcfedd_print_style() {

		$ap_tab = 'appearence';

		?>
		<style type="text/css">
			th.bptcfedd-head-col {
				background: 
				<?php
				echo bptcfedd_get_value(
					array(
						'table_header',
						'background_color',
					),
					$ap_tab
				);
				?>
				;
				color: 
				<?php
				echo bptcfedd_get_value(
					array(
						'table_header',
						'text_color',
					),
					$ap_tab
				);
				?>
				;
				padding: 
				<?php
				echo bptcfedd_get_value(
					array(
						'table_header',
						'padding',
					),
					$ap_tab
				);
				?>
				;
				border-style: 
				<?php
				echo bptcfedd_get_value(
					array(
						'table_header',
						'boder_style',
					),
					$ap_tab
				);
				?>
				;
				border-width: 
				<?php
				echo bptcfedd_get_value(
					array(
						'table_header',
						'boder_width',
					),
					$ap_tab
				);
				?>
				;
				border-color: 
				<?php
				echo bptcfedd_get_value(
					array(
						'table_header',
						'border_color',
					),
					$ap_tab
				);
				?>
				;
				font-size: 
				<?php
				echo bptcfedd_get_value(
					array(
						'table_header',
						'font_size',
					),
					$ap_tab
				);
				?>
				;
				text-align: 
				<?php
				echo bptcfedd_get_value(
					array(
						'table_header',
						'text_align',
					),
					$ap_tab
				);
				?>
				;
			}
			td.bptcfedd-col-val {
				background: 
				<?php
				echo bptcfedd_get_value(
					array(
						'table_body',
						'background_color',
					),
					$ap_tab
				);
				?>
				;
				color: 
				<?php
				echo bptcfedd_get_value(
					array(
						'table_body',
						'text_color',
					),
					$ap_tab
				);
				?>
				;
				padding: 
				<?php
				echo bptcfedd_get_value(
					array(
						'table_body',
						'padding',
					),
					$ap_tab
				);
				?>
				;
				border-style: 
				<?php
				echo bptcfedd_get_value(
					array(
						'table_body',
						'boder_style',
					),
					$ap_tab
				);
				?>
				;
				border-width: 
				<?php
				echo bptcfedd_get_value(
					array(
						'table_body',
						'boder_width',
					),
					$ap_tab
				);
				?>
				;
				border-color: 
				<?php
				echo bptcfedd_get_value(
					array(
						'table_body',
						'border_color',
					),
					$ap_tab
				);
				?>
				;
				font-size: 
				<?php
				echo bptcfedd_get_value(
					array(
						'table_body',
						'font_size',
					),
					$ap_tab
				);
				?>
				;
				text-align: 
				<?php
				echo bptcfedd_get_value(
					array(
						'table_body',
						'text_align',
					),
					$ap_tab
				);
				?>
				;
			}
			.bptcfedd-table-wrap .page-numbers,
			.bptcfedd-table-wrap a.page-numbers{
				background: 
				<?php
				echo bptcfedd_get_value(
					array(
						'pagination',
						'background_color',
					),
					$ap_tab
				);
				?>
				;
				color: 
				<?php
				echo bptcfedd_get_value(
					array(
						'pagination',
						'text_color',
					),
					$ap_tab
				);
				?>
				;
				padding: 
				<?php
				echo bptcfedd_get_value(
					array(
						'pagination',
						'padding',
					),
					$ap_tab
				);
				?>
				;
				border-style: 
				<?php
				echo bptcfedd_get_value(
					array(
						'pagination',
						'boder_style',
					),
					$ap_tab
				);
				?>
				;
				border-width: 
				<?php
				echo bptcfedd_get_value(
					array(
						'pagination',
						'boder_width',
					),
					$ap_tab
				);
				?>
				;
				border-color: 
				<?php
				echo bptcfedd_get_value(
					array(
						'pagination',
						'border_color',
					),
					$ap_tab
				);
				?>
				;
				font-size: 
				<?php
				echo bptcfedd_get_value(
					array(
						'pagination',
						'font_size',
					),
					$ap_tab
				);
				?>
				;
				text-decoration: none;
			}
			.bptcfedd-table-wrap .page-numbers.current {
				background: 
				<?php
				echo bptcfedd_get_value(
					array(
						'pagination',
						'active_background_color',
					),
					$ap_tab
				);
				?>
				;
				color: 
				<?php
				echo bptcfedd_get_value(
					array(
						'pagination',
						'active_text_color',
					),
					$ap_tab
				);
				?>
				;
			}
		</style>
		<?php

	}

	/**
	 * Add all hooks
	 *
	 * @since   1.0.0
	 */
	public function add_hooks() {

		add_action( 'wp_enqueue_scripts', array( $this, 'bptcfedd_enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'bptcfedd_enqueue_styles' ) );
		add_action( 'wp_ajax_bptcfedd_alladdtocart', array( $this, 'bptcfedd_alladdtocart_callback' ) );
		add_action( 'wp_head', array( $this, 'bptcfedd_print_style' ) );

	}

}
