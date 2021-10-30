(function( $ ) {
	'use strict';

	$( document ).ready( function() {
		
		$( document ).on( 'click', '.enhanced-comment-validation-recaptcha-wrapper .enhanced-comment-validation-radio-li', function () {
			var checkedVal = $( this ).find( 'input[type="radio"]:checked' ).val();
			if ( checkedVal == 'v2' ) {
				$( '.enhanced-comment-validation-left-space' ).show();
			} else {
				$( '.enhanced-comment-validation-left-space' ).hide();
			}
			$( '.enhanced-comment-validation-lable-input-site-key, .enhanced-comment-validation-lable-input-secret-key' ).val('');
		});

	});

})( jQuery );
