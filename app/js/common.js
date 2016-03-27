$(function() {
	$(document).ready(function() {
		// superfish
		$('#top-menu').superfish({
			delay: 200,
			hoverClass: 'sf-hover-no',
			cssArrows: false
		});

		// owi carousel
		$(".owl-carousel").owlCarousel({
			center: true,
			loop: true,
			autoplay: true
		});
	});

	// smooth chrome
	try {
		$.browserSelector();
		if($("html").hasClass("chrome")) {
			$.smoothScroll();
		}
	} catch(err) {

	};

	// no drag img
	$("img, a").on("dragstart", function(event) { event.preventDefault(); });
});