<?php
/**
 * Provide a columns metabox area view for the plugin
 *
 * @link       https://profiles.wordpress.org/himanshud
 * @since      1.0.0
 *
 * @package    Bulk_Products_To_Cart_For_Edd
 * @subpackage Bulk_Products_To_Cart_For_Edd/admin/partials
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$table_id         = get_the_ID();
$bptcfedd_columns = get_post_meta( $table_id, 'bptcfedd_columns', true );

$checkbox  = isset( $bptcfedd_columns['checkbox'] ) ?
	$bptcfedd_columns['checkbox'] :
	'';
$id        = isset( $bptcfedd_columns['id'] ) ?
	$bptcfedd_columns['id'] :
	'';
$title     = isset( $bptcfedd_columns['title'] ) ?
	$bptcfedd_columns['title'] :
	'';
$img       = isset( $bptcfedd_columns['img'] ) ?
	$bptcfedd_columns['img'] :
	'';
$price     = isset( $bptcfedd_columns['price'] ) ?
	$bptcfedd_columns['price'] :
	'';
$excerpt   = isset( $bptcfedd_columns['excerpt'] ) ?
	$bptcfedd_columns['excerpt'] :
	'';
$addtocart = isset( $bptcfedd_columns['addtocart'] ) ?
	$bptcfedd_columns['addtocart'] :
	'';
$cats      = isset( $bptcfedd_columns['cats'] ) ?
	$bptcfedd_columns['cats'] :
	'';
$tags      = isset( $bptcfedd_columns['tags'] ) ?
	$bptcfedd_columns['tags'] :
	'';
$date      = isset( $bptcfedd_columns['date'] ) ?
	$bptcfedd_columns['date'] :
	'';

$def_columns = bptcfedd_get_def_columns();

?>
<div class="bptcfedd-metabox-wrap">
	<?php foreach ( $def_columns as $colu_id => $column ) { ?>
		<div class="bptcfedd-field">
			<label for="bptcfedd_<?php echo esc_attr( $colu_id ); ?>"><input type="checkbox" name="bptcfedd_columns[<?php echo esc_attr( $colu_id ); ?>]" id="bptcfedd_<?php echo esc_attr( $colu_id ); ?>" value="1" <?php checked( ${$colu_id}, '1' ); ?> /><?php echo esc_html( $column ); ?></label>
		</div>
	<?php } ?>
</div>
