  jQuery(document).ready(function ($) {
		$( ".sp-listing-tabs" ).each(function() {
			var $element = $(this),
				$tab = $(".ltabs-tab", $element),
				$tab_label = $(".ltabs-tab-label", $tab),
				$tabs = $(".ltabs-tabs", $element),
				ajax_url = $element.data("base_dir")+"modules/splistingtabs/splistingtabs_ajax.php",
				effect = "none",
				delay = $tabs.parents(".ltabs-tabs-container").attr("data-delay"),
				duration = $tabs.parents(".ltabs-tabs-container").attr("data-duration"),
				rl_moduleid = $tabs.parents(".ltabs-tabs-container").attr("data-modid"),
				hook_name = $tabs.parents(".ltabs-tabs-container").attr("data-hookname"),
				$items_content = $(".ltabs-items", $element),
				$items_inner = $(".ltabs-items-inner", $items_content),
				$items_first_active = $(".ltabs-items-selected", $element),
				$load_more = $(".ltabs-loadmore", $element),
				$btn_loadmore = $(".ltabs-loadmore-btn", $load_more),
				$select_box = $(".ltabs-selectbox", $element),
				$tab_label_select = $(".ltabs-tab-selected", $element),
				$condition = ($element.data("show_loadmore_slider") && $element.data("show_loadmore_slider") == 'slider' ) ? true : false;
            enableSelectBoxes();
            function enableSelectBoxes() {
                $tab_wrap = $(".ltabs-tabs-wrap", $element),
                        $tab_label_select.html($(".ltabs-tab", $element).filter(".tab-sel").children(".ltabs-tab-label").html());
                if ($(window).innerWidth() <= 479) {
                    $tab_wrap.addClass("ltabs-selectbox");
                } else {
                    $tab_wrap.removeClass("ltabs-selectbox");
                }
            }

            $("span.ltabs-tab-selected, span.ltabs-tab-arrow", $element).click(function () {
                if ($(".ltabs-tabs", $element).hasClass("ltabs-open")) {
                    $(".ltabs-tabs", $element).removeClass("ltabs-open");
                } else {
                    $(".ltabs-tabs", $element).addClass("ltabs-open");
                }
            });

            $(window).resize(function () {
                if ($(window).innerWidth() <= 479) {
                    $(".ltabs-tabs-wrap", $element).addClass("ltabs-selectbox");
                } else {
                    $(".ltabs-tabs-wrap", $element).removeClass("ltabs-selectbox");
                }
            });

            function showAnimateItems(el) {
                var $_items = $(".new-ltabs-item", el), nub = 0;
                $(".ltabs-loadmore-btn", el).fadeOut("fast");
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
                        $(".ltabs-loadmore-btn", el).fadeIn(delay);
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
                    $(".ltabs-items-inner").addClass("play");
                }
            }

            showAnimateItems($items_first_active);
            $tab.on("click.tab", function () {
                var $this = $(this);
                if ($this.hasClass("tab-sel")) return false;
                if ($this.parents(".ltabs-tabs").hasClass("ltabs-open")) {
                    $this.parents(".ltabs-tabs").removeClass("ltabs-open");
                }
                $tab.removeClass("tab-sel");
                $this.addClass("tab-sel");
                var items_active = $this.attr("data-active-content");
                var _items_active = $(items_active, $element);

                $items_content.removeClass("ltabs-items-selected");
                _items_active.addClass("ltabs-items-selected");
                $tab_label_select.html($tab.filter(".tab-sel").children(".ltabs-tab-label").html());
                var $loading = $(".ltabs-loading", _items_active);
                var loaded = _items_active.hasClass("ltabs-items-loaded");
                if (!loaded && !_items_active.hasClass("ltabs-process")) {
                    _items_active.addClass("ltabs-process");
                    var category_id = $this.attr("data-category-id");
                    $loading.show();
                    $.ajax({
                        type: "POST",
                        url: ajax_url,
                        data: {
                            listing_tabs_moduleid: rl_moduleid,
                            is_ajax_listing_tabs: 1,
                            ajax_reslisting_start: 0,
                            categoryid: category_id,
			    hook_name: hook_name,
                            tinh: 1
                        },
                        success: function (data) {
                            if (data.items_markup != "") {
                                $(".ltabs-items-inner", _items_active).html(data.items_markup);
                                _items_active.addClass("ltabs-items-loaded").removeClass("ltabs-process");
                                $loading.remove();
                                showAnimateItems(_items_active);
                                updateStatus(_items_active);

                                if ($condition){
                                CreateProSlider($(".ltabs-items-inner", _items_active));
                                }
                            }
                        },
                        dataType: "json"
                    });
                } else {
                    if($condition == false){
                    $(".ltabs-item", $items_content).removeAttr("style").addClass("new-ltabs-item").css("opacity", 0);
                    showAnimateItems(_items_active);
					}

                    if($condition){
                    var owl = $(".ltabs-items-inner", _items_active);
                    owl = owl.data("owlCarousel");
                    if (typeof owl === "undefined") {
                    } else {
                        owl.onResize();
                    }
                    }
                }
            });

            function updateStatus($el) {
                $(".ltabs-loadmore-btn", $el).removeClass("loading");
                var countitem = $(".ltabs-item", $el).length;
                $(".ltabs-image-loading", $el).css({display: "none"});
                $(".ltabs-loadmore-btn", $el).parent().attr("data-rl_start", countitem);
                var rl_total = $(".ltabs-loadmore-btn", $el).parent().attr("data-rl_total");
                var rl_load = $(".ltabs-loadmore-btn", $el).parent().attr("data-rl_load");
                var rl_allready = $(".ltabs-loadmore-btn", $el).parent().attr("data-rl_allready");

                if (countitem >= rl_total) {
                    $(".ltabs-loadmore-btn", $el).addClass("loaded");
                    $(".ltabs-image-loading", $el).css({display: "none"});
                    $(".ltabs-loadmore-btn", $el).attr("data-label", rl_allready);
                    $(".ltabs-loadmore-btn", $el).removeClass("loading");
                }
            }

            $btn_loadmore.on("click.loadmore", function () {
                var $this = $(this);
                if ($this.hasClass("loaded") || $this.hasClass("loading")) {
                    return false;
                } else {
                    $this.addClass("loading");
                    $(".ltabs-image-loading", $this).css({display: "inline-block"});
                    var rl_start = $this.parent().attr("data-rl_start"),
                            rl_moduleid = $this.parent().attr("data-modid"),
			    lt_hook_name = $this.parent().attr("data-hookname"),
                            rl_ajaxurl = $element.data("base_dir") + "modules/splistingtabs/splistingtabs_ajax.php",
                            effect = $this.parent().attr("data-effect"),
                            category_id = $this.parent().attr("data-categoryid"),
                            items_active = $this.parent().attr("data-active-content");
                    var _items_active = $(items_active, $element);

                    $.ajax({
                        type: "POST",
                        url: rl_ajaxurl,
                        data: {
                            listing_tabs_moduleid: rl_moduleid,
                            is_ajax_listing_tabs: 1,
                            ajax_reslisting_start: rl_start,
                            categoryid: category_id,
			    hook_name: lt_hook_name
                        },
                        success: function (data) {
                            if (data.items_markup != "") {
                                $(data.items_markup).insertAfter($(".ltabs-item", _items_active).nextAll().last());
                                $(".ltabs-image-loading", $this).css({display: "none"});
                                showAnimateItems(_items_active);
                                updateStatus(_items_active);
                            }
                        }, dataType: "json"
                    });
                }
                return false;
            });

            if ($condition){
				if ($(".ltabs-items-inner", $element).parent().hasClass("ltabs-items-selected")) {
					var items_active = $(".ltabs-tab.tab-sel", $element).attr("data-active-content");
					var _items_active = $(items_active, $element);
					CreateProSlider($(".ltabs-items-inner", _items_active));
				}
            }


			function CreateProSlider($items_inner) {
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
					dots: false,
					autoWidth: false,
					navClass: ["owl-prev", "owl-next"],
					navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
					responsive: {
						0: { items:$element.data("nb_column4") },
						480: {items:$element.data("nb_column3")},
						768: {items:$element.data("nb_column2")},
						1200: {items:$element.data("nb_column1")}
					}
				});
			}
				
		});	
    });
  