<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Qomfort_Elementor_Ova_Image_Gallery extends Widget_Base {

	
	public function get_name() {
		return 'qomfort_elementor_ova_image_gallery';
	}

	
	public function get_title() {
		return esc_html__( 'Image Gallery', 'qomfort' );
	}

	
	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	
	public function get_categories() {
		return [ 'qomfort' ];
	}

	public function get_script_depends() {
		wp_enqueue_style( 'fancybox', get_template_directory_uri().'/assets/libs/fancybox/fancybox.css' );
		wp_enqueue_script( 'fancybox', get_template_directory_uri().'/assets/libs/fancybox/fancybox.umd.js', array('jquery'));

		return [ 'qomfort-elementor-ova-image-gallery' ];
	}
	
	// Add Your Controll In This Function
	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'qomfort' ),
			]
		);
			
			$this->add_control(
				'column',
				[
					'label' => esc_html__( 'Column', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'three_column',
					'options' => [
						'two_column' => esc_html__( '2 Columns', 'qomfort' ),
						'three_column' => esc_html__( '3 Columns', 'qomfort' ),
						'four_column' => esc_html__( '4 Columns', 'qomfort' ),
					],
				]
			);

			$this->add_control(
				'ova_image_gallery',
				[
					'label' => esc_html__( 'Add Images', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::GALLERY,
					'default' => [],
				]
			);

			$this->add_control(
				'icon',
				[
					'label' => esc_html__( 'Icon', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' 	=> [
						'value' 	=> 'fab fa-instagram',
						'library' 	=> 'all',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Image_Size::get_type(),
				[
					'name' => 'medium', // Usage: `{name}_size` and `{name}_custom_dimension`
					'exclude' => [ 'custom' ],
					'default' => 'medium',
					'separator' => 'none',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'ova_image_gallery_style',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Content', 'qomfort' ),
			]
		);

			$this->add_responsive_control(
				'gap',
				[
					'label' => esc_html__( 'Gap', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-image-gallery-ft' => 'gap: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'overlay_opacity',
				[
					'label' => esc_html__( 'Overlay Hover Opacity', 'qomfort' ),
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'size' => 0.84,
					],
					'range' => [
						'px' => [
							'max' => 1,
							'step' => 0.01,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-image-gallery-ft .item-fancybox-ft:hover .overlay' => 'opacity: {{SIZE}};',
					],
					
				]
			);

	        $this->add_control(
				'overlay_color',
				[
					'label' 	=> esc_html__( 'Overlay Hover Color', 'qomfort' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-image-gallery-ft .item-fancybox-ft .overlay' => 'background-color: {{VALUE}};',
					],
				]
			);


		$this->end_controls_section();
		
	}

	// Render Template Here
	protected function render() {

		$settings 	= $this->get_settings();

		$column 				= $settings['column'];
		$list_image 			= $settings['ova_image_gallery'];
		$icon 					= $settings['icon'] ? $settings['icon'] : '';

		?>

		<div class="ova-image-gallery">
            
            <?php if( !empty($list_image) ) : ?>
				<div class="ova-image-gallery-ft <?php echo esc_attr( $column ); ?>">
					<?php foreach( $list_image as $item ): ?>
						<?php 

							$image_id 		= $item['id']; 
							$url 	  		= $item['url'] ;
		                    $thumbnail_url  = wp_get_attachment_image_src( $image_id, $settings['medium_size'] )[0];

		                    $alt 			= get_post_meta($image_id, '_wp_attachment_image_alt', true) ? get_post_meta($image_id, '_wp_attachment_image_alt', true) : esc_html__('Gallery Slide','qomfort');  

		                    $caption        = wp_get_attachment_caption( $image_id );
		                        
		                    if ( $caption == '') {
		                    	$caption = $alt;
		                    }

						?>
							<a href="#" data-src="<?php echo esc_url( $url ); ?>" class="item-fancybox-ft"  data-fancybox="image-gallery-ft"  data-caption="<?php echo esc_attr($caption); ?>">
								
								<img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php echo esc_attr( $alt ); ?>">

								<div class="overlay">
									<?php if( $icon ){ ?>
										<div class="icon">
											<?php 
										        \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] );
										    ?>
										</div>	
									<?php } ?>
								</div>
							</a>
					<?php endforeach; ?>
					
				</div> 
			<?php endif; ?>

		</div>	

		<?php
	}
}
$widgets_manager->register( new Qomfort_Elementor_Ova_Image_Gallery() );