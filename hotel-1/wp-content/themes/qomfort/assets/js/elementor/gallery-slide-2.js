(function($){
	"use strict";
	
	$(window).on('elementor/frontend/init', function () {
		
        elementorFrontend.hooks.addAction('frontend/element_ready/qomfort_elementor_gallery_slide_2.default', function(){
	       
	        /* Add your code here */
	    	$(".ova-gallery-slide-2 .gallery-slide").each(function(){
                
                var owlsl       = $(this) ;
                var owlsl_ops   = owlsl.data('options') ? owlsl.data('options') : {};

                if ( $('body').hasClass('rtl') ) {
                    owlsl_ops.rtl = true;
                }

                var responsive_value = {
                    0:{
                        items:1,
                        nav:false,
                    },
                    767:{
                        items:2,
                    },
                    1024:{
                        items:owlsl_ops.items - 1,
                    },
                    1400:{
                        items:owlsl_ops.items,
                    }
                };
                
                owlsl.owlCarousel({
                    autoWidth: owlsl_ops.autoWidth,
                    margin: owlsl_ops.margin,
                    items: owlsl_ops.items,
                    loop: owlsl_ops.loop,
                    autoplay: owlsl_ops.autoplay,
                    autoplayTimeout: owlsl_ops.autoplayTimeout,
                    center: owlsl_ops.center,
                    nav: owlsl_ops.nav,
                    dots: owlsl_ops.dots,
                    thumbs: owlsl_ops.thumbs,
                    autoplayHoverPause: owlsl_ops.autoplayHoverPause,
                    slideBy: owlsl_ops.slideBy,
                    smartSpeed: owlsl_ops.smartSpeed,
                    rtl: owlsl_ops.rtl,
                    navText:[
                    '<i class="ovaicon ovaicon-back" ></i>',
                    '<i class="ovaicon ovaicon-next" ></i>'
                    ],
                    responsive: responsive_value,
                });

                // Popup Gallery
                if( $('.gallery-slide') && typeof Fancybox != 'undefined' ){
                    Fancybox.bind('[data-fancybox="gallery-slide-2"]', {
                        Image: {
                            zoom: false,
                        },
                    });
                }

            });
        });
        
   });

})(jQuery);
