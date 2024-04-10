<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// var_dump
if ( ! function_exists( 'dd' ) ) {
	function dd( ...$args ) {
		echo '<pre>';
		var_dump( ...$args );
		echo '</pre>';
		die;
	}
}

// Return value of setting
if ( ! function_exists( 'ovabrw_get_setting' ) ) {
	function ovabrw_get_setting( $setting ) {
		if ( trim( $setting ) == '' ) return '';

		return $setting;
	}
}

// Get Date Format in Events Setting
if ( ! function_exists( 'ovabrw_get_date_format' ) ) {
	function ovabrw_get_date_format() {
		return apply_filters( 'ovabrw_get_date_format_hook', ovabrw_get_setting( get_option( 'ova_brw_booking_form_date_format', 'd-m-Y' ) ) );
	}
}

if ( ! function_exists( 'ovabrw_get_placeholder_date' ) ) {
	function ovabrw_get_placeholder_date() {
		$placeholder = '';
		$dateformat = ovabrw_get_date_format();

		if ( 'Y-m-d' === $dateformat ) {
			$placeholder = esc_html__( 'YY-mm-dd', 'ova-brw' );
		} elseif ( 'm/d/Y' === $dateformat ) {
			$placeholder = esc_html__( 'mm/dd/YY', 'ova-brw' );
		} elseif ( 'Y/m/d' === $dateformat ) {
			$placeholder = esc_html__( 'YY/mm/dd', 'ova-brw' );
		} else {
			$placeholder = esc_html__( 'dd-mm-YY', 'ova-brw' );
		}

		return $placeholder;
	}
}

// Get Time Format in Events Setting
if ( ! function_exists( 'ovabrw_get_time_format' ) ) {
	function ovabrw_get_time_format() {
		return apply_filters( 'ova_brw_calendar_time_format_hook', ovabrw_get_setting( get_option( 'ova_brw_calendar_time_format', '12' ) ) );
	}
}

// Get Time book for pick-up date
if ( ! function_exists( 'ovabrw_group_time_pickup_date_global_setting' ) ) {
	function ovabrw_group_time_pickup_date_global_setting() {
		// Get from setting
		$group_time = ovabrw_get_setting( get_option( 'ova_brw_calendar_time_to_book', '07:00, 07:30, 08:00, 08:30, 09:00, 09:30, 10:00, 10:30, 11:00, 11:30, 12:00, 12:30, 13:00, 13:30, 14:00, 14:30, 15:00, 15:30, 16:00, 16:30, 17:00, 17:30, 18:00' ) );

		return apply_filters( 'ovabrw_group_time_pickup_date_global_setting', $group_time );
	}
}

// Get default hour for dropoff date
if ( ! function_exists( 'ovabrw_group_time_dropoff_date_global_setting' ) ) {
	function ovabrw_group_time_dropoff_date_global_setting() {
		// Get from setting
		$group_time = ovabrw_get_setting( get_option( 'ova_brw_calendar_time_to_book_for_end_date', '07:00, 07:30, 08:00, 08:30, 09:00, 09:30, 10:00, 10:30, 11:00, 11:30, 12:00, 12:30, 13:00, 13:30, 14:00, 14:30, 15:00, 15:30, 16:00, 16:30, 17:00, 17:30, 18:00' ) );

		return apply_filters( 'ovabrw_group_time_dropoff_date_global_setting', $group_time );
	}
}

// Get default hour for pick-up date
if ( ! function_exists( 'ovabrw_get_default_time' ) ) {
	function ovabrw_get_default_time( $id = false, $type = "start" ) {
		// Get from Setting
		if ( $type == 'start' ) {
			$time = ovabrw_get_setting( get_option( 'ova_brw_booking_form_default_hour', '07:00' ) );	
			// Get from Product
			$manage_default_hour_start = get_post_meta( $id, 'ovabrw_manage_default_hour_start', true );
			if ( $manage_default_hour_start == 'new_time' ) {
				$time = get_post_meta( $id, 'ovabrw_product_default_hour_start', true );
			}
		}else {
			// Get from Setting
			$time = ovabrw_get_setting( get_option( 'ova_brw_booking_form_default_hour_end_date', '07:00' ) );

			// Get from Product
			$manage_default_hour_start = get_post_meta( $id, 'ovabrw_manage_default_hour_end', true );
			if ( $manage_default_hour_start == 'new_time' ){
				$time = get_post_meta( $id, 'ovabrw_product_default_hour_end', true );
			}
		}
		
		$time = trim( sanitize_text_field( $time ) );
		$hour = (int)substr( $time, 0, strpos( $time, ':' ) );
		$minute = substr( $time, -2 );
		
		$time_format = ovabrw_get_time_format();

		if ( $time_format == '12' ) {
			if( $hour < 12 ) {
				$time = $hour . ':' . $minute . ' AM';
			} elseif( $hour == 12 ) {
				$time = $hour . ':' . $minute . ' PM';
			} elseif ( $hour > 12 ) {
				$time = ( $hour % 12) . ':' . $minute . ' PM';
			}
		}

		return $time;
	}
}

if ( ! function_exists( 'ovabrw_get_time_format_php' ) ) {
	function ovabrw_get_time_format_php() {
		$time_format = ovabrw_get_time_format();

		if ( $time_format == '12' ) {
			$set_time_format = 'g:i A';
		} else {
			$set_time_format = 'H:i';
		}
		
		return $set_time_format;
	}
}

if ( ! function_exists( 'ovabrw_timepicker_product' ) ) {
	function ovabrw_timepicker_product( $product_id = false, $type = 'start' ) {
		if ( $type == 'start' ) {
			$manage_time_to_book = get_post_meta( $product_id, 'ovabrw_manage_time_book_start', true );
		} else {
			$manage_time_to_book = get_post_meta( $product_id, 'ovabrw_manage_time_book_end', true );
		}
		
		$ova_brw_calendar_time_to_book = ovabrw_group_time_pickup_date_global_setting();

		switch( $manage_time_to_book ) {
			case 'in_setting':
			if ( empty( $ova_brw_calendar_time_to_book ) ) {
				return 'false';
			}
			break;
			case 'new_time':
			if ( $type == 'start' ) {
				$time_to_book_new = get_post_meta( $product_id, 'ovabrw_product_time_to_book_start', true );
			} else {
				$time_to_book_new = get_post_meta( $product_id, 'ovabrw_product_time_to_book_end', true );
			}

			if( empty( $time_to_book_new ) ) {
				return 'false';
			}
			break;
			case 'no':
			return 'false';
			break;
		}

		return 'true';
	}
}

// Return real path template in Plugin or Theme
if ( ! function_exists( 'ovabrw_locate_template' ) ) {
	function ovabrw_locate_template( $template_name = '', $template_path = '', $default_path = '' ) {
		// Set variable to search in ovabrw-templates folder of theme.
		if ( ! $template_path ) :
			$template_path = 'ovabrw-templates/';
		endif;

		// Set default plugin templates path.
		if ( ! $default_path ) :
			$default_path = OVABRW_PLUGIN_PATH . 'ovabrw-templates/'; // Path to the template folder
		endif;

		// Search template file in theme folder.
		$template = locate_template( array(
			$template_path . $template_name
			// ,$template_name
		) );

		// Get plugins template file.
		if ( ! $template ) :
			$template = $default_path . $template_name;
		endif;

		return apply_filters( 'ovabrw_locate_template', $template, $template_name, $template_path, $default_path );
	}
}

// Include Template File
if ( ! function_exists( 'ovabrw_get_template' ) ) {
	function ovabrw_get_template( $template_name = '', $args = array(), $tempate_path = '', $default_path = '' ) {
		if ( is_array( $args ) && isset( $args ) ) {
			extract( $args );
		}

		$template_file = ovabrw_locate_template( $template_name, $tempate_path, $default_path );
		if ( ! file_exists( $template_file ) ) :
			_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $template_file ), '1.0.0' );
			return;
		endif;

		include $template_file;
	}
}

