/*
Author       : VAOne Agency
Template Name: Soul Suite Wellness - Health & Beauty HTML Template
Version      : 1.0
*/

(function($) {
	'use strict';
	
	/*PRELOADER JS*/
	$(window).load(function() { 
		$('.status').fadeOut();
		$('.preloader').delay(350).fadeOut('slow'); 
	}); 
	/*END PRELOADER JS*/
		
	jQuery(document).ready(function(){
	
		// Select all links with hashes
        $('#navigation a[href*="#"]')
          .not('[href="#"]')
          .not('[href="#0"]')
          .click(function(event) {
        	if (
        	  location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
        	  && 
        	  location.hostname == this.hostname
        	) {
        	  var target = $(this.hash);
        	  target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        	  if (target.length) {
        		event.preventDefault();
        		$('html, body').animate({
        		  scrollTop: target.offset().top
        		}, 1000, function() {
        		  var $target = $(target);
        		  $target.focus();
        		  if ($target.is(":focus")) {
        			return false;
        		  } else {
        			$target.attr('tabindex','-1');
        			$target.focus();
        		  };
        		});
        	  }
        	}
          });

		$(window).scroll(function() {
		  if ($(this).scrollTop() > 100) {
			$('.menu-top').addClass('menu-shrink');
		  } else {
			$('.menu-top').removeClass('menu-shrink');
		  }
		});
		
		$(document).on('click','.navbar-collapse.in',function(e) {
		if( $(e.target).is('a') && $(e.target).attr('class') != 'dropdown-toggle' ) {
			$(this).collapse('hide');
		}
		});				
	/*END MENU JS*/ 
		
	/*START PRETTYPHOTO - COMMENTED OUT - LIBRARY NOT LOADED*/	
	// $("a[class^='prettyPhoto']").prettyPhoto();
	/*END PRETTYPHOTO*/
											
	/*START TESTIMONIAL JS*/
		$(window).load(function () {
			if ($('.testi-slider').length) {
				$('.testi-slider').flexslider({
					animation: "slide",
					direction: "fade",
					prevText: "<i class='fa fa-long-arrow-left'></i>",
					nextText: "<i class='fa fa-long-arrow-right'></i>"
				});
			}
		});
	/*END TESTIMONIAL JS*/
	
	/*START VIDEO JS*/
	 function autoPlayYouTubeModal() {
		var trigger = $("body").find('[data-toggle="modal"]');
		trigger.on("click",function() {
		  var theModal = $(this).data("target"),
			videoSRC = $('#video-modal iframe').attr('src'),
			videoSRCauto = videoSRC + "?autoplay=1";
		  $(theModal + ' iframe').attr('src', videoSRCauto);
		  $(theModal + ' button.close').on("click",function() {
			$(theModal + ' iframe').attr('src', videoSRC);
		  });
		  $('.modal').on("click",function() {
			$(theModal + ' iframe').attr('src', videoSRC);
		  });
		});
	  }
	  autoPlayYouTubeModal();
	/*END VIDEO JS*/
	
	/* COUNTDOWN JS */
	if ($('#counter_item').length) {
		$('#counter_item').bind('inview', function(event, visible, visiblePartX, visiblePartY) {
			if (visible) {
				$(this).find('.time_counter').each(function () {
					var $this = $(this);
					$({ Counter: 0 }).animate({ Counter: $this.text() }, {
						duration: 2000,
						easing: 'swing',
						step: function () {
							$this.text(Math.ceil(this.Counter));
						}
					});
				});
				$(this).unbind('inview');
			}
		});
	}
	/* END COUNTDOWN JS */

	/*START PARTNER LOGO*/
	if ($('.partner').length) {
		$('.partner').owlCarousel({
		  autoPlay: 3000,
		  items : 4,
		  itemsDesktop : [1199,3],
		  itemsDesktopSmall : [979,3]
		});
	}
	/*END PARTNER LOGO*/
	
	/*START TESTIMONIAL JS*/
	if ($('.carousel').length) {
		$('.carousel').carousel({
			interval:5000,
			pause:'false',
		});
	}
	/*END TESTIMONIAL JS*/

	// Mobile Menu Toggle
	$('.menu-toggle').on('click', function() {
		$(this).toggleClass('active');
		$('.main-navigation').toggleClass('toggled');
		$('body').toggleClass('menu-open');
		
		var expanded = $(this).attr('aria-expanded') === 'true' || false;
		$(this).attr('aria-expanded', !expanded);
	});
	
	// Mobile Submenu Toggle
	$('.main-navigation .menu-item-has-children > a').on('click', function(e) {
		if ($(window).width() <= 991) {
			e.preventDefault();
			$(this).parent().toggleClass('submenu-open');
			$(this).next('.sub-menu').slideToggle(300);
		}
	});
	
	// Close menu when clicking outside
	$(document).on('click', function(e) {
		if (!$(e.target).closest('.main-navigation, .menu-toggle').length) {
			$('.main-navigation').removeClass('toggled');
			$('.menu-toggle').removeClass('active').attr('aria-expanded', 'false');
			$('body').removeClass('menu-open');
		}
	});
	
	// Close menu on Escape key
	$(document).on('keydown', function(e) {
		if (e.key === 'Escape' && $('.main-navigation').hasClass('toggled')) {
			$('.main-navigation').removeClass('toggled');
			$('.menu-toggle').removeClass('active').attr('aria-expanded', 'false');
			$('body').removeClass('menu-open');
		}
	});

	}); 	
		
	/*START WOW ANIMATION JS*/
	if (typeof WOW !== 'undefined') {
		new WOW().init();	
	}
	/*END WOW ANIMATION JS*/	
			
})(jQuery);