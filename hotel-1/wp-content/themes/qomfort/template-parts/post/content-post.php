<?php $sticky_class = is_sticky()?'sticky':''; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-wrap '. $sticky_class); ?>  >
		
		<?php if( ( has_post_format('audio') || has_post_format('gallery') || has_post_format('video' ) || has_post_thumbnail() ) && qomfort_post_show_media() == 'yes' ): ?>	
			<div class="post-media">
				<?php 
					if( has_post_format('audio') ){

					 	get_template_part( 'template-parts/parts/audio' );

					}elseif(has_post_format('gallery')){

						get_template_part( 'template-parts/parts/gallery' );

					}elseif(has_post_format('video')){

						get_template_part( 'template-parts/parts/video' );

					}elseif(has_post_thumbnail()){

						get_template_part( 'template-parts/parts/thumbnail' );

			        }
				?>
			</div>
		<?php endif; ?>

		<?php if ( !is_singular('elementor_library') ) { ?>
			<div class="post-meta">
				<?php get_template_part( 'template-parts/parts/meta' ); ?>
			</div>
		<?php } ?>

		<?php if ( !is_singular('elementor_library') ) { ?>
			<?php if( qomfort_post_show_title() == 'yes' ){
				get_template_part( 'template-parts/parts/title' );
			} ?>
		<?php } ?>

		<div class="post-content">
			<?php get_template_part( 'template-parts/parts/content' ); ?>
		</div>

		<?php if ( !is_singular('elementor_library') ) { ?>
			<div class="post-tags-and-share">
		        <?php if(has_tag() && qomfort_post_show_tag() == 'yes' ){ ?>
					<div class="post-tags">
						<?php get_template_part( 'template-parts/parts/tags' ); ?>
					</div>
				<?php } ?>

				<?php if( qomfort_post_show_share_social_icon() == 'yes' ){ ?>
			        <?php apply_filters( 'ova_share_social', get_the_permalink(), get_the_title()  ); ?>
		        <?php } ?>
			</div>
		<?php } ?>

		<!-- Next Preview Post -->
		<?php if ( !is_singular('elementor_library') ) { ?>
			<?php if( qomfort_post_show_next_prev_post() == 'yes' ){ ?>
			    <div class="ova-next-pre-post">
			    	
					<?php
						$prev_post  = get_previous_post();
						$next_post  = get_next_post();
					?>
					
					<?php if($prev_post) { ?>
						<a class="pre" href="<?php echo esc_attr(get_permalink($prev_post->ID)); ?>">
							<?php echo get_the_post_thumbnail( $prev_post->ID, 'thumbnail' ); ?>
							<span  class="num-2">
								<span class="second_font text-label"><?php esc_html_e('Previous', 'qomfort'); ?></span>
								<span  class="second_font title" ><?php echo esc_html(get_the_title($prev_post->ID)); ?></span>
							</span>
						</a>
					<?php } ?>		
					
					<?php if($next_post) { ?>
						<a class="next" href="<?php echo esc_attr(get_permalink($next_post->ID)); ?> ">
							<?php echo get_the_post_thumbnail( $next_post->ID, 'thumbnail' ); ?>
							<span  class="num-2">
								<span class="second_font text-label"><?php esc_html_e('Next', 'qomfort'); ?></span>
								<span class="second_font title" ><?php echo esc_html(get_the_title($next_post->ID)); ?></span>
							</span>
						</a>
					<?php } ?>

				</div>
			<?php } ?>
		<?php } ?>
	
</article>