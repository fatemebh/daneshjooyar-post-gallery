jQuery(document).ready(function( $ ){
	$( '.swipebox' ).swipebox({rtl: true});
	$('.swipebox-container-images').slick({
	  infinite: true,
	  slidesToShow: 3,
	  slidesToScroll: 3,
	  rtl : true,
	});
});