if ( ! function_exists( 'ovabrw_woo_wp_select_multiple' ) ) {
	function ovabrw_woo_wp_select_multiple( $field ) {
		global $thepostid, $post, $woocommerce;

		$thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
		$field['class']         = isset( $field['class'] ) ? $field['class'] : 'select short';
		$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
		$field['name']          = isset( $field['name'] ) ? $field['name'] : $field['id'];
		$field['value']         = isset( $field['value'] ) ? $field['value'] : ( get_post_meta( $thepostid, $field['id'], true ) ? get_post_meta( $thepostid, $field['id'], true ) : array() );

		echo '<p class="form-field ' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '"><label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label><select id="' . esc_attr( $field['id'] ) . '" name="' . esc_attr( $field['name'] ) . '" class="' . esc_attr( $field['class'] ) . '" multiple="multiple">';

		foreach( $field['options'] as $key => $value ) {
			echo '<option value="' . esc_attr( $key ) . '" ' . ( in_array( $key, $field['value'] ) ? 'selected="selected"' : '' ) . '>' . esc_html( $value ) . '</option>';
		}

		echo '</select> ';

		if ( ! empty( $field['description'] ) ) {
			if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
				echo '<img class="help_tip" data-tip="' . esc_attr( $field['description'] ) . '" src="' . esc_url( WC()->plugin_url() ) . '/assets/images/help.png" height="16" width="16" />';
			} else {
				echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
			}
		}

		echo '</p>';
	}
}

if ( ! function_exists( 'ovabrw_get_timestamp_by_date_and_hour' ) ) {
	function ovabrw_get_timestamp_by_date_and_hour ( $date = 0, $time = 0 ) {
		$time_arr = explode(':', $time);
		$hour_time = 0;

		if ( !empty( $time_arr ) && is_array( $time_arr ) && count( $time_arr ) > 1 ) {
			$hour_time = (float) $time_arr[0];

			if ( strpos($time_arr[1], "AM") !== false )  {
				$time_arr[1] = str_replace('AM', '', $time_arr[1]);
				$hour_time = ($hour_time != 12) ? $hour_time : 0;

			}
			if ( strpos($time_arr[1], "PM") !== false )  {
				$time_arr[1] = str_replace('PM', '', $time_arr[1]);
				$hour_time = $hour_time + 12;
			}

			$min_time = (float) $time_arr[1];
			$hour_time = $hour_time + $min_time / 60;
		}

		$total_time = strtotime( $date ) + $hour_time * 3600;
		return $total_time;
	}
}

if ( ! function_exists( 'ovabrw_show_number_vehicle' ) ) {
	function ovabrw_show_number_vehicle( $product_id ) {
		$ovabrw_show_number_vehicle 		= get_post_meta( $product_id, 'ovabrw_show_number_vehicle', true );
		$ovabrw_show_number_vehicle_global 	= ovabrw_get_setting( get_option( 'ova_brw_booking_form_show_number_vehicle', 'yes' ) );
		
		switch( $ovabrw_show_number_vehicle ) {
			case 'in_setting':
			if ( $ovabrw_show_number_vehicle_global == 'yes' ) {
				return 'yes';
			} else {
				return 'no';
			}
			break;
			case 'yes':
			return 'yes';
			break;
			case 'no':
			return 'no';
			break;
			default:
			return 'yes';
		}
	}
}

if ( ! function_exists( 'ovabrw_show_pick_location_product' ) ) {
	function ovabrw_show_pick_location_product( $product_id = false, $type = 'pickup' ) {
		// Get custom checkout field by Category
		$product_cats 	= wp_get_post_terms( $product_id, 'product_cat' );
		$cat_id 		= isset( $product_cats[0] ) ? $product_cats[0]->term_id : '';
		$ovabrw_show_loc_booking_form = $cat_id ? get_term_meta($cat_id, 'ovabrw_show_loc_booking_form', true) : '';

		if ( $type == 'pickup' ) {
			$ovabrw_show_pick_location_product = get_post_meta( $product_id, 'ovabrw_show_pickup_location_product', true );
			
			if ( !empty( $ovabrw_show_loc_booking_form ) && in_array('pickup_loc', $ovabrw_show_loc_booking_form) ) {
				$ovabrw_booking_form_show_pick_location = 'yes';
			} elseif ( !empty( $ovabrw_show_loc_booking_form ) && !in_array('pickup_loc', $ovabrw_show_loc_booking_form) ) {
				$ovabrw_booking_form_show_pick_location = 'no';
			} else {
				$ovabrw_booking_form_show_pick_location = ovabrw_get_setting( get_option( 'ova_brw_booking_form_show_pickup_location', 'no' ) );	
			}
		} else {
			$ovabrw_show_pick_location_product = get_post_meta( $product_id, 'ovabrw_show_pickoff_location_product', true );
			
			if ( !empty( $ovabrw_show_loc_booking_form ) && in_array('dropoff_loc', $ovabrw_show_loc_booking_form) ) {
				$ovabrw_booking_form_show_pick_location = 'yes';
			} elseif ( !empty( $ovabrw_show_loc_booking_form ) && !in_array('dropoff_loc', $ovabrw_show_loc_booking_form) ) {
				$ovabrw_booking_form_show_pick_location = 'no';
			} else {
				$ovabrw_booking_form_show_pick_location = ovabrw_get_setting( get_option( 'ova_brw_booking_form_show_pickoff_location', 'no' ) );
			}
		}

		switch( $ovabrw_show_pick_location_product ) {
			case 'in_setting':
			if ( $ovabrw_booking_form_show_pick_location == 'no' ) {
				return false;
			} else {
				return true;
			}
			break;
			case 'yes':
			return true;
			break;
			case 'no':
			return false;
			break;
			default:
			if ( $ovabrw_booking_form_show_pick_location == 'no' ) {
				return false;
			} else {
				return true;
			}
		}
	}
}

if ( ! function_exists( 'ovabrw_rq_show_pick_location_product' ) ) {
	function ovabrw_rq_show_pick_location_product( $product_id = false, $type = 'pickup' ) {
		// Get custom checkout field by Category
		$product_cats 	= wp_get_post_terms( $product_id, 'product_cat' );
		$cat_id 		= isset( $product_cats[0] ) ? $product_cats[0]->term_id : '';
		$ovabrw_show_loc_booking_form = $cat_id ? get_term_meta($cat_id, 'ovabrw_show_loc_booking_form', true) : '';

		if ( $type == 'pickup' ) {
			$ovabrw_show_pick_location_product = get_post_meta( $product_id, 'ovabrw_show_pickup_location_product', true );

			if ( !empty( $ovabrw_show_loc_booking_form ) && in_array( 'pickup_loc', $ovabrw_show_loc_booking_form ) ) {
				$ovabrw_booking_form_show_pick_location = 'yes';
			} elseif ( !empty( $ovabrw_show_loc_booking_form ) && !in_array( 'pickup_loc', $ovabrw_show_loc_booking_form ) ) {
				$ovabrw_booking_form_show_pick_location = 'no';
			}else {
				$ovabrw_booking_form_show_pick_location = ovabrw_get_setting( get_option( 'ova_brw_request_booking_form_show_pickup_location', 'no' ) );
			}
		} else {
			$ovabrw_show_pick_location_product = get_post_meta( $product_id, 'ovabrw_show_pickoff_location_product', true );

			if ( !empty( $ovabrw_show_loc_booking_form ) && in_array( 'dropoff_loc', $ovabrw_show_loc_booking_form ) ) {
				$ovabrw_booking_form_show_pick_location = 'yes';
			} elseif ( !empty( $ovabrw_show_loc_booking_form ) && !in_array( 'dropoff_loc', $ovabrw_show_loc_booking_form ) ) {
				$ovabrw_booking_form_show_pick_location = 'no';
			} else {
				$ovabrw_booking_form_show_pick_location = ovabrw_get_setting( get_option( 'ova_brw_request_booking_form_show_pickoff_location', 'no' ) );
			}
		}

		switch( $ovabrw_show_pick_location_product ) {
			case 'in_setting':
			if ( $ovabrw_booking_form_show_pick_location == 'no' ) {
				return false;
			} else {
				return true;
			}
			break;
			case 'yes':
			return true;
			break;
			case 'no':
			return false;
			break;
			default:
			if ( $ovabrw_booking_form_show_pick_location == 'no' ) {
				return false;
			} else {
				return true;
			}
		}
	}
}

