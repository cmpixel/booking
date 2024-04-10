<?php 
/**
 * The template for displaying description content within single
 *
 * This template can be overridden by copying it to yourtheme/ovabrw-templates/single/description.php
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

$description = $product->get_description();

if ( ! $description ) {
	return;
}

?>
<p class="ovabrw-product-details__description">
	<?php echo $description; // WPCS: XSS ok. ?>
</p>