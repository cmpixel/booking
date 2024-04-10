<?php if( ! defined( 'ABSPATH' ) ) exit();

extract( $args );

$search_template = isset($args['search_template'])  ? $args['search_template']  : '';
$show_shape	 	 = isset($args['show_shape']) 		? $args['show_shape'] 		: 'no';
if ( $show_shape === "yes" ) {
	$search_template = $search_template . ' has-shape';
}

$data_get = $_GET;

// date
$dateformat 	= ovabrw_get_date_format();
$placeholder 	= ovabrw_get_placeholder_date( $dateformat );
$hour_default 	= ovabrw_get_setting( get_option( 'ova_brw_booking_form_default_hour', '07:00' ) );
$time_step 		= ovabrw_get_setting( get_option( 'ova_brw_booking_form_step_time', '30' ) );

// form action
$action 	= home_url();
if ( isset( $args['search_result'] ) && ( 'new_page' == $args['search_result'] ) ) {
	$action = $args['search_result_url']['url'];
}

// method
$method  	= 'GET';
if ( isset( $args['method'] ) ) {
	$method = $args['method'];
}

// heading
$form_sub_heading 	= isset($args['form_sub_heading']) ? $args['form_sub_heading'] : '';
$form_heading 		= isset($args['form_heading']) ? $args['form_heading'] : '';

$check_in_label  	= $args['check_in_label'];
$icon_check_in   	= $args['icon_check_in'];
$icon_check_out   	= $args['icon_check_out'];
$check_out_label 	= $args['check_out_label'];

$button_label 	= $args['button_label'];
$adults_label 	= $args['adults_label'];
$max_adult 		= $args['max_adult'];
$min_adult 		= $args['min_adult'];

$default_adult_number 	 = isset( $data_get['ovabrw_adults'] ) 	  	? (int)$data_get['ovabrw_adults'] 		: $args['default_adult_number'];
$default_children_number = isset( $data_get['ovabrw_childrens'] ) 	? (int)$data_get['ovabrw_childrens']  	: $args['default_children_number'];
$default_bed_number 	 = isset( $data_get['ovabrw_beds'] ) 	 	? (int)$data_get['ovabrw_beds'] 		: $args['default_bed_number'];
$default_bath_number 	 = isset( $data_get['ovabrw_baths'] ) 	  	? (int)$data_get['ovabrw_baths'] 		: $args['default_bath_number'];
$ovabrw_pickup_date  	 = isset( $data_get['ovabrw_pickup_date'] ) ? sanitize_text_field( $data_get['ovabrw_pickup_date'] ) : '';
$ovabrw_dropoff_date  	 = isset( $data_get['ovabrw_dropoff_date'] ) ? sanitize_text_field( $data_get['ovabrw_dropoff_date'] ) : '';

$date_placeholder = apply_filters( 'ovabrw_ft_date_placeholder', '&#9661' );

$children_label		= $args['children_label'];
$max_children 		= $args['max_children'];
$min_children 		= $args['min_children'];
$show_children 		= $args['show_children'];

// beds
$beds_label 		= $args['beds_label'];
$max_bed 			= $args['max_bed'];
$min_bed 			= $args['min_bed'];
$show_bed 			= $args['show_bed'];

// baths
$baths_label 		= $args['baths_label'];
$max_bath 			= $args['max_bath'];
$min_bath 			= $args['min_bath'];
$show_bath 			= $args['show_bath'];

?>

