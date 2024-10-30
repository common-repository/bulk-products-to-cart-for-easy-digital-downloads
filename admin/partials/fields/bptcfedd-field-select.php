<?php
/**
 * Provide a select field view for the plugin
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
		<label for="bptcfedd_<?php echo esc_attr( $field['id'] ); ?>"><?php echo esc_html( $field['title'] ); ?></label>
	</th>
	<td class="bptcfedd-field bptcfedd-field-select">
		<select name="<?php echo esc_attr( $field['name'] ); ?>" id="bptcfedd_<?php echo esc_attr( $field['id'] ); ?>"<?php echo implode( ' ', $attributes ); ?>>
			<?php
			foreach ( $field['options'] as $key => $val ) {
				?>
				<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $option_value, (string) $key ); ?>><?php echo esc_html( $val ); ?></option>
				<?php
			}
			?>
		</select> 
		<?php echo esc_html( $description ); ?>
	</td>
</tr>