if ( ! function_exists( 'ovabrw_check_pickup_dropoff_loc_transport' ) ) {
	function ovabrw_check_pickup_dropoff_loc_transport( $product_id = false, $pick_loc = '', $type = 'pickup' ) {
		$list_loc_pickup_dropoff = ovabrw_get_list_pickup_dropoff_loc_transport( $product_id );

		if ( empty( $list_loc_pickup_dropoff ) || !is_array( $list_loc_pickup_dropoff ) ) return false;

		$flag = false;
		if ( $type == 'pickup' ) {
			foreach( $list_loc_pickup_dropoff as $pickup_loc => $dropoff_loc ) {
				if ( $pick_loc == $pickup_loc ) {
					$flag = true;
				}
			}
		} else {
			foreach( $list_loc_pickup_dropoff as $pickup_loc => $dropoff_loc ) {
				if ( is_array( $dropoff_loc ) && in_array( $pick_loc, $dropoff_loc ) ) {
					$flag = true;
				}
			}
		}

		return $flag;
	}
}

if ( ! function_exists( 'ovabrw_get_time_by_pick_up_off_loc_transport' ) ) {
	function ovabrw_get_time_by_pick_up_off_loc_transport( $product_id, $pickup_loc, $dropoff_loc ) {
		if ( ! $product_id ) return [];
		
		$list_time_pickup_dropoff_loc = ovabrw_get_list_time_loc_transport( $product_id );
		$time_complete = 0;

		if ( $list_time_pickup_dropoff_loc && is_array( $list_time_pickup_dropoff_loc ) ) {
			foreach( $list_time_pickup_dropoff_loc as $pickup => $dropoff_arr ) {
				if ( $pickup_loc == $pickup && is_array( $dropoff_arr ) ) {
					foreach( $dropoff_arr as $dropoff => $time ) {
						if ( $dropoff == $dropoff_loc ) {
							$time_complete = (float)$time;
						}
					}
				} 
			}
		}

		return $time_complete;
	}
}

if ( ! function_exists( 'ovabrw_get_list_time_loc_transport' ) ) {
	function ovabrw_get_list_time_loc_transport( $product_id ) {
		if ( ! $product_id ) return [];

		$ovabrw_pickup_location 	= get_post_meta( $product_id, 'ovabrw_pickup_location', 'false' );
		$ovabrw_dropoff_location 	= get_post_meta( $product_id, 'ovabrw_dropoff_location', 'false' );
		$ovabrw_location_time 		= get_post_meta( $product_id, 'ovabrw_location_time', 'false' );
		$list_time_pickup_dropoff_loc = [];

		if ( !empty( $ovabrw_pickup_location ) ) {
			foreach( $ovabrw_pickup_location as $key => $location ) {
				$list_time_pickup_dropoff_loc[$location][$ovabrw_dropoff_location[$key]] = $ovabrw_location_time[$key];
			}
		}

		return $list_time_pickup_dropoff_loc;
	}
}

if ( ! function_exists( 'ovabrw_get_list_price_loc_transport' ) ) {
	function ovabrw_get_list_price_loc_transport( $product_id ) {
		if ( ! $product_id ) return [];

		$ovabrw_pickup_location 	= get_post_meta( $product_id, 'ovabrw_pickup_location', 'false' );
		$ovabrw_dropoff_location 	= get_post_meta( $product_id, 'ovabrw_dropoff_location', 'false' );
		$ovabrw_price_location 		= get_post_meta( $product_id, 'ovabrw_price_location', 'false' );
		$list_price_pickup_dropoff_loc = [];

		if ( !empty( $ovabrw_pickup_location ) ) {
			foreach( $ovabrw_pickup_location as $key => $location ) {
				$list_price_pickup_dropoff_loc[$location][$ovabrw_dropoff_location[$key]] = $ovabrw_price_location[$key];
			}
		}

		return $list_price_pickup_dropoff_loc;
	}
}

if ( ! function_exists( 'ovabrw_show_pick_date_product' ) ) {
	function ovabrw_show_pick_date_product( $product_id = false, $type = 'pickup' ) {
		if ( $type == 'pickup' ) {
			$ovabrw_show_pick_date_product 		= get_post_meta( $product_id, 'ovabrw_show_pickup_date_product', true );
			$ovabrw_booking_form_show_pick_date = ovabrw_get_setting( get_option( 'ova_brw_booking_form_show_pickup_date', 'yes' ) );
		} else {
			$ovabrw_rental_type = get_post_meta( $product_id, 'ovabrw_price_type', true ); 

			if ( $ovabrw_rental_type == 'transportation' ) {
				$ovabrw_show_pick_date_product = 'no';
				$dropoff_date_by_setting = get_post_meta( $product_id, 'ovabrw_dropoff_date_by_setting', true );
				if ( $dropoff_date_by_setting === 'yes' ) {
					$ovabrw_show_pick_date_product 		= get_post_meta( $product_id, 'ovabrw_show_dropoff_date_product', true );
					$ovabrw_booking_form_show_pick_date = ovabrw_get_setting( get_option( 'ova_brw_booking_form_show_dropoff_date', 'yes' ) );
				}
			} else {
				$ovabrw_show_pick_date_product 		= get_post_meta( $product_id, 'ovabrw_show_dropoff_date_product', true );
				$ovabrw_booking_form_show_pick_date = ovabrw_get_setting( get_option( 'ova_brw_booking_form_show_dropoff_date', 'yes' ) );
			}
		}
		
		switch( $ovabrw_show_pick_date_product ) {
			case 'in_setting':
			if ( $ovabrw_booking_form_show_pick_date == 'yes' ) {
				return true;
			} else {
				return false;
			}
			break;
			case 'yes':
			return true;
			break;
			case 'no':
			return false;
			break;
			default:
			return true;
		}
	}
}

if ( ! function_exists( 'ovabrw_show_rq_pick_date_product' ) ) {
	function ovabrw_show_rq_pick_date_product( $product_id = false, $type = 'pickup' ) {
		if ( $type == 'pickup' ) {
			$ovabrw_show_pick_date_product 		= get_post_meta( $product_id, 'ovabrw_show_pickup_date_product', true );
			$ovabrw_booking_form_show_pick_date = ovabrw_get_setting( get_option( 'ova_brw_request_booking_form_show_pickup_date', 'yes' ) );
		} else {
			$ovabrw_show_pick_date_product = get_post_meta( $product_id, 'ovabrw_show_dropoff_date_product', true );
			$ovabrw_booking_form_show_pick_date = ovabrw_get_setting( get_option( 'ova_brw_request_booking_form_show_dropoff_date', 'yes' ) );
		}
		
		switch( $ovabrw_show_pick_date_product ) {
			case 'in_setting':
			if ( $ovabrw_booking_form_show_pick_date == 'yes' ) {
				return true;
			} else {
				return false;
			}
			break;
			case 'yes':
			return true;
			break;
			case 'no':
			return false;
			break;
			default:
			return true;
		}
	}
}

if ( ! function_exists( 'ovabrw_check_time_to_book' ) ) {
	function ovabrw_check_time_to_book( $product_id = false, $type = 'start' ) {
		if ( $type == 'start' ) {
			$manage_time_to_book = get_post_meta( $product_id, 'ovabrw_manage_time_book_start', true );
		} else {
			$manage_time_to_book = get_post_meta( $product_id, 'ovabrw_manage_time_book_end', true );
		}
		
		switch( $manage_time_to_book ) {
			case 'in_setting':
			if ( $type = 'start' ) {
				$time_to_book = ovabrw_group_time_pickup_date_global_setting();
			} else {
				$time_to_book = ovabrw_group_time_dropoff_date_global_setting();
			}
			break;
			case 'new_time':
			if ( $type = 'start' ) {
				$time_to_book = get_post_meta( $product_id, 'ovabrw_product_time_to_book_start', true );
			} else {
				$time_to_book = get_post_meta( $product_id, 'ovabrw_product_time_to_book_end', true );
			}
			break;
			case 'no':
			$time_to_book = '';
			break;
			default:
			if ( $type = 'start' ) {
				$time_to_book = ovabrw_group_time_pickup_date_global_setting();
			} else {
				$time_to_book = ovabrw_group_time_dropoff_date_global_setting();
			}
		}

		return $time_to_book;
	}
}

