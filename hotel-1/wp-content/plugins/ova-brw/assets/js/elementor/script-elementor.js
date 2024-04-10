(function($){
	"use strict";
	

	$(window).on('elementor/frontend/init', function () {

		elementorFrontend.hooks.addAction('frontend/element_ready/ovabrw_product_images.default', function(){
			$(".ova-product-img").each(function(){
		        Fancybox.bind('[data-fancybox="ova_product_img_group"]', {
				   	Image: {
				    	zoom: false,
				  	},
				});
		    });
		});

		elementorFrontend.hooks.addAction('frontend/element_ready/ovabrw_room_slider.default', function(){
			$(".ovabrw-room-slider .room-slider").each(function(){
		        var owlsl 		= $(this) ;
		        var owlsl_ops 	= owlsl.data('options') ? owlsl.data('options') : {};
		        var template 	= $(this).data('template');

		        if ( $('body').hasClass('rtl') ) {
                   	owlsl_ops.rtl = true;
                }

		        var responsive_value = {
		            0:{
		              	items:1,
		              	nav:false
		            },
		            768:{
		              	items:2
		            },
		            1024:{
		             	items: owlsl_ops.items - 1
		            },
		            1260:{
		              	items: owlsl_ops.items
		            }
		        };

		        switch( template ) {
		        case 'template_2':
				    responsive_value = {
			            0:{
			              	items:1,
			              	nav:false
			            },
			            768:{
			              	items:2
			            },
			            1260:{
			              	items:owlsl_ops.items
			            }
			        };
		        	break;
		        case 'template_3':
				    responsive_value = {
			            0:{
			              	items:1,
			              	nav:false
			            },
			            1260:{
			              	items:owlsl_ops.items
			            }
			        };
		        	break;
		        default:
		        }
		        
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
					'<i class="fa fa-angle-left" ></i>',
					'<i class="fa fa-angle-right" ></i>'
					],
					responsive: responsive_value,
		        });

		      	/* Fixed WCAG */
				owlsl.find(".owl-nav button.owl-prev").attr("title", "Previous");
				owlsl.find(".owl-nav button.owl-next").attr("title", "Next");
				owlsl.find(".owl-dots button").attr("title", "Dots");
		    });
		});

		elementorFrontend.hooks.addAction('frontend/element_ready/ovabrw_search_ajax.default', function(){
			$(".ovabrw-search-ajax").each(function(){
				// Sort by filer dropdown
				function sort_by_filter_dropdown(){

					var sort_by  		      = $('.ovabrw-room-filter .input_select_input');
					var sort_by_value  	 	  = $('.ovabrw-room-filter .input_select_input_value');
					var term_item 		      = $('.ovabrw-room-filter .input_select_list .term_item');
					var sort_by_text_default  = $('.ovabrw-room-filter .input_select_list .term_item_selected').data('value');
					var sort_by_value_default = $('.ovabrw-room-filter .input_select_list .term_item_selected').data('id');	
	                
	                sort_by.attr('value',sort_by_text_default);
					sort_by_value.attr('value',sort_by_value_default);

					sort_by.on('click', function () {
			        	$(this).closest('.filter-sort').find('.input_select_list').toggle();
			        	$(this).toggleClass( 'active' );
			        });

			        $('.ovabrw-room-filter .asc_desc_sort').on('click', function () {
			        	$(this).closest('.ovabrw-room-filter').find('.input_select_list').toggle();
			        	$(this).closest('.ovabrw-room-filter').find('.input_select_input').toggleClass( 'active' );
			        });

			        term_item.on('click', function () {
			        	$(this).closest('.ovabrw-room-filter').find('.input_select_list').hide();

			        	// change term item selected
			        	var item_active   = $('.ovabrw-room-filter .input_select_list .term_item_selected').data('id');
			            var item          = $(this).data('id');
			            if ( item != item_active ) {
			                term_item.removeClass('term_item_selected');
			                $(this).addClass('term_item_selected');
			            }

			            // get value, id sort by
			            var sort_value = $(this).data('id');
			            var sort_label = $(this).data('value');

		                // change input select text
			        	sort_by.val(sort_label);
			        	// change input value
			        	sort_by_value.val(sort_value);
			        });
			    } 

			    sort_by_filter_dropdown(); 
				window.Brw_Frontend.ova_search_ajax(); 
		    });
		});

		/* Booking tabs */
		elementorFrontend.hooks.addAction('frontend/element_ready/ovabrw_product_booking_form.default', function(){
			
			$('.ovabrw-forms-booking-tab').each( function() {
				var that = $(this);

				var item    = that.find('.tabs .item');
		        var booking = that.find('.ovabrw-booking');

				item.on( 'click', function() {
					if ( ! $(this).hasClass('active') ) {
						item.removeClass('active');
						$(this).addClass('active');
				        booking.hide();
				        var form = $(this).data('form');
				        that.find('.'+$(this).data('form')).show();
					}
				});
			});

		});

		// Calendar
		elementorFrontend.hooks.addAction('frontend/element_ready/ovabrw_product_calendar.default', function(){
			$(".elementor-calendar .ovabrw__product_calendar").each(function(){
			   	var date_format = '';

		        if ( typeof brw_date_format !== 'undefined' ) {
		            date_format = brw_date_format;
		        }
		        
		        $('.wrap_calendar').each( function(e) {
		            var srcCalendarEl   = $(this).find('.ovabrw__product_calendar')[0];
		            if ( srcCalendarEl === null ) return;

		            var nav             = srcCalendarEl.getAttribute('data-nav');
		            var default_view    = srcCalendarEl.getAttribute('data-default_view');
		            var first_day       = srcCalendarEl.getAttribute('data-first-day');

		            if ( ! first_day ) {
		                first_day = 0;
		            }

		            if ( default_view == 'month' ) {
		                default_view = 'dayGridMonth';
		            }
		            
		            var cal_lang            = srcCalendarEl.getAttribute( 'data-lang' ).replace(/\s/g, '');
		            var define_day          = srcCalendarEl.getAttribute('data-define_day');
		            var data_event_number   = parseInt( srcCalendarEl.getAttribute('data_event_number') );
		            var default_hour_start  = srcCalendarEl.getAttribute( 'default_hour_start' );
		            var time_to_book_start  = srcCalendarEl.getAttribute('time_to_book_start');
		            time_to_book_start      =  window.Brw_Frontend.ova_get_time_to_book_start(time_to_book_start);
		            var price_calendar      = srcCalendarEl.getAttribute('price_calendar');
		            price_calendar          = price_calendar.replace(/[\u0000-\u001F]+/g,""); 
		            var price_full_calendar_value = JSON.parse( price_calendar );
		            var special_time        = srcCalendarEl.getAttribute('data-special-time');
		            var special_time_value  = JSON.parse( special_time );
		            var background_day      = srcCalendarEl.getAttribute('data-background-day');
		            var disable_week_day    = srcCalendarEl.getAttribute('data-disable_week_day');
		            var disable_week_day_value = '';

		            if ( disable_week_day ) {
		                disable_week_day_value = JSON.parse( disable_week_day );
		            }

		            var events          = '';
		            var date_rent_full  = [];
		            var order_time      = srcCalendarEl.getAttribute('order_time');

		            if ( order_time && order_time.length > 0 ) {
		                events = JSON.parse( order_time );
		            }

		            if ( typeof events !== 'undefined' && events.length > 0 ) {
		                events.forEach(function(item, index) {
		                    if ( item.hasOwnProperty('rendering') ) {
		                        date_rent_full.push( item.start );
		                    }
		                });
		            }
		            
		            var srcCalendar = new FullCalendar.Calendar(srcCalendarEl, {
		                editable: false,
		                events: events,
		                firstDay: first_day,
		                height: 'auto',
		                headerToolbar: {
		                    left: 'prev,next,today,' + nav,
		                    right: 'title',
		                },
		                initialView: default_view,
		                locale: cal_lang,
		                dayMaxEventRows: true, // for all non-TimeGrid views
		                views: {
		                    dayGrid: {
		                        dayMaxEventRows: data_event_number
		                        // options apply to dayGridMonth, dayGridWeek, and dayGridDay views
		                    },
		                    timeGrid: {
		                        dayMaxEventRows: data_event_number
		                        // options apply to timeGridWeek and timeGridDay views
		                    },
		                    week: {
		                        dayMaxEventRows: data_event_number
		                        // options apply to dayGridWeek and timeGridWeek views
		                    },
		                    day: {
		                        dayMaxEventRows: data_event_number
		                        // options apply to dayGridDay and timeGridDay views
		                    }
		                },
		                dayCellDidMount: function(e) {
		                    var new_date    = new Date( e.date );
		                    var time_stamp  = Date.UTC( new_date.getFullYear(), new_date.getMonth(), new_date.getDate() )/1000;
		                    
		                    if ( price_full_calendar_value != '' ) {
		                        var type_price = price_full_calendar_value[0].type_price;

		                        if ( type_price == 'day' ) {
		                            var ovabrw_daily_monday     = price_full_calendar_value[1].ovabrw_daily_monday;
		                            var ovabrw_daily_tuesday    = price_full_calendar_value[1].ovabrw_daily_tuesday;
		                            var ovabrw_daily_wednesday  = price_full_calendar_value[1].ovabrw_daily_wednesday;
		                            var ovabrw_daily_thursday   = price_full_calendar_value[1].ovabrw_daily_thursday;
		                            var ovabrw_daily_friday     = price_full_calendar_value[1].ovabrw_daily_friday;
		                            var ovabrw_daily_saturday   = price_full_calendar_value[1].ovabrw_daily_saturday;
		                            var ovabrw_daily_sunday     = price_full_calendar_value[1].ovabrw_daily_sunday;

		                            switch ( new_date.getDay() ) {
		                                case 0: {
		                                    // check disable week day in settings
		                                    if ( disable_week_day_value ) {
		                                        $.each( disable_week_day_value, function( key, day_value ) {
		                                            if( day_value == new_date.getDay() ) {
		                                                e.el.children[0].className = e.el.children[0].className + ' unavailable_date';
		                                                // set background day
		                                                $('.unavailable_date').css('background-color', background_day);
		                                            }
		                                        });
		                                    }
		                                    
		                                    let el = e.el.querySelectorAll(".fc-daygrid-day-bg")[0];

		                                    if ( el ){
		                                        if ( special_time_value ) {
		                                            el.innerHTML = ovabrw_daily_sunday;
		                                            $.each( special_time_value, function( price, special_timestamp ) {
		                                                if ( time_stamp >= special_timestamp[0] && time_stamp <= special_timestamp[1] ) {
		                                                    el.innerHTML = price;
		                                                }
		                                            });
		                                        } else {
		                                            el.innerHTML = ovabrw_daily_sunday;
		                                        }
		                                        
		                                        return e;    
		                                    }
		                                    
		                                    break;
		                                }
		                                case 1: {
		                                    // check disable week day in settings
		                                    if ( disable_week_day_value ) {
		                                        $.each( disable_week_day_value, function( key, day_value ) {
		                                            if( day_value == new_date.getDay() ) {
		                                                e.el.children[0].className = e.el.children[0].className + ' unavailable_date';
		                                                // set background day
		                                                $('.unavailable_date').css('background-color', background_day);
		                                            }
		                                        });
		                                    }

		                                    let el = e.el.querySelectorAll(".fc-daygrid-day-bg")[0];

		                                    if ( el ) {
		                                        if ( special_time_value ) {
		                                            el.innerHTML = ovabrw_daily_monday;
		                                            $.each( special_time_value, function( price, special_timestamp ) {
		                                                if ( time_stamp >= special_timestamp[0] && time_stamp <= special_timestamp[1] ) {
		                                                    el.innerHTML = price;
		                                                }
		                                            });
		                                        } else {
		                                            el.innerHTML = ovabrw_daily_monday;
		                                        }

		                                        return e;
		                                    }
		                                    
		                                    break;
		                                }
		                                case 2: {
		                                    // check disable week day in settings
		                                    if ( disable_week_day_value ) {
		                                        $.each( disable_week_day_value, function( key, day_value ) {
		                                            if( day_value == new_date.getDay() ) {
		                                                e.el.children[0].className = e.el.children[0].className + ' unavailable_date';
		                                                // set background day
		                                                $('.unavailable_date').css('background-color', background_day);
		                                            }
		                                        });
		                                    }

		                                    let el = e.el.querySelectorAll(".fc-daygrid-day-bg")[0];

		                                    if ( el ) {
		                                        if ( special_time_value ) {
		                                            el.innerHTML = ovabrw_daily_tuesday;
		                                            $.each( special_time_value, function( price, special_timestamp ) {
		                                                if ( time_stamp >= special_timestamp[0] && time_stamp <= special_timestamp[1] ) {
		                                                    el.innerHTML = price;
		                                                }
		                                            });
		                                        } else {
		                                            el.innerHTML = ovabrw_daily_tuesday;
		                                        }
		                                        
		                                        return e;
		                                    }
		                                    break;
		                                }
		                                case 3: {
		                                    // check disable week day in settings
		                                    if ( disable_week_day_value ) {
		                                        $.each( disable_week_day_value, function( key, day_value ) {
		                                            if( day_value == new_date.getDay() ) {
		                                                e.el.children[0].className = e.el.children[0].className + ' unavailable_date';
		                                                // set background day
		                                                $('.unavailable_date').css('background-color', background_day);
		                                            }
		                                        });
		                                    }

		                                    let el = e.el.querySelectorAll(".fc-daygrid-day-bg")[0];

		                                    if ( el ) {
		                                        if ( special_time_value ) {
		                                            el.innerHTML = ovabrw_daily_wednesday;
		                                            $.each( special_time_value, function( price, special_timestamp ) {
		                                                if ( time_stamp >= special_timestamp[0] && time_stamp <= special_timestamp[1] ) {
		                                                    el.innerHTML = price;
		                                                }
		                                            });
		                                        } else {
		                                            el.innerHTML = ovabrw_daily_wednesday;
		                                        }
		                                        
		                                        return e;
		                                    }
		                                    break;
		                                }
		                                case 4: {
		                                    // check disable week day in settings
		                                    if ( disable_week_day_value ) {
		                                        $.each( disable_week_day_value, function( key, day_value ) {
		                                            if( day_value == new_date.getDay() ) {
		                                                e.el.children[0].className = e.el.children[0].className + ' unavailable_date';
		                                                // set background day
		                                                $('.unavailable_date').css('background-color', background_day);
		                                            }
		                                        });
		                                    }

		                                    let el = e.el.querySelectorAll(".fc-daygrid-day-bg")[0];

		                                    if ( el ) {
		                                        if ( special_time_value ) {
		                                            el.innerHTML = ovabrw_daily_thursday;
		                                            $.each( special_time_value, function( price, special_timestamp ) {
		                                                if ( time_stamp >= special_timestamp[0] && time_stamp <= special_timestamp[1] ) {
		                                                    el.innerHTML = price;
		                                                }
		                                            });
		                                        } else {
		                                            el.innerHTML = ovabrw_daily_thursday;
		                                        }

		                                        return e;
		                                    }
		                                    break;
		                                }
		                                case 5: {
		                                    // check disable week day in settings
		                                    if ( disable_week_day_value ) {
		                                        $.each( disable_week_day_value, function( key, day_value ) {
		                                            if( day_value == new_date.getDay() ) {
		                                                e.el.children[0].className = e.el.children[0].className + ' unavailable_date';
		                                                // set background day
		                                                $('.unavailable_date').css('background-color', background_day);
		                                            }
		                                        });
		                                    }

		                                    let el = e.el.querySelectorAll(".fc-daygrid-day-bg")[0];

		                                    if ( el ) {
		                                        if ( special_time_value ) {
		                                            el.innerHTML = ovabrw_daily_friday;
		                                            $.each( special_time_value, function( price, special_timestamp ) {
		                                                if ( time_stamp >= special_timestamp[0] && time_stamp <= special_timestamp[1] ) {
		                                                    el.innerHTML = price;;
		                                                    return e;
		                                                }
		                                            });
		                                        } else {
		                                            el.innerHTML = ovabrw_daily_friday;
		                                        }
		                                        
		                                        return e;
		                                    }
		                                    break;
		                                }
		                                case 6: {
		                                    // check disable week day in settings
		                                    if ( disable_week_day_value ) {
		                                        $.each( disable_week_day_value, function( key, day_value ) {
		                                            if( day_value == new_date.getDay() ) {
		                                                e.el.children[0].className = e.el.children[0].className + ' unavailable_date';
		                                                // set background day
		                                                $('.unavailable_date').css('background-color', background_day);
		                                            }
		                                        });
		                                    }

		                                    let el = e.el.querySelectorAll(".fc-daygrid-day-bg")[0];

		                                    if ( el ) {
		                                        if ( special_time_value ) {
		                                            el.innerHTML = ovabrw_daily_saturday;
		                                            $.each( special_time_value, function( price, special_timestamp ) {
		                                                if ( time_stamp >= special_timestamp[0] && time_stamp <= special_timestamp[1] ) {
		                                                    el.innerHTML = price;
		                                                }
		                                            });
		                                        } else {
		                                            el.innerHTML = ovabrw_daily_saturday;
		                                        }
		                                        
		                                        return e;
		                                    }
		                                    break;
		                                }
		                            }
		                        } else if ( type_price == 'hour' ) {
		                            // check disable week day in settings
		                            if ( disable_week_day_value ) {
		                                $.each( disable_week_day_value, function( key, day_value ) {
		                                    if( day_value == new_date.getDay() ) {
		                                        e.el.children[0].className = e.el.children[0].className + ' unavailable_date';
		                                        // set background day
		                                        $('.unavailable_date').css('background-color', background_day);
		                                    }
		                                });
		                            }

		                            var ovabrw_price_hour = price_full_calendar_value[1].ovabrw_price_hour;
		                            let el = e.el.querySelectorAll(".fc-daygrid-day-bg")[0];

		                            if ( el ) {
		                                if ( special_time_value ) {
		                                    el.innerHTML = ovabrw_price_hour;
		                                    $.each( special_time_value, function( price, special_timestamp ) {
		                                        if ( time_stamp >= special_timestamp[0] && time_stamp <= special_timestamp[1] ) {
		                                            el.innerHTML = price;
		                                        }
		                                    });
		                                } else {
		                                    el.innerHTML = ovabrw_price_hour;
		                                }
		                                
		                                return e;
		                            }
		                        } else if ( type_price == 'mixed' ) {
		                            var ovabrw_daily_monday     = price_full_calendar_value[1].ovabrw_daily_monday;
		                            var ovabrw_daily_tuesday    = price_full_calendar_value[1].ovabrw_daily_tuesday;
		                            var ovabrw_daily_wednesday  = price_full_calendar_value[1].ovabrw_daily_wednesday;
		                            var ovabrw_daily_thursday   = price_full_calendar_value[1].ovabrw_daily_thursday;
		                            var ovabrw_daily_friday     = price_full_calendar_value[1].ovabrw_daily_friday;
		                            var ovabrw_daily_saturday   = price_full_calendar_value[1].ovabrw_daily_saturday;
		                            var ovabrw_daily_sunday     = price_full_calendar_value[1].ovabrw_daily_sunday;

		                            switch( new_date.getDay() ) {
		                                case 0: {
		                                    // check disable week day in settings
		                                    if ( disable_week_day_value ) {
		                                        $.each( disable_week_day_value, function( key, day_value ) {
		                                            if( day_value == new_date.getDay() ) {
		                                                e.el.children[0].className = e.el.children[0].className + ' unavailable_date';
		                                                // set background day
		                                                $('.unavailable_date').css('background-color', background_day);
		                                            }
		                                        });
		                                    }
		                                    
		                                    let el = e.el.querySelectorAll(".fc-daygrid-day-bg")[0];

		                                    if ( el ) {
		                                        if ( special_time_value ) {
		                                            el.innerHTML = ovabrw_daily_sunday;
		                                            $.each( special_time_value, function( price, special_timestamp ) {
		                                                if ( time_stamp >= special_timestamp[0] && time_stamp <= special_timestamp[1] ) {
		                                                    el.innerHTML = price;
		                                                }
		                                            });
		                                        } else {
		                                            el.innerHTML = ovabrw_daily_sunday;
		                                        }
		                                        
		                                        return e;    
		                                    }
		                                    break;
		                                }
		                                case 1: {
		                                    // check disable week day in settings
		                                    if ( disable_week_day_value ) {
		                                        $.each( disable_week_day_value, function( key, day_value ) {
		                                            if( day_value == new_date.getDay() ) {
		                                                e.el.children[0].className = e.el.children[0].className + ' unavailable_date';
		                                                // set background day
		                                                $('.unavailable_date').css('background-color', background_day);
		                                            }
		                                        });
		                                    }

		                                    let el = e.el.querySelectorAll(".fc-daygrid-day-bg")[0];

		                                    if ( el ) {
		                                        if ( special_time_value ) {
		                                            el.innerHTML = ovabrw_daily_monday;
		                                            $.each( special_time_value, function( price, special_timestamp ) {
		                                                if ( time_stamp >= special_timestamp[0] && time_stamp <= special_timestamp[1] ) {
		                                                    el.innerHTML = price;
		                                                }
		                                            });
		                                        } else {
		                                            el.innerHTML = ovabrw_daily_monday;
		                                        }

		                                        return e;
		                                    }
		                                    break;
		                                }
		                                case 2: {
		                                    // check disable week day in settings
		                                    if ( disable_week_day_value ) {
		                                        $.each( disable_week_day_value, function( key, day_value ) {
		                                            if( day_value == new_date.getDay() ) {
		                                                e.el.children[0].className = e.el.children[0].className + ' unavailable_date';
		                                                // set background day
		                                                $('.unavailable_date').css('background-color', background_day);
		                                            }
		                                        });
		                                    }

		                                    let el = e.el.querySelectorAll(".fc-daygrid-day-bg")[0];

		                                    if ( el ) {
		                                        if ( special_time_value ) {
		                                            el.innerHTML = ovabrw_daily_tuesday;
		                                            $.each( special_time_value, function( price, special_timestamp ) {
		                                                if ( time_stamp >= special_timestamp[0] && time_stamp <= special_timestamp[1] ) {
		                                                    el.innerHTML = price;
		                                                }
		                                            });
		                                        } else {
		                                            el.innerHTML = ovabrw_daily_tuesday;
		                                        }
		                                        
		                                        return e;
		                                    }
		                                    break;
		                                }
		                                case 3: {
		                                    // check disable week day in settings
		                                    if ( disable_week_day_value ) {
		                                        $.each( disable_week_day_value, function( key, day_value ) {
		                                            if( day_value == new_date.getDay() ) {
		                                                e.el.children[0].className = e.el.children[0].className + ' unavailable_date';
		                                                // set background day
		                                                $('.unavailable_date').css('background-color', background_day);
		                                            }
		                                        });
		                                    }

		                                    let el = e.el.querySelectorAll(".fc-daygrid-day-bg")[0];

		                                    if ( el ) {
		                                        if ( special_time_value ) {
		                                            el.innerHTML = ovabrw_daily_wednesday;
		                                            $.each( special_time_value, function( price, special_timestamp ) {
		                                                if ( time_stamp >= special_timestamp[0] && time_stamp <= special_timestamp[1] ) {
		                                                    el.innerHTML = price;
		                                                }
		                                            });
		                                        } else {
		                                            el.innerHTML = ovabrw_daily_wednesday;
		                                        }
		                                        
		                                        return e;
		                                    }
		                                    break;
		                                }
		                                case 4: {
		                                    // check disable week day in settings
		                                    if ( disable_week_day_value ) {
		                                        $.each( disable_week_day_value, function( key, day_value ) {
		                                            if( day_value == new_date.getDay() ) {
		                                                e.el.children[0].className = e.el.children[0].className + ' unavailable_date';
		                                                // set background day
		                                                $('.unavailable_date').css('background-color', background_day);
		                                            }
		                                        });
		                                    }

		                                    let el = e.el.querySelectorAll(".fc-daygrid-day-bg")[0];

		                                    if ( el ) {
		                                        if ( special_time_value ) {
		                                            el.innerHTML = ovabrw_daily_thursday;
		                                            $.each( special_time_value, function( price, special_timestamp ) {
		                                                if ( time_stamp >= special_timestamp[0] && time_stamp <= special_timestamp[1] ) {
		                                                    el.innerHTML = price;
		                                                }
		                                            });
		                                        } else {
		                                            el.innerHTML = ovabrw_daily_thursday;
		                                        }

		                                        return e;
		                                    }
		                                    break;
		                                }
		                                case 5: {
		                                    // check disable week day in settings
		                                    if ( disable_week_day_value ) {
		                                        $.each( disable_week_day_value, function( key, day_value ) {
		                                            if( day_value == new_date.getDay() ) {
		                                                e.el.children[0].className = e.el.children[0].className + ' unavailable_date';
		                                                // set background day
		                                                $('.unavailable_date').css('background-color', background_day);
		                                            }
		                                        });
		                                    }

		                                    let el = e.el.querySelectorAll(".fc-daygrid-day-bg")[0];

		                                    if ( el ) {
		                                        if ( special_time_value ) {
		                                            el.innerHTML = ovabrw_daily_friday;
		                                            $.each( special_time_value, function( price, special_timestamp ) {
		                                                if ( time_stamp >= special_timestamp[0] && time_stamp <= special_timestamp[1] ) {
		                                                    el.innerHTML = price;;
		                                                    return e;
		                                                }
		                                            });
		                                        } else {
		                                            el.innerHTML = ovabrw_daily_friday;
		                                        }
		                                        
		                                        return e;
		                                    }
		                                    break;
		                                }
		                                case 6: {
		                                    // check disable week day in settings
		                                    if ( disable_week_day_value ) {
		                                        $.each( disable_week_day_value, function( key, day_value ) {
		                                            if( day_value == new_date.getDay() ) {
		                                                e.el.children[0].className = e.el.children[0].className + ' unavailable_date';
		                                                // set background day
		                                                $('.unavailable_date').css('background-color', background_day);
		                                            }
		                                        });
		                                    }

		                                    let el = e.el.querySelectorAll(".fc-daygrid-day-bg")[0];

		                                    if ( el ) {
		                                        if ( special_time_value ) {
		                                            el.innerHTML = ovabrw_daily_saturday;
		                                            $.each( special_time_value, function( price, special_timestamp ) {
		                                                if ( time_stamp >= special_timestamp[0] && time_stamp <= special_timestamp[1] ) {
		                                                    el.innerHTML = price;
		                                                }
		                                            });
		                                        } else {
		                                            el.innerHTML = ovabrw_daily_saturday;
		                                        }
		                                        
		                                        return e;
		                                    }
		                                    break;
		                                }
		                            }
		                        }
		                    } else {
		                        var type_price = srcCalendarEl.getAttribute('type_price');
		                        // period_time
		                        if ( type_price == 'period_time' || type_price == 'transportation' ) {

		                            // check disable week day in settings
		                            if ( disable_week_day_value ) {
		                                $.each( disable_week_day_value, function( key, day_value ) {
		                                    if( day_value == new_date.getDay() ) {
		                                        e.el.children[0].className = e.el.children[0].className + ' unavailable_date';
		                                        // set background day
		                                        $('.unavailable_date').css('background-color', background_day);
		                                    }
		                                });
		                            }

		                            return e;
		                        }
		                    }
		                },
		                dateClick: function( info ) {
		                    var new_date_a = new Date( info.date );            

		                    var year  = new_date_a.getFullYear();
		                    var month = new_date_a.getMonth() + 1;
		                    var day   = new_date_a.getDate();

		                    month   = ( month < 10 ) ? '0' + month : month;
		                    day     = ( day < 10 ) ? '0' + day : day;

		                    var today = new Date();
		                    var date_click_24 = new Date( year, month - 1, day, 24, 0 );

		                    var date_check_rent_full = year + '-' + month + '-' + day;

		                    if ( define_day == "hotel" || $('.rental_item input[name="ovabrw_pickup_date"]').hasClass('no_time_picker') || ( time_to_book_start.length < 1 ) ) {
		                        default_hour_start = '';
		                    }

		                    // check disable week day in settings
		                    if ( disable_week_day_value ) {
		                        $.each( disable_week_day_value, function( key, day_value ) {
		                            if ( day_value == new_date_a.getDay() ) {
		                                alert(notifi_disable_day);
		                                date_click_24 = 0;
		                            }
		                        });
		                    }

		                    if ( ( ! date_rent_full.includes( date_check_rent_full ) ) && ( date_click_24 >= today ) ) {
		                        var date_input = date_format;
		                        date_input = date_input.replace('Y', year);
		                        date_input = date_input.replace('m', month);
		                        date_input = date_input.replace('d', day);

		                        if ( default_hour_start ) {
		                            $('input[name="ovabrw_pickup_date"]').val(date_input + ' ' + default_hour_start);
		                        } else {
		                            $('input[name="ovabrw_pickup_date"]').val(date_input);
		                        }
		                        
		                        if( document.getElementById("ovabrw_booking_form") ){
		                            document.getElementById("ovabrw_booking_form").scrollIntoView({behavior: 'smooth'});
		                            $('.startdate_perido_time').each( function() {
		                                var that = $(this);
		                                if ( that.val() ) {
		                                    window.Brw_Frontend.ova_ajax_load_packages(that);
		                                }
		                            });
		                        }
		                    }
		                }
		            });

		            srcCalendar.render();
		        });
		    });
		});
		
	});


})(jQuery);