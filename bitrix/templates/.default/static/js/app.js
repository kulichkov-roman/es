var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent);

if(window.jQuery != undefined) {
	$.support.FileReader = (window.FileReader !== undefined);
	if($.browser.msie && parseInt($.browser.version, 10) == 10) {
		$("html").addClass("ie10");
	};
	if(isMobile) {$("html").addClass("is-mobile");};
	
	if($.widget != undefined) {
		$.widget("ui.tabs", $.ui.tabs, {
			_getList: function() {
				return this.element.find("> .tabs-block__nav .tabs-nav__list").eq(0);
			}
		});
	};
	
	jQuery(document).ready(function($) {
/*-----------------------------tabs-block-------------------------------------*/
		$("body").on("initTabs", ".tabs-block.js-tabs", initTabs);
		$(".tabs-block.js-tabs").trigger("initTabs");
/*-----------------------------fancybox---------------------------------------*/
		if($.fn.fancybox != undefined) {
			$(".is_open_modal").trigger("click");
			$(".link-modal, .fancybox-media").fancybox();
		};
/*-----------------------------collapse-block---------------------------------*/
		$("body").on("initCollapse", ".collapse-block", initCollapse);
		$(".collapse-block").trigger("initCollapse");
/*-----------------------------scroll_block-----------------------------------*/
		$("body").on("initCustomScrollbar", ".js-scrollbar, .select-block__body-inner, .selectbox__dropdown-inner", initCustomScrollbar);
		$(".js-scrollbar, .select-block__body-inner, .selectbox__dropdown-inner").trigger("initCustomScrollbar");
/*----------------------------------------------------------------------------*/
	});
};
/*============================================================================*/
/*-----------------------------tabs-block-------------------------------------*/
function initTabs() {
	if($.fn.tabs != undefined) {
		var self = $(this);
		
		$("> .tabs-block__cont > .tabs-block__item.tabs-block__item--current", self).removeClass("tabs-block__item--current");
		if($(self).data("collapsible") == undefined && $(self).data("noactive") != undefined) {
			$("> .tabs-block__menu .tabs-nav__list", self).append($("<li>").addClass("tabs-nav__item notab-item").hide().append('<a href="#notab" class="tabs-nav__link"></a>'));
			$("> .tabs-block__cont", self).append($("<div>").addClass("tabs-block__item notab-item").attr("id", "notab").hide());
		};
		self.tabs({
			collapsible: $(self).data("collapsible") != undefined,
			active: $(self).data("collapsible") != undefined || $(self).data("noactive") != undefined ? false : 0,
			activate: function(event, ui) {
				var self = this;
				$(".slider-block__list", ui.newPanel).trigger("updateSlider");
				if($.fn.fancybox != undefined) {
					if($(".fancybox-inner").has(ui.newPanel)) {
						$.fancybox.update();
					};
				};
				if(this.synchronize !== undefined && this.synchronize.length) {
					var cur = $(".ui-tabs-anchor[data-synchronize-tab]", ui.newTab).data("synchronize-tab");
					$("> .tabs-block__cont > .tabs-block__item", this.synchronize).hide().filter(cur).show(0, function() {
						$(".slider-block__list", this).trigger("updateSlider");
					});
				};
				$(self).trigger("activate.tabs", [ui]);
			},
			create: function(event, ui) {
				var self = this,
					disabledArr = [];
				if($(self).data("collapsible") == undefined && $(self).data("noactive") != undefined) {
					$("> .tabs-block__menu .notab-item a.tabs-nav__link", self).click();
				};
				$("> .tabs-block__menu .tabs-nav__item", self).each(function(i) {
					if(!$("a.tabs-nav__link", this).is("[href^='#']") || !$($("a.tabs-nav__link", this).attr("href"), self).length) {
						disabledArr.push(i);
					};
				});
				if(disabledArr.length) {
					$(self).tabs("option", "disabled", disabledArr);
				};
				
				$("> .tabs-block__menu .tabs-nav__item input", self).on("change click", function() {
					if($(this).is(":checked")) {
						$(this).closest(".tabs-nav__item").find("a.tabs-nav__link").click();
					};
				}).triggerHandler("change");
				
				$(".slider-block__list", ui.panel).trigger("updateSlider");
				if($(this).data("synchronize") != undefined && $($(this).data("synchronize")).length) {
					this.synchronize = $($(this).data("synchronize"));
					var cur = $(".ui-tabs-anchor[data-synchronize-tab]", ui.tab).data("synchronize-tab");
					$("> .tabs-block__cont > .tabs-block__item", this.synchronize).removeClass("tabs-block__item--current").hide().filter(cur).show(0, function() {
						$(".slider-block__list", this).trigger("updateSlider");
					});
				};
				if($(".tabs-block__menu--emulation", self).length) {
					var emulationMenu = $(".tabs-block__menu--emulation", self);
					$(".tabs-nav__link[href='" + $(".tabs-nav__link", ui.tab).attr("href") + "']", emulationMenu).parent().addClass("ui-tabs-active");
					$(".tabs-nav__link[href^='#']", emulationMenu).on("click", function(event) {
						var link = $(this),
							tabLink = $("> .tabs-block__menu .tabs-nav__link[href='" + link.attr("href") + "']", self);
						if(tabLink.length) {
							event.preventDefault();
							$(tabLink).click();
						};
					});
				};
			}
		});
		if ($("> .tabs-block__menu .tabs-nav__item.tabs-nav__item--current", self).length) {
			$("> .tabs-block__menu .tabs-nav__item.tabs-nav__item--current", self).removeClass("tabs-nav__item--current").find(".tabs-nav__link").click();
		};
		self.on("activate.tabs", function(event, ui) {
			if($(".tabs-block__menu--emulation", self).length) {
				var emulationMenu = $(".tabs-block__menu--emulation", self);
				var oldHesh = $(".tabs-nav__link", ui.oldTab).attr("href"),
					newHesh = $(".tabs-nav__link", ui.newTab).attr("href");
				if(oldHesh != undefined) {
					$(".tabs-nav__link[href='" + oldHesh + "']", emulationMenu).parent().removeClass("ui-tabs-active");
				};
				if(newHesh != undefined) {
					$(".tabs-nav__link[href='" + newHesh + "']", emulationMenu).parent().addClass("ui-tabs-active");
				};
			};
		});
		$(".tabs-block__close", self).off("click.close").on("click.close", function() {
			$(this).closest(".ui-tabs").tabs( "option", "active", false );
		});
	} else {
		//console.log("Plagin \"tabs\" is not find!");
	};
};
/*-----------------------------fancybox---------------------------------------*/
if($.fn.fancybox != undefined) {
	$.extend(true, $.fancybox.defaults, {
		wrapCSS: "typo",
		scrolling: 'visible',
		autoCenter: !Modernizr.touch,
		fitToView: false,
		maxWidth: 960,
		minHeight: 0,
		margin: 20,
		padding: 20,
		parent: "body",
		//openEffect: "none",
		//closeEffect: "none",
		helpers : {
			overlay : {
				locked : false
			},
			title: {
				type: 'outside'
			},
			media : {}
		},
		tpl: {
			closeBtn : '<a title="Закрыть" class="fancybox-item fancybox-close" href="javascript:void(0);"></a>',
			next     : '<a title="Вперед" class="fancybox-nav fancybox-next" href="javascript:void(0);"><span></span></a>',
			prev     : '<a title="Назад" class="fancybox-nav fancybox-prev" href="javascript:void(0);"><span></span></a>'
		},
		keys: {
			toggle: false,
			play: false
		},
		beforeLoad: function() {
			if($(this.element).hasClass("fancybox-media")) {
				this.openEffect = 'none';
				this.closeEffect = 'none';
				this.helpers.media = true;
			};
			if($(this.element).data("fancybox_skin") != undefined && $(this.element).data("fancybox_skin") == "fancybox-black") {
				this.fitToView = true;
				this.padding = [10, 10, 10, 10];
				this.helpers.overlay.locked = true;
				this.helpers.title.type = "inside";
				this.helpers.title.position = "top";
				if ($(this.element).data("subtitle") != undefined) {
                    this.title = this.title + '<div class="fancybox-title__sub">' + $(this.element).data("subtitle") + '</div>';
                };
			};
		},
		beforeShow: function() {
			var self = this;
			$(".modal-form-reset", this.content).trigger("onResetForm");
			if($(this.element).data("fancybox_skin") != undefined) {
				$(this.wrap).addClass($(this.element).data("fancybox_skin"));
				$(".fancybox-overlay").addClass($(this.element).data("fancybox_skin"));
			};
			if($(".scroll_block", this.content).length) {
				$(".scroll-content", this.content).scrollTop(0).trigger("updateScroll").trigger("scroll");
				$(".scroll-content", this.content).on("scrollUpdate", function() {
					$.fancybox.update() ;
				});
			};
		},
		afterClose: function() {
			$(this.content).css("display", "");
		},
		afterShow: function() {
			if(this.content != null) {
				$(".slider-block__list", this.content).trigger("updateSlider");
				if($(".zoom_link .image_item", this.content).length) {
					var zoom = $.data($(".zoom_link .image_item", this.content)[0], 'elevateZoom');
					if(zoom != undefined) {
						zoom.refresh();
					};
				};
			};
		}
	});
};
/*-----------------------------collapse-block---------------------------------*/
function initCollapse() {
	var self = $(this),
		selfCont = $(".collapse-block__cont", self),
		minHeight = $(selfCont).css("min-height") != undefined ? parseInt($(selfCont).css("min-height"), 10) : 0,
		duration = selfCont.css("transition-duration") != undefined ? parseFloat(selfCont.css("transition-duration"), 10) : 0,
		transitionEnd = 'transitionend webkitTransitionEnd oTransitionEnd otransitionend update';
		
	if (self.data("collapseInited") != undefined) {
		return;
	};
	self.data("collapseInited", true);
	
	self.addClass("out");console.log(minHeight);
	if (!!minHeight/*selfCont.hasClass("collapse")*/) {
        selfCont.height(Math.max(1, minHeight));
    };
	$(".collapse-block__button", self).bind("click touchstart", function(event) {
		event.preventDefault();
		event.stopPropagation();
		if(Modernizr.csstransitions) {
			selfCont.removeClass("collapse");
			if(selfCont.hasClass("in")) {
				selfCont.height(selfCont[0].scrollHeight);
				setTimeout(function() {
					selfCont.addClass("collapsing").removeClass("in").height(Math.max(1, minHeight));
					self.removeClass("in").addClass("out");
				}, 100);
			} else {
				selfCont.addClass("in").height(Math.max(1, minHeight)).addClass("collapsing").height(selfCont[0].scrollHeight);
				self.removeClass("out").addClass("in");
			};
		} else {
			if(selfCont.hasClass("in")) {
				selfCont.animate({"height": Math.max(1, minHeight)}, 350, "linear", function() {
					selfCont.removeClass("in").trigger("update");
					self.removeClass("in").addClass("out");
				});
			} else {
				selfCont.animate({"height": selfCont[0].scrollHeight}, 350, "linear", function() {
					selfCont.addClass("in").trigger("update");
					self.removeClass("out").addClass("in");
				});
			};
			//selfCont.slideToggle(350, function() {selfCont.trigger("update");});
		};
	});
	$(self).bind("collapse", function(event) {
		if(selfCont.hasClass("in")) {
			if(Modernizr.csstransitions) {
				selfCont.removeClass("collapse");
				selfCont.height(selfCont[0].scrollHeight).addClass("collapsing");
				setTimeout(function() {
					selfCont.removeClass("in").height("1px");
				}, 100);
			} else {
				selfCont.slideUp(350, function() {selfCont.trigger("update");});
			};
		};
	});
	selfCont.bind(transitionEnd, function() {
		selfCont.removeClass("collapsing");
		if (!minHeight) {
            selfCont.addClass("collapse");
        };
		if(selfCont.hasClass("in")) {
			selfCont.height("");
			//self.removeClass("out").addClass("in");
		} else {
			//self.removeClass("in").addClass("out");
		};
	});
};
/*-----------------------------scroll_block-----------------------------------*/
function initCustomScrollbar() {
	if($.fn.scrollbar != undefined) {
		$(this).each(function() {
			var self = $(this).addClass("scroll-conteiner");
			$(".scroll_block, .scroll-block", self).scrollbar({
				disableBodyScroll: isMobile ? false : true,
				showArrows: $(self).data("showarrows") != undefined ? true : false,
				type: "advanced",
				duration: 200,
				ignoreMobile: false,
				scrollStep: $(self).data("scrollstep") != undefined ? parseInt($(self).data("scrollstep"), 10) : 30,
				scrollx: $('.scroll-element.scroll-x', self).length ? $('.scroll-element.scroll-x', self) : null,
				scrolly: $('.scroll-element.scroll-y', self).length ? $('.scroll-element.scroll-y', self) : null,
				onInit: function(c) {
					var selfObj = this;
					$(c).trigger("scrollUpdate");
				},
				onScroll: function(yScroll, xScroll) {
					if(this.scrollx.isVisible) {
						if(xScroll.scroll == 0) {
							self.removeClass("scroll-shadow-left");
						} else {
							self.addClass("scroll-shadow-left");
						};
						if(xScroll.scroll >= xScroll.maxScroll) {
							self.removeClass("scroll-shadow-right");
						} else {
							self.addClass("scroll-shadow-right");
						};
					} else {
						self.removeClass("scroll-shadow-left");
						self.removeClass("scroll-shadow-right");
					};
					if(this.scrolly.isVisible) {
						if(yScroll.scroll == 0) {
							self.removeClass("scroll-shadow-top");
						} else {
							self.addClass("scroll-shadow-top");
						};
						if(yScroll.scroll >= yScroll.maxScroll) {
							self.removeClass("scroll-shadow-bottom");
						} else {
							self.addClass("scroll-shadow-bottom");
						};
					} else {
						self.removeClass("scroll-shadow-top");
						self.removeClass("scroll-shadow-bottom");
					};
				},
				onUpdate: function(yScroll, xScroll) {
					
				}
			});
		});
	} else {
		//console.log("Plagin \"scrollbar\" is not find!");
	};
};
/*----------------------------------------------------------------------------*/