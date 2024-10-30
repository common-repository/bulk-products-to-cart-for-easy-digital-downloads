<?php
/**
 * Provide a number field view for the plugin
 *
 * @link       https://profiles.wordpress.org/himanshud
 * @since      1.0.0
 *
 * @package    Bulk_Products_To_Cart_For_Edd
 * @subpackage Bulk_Products_To_Cart_For_Edd/admin/partials
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $field;
$description  = $field['description'];
$attributes   = $field['attributes'];
$option_value = $field['value'];

?>
<tr valign="top">
	<th scope="row" class="bptcfedd-field-heading">
		<label for="<?php echo esc_attr( $field['id'] ); ?>"><?php esc_html_e( $field['title'] ); ?></label>
	</th>
	<td class="bptcfedd-field bptcfedd-field-number">
		<input type="<?php echo esc_attr( $field['input_type'] ); ?>" name="<?php echo esc_attr( $field['name'] ); ?>" id="bptcfedd_<?php echo esc_attr( $field['id'] ); ?>" value="<?php echo esc_attr( $option_value ); ?>"<?php echo implode( ' ', $attributes ); ?> />
		<?php echo esc_html( $description ); ?>
	</td>
</tr>
