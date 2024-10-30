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

?>
<tr valign="top">
	<th scope="row" class="bptcfedd-field-heading">
		<h4 class="bptcfedd-sub-heading" id="bptcfedd_<?php echo esc_attr( $field['id'] ); ?>"><?php esc_html_e( $field['title'] ); ?></h4>
	</th>
</tr>
