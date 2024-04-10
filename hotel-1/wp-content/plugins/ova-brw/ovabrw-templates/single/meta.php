<?php 
/**
 * The template for displaying meta content within single
 *
 * This template can be overridden by copying it to yourtheme/ovabrw-templates/single/meta.php
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit();

// Get product_id from do_action - use when insert shortcode
if ( isset( $args['id'] ) && $args['id'] ) {
	$pid = $args['id'];
} else {
	$pid = get_the_id();
}

// Check product type: rental
$product = wc_get_product( $pid );
if ( !$product || $product->get_type() !== 'ovabrw_car_rental' ) return;

$area   	= get_post_meta( $pid,'ovabrw_acreage_number',true );
$area_unit  = get_post_meta( $pid,'ovabrw_acreage_unit',true );
$area_icon  = $args['area_icon'];
$area_label = $args['area_label'];

$beds   	= get_post_meta( $pid,'ovabrw_bed_number',true );
$beds_icon  = $args['beds_icon'];
$beds_label = $args['beds_label'];

$bath   	= get_post_meta( $pid,'ovabrw_bath_number',true );
$bath_icon  = $args['bath_icon'];
$bath_label = $args['bath_label'];

$adults   		= get_post_meta( $pid,'ovabrw_adult_number',true );
$adults_icon  	= $args['adults_icon'];
$adults_label 	= $args['adults_label'];

$children   	= get_post_meta( $pid,'ovabrw_children_number',true );
$children_icon  = $args['children_icon'];
$children_label = $args['children_label'];


?>

<?php if( !empty($area) || !empty($beds) || !empty($bath) || !empty($adults) || !empty($children) ) : ?>
	<ul class="ovabrw-product-meta">
		<?php if( !empty($area) ) : ?>
			<li class="item-meta">
				<?php \Elementor\Icons_Manager::render_icon( $area_icon, [ 'aria-hidden' => 'true' ] ); ?>
				<span class="label">
					<?php echo esc_html( $area_label ) ; ?>		   
				</span>
				<span class="value">
					<?php echo esc_html( $area ) . esc_html( $area_unit ) ; ?>	
					<sup><?php echo esc_html__( '2', 'ova-brw' ) ; ?></sup>
				</span>
			</li>
		<?php endif; ?>
		<?php if( !empty($beds) ) : ?>
			<li class="item-meta">
				<?php \Elementor\Icons_Manager::render_icon( $beds_icon, [ 'aria-hidden' => 'true' ] ); ?>
				<span class="label">
					<?php echo esc_html( $beds_label ) ; ?>		   
				</span>
				<span class="value">
					<?php echo esc_html( $beds ); ?>	
				</span>
			</li>
		<?php endif; ?>
		<?php if( !empty($bath) ) : ?>
			<li class="item-meta">
				<?php \Elementor\Icons_Manager::render_icon( $bath_icon, [ 'aria-hidden' => 'true' ] ); ?>
				<span class="label">
					<?php echo esc_html( $bath_label ) ; ?>		   
				</span>
				<span class="value">
					<?php echo esc_html( $bath ); ?>	
				</span>
			</li>
		<?php endif; ?>
		<?php if( !empty($adults) ) : ?>
			<li class="item-meta">
				<?php \Elementor\Icons_Manager::render_icon( $adults_icon, [ 'aria-hidden' => 'true' ] ); ?>
				<span class="label">
					<?php echo esc_html( $adults_label ) ; ?>		   
				</span>
				<span class="value">
					<?php echo esc_html( $adults ); ?>	
				</span>
			</li>
		<?php endif; ?>
		<?php if( !empty($children) ) : ?>
			<li class="item-meta">
				<?php \Elementor\Icons_Manager::render_icon( $children_icon, [ 'aria-hidden' => 'true' ] ); ?>
				<span class="label">
					<?php echo esc_html( $children_label ) ; ?>		   
				</span>
				<span class="value">
					<?php echo esc_html( $children ); ?>	
				</span>
			</li>
		<?php endif; ?>
	</ul>
<?php endif; ?>