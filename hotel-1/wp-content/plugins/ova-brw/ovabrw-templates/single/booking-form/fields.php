<?php
/**
 * The template for displaying fields in booking form within single
 *
 * This template can be overridden by copying it to yourtheme/ovabrw-templates/single/booking-form/fields.php
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit();

// Get product_id from do_action - use when insert shortcode
if ( isset( $args['product_id'] ) && $args['product_id'] ){
	$pid = $args['product_id'];
} else {
	$pid = get_the_id();
}

$ovabrw_rental_type 	= get_post_meta( $pid, 'ovabrw_price_type', true );
$defined_one_day 		= defined_one_day( $pid );
$class_no_time_picker 	= $defined_one_day == 'hotel' ? 'no_time_picker' : '';
$time_to_book_start 	= ovabrw_time_to_book( $pid, 'start' );
$time_to_book_end 		= ovabrw_time_to_book( $pid, 'end' );
$default_hour_start 	= ovabrw_get_default_time( $pid, 'start' );
$default_hour_end 		= ovabrw_get_default_time( $pid, 'end' );
$timepicker_start 		= ovabrw_timepicker_product( $pid, 'start' );
$timepicker_end 		= ovabrw_timepicker_product( $pid, 'end' );
$show_pickup_date 		= ovabrw_show_pick_date_product( $pid, $type = 'pickup' );
$show_dropoff_date 		= ovabrw_show_pick_date_product( $pid, $type = 'dropoff' );
$show_number_vehicle 	= ovabrw_show_number_vehicle( $pid );
$disable_week_day 		= get_post_meta( $pid, 'ovabrw_product_disable_week_day', true );
$dropoff_date_by_setting = get_post_meta( $pid, 'ovabrw_dropoff_date_by_setting', true );

// Get booked time
$statuses 	= brw_list_order_status();
$order_time = get_order_rent_time( $pid, $statuses );
$dateformat = ovabrw_get_date_format();
$placeholder_date 			= ovabrw_get_placeholder_date();
$class_date_picker_period 	= $ovabrw_rental_type == 'period_time' ? 'no_time_picker' : '';
$ovabrw_unfixed_time 		= get_post_meta( $pid, 'ovabrw_unfixed_time', true );

$startdate_perido_time = '';

if ( ( $ovabrw_rental_type == 'period_time' ) ) {
	$startdate_perido_time = 'startdate_perido_time';

	if ( $ovabrw_unfixed_time == 'yes' ) {
		$class_date_picker_period = '';
	} 
}

// Get Date, Location from URl
$choose_hour_pickup 	= $class_date_picker_period == 'no_time_picker' || $class_no_time_picker == 'no_time_picker' ? 'no' : 'yes';
$choose_hour_dropoff 	= $class_no_time_picker == 'no_time_picker' ? 'no' : 'yes';
$pickup_date 	= ovabrw_get_current_date_from_search( $choose_hour_pickup, 'pickup_date', $pid );
$dropoff_date 	= ovabrw_get_current_date_from_search( $choose_hour_dropoff, 'dropoff_date', $pid );

// Get first day in week
$first_day = get_option( 'ova_brw_calendar_first_day', '0' );

if ( empty( $first_day ) ) {
	$first_day = 0;
}

// Get categories
$terms = wp_get_post_terms( $pid,'product_cat',array('fields'=>'ids') );
if ( $terms && is_array( $terms ) ) {
	$term_id = reset($terms);
}

// Get label pick-up and pick-off date
$label_pickup_date 			= esc_html__( 'Check-in', 'ova-brw');
$setting_lable_pickup_date 	= get_post_meta( $pid, 'ovabrw_label_pickup_date_product', true );

if ( $setting_lable_pickup_date == 'new' ) {
	$label_pickup_date = get_post_meta( $pid, 'ovabrw_new_pickup_date_product', true );
} elseif ( $setting_lable_pickup_date == 'category' ) {
	$label_pickup_date 	= isset( $term_id ) ? get_term_meta( $term_id, 'ovabrw_lable_pickup_date', true ) : esc_html__( 'Check-in', 'ova-brw');
} else {
	$label_pickup_date = esc_html__( 'Check-in', 'ova-brw');
}

$label_dropoff_date 		= esc_html__( 'Check-out', 'ova-brw');
$setting_lable_dropoff_date = get_post_meta( $pid, 'ovabrw_label_dropoff_date_product', true );

if ( $setting_lable_dropoff_date == 'new' ) {
	$label_dropoff_date = get_post_meta( $pid, 'ovabrw_new_dropoff_date_product', true );
} elseif ( $setting_lable_dropoff_date == 'category' ) {
	$label_dropoff_date = isset( $term_id ) ? get_term_meta( $term_id, 'ovabrw_lable_dropoff_date', true ) : esc_html__( 'Check-out', 'ova-brw');
} else {
	$label_dropoff_date = esc_html__( 'Check-out', 'ova-brw');
}

if ( $label_pickup_date == '' ) {
	$label_pickup_date  = esc_html__( 'Check-in', 'ova-brw');
}
if ( $label_dropoff_date == '' ) {
	$label_dropoff_date  = esc_html__( 'Check-out', 'ova-brw');
}

// Guest 
$max_adults 	= get_post_meta( $pid, 'ovabrw_adult_number', true );
$max_childrens 	= get_post_meta( $pid, 'ovabrw_children_number', true );

$number_adults 		= isset( $_GET['ovabrw_adults'] ) ? $_GET['ovabrw_adults'] : 1;
$number_childrens 	= isset( $_GET['ovabrw_childrens'] ) ? $_GET['ovabrw_childrens'] : 0;

$show_children 	= 'yes';

?>

<?php if ( $show_pickup_date ): ?>
	<div class="rental_item">
		<label>
			<?php echo $label_pickup_date; ?>
		</label>
		<div class="error_item">
			<label>
				<?php esc_html_e( 'This field is required', 'ova-brw' ) ?>
			</label>
		</div>
		<input 
			type="text" 
			name="ovabrw_pickup_date"  
			default_hour="<?php echo $default_hour_start; ?>"  
			time_to_book="<?php echo $time_to_book_start; ?>" 
			class="required ovabrw_datetimepicker ovabrw_start_date <?php echo esc_attr( $class_date_picker_period ) ?> <?php echo esc_attr( $class_no_time_picker ) ?> <?php echo esc_attr($startdate_perido_time); ?>" 
			placeholder="<?php echo esc_attr( $placeholder_date ); ?>" 
			autocomplete="off" 
			value="<?php echo $pickup_date; ?>" 
			order_time='<?php echo $order_time; ?>' 
			data-pid="<?php echo $pid; ?>"
			timepicker='<?php echo $timepicker_start; ?>' 
			data-firstday='<?php echo esc_attr( $first_day ); ?>' 
			data-disable-week-day='<?php echo esc_attr( $disable_week_day ); ?>' 
			onfocus="blur();"
		/>
	</div>
<?php endif; ?>

<?php if ( $show_dropoff_date ): ?>
	<div class="rental_item">
		<label>
			<?php echo $label_dropoff_date; ?>
		</label>
		<div class="error_item">
			<label>
				<?php esc_html_e( 'This field is required', 'ova-brw' ) ?>
			</label>
		</div>
		<input 
			type="text" 
			name="ovabrw_dropoff_date" 
			default_hour="<?php echo $default_hour_end ?>"  
			time_to_book="<?php echo $time_to_book_end ?>"  
			class="required ovabrw_datetimepicker ovabrw_end_date <?php echo esc_attr( $class_no_time_picker ) ?>" 
			placeholder="<?php echo esc_attr( $placeholder_date ); ?>"   
			autocomplete="off" 
			value="<?php echo $dropoff_date; ?>"   
			order_time='<?php echo $order_time; ?>' 
			timepicker='<?php echo $timepicker_end; ?>' 
			data-firstday='<?php echo esc_attr( $first_day ); ?>' 
			data-disable-week-day='<?php echo esc_attr( $disable_week_day ); ?>' 
			onfocus="blur();" 
		/>
	</div>
<?php endif; ?>

<?php if ( $max_adults ): ?>
	<div class="rental_item">
		<label><?php esc_html_e( 'Adults', 'ova-brw' ); ?></label>
		<div class="error_item">
			<label><?php esc_html_e( 'This field is required', 'ova-brw' ) ?></label>
		</div>
		<input type="number" class="required" name="ovabrw_adults" value="<?php esc_attr_e( $number_adults ); ?>" min="1" max="<?php echo esc_attr( $max_adults ) ?>" >
	</div>
<?php endif; ?>

<?php if ( $show_children === 'yes' ): ?>
	<div class="rental_item">
		<label><?php esc_html_e( 'Children', 'ova-brw' ); ?></label>
		<div class="error_item">
			<label><?php esc_html_e( 'This field is required', 'ova-brw' ) ?></label>
		</div>
		<input type="number" class="required" name="ovabrw_childrens" value="<?php esc_attr_e( $number_childrens ); ?>" min="0" max="<?php echo esc_attr( $max_childrens ) ?>" >
	</div>
<?php endif; ?>

<?php if ( $show_number_vehicle === 'yes' ): 
	$total_number_vehicle = ovabrw_get_total_stock( $pid );
?>
	<div class="rental_item ovabrw_number_vehicle">
		<label><?php esc_html_e( 'Quantity', 'ova-brw' ); ?></label>
		<div class="error_item">
			<label><?php esc_html_e( 'This field is required', 'ova-brw' ) ?></label>
		</div>
		<input type="number" class="required" name="ovabrw_number_vehicle" value="1" min="1" max="<?php echo esc_attr( $total_number_vehicle ) ?>" >
	</div>
<?php endif; ?>