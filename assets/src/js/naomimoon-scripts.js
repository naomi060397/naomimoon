(function ($) {
	"use strict";
	$(document).on("click", ".naomimoon-header__hamburger", function () {
	  $('.naomimoon-header__hamburger-menu').toggleClass('active');
	  $('.dim-background').toggleClass('active');
	});

	$(document).on("click", ".dim-background", function () {
		$('.naomimoon-header__hamburger-menu').toggleClass('active');
		$('.dim-background').toggleClass('active');
	});

	// Hidden Sticky Header
	var lastScroll = 0;
	var width = $(window).width();

	$(window).scroll(function () {
		var scroll = $(this).scrollTop();
		if (width >= 900) {
			if (scroll < 1150) {
				$(".site-header").removeClass("scrolled");
			}
			if (scroll > lastScroll && scroll > 270) {
				$(".site-header").addClass("scrolled");
			}
			lastScroll = scroll;
		}
	});

	// Detect mouse at top of page
	$(document).mousemove(function(e){
		var verticalClient = e.clientY;
		var verticalPage = e.pageY;
		if (width >= 900) {
			if(verticalClient <= 55) {
				$(".site-header").removeClass("scrolled");
			}
			if (verticalClient >= 55 && verticalPage >= 1000) {
				$(".site-header").addClass("scrolled");
			}
		}
	});
	
	// Back to top animation
	$(document).on('click', '.back-to-top', function (e) {
		$("html, body").animate({ scrollTop: "0" });
		$(".site-header").removeClass("scrolled");
	});

})(jQuery);