if ( ! function_exists( 'ovabrw_time_to_book' ) ) {
	function ovabrw_time_to_book( $product_id = false, $type = 'start' ) {
		if ( $type == 'start' ) {
			$manage_time_to_book_start = get_post_meta( $product_id, 'ovabrw_manage_time_book_start', true );

			switch( $manage_time_to_book_start ) {
				case 'in_setting':
				$time_to_book = ovabrw_group_time_pickup_date_global_setting();
				break;
				case 'new_time':
				$time_to_book = get_post_meta( $product_id, 'ovabrw_product_time_to_book_start', true );
				break;
				case 'no':
				$time_to_book = 'no';
				break;
				default:
				$time_to_book = ovabrw_group_time_pickup_date_global_setting();
			}
		} else {
			$ovabrw_manage_time_book_end = get_post_meta( $product_id, 'ovabrw_manage_time_book_end', true );

			switch( $ovabrw_manage_time_book_end ) {
				case 'in_setting':
				$time_to_book = ovabrw_group_time_dropoff_date_global_setting();
				break;
				case 'new_time':
				$time_to_book = get_post_meta( $product_id, 'ovabrw_product_time_to_book_end', true );
				break;
				case 'no':
				$time_to_book = 'no';
				break;
				default:
				$time_to_book = ovabrw_group_time_dropoff_date_global_setting();
			}
		}

		return $time_to_book;
	}
}

// Get Defined 1 day of product
if ( ! function_exists( 'defined_one_day' ) ) {
	function defined_one_day( $product_id ) {
		$ovabrw_price_type 		= get_post_meta( $product_id, 'ovabrw_price_type', true );
		$ovabrw_define_1_day 	= get_post_meta( $product_id, 'ovabrw_define_1_day', true );

		if ( $ovabrw_price_type === 'day' && $ovabrw_define_1_day === 'hotel' ) {
			return 'hotel';
		} elseif ( $ovabrw_price_type === 'day' && $ovabrw_define_1_day === 'day' ) {
			return 'day';
		} elseif ( $ovabrw_price_type === 'day' && $ovabrw_define_1_day === 'hour' ) {
			return 'hour';
		}

		return false;
	}
}

// Get Text Time
if ( ! function_exists( 'ovabrw_text_time' ) ) {
	function ovabrw_text_time( $price_type, $rent_time ) {
		if ( $price_type == 'day' ) {
			$text = esc_html__( 'Day(s)', 'ova-brw' );
		} elseif ( $price_type == 'hour' ) {
			$text = esc_html__( 'Hour(s)', 'ova-brw' );
		} elseif ( $price_type == 'mixed' && $rent_time['rent_time_day_raw'] < 1 ) {
			$text = esc_html__( 'Hour(s)', 'ova-brw' );
		} elseif ( $price_type == 'mixed' && $rent_time['rent_time_day_raw'] >= 1 ) {
			$text = esc_html__( 'Day(s)', 'ova-brw' );
		} else {
			$text = '';
		}

		return $text;
	}
}

// Get Text Time for Global
if ( ! function_exists( 'ovabrw_text_time_gl' ) ) {
	function ovabrw_text_time_gl( $price_type, $rent_time ) {
		if ( $price_type == 'day' ) {
			$text = esc_html__( 'Day(s)', 'ova-brw' );
		} elseif ( $price_type == 'hour' ) {
			$text = esc_html__( 'Hour(s)', 'ova-brw' );
		} elseif ( $price_type == 'mixed' && $rent_time['rent_time_day_raw'] < 1 ) {
			$text = esc_html__( 'Hour(s)', 'ova-brw' );
		} elseif( $price_type == 'mixed' && $rent_time['rent_time_day_raw'] >= 1 ) {
			$text = esc_html__( 'Day(s)', 'ova-brw' );
		} else {
			$text = '';
		}

		return $text;
	}
}

// Get Text Time for range time
if ( ! function_exists( 'ovabrw_text_time_rt' ) ) {
	function ovabrw_text_time_rt( $price_type, $rent_time ) {
		if ( $price_type == 'day' ) {
			$text = esc_html__( 'Special Day(s)', 'ova-brw' );
		} elseif ( $price_type == 'hour' ) {
			$text = esc_html__( 'Special Hour(s)', 'ova-brw' );
		} elseif ( $price_type == 'mixed' && $rent_time['rent_time_day_raw'] < 1 ) {
			$text = esc_html__( 'Special Hour(s)', 'ova-brw' );
		} elseif ( $price_type == 'mixed' && $rent_time['rent_time_day_raw'] >= 1 ) {
			$text = esc_html__( 'Special Day(s)', 'ova-brw' );
		} else {
			$text = '';
		}

		return $text;
	}
}

// List custom checkout fields array
if ( ! function_exists( 'ovabrw_get_list_field_checkout' ) ) {
	function ovabrw_get_list_field_checkout( $post_id ) {
		if ( ! $post_id ) return [];

		$list_ckf_output = [];
		$ovabrw_manage_custom_checkout_field = get_post_meta( $post_id, 'ovabrw_manage_custom_checkout_field', true );
		$list_field_checkout = get_option( 'ovabrw_booking_form', array() );

		// Get custom checkout field by Category
		$product_cats 	= wp_get_post_terms( $post_id, 'product_cat' );
		$cat_id 		= isset( $product_cats[0] ) ? $product_cats[0]->term_id : '';
		$ovabrw_custom_checkout_field = $cat_id ? get_term_meta($cat_id, 'ovabrw_custom_checkout_field', true) : '';
		$ovabrw_choose_custom_checkout_field = $cat_id ? get_term_meta($cat_id, 'ovabrw_choose_custom_checkout_field', true) : '';
		
		if ( $ovabrw_manage_custom_checkout_field === 'new' ) {
			$list_field_checkout_in_product = get_post_meta( $post_id, 'ovabrw_product_custom_checkout_field', true );
			$list_field_checkout_in_product_arr = explode( ',', $list_field_checkout_in_product );
			$list_field_checkout_in_product_arr = array_map( 'trim', $list_field_checkout_in_product_arr );

			$list_ckf_output = [];
			if ( !empty( $list_field_checkout_in_product_arr ) && is_array( $list_field_checkout_in_product_arr ) ) {
				foreach( $list_field_checkout_in_product_arr as $field_name ) {
					if ( array_key_exists( $field_name, $list_field_checkout ) ) {
						$list_ckf_output[$field_name] = $list_field_checkout[$field_name];
					}
				}
			} 
		} elseif ( $ovabrw_choose_custom_checkout_field == 'all' ) {
			$list_ckf_output = $list_field_checkout;
		} elseif( $ovabrw_choose_custom_checkout_field == 'special' ) {
			if ( $ovabrw_custom_checkout_field ) {
				foreach( $ovabrw_custom_checkout_field as $field_name ) {
					if ( array_key_exists( $field_name, $list_field_checkout ) ) {
						$list_ckf_output[$field_name] = $list_field_checkout[$field_name];
					}
				}
			} else {
				$list_ckf_output = [];
			}
		} else {
			$list_ckf_output = $list_field_checkout;
		}

		return $list_ckf_output;
	}
}

