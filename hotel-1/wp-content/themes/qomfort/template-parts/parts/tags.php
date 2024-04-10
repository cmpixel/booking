
    
        <?php the_tags('', '', ''); ?>
    

<div class="clearboth"></div>


<?php if( has_filter( 'qomfort_share_social' ) ){ ?>
    <div class="share_social">
    	<div class="ova_label">
    		<?php esc_html_e('Share: ', 'qomfort'); ?>
    	</div>
    	<?php echo apply_filters('qomfort_share_social', get_the_permalink(), get_the_title() ); ?>
    </div>
<?php } ?>
