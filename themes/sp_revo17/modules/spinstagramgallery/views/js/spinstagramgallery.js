jQuery(document).ready(function ($) {
	$( ".sp-instagram-gallery" ).each(function() {
		var $element = $(this);
		var value_user_id = $element.attr('data-user_id');
		var value_access_token = $element.attr('data-access_token');
		var value_limit = $element.attr('data-count_number_img');
		var value_row = $element.attr('data-nb_row');
		var active_owl = $element.attr('data-active_owl');
		if (value_user_id && value_access_token) {
			var media_users_recent = "https://api.instagram.com/v1/users/" + value_user_id + "/media/recent?access_token=" + value_access_token;
			if(active_owl == 1){
				$.ajax({
					method: "GET",
					dataType: "jsonp",
					cache: false,
					url: media_users_recent,
					success: function (response) {
						var data_image = response.data;
						if (typeof (data_image) == 'undefined') {
							$('.instagram-slider', $element).append("<div>Please check User ID, Access token or Networking again.</div>");
							return;
						}

						if (data_image.length > 0) {
							//add li
							if (value_limit > data_image.length) {
								var value_limit_img = data_image.length;
							} else {
								var value_limit_img = value_limit;
							}

							if (value_limit >= 1) {
								var html = '';
								for (var i = 0; i < value_limit_img; i++) {
									var k =i+1;	
									var $href = '<a href="'+data_image[i].link+'" target="_blank"><img class="fancybox-image"  src="'+data_image[i].images.low_resolution.url+'" alt=""/></a>';						
										if(k==1 || k%value_row==1 || value_row==1)
										html += "<div class='item'>"; 
											html += "<a  data-fancybox-group='other-views' href='#instagramimg"+i+"' data-href='"+data_image[i].link+"' data-link='"+data_image[i].images.low_resolution.url+"' class='fancybox'>" ;
											html +=	"<img src='" + data_image[i].images.low_resolution.url + "'>"; 
											html += "</a>";			
											html += "<div id='instagramimg"+i+"' style='display:none'>";
											html +=		$href ;
											html +=	"</div>";	
										if(k%value_row==0 || k==value_limit_img || value_row==1)
										 html +=	"</div>";
								}
								$('.instagram-slider', $element).append(html);
							} else {
								var html = '';
								for (var j = 0; j < data_image.length; j++) {
									var k =j+1;	
									var $href = '<a href="'+data_image[j].link+'" target="_blank"><img class="fancybox-image"  src="'+data_image[j].images.low_resolution.url+'" alt=""/></a>';
									if(k==1 || k%value_row==1)
										html += "<div class='item'>"; 
										html += "<a  data-fancybox-group='other-views' href='#instagramimg"+j+"' data-href='"+data_image[j].link+"' data-link='"+data_image[j].images.low_resolution.url+"' class='fancybox'>" ;
										html +=	"<img src='" + data_image[j].images.low_resolution.url + "'>"; 
										html += "</a>";			
										html += "<div id='instagramimg"+j+"' style='display:none'>";
										html +=		$href ;
										html +=	"</div>";	
									if(k%value_row==0 || k==value_limit_img )
										html +=	"</div>";												
								}
								$('.instagram-slider', $element).append(html);
							}
						}else {
							$('.instagram-slider', $element).append("<div>No Image To Show</div>");
							return;
						}
						
						$spinstagramgallery = $(".instagram-slider",$element),
						_delay = $element.attr('data-delay'),
						_duration = $element.attr('data-duration'),
						_effect = $element.attr('data-effect');	
						$spinstagramgallery.on("initialized.owl.carousel", function () {
							var $item_active = $(".spinstagramgallery-item.active", $element);
							if ($item_active.length > 1 && _effect != "none") {
								_getAnimate($item_active);
							}
							else {
								var $item = $(".spinstagramgallery-item", $element);
								$item.css("opacity", "1");
								$item.css("filter", "alpha(opacity = 100)");
							}
						});

						$spinstagramgallery.owlCarousel({
							autoplay: ($element.attr('data-autoplay') == 1 ? true :false ),
							autoplayTimeout: $element.attr('data-autoplay_timeout'),
							autoplaySpeed: $element.attr('data-autoplaySpeed'),
							smartSpeed: 500,
							autoplayHoverPause: ($element.attr('data-autoplayHoverPause') == 1 ? true :false ),
							startPosition: $element.attr('data-startPosition'),
							mouseDrag: ($element.attr('data-mouseDrag') == 1 ? true :false ),
							touchDrag: ($element.attr('data-touchDrag') == 1 ? true :false ),
							autoWidth: false,
							margin: ($(".spinsta-layout5").length) ? 0 :10,
							dotClass: "spinstagramgallery-dot",
							dotsClass: "spinstagramgallery-dots",
							themeClass: 'spinstagramgallery-theme',
							baseClass: 'spinstagramgallery-carousel',
							itemClass: 'spinstagramgallery-item',
							nav: ($element.attr('data-nav') == 1 ? true :false ),
							loop: ($element.attr('data-loop') == 1 ? true :false ),
							navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
							navClass: ["owl-prev", "owl-next"],
							responsive:{
								0:{
								  items: $element.attr('data-nb_column4') // In this configuration 1 is enabled from 0px up to 479px screen size 
								},
								480:{
								  items: $element.attr('data-nb_column3') // In this configuration 1 is enabled from 0px up to 767px screen size 
								},	
								768:{
								  items: $element.attr('data-nb_column2') // In this configuration 1 is enabled from 0px up to 1199px screen size 
								},	
								1200:{
								  items: $element.attr('data-nb_column1') // In this configuration 1 is enabled from 0px up to 1200px screen size 
								},												
							}
						});

						$spinstagramgallery.on("translate.owl.carousel", function (e) {
							var $item_active = $(".spinstagramgallery-item.active", $element);
							if ($item_active.length > 1 && _effect != "none")
								_UngetAnimate($item_active);
							_getAnimate($item_active);
						});

						$spinstagramgallery.on("translated.owl.carousel", function (e) {
							var $item_active = $(".spinstagramgallery-item.active", $element);
							var $item = $(".spinstagramgallery-item", $element);
							if ($item_active.length > 1 && _effect != "none")
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
							$spinstagramgallery.removeClass("extra-animate");
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
									$spinstagramgallery.addClass("extra-animate");
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
						
						$('.fancybox',$element).fancybox();									
					},
					error: function () {
						$('.instagram-slider', $element).append("<div>Please check User ID, Access token or Networking again.</div>");
					}
				});
			}else{ /*active_owl == 0*/
				$.ajax({
					method: "GET",
					dataType: "jsonp",
					cache: false,
					url: media_users_recent,
					success: function (response) {
						var data_image = response.data;
						if (typeof (data_image) == 'undefined') {
							$('.ig-items ul', $element).append("<li>Please check User ID, Access token or Networking again.</li>");
							return;
						}

						if (data_image.length > 0) {
							//add li
							if (value_limit > data_image.length) {
								var value_limit_img = data_image.length;
							} else {
								var value_limit_img = value_limit;
							}

							if (value_limit >= 1) {
								for (var i = 0; i < value_limit_img; i++) {
									var $href = '<a href="'+data_image[i].link+'" target="_blank"><img class="fancybox-image"  src="'+data_image[i].images.low_resolution.url+'" alt=""/></a>';
									$('.ig-items ul', $element).append(
											"<li>" +
											"<a  data-fancybox-group='other-views' href='#instagramimg"+i+"' data-href='"+data_image[i].link+"' data-link='"+data_image[i].images.low_resolution.url+"' class='fancybox'>" +
												"<img src='" + data_image[i].images.low_resolution.url + "'>" +
											"</a>"	+
											"<div id='instagramimg"+i+"' style='display:none'>"+
												$href + 
											"</div>"+																
											"</li>"
									);
								}
							} else {
								for (var j = 0; j < data_image.length; j++) {
									var $href = '<a href="'+data_image[j].link+'" target="_blank"><img class="fancybox-image"  src="'+data_image[j].images.low_resolution.url+'" alt=""/></a>';
									$('.ig-items ul', $element).append(
									"<li>" +
										"<a   data-fancybox-group='other-views' href='#instagramimg"+j+"' data-href='"+data_image[j].link+"' data-link='"+data_image[j].images.low_resolution.url+"' class='fancybox'>" +
											"<img src='" + data_image[j].images.low_resolution.url + "'>" +
										"</a>"	+
										"<div id='instagramimg"+j+"' style='display:none'>"+
											$href + 
										"</div>"+						
									"</li>"
									);
								}
							}
							
						$('.fancybox',$element).fancybox();	
					
						}else {
							$('.ig-items ul', $element).append("<li>No Image To Show'</li>");
							return;
						}
					},
					error: function () {
						$('.ig-items ul', $element).append("<li>Please check User ID, Access token or Networking again.</li>");
					}
				});
			}
			
		}else{
			$('.instagram-slider', $element).append("<div>Please check User ID.</div>");
		}
	})
});