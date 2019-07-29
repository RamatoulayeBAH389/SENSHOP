jQuery(document).ready(function ($) {
	$( ".sp-extraslider" ).each(function() {
		var $element = $(this),
				$extraslider = $(".extraslider-inner", $element),
				_delay = $extraslider.attr("data-effect"),
				_duration = $extraslider.attr("data-effect"),
				_effect = $extraslider.attr("data-effect");

		$extraslider.on("initialized.owl.carousel", function () {
			var $item_active = $(".owl-item.active", $element);
			if ($item_active.length > 1 && _effect != "none") {
				_getAnimate($item_active);
			}
			else {
				var $item = $(".owl-item", $element);
				$item.css("opacity", "1");
				$item.css("filter", "alpha(opacity = 100)");
			}
			$(".owl-controls", $element).insertBefore($extraslider);
			$(".owl-dots", $element).insertAfter($(".owl-prev", $element));
		});

		$extraslider.owlCarousel({
			margin: $element.data("margin"),
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

		$extraslider.on("translate.owl.carousel", function (e) {
			var $item_active = $(".owl-item.active", $element);
			_UngetAnimate($item_active);
			_getAnimate($item_active);
		});

		$extraslider.on("translated.owl.carousel", function (e) {
			var $item_active = $(".owl-item.active", $element);
			var $item = $(".owl-item", $element);

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
			$extraslider.removeClass("extra-animate");
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
					$extraslider.addClass("extra-animate");
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
					"opacity": 1
				});
			});
		}
		
var _timer = 0;
$(window).load(function () {
	if (_timer) clearTimeout(_timer);
	_timer = setTimeout(function () {
		$(".sp-loading", $element).remove();
		$element.removeClass("sp-preload");
	}, 1000);
});

data = new Date(2013, 10, 26, 12, 00, 00);
function CountDown(date, id) {
	dateNow = new Date();
	amount = date.getTime() - dateNow.getTime();
	if (amount < 0 && $("#" + id).length) {
		$("." + id).html("Now!");
	} else {
		days = 0;
		hours = 0;
		mins = 0;
		secs = 0;
		out = "";
		amount = Math.floor(amount / 1000);
		days = Math.floor(amount / 86400);
		amount = amount % 86400;
		hours = Math.floor(amount / 3600);
		amount = amount % 3600;
		mins = Math.floor(amount / 60);
		amount = amount % 60;
		secs = Math.floor(amount);
		if (days != 0) {
			out += "<div class='time-item time-day'>" + "<div class='num-time'>" + days + "</div>" + "<div class='name-time'>" + ((days == 1) ? "Day" : "Days") + "</div>" + "</div> ";
		}
		if (hours != 0) {
			out += "<div class='time-item time-hour'>" + "<div class='num-time'>" + hours + "</div>" + "<div class='name-time'>" + ((hours == 1) ? "Hour" : "Hours") + "</div>" + "</div>";
		}
		out += "<div class='time-item time-min'>" + "<div class='num-time'>" + mins + "</div>" + "<div class='name-time'>" + ((mins == 1) ? "Min" : "Mins") + "</div>" + "</div>";
		out += "<div class='time-item time-sec'>" + "<div class='num-time'>" + secs + "</div>" + "<div class='name-time'>" + ((secs == 1) ? "Sec" : "Secs") + "</div>" + "</div>";
		out = out.substr(0, out.length - 2);
		$("." + id).html(out);

		 setTimeout(function () {
			 CountDown(date, id);
		 }, 1000);
	}
}

		if (extradeal.length > 0) {
			for (var i = 0; i < extradeal.length; i++) {
				var arr = extradeal[i].split("|");
				if (arr[1].length) {
					var data = new Date(arr[1]);
					CountDown(data, arr[0]);
				}
			}
		}							

	});
});
