/*
Author       : Syed Ekram.
Template Name: Monalisa - Health & Beauti HTML Template
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
          // Remove links that don't actually link to anything
          .not('[href="#"]')
          .not('[href="#0"]')
          .click(function(event) {
        	// On-page links
        	if (
        	  location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
        	  && 
        	  location.hostname == this.hostname
        	) {
        	  // Figure out element to scroll to
        	  var target = $(this.hash);
        	  target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        	  // Does a scroll target exist?
        	  if (target.length) {
        		// Only prevent default if animation is actually gonna happen
        		event.preventDefault();
        		$('html, body').animate({
        		  scrollTop: target.offset().top
        		}, 1000, function() {
        		  // Callback after animation
        		  // Must change focus!
        		  var $target = $(target);
        		  $target.focus();
        		  if ($target.is(":focus")) { // Checking if the target was focused
        			return false;
        		  } else {
        			$target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
        			$target.focus(); // Set focus again
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
			
		/*START MIXITUP JS*/	
		$("a[class^='prettyPhoto']").prettyPhoto();
		/*END MIXITUP JS*/
												
		/*START TESTIMONIAL JS*/
			$(window).load(function () {
				$('.testi-slider').flexslider({
					animation: "slide",
					direction: "fade",
					prevText: "<i class='fa fa-long-arrow-left'></i>",
					nextText: "<i class='fa fa-long-arrow-right'></i>"
				});
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
		/* END COUNTDOWN JS */

		/*START PARTNER LOGO*/
		$('.partner').owlCarousel({
		  autoPlay: 3000, //Set AutoPlay to 3 seconds
		  items : 4,
		  itemsDesktop : [1199,3],
		  itemsDesktopSmall : [979,3]
		});
		/*END PARTNER LOGO*/
		
		/*START TESTIMONIAL JS*/
		$('.carousel').carousel({
			interval:5000,
			pause:'false',
		});
		/*END TESTIMONIAL JS*/
	


	}); 	
		
	/*START WOW ANIMATION JS*/
	  new WOW().init();	
	/*END WOW ANIMATION JS*/	
				
})(jQuery);


  

