jQuery('document').ready(function($){

	"use strict";
	var currentWidth = window.innerWidth || document.documentElement.clientWidth;
	var isMobile = (navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i)) || (navigator.userAgent.match(/Android/i)) || (navigator.userAgent.match(/Blackberry/i)) || (navigator.userAgent.match(/Windows Phone/i) || navigator.platform.match(/(Mac|iPhone|iPod|iPad)/i) ) ? true : false;

	$("select").each(function(){
		if($(this).css('display') != 'none') {
			$(this).wrap( '<div class="selection-box"></div>' );
		}
	});

	// Nice Scroll
	if (Boolean( kriya_urls.nicescroll) &&
        	$(window).width() > 767 &&
        	! navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/) && ! navigator.platform.match(/(Mac|iPhone|iPod|iPad)/i) ) {
            $("html").niceScroll({
                zindex: 999999,
                cursorborder: "1px solid #424242"
            });
        }

	// Loader
	if( Boolean( kriya_urls.loader)  ) {
		Pace.on("done", function(){
			$(".loader").fadeOut(500);
			$(".pace").remove();
		});
	}

	// Sticky Navigation
	if( Boolean( kriya_urls.stickynav) ) {
		$("#main-header-wrapper").sticky({ topSpacing: 0 });
	}

	// Menu
	megaMenu();
	if( $("ul.onepage").length ) {
		$("ul.onepage").visualNav({
			selectedClass     : 'current_page_item',
			externalLinks     : 'external',
			offsetTop		  : 101,
			useHash           : false
		});
	}

	if( currentWidth > 767 ) {
		menuHover();
	}


	if( currentWidth > 767 ) {
		if( $('#primary').hasClass('with-left-sidebar') ) {
			if( $('#secondary-left').is(':empty') ){
				$('#primary').addClass("content-full-width").removeClass("page-with-sidebar with-left-sidebar");
			}
		} else if( $('#primary').hasClass('with-right-sidebar') ) {
			if( $('#secondary-right').is(':empty') ){
				$('#primary').addClass("content-full-width").removeClass("page-with-sidebar with-right-sidebar");
			}
		}
	}

	// Mobile Menu
	$("#dt-menu-toggle").on('click',function( event ){
		event.preventDefault();

		var $menu = $("nav#main-menu").find("ul.menu:first");
		$menu.slideToggle(function(){
			$menu.css('overflow' , 'visible');
			$menu.toggleClass('menu-toggle-open');
		});

		var $right = $("nav#main-menu").find("ul.menu-right");
		if( $right.length ) {
			$right.slideToggle(function(){
				$right.css('overflow' , 'visible');
				$right.toggleClass('menu-toggle-open');
			});
		}
	});

	$(".dt-menu-expand").on('click',function(){
		if( $(this).hasClass("dt-mean-clicked") ){
			$(this).text("+");
			if( $(this).prev('ul').length ) {
				$(this).prev('ul').slideUp(300);
			} else {
				$(this).prev('.megamenu-child-container').find('ul:first').slideUp(300);
			}
		} else {
			$(this).text("-");
			if( $(this).prev('ul').length ) {
				$(this).prev('ul').slideDown(300);
			} else{
				$(this).prev('.megamenu-child-container').find('ul:first').slideDown(300);
			}
		}

		$(this).toggleClass("dt-mean-clicked");
		return false;
	});

	$("div.dt-video-wrap").fitVids();

	//Gallery Post Slider
	if( ($("ul.entry-gallery-post-slider").length) && ( $("ul.entry-gallery-post-slider li").length > 1 ) ) {
		$("ul.entry-gallery-post-slider").bxSlider({
			auto:false,
			video:true,
			useCSS:false,
			pager:'',
			autoHover:true,
			adaptiveHeight:true
		});
	}

	// Portfolio like this
	$(".dt-portfolio-like").on('click',function(e){
		var el = $(this);

		if( el.hasClass('liked') ) return false;

		var post = {
			action: 'kriya_like_love',
			post_id: el.attr('data-id')
		};

		$.post(kriya_urls.ajaxurl, post, function(data){
			el.find('.label').html(data);
			el.addClass('liked');
		});

		e.preventDefault();
	});

	// Portfolio Sorting
	if($("div.dt-sc-portfolio-sorting").length) {

		var $container = $('.dt-sc-portfolio-container');

		$("div.dt-sc-portfolio-sorting a").on('click',function(e){

			$("div.dt-sc-portfolio-sorting a").removeClass("active-sort");
			$(this).addClass("active-sort");

			var $selector = $(this).attr('data-filter'),
				$width = $container.hasClass("no-space") ? 0 : parseInt( $container.attr("data-gutter") );

			$container.isotope({
				filter: $selector,
				masonry: { gutter: 0 },
				animationOptions: { duration: 750, easing: 'linear', queue: false  }
			});

			e.preventDefault();
		});
	}

	//Portfolio single
	if( $(".dt-portfolio-single-slider").find("li").length > 1 ) {
		$(".dt-portfolio-single-slider").bxSlider({ auto:false, video:true, useCSS:false, pagerCustom: '#bx-pager', autoHover:true, adaptiveHeight:true, controls:false });
	}


	//Therapist single
	if( $(".dt-therapist-single-slider").find("li").length > 1 ) {
		$(".dt-therapist-single-slider").bxSlider({ auto:false, video:true, useCSS:false, pagerCustom: '#bx-pager', autoHover:true, adaptiveHeight:true, controls:false });
	}

	// Coming Soon
	$('.downcount').each(function(){
		var el = $(this);
		console.log(el);
		el.downCount({
			date	: el.attr('data-date'),
			offset	: el.attr('data-offset')
		});
	});

	$(window).on('load', function(){

		// Portfolio isotope
		var $container = $(".dt-sc-portfolio-container");
		if( $container.length) {

			var $width = $container.hasClass("no-space") ? 0 : parseInt( $container.attr("data-gutter") );
			$container.isotope({
				filter: '*',
				itemSelector : '.column',
				masonry: { gutter: 0,  columnWidth: $container.find('.column').width() },
				animationOptions: { duration: 750, easing: 'linear', queue: false  }
			});
		}

		// Blog isotope
		if( $(".apply-isotope").length ) {
			$(".apply-isotope").isotope({
				itemSelector : '.column',
				transformsEnabled:false,
				masonry: { gutter: 20}
			});
		}
	});

	$(window).smartresize(function(){

		// Mega Menu
		megaMenu();

		// Portfolio isotope
		var $container = $(".dt-sc-portfolio-container");
		if( $container.length) {

			var $width = $container.hasClass("no-space") ? 0 : parseInt( $container.attr("data-gutter") );
			$container.isotope({
				filter: '*',
				itemSelector : '.column',
				masonry: { gutter: 0,  columnWidth: $container.find('.column').width() },
				animationOptions: { duration: 750, easing: 'linear', queue: false  }
			});
		}

		// Blog isotope
		if( $(".apply-isotope").length ) {
			$(".apply-isotope").isotope({
				itemSelector : '.column',
				transformsEnabled:false,
				masonry: { gutter: 20}
			});
		}
	});

	// Mega menu
	function megaMenu(){
		var screenWidth = $(document).width(),
		containerWidth = $("#header .container").width(),
		containerMinuScreen = (screenWidth - containerWidth)/2;
		if( containerWidth == screenWidth ){

			$("li.menu-item-megamenu-parent .megamenu-child-container").each(function(){

				var ParentLeftPosition = $(this).parent("li.menu-item-megamenu-parent").offset().left,
				MegaMenuChildContainerWidth = $(this).width();

				if( (ParentLeftPosition + MegaMenuChildContainerWidth) > screenWidth ){
					var SwMinuOffset = screenWidth - ParentLeftPosition;
					var marginFromLeft = MegaMenuChildContainerWidth - SwMinuOffset;
					var marginFromLeftActual = (marginFromLeft) + 25;
					var marginLeftFromScreen = "-"+marginFromLeftActual+"px";
					$(this).css('left',marginLeftFromScreen);
				}

			});
		} else {

			$("li.menu-item-megamenu-parent .megamenu-child-container").each(function(){
				var ParentLeftPosition = $(this).parent("li.menu-item-megamenu-parent").offset().left,
				MegaMenuChildContainerWidth = $(this).width();

				if( (ParentLeftPosition + MegaMenuChildContainerWidth) > containerWidth ){
					var marginFromLeft = ( ParentLeftPosition + MegaMenuChildContainerWidth ) - screenWidth;
					var marginLeftFromContainer = containerMinuScreen + marginFromLeft + 20;

					if( MegaMenuChildContainerWidth > containerWidth ){
						var MegaMinuContainer	= ( (MegaMenuChildContainerWidth - containerWidth)/2 ) + 10;
						var marginLeftFromContainerVal = marginLeftFromContainer - MegaMinuContainer;
						marginLeftFromContainerVal = "-"+marginLeftFromContainerVal+"px";
						$(this).css('left',marginLeftFromContainerVal);
					} else {
						marginLeftFromContainer = "-"+marginLeftFromContainer+"px";
						$(this).css('left',marginLeftFromContainer);
					}
				}

			});
		}
	}

	// Menu Hover
	function menuHover(){
		$("li.menu-item-depth-0,li.menu-item-simple-parent ul li" ).mouseenter(function(e) {
			//mouseenter
			if( $(this).find(".megamenu-child-container").length  ){
				$(this).find(".megamenu-child-container").stop().fadeIn('fast');
			} else {
				$(this).find("> ul.sub-menu").stop().fadeIn('fast');
			}
			e.preventDefault();
		}).mouseleave(function(e) {
			//mouseleave
			if( $(this).find(".megamenu-child-container").length ){
				$(this).find(".megamenu-child-container").stop(true, true).hide();
			} else {
				$(this).find('> ul.sub-menu').stop(true, true).hide();
			}
			e.preventDefault();
		});
	}

	// Gutenberg - Fullwidth Section Fix
	$('.alignfull').each(function() {
		if($(this).parents('body').hasClass('has-gutenberg-blocks') && $(this).parents('#primary').hasClass('content-full-width')) {
			if($(this).parents('body').hasClass('layout-boxed')) {
				var containerWidth = $('.layout-boxed .wrapper').width();
				$(this).css('width', containerWidth);

				var mainLeft = $('#main').offset().left;
				var primaryLeft = $('#primary').offset().left;

				var sectionMargin = parseInt(primaryLeft, 10) - parseInt(mainLeft, 10);

				var offset = 0 - sectionMargin;
				$(this).css('left', offset);
			} else {

				var windowWidth = $(window).width();
				$(this).css('width', windowWidth);

				var $container = '';

				$container = $(this).parents('.entry-body');
				if(!$container.length) {
					$container = $(this).parents('.content-full-width');
				}

				var offset = 0 - $container.offset().left;
				$(this).css('left', offset);
			}
		}
	});

	// Gutenberg - WP Category Widget Fix
	if($('.wp-block-categories-list').length) {

		$('.wp-block-categories-list').find('li').each(function() {

			var span_text = $(this).find('span:first').html();
			$(this).find('span:first').remove()
			$('<span>'+span_text+'</span>').insertAfter($(this).find('a:first'));

		});

	}

});