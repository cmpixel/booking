<?php
	if ( ! defined('ABSPATH') ) {
		exit();
	}
	$rooms 	= ovabrw_get_room( $args );
?>

<div class="ovabrw-room-list">
	<?php if ( $rooms->have_posts() ): ?>
	<ul class="list">
		<?php while ( $rooms->have_posts() ) : $rooms->the_post(); ?>
		<?php
			$id 	= get_the_id();
			$price  = get_post_meta( $id, '_regular_price', true );
		?>
		<li class="item">
			<div class="content">
				<h3 class="title">
					<a href="<?php echo esc_url( get_the_permalink() ); ?>"
						title="<?php echo esc_attr( get_the_title() ); ?>">
						<?php echo esc_html( get_the_title() ); ?>
					</a>
				</h3>
				<?php if ( $price ): ?>
					<div class="price">
						<span class="text"><?php esc_html_e( 'From ', 'ova-brw' ) ?></span>
						<span class="number"><?php echo wc_price( $price ); ?></span>
						<span class="text"><?php esc_html_e( '/per night', 'ova-brw' ); ?></span>
					</div>
				<?php endif; ?>
			</div>
			<a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" class="icon">
				<i class="ovaicon-diagonal-arrow" aria-hidden="true"></i>
			</a>
		</li>
		<?php endwhile; ?>
	</ul>
	<?php endif;wp_reset_postdata(); ?>
</div>