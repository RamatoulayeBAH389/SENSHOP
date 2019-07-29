jQuery(document).ready(function ($) {
	$( ".sp-manu-slider" ).each(function() {
		var $element = $(this),
		$manufacturer = $(".spmanufactureslider", $element),
		_delay = $manufacturer.attr("data-effect"),
		_duration = $manufacturer.attr("data-effect"),
		_effect = $manufacturer.attr("data-effect");

		$manufacturer.on("initialized.owl.carousel", function () {
			var $item_active = $(".spmanufactureslider-item.active", $element);
			if ($item_active.length > 1 && _effect != "none") {
				_getAnimate($item_active);
			}
			else {
				var $item = $(".spmanufactureslider-item", $element);
				$item.css("opacity", "1");
				$item.css("filter", "alpha(opacity = 100)");
			}
		});
		var _timer = 0;
		$(window).load(function () {
			if (_timer) clearTimeout(_timer);
			_timer = setTimeout(function () {
				$element.removeClass("sp-preload");
				$(".sp-loading", $element).remove();
			}, 1000);
		});

		$manufacturer.owlCarousel({
			autoplay: ($element.data("autoplay") && $element.data("autoplay") == 1 ) ? true : false,
			autoplayTimeout: $element.data("autoplay_timeout"),
			autoplaySpeed: $element.data("autoplaySpeed"),
			smartSpeed: 500,
			autoplayHoverPause: $element.data("autoplayHoverPause"),
			startPosition: $element.data("startPosition"),
			dots: $element.data("dots"),
			autoWidth: false,
			//dotClass: "spdeal-dot",
			//dotsClass: "spdeal-dots",
			//themeClass: 'spdeal-theme',
			//baseClass: 'spdeal-carousel',
			//itemClass: 'spdeal-item',
			nav: ($element.data("nav") && $element.data("nav") == 1 ) ? true : false,
			loop: ($element.data("loop") && $element.data("loop") == 1 ) ? true : false,
			navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
			navClass: ["owl-prev", "owl-next"],
			responsive:{
				0: {items:1},
				480: {items:$element.data("nb_column4")},
				768: {items:$element.data("nb_column3")},
				992: {items:$element.data("nb_column2")},
				1200: {items:$element.data("nb_column1")},											
			}
		});

	$manufacturer.on("translate.owl.carousel", function (e) {
		var $item_active = $(".spmanufactureslider-item.active", $element);
		_UngetAnimate($item_active);
		_getAnimate($item_active);
	});

	$manufacturer.on("translated.owl.carousel", function (e) {
		var $item_active = $(".spmanufactureslider-item.active", $element);
		var $item = $(".spmanufactureslider-item", $element);
		
		_UngetAnimate($item);

		if ($item_active.length > 1 && _effect != "none") {
			_getAnimate($item_active);
		} else {
			$item.css("opacity", "1");
			$item.css("filter", "alpha(opacity = 100)");
		}
	});

	function _getAnimate($el) {
		if (_effect == "none") return;
		//if ($.browser.msie && parseInt($.browser.version, 10) <= 9) return;
		$manufacturer.removeClass("extra-animate");
		$el.each(function (i) {
			var $_el = $(this);
			$(this).css({
				"-webkit-animation": _effect + " " + _duration + "ms ease both",
				"-moz-animation": _effect + " " + _duration + "ms ease both",
				"-o-animation": _effect + " " + _duration + "ms ease both",
				"animation": _effect + " " + _duration + "ms ease both",
				"-webkit-animation-delay": +i * _delay + "ms",
				"-moz-animation-delay": +i * _delay + "ms",
				"-o-animation-delay": +i * _delay + "ms",
				"animation-delay": +i * _delay + "ms",
				"opacity": 1
			}).animate({
				opacity: 1
			});

			if (i == $el.size() - 1) {
				$manufacturer.addClass("extra-animate");
			}
		});
	}

	function _UngetAnimate($el) {
		$el.each(function (i) {
			$(this).css({
				"animation": "",
				"-webkit-animation": "",
				"-moz-animation": "",
				"-o-animation": "",
				"opacity": 0
			});
		});
	}	
	})
});
