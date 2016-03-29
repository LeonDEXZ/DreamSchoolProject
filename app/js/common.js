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
			animateOut: 'fadeOut',
			animateIn: 'fadeIn',
			smartSpeed: 450,
    		autoplayTimeout: 6000,
    		mouseDrag: false,
    		touchDrag: false,
    		pullDrag: false,
			loop: true,
			items: 1,
			nav: true,
			navClass: [
				'col-md-1 owl-nav-but owl-prev',
				'col-md-1 owl-nav-but owl-next pull-right'
			],
			navText: [
				'<i class="fa fa-chevron-left"></i>',
				'<i class="fa fa-chevron-right"></i>'
			],
			autoplay: true,
			autoplayHoverPause: false
		});

		$(".nano").nanoScroller();
	});

	// no drag img
	$("img, a").on("dragstart", function(event) { event.preventDefault(); });

	$(".preloader").fadeOut();
});