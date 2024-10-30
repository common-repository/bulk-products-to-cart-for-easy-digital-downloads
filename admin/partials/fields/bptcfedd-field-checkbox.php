<?php
/**
 * Provide a checkbox field view for the plugin
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
		<label for="bptcfedd_<?php echo esc_attr( $field['id'] ); ?>"><?php esc_html_e( $field['title'] ); ?></label>
	</th>
	<td class="bptcfedd-field bptcfedd-field-checkbox">
		<?php if ( ! empty( $field['label'] ) ) { ?>
			<label class="bptcfedd-checkbox-label"><?php echo esc_html( $field['label'] ); ?></label>
		<?php } ?>
		<input type="checkbox" name="<?php echo esc_attr( $field['name'] ); ?>" id="bptcfedd_<?php echo esc_attr( $field['id'] ); ?>"<?php echo implode( ' ', $attributes ); ?> value="1" <?php checked( $option_value, '1' ); ?>>
		<?php echo esc_html( $description ); ?>
	</td>
</tr>
