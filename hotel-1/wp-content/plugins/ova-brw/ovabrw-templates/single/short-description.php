<?php 
/**
 * The template for displaying short-description content within single
 *
 * This template can be overridden by copying it to yourtheme/ovabrw-templates/single/short-description.php
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

$short_description = apply_filters( 'woocommerce_short_description', $product->get_short_description() );

if ( ! $short_description ) {
	return;
}

?>
<div class="ovabrw-product-details__short-description">
	<?php echo $short_description; // WPCS: XSS ok. ?>
</div>