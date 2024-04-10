<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Qomfort_Elementor_Icon_Box extends Widget_Base {

	public function get_name() {
		return 'qomfort_elementor_icon_box';
	}

	public function get_title() {
		return esc_html__( 'Ova Icon Box', 'qomfort' );
	}

	public function get_icon() {
		return 'eicon-icon-box';
	}

	public function get_categories() {
		return [ 'qomfort' ];
	}

	public function get_script_depends() {
		return [ '' ];
	}
	
	// Add Your Controll In This Function
	protected function register_controls() {

		/* Content */
		$this->start_controls_section(
				'section_content',
				[
					'label' => esc_html__( 'Content', 'qomfort' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);

			$this->add_control(
				'template',
				[
					'label' => esc_html__( 'Template', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'template_1',
					'options' => [
						'template_1' => esc_html__( 'Template 1', 'qomfort' ),
						'template_2' => esc_html__( 'Template 2', 'qomfort' ),
						'template_3' => esc_html__( 'Template 3', 'qomfort' ),
					],
				]
			);

			$this->add_control(
				'icon',
				[
					'label' => esc_html__( 'Icon', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'qomfort-mop',
						'library' => 'all',
					],
				]
			);

			$this->add_control(
				'title',
				[
					'label' => esc_html__( 'Title', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Room Cleaning and Guide', 'qomfort' ),
					'placeholder' => esc_html__( 'Type your title here', 'qomfort' ),
					'label_block' => true,
				]
			);

			$this->add_control(
				'desc',
				[
					'label' => esc_html__( 'Description', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'rows' => 5,
					'default' => esc_html__( 'To take a trivial example which of ever undertakes laborious exerc obtain', 'qomfort' ),
					'placeholder' => esc_html__( 'Type your description here', 'qomfort' ),
				]
			);

			$this->add_control(
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

			$this->add_control(
				'text_link',
				[
					'label' => esc_html__( 'Text Link', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Read More', 'qomfort' ),
				]
			);

			$this->add_responsive_control(
				'text_align',
				[
					'label' => esc_html__( 'Alignment', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'qomfort' ),
							'icon' => 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'qomfort' ),
							'icon' => 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'qomfort' ),
							'icon' => 'eicon-text-align-right',
						],
					],
					'toggle' => true,
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box' => 'text-align: {{VALUE}};',
					],
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
				'item_padding',
				[
					'label' => esc_html__( 'Padding', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
							'selector' => '{{WRAPPER}} .ova-icon-box',
						]
					);

					$this->add_control(
						'item_bg',
						[
							'label' => esc_html__( 'Background', 'qomfort' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-icon-box' => 'background: {{VALUE}}',
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
							'selector' => '{{WRAPPER}} .ova-icon-box:hover',
						]
					);

					$this->add_control(
						'item_bg_hover',
						[
							'label' => esc_html__( 'Background', 'qomfort' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-icon-box:hover' => 'background: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

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
						'{{WRAPPER}} .ova-icon-box .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .ova-icon-box .icon svg' => 'width: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-icon-box .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs(
					'icon_style_tabs'
				);

				$this->start_controls_tab(
						'icon_style_normal_tab',
						[
							'label' => esc_html__( 'Normal', 'qomfort' ),
						]
					);

					$this->add_control(
						'icon_bg',
						[
							'label' => esc_html__( 'Background', 'qomfort' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-icon-box .icon' => 'background: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'icon_color',
						[
							'label' => esc_html__( 'Color', 'qomfort' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-icon-box .icon i' => 'color: {{VALUE}}',
								'{{WRAPPER}} .ova-icon-box .icon svg' => 'fill: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
						'icon_style_hover_tab',
						[
							'label' => esc_html__( 'Hover', 'qomfort' ),
						]
					);

					$this->add_control(
						'icon_bg_hover',
						[
							'label' => esc_html__( 'Background', 'qomfort' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-icon-box:hover .icon' => 'background: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'icon_color_hover',
						[
							'label' => esc_html__( 'Color', 'qomfort' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-icon-box:hover .icon i' => 'color: {{VALUE}}',
								'{{WRAPPER}} .ova-icon-box:hover .icon svg' => 'fill: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

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
						'{{WRAPPER}} .ova-icon-box .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .ova-icon-box .title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box .title' => 'color: {{VALUE}}',
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
						'{{WRAPPER}} .ova-icon-box .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'desc_typography',
					'selector' => '{{WRAPPER}} .ova-icon-box .desc',
				]
			);

			$this->add_control(
				'desc_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box .desc' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		/* Text Link */
		$this->start_controls_section(
				'text_link_style_section',
				[
					'label' => esc_html__( 'Text Link', 'qomfort' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'text_link_margin',
				[
					'label' => esc_html__( 'Margin', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box .text_link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'text_link_typography',
					'selector' => '{{WRAPPER}} .ova-icon-box .text_link',
				]
			);

			$this->start_controls_tabs(
					'text_link_style_tabs'
				);

				$this->start_controls_tab(
						'text_link_style_normal_tab',
						[
							'label' => esc_html__( 'Normal', 'qomfort' ),
						]
					);

					$this->add_control(
						'text_link_color',
						[
							'label' => esc_html__( 'Color', 'qomfort' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-icon-box .text_link' => 'color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
						'text_link_style_hover_tab',
						[
							'label' => esc_html__( 'Hover', 'qomfort' ),
						]
					);

					$this->add_control(
						'text_link_color_hover',
						[
							'label' => esc_html__( 'Color', 'qomfort' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-icon-box .text_link:hover' => 'color: {{VALUE}}',
								'{{WRAPPER}} .ova-icon-box .text_link:before' => 'background: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();
	}

	// Render Template Here
	protected function render() {
		$settings 	= $this->get_settings();
		$template 	= $settings['template'];
		$title 		= $settings['title'];
		$desc 		= $settings['desc'];
		$link 		= $settings['link'];
		$text_link 	= $settings['text_link'];
		$nofollow 	= $link['nofollow'] 	? 'rel="nofollow"' 	: '';
		$target 	= $link['is_external'] 	? 'target="_blank"' : '';
		?>
		<div class="ova-icon-box <?php echo esc_attr( $template ); ?>">
			<?php if ( $settings['icon'] ): ?>
				<div class="icon">
					<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
				</div>
			<?php endif; ?>
			<?php if ( $title ): ?>
				<h3 class="title"><?php echo esc_html( $title ); ?></h3>
			<?php endif; ?>
			<?php if ( $desc ): ?>
				<p class="desc"><?php echo esc_html( $desc ); ?></p>
			<?php endif; ?>
			<?php if ( $text_link ): ?>
				<a href="<?php echo esc_url( $link['url'] ); ?>" class="text_link" title="<?php echo esc_attr( $text_link ); ?>" <?php printf( '%1$s %2$s', $nofollow, $target ); ?>>
					<?php echo esc_html( $text_link ); ?>
					<i class="fas fa-chevron-right" aria-hidden="true"></i>
				</a>
			<?php endif; ?>
		</div>
		<?php
	}

	
}
$widgets_manager->register( new Qomfort_Elementor_Icon_Box() );