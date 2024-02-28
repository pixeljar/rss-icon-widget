jQuery( document ).on( 'ready widget-added widget-updated', function() {
	var $ = window.jQuery;
	var colorPicker = $( '.rss-icon-widget-colorpicker' );
	var params = {
		change: function( event, ui ) {
			$( event.target ).val( ui.color.toString() );
			$( event.target ).trigger( 'change' );
		},
	};
	colorPicker.not( '[id*="__i__"]' ).wpColorPicker( params );
} );