<div class="ovabrw-search <?php echo esc_attr($search_template);?>">

	<form action="<?php echo esc_url( $action ); ?>" method="<?php echo esc_attr( $method ); ?>" class="ovabrw-search-form">

		<?php if( !empty($form_sub_heading) ) { ?>
			<div class="form-sub-heading">
				<?php echo esc_html($form_sub_heading);?>
			</div>
		<?php } ?>

		<?php if( !empty($form_heading) ) { ?>
			<h2 class="form-heading">
				<?php echo esc_html($form_heading);?>
			</h2>
		<?php } ?>

		<div class="ovabrw-s-field">

			<div class="search-field date-control">
				<div class="ovabrw-label">
					<?php 
					    if( $icon_check_in ) {
					    	\Elementor\Icons_Manager::render_icon( $icon_check_in, [ 'aria-hidden' => 'true' ] );
					    }     
				    ?>
					<span class="label"><?php echo esc_html( $check_in_label ); ?></span>
				</div>
				<div class="ovabrw-input">
					<input 
						type="text" 
						name="ovabrw_pickup_date" 
						value="<?php echo esc_attr( $ovabrw_pickup_date ); ?>"
						class="ovabrw_datetimepicker ovabrw_start_date" 
						placeholder="<?php echo $date_placeholder;?>" 
						autocomplete="off" 
						data-hour_default="<?php echo esc_attr( $hour_default ); ?>" 
						data-time_step="<?php echo esc_attr( $time_step ); ?>" 
						data-dateformat="<?php echo esc_attr( $dateformat ); ?>" 
						onkeydown="return false" 
						onfocus="blur();" />
				</div>
			</div>

			<div class="search-field date-control">
				<div class="ovabrw-label">
					<?php 
					    if( $icon_check_out ) {
					    	\Elementor\Icons_Manager::render_icon( $icon_check_out, [ 'aria-hidden' => 'true' ] );
					    }     
				    ?>
					<span class="label"><?php echo esc_html( $check_out_label ); ?></span>
				</div>
				<div class="ovabrw-input">
					<input 
						type="text" 
						name="ovabrw_dropoff_date"
						value="<?php echo esc_attr( $ovabrw_dropoff_date ); ?>"
						class="ovabrw_datetimepicker ovabrw_end_date" 
						placeholder="<?php echo $date_placeholder;?>" 
						autocomplete="off" 
						data-hour_default="<?php echo esc_attr( $hour_default ); ?>" 
						data-time_step="<?php echo esc_attr( $time_step ); ?>" 
						data-dateformat="<?php echo esc_attr( $dateformat ); ?>" 
						onkeydown="return false" 
						onfocus="blur();" />
				</div>
			</div>

			<div class="search-field adults-control">
				<div class="ovabrw-label">
					<span class="label"><?php echo esc_html( $adults_label ); ?></span>
				</div>
				<div class="ovabrw-input">
					<input 
						type="number" 
						id="ovabrw_adults" 
						name="ovabrw_adults" 
						class="ovabrw_adults" 
						value="<?php echo esc_attr( $default_adult_number ); ?>" 
						min="<?php echo esc_attr( $min_adult ); ?>" 
						max="<?php echo esc_attr( $max_adult ); ?>" />
				</div>
			</div>

			<?php if($show_children == 'yes') { ?>
			<div class="search-field children-control">
				<div class="ovabrw-label">
					<span class="label"><?php echo esc_html( $children_label ); ?></span>
				</div>
				<div class="ovabrw-input">
					<input 
						type="number" 
						id="ovabrw_childrens" 
						name="ovabrw_childrens" 
						class="ovabrw_childrens" 
						value="<?php echo esc_attr( $default_children_number ); ?>" 
						min="<?php echo esc_attr( $min_children ); ?>" 
						max="<?php echo esc_attr( $max_children ); ?>" />
				</div>
			</div>
			<?php } ?>

			<?php if($show_bed == 'yes') { ?>
			<div class="search-field beds-control">
				<div class="ovabrw-label">
					<span class="label"><?php echo esc_html( $beds_label ); ?></span>
				</div>

				<div class="ovabrw-input">
					<input 
						type="number" 
						id="ovabrw_beds" 
						name="ovabrw_beds" 
						class="ovabrw_beds" 
						value="<?php echo esc_attr( $default_bed_number ); ?>" 
						min="<?php echo esc_attr( $min_bed ); ?>" 
						max="<?php echo esc_attr( $max_bed ); ?>" />
				</div>
			</div>
			<?php } ?>

			<?php if($show_bath == 'yes') { ?>
			<div class="search-field baths-control">
				<div class="ovabrw-label">
					<span class="label"><?php echo esc_html( $baths_label ); ?></span>
				</div>

				<div class="ovabrw-input">
					<input 
						type="number" 
						id="ovabrw_baths" 
						name="ovabrw_baths" 
						class="ovabrw_baths" 
						value="<?php echo esc_attr( $default_bath_number ); ?>" 
						min="<?php echo esc_attr( $min_bath ); ?>" 
						max="<?php echo esc_attr( $max_bath ); ?>" />
				</div>
			</div>
			<?php } ?>

			<div class="search-field ovabrw-search-btn">
				<?php if ( isset( $args['search_result'] ) && ( 'default' == $args['search_result'] ) ): ?>
					<input type="hidden" name="ovabrw_search_product" value="ovabrw_search_product" />
	                <input type="hidden" name="ovabrw_search" value="search_item" />
	                <input type="hidden" name="post_type" value="product" />
				<?php endif; ?>
				<input type="hidden" name="ovabrw_s_clicked" value="true" />
				<button class="ovabrw-btn" type="submit">
					<?php    
					    printf( $button_label );  
					    if( $icon_button ) {
					    	\Elementor\Icons_Manager::render_icon( $icon_button, [ 'aria-hidden' => 'true' ] );
					    }  
				    ?>
				</button>
			</div>

		</div>

	</form>
	
</div>