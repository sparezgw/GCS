// $( "#del" ).on( "click", function() {
// 	console.log('hi');
// 	$.mobile.changePage( "/user/logout" , true );
// });

// $( "#loadpage" ).on( "click", function() {
//     $.mobile.loadPage( "../resources/us.html" , true );
//   });

//   $( "a" ).on( "click", function( event ) {
//  	console.log("asdfasdf")
//   // Prevent the usual navigation behavior
//   event.preventDefault();
 
//   // Alter the url according to the anchor's href attribute, and
//   // store the data-foo attribute information with the url
//   $.mobile.navigate( this.attr( "href" ), { foo: this.attr( "data-foo" ) });
 
//   // Hypothetical content alteration based on the url. E.g, make
//   // an ajax request for JSON data and render a template into the page.
//   alterContent( this.attr( "href" ) );
// });


// $( document ).on( "pageinit", function() {


// });

(function($, undefined) {

	$(document).on("pageinit", "#main-page", function() {
		// console.log('page.init')
		$("a").on("click", function(event) {
			// console.log('link')
			// $.mobile.changePage( "/user/login", { transition: "slideup", changeHash: false });
		});
	});
	/* $("#logout").on("click", function() {
		console.log('logout')
		$.mobile.loadPage( "/user/login" , true );
		$.mobile.changePage( "/user/login", { transition: "slideup", changeHash: false });
		$.mobile.navigate( "/user/login" );
		// $.mobile.changePage( "/user/logout" , true );
		// $.mobile.navigate( "/user/login" );
	}); */

})(jQuery);
