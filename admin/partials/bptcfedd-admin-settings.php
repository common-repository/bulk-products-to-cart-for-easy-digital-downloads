<?php
/**
 * Provide a admin settings view for the plugin
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

?>

<?php

global $bptcfedd_settings;

if ( ! current_user_can( 'manage_options' ) ) {
	return;
}

$bptcfedd_tabs = $bptcfedd_settings->bptcfedd_get_tabs();

?>
<div class="wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<?php bptcfedd_print_admin_notices(); ?>
	<form method="post">
		<div class="bptcfedd-tabs">
			<ul id="bptcfedd-tabs-nav">
				<?php foreach ( $bptcfedd_tabs as $tbkey => $bptcfedd_tab ) { ?>
					<li><a href="#bptcfedd_<?php echo esc_attr( $bptcfedd_tab['id'] ); ?>"><?php echo esc_html( $bptcfedd_tab['title'] ); ?></a></li>
				<?php } ?>
			</ul>
			<div id="bptcfedd-tabs-content">
				<?php foreach ( $bptcfedd_tabs as $tbkey => $bptcfedd_tab ) { ?>
					<div id="bptcfedd_<?php echo esc_attr( $bptcfedd_tab['id'] ); ?>" class="bptcfedd-tab-content">
						 <table class="form-table" role="presentation">
							<tbody>
								<?php foreach ( $bptcfedd_tab['fields'] as $t_fkey => $tfield ) { ?>
									<?php

									global $field;

									$field     = $bptcfedd_settings->bptcfedd_preapre_field( $tfield, $bptcfedd_tab );
									$file_name = sprintf( 'fields/bptcfedd-field-%s.php', $field['type'] );
									bptcfedd_get_template( $file_name, BPTCFEDD_ADMIN_TEMPLATE_PATH );

									?>
								<?php } ?>
							</tbody>
						</table>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php wp_nonce_field( 'bptcfedd_settings_non', 'bptcfedd_settings_nonce' ); ?>
		<?php submit_button( 'Save Settings' ); ?>
	</form>
</div>