// Render value in product to javascript at frontend
if ( ! function_exists( 'ovabrw_create_order_time_calendar' ) ) {
	function ovabrw_create_order_time_calendar( $post_id ) {
		if ( ! $post_id ) return [];

		$statuses 		= brw_list_order_status();
		$order_date 	= get_order_rent_time( $post_id, $statuses );
		$price_type 	= get_post_meta( $post_id, 'ovabrw_price_type', true );
		$price_calendar = [];

		if ( $price_type === 'day' ) {
			$regular_price 			= get_post_meta( $post_id, '_regular_price', true );
			$ovabrw_daily_monday 	= !empty( get_post_meta( $post_id, 'ovabrw_daily_monday', true ) ) ? (float)get_post_meta( $post_id, 'ovabrw_daily_monday', true ) : (float)$regular_price;
			$ovabrw_daily_tuesday 	= !empty( get_post_meta( $post_id, 'ovabrw_daily_tuesday', true ) ) ? (float)get_post_meta( $post_id, 'ovabrw_daily_tuesday', true ) : (float)$regular_price;
			$ovabrw_daily_wednesday = !empty( get_post_meta( $post_id, 'ovabrw_daily_wednesday', true ) ) ? (float)get_post_meta( $post_id, 'ovabrw_daily_wednesday', true ) : (float)$regular_price;
			$ovabrw_daily_thursday 	= !empty( get_post_meta( $post_id, 'ovabrw_daily_thursday', true ) ) ? (float)get_post_meta( $post_id, 'ovabrw_daily_thursday', true ) : (float)$regular_price;
			$ovabrw_daily_friday 	= !empty( get_post_meta( $post_id, 'ovabrw_daily_friday', true ) ) ?  (float)get_post_meta( $post_id, 'ovabrw_daily_friday', true ) : (float)$regular_price;
			$ovabrw_daily_saturday 	= !empty( get_post_meta( $post_id, 'ovabrw_daily_saturday', true ) ) ? (float)get_post_meta( $post_id, 'ovabrw_daily_saturday', true ) : (float)$regular_price;
			$ovabrw_daily_sunday 	= !empty( get_post_meta( $post_id, 'ovabrw_daily_sunday', true ) ) ? (float)get_post_meta( $post_id, 'ovabrw_daily_sunday', true ) : (float)$regular_price;

			$price_calendar = [
				[
					'type_price' => 'day',
				],
				[
					'ovabrw_daily_monday' 		=> wc_price_calendar( $ovabrw_daily_monday ),
					'ovabrw_daily_tuesday' 		=> wc_price_calendar( $ovabrw_daily_tuesday ),
					'ovabrw_daily_wednesday' 	=> wc_price_calendar( $ovabrw_daily_wednesday ),
					'ovabrw_daily_thursday' 	=> wc_price_calendar( $ovabrw_daily_thursday ),
					'ovabrw_daily_friday' 		=> wc_price_calendar( $ovabrw_daily_friday ),
					'ovabrw_daily_saturday' 	=> wc_price_calendar( $ovabrw_daily_saturday ),
					'ovabrw_daily_sunday' 		=> wc_price_calendar( $ovabrw_daily_sunday ),
				],
			];

		} elseif ( $price_type === 'hour' ) {
			$regular_price_hour = get_post_meta( $post_id, 'ovabrw_regul_price_hour', true );

			$price_calendar = [
				[
					'type_price' => 'hour',
				],
				[
					'ovabrw_price_hour' => wc_price_calendar( $regular_price_hour ),
				],
			];
		} elseif ( $price_type === 'mixed' ) {
			$regular_price_day  	= get_post_meta( $post_id, '_regular_price', true );
			$regular_price_hour 	= get_post_meta( $post_id, 'ovabrw_regul_price_hour', true );
			$ovabrw_daily_monday 	= !empty( get_post_meta( $post_id, 'ovabrw_daily_monday', true ) ) ? (float)get_post_meta( $post_id, 'ovabrw_daily_monday', true ) : (float)$regular_price_day;
			$ovabrw_daily_tuesday 	= !empty( get_post_meta( $post_id, 'ovabrw_daily_tuesday', true ) ) ? (float)get_post_meta( $post_id, 'ovabrw_daily_tuesday', true ) : (float)$regular_price_day;
			$ovabrw_daily_wednesday = !empty( get_post_meta( $post_id, 'ovabrw_daily_wednesday', true ) ) ? (float)get_post_meta( $post_id, 'ovabrw_daily_wednesday', true ) : (float)$regular_price_day;
			$ovabrw_daily_thursday 	= !empty( get_post_meta( $post_id, 'ovabrw_daily_thursday', true ) ) ? (float)get_post_meta( $post_id, 'ovabrw_daily_thursday', true ) : (float)$regular_price_day;
			$ovabrw_daily_friday 	= !empty( get_post_meta( $post_id, 'ovabrw_daily_friday', true ) ) ?  (float)get_post_meta( $post_id, 'ovabrw_daily_friday', true ) : (float)$regular_price_day;
			$ovabrw_daily_saturday 	= !empty( get_post_meta( $post_id, 'ovabrw_daily_saturday', true ) ) ? (float)get_post_meta( $post_id, 'ovabrw_daily_saturday', true ) : (float)$regular_price_day;
			$ovabrw_daily_sunday 	= !empty( get_post_meta( $post_id, 'ovabrw_daily_sunday', true ) ) ? (float)get_post_meta( $post_id, 'ovabrw_daily_sunday', true ) : (float)$regular_price_day;

			$price_calendar = [
				[
					'type_price' => 'mixed',
				],
				[
					'ovabrw_daily_monday' 		=> wc_price_calendar( $regular_price_hour ) . '<br>' . wc_price_calendar( $ovabrw_daily_monday ),
					'ovabrw_daily_tuesday' 		=> wc_price_calendar( $regular_price_hour )  . '<br>' . wc_price_calendar( $ovabrw_daily_tuesday ),
					'ovabrw_daily_wednesday' 	=> wc_price_calendar( $regular_price_hour ) . '<br>' . wc_price_calendar( $ovabrw_daily_wednesday ),
					'ovabrw_daily_thursday' 	=> wc_price_calendar( $regular_price_hour ) . '<br>' . wc_price_calendar( $ovabrw_daily_thursday ),
					'ovabrw_daily_friday' 		=> wc_price_calendar( $regular_price_hour ) . '<br>' . wc_price_calendar( $ovabrw_daily_friday ),
					'ovabrw_daily_saturday' 	=> wc_price_calendar( $regular_price_hour ) . '<br>' . wc_price_calendar( $ovabrw_daily_saturday ),
					'ovabrw_daily_sunday' 		=> wc_price_calendar( $regular_price_hour ) . '<br>' . wc_price_calendar( $ovabrw_daily_sunday ),
				],
			];
		}
		
		if ( apply_filters( 'ovabrw_show_price_calendar', true ) == false ) {
			$price_calendar = [];
		}
		
		if ( $order_date && $order_date != '[]' ) {
			return array( 'order_time' =>  $order_date, 'price_calendar' => json_encode( $price_calendar ) );
		} else {
			return array( 'order_time' => '', 'price_calendar' => json_encode( $price_calendar ) );
		}
	}
}

// Get Deposit Type HTML in Product
if ( ! function_exists( 'ovabrw_p_deposit_type' ) ) {
	function ovabrw_p_deposit_type( $product_id ) {
		$deposit_type 	= get_post_meta ( $product_id, 'ovabrw_type_deposit', true );
		$deposit_value 	= get_post_meta ( $product_id, 'ovabrw_amount_deposit', true );

		if ( $deposit_type === 'percent' ) {
			return '<span>'.esc_html($deposit_value).'%</span>';
		} elseif ($deposit_type === 'value') {
			return '<span>'.wc_price($deposit_value).'</span>';
		}
	}
}

