jQuery(document).ready(function( $ ){
	$( '.swipebox' ).swipebox({rtl: true});
	$('.swipebox-container-images').slick({
	  infinite: true,
	  slidesToShow: dypg_settings.slidesToShow,
	  slidesToScroll: 3,
	  rtl : true,
	});
});
