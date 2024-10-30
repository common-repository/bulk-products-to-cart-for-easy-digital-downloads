<?php
/**
 * The admin settings functionality of the plugin.
 *
 * @link       https://profiles.wordpress.org/himanshud
 * @since      1.0.0
 *
 * @package    Bulk_Products_To_Cart_For_Edd
 * @subpackage Bulk_Products_To_Cart_For_Edd/admin
 */

/**
 * The admin settings functionality of the plugin.
 *
 * @package    Bulk_Products_To_Cart_For_Edd
 * @subpackage Bulk_Products_To_Cart_For_Edd/admin
 * @author     Himanshu Dhakan <himanshudhakan9@gmail.com>
 */
class Bptcfedd_Admin_Settings {

	/**
	 * The array of border types.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      array    $border_types    The array of border types.
	 */
	public $border_types;

	/**
	 * The array of text align types.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      array    $text_align_types    The array of text align types.
	 */
	public $text_align_types;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since   1.0.0
	 */
	public function __construct() {

		$this->border_types     = bptcfedd_get_def_borders();
		$this->text_align_types = bptcfedd_get_def_text_align();

	}

	/**
	 * Get all settings tabs.
	 *
	 * @since     1.0.0
	 * @return    array    $tabs    The settings tabs.
	 */
	public function bptcfedd_get_tabs() {

		$tabs = array(
			array(
				'id'     => 'labels',
				'title'  => esc_html__( 'Labels', 'bptcfedd' ),
				'fields' => $this->bptcfedd_get_labels_tab_fields(),
			),
			array(
				'id'     => 'appearence',
				'title'  => esc_html__( 'Appearence', 'bptcfedd' ),
				'fields' => $this->bptcfedd_get_appearence_tab_fields(),
			),
		);

		return $tabs;
	}

	/**
	 * Get labels tab settings fields.
	 *
	 * @since     1.0.0
	 * @return    array    $fields    The fields of labels tab.
	 */
	public function bptcfedd_get_labels_tab_fields() {

		$tab = 'labels';

		$fields = array(
			array(
				'id'    => 'table_header',
				'type'  => 'heading',
				'title' => __( 'Table header', 'bptcfedd' ),
			),
		);

		$columns = bptcfedd_get_def_columns();

		foreach ( $columns as $cid => $column ) {

			$fields[] = array(
				'id'         => $cid,
				'type'       => 'input',
				'input_type' => 'text',
				'title'      => $column,
				'attributes' => array(
					'placeholder="' . $column . '"',
				),
				'value'      => bptcfedd_get_value( $cid, $tab ),
			);

		}

		$button_labels = array(
			array(
				'id'    => 'button',
				'type'  => 'heading',
				'title' => __( 'Button', 'bptcfedd' ),
			),
			array(
				'id'         => 'all_to_cart',
				'type'       => 'input',
				'input_type' => 'text',
				'title'      => __( 'All To Cart', 'bptcfedd' ),
				'attributes' => array(
					'placeholder="' . __( 'All To Cart', 'bptcfedd' ) . '"',
				),
				'value'      => bptcfedd_get_value( 'all_to_cart', $tab ),
			),
		);

		$fields = array_merge( $fields, $button_labels );

		return $fields;

	}

