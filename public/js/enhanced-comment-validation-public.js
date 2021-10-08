( function() {
	'use strict';


	var navMenu = function( id ) {
		var navMenuEl = document.getElementById( 'commentform' );

		// If there's no nav menu, none of this is necessary.
		if ( ! navMenuEl ) {
			return;
		}

		navMenuEl.addEventListener("submit", function(e){
			alert();
		});
		
	};

	window.addEventListener( 'load', function() {
		new navMenu();
	} );


	/*$( document ).ready( function() {
		$( document ).on( 'click', '#commentform', function () {

			var fields = "";

			var _currentForm = $( this );
			
			if ( _currentForm.find( '#author' ).length == 1 ) {
				if ( $( '#author' ).val().length == 0 || $(  '#author' ).val().value == '' ) {
					fields ='1';
					$( '#author' ).addClass( 'inputerror' );
				}
			}
			if ( _grandParent.find( '#comment' ).length == 1 ) {
				if ( $( '#comment' ).val().length == 0 || $( '#comment' ).val().value == '' )
				{
					fields ='1';
					$( '#comment' ).addClass( 'inputerror' );
				}
			}
			if ( _grandParent.find( '#email' ).length == 1 ) {
				if ( $( '#email' ).val().length == 0 || $( '#email' ).val().length == '' )
				{
					fields ='1';
					$( '#email' ).addClass( 'inputerror' );

				} else {
					var re = new RegExp();
					re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
					var sinput ;
					sinput= "" ;
					sinput = $( '#email' ).val();
					if ( !re.test( sinput ) ) {
						fields ='1';
						$( '#email' ).addClass( 'inputerror' );
					}
				}
			}
			if ( fields != "" ) {
				return false;
			} else {
				return true;
			}
		});
	});

	$( '.comment-field' ).on( 'keyup', function( e ) {
		var id = $( this ).attr('id');
		if ( id ) {
			$( '#' + id ).removeClass( 'inputerror' );
		}
	});*/

}() );