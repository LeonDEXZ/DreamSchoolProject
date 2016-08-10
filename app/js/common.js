// AJAX
function ajax_load(q_data)
{
	$("#message-box").slideUp(800, function(){
		$("#message-box").empty();
		$('#message-box').append("<div id=\"message_new\" class='message' style=\"display: none;\"></div>");
	});

	q_data.ajax = "";

	var loader = $('#loader-box');
	if (!loader.is(':empty'))
	{
		loader.empty();
		$("#preloader-page").show();
	}

	$.ajax({
		method: "GET",
		url: SitePath + "/index.php",
		dataType: "html",
		data: q_data,
		success: function (data, textStatus) {
			$("#preloader-page").fadeOut(300, function() {
				$("#loader-box").html(
					$(data).hide().fadeIn(600)
				);
			});				
		}
	});
};

window.onpopstate = function() {
	if (history.state.load_state)
	{
		ajax_load(history.state.pageObj);
	}
};
	
$(document).ready(function() {
	// no drag img
	$("img, a").on("dragstart", function(event) {
		event.preventDefault();
	});

	// superfish
	// $('#top-menu').superfish({
	// 	delay: 200,
	// 	hoverClass: 'sf-hover-no',
	// 	cssArrows: false
	// });
	
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

	//ajax_load({mod: "boost", id: 1});
	// ajax_load({mod: "blog", news: '', page: 2});
	// ajax_load({mod: "blog", full: '', id: 2});
	// ajax_load({mod: "commentator"});

	console.log(history.state);

	if (!$('#loader-box').is(':empty'))
	{
		$("#preloader-page").fadeOut(300, function() {
			$("#loader-box").fadeIn(600);
		});	
	}
	else if (history.state.load_state !== null)
	{
		ajax_load(history.state.pageObj);
	}
	else
	{
		ajax_load({mod: "index"});
	}

	$(document).on('click', '#but-g-index', function(event) {
		var page = {mod: 'index'};

		window.history.pushState({load_state: true, pageObj: page}, 'Главная', SitePath+'/');
		$('title').html('Главная');

		ajax_load(page);
	});

	$(document).on('click', '#but-g-coach', function(event) {
		var page = {mod: "coach"};

		window.history.pushState({load_state: true, pageObj: page}, 'Обучение', SitePath+"/coach");
		$('title').html('Обучение');

		ajax_load(page);
	});

	$(document).on('click', '#but-g-commentator', function(event) {
		var page = {mod: "commentator"};

		window.history.pushState({load_state: true, pageObj: page}, 'Школа комментаторов', SitePath+"/commentator");
		$('title').html('Школа комментаторов');

		ajax_load(page);
	});

	$(document).on('click', '#but-g-menager', function(event) {
		var page = {mod: "menager"};

		window.history.pushState({load_state: true, pageObj: page}, 'Менеджер для вашей команды', SitePath+"/menager");
		$('title').html('Менеджер для вашей команды');

		ajax_load(page);
	});

	$(document).on('click', '#but-g-boost', function(event) {
		var page = {mod: "boost"};

		window.history.pushState({load_state: true, pageObj: page}, 'Boost RMM', SitePath+"/boost");
		$('title').html('Boost RMM');

		ajax_load(page);
	});

	$(document).on('click', '#but-g-news', function(event) {
		var page = {mod: "blog", news: ""};

		window.history.pushState({load_state: true, pageObj: page}, 'Новости', SitePath+"/news");
		$('title').html('Новости');

		ajax_load(page);
	});
});
