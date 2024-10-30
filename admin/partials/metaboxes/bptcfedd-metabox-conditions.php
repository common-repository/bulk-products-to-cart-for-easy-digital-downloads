<?php
/**
 * Provide a conditions metabox area view for the plugin
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

$downloads_categories = bptcfedd_get_terms(
	'download_category',
	array(
		'fields' => 'id=>name',
	)
);
$downloads_tags       = bptcfedd_get_terms(
	'download_tag',
	array(
		'fields' => 'id=>name',
	)
);
$all_orders           = bptcfedd_get_def_orders();
$all_order_bys        = bptcfedd_get_def_order_bys();

$table_id            = get_the_ID();
$bptcfedd_conditions = get_post_meta( $table_id, 'bptcfedd_conditions', true );
$bptcfedd_downloads  = isset( $bptcfedd_conditions['downloads'] ) ?
	$bptcfedd_conditions['downloads'] :
	array();
$bptcfedd_categories = isset( $bptcfedd_conditions['categories'] ) ?
	$bptcfedd_conditions['categories'] :
	array();
$bptcfedd_tags       = isset( $bptcfedd_conditions['tags'] ) ?
	$bptcfedd_conditions['tags'] :
	array();
$exclude_downloads   = isset( $bptcfedd_conditions['exclude_downloads'] ) ?
	$bptcfedd_conditions['exclude_downloads'] :
	array();
$exclude_categories  = isset( $bptcfedd_conditions['exclude_categories'] ) ?
	$bptcfedd_conditions['exclude_categories'] :
	array();
$exclude_tags        = isset( $bptcfedd_conditions['exclude_tags'] ) ?
	$bptcfedd_conditions['exclude_tags'] :
	array();
$bptcfedd_order      = isset( $bptcfedd_conditions['order'] ) ?
	$bptcfedd_conditions['order'] :
	'';
$bptcfedd_orderby    = isset( $bptcfedd_conditions['orderby'] ) ?
	$bptcfedd_conditions['orderby'] :
	'';
$bptcfedd_per_page   = isset( $bptcfedd_conditions['per_page'] ) ?
	$bptcfedd_conditions['per_page'] :
	'-1';
$pagination          = isset( $bptcfedd_conditions['pagination'] ) ?
	$bptcfedd_conditions['pagination'] :
	'';
$all_to_cart         = isset( $bptcfedd_conditions['all_to_cart'] ) ?
	$bptcfedd_conditions['all_to_cart'] :
	'';
?>

<?php wp_nonce_field( 'bptcfedd_table_meta', 'bptcfedd_table_meta_nonce' ); ?>
<div class="bptcfedd-metabox-wrap bptcfedd-metabox-conditions">
	<div class="bptcfedd-field">
		<label for="bptcfedd_select2_downloads"><?php esc_html_e( 'Downloads', 'bptcfedd' ); ?></label>
		<select class="bptcfedd-select2" id="bptcfedd_select2_downloads" name="bptcfedd_conditions[downloads][]" multiple="multiple">
			<?php if ( ! empty( $bptcfedd_downloads ) ) { ?>
				<?php foreach ( $bptcfedd_downloads as $d_id => $download ) { ?>
					<option value="<?php echo esc_attr( $download ); ?>" selected="selected"><?php echo esc_html( get_the_title( intval( $download ) ) ); ?></option>
				<?php } ?>
			<?php } ?>
		</select>
	</div>
	<div class="bptcfedd-field">
		<label for="bptcfedd_select2_categories"><?php esc_html_e( 'Downloads By Categories', 'bptcfedd' ); ?></label>
		<select class="bptcfedd-select2" id="bptcfedd_select2_categories" name="bptcfedd_conditions[categories][]" multiple="multiple">
			<?php if ( ! empty( $downloads_categories ) ) { ?>
				<?php foreach ( $downloads_categories as $cat_id => $category ) { ?>
					<?php
					$cat_selected = in_array( $cat_id, $bptcfedd_categories ) ? ' selected="selected"' : '';
					?>
					<option value="<?php echo esc_attr( $cat_id ); ?>"<?php echo esc_attr( $cat_selected ); ?>><?php echo esc_html( $category ); ?></option>
				<?php } ?>
			<?php } ?>
		</select>
	</div>
	<div class="bptcfedd-field">
		<label for="bptcfedd_select2_tags"><?php esc_html_e( 'Downloads By Tags', 'bptcfedd' ); ?></label>
		<select class="bptcfedd-select2" id="bptcfedd_select2_tags" name="bptcfedd_conditions[tags][]" multiple="multiple">
			<?php if ( ! empty( $downloads_tags ) ) { ?>
				<?php foreach ( $downloads_tags as $tag_id => $tag ) { ?>
					<?php
					$tag_selected = in_array( $tag_id, $bptcfedd_tags ) ? ' selected="selected"' : '';
					?>
					<option value="<?php echo esc_attr( $tag_id ); ?>"<?php echo esc_attr( $tag_selected ); ?>><?php echo esc_html( $tag ); ?></option>
				<?php } ?>
			<?php } ?>
		</select>
	</div>
	<div class="bptcfedd-field">
		<label for="bptcfedd_select2_exclude_downloads"><?php esc_html_e( 'Exclude Downloads', 'bptcfedd' ); ?></label>
		<select class="bptcfedd-select2" id="bptcfedd_select2_exclude_downloads" name="bptcfedd_conditions[exclude_downloads][]" multiple="multiple">
			<?php if ( ! empty( $exclude_downloads ) ) { ?>
				<?php foreach ( $exclude_downloads as $ed_id => $exclude_download ) { ?>
					<option value="<?php echo esc_attr( $exclude_download ); ?>" selected="selected"><?php echo esc_html( get_the_title( intval( $exclude_download ) ) ); ?></option>
				<?php } ?>
			<?php } ?>
		</select>
	</div>
	<div class="bptcfedd-field">
		<label for="bptcfedd_select2_exclude_categories"><?php esc_html_e( 'Exclude Downloads By Categories', 'bptcfedd' ); ?></label>
		<select class="bptcfedd-select2" id="bptcfedd_select2_exclude_categories" name="bptcfedd_conditions[exclude_categories][]" multiple="multiple">
			<?php if ( ! empty( $downloads_categories ) ) { ?>
				<?php foreach ( $downloads_categories as $excat_id => $category ) { ?>
					<?php
					$excat_selected = in_array( $excat_id, $exclude_categories ) ? ' selected="selected"' : '';
					?>
					<option value="<?php echo esc_attr( $excat_id ); ?>"<?php echo esc_attr( $excat_selected ); ?>><?php echo esc_html( $category ); ?></option>
				<?php } ?>
			<?php } ?>
		</select>
	</div>
	<div class="bptcfedd-field">
		<label for="bptcfedd_select2_exclude_tags"><?php esc_html_e( 'Exclude Downloads By Tags', 'bptcfedd' ); ?></label>
		<select class="bptcfedd-select2" id="bptcfedd_select2_exclude_tags" name="bptcfedd_conditions[exclude_tags][]" multiple="multiple">
			<?php if ( ! empty( $downloads_tags ) ) { ?>
				<?php foreach ( $downloads_tags as $extag_id => $tag ) { ?>
					<?php
					$extag_selected = in_array( $extag_id, $exclude_tags ) ? ' selected="selected"' : '';
					?>
					<option value="<?php echo esc_attr( $extag_id ); ?>"<?php echo esc_attr( $extag_selected ); ?>><?php echo esc_html( $tag ); ?></option>
				<?php } ?>
			<?php } ?>
		</select>
	</div>
	<div class="bptcfedd-field">
		<label for="bptcfedd_select2_order"><?php esc_html_e( 'Order', 'bptcfedd' ); ?></label>
		<select class="bptcfedd-select2" id="bptcfedd_select2_order" name="bptcfedd_conditions[order]">
			<?php if ( ! empty( $all_orders ) ) { ?>
				<?php foreach ( $all_orders as $ord => $order_title ) { ?>
					<option value="<?php echo esc_attr( $ord ); ?>"<?php selected( $bptcfedd_order, $ord ); ?>><?php echo esc_html( $order_title ); ?></option>
				<?php } ?>
			<?php } ?>
		</select>
	</div>
	<div class="bptcfedd-field">
		<label for="bptcfedd_select2_orderby"><?php esc_html_e( 'Order by', 'bptcfedd' ); ?></label>
		<select class="bptcfedd-select2" id="bptcfedd_select2_orderby" name="bptcfedd_conditions[orderby]">
			<?php if ( ! empty( $all_order_bys ) ) { ?>
				<?php foreach ( $all_order_bys as $ord_by => $order_by ) { ?>
					<option value="<?php echo esc_attr( $ord_by ); ?>"<?php selected( $bptcfedd_orderby, $ord_by ); ?>><?php echo esc_html( $order_by ); ?></option>
				<?php } ?>
			<?php } ?>
		</select>
	</div>
	<div class="bptcfedd-field">
		<label for="bptcfedd_per_page"><?php esc_html_e( 'Downloads per page', 'bptcfedd' ); ?></label>
		<input type="number" name="bptcfedd_conditions[per_page]" id="bptcfedd_per_page" value="<?php echo esc_attr( $bptcfedd_per_page ); ?>" min="-1" />
	</div>
	<div class="bptcfedd-field">
		<label for="bptcfedd_pagination"><?php esc_html_e( 'Pagination', 'bptcfedd' ); ?></label>
		<input class="bptcfedd-simple-checkbox" type="checkbox" name="bptcfedd_conditions[pagination]" id="bptcfedd_pagination" value="1" <?php checked( $pagination, '1' ); ?> />
	</div>
	<div class="bptcfedd-field">
		<label for="bptcfedd_all_to_cart"><?php esc_html_e( 'All To Cart Button', 'bptcfedd' ); ?></label>
		<input class="bptcfedd-simple-checkbox" type="checkbox" name="bptcfedd_conditions[all_to_cart]" id="bptcfedd_all_to_cart" value="1" <?php checked( $all_to_cart, '1' ); ?> />
	</div>
</div>
