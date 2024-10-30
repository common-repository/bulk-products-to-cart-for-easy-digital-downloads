/**
 * Script for public
 *
 * @since      1.0.0
 * @package    Bulk_Products_To_Cart_For_Edd
 * @subpackage Bulk_Products_To_Cart_For_Edd/public
 */

(function( $ ) {
	'use strict';

	const ajaxUrl              = bptcfedd_public_obj.ajaxurl,
		addtocart_success_html = bptcfedd_public_obj.addtocart_success_html;

	$( '.bptcfedd-alladdtocart-selectall' ).change(
		function(){

			var main   = $( this ).closest( '.bptcfedd-table-wrap' ),
			checkboxes = main.find( '.bptcfedd-download-table .bptcfedd-table-checkbox' );

			if ( $( this ).is( ":checked" ) ) {
				checkboxes.prop( 'checked', true );
			} else {
				checkboxes.prop( 'checked', false );
			}

		}
	);

	$( '.bptcfedd-alladdtocart-btn' ).click(
		function(){

			var main = $( this ).closest( '.bptcfedd-table-wrap' ),
			btn      = $( this ),
			action   = '&action=bptcfedd_alladdtocart';

			if ( main.find( '.bptcfedd-alladdtocart-selectall' ).length ) {
				var checkboxes = main.find( '.bptcfedd-download-table .bptcfedd-table-checkbox:checked' ).serialize();
				var	data       = checkboxes + action;
			} else {
				var downloads = [];
				main.find( '.bptcfedd-download-table tbody tr' ).each(
					function(key, val){

						var id = $( this ).data( 'download-id' );
						downloads.push( id );

					}
				);
				var data = {
					action: 'bptcfedd_alladdtocart',
					bptcfedd_checkbox: downloads
				}
			}

			$.ajax(
				{
					type: 'POST',
					data: data,
					url: ajaxUrl,
					beforeSend: function(){
						btn.addClass( 'bptcfedd-loading' );
					},
					complete: function(){
						btn.removeClass( 'bptcfedd-loading' );
					},
					success: function( response ) {
						if ( response.success ) {
							btn.after( addtocart_success_html );
						}

						setTimeout(
							function(){
								main.find( '.edd-cart-added-alert' ).remove();
							},
							3000
						);
					}
				}
			);

		}
	);

})( jQuery );