// Get price array of weekdays
if ( ! function_exists( 'ovabrw_p_weekdays' ) ) {
	function ovabrw_p_weekdays( $product_id ) {
		$price_day = get_post_meta( $product_id, '_regular_price', true );

		$daily_monday_price 	= !empty( get_post_meta( $product_id, 'ovabrw_daily_monday', true ) ) ? get_post_meta( $product_id, 'ovabrw_daily_monday', true ) : $price_day;
		$daily_tuesday_price 	= !empty( get_post_meta( $product_id, 'ovabrw_daily_tuesday', true ) ) ? get_post_meta( $product_id, 'ovabrw_daily_tuesday', true ) : $price_day;
		$daily_wednesday_price 	= !empty( get_post_meta( $product_id, 'ovabrw_daily_wednesday', true ) ) ? get_post_meta( $product_id, 'ovabrw_daily_wednesday', true ) : $price_day;
		$daily_thursday_price 	= !empty( get_post_meta( $product_id, 'ovabrw_daily_thursday', true ) ) ? get_post_meta( $product_id, 'ovabrw_daily_thursday', true ) : $price_day;
		$daily_friday_price 	= !empty( get_post_meta( $product_id, 'ovabrw_daily_friday', true ) ) ? get_post_meta( $product_id, 'ovabrw_daily_friday', true ) : $price_day;
		$daily_saturday_price 	= !empty( get_post_meta( $product_id, 'ovabrw_daily_saturday', true ) ) ? get_post_meta( $product_id, 'ovabrw_daily_saturday', true ) : $price_day;
		$daily_sunday_price 	= !empty( get_post_meta( $product_id, 'ovabrw_daily_sunday', true ) ) ? get_post_meta( $product_id, 'ovabrw_daily_sunday', true ) : $price_day;

		$daily = array(
			'monday' 	=> $daily_monday_price, 
			'tuesday' 	=> $daily_tuesday_price, 
			'wednesday' => $daily_wednesday_price, 
			'thursday' 	=> $daily_thursday_price, 
			'friday' 	=> $daily_friday_price, 
			'saturday' 	=> $daily_saturday_price, 
			'sunday' 	=> $daily_sunday_price
		);

		return $daily;
	}
}

// List Order Status 
if ( ! function_exists( 'brw_list_order_status' ) ) {
	function brw_list_order_status() {
		return apply_filters( 'brw_list_order_status', array( 'wc-completed', 'wc-processing' ) );
	}
}

if ( ! function_exists( 'ovabrw_get_total_stock' ) ) {
	function ovabrw_get_total_stock( $product_id ) {
		$ovabrw_manage_store 	= get_post_meta( $product_id, 'ovabrw_manage_store', true );
		$number_stock 			= 1;

		if ( $ovabrw_manage_store == 'store' ) {
			$number_stock = (int)get_post_meta( $product_id, 'ovabrw_car_count', true );
			
			return $number_stock;
		} elseif ( $ovabrw_manage_store == 'id_vehicle' ) {
			$ovabrw_id_vehicles = get_post_meta( $product_id, 'ovabrw_id_vehicles', true );
			$number_stock 		=  $ovabrw_id_vehicles ? count( $ovabrw_id_vehicles ) : 0;

			return $number_stock;
		}

		return $number_stock;
	}
}

if ( ! function_exists( 'ovabrw_createDatefull' ) ) {
	function ovabrw_createDatefull( $start = '', $end = '', $format = "Y-m-d H:i" ){
		$dates = array();

		while( $start <= $end ) {
			array_push( $dates, date( $format, $start) );
			$start += 86400;
		}

		return $dates;
	} 
}

if ( ! function_exists( 'total_between_2_days' ) ) {
	function total_between_2_days( $start, $end ) {
		return floor( abs( strtotime( $end ) - strtotime( $start ) ) / ( 60*60*24 ) );
	}
}

// You have to insert unistamp time
if ( ! function_exists( 'get_time_bew_2day' ) ) {
	function get_time_bew_2day( $start = '', $end = '', $product_id = '' ) {
		$start 	= $start == '' ? null : $start;
		$end 	= $end == '' ? null : $end;

		$defined_one_day = $product_id != '' ? defined_one_day( $product_id ) : '';    

		if ( $defined_one_day === 'day' ) {
			$start = strtotime( date( 'Y-m-d', $start ) );
			$end = strtotime( date('Y-m-d', $end ) ) + 24*60*60 - 1  ;
		} elseif ( $defined_one_day === 'hotel' ) {
			$start = strtotime( date( 'Y-m-d', $start ) );
			$end = strtotime( date('Y-m-d', $end ) ) ;
		}

		$rent_time_day_raw 	= ( $end - $start )/(24*60*60);
		$rent_time_hour_raw = ( $end - $start )/(60*60);
		$rent_time_day 		= ceil( $rent_time_day_raw );
		$rent_time_hour 	= ceil( $rent_time_hour_raw );

		return array( 'rent_time_day_raw' => $rent_time_day_raw, 'rent_time_hour_raw' => $rent_time_hour_raw, 'rent_time_day' => $rent_time_day, 'rent_time_hour' => $rent_time_hour );
	}
}

if ( ! function_exists( 'ovabrw_array_flatten' ) ) {
	function ovabrw_array_flatten( $array ) {
		if ( ! is_array( $array ) ) { 
			return FALSE; 
		} 

		$result = array(); 
		foreach( $array as $key => $value ) { 
			if ( is_array( $value ) ) { 
				$result = array_merge($result, ovabrw_array_flatten($value)); 
			} else { 
				$result[$key] = $value; 
			} 
		} 

		return $result; 
	}
}

if ( ! function_exists( 'ovabrw_pagination_theme' ) ) {
	function ovabrw_pagination_theme( $ovabrw_query = null ) {
		/** Stop execution if there's only 1 page */
		if ( $ovabrw_query != null ) {
			if ( $ovabrw_query->max_num_pages <= 1 ) return; 
		} elseif ( $wp_query->max_num_pages <= 1 ) {
			return;
		}

		$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;

		if ( $ovabrw_query != null ) {
			$max = intval( $ovabrw_query->max_num_pages );
		} else {
			$max = intval( $wp_query->max_num_pages );    
		}
		
		/** Add current page to the array */
		if ( $paged >= 1 ) $links[] = $paged;

		/** Add the pages around the current page to the array */
		if ( $paged >= 3 ) {
			$links[] = $paged - 1;
			$links[] = $paged - 2;
		}

		if ( ( $paged + 2 ) <= $max ) {
			$links[] = $paged + 2;
			$links[] = $paged + 1;
		}

		echo '<nav class="woocommerce-pagination"><ul class="page-numbers">' . "\n";

		/** Previous Post Link */
		if ( get_previous_posts_link() )
			printf( '<li class="prev page-numbers">%s</li>' . "\n", get_previous_posts_link('<i class="arrow_carrot-left"></i>') );

		/** Link to first page, plus ellipses if necessary */
		if ( !in_array( 1, $links ) ) {
			$class = $paged == 1 ? ' class="current"' : 'page-numbers';
			printf( '<li><a href="%s" %s>%s</a></li>' . "\n",  esc_url( get_pagenum_link( 1 ) ), $class, '1' );

			if ( !in_array( 2, $links ) )
				echo '<li>...</li>';
		}

		/** Link to current page, plus 2 pages in either direction if necessary */
		sort( $links );
		foreach( (array)$links as $link ) {
			$class = $paged == $link ? ' class="current"' : '';
			printf( '<li><a href="%s" %s>%s</a></li>' . "\n",  esc_url( get_pagenum_link( $link ) ), $class, $link );
		}

		/** Link to last page, plus ellipses if necessary */
		if ( !in_array( $max, $links ) ) {
			if ( !in_array( $max - 1, $links ) )
				echo '<li>...</li>' . "\n";

			$class = $paged == $max ? ' class="current"' : '';
			printf( '<li><a href="%s" %s>%s</a></li>' . "\n",  esc_url( get_pagenum_link( $max ) ), $class, $max );
		}

		/** Next Post Link */
		if ( get_next_posts_link() )
			printf( '<li class="next page-numbers">%s</li>' . "\n", get_next_posts_link('<i class="arrow_carrot-right"></i>') );
		echo '</ul></nav>' . "\n";
	}
}