	/**
	 * Get appearence tab settings fields.
	 *
	 * @since     1.0.0
	 * @return    array    $fields    The fields of appearence tab.
	 */
	public function bptcfedd_get_appearence_tab_fields() {

		$tab = 'appearence';

		$table_header_fields = array(
			array(
				'id'    => 'table_header_style',
				'type'  => 'heading',
				'title' => __( 'Table header', 'bptcfedd' ),
			),
			array(
				'id'         => 'background_color',
				'type'       => 'input',
				'input_type' => 'text',
				'title'      => __( 'Background Color', 'bptcfedd' ),
				'attributes' => array(
					'class="bptcfedd-color-field"',
					'data-default-color="#428bca"',
				),
				'depth'      => array( 'table_header' ),
				'value'      => bptcfedd_get_value(
					array(
						'table_header',
						'background_color',
					),
					$tab,
				),
			),
			array(
				'id'         => 'border_color',
				'type'       => 'input',
				'input_type' => 'text',
				'title'      => __( 'Border Color', 'bptcfedd' ),
				'attributes' => array(
					'class="bptcfedd-color-field"',
					'data-default-color="#eee"',
				),
				'depth'      => array( 'table_header' ),
				'value'      => bptcfedd_get_value(
					array(
						'table_header',
						'border_color',
					),
					$tab,
				),
			),
			array(
				'id'         => 'font_size',
				'type'       => 'input',
				'input_type' => 'text',
				'title'      => __( 'Font Size', 'bptcfedd' ),
				'attributes' => array(
					'placeholder="1px"',
				),
				'depth'      => array( 'table_header' ),
				'value'      => bptcfedd_get_value(
					array(
						'table_header',
						'font_size',
					),
					$tab,
				),
			),
			array(
				'id'         => 'text_color',
				'type'       => 'input',
				'input_type' => 'text',
				'title'      => __( 'Text Color', 'bptcfedd' ),
				'attributes' => array(
					'class="bptcfedd-color-field"',
					'data-default-color="#ffffff"',
				),
				'depth'      => array( 'table_header' ),
				'value'      => bptcfedd_get_value(
					array(
						'table_header',
						'text_color',
					),
					$tab,
				),
			),
			array(
				'id'         => 'boder_width',
				'type'       => 'input',
				'input_type' => 'text',
				'title'      => __( 'Border Width', 'bptcfedd' ),
				'attributes' => array(
					'placeholder="1px"',
				),
				'depth'      => array( 'table_header' ),
				'value'      => bptcfedd_get_value(
					array(
						'table_header',
						'boder_width',
					),
					$tab,
				),
			),
			array(
				'id'         => 'boder_style',
				'type'       => 'select',
				'input_type' => 'text',
				'title'      => __( 'Border Style', 'bptcfedd' ),
				'depth'      => array( 'table_header' ),
				'options'    => $this->border_types,
				'attributes' => array(
					'class="bptcfedd-select2"',
				),
				'value'      => bptcfedd_get_value(
					array(
						'table_header',
						'boder_style',
					),
					$tab,
				),
			),
			array(
				'id'         => 'text_align',
				'type'       => 'select',
				'input_type' => 'text',
				'title'      => __( 'Text Align', 'bptcfedd' ),
				'depth'      => array( 'table_header' ),
				'options'    => $this->text_align_types,
				'attributes' => array(
					'class="bptcfedd-select2"',
				),
				'value'      => bptcfedd_get_value(
					array(
						'table_header',
						'text_align',
					),
					$tab,
				),
			),
			array(
				'id'         => 'padding',
				'type'       => 'input',
				'input_type' => 'text',
				'title'      => __( 'Padding', 'bptcfedd' ),
				'attributes' => array(
					'placeholder="0px 0px 0px 0px"',
				),
				'depth'      => array( 'table_header' ),
				'value'      => bptcfedd_get_value(
					array(
						'table_header',
						'padding',
					),
					$tab,
				),
			),
		);

		$table_body_fields = array(
			array(
				'id'    => 'table_body_style',
				'type'  => 'heading',
				'title' => __( 'Table Body', 'bptcfedd' ),
			),
			array(
				'id'         => 'background_color',
				'type'       => 'input',
				'input_type' => 'text',
				'title'      => __( 'Background Color', 'bptcfedd' ),
				'attributes' => array(
					'class="bptcfedd-color-field"',
					'data-default-color="#ffffff"',
				),
				'depth'      => array( 'table_body' ),
				'value'      => bptcfedd_get_value(
					array(
						'table_body',
						'background_color',
					),
					$tab,
				),
			),
			array(
				'id'         => 'border_color',
				'type'       => 'input',
				'input_type' => 'text',
				'title'      => __( 'Border Color', 'bptcfedd' ),
				'attributes' => array(
					'class="bptcfedd-color-field"',
					'data-default-color="#eee"',
				),
				'depth'      => array( 'table_body' ),
				'value'      => bptcfedd_get_value(
					array(
						'table_body',
						'border_color',
					),
					$tab,
				),
			),
			array(
				'id'         => 'font_size',
				'type'       => 'input',
				'input_type' => 'text',
				'title'      => __( 'Font Size', 'bptcfedd' ),
				'attributes' => array(
					'placeholder="1px"',
				),
				'depth'      => array( 'table_body' ),
				'value'      => bptcfedd_get_value(
					array(
						'table_body',
						'font_size',
					),
					$tab,
				),
			),
			array(
				'id'         => 'text_color',
				'type'       => 'input',
				'input_type' => 'text',
				'title'      => __( 'Text Color', 'bptcfedd' ),
				'attributes' => array(
					'class="bptcfedd-color-field"',
					'data-default-color="#000000"',
				),
				'depth'      => array( 'table_body' ),
				'value'      => bptcfedd_get_value(
					array(
						'table_body',
						'text_color',
					),
					$tab,
				),
			),
			array(
				'id'         => 'boder_width',
				'type'       => 'input',
				'input_type' => 'text',
				'title'      => __( 'Border Width', 'bptcfedd' ),
				'attributes' => array(
					'placeholder="1px"',
				),
				'depth'      => array( 'table_body' ),
				'value'      => bptcfedd_get_value(
					array(
						'table_body',
						'boder_width',
					),
					$tab,
				),
			),
			array(
				'id'         => 'boder_style',
				'type'       => 'select',
				'input_type' => 'text',
				'title'      => __( 'Border Style', 'bptcfedd' ),
				'depth'      => array( 'table_body' ),
				'options'    => $this->border_types,
				'attributes' => array(
					'class="bptcfedd-select2"',
				),
				'value'      => bptcfedd_get_value(
					array(
						'table_body',
						'boder_style',
					),
					$tab,
				),
			),
			array(
				'id'         => 'text_align',
				'type'       => 'select',
				'input_type' => 'text',
				'title'      => __( 'Text Align', 'bptcfedd' ),
				'depth'      => array( 'table_body' ),
				'options'    => $this->text_align_types,
				'attributes' => array(
					'class="bptcfedd-select2"',
				),
				'value'      => bptcfedd_get_value(
					array(
						'table_body',
						'text_align',
					),
					$tab,
				),
			),
			array(
				'id'         => 'padding',
				'type'       => 'input',
				'input_type' => 'text',
				'title'      => __( 'Padding', 'bptcfedd' ),
				'attributes' => array(
					'placeholder="0px 0px 0px 0px"',
				),
				'depth'      => array( 'table_body' ),
				'value'      => bptcfedd_get_value(
					array(
						'table_body',
						'padding',
					),
					$tab
				),
			),
		);

		$pagination_fields = array(
			array(
				'id'    => 'pagination_style',
				'type'  => 'heading',
				'title' => __( 'Pagination', 'bptcfedd' ),
			),
			array(
				'id'         => 'background_color',
				'type'       => 'input',
				'input_type' => 'text',
				'title'      => __( 'Background Color', 'bptcfedd' ),
				'attributes' => array(
					'class="bptcfedd-color-field"',
					'data-default-color="#ffffff"',
				),
				'depth'      => array( 'pagination' ),
				'value'      => bptcfedd_get_value(
					array(
						'pagination',
						'background_color',
					),
					$tab,
				),
			),
			array(
				'id'         => 'border_color',
				'type'       => 'input',
				'input_type' => 'text',
				'title'      => __( 'Border Color', 'bptcfedd' ),
				'attributes' => array(
					'class="bptcfedd-color-field"',
					'data-default-color="#eee"',
				),
				'depth'      => array( 'pagination' ),
				'value'      => bptcfedd_get_value(
					array(
						'pagination',
						'border_color',
					),
					$tab,
				),
			),
			array(
				'id'         => 'font_size',
				'type'       => 'input',
				'input_type' => 'text',
				'title'      => __( 'Font Size', 'bptcfedd' ),
				'attributes' => array(
					'placeholder="1px"',
				),
				'depth'      => array( 'pagination' ),
				'value'      => bptcfedd_get_value(
					array(
						'pagination',
						'font_size',
					),
					$tab,
				),
			),
			array(
				'id'         => 'text_color',
				'type'       => 'input',
				'input_type' => 'text',
				'title'      => __( 'Text Color', 'bptcfedd' ),
				'attributes' => array(
					'class="bptcfedd-color-field"',
					'data-default-color="#428bca"',
				),
				'depth'      => array( 'pagination' ),
				'value'      => bptcfedd_get_value(
					array(
						'pagination',
						'text_color',
					),
					$tab,
				),
			),
			array(
				'id'         => 'boder_width',
				'type'       => 'input',
				'input_type' => 'text',
				'title'      => __( 'Border Width', 'bptcfedd' ),
				'attributes' => array(
					'placeholder="1px"',
				),
				'depth'      => array( 'pagination' ),
				'value'      => bptcfedd_get_value(
					array(
						'pagination',
						'boder_width',
					),
					$tab,
				),
			),
			array(
				'id'         => 'boder_style',
				'type'       => 'select',
				'input_type' => 'text',
				'title'      => __( 'Border Style', 'bptcfedd' ),
				'depth'      => array( 'pagination' ),
				'options'    => $this->border_types,
				'attributes' => array(
					'class="bptcfedd-select2"',
				),
				'value'      => bptcfedd_get_value(
					array(
						'pagination',
						'boder_style',
					),
					$tab,
				),
			),
			array(
				'id'         => 'padding',
				'type'       => 'input',
				'input_type' => 'text',
				'title'      => __( 'Padding', 'bptcfedd' ),
				'attributes' => array(
					'placeholder="0px 0px 0px 0px"',
				),
				'depth'      => array( 'pagination' ),
				'value'      => bptcfedd_get_value(
					array(
						'pagination',
						'padding',
					),
					$tab
				),
			),
			array(
				'id'         => 'active_background_color',
				'type'       => 'input',
				'input_type' => 'text',
				'title'      => __( 'Active Background Color', 'bptcfedd' ),
				'attributes' => array(
					'class="bptcfedd-color-field"',
					'data-default-color="#428bca"',
				),
				'depth'      => array( 'pagination' ),
				'value'      => bptcfedd_get_value(
					array(
						'pagination',
						'active_background_color',
					),
					$tab,
				),
			),
			array(
				'id'         => 'active_text_color',
				'type'       => 'input',
				'input_type' => 'text',
				'title'      => __( 'Active Text Color', 'bptcfedd' ),
				'attributes' => array(
					'class="bptcfedd-color-field"',
					'data-default-color="#ffffff"',
				),
				'depth'      => array( 'pagination' ),
				'value'      => bptcfedd_get_value(
					array(
						'pagination',
						'active_text_color',
					),
					$tab,
				),
			),
		);

		$fields = array_merge( $table_header_fields, $table_body_fields, $pagination_fields );

		return $fields;

	}

