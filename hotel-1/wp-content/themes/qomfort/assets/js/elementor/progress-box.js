(function($){
	"use strict";
	
	$(window).on('elementor/frontend/init', function () {
		
        elementorFrontend.hooks.addAction('frontend/element_ready/qomfort_elementor_progress_box.default', function(){
	       
	        /* Add your code here */
	    	$('.ova-percent').appear(function(){
   				var that 		= $(this);
   				var percent 	= that.data('percent');
   				var percentage 	= that.closest('.ova-percent-view').find('.percentage')

   				that.animate({
			        width: percent + "%"
			        },1000, function() {
			        	var show_percent = percentage.data('show-percent');
			        	if ( show_percent == 'yes' ) {
			        		percentage.show();
			        		percentage.css('left', (percent - 5) + '%');
			        	}
			        }
		        );
   			});
        });
        
   });

})(jQuery);