if ( ! function_exists( 'ovabrw_get_real_date' ) ) {
	function ovabrw_get_real_date( $product_id, $rental_type, $defined_one_day, $ovabrw_pickup_date, $ovabrw_dropoff_date ) {
		$date_format = ovabrw_get_date_format();

		if ( $rental_type === 'transportation' ) {
			$dropoff_date_by_setting = get_post_meta( $product_id, 'ovabrw_dropoff_date_by_setting', true );
			if ( $dropoff_date_by_setting != 'yes' ) {
				$ovabrw_pickup_date_timestamp 	= strtotime( $ovabrw_pickup_date );
				$ovabrw_pickup_date_real 		= date( $date_format, $ovabrw_pickup_date_timestamp ) . ' 00:00';
				$ovabrw_dropoff_date_real 		= date( $date_format, $ovabrw_pickup_date_timestamp ) . ' 24:00';
			} else {
				$ovabrw_pickup_date_real 	= $ovabrw_pickup_date;
				$ovabrw_dropoff_date_real 	= $ovabrw_dropoff_date;
			}
		}
		
		if ( $defined_one_day == 'hotel' ) {
			$ovabrw_pickup_date_timestamp 	= strtotime( $ovabrw_pickup_date );
			$ovabrw_dropoff_date_timestamp 	= strtotime( $ovabrw_dropoff_date );
			$ovabrw_pickup_date 			= date($date_format, $ovabrw_pickup_date_timestamp);
			$ovabrw_dropoff_date 			= date($date_format, $ovabrw_dropoff_date_timestamp);
			$ovabrw_pickup_date_timestamp 	= strtotime( $ovabrw_pickup_date );
			$ovabrw_dropoff_date_timestamp 	= strtotime( $ovabrw_dropoff_date );
			$ovabrw_pickup_date_real 		= date( $date_format, $ovabrw_pickup_date_timestamp ) .' '. apply_filters( 'brw_real_pickup_time_hotel', '14:00' );
			$ovabrw_dropoff_date_real 		= date(  $date_format, $ovabrw_dropoff_date_timestamp ) .' '. apply_filters( 'brw_real_dropoff_time_hotel', '11:00' );
		} elseif ( $defined_one_day == 'day' ) {
			$ovabrw_pickup_date_timestamp 	= strtotime( $ovabrw_pickup_date );
			$ovabrw_dropoff_date_timestamp 	= strtotime( $ovabrw_dropoff_date );
			$ovabrw_pickup_date_real 		= date( $date_format, $ovabrw_pickup_date_timestamp ) . ' 00:00';
			$ovabrw_dropoff_date_real 		= date( $date_format, $ovabrw_dropoff_date_timestamp ) . ' 24:00';
		} elseif ( $defined_one_day == 'hour' ) {
	        //fixed later
			$ovabrw_pickup_date_real 	= $ovabrw_pickup_date;
			$ovabrw_dropoff_date_real 	= $ovabrw_dropoff_date;
		}

		if ( $rental_type === 'hour' || $rental_type === 'mixed' || $rental_type === 'period_time' ) {
			$ovabrw_pickup_date_real 	= $ovabrw_pickup_date;
			$ovabrw_dropoff_date_real 	= $ovabrw_dropoff_date;
		}

		return array( 'pickup_date_real' => $ovabrw_pickup_date_real, 'dropoff_date_real' => $ovabrw_dropoff_date_real );
	}
}

// Display price in calendar
if ( ! function_exists( 'wc_price_calendar' ) ) {
	function wc_price_calendar( $price ) {
		return wc_price( 
			$price, 
			apply_filters( 
				'wc_price_calendar_args', 
				array(
					'ex_tax_label'       => false,
					'currency'           => '',
					'decimal_separator'  => wc_get_price_decimal_separator(),
					'thousand_separator' => wc_get_price_thousand_separator(),
					'decimals'           => wc_get_price_decimals(),
					'price_format'       => get_woocommerce_price_format(),
				) 
			) 
		);
	}
}

// Get Array Product ID with WPML
if ( ! function_exists( 'ovabrw_get_wpml_product_ids' ) ) {
	function ovabrw_get_wpml_product_ids( $product_id_original ) {
		$translated_ids = array();

		// get plugin active
		$active_plugins = get_option('active_plugins');

		if ( in_array ( 'polylang/polylang.php', $active_plugins ) || in_array ( 'polylang-pro/polylang.php', $active_plugins ) ) {
			$languages = pll_languages_list();
			if ( !isset( $languages ) ) return;
			foreach ($languages as $lang) {
				$translated_ids[] = pll_get_post($product_id_original, $lang);
			}
		} elseif ( in_array ( 'sitepress-multilingual-cms/sitepress.php', $active_plugins ) ) {
			global $sitepress;
			
			if ( !isset( $sitepress ) ) return;
			
			$trid 			= $sitepress->get_element_trid($product_id_original, 'post_product');
			$translations 	= $sitepress->get_element_translations($trid, 'product');

			foreach( $translations as $lang => $translation ) {
				$translated_ids[] = $translation->element_id;
			}
		} else {
			$translated_ids[] = $product_id_original;
		}

		if ( empty( $translated_ids ) ) {
			$translated_ids[] = $product_id_original;
		}

		return apply_filters( 'ovabrw_multiple_languages', $translated_ids );
	}
}

// Get Pick up date from URL in Product detail
if ( ! function_exists( 'ovabrw_get_current_date_from_search' ) ) {
	function ovabrw_get_current_date_from_search( $choose_hour = 'yes', $type = 'pickup_date', $product_id = false ) {
		// Get date from URL
		if ( $type == 'pickup_date' ) {
			$time = isset( $_GET['ovabrw_pickup_date'] ) ? strtotime( $_GET['ovabrw_pickup_date'] ) : '';
		} elseif ( $type == 'dropoff_date' ) {
			$time = ( isset( $_GET['ovabrw_dropoff_date'] ) ) ? strtotime( $_GET['ovabrw_dropoff_date'] ) : '';
		}

		$dateformat 	= ovabrw_get_date_format();
		$time_format 	= ovabrw_get_time_format_php();

		if ( $time && $choose_hour == 'yes' ) {
			return date( $dateformat.' '.$time_format, $time );
		} elseif ( $time && $choose_hour == 'no' ) {
			return date( $dateformat, $time );		
		}

		return '';
	}
}

// Get All custom taxonomy display in listing of product
if ( ! function_exists( 'get_all_cus_tax_dis_listing' ) ) {
	function get_all_cus_tax_dis_listing( $pid ) {
		$all_cus_choosed 		= array();
		$all_cus_choosed_tmp 	= array();

		// Get All Categories of this product
		$categories = get_the_terms( $pid, 'product_cat' );
		if ( $categories ) {
			foreach( $categories as $key => $value ) {
				$cat_id = $value->term_id;

				// Get custom tax display in category
				$ovabrw_custom_tax = get_term_meta($cat_id, 'ovabrw_custom_tax', true);

				if ( $ovabrw_custom_tax ) {
					foreach( $ovabrw_custom_tax as $slug_tax ) {
						
						// Get value of terms in product
						$terms = get_the_terms( $pid, $slug_tax );

						// Get option: custom taxonomy
						$ovabrw_custom_taxonomy =  get_option( 'ovabrw_custom_taxonomy', '' );
						$show_listing_status 	= 'no';

						if ( $ovabrw_custom_taxonomy ) {
							foreach( $ovabrw_custom_taxonomy as $slug => $value ) {
								if ( $slug_tax == $slug && isset( $value['show_listing'] ) && $value['show_listing'] == 'on' ) {
									$show_listing_status = 'yes';
									break;
								}
							}
						}
						if ( $terms && $show_listing_status == 'yes' ) {
							foreach( $terms as $term ) {
								if ( !in_array( $slug_tax, $all_cus_choosed_tmp ) ) {
									// Assign array temp to check exist
									array_push($all_cus_choosed_tmp, $slug_tax);
									array_push($all_cus_choosed, array( 'slug' => $slug_tax, 'name' => $term->name) );
								}
							}
						}
					}
				}
			}
		}

		return $all_cus_choosed;
	}
}