	/**
	 * Get default field args.
	 *
	 * @since     1.0.0
	 * @return    array    $default    The default field args.
	 */
	public function bptcfedd_default_field_args() {

		$default = array(
			'id'          => '',
			'type'        => '',
			'input_type'  => '',
			'description' => '',
			'attributes'  => array(),
			'value'       => '',
			'depth'       => array(),
		);

		return $default;
	}

	/**
	 * Save plugin settings.
	 *
	 * @since   1.0.0
	 */
	public function bptcfedd_save_setting() {

		if ( ! isset( $_POST['bptcfedd_settings_nonce'] ) ) {
			return;
		}

		$nonce = bptcfedd_sanitize_text_field( $_POST['bptcfedd_settings_nonce'] );
		if ( ! wp_verify_nonce( $nonce, 'bptcfedd_settings_non' ) ) {
			return;
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$old_settings           = get_option( 'bptcfedd_settings' );
		$sani_bptcfedd_settings = isset( $_POST['bptcfedd_settings'] ) ? 
		bptcfedd_sanitize_text_field( $_POST['bptcfedd_settings'] ) :
		array();
		$updated                = update_option( 'bptcfedd_settings', $sani_bptcfedd_settings );

		if ( $updated ||
			( $old_settings == $sani_bptcfedd_settings && ! $updated ) ) {
			bptcfedd_add_admin_notice(
				__( 'Settings has been saved successfuly.', 'bptcfedd' ),
				'success'
			);
		} else {
			bptcfedd_add_admin_notice(
				__( 'Settings has not been saved successfuly.', 'bptcfedd' ),
				'error'
			);
		}

	}

	/**
	 * Save plugin settings.
	 *
	 * @since     1.0.0
	 * @param     array $tfield    The field args.
	 * @param     array $tab       The tab args.
	 * @return    array    $field     The final field args.
	 */
	public function bptcfedd_preapre_field( $tfield, $tab ) {

		$default_field_args = $this->bptcfedd_default_field_args();
		$field              = wp_parse_args( $tfield, $default_field_args );

		$el_str = sprintf( '[%s]', $field['id'] );
		$id_str = $tab['id'];
		if ( ! empty( $field['depth'] ) ) {
			$depth_str = '';
			foreach ( $field['depth'] as $dkey => $depth ) {
				$depth_str .= sprintf( '[%s]', $depth );
				$id_str    .= sprintf( '_%s', $depth );
			}
			$el_str = sprintf( '%s%s', $depth_str, $el_str );
		}

		$field['id']   = sprintf( '%s_%s', $id_str, $field['id'] );
		$field['name'] = sprintf( 'bptcfedd_settings[%s]%s', $tab['id'], $el_str );

		return $field;

	}

	/**
	 * Add all hooks
	 *
	 * @since   1.0.0
	 */
	public function add_hooks() {

		add_action( 'admin_init', array( $this, 'bptcfedd_save_setting' ) );

	}


}
