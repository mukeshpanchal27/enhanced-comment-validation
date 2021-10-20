(function( $ ) {
	'use strict';

	$( document ).ready( function() {

		$( document ).on( 'click', '#commentform input[type="submit"]', function () {

			var _commentFormFields = '',
				_currentForm = $( this ).parents( 'form' ),
				_commentFormComment = _currentForm.find( 'textarea[name="comment"]' ),
				_commentFormAuthor = _currentForm.find( 'input[name="author"]' ),
				_commentFormUrl = _currentForm.find( 'input[name="url"]' ),
				_commentFormEmail = _currentForm.find( 'input[name="email"]' ),
				_commentMessageStyle = enhanced_comment_form_validation._message_style;

			if ( _commentFormComment.length == 1 && enhanced_comment_form_validation._enable_comment == 'yes' ) {
				if ( _commentFormComment.val().length == 0 || _commentFormComment.val().value == '' ) {
					_commentFormFields ='1';
					_commentFormComment.addClass( 'validation-error' );
					
					if ( _commentMessageStyle != 'style1' && _currentForm.find( '.validation-comment-error-message' ).length == 0 ) {
						if ( enhanced_comment_form_validation._comment_message ) {
							_commentFormComment.after( '<span class="validation-error-message validation-comment-error-message">'+enhanced_comment_form_validation._comment_message+'</span>' );
						}
					}

				}
			}

			if ( _commentFormAuthor.length == 1 && enhanced_comment_form_validation._enable_author == 'yes' ) {
				if ( _commentFormAuthor.val().length == 0 || _commentFormAuthor.val().value == '' ) {
					_commentFormFields ='1';
					_commentFormAuthor.addClass( 'validation-error' );

					if ( _commentMessageStyle != 'style1' && _currentForm.find( '.validation-author-error-message' ).length == 0 ) {
						if ( enhanced_comment_form_validation._author_message ) {
							_commentFormAuthor.after( '<span class="validation-error-message validation-author-error-message">'+enhanced_comment_form_validation._author_message+'</span>' );
						}
					}
				}
			}

			if ( _commentFormUrl.length == 1 && enhanced_comment_form_validation._enable_website == 'yes' ) {
				if ( _commentFormUrl.val().length == 0 || _commentFormUrl.val().value == '' ) {
					_commentFormFields ='1';
					_commentFormUrl.addClass( 'validation-error' );

					if ( _commentMessageStyle != 'style1' && _currentForm.find( '.validation-website-error-message' ).length == 0 ) {
						if ( enhanced_comment_form_validation._website_message ) {
							_commentFormUrl.after( '<span class="validation-error-message validation-website-error-message">'+enhanced_comment_form_validation._website_message+'</span>' );
						}
					}
				}
			}
			
			if ( _commentFormEmail.length == 1 && enhanced_comment_form_validation._enable_email == 'yes' ) {
				var emailErrorFlag = false;
				if ( _commentFormEmail.val().length == 0 || _commentFormEmail.val().length == '' ) {
					_commentFormFields ='1';
					_commentFormEmail.addClass( 'validation-error' );
					emailErrorFlag = true;
				} else {
					var re = new RegExp();
					re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
					var sinput = '';
					sinput = _commentFormEmail.val();
					if ( !re.test( sinput ) ) {
						_commentFormFields ='1';
						_commentFormEmail.addClass( 'validation-error' );
						emailErrorFlag = true;
					}
				}

				if ( emailErrorFlag ) {
					
					if ( _commentMessageStyle != 'style1' && _currentForm.find( '.validation-email-error-message' ).length == 0 ) {
						if ( enhanced_comment_form_validation._email_message ) {
							_commentFormEmail.after( '<span class="validation-error-message validation-email-error-message">'+enhanced_comment_form_validation._email_message+'</span>' );
						}
					}
				}
			}
			if ( _commentFormFields != "" ) {
				return false;
			} else {
				return true;
			}
		});
	});

	$( document ).on( 'focus', '#commentform textarea[name="comment"], #commentform input[name="author"], #commentform input[name="url"], #commentform input[name="email"]', function () {
		var _currentThis = $( this );
		if ( _currentThis.hasClass( 'validation-error' ) ) {
			_currentThis.removeClass( 'validation-error' );

			if ( _currentThis.next().is( '.validation-error-message' ) ) {
				_currentThis.next().remove();
			}

		}
	});

})( jQuery );