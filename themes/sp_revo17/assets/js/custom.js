/*
 * Custom code goes here. 
 * But it could slow down your site * Neil Trinh
 */

$(document).ready( function(){
    if ($('#js-product-list').length > 0) {
        magentech.init();
    }
    prestashop.on('updateProductList', function (event) {
        if (magentech.spMagentechDisplay instanceof Function) {
                var view = $.totalStorage('n_display');
                        magentech.spMagentechDisplay(view);
        }
    });	
});	

jQuery(document).ready(function($) {
	$('.product-accessories .products').owlCarousel({
		pagination: false,
		center: false,
		nav: true,
		mouseDrag: false,
		loop: true,
		margin: 30,
		navText: [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ],
		dots: false,
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
			480:{
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
			},
			1400:{
				items:3
			}
		}
	});
});

jQuery(document).ready(function($) {
	$('.testimonials .testimonial-items').owlCarousel({
		pagination: false,
		center: false,
		nav: true,
		dots: false,
		loop: true,
		margin: 0,
		navText: [ '<i class="fa fa-caret-left"></i>', '<i class="fa fa-caret-right"></i>' ],
		slideBy: 1,
		autoplay: false,
		autoplayTimeout: 2500,
		autoplayHoverPause: true,
		autoplaySpeed: 800,
		startPosition: 0,
		mouseDrag: 0,
		touchDrag: 0,
		pullDrag: 0,
		responsive:{
			0:{
				items:1
			},
			481:{
				items:1
			},
			768:{
				items:1
			},
			992:{
				items:1
			},
			1200:{
				items:1
			}
		}
	});
});


jQuery(document).ready(function($) {
		$('.lastest_posts_7').owlCarousel({
			pagination: false,
			center: false,
			nav: true,
			loop: false,
			dots: false,
			margin: 0,
			navText: [ '<i class="fa fa-caret-left"></i>', '<i class="fa fa-caret-right"></i>' ],
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
				480:{
					items:1
				},
				768:{
					items:1
				},
				1200:{
					items:1
				}
			}
		});
});
