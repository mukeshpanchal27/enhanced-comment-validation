(function( $ ) {
	'use strict';

	$( document ).ready( function() {
		
		$( document ).on( 'click', '.enhanced-comment-validation-recaptcha-wrapper .enhanced-comment-validation-radio-li', function () {
			var checkedVal = $( this ).find( 'input[type="radio"]:checked' ).val();
			if ( checkedVal == 'v2' ) {
				$( '.enhanced-comment-validation-left-space' ).show();

				if ( $( '.enhanced-comment-validation-invisible-captcha-checkbox' ).is( ':checked' ) ) {
					$( '.enhanced-comment-validation-invisible-captcha_badge' ).show();
				} else {
					$( '.enhanced-comment-validation-invisible-captcha_badge' ).hide();
				}
				
			} else {
				$( '.enhanced-comment-validation-left-space' ).hide();
				$( '.enhanced-comment-validation-invisible-captcha_badge' ).show();
			}

			$( '.enhanced-comment-validation-lable-input-site-key, .enhanced-comment-validation-lable-input-secret-key' ).val( '' );
		});

		$( document ).on( 'click', '.enhanced-comment-validation-recaptcha-wrapper .enhanced-comment-validation-invisible-captcha-checkbox', function () {
			if ( $( this ).is( ':checked' ) ) {
				$( '.enhanced-comment-validation-invisible-captcha_badge' ).show();
			} else {
				$( '.enhanced-comment-validation-invisible-captcha_badge' ).hide();
			}
		});

	});

})( jQuery );
