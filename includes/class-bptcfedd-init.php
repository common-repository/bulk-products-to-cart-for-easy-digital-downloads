<?php
/**
 * The initialization of the plugin.
 *
 * @link       https://profiles.wordpress.org/himanshud
 * @since      1.0.0
 *
 * @package    Bulk_Products_To_Cart_For_Edd
 * @subpackage Bulk_Products_To_Cart_For_Edd/includes
 */

/**
 * The initialization of the plugin.
 *
 * @package    Bulk_Products_To_Cart_For_Edd
 * @subpackage Bulk_Products_To_Cart_For_Edd/includes
 * @author     Himanshu Dhakan <himanshudhakan9@gmail.com>
 */
class Bptcfedd_Init {

	/**
	 * Register custom post types
	 *
	 * @since   1.0.0
	 */
	public function bptcfedd_register_post_type() {

		$labels = array(
			'name'               => _x( 'Product Tables', 'Post type general name', 'bptcfedd' ),
			'singular_name'      => _x( 'Product Table', 'Post type singular name', 'bptcfedd' ),
			'menu_name'          => _x( 'EDD Product Tables', 'Admin Menu text', 'bptcfedd' ),
			'name_admin_bar'     => _x( 'Product Table', 'Add New on Toolbar', 'bptcfedd' ),
			'add_new'            => __( 'Add New', 'bptcfedd' ),
			'add_new_item'       => __( 'Add New Product Table', 'bptcfedd' ),
			'new_item'           => __( 'New Product Table', 'bptcfedd' ),
			'edit_item'          => __( 'Edit Product Table', 'bptcfedd' ),
			'view_item'          => __( 'View Product Table', 'bptcfedd' ),
			'all_items'          => __( 'All Product Tables', 'bptcfedd' ),
			'search_items'       => __( 'Search Product Tables', 'bptcfedd' ),
			'parent_item_colon'  => __( 'Parent Product Tables:', 'bptcfedd' ),
			'not_found'          => __( 'No product tables found.', 'bptcfedd' ),
			'not_found_in_trash' => __( 'No product tables found in Trash.', 'bptcfedd' ),
		);

		$args = array(
			'labels'              => $labels,
			'public'              => true,
			'has_archive'         => false,
			'hierarchical'        => false,
			'show_in_nav_menus'   => true,
			'supports'            => array( 'title' ),
			'publicly_queryable'  => false,
			'exclude_from_search' => true,
			'menu_icon'           => 'dashicons-editor-table',
			'can_export'          => true,
			'rewrite'             => array(
				'slug' => 'bptcfedd_tables',
			),
			'menu_position'       => null,
		);

		register_post_type( 'bptcfedd_tables', $args );

	}

	/**
	 * Add all hooks
	 *
	 * @since   1.0.0
	 */
	public function add_hooks() {

		add_action( 'init', array( $this, 'bptcfedd_register_post_type' ) );

	}


}
