<?php 
/**
 * The template for displaying price content within single
 *
 * This template can be overridden by copying it to yourtheme/ovabrw-templates/single/price.php
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

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

$pid = $product->get_id();

$price_type     = get_post_meta( $pid, 'ovabrw_price_type', true ) ? get_post_meta( $pid, 'ovabrw_price_type', true ) : 'day' ;
$price_hour     = get_post_meta( $pid, 'ovabrw_regul_price_hour', true );
$price_day      = get_post_meta( $pid, '_regular_price', true );


if( $price_type == 'hour' ){ ?>
    <div class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'ovabrw-price price' ) );?>">
        <span class="amount"><?php echo wc_price( $price_hour) ; ?> </span>
        <span class="label"><?php esc_html_e( '/ Hour', 'ova-brw' ); ?></span>
    </div>
<?php } else if( $price_type == 'day' ){ ?>
    <div class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'ovabrw-price price' ) );?>">
        <span class="amount"><?php echo wc_price( $price_day ); ?></span>
        <span class="label"><?php esc_html_e( '/ Night', 'ova-brw' ); ?></span>
    </div>
<?php }else if( $price_type == 'mixed' ){ ?>
    <div class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'ovabrw-price price' ) );?>">
        <span class="ovabrw_woo_price">
            <span class="amount"><?php echo wc_price( $price_hour ); ?></span>
            <span class="label"><?php esc_html_e( '/ Hour', 'ova-brw' ); ?></span>
        </span>
        <span class="ovabrw_woo_price">
            <span class="amount"><?php echo wc_price( $price_day ); ?></span>
            <span class="label"><?php esc_html_e( '/ Night', 'ova-brw' ); ?></span>
        </span>
    </div>
<?php }else{ ?>
    <div class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'ovabrw-price price' ) );?>">
        <?php esc_html_e( 'Option Price', 'ova-brw' ); ?>
    </div>
<?php }
