jQuery(document).ready(function($){
	var spts = $('.sp-twitter-slider');
	if (spts.length){
		spts.each(function(){
			var _el = $(this) , _cf = $('.spts-wrap'),
				spts_id_user = _cf.data('spts_id_user'),
				spts_screen_name = _cf.data('spts_screen_name'),
				spts_display_follow_button = _cf.data('spts_display_follow_button'),
				spts_display_avatar = _cf.data('spts_display_avatar'),
				spts_limit = _cf.data('spts_limit'),
				spts_idmodule = _cf.data('spts_idmodule');
			var _interval = setInterval(function() {
				if(document.readyState === 'complete') {
					clearInterval(_interval);
					_runAllScriptTwitterSlider();
				 }    
			}, 500);
			function _runAllScriptTwitterSlider () {
				var config = {
					  "profile": {"screenName": spts_screen_name},	
					  "id": spts_id_user,
					  "maxTweets": spts_limit,
					  "enableLinks": true,
					  "showUser": spts_display_avatar,
					  "showTime": true,
					  "showInteraction": false,
					  "customCallback": handleTweets
				};
				console.log(config);
				function handleTweets(tweets){
					var x = tweets.length;
					var n = 0;
					var j = 0;
					var element = document.getElementById('content-twiter');
					var start = 0;
					var html = '<div class="owl-carousel list-item">';
					while(n < x) {
						var active_cls = (n == start) ? 'active' : '';
						html += '<div class="spts-item item '+active_cls+'">' + tweets[n] + '</div>';
						n++;
					}
					html += '</div>';
					$('.spts-slider-wrap', _el).prepend($(html));
					_runOwlCarousel(_el);
				}
				twitterFetcher.fetch(config);
				function _runOwlCarousel(el) {
					$('.owl-carousel', el).owlCarousel({
						loop:false,
						nav:false,
						dots: true,
						autoplay: false,
						autoplayHoverPause: true,
						margin: 30,
						items: 1
					});
				}
			}
		});
	}
});