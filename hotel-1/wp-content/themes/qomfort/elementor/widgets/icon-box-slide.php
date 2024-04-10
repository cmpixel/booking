<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Qomfort_Elementor_Icon_Box_Slide extends Widget_Base {

	public function get_name() {
		return 'qomfort_elementor_icon_box_slide';
	}

	public function get_title() {
		return esc_html__( 'Ova Icon Box Slide', 'qomfort' );
	}

	public function get_icon() {
		return 'eicon-icon-box';
	}

	public function get_categories() {
		return [ 'qomfort' ];
	}

	public function get_script_depends() {
		return [ 'qomfort-elementor-icon-box-slide' ];
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
				'link',
				[
					'label' => esc_html__( 'Link', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::URL,
					'placeholder' => esc_html__( 'https://your-link.com', 'qomfort' ),
					'options' => [ 'url', 'is_external', 'nofollow' ],
					'default' => [
						'url' => '',
						'is_external' => false,
						'nofollow' => false,
					],
					'label_block' => true,
				]
			);

			$repeater->add_control(
				'icon',
				[
					'label' => esc_html__( 'Icon', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'qomfort-stationary-bike',
						'library' => 'all',
					],
				]
			);

			$repeater->add_control(
				'title',
				[
					'label' => esc_html__( 'Title', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Fitness Center', 'qomfort' ),
					'placeholder' => esc_html__( 'Type your title here', 'qomfort' ),
					'label_block' => true,
				]
			);

			$repeater->add_control(
				'desc',
				[
					'label' => esc_html__( 'Description', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'rows' => 5,
					'default' => esc_html__( 'At vero eos accusamus simos blande praesente tatum', 'qomfort' ),
					'placeholder' => esc_html__( 'Type your description here', 'qomfort' ),
				]
			);

			$this->add_control(
				'tab_item',
				[
					'label' => esc_html__( 'Items', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'icon' => [
								'value' => 'qomfort-stationary-bike',
							],
							'title' => esc_html__( 'Fitness Center', 'qomfort' ),
							'desc' => esc_html__( 'At vero eos accusamus simos blande praesente tatum', 'qomfort' ),
						],
						[
							'icon' => [
								'value' => 'qomfort-jacuzzi',
							],
							'title' => esc_html__( 'Jacuzzi', 'qomfort' ),
							'desc' => esc_html__( 'Libero tempore cum soluta to eligende optio cumque', 'qomfort' ),
						],
						[
							'icon' => [
								'value' => 'qomfort-swim',
							],
							'title' => esc_html__( 'Swimming Pool', 'qomfort' ),
							'desc' => esc_html__( 'Blinded by desirec that cannot foresies trouble bounde', 'qomfort' ),
						],
						[
							'icon' => [
								'value' => 'qomfort-relax',
							],
							'title' => esc_html__( 'SPA Treatments', 'qomfort' ),
							'desc' => esc_html__( 'At vero eos accusamus simos blande praesente tatum', 'qomfort' ),
						],
						[
							'icon' => [
								'value' => 'qomfort-restaurant',
							],
							'title' => esc_html__( 'Restaurants', 'qomfort' ),
							'desc' => esc_html__( 'Nam libero tempores eligende optio cumque impedit quo', 'qomfort' ),
						],
						[
							'icon' => [
								'value' => 'qomfort-transportation',
							],
							'title' => esc_html__( 'Transportation', 'qomfort' ),
							'desc' => esc_html__( 'Libero tempore cum soluta to eligende optio cumque', 'qomfort' ),
						],
						[
							'icon' => [
								'value' => 'qomfort-champagne',
							],
							'title' => esc_html__( 'Lounge bar', 'qomfort' ),
							'desc' => esc_html__( 'Blinded by desirec that cannot foresies trouble bounde', 'qomfort' ),
						],
						[
							'icon' => [
								'value' => 'qomfort-laundry-machine',
							],
							'title' => esc_html__( 'Laundry Services', 'qomfort' ),
							'desc' => esc_html__( 'At vero eos accusamus simos blande praesente tatum', 'qomfort' ),
						],
					],
					'title_field' => '{{{ title }}}',
				]
			);

		$this->end_controls_section();

		/* Additional Options */
		$this->start_controls_section(
				'section_additional_options',
				[
					'label' => esc_html__( 'Additional Options', 'qomfort' ),
				]
			);

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
					'default'     => 4,
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

		/* General */
		$this->start_controls_section(
				'style_section',
				[
					'label' => esc_html__( 'General', 'qomfort' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'items_padding',
				[
					'label' => esc_html__( 'Padding', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box-slide .slider .owl-stage-outer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		/* Items */
		$this->start_controls_section(
				'item_style_section',
				[
					'label' => esc_html__( 'Items', 'qomfort' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'item_padding',
				[
					'label' => esc_html__( 'Padding', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box-slide .card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs(
					'item_style_tabs'
				);

				$this->start_controls_tab(
						'item_style_normal_tab',
						[
							'label' => esc_html__( 'Normal', 'qomfort' ),
						]
					);

					$this->add_group_control(
						\Elementor\Group_Control_Box_Shadow::get_type(),
						[
							'name' => 'item_box_shadow',
							'selector' => '{{WRAPPER}} .ova-icon-box-slide .card',
						]
					);

					$this->add_control(
						'item_bg',
						[
							'label' => esc_html__( 'Background', 'qomfort' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-icon-box-slide .card' => 'background: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
						'item_style_hover_tab',
						[
							'label' => esc_html__( 'Hover', 'qomfort' ),
						]
					);

					$this->add_group_control(
						\Elementor\Group_Control_Box_Shadow::get_type(),
						[
							'name' => 'item_box_shadow_hover',
							'selector' => '{{WRAPPER}} .ova-icon-box-slide .card:hover',
						]
					);

					$this->add_control(
						'item_bg_hover',
						[
							'label' => esc_html__( 'Background', 'qomfort' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-icon-box-slide .card:hover' => 'background: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();

		/* Number */
		$this->start_controls_section(
				'number_style_section',
				[
					'label' => esc_html__( 'Number', 'qomfort' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'number_margin',
				[
					'label' => esc_html__( 'Margin', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box-slide .card .number' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'number_typography',
					'selector' => '{{WRAPPER}} .ova-icon-box-slide .card .number',
				]
			);

			$this->add_control(
				'number_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box-slide .card .number' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		/* Title */
		$this->start_controls_section(
				'title_style_section',
				[
					'label' => esc_html__( 'Title', 'qomfort' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'title_margin',
				[
					'label' => esc_html__( 'Margin', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box-slide .card .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .ova-icon-box-slide .card .title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box-slide .card .title' => 'color: {{VALUE}}',
						'{{WRAPPER}} .ova-icon-box-slide .card .title a' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		/* Description */
		$this->start_controls_section(
				'desc_style_section',
				[
					'label' => esc_html__( 'Description', 'qomfort' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'desc_margin',
				[
					'label' => esc_html__( 'Margin', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box-slide .card .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'desc_typography',
					'selector' => '{{WRAPPER}} .ova-icon-box-slide .card .desc',
				]
			);

			$this->add_control(
				'desc_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box-slide .card .desc' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		/* Icon */
		$this->start_controls_section(
				'icon_style_section',
				[
					'label' => esc_html__( 'Icon', 'qomfort' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'icon_margin',
				[
					'label' => esc_html__( 'Margin', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box-slide .card .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'icon_size',
				[
					'label' => esc_html__( 'Size', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
							'step' => 5,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box-slide .card .icon svg' => 'width: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-icon-box-slide .card .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'icon_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box-slide .card .icon i' => 'color: {{VALUE}}',
						'{{WRAPPER}} .ova-icon-box-slide .card .icon svg' => 'fill: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();
	}

	// Render Template Here
	protected function render() {
		$settings = $this->get_settings();
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
		<div class="ova-icon-box-slide">
			<div class="slider owl-carousel owl-theme" data-options="<?php echo esc_attr(json_encode($data_options)) ?>">

				<?php if ( $tab_item ): ?>
					<?php foreach ( $tab_item as $key => $item ): ?>
						<?php
						$title 		= $item['title'];
						$desc 		= $item['desc'];
						$link 		= $item['link'];
						$nofollow 	= $link['nofollow'] 	? 'rel="nofollow"' 	: '';
						$target 	= $link['is_external'] 	? 'target="_blank"' : '';
						$number 	= ( $key + 1 ) < 10 ? '0' . ( $key + 1 ) : ( $key + 1 );
						?>
						<div class="item">
							<div class="card">
								<p class="number"><?php echo esc_html( $number ); ?></p>
								<?php if ( $title ): ?>
									<?php if ( $link['url'] ): ?>
										<h3 class="title">
											<a href="<?php echo esc_url( $link['url'] ); ?>" title="<?php echo esc_attr( $title ); ?>" <?php printf( '%1$s %2$s', $nofollow, $target ); ?>>
												<?php echo esc_html( $title ); ?>
											</a>
										</h3>
									<?php else: ?>
										<h3 class="title"><?php echo esc_html( $title ); ?></h3>
									<?php endif; ?>
								<?php endif; ?>
								<?php if ( $desc ): ?>
									<p class="desc"><?php echo esc_html( $desc ); ?></p>
								<?php endif; ?>
								<?php if ( $item['icon'] ): ?>
									<div class="icon">
										<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
									</div>
								<?php endif; ?>
							</div>
						</div>

					<?php endforeach; ?>
				<?php endif; ?>

			</div>
		</div>
		<?php
	}

	
}
$widgets_manager->register( new Qomfort_Elementor_Icon_Box_Slide() );