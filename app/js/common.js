/*
** Slider script
** Code by Leonid aka DEX Zharikov (leon.zharikov@gmail.com) 
*/
$(function() {
	$(document).ready(function(){
		$('#top-menu').superfish({
			delay: 200,
			hoverClass: 'sf-hover-no',
			cssArrows: false
		});
	});

	try {
		$.browserSelector();
		if($("html").hasClass("chrome")) {
			$.smoothScroll();
		}
	} catch(err) {

	};

	$("img, a").on("dragstart", function(event) { event.preventDefault(); });

	var AllSlide = $("#slider ul li");
	var CurrentSlide = 0;
	var AnimationOn = false;

	function RefreshSlide(old_slide)
	{
		if (CurrentSlide > AllSlide.length - 1) {
			CurrentSlide = 0;
		}

		if (CurrentSlide < 0) {
			CurrentSlide = AllSlide.length - 1;
		}

		if (old_slide == "nouse") {
			$(AllSlide.get(CurrentSlide)).show();
		}
		else {
			AnimationOn = true;
			$(AllSlide.get(old_slide)).fadeOut(300, function () {
				$(AllSlide.get(CurrentSlide)).fadeIn(400, function () {
					AnimationOn = false; 
				});
			});
		}
	}

	RefreshSlide("nouse");

	var IntervalTime = 3500;
	var IntervalSlide = setInterval(function(){
		  CurrentSlide++;
		  RefreshSlide(CurrentSlide - 1);
	}, IntervalTime);

	// next
	$("#slider_right").bind("click", function(){
		if (!AnimationOn)
		{
			clearInterval(IntervalSlide);

			CurrentSlide++;
			RefreshSlide(CurrentSlide - 1);

			IntervalSlide = setInterval(function(){
				  CurrentSlide++;
				  RefreshSlide(CurrentSlide - 1);
			}, IntervalTime);
		}	
	});

	// back
	$("#slider_left").bind("click", function(){
		if (!AnimationOn)
		{
			clearInterval(IntervalSlide);

			CurrentSlide--;
			RefreshSlide(CurrentSlide + 1);

			IntervalSlide = setInterval(function(){
				  CurrentSlide++;
				  RefreshSlide(CurrentSlide - 1);
			}, IntervalTime);
		}
	});
});