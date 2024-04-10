<?php if( ! defined( 'ABSPATH' ) ) exit();

extract( $args );

$template   	  = $args['template'];
$posts_per_page   = $args['posts_per_page'];
$order   		  = $args['order'];
$orderby   		  = $args['orderby'];
$orderby_meta_key = '';
$args['method']   = 'POST';

// Filter Settings
$show_filter             = $args['show_filter'];
$room_found_text         = $args['room_found_text'];
$clear_filter_text       = $args['clear_filter_text'];

// Template Settings ( change icon )
$icon_adults     = json_encode($args['icon_adults']);
$icon_children   = json_encode($args['icon_children']);
$icon_area       = json_encode($args['icon_area']);
$icon_beds       = json_encode($args['icon_beds']);
$icon_baths      = json_encode($args['icon_baths']);

$clicked = isset($_GET['ovabrw_s_clicked']) ? $_GET['ovabrw_s_clicked'] : '';

?>


<div class="ovabrw-search-ajax">
	<div class="wrap-search-ajax wrap-search-ajax-<?php echo esc_attr( $template ); ?>"
	 	data-adults="<?php echo esc_attr( $args['default_adult_number'] ) ;?>"
	    data-childrens="<?php echo esc_attr( $args['default_children_number'] ) ;?>"
	    data-beds="<?php echo esc_attr( $args['default_bed_number'] ) ;?>"
	    data-baths="<?php echo esc_attr( $args['default_bath_number'] ) ;?>"  
	    data-icon_adults="<?php echo esc_attr( $icon_adults ) ;?>"
	    data-icon_children="<?php echo esc_attr( $icon_children ) ;?>"
	    data-icon_area="<?php echo esc_attr( $icon_area ) ;?>"
	    data-icon_beds="<?php echo esc_attr( $icon_beds ) ;?>"
	    data-icon_baths="<?php echo esc_attr( $icon_baths ) ;?>"
		data-template="<?php echo esc_attr( $template ) ;?>"
		data-field_1="<?php echo esc_attr( $field_1 ) ;?>"
		data-field_2="<?php echo esc_attr( $field_2 ) ;?>"
		data-field_3="<?php echo esc_attr( $field_3 ) ;?>"
		data-field_4="<?php echo esc_attr( $field_4 ) ;?>"
		data-field_5="<?php echo esc_attr( $field_5 ) ;?>"
		data-clicked="<?php echo esc_attr( $clicked ) ;?>"
	>
		
		<!-- Search -->
		<?php ovabrw_get_template('elementor/ovabrw_search.php', $args) ; ?>

		 <!-- Filter -->
		<?php if( $show_filter === 'yes') : ?>
	        <div class="ovabrw-room-filter">
	        	
	        	<div class="left-filter">
	        		<div class="found-text" style="display: inline-block;">
	        			<span class="room-found-text number-result-room-found">
			        		<?php echo esc_html__( '0', 'ova-brw' ); ?>
			        	</span>
		        		<span class="room-found-text">
			        		<?php echo esc_html( $room_found_text ); ?>
			        	</span>
	        		</div>
		        	<span class="clear-filter">
		        		<?php echo esc_html( $clear_filter_text ); ?>
		        	</span>
	        	</div>

	        	<div class="right-filter">
	        		<div class="filter-sort">

	        			<input type="text" class="input_select_input" name="sr_sort_by_label" value="<?php echo esc_html__('Sort by','ova-brw'); ?>" autocomplete="off" readonly="readonly">

						<input type="hidden" class="input_select_input_value" name="sr_sort_by" value="">

						<i aria-hidden="true" class="asc_sort ovaicon ovaicon-double-chevron"></i>

						<ul class="input_select_list" style="display: none;">
						    <li class="term_item" 
						    	data-id="id_desc" 
						    	data-value="<?php esc_attr_e('Sort by latest','ova-brw'); ?>"
						    >
							    <?php echo esc_html__('Latest','ova-brw'); ?>
							</li>
							<li class="term_item" 
								data-id="rating_desc" 
								data-value="<?php esc_attr_e('Sort by rating','ova-brw'); ?>"
							>
								<?php echo esc_html__('Rating','ova-brw'); ?>
							</li>
							<li class="term_item" 
								data-id="price_asc" 
								data-value="<?php esc_attr_e('Sort by price: low to high','ova-brw'); ?>"
							>
								<?php echo esc_html__('Price: low to high','ova-brw'); ?>
							</li>
							<li class="term_item" 
								data-id="price_desc" 
								data-value="<?php esc_attr_e('Sort by price: high to low','ova-brw'); ?>"
							>
								<?php echo esc_html__('Price: high to low','ova-brw'); ?>
							</li>
						</ul>
					</div>

	        		<div class="filter-result-layout">
		        		<i aria-hidden="true" class="filter-layout <?php if( $template == 'template1' )  { echo 'filter-layout-active' ; } ?> ovaicon ovaicon-menu-3" data-layout="template1"></i>
		        		<i aria-hidden="true" class="filter-layout <?php if( $template == 'template2' )  { echo 'filter-layout-active' ; } ?> ovaicon ovaicon-menu-2" data-layout="template3"></i>
						<i aria-hidden="true" class="filter-layout <?php if( $template == 'template3' )  { echo 'filter-layout-active' ; } ?> ovaicon ovaicon-list" data-layout="template2"></i>
					</div>
	         	</div>	
	        </div>
	    <?php endif; ?>

		<!-- Load more -->
		<div class="wrap-load-more" style="display: none;">
			<svg class="loader" width="50" height="50">
				<circle cx="25" cy="25" r="10" />
				<circle cx="25" cy="25" r="20" />
			</svg>
		</div>

		<!-- Search result -->
		<div 
			id="search-ajax-result" 
			class="search-ajax-result" 
			data-order="<?php echo esc_attr( $order ); ?>" 
			data-orderby="<?php echo esc_attr( $orderby ); ?>"
			data-orderby_meta_key="<?php echo esc_attr( $orderby_meta_key ); ?>"  
			data-posts-per-page="<?php echo esc_attr( $posts_per_page ); ?>">
		</div>

</div>