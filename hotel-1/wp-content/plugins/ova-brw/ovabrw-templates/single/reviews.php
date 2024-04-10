<?php 
/**
 * The template for displaying reviews and comment content within single
 *
 * This template can be overridden by copying it to yourtheme/ovabrw-templates/single/reviews.php
 *
 */

if ( !defined( 'ABSPATH' ) ) exit();

if ( isset( $args['id'] ) && $args['id'] ) {
    $pid = $args['id'];
} else {
    $pid = get_the_id();
}

// Check product type: rental
$product = wc_get_product( $pid );

// if the product type isn't ovabrw_car_rental
if ( !$product || $product->get_type() !== 'ovabrw_car_rental' ) return;

// Review
$product_review = array(
    'title'    => sprintf( __( 'Reviews (%d)', 'ova-brw' ), $product->get_review_count() ),
    'priority' => 30,
    'callback' => 'comments_template',
);

?>

<!--  Room Review -->
<?php if( is_singular('product') ) { ?>
    <div class="ovabrw-product-review" id="ovabrw-product-review">
        <?php call_user_func( $product_review['callback'], 'reviews', $product_review ); ?>
    </div>
<?php } else { ?>
    <div class="ovabrw-product-review" id="ovabrw-product-review">
        <h4 class="not-visible">
            <?php echo esc_html__('Reviews are only visible in a single room page','ova-brw'); ?>
        </h4>
    </div>
<?php } ?>