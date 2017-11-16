/*-------------------------------------------------------------------------------------------------------------------------------*/
/*This is main JS file that contains custom style rules used in this template*/
/*-------------------------------------------------------------------------------------------------------------------------------*/
/* Template Name: Site Title*/
/* Version: 1.0 Initial Release*/
/* Build Date: 22-04-2015*/
/* Author: Unbranded*/
/* Website: http://moonart.net.ua/site/
/* Copyright: (C) 2015 */
/*-------------------------------------------------------------------------------------------------------------------------------*/

/*--------------------------------------------------------*/
/* TABLE OF CONTENTS: */
/*--------------------------------------------------------*/
/* 01 - VARIABLES */
/*-------------------------------------------------------------------------------------------------------------------------------*/

;(function($, window, document, undefined) {

	"use strict";

	/*================*/
	/* 01 - VARIABLES */
	/*================*/
	var swipers = [], winW, winH, winScr, _isresponsive, smPoint = 768, mdPoint = 992, lgPoint = 1200, addPoint = 1600, _ismobile = navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i);

	/*========================*/
	/* 02 - page calculations */
	/*========================*/

	$('.simple-article.post-type-link a').each(function(){
		if( $(this).find('img').length ) {
			$(this).addClass('post-linked-a');
		}
	});

	$('.custom-gallery a').on('click', function(){
		openModalPopup($(this));
		return false;
	});

	$('#scroll-link').on('click', function(){
	    var hash = $(this).attr('href');
	    if ( hash != '' ) {
	      	if ( $(hash).length ) {
	        	$( 'body, html' ).stop().animate({'scrollTop' : $(hash).offset().top-200 },1000);
	      	} else {
	        	$( 'body, html' ).stop().animate({'scrollTop' : 0 }, 1000);
	      	}
	      	return false;
	    };
  	});

	$('.main-nav > ul > li.menu-item-has-children > a').append('<span class="fa fa-angle-down"></span>');
	function menuArrows(){
		if( $(window).width() > 991 ) {
			if( ! $('ul.sub-menu > li.menu-item-has-children > a > .fa-angle-right').length ) {
				$('ul.sub-menu > li.menu-item-has-children > a').append('<span class="fa fa-angle-right"></span>');
			}
			if( ! $('.ddm li.menu-item-has-children > a > .fa-angle-right').length ) {
				$('.ddm .fa-angle-down').remove();
				$('.ddm li.menu-item-has-children > a').append('<span class="fa fa-angle-right"></span>');
			}
			if( ! $('#menu-right-menu > .menu-item-has-children > a > .fa-angle-down').length ) {
				$('#menu-right-menu > .menu-item-has-children > a').append('<span class="fa fa-angle-down"></span>');
			}
		} else {
			$('li.menu-item-has-children > a .fa-angle-right').remove();
			if( ! $('#menu-right-menu-1 > .menu-item-has-children > a > .fa-angle-down').length ) {
				$('#menu-right-menu-1 > .menu-item-has-children > a').append('<span class="fa fa-angle-down"></span>');
			}
		}
	}

	function footerInstagramGallery() {
		if( $('#footer_intagram_gallery').length ) {
			var $item = $('#footer_intagram_gallery');

			$.ajax({
				type: "POST",
				url: $item.data('url'),
				data: ({
					action: 'ngrblog_instagram_helper',
					count: $item.data('count'),
					place: 'footer-gallery'
				}),
				success: function(msg) {
					$item.html(msg);
					initSwiper();
				}
			});

		}
		if( $('.widget_intagram_gallery').length ) {
			$('.widget_intagram_gallery').each(function(){
				var $widget = $(this);
				$.ajax({
					type: "POST",
					url: $widget.data('url'),
					data: ({
						action: 'ngrblog_instagram_helper',
						count: $widget.data('count'),
						place: 'widget-gallery'
					}),
					success: function(msg) {
						$widget.html(msg);
					}
				});
			});
		}
	}

	function pageCalculations(){
		winW = $(window).width();
		winH = $(window).height();
		if($('.menu-button').is(':visible')) _isresponsive = true;
		else _isresponsive = false;
		headerSticky();
		if ( $("header").height() > winH ) {
			$("header").addClass("absolute");
		}
		else{$("header").removeClass("absolute")}
	}

	function headerPosition() {
		if( $('body.admin-bar').length ) {
			if ( $(window).width() < 601 ) {
		    	if ( $(window).scrollTop() < 47 ) {
		    		$('header').css({'top':46 - $(window).scrollTop()})
		    		$('#content-wrapper').css({'margin-top':46 - $(window).scrollTop()})
		    	} else {
		    		$('header').css({'top': 0})
		    		$('#content-wrapper').css({'margin-top':0 - $(window).scrollTop()})
		    	}
	    	}
		}
	}


	/*=================================*/
	/* 03 - function on document ready */
	/*=================================*/
	pageCalculations();

	//center all images inside containers
	$('.center-image').each(function(){
		var bgSrc = $(this).attr('src');
		$(this).parent().addClass('background-block').css({'background-image':'url('+bgSrc+')'});
		$(this).hide();
	});

	/*============================*/
	/* 04 - function on page load */
	/*============================*/
	$(window).scroll(function(){
		headerPosition();
	});

	$(window).resize(function(){
		menuArrows();
		headerPosition();
		videoSize();
	});

	$(window).load(function(){
		menuArrows();
		headerPosition();
		videoSize();
		$('#loader-wrapper').fadeOut();
		initSwiper();
		$('.isotope-grid').isotope({
			itemSelector: '.isotope-item',
			percentPosition: true,
			masonry:{gutter:0,columnWidth:'.grid-sizer'}
		});
		setBG();
		footerInstagramGallery();
	});

	function setBG(){
		if( $(".blur-slider").length && winW > 992){
			changeBG();
		}
	}

	function videoSize() {
		if( $('.simple-article iframe[allowfullscreen]' ) ) {
			var $width = $('.simple-article iframe[allowfullscreen]' ).width();
			$('.simple-article iframe[allowfullscreen]' ).css('max-height', $width * 0.55 );
		}
	}

	function changeBG(){
			if( $(".blur-slider").length && winW > 992){
				$(".blur-bg").removeClass("show");
				var index = $(".swiper-slide-active").index();
				$(".blur-bg").eq(index-1).addClass("show");
			}
	}

	/*==============================*/
	/* 05 - function on page resize */
	/*==============================*/
	function resizeCall(){
		pageCalculations();

		$('.swiper-container.initialized[data-slides-per-view="responsive"]').each(function(){
			var thisSwiper = swipers['swiper-'+$(this).attr('id')], $t = $(this), slidesPerViewVar = updateSlidesPerView($t);
			thisSwiper.params.slidesPerView = slidesPerViewVar;
			thisSwiper.reInit();
			var paginationSpan = $t.find('.pagination span');
			var paginationSlice = paginationSpan.hide().slice(0,(paginationSpan.length+1-slidesPerViewVar));
			if(paginationSlice.length<=1 || slidesPerViewVar>=$t.find('.swiper-slide').length) $t.addClass('pagination-hidden');
			else $t.removeClass('pagination-hidden');
			paginationSlice.show();
		});
	}
	if(!_ismobile){
		$(window).resize(function(){
			resizeCall();
			initSwiper();
		});
	} else{
		window.addEventListener("orientationchange", function() {
			resizeCall();
		}, false);
	}

	var footerTop, WindowTop,footerHeight;
	function headerSticky(){
		if( $(".header.style-1 .footer.style-2").length || $(".header.style-1 .footer.style-3").length ){
			if(winW > 992)	{
				footerTop = $(".footer").offset().top;
				WindowTop = $(window).scrollTop()
				footerHeight = $(".footer").height();
				if(WindowTop + winH + 96> footerTop && $("header").height() < winH){
					$("body").addClass("absolute-header");
					$(".absolute-header header").css({"bottom":$(document).height() - footerTop + 96 + "px"});
				}
				else{
					$(".absolute-header").removeClass("absolute-header");
				}
			}
		}
	}


	$(window).on("scroll",function(){
		headerSticky();
	});

	/*=====================*/
	/* 07 - swiper sliders */
	/*=====================*/
	var initIterator = 0;
	function initSwiper(){
		$('.swiper-container:not(.initialized)').each(function(){
			var $t = $(this);

			var index = 'swiper-unique-id-'+initIterator;

			$t.addClass('swiper-'+index + ' initialized').attr('id', index);
			$t.find('.pagination').addClass('pagination-'+index);

			var autoPlayVar = parseInt($t.attr('data-autoplay'),10);
			var centerVar = parseInt($t.attr('data-center'),10);
			var simVar = ($t.closest('.circle-description-slide-box').length)?false:true;

			var slidesPerViewVar = $t.attr('data-slides-per-view');
			if(slidesPerViewVar == 'responsive'){
				slidesPerViewVar = updateSlidesPerView($t);
			}
			else if(slidesPerViewVar != 'auto') slidesPerViewVar = parseInt(slidesPerViewVar,10);

			var loopVar = parseInt($t.attr('data-loop'),10);
			var speedVar = parseInt($t.attr('data-speed'),10);

			var slidesPerGroup = parseInt($t.attr('data-slides-per-group'),10);
			if(!slidesPerGroup){slidesPerGroup=1;}

			swipers['swiper-'+index] = new Swiper('.swiper-'+index,{
				speed: speedVar,
				pagination: '.pagination-'+index,
				loop: loopVar,
				paginationClickable: true,
				autoplay: autoPlayVar,
				slidesPerView: slidesPerViewVar,
				slidesPerGroup: slidesPerGroup,
				keyboardControl: true,
				calculateHeight: true,
				simulateTouch: simVar,
				centeredSlides: centerVar,
				roundLengths: true,
				onInit: function(swiper){
					var browserWidthResize = $(window).width();
					if (browserWidthResize < 750) {
							swiper.params.slidesPerGroup=1;
					} else {
                      swiper.params.slidesPerGroup=slidesPerGroup;
					}
				},
				onResize: function(swiper){
					var browserWidthResize2 = $(window).width();
					if (browserWidthResize2 < 750) {
							swiper.params.slidesPerGroup=1;
					} else {
                      swiper.params.slidesPerGroup=slidesPerGroup;
					  swiper.resizeFix(true);
					}
				},
				onSlideChangeEnd: function(swiper){
					var activeIndex = (loopVar===true)?swiper.activeLoopIndex:swiper.activeIndex;
					var qVal = $t.find('.swiper-slide-active').attr('data-val');
					$t.find('.swiper-slide[data-val="'+qVal+'"]').addClass('active');
				},
				onSlideChangeStart: function(swiper){
					$t.find('.swiper-slide.active').removeClass('active');
					changeBG();
					if($t.hasClass('thumbnails-preview')){
						var activeIndex = (loopVar===1)?swiper.activeLoopIndex:swiper.activeIndex;
						swipers['swiper-'+$t.prev().attr('id')].swipeTo(activeIndex);
						$t.prev().find('.current').removeClass('current');
						$t.prev().find('.swiper-slide[data-val="'+activeIndex+'"]').addClass('current');
					}
				},
				onSlideClick: function(swiper){
					var thisSlide = $(swiper.clickedSlide);
					if(thisSlide.hasClass('open-modal-popup')) openModalPopup(thisSlide);
					if($t.hasClass('thumbnails')) {
						swipers['swiper-'+$t.next().attr('id')].swipeTo(swiper.clickedSlideIndex);
					}
				}
			});
			swipers['swiper-'+index].reInit();
			if($t.attr('data-slides-per-view')=='responsive'){
				var paginationSpan = $t.find('.pagination span');
				var paginationSlice = paginationSpan.hide().slice(0,(paginationSpan.length+1-slidesPerViewVar));
				if(paginationSlice.length<=1 || slidesPerViewVar>=$t.find('.swiper-slide').length) $t.addClass('pagination-hidden');
				else $t.removeClass('pagination-hidden');
				paginationSlice.show();
			}
			initIterator++;
		});

	}

	function updateSlidesPerView(swiperContainer){
		if(winW>=addPoint) return parseInt(swiperContainer.attr('data-add-slides'),10);
		else if(winW>=lgPoint) return parseInt(swiperContainer.attr('data-lg-slides'),10);
		else if(winW>=mdPoint) return parseInt(swiperContainer.attr('data-md-slides'),10);
		else if(winW>=smPoint) return parseInt(swiperContainer.attr('data-sm-slides'),10);
		else return parseInt(swiperContainer.attr('data-xs-slides'),10);
	}

	//swiper arrows
	$('.swiper-arrow-left').on("click",function(){
		swipers['swiper-'+$(this).parent().attr('id')].swipePrev();
	});

	$('.swiper-arrow-right').on("click",function(){
		swipers['swiper-'+$(this).parent().attr('id')].swipeNext();
	});

	/*==============================*/
	/* 08 - buttons, clicks, hovers */
	/*==============================*/
	// top menu
	$(".cmn-toggle-switch").on("click", function(){
		$(this).toggleClass("active");
		$('.nav-container').stop().slideToggle();
		return false;
	});

	$(".small-menu-btn").on("click",function(){
		$(this).toggleClass("active");
		$(".sub-nav").stop().slideToggle();
		return false;
	});

	//modal popup
	$('.footer-slider a').on('click', function(){
		var src = $(this).find("img").attr("src");
		$('.modal-popup img').attr("src",src);
		$('.modal-popup').addClass('active');

		return false;
	});
	/*photo viewer popup*/
	function openModalPopup(foo){
		var src = foo.attr("data-src");
		$('.modal-popup img').attr("src",src);
		$('.modal-popup').addClass('active');
	}

	$(".footer-slider").on("click",function(){
		return false;
	})
	//close modal popup
	$('.modal-popup .close-button, .modal-popup .close-layer').on('click', function(){
		$('.modal-popup.active').removeClass('active');
	});
	/*open popups buttons*/
	$("header .h-search").on("click",function(){
		$(".search-popup").addClass("opened");
		$(".popup-bg").addClass("opened");
	});
	$(".video-play").on("click",function(){
		var src = $(this).attr("data-src");
		$(".video-popup iframe").attr("src",src);
		setTimeout(function(){ $(".video-popup").addClass("opened");}
		, 700);
		$(".popup-bg").addClass("opened");
		return false;
	});
	/*close popups buttons*/
	$(".popup .close").on("click",function(){
		$(".popup").removeClass("opened");
	});
	$(".header.style-4 .small-menu-btn").on("click",function(){
		$(".main-nav").stop().slideToggle();
	});
	$(".popup-bg").on("click",function(){
		$(".popup").removeClass("opened");
	}) ;

	$('nav > ul > li > a').on('click', 'span', function(){
	    if ( $(this).parent().parent().find('.sub-menu').hasClass('slide') ) {
		    $(this).parent().parent().find('.sub-menu').removeClass('slide');
		} else {
			$('.sub-menu').removeClass('slide');
			$(this).parent().parent().find('.sub-menu').addClass('slide');
		}
		return false
	});

	$('.subscribe-form').submit(function() {
		var $this = $(this);
		var url = $this.data('url');
		var email = $this.find('input[name="email"]').val();
		var code_nonce = $this.find('input[name="code_nonce"]').val();
		var submit = $this.find('input[type="submit"]').val();

		$this.find('input[type="submit"]').val('Loading...');

		$.ajax({
			type: "POST",
			url: url,
			data: ({
				action: 'nrgblog_subscribe_user',
				email: email,
				code_nonce: code_nonce
			}),
			success: function(msg) {
				$this.find('.msg').html(msg);
				$this.find('input[type="submit"]').val( submit );
			}
		});
		return false;
	});

	$('.like-it').on('click', function() {
		var $this = $(this);
		var id = $this.data('post');
		var url = $this.data('url');
		$.ajax({
			type: "POST",
			url: url,
			data: ({
				action: 'nrgblog_post_like',
				id: id
			}),
			success: function(msg) {
				$this.html( msg );
			}
		});

		return false;
	});

	// Custom JS

	$("#portfolio-switch").on("click", function(){
		$("#envira-gallery-wrap-816").toggle('slow');
		$("#envira-gallery-wrap-795").toggle('slow');
		if ($("#portfolio-switch").value === "Color Photos") {
			$("#portfolio-switch").value = "Black and White photos"
		} else {
			$("#portfolio-switch").value = "Color Photos"
		}
	});

})(jQuery, window, document);
