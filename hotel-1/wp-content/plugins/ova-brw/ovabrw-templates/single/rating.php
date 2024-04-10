<?php 
/**
 * The template for displaying rating content within single
 *
 * This template can be overridden by copying it to yourtheme/ovabrw-templates/single/rating.php
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

$review_count   = $product->get_review_count();
$rating         = $product->get_average_rating();

?>

<?php if ( wc_review_ratings_enabled() && $rating > 0 ): ?>
    <div class="ova-product-rating">
        <div class="star-rating" role="img" aria-label="<?php echo sprintf( __( 'Rated %s out of 5', 'ova-brw' ), $rating ); ?>">
            <span class="rating-percent" style="width: <?php echo esc_attr( ( $rating / 5 ) * 100 ).'%'; ?>;"></span>
        </div>
        <a href="#reviews" class="woo-review-link" rel="nofollow">
            ( <?php printf( _n( '%s review', '%s reviews', $review_count, 'ova-brw' ), esc_html( $review_count ) ); ?> )
        </a> 
    </div>
<?php endif; ?>