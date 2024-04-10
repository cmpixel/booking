<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Qomfort_Elementor_Price extends Widget_Base {

	public function get_name() {
		return 'qomfort_elementor_price';
	}

	public function get_title() {
		return esc_html__( 'Price', 'qomfort' );
	}

	public function get_icon() {
		return 'eicon-price-table';
	}

	public function get_categories() {
		return [ 'qomfort' ];
	}

	public function get_script_depends() {
		return [ '' ];
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
			'title',
			[
				'label' => esc_html__( 'Title', 'qomfort' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Basic Plan', 'qomfort' ),
				'placeholder' => esc_html__( 'Type your title here', 'qomfort' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'price',
			[
				'label' => esc_html__( 'Price', 'qomfort' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '$19.56', 'qomfort' ),
				'placeholder' => esc_html__( 'Type your price here', 'qomfort' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'after_price',
			[
				'label' => esc_html__( 'After Price', 'qomfort' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'per month', 'qomfort' ),
				'placeholder' => esc_html__( 'Type your text here', 'qomfort' ),
				'label_block' => true,
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
				'default' => esc_html__( 'Choose Package', 'qomfort' ),
				'placeholder' => esc_html__( 'Type your text link here', 'qomfort' ),
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'qomfort' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-check',
					'library' => 'all',
				],
			]
		);

		$repeater->add_control(
			'list_title',
			[
				'label' => esc_html__( 'List Title', 'qomfort' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Type your title here', 'qomfort' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'active',
			[
				'label' => esc_html__( 'Active', 'qomfort' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'qomfort' ),
				'label_off' => esc_html__( 'No', 'qomfort' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Items', 'qomfort' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => esc_html__( 'Transportations', 'qomfort' ),
						'active' => 'yes',
					],
					[
						'list_title' => esc_html__( 'SPA Treatment', 'qomfort' ),
						'active' => 'yes',
					],
					[
						'list_title' => esc_html__( 'Food & Drinks', 'qomfort' ),
					],
					[
						'list_title' => esc_html__( 'GYM & Yoga', 'qomfort' ),
					],
					[
						'list_title' => esc_html__( 'Hotel Guide', 'qomfort' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->end_controls_section();

		/* General */
		$this->start_controls_section(
				'general_style_section',
				[
					'label' => esc_html__( 'General', 'qomfort' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'general_padding',
				[
					'label' => esc_html__( 'Padding', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'general_bg',
					'types' => [ 'classic', 'gradient', 'video' ],
					'selector' => '{{WRAPPER}} .ova-price',
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
						'{{WRAPPER}} .ova-price .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .ova-price .title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-price .title' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		/* Price */
		$this->start_controls_section(
				'price_style_section',
				[
					'label' => esc_html__( 'Price', 'qomfort' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'price_margin',
				[
					'label' => esc_html__( 'Margin', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-price .price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'price_typography',
					'selector' => '{{WRAPPER}} .ova-price .price',
				]
			);

			$this->add_control(
				'price_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-price .price' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		/* After Price */
		$this->start_controls_section(
				'after_price_style_section',
				[
					'label' => esc_html__( 'After Price', 'qomfort' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'after_price_margin',
				[
					'label' => esc_html__( 'Margin', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-price .after_price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'after_price_typography',
					'selector' => '{{WRAPPER}} .ova-price .after_price',
				]
			);

			$this->add_control(
				'after_price_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-price .after_price' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		/* List Items */
		$this->start_controls_section(
				'items_style_section',
				[
					'label' => esc_html__( 'List Items', 'qomfort' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'items_margin',
				[
					'label' => esc_html__( 'Margin', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-price .list-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .ova-price .list-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'items_border',
					'selector' => '{{WRAPPER}} .ova-price .list-item',
				]
			);

			/* Icon */
			$this->add_control(
				'icon_style',
				[
					'label' => esc_html__( 'Icon', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
				'icon_margin',
				[
					'label' => esc_html__( 'Margin', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-price .list-item .item .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .ova-price .list-item .item .icon svg' => 'width: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-price .list-item .item .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
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
						'icon_color',
						[
							'label' => esc_html__( 'Color', 'qomfort' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-price .list-item .item .icon i' => 'color: {{VALUE}}',
								'{{WRAPPER}} .ova-price .list-item .item .icon svg' => 'fill: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
						'icon_style_active_tab',
						[
							'label' => esc_html__( 'Active', 'qomfort' ),
						]
					);

					$this->add_control(
						'icon_color_active',
						[
							'label' => esc_html__( 'Color', 'qomfort' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-price .list-item .item.active .icon i' => 'color: {{VALUE}}',
								'{{WRAPPER}} .ova-price .list-item .item.active .icon svg' => 'fill: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

			/* Text */
			$this->add_control(
				'text_style',
				[
					'label' => esc_html__( 'Text', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
				'text_margin',
				[
					'label' => esc_html__( 'Margin', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-price .list-item .item .text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'text_typography',
					'selector' => '{{WRAPPER}} .ova-price .list-item .item .text',
				]
			);

			$this->start_controls_tabs(
					'text_style_tabs'
				);

				$this->start_controls_tab(
						'text_style_normal_tab',
						[
							'label' => esc_html__( 'Normal', 'qomfort' ),
						]
					);

					$this->add_control(
						'text_color',
						[
							'label' => esc_html__( 'Color', 'qomfort' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-price .list-item .item .text' => 'color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
						'text_style_active_tab',
						[
							'label' => esc_html__( 'Active', 'qomfort' ),
						]
					);

					$this->add_control(
						'text_color_active',
						[
							'label' => esc_html__( 'Color', 'qomfort' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-price .list-item .item.active .text' => 'color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

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
						'{{WRAPPER}} .ova-price .text_link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'text_link_padding',
				[
					'label' => esc_html__( 'Padding', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-price .text_link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'text_link_typography',
					'selector' => '{{WRAPPER}} .ova-price .text_link',
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
						'text_link_bg',
						[
							'label' => esc_html__( 'Background', 'qomfort' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-price .text_link' => 'background: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'text_link_color',
						[
							'label' => esc_html__( 'Color', 'qomfort' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-price .text_link' => 'color: {{VALUE}}',
								'{{WRAPPER}} .ova-price .text_link i' => 'color: {{VALUE}}',
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
						'text_link_bg_hover',
						[
							'label' => esc_html__( 'Background', 'qomfort' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-price .text_link:hover' => 'background: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'text_link_color_hover',
						[
							'label' => esc_html__( 'Color', 'qomfort' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-price .text_link:hover' => 'color: {{VALUE}}',
								'{{WRAPPER}} .ova-price .text_link:hover i' => 'color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();
	}

	// Render Template Here
	protected function render() {
		$settings 		= $this->get_settings();
		$title 			= $settings['title'];
		$price 			= $settings['price'];
		$after_price 	= $settings['after_price'];
		$list 			= $settings['list'];
		$link 			= $settings['link'];
		$text_link 		= $settings['text_link'];
		$nofollow 		= $link['nofollow'] 	? 'rel="nofollow"' 	: '';
		$target 		= $link['is_external'] 	? 'target="_blank"' : '';
		?>
		<div class="ova-price">
			<?php if ( $title ): ?>
				<h3 class="title"><?php echo esc_html( $title ); ?></h3>
			<?php endif; ?>
			<?php if ( $price ): ?>
				<p class="price"><?php echo esc_html( $price ); ?></p>
			<?php endif; ?>
			<?php if ( $after_price ): ?>
				<p class="after_price"><?php echo esc_html( $after_price ); ?></p>
			<?php endif; ?>
			<?php if ( $list ): ?>
				<ul class="list-item">
					<?php foreach ($list as $key => $item): ?>
						<?php
							$list_title = $item['list_title'];
							$active 	= $item['active'] == 'yes' ? 'active' : '';
						?>
						<li class="item <?php echo esc_attr( $active ); ?>">
							<?php if ( $item['icon'] ): ?>
								<span class="icon"><?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
							<?php endif; ?>
							<?php if ( $list_title ): ?>
								<span class="text"><?php echo esc_html( $list_title ); ?></span>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>
				</ul>
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
$widgets_manager->register( new Qomfort_Elementor_Price() );