(function( $ ) {
	'use strict';

		
	$( document ).ready( function() {
		
		if ($('.enhanced-comment-validation-recaptcha-v2').is(":checked")) {			
			$('.enhanced-comment-validation-invisible-captcha').show();	
		}		
	
		// v2
		$( document ).on( 'click', '.enhanced-comment-validation-recaptcha-v2 ', function () {		
			$('.enhanced-comment-validation-invisible-captcha').show();	
			$(".enhanced-comment-validation-lable-input-site-key").val("");				
		});
		
		// v3
		$( document ).on( 'click', '.enhanced-comment-validation-recaptcha-v3 ', function () {	
			$('.enhanced-comment-validation-invisible-captcha').hide();	
			$(".enhanced-comment-validation-lable-input-site-key").val("");								
		});		
	});

})( jQuery );
