<?php
/**
 * Provide a all add to cart button for the plugin
 *
 * @link       https://profiles.wordpress.org/himanshud
 * @since      1.0.0
 *
 * @package    Bulk_Products_To_Cart_For_Edd
 * @subpackage Bulk_Products_To_Cart_For_Edd/public/partials
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $bptcfedd_tatts,$table_id,$bptcfedd_table;

$button_lable = bptcfedd_get_value( 'all_to_cart', 'labels' );
if ( ! isset( $bptcfedd_table->configs['conditions']['all_to_cart'] ) ) {
	return;
}

?>
<?php do_action( 'bptcfedd_before_alladdtocart_wrap', $table_id, $bptcfedd_tatts, $bptcfedd_table); ?>
<div class="bptcfedd-alladdtocart-wrap">
	<?php do_action( 'bptcfedd_before_alladdtocart_btn', $table_id, $bptcfedd_tatts,  $bptcfedd_table); ?>
	<?php if ( isset( $bptcfedd_table->configs['columns']['checkbox'] ) ) { ?>
		<input type="checkbox" name="bptcfedd_alladdtocart" class="bptcfedd-alladdtocart-selectall" />
	<?php } ?>
	<button class="bptcfedd-alladdtocart-btn button blue edd-submit">
		<span class="bptcfedd-alladdtocart"><?php echo esc_html( $button_lable ); ?></span>
		<span class="edd-loading" aria-label="<?php esc_html_e( 'Loading', 'bptcfedd' ); ?>"></span>
	</button>
	<?php do_action( 'bptcfedd_after_alladdtocart_btn', $table_id, $bptcfedd_tatts,  $bptcfedd_table); ?>
</div>
<?php do_action( 'bptcfedd_after_alladdtocart_wrap', $table_id, $bptcfedd_tatts, $bptcfedd_table); ?>