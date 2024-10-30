<?php
/**
 * Provide a table view for the plugin
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

?>

<?php do_action( 'bptcfedd_before_wrap', $table_id, $bptcfedd_tatts, $bptcfedd_table); ?>
<div class="bptcfedd-table-wrap" id="bptcfedd_table_wrap_<?php echo esc_attr( $table_id ); ?>">
	<?php bptcfedd_get_template( 'shortcodes/all-add-to-cart.php', BPTCFEDD_PUBLIC_TEMPLATE_PATH ); ?>
	<div class="bptcfedd-table-parent">
		<table class="bptcfedd-download-table">
			<thead>
				<tr>
					<?php $bptcfedd_table->bptcfedd_display_header(); ?>
				</tr>
			</thead>
			<tbody>
				<?php $bptcfedd_table->bptcfedd_display_body(); ?>
			</tbody>
		</table>
	</div>
	<div class="bptcfedd-pagination">
		<?php
		$bptcfedd_table->bptcfedd_display_pagination();
		wp_reset_postdata();
		?>
	</div>
</div>
<?php do_action( 'bptcfedd_after_wrap', $table_id, $bptcfedd_tatts, $bptcfedd_table); ?>