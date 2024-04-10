<?php

	if ( ! defined( 'ABSPATH' ) ) exit();

	$id 		= get_the_id();
	$product 	= wc_get_product( $id );

	$excerpt    = ovabrw_limit_words( get_the_excerpt(), 18 );
	$excerpt    = apply_filters('ovabrw_element_room_excerpt', $excerpt );

	$price             = get_post_meta( $id, '_regular_price', true );
	$adults 		   = get_post_meta( $id, 'ovabrw_adult_number', true );
	$childs 		   = get_post_meta( $id, 'ovabrw_children_number', true );
	$beds 		   	   = get_post_meta( $id, 'ovabrw_bed_number', true );
	$baths 		   	   = get_post_meta( $id, 'ovabrw_bath_number', true );
	$area_number       = get_post_meta( $id, 'ovabrw_acreage_number', true );
	$area_unit         = get_post_meta( $id, 'ovabrw_acreage_unit', true );

	$field_1 = $args['field_1'];
	$field_2 = $args['field_2'];
	$field_3 = $args['field_3'];
	$field_4 = $args['field_4'];
	$field_5 = $args['field_5'];

	$meta = array(
		'field_1' => $field_1,
		'field_2' => $field_2,
		'field_3' => $field_3,
		'field_4' => $field_4,
		'field_5' => $field_5,
	);

	$icon_adults     = $args['icon_adults'];
	$icon_children   = $args['icon_children'];
	$icon_area       = $args['icon_area'];
	$icon_beds       = $args['icon_beds'];
	$icon_baths      = $args['icon_baths'];

	// link
	$link      	= apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
	$param      = array();

	global $_POST;

	$clicked 		= isset( $_POST['clicked'] ) 	 ? $_POST['clicked'] 	: '';
	$pickup_date 	= isset( $_POST['start_date'] )  ? $_POST['start_date'] : '';
	$dropoff_date 	= isset( $_POST['end_date'] ) 	 ? $_POST['end_date'] 	: '';
	$adults_p 		= isset( $_POST['adults'] ) 	 ? $_POST['adults'] 	: 1;
	$childrens 		= isset( $_POST['childrens'] ) 	 ? $_POST['childrens'] 	: 0;

	if ( $clicked  ) { 
		
		$param['ovabrw_s_clicked'] = $clicked;

		if ( $pickup_date ) {
			$param['ovabrw_pickup_date']  = $pickup_date;
		}

		if ( $dropoff_date ) {
			$param['ovabrw_dropoff_date'] = $dropoff_date;
		}

		if ( $adults_p ) {
			$param['ovabrw_adults'] = $adults_p;
		}

		if ( $childrens ) {
			$param['ovabrw_childrens'] = $childrens;
		}

		if ( $param ) {
			$link = add_query_arg( $param, $link );
		}
	}

?>
						
<div class="room-grid-content room-grid-content2">
	<?php if ( has_post_thumbnail() ): ?>
		<a href="<?php echo esc_url( $link ); ?>" class="image" title="<?php echo esc_attr( get_the_title() ); ?>">
			<?php the_post_thumbnail( 'qomfort_thumbnail' ); ?>
		</a>
	<?php endif; ?>
	<div class="content">
		<h3 class="title">
			<a href="<?php echo esc_url( $link ); ?>"
				title="<?php echo esc_attr( get_the_title() ); ?>">
				<?php echo esc_html( get_the_title() ); ?>
			</a>
		</h3>
		<ul class="meta">
			<?php for ( $i = 1; $i <= 5; $i++ ):
				$key = 'field_'.$i;

				switch ( $meta[$key] ) {
					case 'adults': ?>
						<?php if ( $adults ): ?>
							<li class="item">
								<?php \Elementor\Icons_Manager::render_icon( $icon_adults, [ 'aria-hidden' => 'true' ] ); ?>
								<?php echo esc_html__("Adults : ",'ova-brw') . $adults; ?>
							</li>
						<?php endif; ?>
					<?php break;

					case 'children': ?>
						<?php if ( $childs ): ?>
							<li class="item">
								<?php \Elementor\Icons_Manager::render_icon( $icon_children, [ 'aria-hidden' => 'true' ] ); ?>
								<?php echo esc_html__("Children : ",'ova-brw') . $childs; ?>
							</li>
						<?php endif; ?>
					<?php break;

					case 'acreage': ?>
						<?php if ( $area_number ): ?>
							<li class="item">
								<?php \Elementor\Icons_Manager::render_icon( $icon_area, [ 'aria-hidden' => 'true' ] ); ?>
								<span>
									<?php echo esc_html__("Size : ",'ova-brw') . $area_number; ?>
									<?php if ( strcasecmp($area_unit, 'sqm') == 0 ){
										echo esc_html( $area_unit );
									} else {
										echo esc_html( $area_unit ); ?><sup><?php esc_html_e( '2', 'ova-brw' ); ?></sup>
									<?php } ?>
								</span>
							</li>
						<?php endif; ?>
					<?php break;

					case 'beds': ?>
						<?php if ( $beds ): ?>
							<li class="item">
								<?php \Elementor\Icons_Manager::render_icon( $icon_beds, [ 'aria-hidden' => 'true' ] ); ?>
								<?php echo esc_html__("Beds : ",'ova-brw') . $beds; ?>
							</li>
						<?php endif; ?>
					<?php break;

					case 'baths': ?>
						<?php if ( $baths ): ?>
							<li class="item">
								<?php \Elementor\Icons_Manager::render_icon( $icon_baths, [ 'aria-hidden' => 'true' ] ); ?>
								<?php echo esc_html__("Bathrooms : ",'ova-brw') . $baths; ?>
							</li>
						<?php endif; ?>
					<?php break;

					default:
						break;
				}
			?>
			<?php endfor; ?>
		</ul>
		<?php if ( get_the_excerpt() ): ?>
			<p class="short-desc"><?php echo $excerpt; ?></p>
		<?php endif; ?>
		<div class="bottom">
			<?php if ( $price ): ?>
				<div class="price">
					<span class="text"><?php esc_html_e( 'From ', 'ova-brw' ) ?></span>
					<span class="number"><?php echo wc_price( $price ); ?></span>
					<span class="text"><?php esc_html_e( '/per night', 'ova-brw' ); ?></span>
				</div>
			<?php endif; ?>
			<a href="<?php echo esc_url( $link ); ?>" class="btn_link" title="<?php esc_attr_e('Book Now', 'ova-brw'); ?>">
				<?php esc_html_e( 'Book Now', 'ova-brw' ); ?>
				<i class="fas fa-angle-right" aria-hidden="true"></i>
			</a>
		</div>
	</div>
</div>