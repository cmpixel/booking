<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Qomfort_Elementor_Gallery extends Widget_Base {

	public function get_name() {
		return 'qomfort_elementor_gallery';
	}

	public function get_title() {
		return esc_html__( 'Ova Gallery', 'qomfort' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'qomfort' ];
	}

	public function get_script_depends() {
		wp_enqueue_style('fancybox', get_template_directory_uri().'/assets/libs/fancybox/fancybox.css');
		wp_enqueue_script('fancybox', get_template_directory_uri().'/assets/libs/fancybox/fancybox.umd.js', array('jquery'), false, true);
		return [ 'qomfort-elementor-gallery' ];
	}
	
	// Add Your Controll In This Function
	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'qomfort' ),
			]
		);	
			
			// Add Class control
			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'title',
				[
					'label'   => esc_html__( 'Title', 'qomfort' ),
					'type'    => \Elementor\Controls_Manager::TEXT,
					'default' =>  esc_html__( 'Luxury Hotel', 'qomfort' ),
				]
			);

			$repeater->add_control(
				'caption',
				[
					'label'   => esc_html__( 'Caption Image', 'qomfort' ),
					'type'    => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( '', 'qomfort' ),
				]
			);

			$repeater->add_control(
				'image',
				[
					'label'   => esc_html__( 'Gallery Image', 'qomfort' ),
					'type'    => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);

			$repeater->add_control(
				'image_popup',
				[
					'label'   => esc_html__( 'Popup Image', 'qomfort' ),
					'type'    => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);

			$repeater->add_control(
				'video_link',
				[
					'label' => esc_html__( 'Embed Video Link', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::URL,
					'description' => esc_html__( 'https://www.youtube.com/watch?v=MLpWrANjFbI', 'qomfort' ),
					'options' => [ 'url', 'is_external', 'nofollow' ],
					'default' => [
						'url' => '',
						'is_external' => false,
						'nofollow' => false,
					],
				]
			);

			$repeater->add_responsive_control(
				'image_width',
				[
					'label' 		=> esc_html__( 'Width', 'qomfort' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ '%', 'px' ],
					'default' => [
						'unit' => '%',
					],
					'tablet_default' => [
						'unit' => '%',
					],
					'mobile_default' => [
						'unit' => '%',
					],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 500,
							'step' 	=> 10,
						],
						'%' => [
							'min' 	=> 0,
							'max' 	=> 100,
							'step' 	=> 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery .grid {{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$repeater->add_responsive_control(
				'image_padding',
				[
					'label'      => esc_html__( 'Padding', 'qomfort' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-gallery .grid {{CURRENT_ITEM}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'tab_item',
				[
					'label'		=> esc_html__( 'Items Gallery', 'qomfort' ),
					'type'		=> \Elementor\Controls_Manager::REPEATER,
					'fields'  	=> $repeater->get_controls(),
					'default' 	=> [
						[
							'title' => esc_html__('Luxury Hotel', 'qomfort'),
						],
						[
							'title' => esc_html__('Luxury Hotel', 'qomfort'),
						],
						[
							'title' => esc_html__('Luxury Hotel', 'qomfort'),
						],
						[
							'title' => esc_html__('Luxury Hotel', 'qomfort'),
						],
						[
							'title' => esc_html__('Luxury Hotel', 'qomfort'),
						],
						[
							'title' => esc_html__('Luxury Hotel', 'qomfort'),
						],
					],
					'title_field' => '{{{ title }}}',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_style',
			[
				'label' => esc_html__( 'Image', 'qomfort' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'image_margin',
				[
					'label'      => esc_html__( 'Margin', 'qomfort' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-gallery .grid .grid-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'image_height',
				[
					'label' => esc_html__( 'Height', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,
							'step' => 5,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery .grid .grid-item .gallery-fancybox img' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' => esc_html__( 'Content', 'qomfort' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'content_bg_hover',
				[
					'label'     => esc_html__( 'Background Hover', 'qomfort' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery .grid .grid-item .gallery-fancybox .gallery-container:before' => 'background-color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'content_opacity',
				[
					'label' => esc_html__( 'Opacity', 'qomfort' ),
					'type' 	=> \Elementor\Controls_Manager::SLIDER,
					
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 1,
							'step' 	=> 0.1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery .grid .grid-item:hover .gallery-fancybox .gallery-container:before' => 'opacity: {{SIZE}}',
					],
				]
			);

			$this->add_responsive_control(
	            'content_alignment',
	            [
	                'label' 	=> esc_html__( 'Alignment', 'qomfort' ),
	                'type' 		=> \Elementor\Controls_Manager::CHOOSE,
	                'options' 	=> [
	                    'left' 	=> [
	                        'title' => esc_html__( 'Left', 'qomfort' ),
	                        'icon' 	=> 'eicon-text-align-left',
	                    ],
	                    'center' 	=> [
	                        'title' => esc_html__( 'Center', 'qomfort' ),
	                        'icon' 	=> 'eicon-text-align-center',
	                    ],
	                    'right' 	=> [
	                        'title' => esc_html__( 'Right', 'qomfort' ),
	                        'icon' 	=> 'eicon-text-align-right',
	                    ],
	                ],
	                'selectors' => [
	                    '{{WRAPPER}} .ova-gallery .grid .grid-item .gallery-fancybox .gallery-container .gallery-content .gallery-title' => 'text-align: {{VALUE}}',
	                    '{{WRAPPER}} .ova-gallery .grid .grid-item .gallery-fancybox .gallery-container .gallery-content .gallery-sub-title' => 'text-align: {{VALUE}}',
	                ],
	            ]
	        );

			$this->add_responsive_control(
				'content_bottom',
				[
					'label' 		=> esc_html__( 'Bottom', 'qomfort' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ '%', 'px' ],
					'default' => [
						'unit' => 'px',
					],
					'tablet_default' => [
						'unit' => 'px',
					],
					'mobile_default' => [
						'unit' => 'px',
					],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 500,
							'step' 	=> 1,
						],
						'%' => [
							'min' 	=> 0,
							'max' 	=> 100,
							'step' 	=> 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery .grid .grid-item:hover .gallery-fancybox .gallery-container .gallery-content' => 'bottom: {{SIZE}}{{UNIT}}',
					],
				]
			);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title', 'qomfort' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name'     => 'title_typography',
					'selector' => '{{WRAPPER}} .ova-gallery .grid .grid-item .gallery-fancybox .gallery-container .gallery-content .gallery-title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label'     => esc_html__( 'Color', 'qomfort' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery .grid .grid-item .gallery-fancybox .gallery-container .gallery-content .gallery-title' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'title_margin',
				[
					'label'      => esc_html__( 'Margin', 'qomfort' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-gallery .grid .grid-item .gallery-fancybox .gallery-container .gallery-content .gallery-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
	}

	// Render Template Here
	protected function render() {

		$settings 	= $this->get_settings();

		// Get list item
		$tabs 		= $settings['tab_item'];

		?>

		<?php if ( $tabs && is_array( $tabs ) ): ?>
	        <div class="ova-gallery">
	        	<div class="grid">
	        		<div class="grid-sizer"></div>
	  				<?php foreach ( $tabs as $key => $items ): 
	  					$img_url 	= $items['image']['url'];
	  					$img_popup 	= $items['image_popup']['url'];
	  					$img_id 	= $items['image']['id'];
	  					$img_alt 	= '';
	  					if ( $img_id ) {
	  						$img_alt = get_post_meta( $img_id, '_wp_attachment_image_alt', true );
	  						if ( ! $img_alt ) {
	  							$img_alt = get_the_title( $img_id );
	  						}
	  					}
	  					$caption 	= $items['caption'];
	  					$item_id 	= 'elementor-repeater-item-' . $items['_id'];
	  					$title 		= $items['title'];

	  					if ( ! $caption ) {
	  						$caption = $img_alt;
	  					}

	  					$class_item = ( $key == 2 ) || ( $key == 3 ) ? 'grid-width-2' : '';

	  					$video_link	= $items['video_link']['url'];
	  					if ( !empty($video_link)) {
	  						$href = $img_popup = $video_link;
	  					} else {
	  						$href = '#';
	  					}
	  				?>
	  					<div class="grid-item <?php echo esc_attr( $item_id ); ?><?php if ( 0 == $key ) esc_attr(' grid-item-fisrt'); ?> <?php echo esc_attr( $class_item ); ?>">
	  						<a href="<?php echo esc_url($href);?>" class="gallery-fancybox" data-src="<?php echo esc_url( $img_popup ); ?>" 
	  							data-fancybox="gallery" 
	  							data-caption="<?php echo esc_attr( $caption ); ?>">

	  							<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $caption ); ?>">
	  							<div class="gallery-container">
		  							<div class="gallery-content">
			  							<?php if ( $title ): ?>
			  								<h2 class="gallery-title"><?php echo esc_html( $title ); ?></h2>
			  							<?php endif; ?>
			  						</div>
		  						</div>
	  						</a>
	  					</div>
	  				<?php endforeach; ?>
	        	</div>
			</div>
		<?php
		endif;
	}

	
}
$widgets_manager->register( new Qomfort_Elementor_Gallery() );