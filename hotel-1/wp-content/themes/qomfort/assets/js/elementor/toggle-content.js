(function($){
	"use strict";
	
	$(window).on('elementor/frontend/init', function () {
		
        elementorFrontend.hooks.addAction('frontend/element_ready/qomfort_elementor_toggle_content.default', function(){
	       
	        /* Add your code here */
	        var ova_aria_expanded = function(){
	        	if ($(".ova-toggle-content").hasClass("toggled")) {
	            	$(".ova-toggle-content .button-toggle").attr("aria-expanded","true");
	            } else {
	            	$(".ova-toggle-content .button-toggle").attr("aria-expanded","false");
	            }
	        }
	    	$('.ova-toggle-content .button-toggle').each(function(){
		        $(this).off().on('click', function() {
		            $(this).closest( '.ova-toggle-content' ).toggleClass('toggled');
		            ova_aria_expanded();
		        });
		    });
	        
	       	if( $('.ova-toggle-content .site-overlay').length > 0 ){
	        	$('.ova-toggle-content .site-overlay').off().on('click', function () {
		        	$(this).closest( '.ova-toggle-content' ).toggleClass('toggled');
		        	ova_aria_expanded();
		        });
	        }

	        if( $('.ova-toggle-content .close-menu').length > 0 ){
	        	$('.ova-toggle-content .close-menu').off().on('click', function () {
		        	$(this).closest( '.ova-toggle-content' ).toggleClass('toggled');
		        	ova_aria_expanded();
		        });
	        }
        });
        
   });

})(jQuery);
