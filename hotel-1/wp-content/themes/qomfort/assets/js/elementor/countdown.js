(function($){
	"use strict";
	
	$(window).on('elementor/frontend/init', function () {
		
        elementorFrontend.hooks.addAction('frontend/element_ready/qomfort_elementor_countdown.default', function(){
	       
	        /* Add your code here */
	    	$(".ova-countdown").appear(function(){
				var count    = $(this).attr('data-count');
				var odometer = $(this).closest('.ova-countdown').find('.odometer');

		        setTimeout(function(){
				    odometer.html(count);
				}, 500);
				
		    });
        });
        
   });

})(jQuery);
