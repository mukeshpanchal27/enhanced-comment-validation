
const enable_google_captcha = form_obj._enable_captcha;

const sitekey = form_obj.google_captcha_site_key;

var comment_form_recaptcha;

var Enhanced_RecaptchaCallback = function() {

	if ( jQuery('#comment_form_recaptcha').length ) {
		console.log('hhhhhhhhh');
		comment_form_recaptcha = grecaptcha.render('comment_form_recaptcha', {
		  'sitekey' : sitekey, 
		  'theme' : 'light',		
		});
	}

}



jQuery(document).ready(function($) {
	
	if( form_obj._comment_input_enable == 1){ 
		var comment_Validation = true;		
	}else{
		comment_Validation = false		
	}
	if( form_obj._name_input_enable == 1 ){
		var author_Validation = true;		
	}else{
		author_Validation = false;		
	}
	if( form_obj._email_input_enable == 1 ){
		var email_Validation = true;		
	}else{
		email_Validation = false;	
	}
	if( form_obj._website_input_enable == 1 ){
		var url_Validation = true;
	}else{
		url_Validation = false;
	}

	$('#commentform').validate({
		ignore: ".ignore",
		
		rules: {

			comment: {
				required: comment_Validation 
			},			
			author: {
				required: author_Validation,
				minlength: 2
			},
			email: {
				required: email_Validation,
				email: true
			},
			url: {
				required: url_Validation,														
			},			
		},

		messages: {
			comment: form_obj.comment_input,
			author: form_obj.name_input,
			
			email: {
			    required: form_obj.email_input,
			},
			url:{
				required: form_obj.website_input,
			}
		},

		errorElement: "div",
		errorPlacement: function(error, element) {
		  element.after(error);
		}

	});
});