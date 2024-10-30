/**
 * Script for admin side
 *
 * @since      1.0.0
 * @package    Bulk_Products_To_Cart_For_Edd
 * @subpackage Bulk_Products_To_Cart_For_Edd/admin
 */

(function( $ ) {
	'use strict';

	const ajaxUrl           = bptcfedd_admin_obj.ajaxurl,
		coman_select2_obj   = {
			width: 'resolve',
	},
		{ __, _x, _n, _nx } = wp.i18n;
	var select2_obj         = {};

	select2_obj.bptcfedd_select2_downloads         = {
		ajax:{
			type: 'POST',
			url: ajaxUrl,
			data: function (params) {
				var query = {
					action: 'bptcfedd_search_downloads',
					search_text: params.term,
					nonce: bptcfedd_admin_obj.nonce,
				}
				return query;
			},
			dataType: "json",
			processResults: function (responsData) {
				var opitons = [];
				$.each(
					responsData.data,
					function( key, value ) {
						opitons.push( { id: key, text: value } );
					}
				);
				return {
					results: opitons,
				};
			}
		},
		minimumInputLength: 3,
	};
	select2_obj.bptcfedd_select2_exclude_downloads = select2_obj['bptcfedd_select2_downloads'];

	function bptcfedd_init_select2(){

		$( '.bptcfedd-select2' ).each(
			function(key, el){

				var obj = coman_select2_obj;
				var id  = $( this ).attr( 'id' );
				if ( select2_obj.hasOwnProperty( id ) ) {
					obj = select2_obj[id];
				}

				$( this ).select2( obj );
			}
		);

	}
	bptcfedd_init_select2();

	$( '.bptcfedd-color-field' ).wpColorPicker();

	$( '#bptcfedd-tabs-nav li:first-child' ).addClass( 'active' );
	$( '.bptcfedd-tab-content' ).hide();
	$( '.bptcfedd-tab-content:first' ).show();

	$( '#bptcfedd-tabs-nav li' ).click(
		function(){

			$( '#bptcfedd-tabs-nav li' ).removeClass( 'active' );
			$( this ).addClass( 'active' );
			$( '.bptcfedd-tab-content' ).hide();

			var activeTab = $( this ).find( 'a' ).attr( 'href' );
			$( activeTab ).show();
			return false;
		}
	);

	$( '.bptcfedd-shortcode-copy-btn' ).click(
		function(){

			var main = $( this ).closest( '.bptcfedd-shortcode-wrap' ),
			input    = main.find( '.bptcfedd-shortcode' ),
			btn      = $( this );

			input.select();
			document.execCommand( "copy" );
			$( this ).text( __( 'Copied', 'bptcfedd' ) );

			setTimeout(
				function(){
					btn.text( __( 'Copy', 'bptcfedd' ) );
				},
				3000
			);

		}
	);

	$( '.bptcfedd-shortcode' ).click(
		function(){
			$( this ).select();
		}
	);

})( jQuery );
