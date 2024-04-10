<?php
namespace ovabrw_product_elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ovabrw_room_list extends Widget_Base {

	public function get_name() {		
		return 'ovabrw_room_list';
	}

	public function get_title() {
		return esc_html__( 'Room List', 'ova-brw' );
	}

	public function get_icon() {
		return 'eicon-bullet-list';
	}

	public function get_categories() {
		return [ 'ovatheme' ];
	}

	protected function ovabrw_get_categories() {
		$terms = get_terms([
		    'taxonomy' => 'product_cat',
		    'hide_empty' => false,
		    'orderby' => 'name',
		    'order' => 'ASC',
		]);
		$categories = array();
		if ( $terms ) {
			foreach ( $terms as $key => $term ) {
				$categories[$term->term_id] = $term->name;
			}
		}
		return $categories;
	}

	protected function register_controls() {
		
		/* Content */
		$this->start_controls_section(
				'section_room_style',
				[
					'label' => esc_html__( 'Content', 'ova-brw' ),
				]
			);

			$this->add_control(
				'categories',
				[
					'label' => esc_html__( 'Categories', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::SELECT2,
					'label_block' => true,
					'multiple' => true,
					'options' => $this->ovabrw_get_categories(),
				]
			);

			$this->add_control(
				'posts_per_page',
				[
					'label' 	=> esc_html__( 'Rooms Per Page', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::NUMBER,
					'default' 	=> 4,
				]
			);

			$this->add_control(
				'orderby',
				[
					'label' => esc_html__( 'Order By', 'ova-brw' ),
					'type' 	=> \Elementor\Controls_Manager::SELECT,
					'default' => 'ID',
					'options' => [
						'ID' 			=> esc_html__( 'ID', 'ova-brw' ),
						'date' 			=> esc_html__( 'Date', 'ova-brw' ),
						'title' 		=> esc_html__( 'Title', 'ova-brw' ),
						'price' 		=> esc_html__( 'Price', 'ova-brw' ),
						'popularity' 	=> esc_html__( 'Popularity', 'ova-brw' ),
						'rating' 		=> esc_html__( 'Rating', 'ova-brw' ),
						'rand' 			=> esc_html__( 'Random', 'ova-brw' ),
						'menu_order' 	=> esc_html__( 'Menu Order', 'ova-brw' ),
					],
				]
			);

			$this->add_control(
				'order',
				[
					'label' => esc_html__( 'Order', 'ova-brw' ),
					'type' 	=> \Elementor\Controls_Manager::SELECT,
					'default' => 'DESC',
					'options' => [
						'ASC' 	=> esc_html__( 'ASC', 'ova-brw' ),
						'DESC' 	=> esc_html__( 'DESC', 'ova-brw' ),
					],
				]
			);

		$this->end_controls_section();

		/* Items */
		$this->start_controls_section(
				'items_style_section',
				[
					'label' => esc_html__( 'Items', 'ova-brw' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'items_padding',
				[
					'label' => esc_html__( 'Padding', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ovabrw-room-list .list .item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs(
					'items_style_tabs'
				);

				$this->start_controls_tab(
						'items_style_normal_tab',
						[
							'label' => esc_html__( 'Normal', 'ova-brw' ),
						]
					);

					$this->add_control(
						'items_bg',
						[
							'label' => esc_html__( 'Background', 'ova-brw' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-room-list .list .item' => 'background: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
						'items_style_hover_tab',
						[
							'label' => esc_html__( 'Hover', 'ova-brw' ),
						]
					);

					$this->add_control(
						'items_bg_hover',
						[
							'label' => esc_html__( 'Background', 'ova-brw' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-room-list .list .item:hover' => 'background: {{VALUE}}',
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
					'label' => esc_html__( 'Title', 'ova-brw' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'title_margin',
				[
					'label' => esc_html__( 'Margin', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ovabrw-room-list .list .item .content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'title_padding',
				[
					'label' => esc_html__( 'Padding', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ovabrw-room-list .list .item .content .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .ovabrw-room-list .list .item .content .title a',
				]
			);

			$this->start_controls_tabs(
					'title_style_tabs'
				);

				$this->start_controls_tab(
						'title_style_normal_tab',
						[
							'label' => esc_html__( 'Normal', 'ova-brw' ),
						]
					);

					$this->add_control(
						'title_color',
						[
							'label' => esc_html__( 'Color', 'ova-brw' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-room-list .list .item .content .title a' => 'color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
						'title_style_hover_tab',
						[
							'label' => esc_html__( 'Hover', 'ova-brw' ),
						]
					);

					$this->add_control(
						'title_color_hover',
						[
							'label' => esc_html__( 'Color', 'ova-brw' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-room-list .list .item:hover .content .title a' => 'color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();

		/* Price */
		$this->start_controls_section(
				'price_style_section',
				[
					'label' => esc_html__( 'Price', 'ova-brw' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'price_typography',
					'selector' => '{{WRAPPER}} .ovabrw-room-list .list .item .content .price .number',
				]
			);

			$this->start_controls_tabs(
					'price_style_tabs'
				);

				$this->start_controls_tab(
						'price_style_normal_tab',
						[
							'label' => esc_html__( 'Normal', 'ova-brw' ),
						]
					);

					$this->add_control(
						'price_color',
						[
							'label' => esc_html__( 'Color', 'ova-brw' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-room-list .list .item .content .price .number' => 'color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
						'price_style_hover_tab',
						[
							'label' => esc_html__( 'Hover', 'ova-brw' ),
						]
					);

					$this->add_control(
						'price_color_hover',
						[
							'label' => esc_html__( 'Color', 'ova-brw' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-room-list .list .item:hover .content .price .number' => 'color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();

		/* Text Price */
		$this->start_controls_section(
				'after_price_style_section',
				[
					'label' => esc_html__( 'Text Price', 'ova-brw' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'after_price_typography',
					'selector' => '{{WRAPPER}} .ovabrw-room-list .list .item .content .price .text',
				]
			);

			$this->start_controls_tabs(
					'after_price_style_tabs'
				);

				$this->start_controls_tab(
						'after_price_style_normal_tab',
						[
							'label' => esc_html__( 'Normal', 'ova-brw' ),
						]
					);

					$this->add_control(
						'after_price_color',
						[
							'label' => esc_html__( 'Color', 'ova-brw' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-room-list .list .item .content .price .text' => 'color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
						'after_price_style_hover_tab',
						[
							'label' => esc_html__( 'Hover', 'ova-brw' ),
						]
					);

					$this->add_control(
						'after_price_color_hover',
						[
							'label' => esc_html__( 'Color', 'ova-brw' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-room-list .list .item:hover .content .price .text' => 'color: {{VALUE}}',
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
					'label' => esc_html__( 'Icon', 'ova-brw' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'icon_size',
				[
					'label' => esc_html__( 'Size', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 50,
							'step' => 5,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ovabrw-room-list .list .item .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'icon_border',
					'selector' => '{{WRAPPER}} .ovabrw-room-list .list .item .icon',
				]
			);

			$this->start_controls_tabs(
					'icon_style_tabs'
				);

				$this->start_controls_tab(
						'icon_style_normal_tab',
						[
							'label' => esc_html__( 'Normal', 'ova-brw' ),
						]
					);

					$this->add_control(
						'icon_color',
						[
							'label' => esc_html__( 'Color', 'ova-brw' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-room-list .list .item .icon i' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'icon_bg',
						[
							'label' => esc_html__( 'Background', 'ova-brw' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-room-list .list .item .icon' => 'background: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
						'icon_style_hover_tab',
						[
							'label' => esc_html__( 'Hover', 'ova-brw' ),
						]
					);

					$this->add_control(
						'icon_color_hover',
						[
							'label' => esc_html__( 'Color', 'ova-brw' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-room-list .list .item:hover .icon i' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'icon_bg_hover',
						[
							'label' => esc_html__( 'Background', 'ova-brw' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-room-list .list .item:hover .icon' => 'background: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
			ovabrw_get_template('elementor/ovabrw_room_list.php', $settings );
		?>
		<?php
	}
}