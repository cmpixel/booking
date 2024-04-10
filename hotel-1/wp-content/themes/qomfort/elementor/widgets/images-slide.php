<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Qomfort_Elementor_Images_Slide extends Widget_Base {

	public function get_name() {
		return 'qomfort_elementor_images_slide';
	}

	public function get_title() {
		return esc_html__( 'Images Slide', 'qomfort' );
	}

	public function get_icon() {
		return 'eicon-slider-album';
	}

	public function get_categories() {
		return [ 'qomfort' ];
	}

	public function get_script_depends() {
		return [ 'qomfort-elementor-images-slide' ];
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
				'image',
				[
					'label'   => esc_html__( 'Image', 'qomfort' ),
					'type'    => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
					],
				]
			);

			$repeater->add_control(
				'title',
				[
					'label'   => esc_html__( 'Title', 'qomfort' ),
					'type'    => \Elementor\Controls_Manager::TEXT,
				]
			);

			$repeater->add_control(
				'link',
				[
					'label' => esc_html__( 'Link', 'qomfort' ),
					'type' => Controls_Manager::TEXT,
					'default' => '#',
				]
			);

			$this->add_control(
				'tab_item',
				[
					'label'       => esc_html__( 'Images Slide', 'qomfort' ),
					'type'        => Controls_Manager::REPEATER,
					'fields'      => $repeater->get_controls(),
					'default' => [
						[
							'title' => esc_html__('Departments', 'qomfort'),
							'link' => esc_html__('http://ovapt.com/qomfort/wp/ova_dep/', 'qomfort'),
						],
						[
							'title' => esc_html__('Documentation', 'qomfort'),
							'link' => esc_html__('http://ovapt.com/qomfort/wp/ova_doc/', 'qomfort'),
						],
						[
							'title' => esc_html__('Events', 'qomfort'),
							'link' => esc_html__('http://ovapt.com/qomfort/wp/event/', 'qomfort'),
						],
					],
					'title_field' => '{{{ title }}}',
				]
			);

		$this->end_controls_section();

			/*****************************************************************
						START SECTION ADDITIONAL
		******************************************************************/

		$this->start_controls_section(
			'section_additional_options',
			[
				'label' => __( 'Additional Options', 'qomfort' ),
			]
		);

			$this->add_control(
				'margin_items',
				[
					'label'   => esc_html__( 'Margin Right Items', 'qomfort' ),
					'type'    => Controls_Manager::NUMBER,
					'default' => 30,
				]
				
			);

			$this->add_control(
				'item_number',
				[
					'label'       => esc_html__( 'Item Number', 'qomfort' ),
					'type'        => Controls_Manager::NUMBER,
					'description' => esc_html__( 'Number Item', 'qomfort' ),
					'default'     => 3,
				]
			);

			$this->add_control(
				'slides_to_scroll',
				[
					'label'       => esc_html__( 'Slides to Scroll', 'qomfort' ),
					'type'        => Controls_Manager::NUMBER,
					'description' => esc_html__( 'Set how many slides are scrolled per swipe.', 'qomfort' ),
					'default'     => 1,
				]
			);

			$this->add_control(
				'pause_on_hover',
				[
					'label'   => esc_html__( 'Pause on Hover', 'qomfort' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'qomfort' ),
						'no'  => esc_html__( 'No', 'qomfort' ),
					],
					'frontend_available' => true,
				]
			);


			$this->add_control(
				'infinite',
				[
					'label'   => esc_html__( 'Infinite Loop', 'qomfort' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'qomfort' ),
						'no'  => esc_html__( 'No', 'qomfort' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'autoplay',
				[
					'label'   => esc_html__( 'Autoplay', 'qomfort' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'qomfort' ),
						'no'  => esc_html__( 'No', 'qomfort' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'autoplay_speed',
				[
					'label'     => esc_html__( 'Autoplay Speed', 'qomfort' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => 3000,
					'step'      => 500,
					'condition' => [
						'autoplay' => 'yes',
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'smartspeed',
				[
					'label'   => esc_html__( 'Smart Speed', 'qomfort' ),
					'type'    => Controls_Manager::NUMBER,
					'default' => 500,
				]
			);

			$this->add_control(
				'dot_control',
				[
					'label'   => esc_html__( 'Show Dots', 'qomfort' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'qomfort' ),
						'no'  => esc_html__( 'No', 'qomfort' ),
					],
					'frontend_available' => true,
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_slide',
			[
				'label' => esc_html__( 'Style', 'qomfort' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'content_testimonial_typography',
					'selector' => '{{WRAPPER}} .ova-slide .title_slide a',
				]
			);

			$this->add_control(
				'content_color',
				[
					'label'     => esc_html__( 'Color', 'qomfort' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-slide .title_slide a' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'content_color_hover',
				[
					'label'     => esc_html__( 'Color Hover', 'qomfort' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-slide .title_slide a:hover' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'content_padding',
				[
					'label'      => esc_html__( 'Padding', 'qomfort' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-slide .title_slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'content_color_dot',
				[
					'label'     => esc_html__( 'Color Dot', 'qomfort' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-slide .owl-dots .owl-dot.active span' => 'background-color : {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();
	}

	// Render Template Here
	protected function render() {
		$settings = $this->get_settings();

		$tab_item = $settings['tab_item'];

		$data_options['items']              = $settings['item_number'];
		$data_options['slideBy']            = $settings['slides_to_scroll'];
		$data_options['margin']             = $settings['margin_items'];
		$data_options['autoplayHoverPause'] = $settings['pause_on_hover'] === 'yes' ? true : false;
		$data_options['loop']               = $settings['infinite'] === 'yes' ? true : false;
		$data_options['autoplay']           = $settings['autoplay'] === 'yes' ? true : false;
		$data_options['autoplayTimeout']    = $settings['autoplay_speed'];
		$data_options['smartSpeed']         = $settings['smartspeed'];
		$data_options['dots']               = $settings['dot_control'] === 'yes' ? true : false;

		?>

			<div class="ova-slide">

				<div class="slide owl-carousel owl-theme" data-options="<?php echo esc_attr(json_encode($data_options)) ?>">

					<?php if(!empty($tab_item)) : foreach ($tab_item as $item) : ?>

						<div class="item">
								
							<div class="image_slide">
								<?php if( $item['image'] != '' ) { ?>
									<a href="<?php echo esc_html($item['link']) ?>" target="_blank"><img src="<?php echo esc_attr($item['image']['url']) ?>" alt=""></a>
								<?php } ?>
							</div>

							<div class="title_slide">
								<?php if( $item['title'] != '' ) { ?>
								<a href="<?php echo esc_url($item['link']) ?>" target="_blank"><span class="title"><?php echo esc_html($item['title']) ?></span></a>
								<?php } ?>
							</div>
						
						</div>

					<?php endforeach; endif; ?>

				</div>

			</div>

		<?php
	}

	
}
$widgets_manager->register( new Qomfort_Elementor_Images_Slide() );