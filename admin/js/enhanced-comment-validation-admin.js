(function( $ ) {
	'use strict';

	$( document ).ready( function() {
		
		if ( $( '.enhanced-comment-validation-recaptcha-v2' ).is( ':checked' ) ) {
			$( '.enhanced-comment-validation-invisible-captcha' ).show();
		} else {
			$( '.enhanced-comment-validation-invisible-captcha' ).hide();
		}

		if ( $( '.enhanced-comment-validation-invisible-captcha-checkbox' ).is( ':checked' ) ) {
			$( '.enhanced-comment-validation-v2' ).hide();
		} else {
			$( '.enhanced-comment-validation-v2' ).show();
		}



		$( document ).on( 'click', '.enhanced-comment-validation-recaptcha-v2', function () {
			$( '.enhanced-comment-validation-invisible-captcha' ).show();
			// $( '.enhanced-comment-validation-v2' ).show();	
			$( '.enhanced-comment-validation-lable-input-site-key, .enhanced-comment-validation-lable-input-secret-key' ).val('');
		});
		
		$( document ).on( 'click', '.enhanced-comment-validation-recaptcha-v3', function () {
			$( '.enhanced-comment-validation-invisible-captcha' ).hide();
			$( '.enhanced-comment-validation-v2' ).hide();
			$( '.enhanced-comment-validation-lable-input-site-key, .enhanced-comment-validation-lable-input-secret-key' ).val('');
		});
	});

})( jQuery );
