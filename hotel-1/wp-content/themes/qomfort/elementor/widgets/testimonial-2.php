<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Qomfort_Elementor_Testimonial_2 extends Widget_Base {

	public function get_name() {
		return 'qomfort_elementor_testimonial_2';
	}

	public function get_title() {
		return esc_html__( 'Ova Testimonial 2', 'qomfort' );
	}

	public function get_icon() {
		return 'eicon-testimonial';
	}

	public function get_categories() {
		return [ 'qomfort' ];
	}

	public function get_script_depends() {
		return [ 'qomfort-elementor-testimonial-2' ];
	}
	
	// Add Your Controll In This Function
	protected function register_controls() {

		/* Content */
		$this->start_controls_section(
				'section_content',
				[
					'label' => esc_html__( 'Content', 'qomfort' ),
				]
			);

			$repeater = new \Elementor\Repeater();

				$repeater->add_control(
					'featured_image',
					[
						'label'   => esc_html__( 'Featured Image', 'qomfort' ),
						'type'    => \Elementor\Controls_Manager::MEDIA,
						'default' => [
							'url' => Utils::get_placeholder_image_src(),
						],
					]
				);

				$repeater->add_control(
					'image_author',
					[
						'label'   => esc_html__( 'Author Image', 'qomfort' ),
						'type'    => \Elementor\Controls_Manager::MEDIA,
						'default' => [
							'url' => Utils::get_placeholder_image_src(),
						],
					]
				);

				$repeater->add_control(
					'name_author',
					[
						'label'   => esc_html__( 'Author Name', 'qomfort' ),
						'type'    => \Elementor\Controls_Manager::TEXT,
					]
				);

				$repeater->add_control(
					'job',
					[
						'label'   => esc_html__( 'Job', 'qomfort' ),
						'type'    => \Elementor\Controls_Manager::TEXT,

					]
				);

				$repeater->add_control(
					'testimonial',
					[
						'label'   => esc_html__( 'Testimonial', 'qomfort' ),
						'type'    => \Elementor\Controls_Manager::TEXTAREA,
						'default' => esc_html__( 'At vero eoset accusamus ustodio dignissimos ducimus quiebla nditiis praesentium voluptatu deleniti atque corrupti quolores mole sintocc', 'qomfort' ),
					]
				);

				$this->add_control(
					'tab_item',
					[
						'label'       => esc_html__( 'Items Testimonial', 'qomfort' ),
						'type'        => \Elementor\Controls_Manager::REPEATER,
						'fields'      => $repeater->get_controls(),
						'default' => [
							[
								'name_author' => esc_html__( 'Diane C. Valentine', 'qomfort' ),
								'job' => esc_html__( 'CEO & Founder', 'qomfort' ),
							],
							[
								'name_author' => esc_html__( 'Myrtle W. Daughert', 'qomfort' ),
								'job' => esc_html__( 'Web Developer', 'qomfort' ),
							],
							[
								'name_author' => esc_html__( 'Marketing Officer', 'qomfort' ),
								'job' => esc_html__( 'Senior Manager', 'qomfort' ),
							],
							[
								'name_author' => esc_html__( 'Nicholas J. England', 'qomfort' ),
								'job' => esc_html__( 'Graphics Designer', 'qomfort' ),
							],
						],
						'title_field' => '{{{ name_author }}}',
					]
				);

		$this->end_controls_section();

		/*****************  END SECTION CONTENT ******************/


		/*****************************************************************
						START SECTION ADDITIONAL
		******************************************************************/

		$this->start_controls_section(
			'section_additional_options',
			[
				'label' => esc_html__( 'Additional Options', 'qomfort' ),
			]
		);

		/***************************  VERSION 1 ***********************/
			$this->add_control(
				'margin_items',
				[
					'label'   => esc_html__( 'Margin Right Items', 'qomfort' ),
					'type'    => \Elementor\Controls_Manager::NUMBER,
					'default' => 30,
				]
				
			);

			$this->add_control(
				'item_number',
				[
					'label'       => esc_html__( 'Item Number', 'qomfort' ),
					'type'        => \Elementor\Controls_Manager::NUMBER,
					'description' => esc_html__( 'Number Item', 'qomfort' ),
					'default'     => 1,
				]
			);

			$this->add_control(
				'slides_to_scroll',
				[
					'label'       => esc_html__( 'Slides to Scroll', 'qomfort' ),
					'type'        => \Elementor\Controls_Manager::NUMBER,
					'description' => esc_html__( 'Set how many slides are scrolled per swipe.', 'qomfort' ),
					'default'     => 1,
				]
			);

			$this->add_control(
				'pause_on_hover',
				[
					'label'   => esc_html__( 'Pause on Hover', 'qomfort' ),
					'type'    => \Elementor\Controls_Manager::SWITCHER,
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
					'type'    => \Elementor\Controls_Manager::SWITCHER,
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
					'type'    => \Elementor\Controls_Manager::SWITCHER,
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
					'type'      => \Elementor\Controls_Manager::NUMBER,
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
					'type'    => \Elementor\Controls_Manager::NUMBER,
					'default' => 500,
				]
			);

			$this->add_control(
				'dot_control',
				[
					'label'   => esc_html__( 'Show Dots', 'qomfort' ),
					'type'    => \Elementor\Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'qomfort' ),
						'no'  => esc_html__( 'No', 'qomfort' ),
					],
					'frontend_available' => true,
				]
			);

		$this->end_controls_section();

		/****************************  END SECTION ADDITIONAL *********************/

		/* General */
		$this->start_controls_section(
			'section_general',
					[
						'label' => esc_html__( 'General', 'qomfort' ),
						'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
					]
				);

			$this->add_responsive_control(
				'slider_padding',
				[
					'label' => esc_html__( 'Padding', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial-2 .owl-stage-outer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'quote_color',
				[
					'label'     => esc_html__( 'Quote', 'qomfort' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial-2 .wrapper .client_info .testimonial .icon i' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'rate_color',
				[
					'label'     => esc_html__( 'Rate', 'qomfort' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial-2 .wrapper .client_info .rating i' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'dot_active_color',
				[
					'label'     => esc_html__( 'Dot Active Color', 'qomfort' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial-2 .slide-testimonials .owl-dots .owl-dot.active span' => 'background: {{VALUE}};',
						'{{WRAPPER}} .ova-testimonial-2 .slide-testimonials .owl-dots .owl-dot.active' => 'outline-color: {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();

		/* Items */
		$this->start_controls_section(
			'items_section_style',
					[
						'label' => esc_html__( 'Items', 'qomfort' ),
						'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
					]
				);

			$this->add_responsive_control(
				'items_margin',
				[
					'label' => esc_html__( 'Margin', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial-2 .wrapper .client_info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'items_padding',
				[
					'label' => esc_html__( 'Padding', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial-2 .wrapper .client_info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'items_bg',
				[
					'label' => esc_html__( 'Background', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial-2 .wrapper' => 'background: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		/* Testimonial */
		$this->start_controls_section(
			'testimonial_section_style',
					[
						'label' => esc_html__( 'Testimonial', 'qomfort' ),
						'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
					]
				);

			$this->add_responsive_control(
				'testimonial_margin',
				[
					'label' => esc_html__( 'Margin', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial-2 .client_info .testimonial' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'testimonial_typography',
					'selector' => '{{WRAPPER}} .ova-testimonial-2 .wrapper .client_info .testimonial .text',
				]
			);

			$this->add_control(
				'testimonial_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial-2 .wrapper .client_info .testimonial .text' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		/* Name */
		$this->start_controls_section(
			'name_section_style',
					[
						'label' => esc_html__( 'Name', 'qomfort' ),
						'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
					]
				);

			$this->add_responsive_control(
				'name_margin',
				[
					'label' => esc_html__( 'Margin', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial-2 .wrapper .client_info .info .name-job .name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'name_typography',
					'selector' => '{{WRAPPER}} .ova-testimonial-2 .wrapper .client_info .info .name-job .name',
				]
			);

			$this->add_control(
				'name_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial-2 .wrapper .client_info .info .name-job .name' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		/* Job */
		$this->start_controls_section(
			'job_section_style',
					[
						'label' => esc_html__( 'Job', 'qomfort' ),
						'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
					]
				);

			$this->add_responsive_control(
				'job_margin',
				[
					'label' => esc_html__( 'Margin', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial-2 .wrapper .client_info .info .name-job .job' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'job_typography',
					'selector' => '{{WRAPPER}} .ova-testimonial-2 .wrapper .client_info .info .name-job .job',
				]
			);

			$this->add_control(
				'job_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial-2 .wrapper .client_info .info .name-job .job' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();
	}

	// Render Template Here
	protected function render() {
		$settings 	= $this->get_settings();
		$tab_item 	= $settings['tab_item'];
		
		$data_options['items']              = $settings['item_number'];
		$data_options['slideBy']            = $settings['slides_to_scroll'];
		$data_options['margin']             = $settings['margin_items'];
		$data_options['autoplayHoverPause'] = $settings['pause_on_hover'] === 'yes' ? true : false;
		$data_options['loop']               = $settings['infinite'] === 'yes' ? true : false;
		$data_options['autoplay']           = $settings['autoplay'] === 'yes' ? true : false;
		$data_options['autoplayTimeout']    = $settings['autoplay_speed'];
		$data_options['smartSpeed']         = $settings['smartspeed'];
		$data_options['dots']               = $settings['dot_control'] === 'yes' ? true : false;
		$data_options['rtl']				= is_rtl() ? true : false;
		?>

		<section class="ova-testimonial-2">
			<div class="slide-testimonials owl-carousel owl-theme " data-options="<?php echo esc_attr(json_encode($data_options)) ?>">
				<?php if ( ! empty( $tab_item ) ) : foreach( $tab_item as $item ): ?>
					<?php
					$image_author 		= $item['image_author'];
					$image_author_id 	= $image_author['id'];
					$image_author_alt 	= '';
					if ( $image_author_id ) {
						$image_author_alt = get_post_meta( $image_author_id, '_wp_attachment_image_alt', true );
						if ( ! $image_author_alt ) {
							$image_author_alt = get_the_title( $image_author_id );
						}
					}
					$featured_image 	= $item['featured_image'];
					$featured_image_id 	= $featured_image['id'];
					$featured_image_alt = '';
					if ( $featured_image_id ) {
						$featured_image_alt = get_post_meta( $featured_image_id, '_wp_attachment_image_alt', true );
						if ( ! $featured_image_alt ) {
							$featured_image_alt = get_the_title( $featured_image_id );
						}
					}
					$testimonial 	= $item['testimonial'];
					$name_author 	= $item['name_author'];
					$job 			= $item['job'];
					?>
					<div class="item">
						<div class="wrapper">
							<div class="client_info">
								<div class="info">
									<div class="client">
										<?php if ( $image_author['url'] ) { ?>
											<img src="<?php echo esc_url( $image_author['url'] ); ?>"
											alt="<?php echo esc_attr( $image_author_alt ); ?>" >
										<?php } ?>
									</div>
									<div class="name-job">
										<?php if ( $name_author ) { ?>
											<p class="name">
												<?php echo esc_html( $name_author ); ?>
											</p>
										<?php } ?>
										<?php if ( $job) { ?>
											<p class="job">
												<?php echo esc_html( $job ); ?>
											</p>
										<?php } ?>
									</div>
								</div>
								
								<?php if ( $testimonial ): ?>
									<p class="testimonial">
										<span class="icon"><i class="ovaicon ovaicon-left-quotes-sign" aria-hidden="true"></i></span>
										<span class="text"><?php echo esc_html( $testimonial ); ?></span>
										<span class="icon icon-rotate"><i class="ovaicon ovaicon-left-quotes-sign" aria-hidden="true"></i></span>
									</p>
								<?php endif; ?>
								<div class="rating">
									<i class="fas fa-star" aria-hidden="true"></i>
									<i class="fas fa-star" aria-hidden="true"></i>
									<i class="fas fa-star" aria-hidden="true"></i>
									<i class="fas fa-star" aria-hidden="true"></i>
									<i class="fas fa-star" aria-hidden="true"></i>
								</div>
							</div>
							<div class="featured_image">
								<?php if ( $featured_image['url'] ): ?>
									<img src="<?php echo esc_url( $featured_image['url'] ); ?>"
									alt="<?php echo esc_attr( $featured_image_alt ); ?>">
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endforeach; endif; ?>
			</div>
		</section>
		<?php
	}

	
}
$widgets_manager->register( new Qomfort_Elementor_Testimonial_2() );