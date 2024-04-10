<?php 
/**
 * The template for displaying rules content within single
 *
 * This template can be overridden by copying it to yourtheme/ovabrw-templates/single/rules.php
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

$rule  = get_post_meta( $pid, 'ovabrw_room_rules', true );

if ( ! $rule ) {
	return;
}

?>
<div class="ovabrw-product-rules">
	<?php echo $rule; ?>
</div>