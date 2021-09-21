
jQuery(document).ready(function($) {
	$('#commentform').validate({
		ignore: ".ignore",
		rules: {
			comment: {
				required: true
			},
			
			author: {
				required: true,
				minlength: 2
			},

			email: {
				required: true,
				email: true
			},
			url: {
				required: true,														
			},			
		},

		messages: {
			comment: form_obj.comment_input,
			author: form_obj.name_input,
			
			email: {
			    required: form_obj.email_input,
				email: "Please enter a valid email address."
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