<?php
/**
 * The template for displaying feature image and gallery image within single
 *
 * This template can be overridden by copying it to yourtheme/ovabrw-templates/single/product_image.php
 *
 */

if ( !defined( 'ABSPATH' ) ) exit();

// Get product_id from do_action - use when insert shortcode
if ( isset( $args['id'] ) && $args['id'] ) {
    $product_id = $args['id'];
} else {
    $product_id = get_the_id();
}

$gallery_ids      = ovabrw_get_gallery_ids( $product_id );
$count_list       = count($gallery_ids);
if( $count_list <= 2 ) {
    $count_list = 'grid-two';
} else {
    $count_list = '';
}

$product            = wc_get_product( $product_id );
$ovabrw_video_link  = $product->get_meta( 'ovabrw_video_link', true );

$img_url    = $img_alt = '';
$img_id     = $product->get_image_id();

if ( $img_id ) {
    $img_url = wp_get_attachment_url( $img_id );
    $img_alt = get_post_meta( $img_id, '_wp_attachment_image_alt', true );

    if ( ! $img_alt ) {
        $img_alt = get_the_title( $img_id );
    }
}

?>

<?php if ( $img_url ): ?>
    <div class="ova-product-img">
        <ul class="list-img <?php echo esc_attr($count_list);?>">
            <li class="item-img featured-img">
                <a class="gallery-fancybox" 
                    data-src="<?php echo esc_url( $img_url ); ?>" 
                    data-fancybox="ova_product_img_group" 
                    data-caption="<?php echo esc_attr( $img_alt ); ?>">
                    <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
                </a>
                <?php if( !empty( $ovabrw_video_link ) ) : ?>
                    <div class="room-video-gallery-wrapper">
                        <div class="room-video-gallery room-video-link" data-src="<?php echo esc_attr( $ovabrw_video_link ); ?>">
                            <i aria-hidden="true" class="fas fa-play"></i>
                        </div>
                    </div>
                <?php endif; ?>
            </li>
            <?php if ( $gallery_ids ): ?>
                <?php foreach( $gallery_ids as $k => $gallery_id ):
                    $gallery_url = wp_get_attachment_url( $gallery_id );
                    $gallery_alt = get_post_meta( $gallery_id, '_wp_attachment_image_alt', true );

                    if ( ! $gallery_alt ) {
                        $gallery_alt = get_the_title( $gallery_id );
                    }

                    $hidden = ( $k > 3 ) ? ' gallery_hidden' : '';
                    $blur   = ( $k == 3 && count( $gallery_ids ) > 4 ) ? ' gallery_blur' : '';

                ?>
                    <li class="item-img<?php printf( $hidden ); ?><?php printf( $blur ); ?>">
                        <a class="gallery-fancybox" 
                            data-src="<?php echo esc_url( $gallery_url ); ?>" 
                            data-fancybox="ova_product_img_group" 
                            data-caption="<?php echo esc_attr( $gallery_alt ); ?>">
                            <img src="<?php echo esc_url( $gallery_url ); ?>" alt="<?php echo esc_attr( $gallery_alt ); ?>">
                            <?php if ( $blur ): ?>
                                <div class="blur-bg">
                                    <span class="gallery-count">
                                        <?php echo esc_html( '+', 'ova-brw' ) . esc_html( count( $gallery_ids ) - 4 ); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
    <!-- Video -->
    <div class="room-video-modal-container">
        <div class="modal">
            <div class="modal-close">
                <i class="ovaicon-cancel"></i>
            </div>
            <iframe class="modal-video" allow="autoplay"></iframe>
        </div>
    </div>
<?php endif; ?>