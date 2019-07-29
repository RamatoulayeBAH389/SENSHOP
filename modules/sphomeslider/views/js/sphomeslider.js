jQuery(document).ready(function ($) {
	$( ".sphomepage-slider" ).each(function() {
		var $element = $(this),
		$homeslider = $(".sp-homeslider", $element);
		var _timer = 0;
		$(window).load(function () {
			if (_timer) clearTimeout(_timer);
			_timer = setTimeout(function () {
				$element.removeClass("sp-preload");
				$(".sp-loading", $element).remove();
			}, 1000);
		});
		$homeslider.owlCarousel({
			animateOut: $element.data("animateOut"),
			animateIn: $element.data("animateIn"),
			autoplay: ($element.data("autoplay") == 1 ) ? true : false,
			autoplayTimeout: $element.data("autoplay_timeout"),
			autoplaySpeed: $element.data("autoplaySpeed"),
			smartSpeed: 500,
			autoplayHoverPause: $element.data("autoplayHoverPause"),
			startPosition: $element.data("startPosition"),
			dots: $element.data("dots"),
			autoWidth: false,
			dotClass: "owl-dot",
			dotsClass: "owl-dots",
			nav: ($element.data("nav") == 1 ) ? true : false,
			loop: ($element.data("loop") == 1 ) ? true : false,
			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
			navClass: ["owl-prev", "owl-next"],
			responsive:{
				0:{
				  items:1 // In this configuration 1 is enabled from 0px up to 479px screen size 
				},
			}
		});
	});
});