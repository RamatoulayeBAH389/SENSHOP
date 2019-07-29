jQuery(document).ready(function($) {
		$('.lastest_posts').owlCarousel({
			pagination: false,
			center: false,
			nav: true,
			loop: true,
			dots: false,
			margin: 30,
			navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
			slideBy: 1,
			autoplay: false,
			autoplayTimeout: 2500,
			autoplayHoverPause: true,
			autoplaySpeed: 800,
			startPosition: 0, 
			responsive:{
				0:{
					items:1
				},
				481:{
					items:2
				},
				768:{
					items:2
				},
				992:{
					items:3
				},
				1200:{
					items:3
				}
			}
		});
	});
