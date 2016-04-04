$(function() {
	$(document).ready(function() {
		// no drag img
		$("img, a").on("dragstart", function(event) {
			event.preventDefault();
		});

		// superfish
		$('#top-menu').superfish({
			delay: 200,
			hoverClass: 'sf-hover-no',
			cssArrows: false
		});

		$(".nano").nanoScroller();
		
		//setTimeout(function() {
			$("#preloader-main").fadeOut(300, function() {
				$(".main_page").fadeIn(900);
			});
		//}, 2000);

		// owi carousel
		$.ajax({
			method: "GET",
			url: SitePath + "/index.php",
			dataType: "html",
			data: {ajax: "", mod: "slider"},
			success: function (data, textStatus) {
				//setTimeout(function() {
					$("#preloader-slider").fadeOut(300, function() {
						var owl = $("#slider"),
							owlInit = false;
						owl.html(data).hide();
						owl.on('changed.owl.carousel', function(event) {
							if (!owlInit) {
								owl.fadeIn(900);
								owlInit = true;
							}
						});			
						owl.owlCarousel({
							smartSpeed: 450,
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
							slideSpeed: 900,
							pagination: true,
							autoplayTimeout: 3500,
							autoplayHoverPause: true,
							addClassActive: true,
							singleItem: true
						});
					});	
				//}, 5000);	
			}
		});

		// AJAX
		var ajax_load = function(q_data) {
			q_data.ajax = "";
			$.ajax({
				method: "GET",
				url: SitePath + "/index.php",
				dataType: "html",
				data: q_data,
				success: function (data, textStatus) {
					//setTimeout(function(){
						$("#preloader-page").fadeOut(300, function() {
							$("#loader-box").html(data).hide().fadeIn(600, function() {
								$(".nano").nanoScroller();
							});
						});				
					//}, 8000);	
				}
			});
		};

		ajax_load({mod: "index"});

		$(document).on('click', '#but-g-m', function(event) {
			ajax_load({mod: "index"});
		});

		$(document).on('click', '#but-g-c', function(event) {

		});

		$(document).on('click', '#but-g-sc', function(event) {
		});

		$(document).on('click', '#but-g-mfut', function(event) {
		});

		$(document).on('click', '#but-g-boost', function(event) {
		});
	});
});
