  jQuery(document).ready(function ($) {
		$( ".sp_supercategory" ).each(function() {
			var $element = $(this),
                    $tab = $(".spcat-tab", $element),
                    $tab_label = $(".spcat-tab-label", $tab),
                    $tabs = $(".spcat-tabs", $element),
					ajax_url = $tabs.parents(".spcat-tabs-container").attr("data-ajaxurl")+"modules/spsupercategory/spsupercategory_ajax.php",
                    effect = $tabs.parents(".spcat-tabs-container").attr("data-effect"),
                    delay = $tabs.parents(".spcat-tabs-container").attr("data-delay"),
                    duration = $tabs.parents(".spcat-tabs-container").attr("data-duration"),
                    rl_moduleid = $tabs.parents(".spcat-tabs-container").attr("data-modid"),
					language_site = $tabs.parents(".spcat-tabs-container").attr("data-language_site"),
                    $items_content = $(".spcat-items", $element),
                    $items_inner = $(".spcat-items-inner", $items_content),
                    $items_first_active = $(".spcat-items-selected", $element),
                    $load_more = $(".spcat-loadmore", $element),
                    $btn_loadmore = $(".spcat-loadmore-btn", $load_more),
                    $select_box = $(".spcat-selectbox", $element),
                    $id_cate = $(".spcat-tab", $element).attr("data-id-cate"),
                    $tab_label_select = $(".spcat-tab-selected", $element),
					category_id = $(".sp-cat-title-parent", $element).attr("data-catids"),
					$condition = ($element.data("show_loadmore_slider") && $element.data("show_loadmore_slider") == 'slider' ) ? true : false;
			
            $(window).on("load", function () {
                setTimeout(function () {
                    $(".sp-super-loading", $element).remove();
					$(".sp-sp-cat", $element).removeClass("sp-super-preload");
                }, 1000);
            });

            enableSelectBoxes();
            function enableSelectBoxes() {
                $tab_wrap = $(".spcat-tabs-wrap", $element);
                $tab_label_select.html($(".spcat-tab", $element).filter(".tab-sel").children(".spcat-tab-label").html());
                if ($(window).innerWidth() <= 479) {
                    $tab_wrap.addClass("spcat-selectbox");
                } else {
                    $tab_wrap.removeClass("spcat-selectbox");
                }
            }

            $("span.spcat-tab-selected, span.spcat-tab-arrow", $element).click(function () {
                if ($(".spcat-tabs", $element).hasClass("spcat-open")) {
                    $(".spcat-tabs", $element).removeClass("spcat-open");
                } else {
                    $(".spcat-tabs", $element).addClass("spcat-open");
                }
            });

            $(window).resize(function () {
                if ($(window).innerWidth() <= 479) {
                    $(".spcat-tabs-wrap", $element).addClass("spcat-selectbox");
                } else {
                    $(".spcat-tabs-wrap", $element).removeClass("spcat-selectbox");
                }
            });

            function showAnimateItems(el) {
                var $_items = $(".new-ltabs-item", el), nub = 0;
                $(".spcat-loadmore-btn", el).fadeOut("fast");
                $_items.each(function (i) {
                    nub++;
                    switch (effect) {
                        case "none" :
                            $(this).css({"opacity": "1", "filter": "alpha(opacity = 100)"});
                            break;
                        default:
                            animatesItems($(this), nub * delay, i, el);
                    }
                    if (i == $_items.length - 1) {
                        $(".spcat-loadmore-btn", el).fadeIn(delay);
                    }
                    $(this).removeClass("new-ltabs-item");
                });
            }

            function animatesItems($this, fdelay, i, el) {
                var $_items = $(".ltabs-item", el);
                $this.attr("style",
                        "-webkit-animation:" + effect + " " + duration + "ms;"
                        + "-moz-animation:" + effect + " " + duration + "ms;"
                        + "-o-animation:" + effect + " " + duration + "ms;"
                        + "-moz-animation-delay:" + fdelay + "ms;"
                        + "-webkit-animation-delay:" + fdelay + "ms;"
                        + "-o-animation-delay:" + fdelay + "ms;"
                        + "animation-delay:" + fdelay + "ms;").delay(fdelay).animate({
                            opacity: 1,
                            filter: "alpha(opacity = 100)"
                        }, {
                            delay: 100
                        });
                if (i == ($_items.length - 1)) {
                    $(".spcat-items-inner").addClass("play");
                }
            }

            showAnimateItems($items_first_active);
            $tab.on("click.tab", function () {
                var $this = $(this);
                if ($this.hasClass("tab-sel")) return false;
                if ($this.parents(".spcat-tabs").hasClass("spcat-open")) {
                    $this.parents(".spcat-tabs").removeClass("spcat-open");
                }
                $tab.removeClass("tab-sel");
                $this.addClass("tab-sel");
                var items_active = $this.attr("data-active-content");

                var _items_active = $(items_active, $element);
                $items_content.removeClass("spcat-items-selected");
                _items_active.addClass("spcat-items-selected");
                $tab_label_select.html($tab.filter(".tab-sel").children(".spcat-tab-label").html());
                var $loading = $(".spcat-loading", _items_active);
                var loaded = _items_active.hasClass("spcat-items-loaded");
                if (!loaded && !_items_active.hasClass("spcat-process")) {
                    _items_active.addClass("spcat-process");
                    var field_order = $this.attr("data-field_order");
                    $loading.show();
                    $.ajax({
                        type: "POST",
                        url: ajax_url,
                        data: {
                            spcat_module_id: rl_moduleid,
                            is_ajax_super_category: 1,
                            ajax_limit_start: 0,
                            categoryid: category_id,
                            fieldorder: field_order
                        },
                        success: function (data) {
                            if (data.items_markup != "") {
                                $(".spcat-items-inner", _items_active).html(data.items_markup);
                                _items_active.addClass("spcat-items-loaded").removeClass("spcat-process");
                                $loading.remove();
                                showAnimateItems(_items_active);
                                updateStatus(_items_active);

                                if ($condition){
                                    CreateProSlider($(".spcat-items-inner", _items_active));
								}

                            }
                        },
                        dataType: "json",
                        error: function(){

                        }
                    });

                } else {

                       if ($condition == false){
                            $(".ltabs-item", $items_content).removeAttr("style").addClass("new-ltabs-item").css("opacity", 0);
                            showAnimateItems(_items_active);  
					   }

                    if ($condition){

						var owl = $(".spcat-items-inner", _items_active);
						owl = owl.data("owlCarousel");
						if(typeof owl === "undefined") {
						}else{
							owl.onResize();
						}

                    }

                }
            });

            function updateStatus($el) {
                $(".spcat-loadmore-btn", $el).removeClass("loading");
                var countitem = $(".ltabs-item", $el).length;
                $(".spcat-image-loading", $el).css({display: "none"});
                $(".spcat-loadmore-btn", $el).parent().attr("data-rl_start", countitem);
                var rl_total = $(".spcat-loadmore-btn", $el).parent().attr("data-rl_total");
                var rl_load = $(".spcat-loadmore-btn", $el).parent().attr("data-rl_load");
                var rl_allready = $(".spcat-loadmore-btn", $el).parent().attr("data-rl_allready");

                if (countitem >= rl_total) {
                    $(".spcat-loadmore-btn", $el).addClass("loaded");
                    $(".spcat-image-loading", $el).css({display: "none"});
                    $(".spcat-loadmore-btn", $el).attr("data-label", rl_allready);
                    $(".spcat-loadmore-btn", $el).removeClass("loading");
                }
            }

            $btn_loadmore.on("click.loadmore", function () {
                var $this = $(this);
                if ($this.hasClass("loaded") || $this.hasClass("loading")) {
                    return false;
                } else {
                    $this.addClass("loading");
                    $(".spcat-image-loading", $this).css({display: "inline-block"});
                    var rl_start = $this.parent().attr("data-rl_start"),
                            rl_moduleid = $this.parent().attr("data-modid"),
                            effect = $this.parent().attr("data-effect"),
                            field_order = $this.parent().attr("data-field_order"),
                            items_active = $this.parent().attr("data-active-content");
                    var _items_active = $(items_active, $element);
                    $.ajax({
                        type: "POST",
                        url: ajax_url,
                        data: {
                            spcat_module_id: rl_moduleid,
                            is_ajax_super_category: 1,
                            ajax_limit_start: rl_start,
                            categoryid: category_id,
                            fieldorder: field_order
                        },
                        success: function (data) {
                            if (data.items_markup != "") {
								
                                $(data.items_markup).insertAfter($(".ltabs-item", _items_active).nextAll().last());
                                $(".spcat-image-loading", $this).css({display: "none"});
                                showAnimateItems(_items_active);
                                updateStatus(_items_active);
                            }
                        }, dataType: "json"
                    });
                }
                return false;
            });
            var $cat_slider_inner = $(".cat_slider_inner", $element);
            $cat_slider_inner.owlCarousel({
				center: $element.data("center"),
				nav: ($element.data("nav") && $element.data("nav") == 1 ) ? true : false,
				loop: ($element.data("loop") && $element.data("loop") == 1 ) ? true : false,
				margin: $element.data("margin"),
				slideBy: $element.data("slideby"),
				autoplay: ($element.data("autoplay") && $element.data("autoplay") == 1 ) ? true : false,
				autoplayHoverPause: ($element.data("autoplayhoverpause") && $element.data("autoplayhoverpause") == 1 ) ? true : false,
				autoplayTimeout: $element.data("autoplaytimeout"),
				autoplaySpeed: $element.data("autoplayspeed"),
				navSpeed: $element.data("navspeed"),
				startPosition: $element.data("startposition"),
				mouseDrag: ($element.data("mousedrag") && $element.data("mousedrag") == 1 ) ? true : false,
				touchDrag:($element.data("touchdrag") && $element.data("touchdrag") == 1 ) ? true : false,
				dots: false,
				autoWidth: false,
				navClass: ["sp-owl-prev", "sp-owl-next"],
				responsive: {
					0: { items:$element.data("nb__column4") },
					480: {items:$element.data("nb__column3")},
					768: {items:$element.data("nb__column2")},
					1200: {items:$element.data("nb__column1")}
				}
            });

            if($condition){

                if($(".spcat-items-inner", $element).parent().hasClass("spcat-items-selected")){
                    var items_active = $(".spcat-tab.tab-sel", $element).attr("data-active-content");
                    var _items_active = $(items_active, $element);
                    CreateProSlider($(".spcat-items-inner", _items_active));
                }

                function CreateProSlider($items_inner){
                    $items_inner.owlCarousel({
					center: $element.data("center"),
					nav: ($element.data("nav") && $element.data("nav") == 1 ) ? true : false,
					loop: ($element.data("loop") && $element.data("loop") == 1 ) ? true : false,
					margin: $element.data("margin"),
					slideBy: $element.data("slideby"),
					autoplay: ($element.data("autoplay") && $element.data("autoplay") == 1 ) ? true : false,
					autoplayHoverPause: ($element.data("autoplayhoverpause") && $element.data("autoplayhoverpause") == 1 ) ? true : false,
					autoplayTimeout: $element.data("autoplaytimeout"),
					autoplaySpeed: $element.data("autoplayspeed"),
					navSpeed: $element.data("navspeed"),
					startPosition: $element.data("startposition"),
					mouseDrag: ($element.data("mousedrag") && $element.data("mousedrag") == 1 ) ? true : false,
					touchDrag:($element.data("touchdrag") && $element.data("touchdrag") == 1 ) ? true : false,
					dots: false,
					autoWidth: false,
					navClass: ["sp-owl-prev", "sp-owl-next"],
                    navText: ["&#139;", "&#155;"],
					responsive: {
						0: { items:$element.data("nb_column4") },
						480: {items:$element.data("nb_column3")},
						768: {items:$element.data("nb_column2")},
						1200: {items:$element.data("nb_column1")}
					}
                    });
                }
			}
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
							if(days != 0){
								out += "<div class='time-item time-day'>" + "<div class='num-time'>" + "<span>" + days + "</span>" + ((days==1)?"":"") + "</div>" + "</div> ";
							}
							
							if(hours != 0){
								out += "<div class='time-item time-hour'>" + "<div class='num-time'>" + "<span>" + hours + "</span>" + ((hours==1)?"":"") + "</div>" +"</div> ";
							}
							out += "<div class='time-item time-min'>" + "<div class='num-time'>" + "<span>" + mins + "</span>" + ((mins==1)?"":"") + "</div>" +"</div> ";
							out += "<div class='time-item time-sec'>" + "<div class='num-time'>" + "<span>" + secs + "</span>" + ((secs==1)?"":"") + "</div>" +"</div> ";
							out = out.substr(0,out.length-2);
							$("." + id).html(out);

							setTimeout(function () {
								CountDown(date, id);
							}, 1000);
						}
					}
					if (listsuper.length > 0) {
						for (var i = 0; i < listsuper.length; i++) {
							var arr = listsuper[i].split("|");
							if (arr[1].length) {
								var data = new Date(arr[1]);
								CountDown(data, arr[0]);
							}
						}
					}
				
				
		});	
    });
  