// Get custom taxonomy of an product
if ( ! function_exists( 'ovabrw_get_taxonomy_choosed_product' ) ) {
	function ovabrw_get_taxonomy_choosed_product( $pid ) {
		// Custom taxonomies choosed in post
		$all_cus_tax 	= array();
		$exist_cus_tax 	= array();
		
		// Get Category of product
		$cats = get_the_terms( $pid, 'product_cat' );
		$show_taxonomy_depend_category = ovabrw_get_setting( get_option( 'ova_brw_search_show_tax_depend_cat', 'yes' ) );

		if ( 'yes' == $show_taxonomy_depend_category ) {
			if ( $cats ) {
				foreach( $cats as $key => $cat ) {
					// Get custom taxonomy display in category
					$ovabrw_custom_tax = get_term_meta($cat->term_id, 'ovabrw_custom_tax', true);	
					
					if ( $ovabrw_custom_tax ) {
						foreach( $ovabrw_custom_tax as $key => $value ) {
							array_push( $exist_cus_tax, $value );
						}	
					}
				}
			}

			if ( $exist_cus_tax ) {
				foreach( $exist_cus_tax as $key => $value ) {
					$cus_tax_terms = get_the_terms( $pid, $value );

					if ( $cus_tax_terms ) {
						foreach( $cus_tax_terms as $key => $value ) {
							$list_fields = get_option( 'ovabrw_custom_taxonomy', array() );

							if ( !empty( $list_fields ) ):
								foreach( $list_fields as $key => $field ): 
									if ( is_object($value) && $value->taxonomy == $key ) {
										if ( array_key_exists($key, $all_cus_tax) ) {
											if ( !in_array( $value->name, $all_cus_tax[$key]['value'] ) ) {
												array_push($all_cus_tax[$key]['value'], $value->name);	
											}
										} else {
											if ( isset( $field['label_frontend'] ) && $field['label_frontend'] ) {
												$all_cus_tax[$key]['name'] = $field['label_frontend'];	
											} else {
												$all_cus_tax[$key]['name'] = $field['name'];	
											}
											$all_cus_tax[$key]['value'] = array( $value->name );
										}
										break;
									}
								endforeach;
							endif;
						}
					}
				}
			}
		} else {
			$list_fields = get_option( 'ovabrw_custom_taxonomy', array() );

			if ( !empty( $list_fields ) ) {
				foreach( $list_fields as $key => $field ) {
					$terms = get_the_terms( $pid, $key );

					if ( $terms && !isset( $terms->errors ) ) {
						foreach( $terms as $value ) {
							if ( is_object( $value ) ) {
								if ( array_key_exists( $key, $all_cus_tax ) ) {
									if ( ! in_array( $value->name, $all_cus_tax[$key]['value'] ) ) {
										array_push($all_cus_tax[$key]['value'], $value->name);	
									}
								} else {
									if ( isset( $field['label_frontend'] ) && $field['label_frontend'] ) {
										$all_cus_tax[$key]['name'] = $field['label_frontend'];	
									} else {
										$all_cus_tax[$key]['name'] = $field['name'];
									}

									$all_cus_tax[$key]['value'] = array( $value->name );
								}
							}
						}
					}
				}
			}
		}

		return $all_cus_tax;
	}
}

// Get Special Time Product
if ( ! function_exists( 'ovabrw_get_special_time' ) ) {
	function ovabrw_get_special_time( $product_id, $price_type ) {
		// init array special time
		$special_time = [];
		$prices = [];

		// get special price
		if ( $price_type == 'day' ) {
			$ovabrw_rt_price = get_post_meta( $product_id, 'ovabrw_rt_price', true );
		} elseif ( $price_type == 'hour' ) {
			$ovabrw_rt_price = get_post_meta( $product_id, 'ovabrw_rt_price_hour', true );
		} elseif ( $price_type == 'mixed' ) {
			$ovabrw_rt_price  = get_post_meta( $product_id, 'ovabrw_rt_price', true );
			$ovabrw_rt_price_hour = get_post_meta( $product_id, 'ovabrw_rt_price_hour', true );
		}

		// get timestamp
		$ovabrw_start_timestamp = get_post_meta( $product_id, 'ovabrw_start_timestamp', true );
		$ovabrw_end_timestamp 	= get_post_meta( $product_id, 'ovabrw_end_timestamp', true );

		if ( !empty( $ovabrw_rt_price ) ) {
			foreach( $ovabrw_rt_price as $key => $value ) {
				// start timestamp
				$start_timestamp = array_key_exists( $key, $ovabrw_start_timestamp ) ? strtotime( gmdate( 'Y-m-d', $ovabrw_start_timestamp[$key] ) ) : 0;

				// end timestamp
				$end_timestamp 	= array_key_exists( $key, $ovabrw_end_timestamp ) ? strtotime( gmdate( 'Y-m-d', $ovabrw_end_timestamp[$key] ) ) : 0;

				// check price type
				if ( $price_type == 'mixed' ) {
					$price_mixed = array_key_exists( $key, $ovabrw_rt_price_hour ) ? ( wc_price_calendar($ovabrw_rt_price_hour[$key]) . '<br>' . wc_price_calendar($value) ) : ( wc_price_calendar(0) . '<br>' . wc_price_calendar($value) );

					if ( in_array( $value, $prices ) ) {
						$special_time[$price_mixed.'<span hidden>'.$key.'</span>'] = [ $start_timestamp, $end_timestamp ];
					} else {
						$special_time[$price_mixed] = [ $start_timestamp, $end_timestamp ];
						array_push($prices, $value);
					}
				} else {
					if ( in_array( $value, $prices ) ) {
						$special_time[wc_price_calendar($value).'<span hidden>'.$key.'</span>'] = [ $start_timestamp, $end_timestamp ];
					} else {
						$special_time[wc_price_calendar($value)] = [ $start_timestamp, $end_timestamp ];
						array_push($prices, $value);
					}
				}
			}
		}
		
		return $special_time;
	}
}

// Get product template
if ( ! function_exists( 'ovabrw_get_product_template' ) ) {
	function ovabrw_get_product_template( $id ) {
		$template = get_option( 'ova_brw_template_elementor_template', 'default' );

		if ( empty( $id ) ) {
			return $template;
		}

		$products 	= wc_get_product( $id );
		$categories = $products->get_category_ids();

		if ( !empty( $categories ) ) {
			$term_id 	= reset( $categories );
			$template_by_category = get_term_meta( $term_id, 'ovabrw_product_templates', true );

			if ( $template_by_category && $template_by_category != 'global' ) {
				$template = $template_by_category;
			}
		}

		return $template;
	}
}

// Check locations
if ( ! function_exists( 'ovabrw_check_location' ) ) {
	function ovabrw_check_location( $product_id = null, $pickup_loc = '', $dropoff_loc = '' ) {
		if ( ! $product_id ) return false;

		$data_pickup_loc 	= get_post_meta( $product_id, 'ovabrw_st_pickup_loc', true );
		$data_dropoff_loc 	= get_post_meta( $product_id, 'ovabrw_st_dropoff_loc', true );

		if ( ! empty( $data_pickup_loc ) && is_array( $data_pickup_loc ) ) {
			foreach( $data_pickup_loc as $k => $loc ) {
				if ( $loc === $pickup_loc && isset( $data_dropoff_loc[$k] ) && $data_dropoff_loc[$k] === $dropoff_loc ) {
					return true;
				}
			}
		} else {
			return true;
		}

		return false;
	}
}

// Check key in array
if ( ! function_exists( 'ovabrw_check_array' ) ) {
	function ovabrw_check_array( $args, $key ) {
		if ( ! empty( $args ) && is_array( $args ) ) {
			if ( isset( $args[$key] ) && $args[$key] ) {
				return true;
			}
		}

		return false;
	}
}

if ( ! function_exists('ovabrw_limit_words') ) {
	function ovabrw_limit_words($string, $word_limit) {
		$string = strip_tags($string);
		$words 	= explode(' ', strip_tags($string));
		$return = trim(implode(' ', array_slice($words, 0, $word_limit)));
		if(strlen($return) < strlen($string)){
			$return .= '..';
		}
		return $return;
	}
}
