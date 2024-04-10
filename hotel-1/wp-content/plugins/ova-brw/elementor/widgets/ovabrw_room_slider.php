<?php
namespace ovabrw_product_elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ovabrw_room_slider extends Widget_Base {

	public function get_name() {		
		return 'ovabrw_room_slider';
	}

	public function get_title() {
		return esc_html__( 'Room Slider', 'ova-brw' );
	}

	public function get_icon() {
		return 'eicon-slider-push';
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
				'template',
				[
					'label' => esc_html__( 'Template', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'template_1',
					'options' => [
						'template_1' => esc_html__( 'Template 1', 'ova-brw' ),
						'template_2' => esc_html__( 'Template 2', 'ova-brw' ),
						'template_3' => esc_html__( 'Template 3', 'ova-brw' ),
					],
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
					'default' 	=> 6,
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

		/* Additional Options */
		$this->start_controls_section(
				'section_additional_options',
				[
					'label' => esc_html__( 'Additional Options', 'ova-brw' ),
				]
			);

			$this->add_control(
				'margin_items',
				[
					'label'   => esc_html__( 'Margin Right Items', 'ova-brw' ),
					'type'    => \Elementor\Controls_Manager::NUMBER,
					'default' => 30,
				]
				
			);

			$this->add_control(
				'item_number',
				[
					'label'       => esc_html__( 'Item Number', 'ova-brw' ),
					'type'        => \Elementor\Controls_Manager::NUMBER,
					'description' => esc_html__( 'Number Item', 'ova-brw' ),
					'default'     => 4,
					'condition' => [
						'template' => 'template_1',
					],
				]
			);

			$this->add_control(
				'item_number_2',
				[
					'label'       => esc_html__( 'Item Number', 'ova-brw' ),
					'type'        => \Elementor\Controls_Manager::NUMBER,
					'description' => esc_html__( 'Number Item', 'ova-brw' ),
					'default'     => 3,
					'condition' => [
						'template' => 'template_2',
					],
				]
			);

			$this->add_control(
				'item_number_3',
				[
					'label'       => esc_html__( 'Item Number', 'ova-brw' ),
					'type'        => \Elementor\Controls_Manager::NUMBER,
					'description' => esc_html__( 'Number Item', 'ova-brw' ),
					'default'     => 2,
					'condition' => [
						'template' => 'template_3',
					],
				]
			);

			$this->add_control(
				'slides_to_scroll',
				[
					'label'       => esc_html__( 'Slides to Scroll', 'ova-brw' ),
					'type'        => \Elementor\Controls_Manager::NUMBER,
					'description' => esc_html__( 'Set how many slides are scrolled per swipe.', 'ova-brw' ),
					'default'     => 1,
				]
			);

			$this->add_control(
				'pause_on_hover',
				[
					'label'   => esc_html__( 'Pause on Hover', 'ova-brw' ),
					'type'    => \Elementor\Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'ova-brw' ),
						'no'  => esc_html__( 'No', 'ova-brw' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'infinite',
				[
					'label'   => esc_html__( 'Infinite Loop', 'ova-brw' ),
					'type'    => \Elementor\Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'ova-brw' ),
						'no'  => esc_html__( 'No', 'ova-brw' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'autoplay',
				[
					'label'   => esc_html__( 'Autoplay', 'ova-brw' ),
					'type'    => \Elementor\Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'ova-brw' ),
						'no'  => esc_html__( 'No', 'ova-brw' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'autoplay_speed',
				[
					'label'     => esc_html__( 'Autoplay Speed', 'ova-brw' ),
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
					'label'   => esc_html__( 'Smart Speed', 'ova-brw' ),
					'type'    => \Elementor\Controls_Manager::NUMBER,
					'default' => 500,
				]
			);

			$this->add_control(
				'dot_control',
				[
					'label'   => esc_html__( 'Show Dots', 'ova-brw' ),
					'type'    => \Elementor\Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'ova-brw' ),
						'no'  => esc_html__( 'No', 'ova-brw' ),
					],
					'frontend_available' => true,
				]
			);

		$this->end_controls_section();

		/* Template Settings */
		$this->start_controls_section(
			'more_options',
			[
				'label' => esc_html__( 'Template Settings', 'ova-brw' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

			$this->add_control(
				'meta_fields',
				[
					'label' 	=> esc_html__( 'Meta Fields', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
				]
			);

			$meta_fields = array(
				'' 					=> esc_html__('Select Meta', 'ova-brw'),
				'adults' 			=> esc_html__('Adults', 'ova-brw'),
				'children' 			=> esc_html__('Children', 'ova-brw'),
				'acreage' 			=> esc_html__('Acreage ', 'ova-brw'),
				'beds' 				=> esc_html__('Beds', 'ova-brw'),
				'baths' 			=> esc_html__('Baths', 'ova-brw'),
			);

			$this->add_control(
				'field_1',
				[
					'label'   	=> esc_html__( 'Field 1', 'ova-brw' ),
					'type'    	=> Controls_Manager::SELECT,
					'default' 	=> 'adults',
					'options' 	=> $meta_fields,
				]
			);

			$this->add_control(
				'field_2',
				[
					'label'   	=> esc_html__( 'Field 2', 'ova-brw' ),
					'type'    	=> Controls_Manager::SELECT,
					'default' 	=> 'acreage',
					'separator' => 'before',
					'options' 	=> $meta_fields,
				]
			);

			$this->add_control(
				'field_3',
				[
					'label'   	=> esc_html__( 'Field 3', 'ova-brw' ),
					'type'    	=> Controls_Manager::SELECT,
					'default' 	=> '',
					'separator' => 'before',
					'options' 	=> $meta_fields,
				]
			);

			$this->add_control(
				'field_4',
				[
					'label'   	=> esc_html__( 'Field 4', 'ova-brw' ),
					'type'    	=> Controls_Manager::SELECT,
					'default' 	=> '',
					'separator' => 'before',
					'options' 	=> $meta_fields,
				]
			);

			$this->add_control(
				'field_5',
				[
					'label'   	=> esc_html__( 'Field 5', 'ova-brw' ),
					'type'    	=> Controls_Manager::SELECT,
					'default' 	=> '',
					'separator' => 'before',
					'options' 	=> $meta_fields,
				]
			);

			$this->add_control(
				'icon_adults',
				[
					'label' => esc_html__( 'Icon Adults', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'far fa-user',
						'library' => 'all',
					],
				]
			);

			$this->add_control(
				'icon_children',
				[
					'label' => esc_html__( 'Icon Children', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'far fa-user-circle',
						'library' => 'all',
					],
				]
			);

			$this->add_control(
				'icon_area',
				[
					'label' => esc_html__( 'Icon Area', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-drafting-compass',
						'library' => 'all',
					],
				]
			);

			$this->add_control(
				'icon_beds',
				[
					'label' => esc_html__( 'Icon Beds', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-bed',
						'library' => 'all',
					],
				]
			);

			$this->add_control(
				'icon_baths',
				[
					'label' => esc_html__( 'Icon Baths', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-bath',
						'library' => 'all',
					],
				]
			);

		$this->end_controls_section();

		/* Items STYLE TAB */
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
						'{{WRAPPER}} .ovabrw-room-slider .room-slider .room .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'dot_active_color',
				[
					'label'     => esc_html__( 'Dot Active Color', 'ova-brw' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ovabrw-room-slider .room-slider .owl-dots .owl-dot.active span' => 'background : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'items_overlay_heading',
				[
					'label' => esc_html__( 'Overlay', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'template' => 'template_1',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'items_overlay',
					'types' => [ 'gradient' ],
					'selector' => '{{WRAPPER}} .ovabrw-room-slider .room-slider .room .image .overlay',
					'condition' => [
						'template' => 'template_1',
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
						'items_heading',
						[
							'label' => esc_html__( 'Items', 'ova-brw' ),
							'type' => \Elementor\Controls_Manager::HEADING,
							'separator' => 'before',
						]
					);

					$this->add_control(
						'items_bg',
						[
							'label' => esc_html__( 'Background', 'ova-brw' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-room-slider .room-slider .room .content' => 'background: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'price_heading',
						[
							'label' => esc_html__( 'Price', 'ova-brw' ),
							'type' => \Elementor\Controls_Manager::HEADING,
							'separator' => 'before',
						]
					);

					$this->add_control(
						'price_bg',
						[
							'label' => esc_html__( 'Background', 'ova-brw' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-room-slider .room-slider .room .price' => 'background: {{VALUE}}',
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
						'items_heading_hover',
						[
							'label' => esc_html__( 'Items', 'ova-brw' ),
							'type' => \Elementor\Controls_Manager::HEADING,
							'separator' => 'before',
						]
					);

					$this->add_control(
						'items_bg_hover',
						[
							'label' => esc_html__( 'Background', 'ova-brw' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-room-slider .room-slider .room:hover .content' => 'background: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'price_heading_hover',
						[
							'label' => esc_html__( 'Price', 'ova-brw' ),
							'type' => \Elementor\Controls_Manager::HEADING,
							'separator' => 'before',
						]
					);

					$this->add_control(
						'price_bg_hover',
						[
							'label' => esc_html__( 'Background', 'ova-brw' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-room-slider .room-slider .room:hover .price' => 'background: {{VALUE}}',
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
					'selector' => '{{WRAPPER}} .ovabrw-room-slider .room-slider .room .number',
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
								'{{WRAPPER}} .ovabrw-room-slider .room-slider .room .number' => 'color: {{VALUE}}',
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
								'{{WRAPPER}} .ovabrw-room-slider .room-slider .room:hover .number' => 'color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();

		/* After Price */
		$this->start_controls_section(
				'after_price_style_section',
				[
					'label' => esc_html__( 'After Price', 'ova-brw' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'after_price_typography',
					'selector' => '{{WRAPPER}} .ovabrw-room-slider .room-slider .room .text',
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
								'{{WRAPPER}} .ovabrw-room-slider .room-slider .room .text' => 'color: {{VALUE}}',
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
								'{{WRAPPER}} .ovabrw-room-slider .room-slider .room:hover .text' => 'color: {{VALUE}}',
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
						'{{WRAPPER}} .ovabrw-room-slider .room-slider .room .content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .ovabrw-room-slider .room-slider .room .content .title a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .ovabrw-room-slider .room-slider .room .content .title a',
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
								'{{WRAPPER}} .ovabrw-room-slider .room-slider .room .content .title a' => 'color: {{VALUE}}',
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
								'{{WRAPPER}} .ovabrw-room-slider .room-slider .room:hover .content .title a' => 'color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();

		/* Description */
		$this->start_controls_section(
				'desc_style_section',
				[
					'label' => esc_html__( 'Description', 'ova-brw' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					'condition' => [
						'template' => 'template_3',
					],
				]
			);

			$this->add_responsive_control(
				'desc_margin',
				[
					'label' => esc_html__( 'Margin', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ovabrw-room-slider.template_3 .room-slider .room .content .short-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'desc_padding',
				[
					'label' => esc_html__( 'Padding', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ovabrw-room-slider.template_3 .room-slider .room .content .short-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'desc_typography',
					'selector' => '{{WRAPPER}} .ovabrw-room-slider.template_3 .room-slider .room .content .short-desc',
				]
			);

			$this->start_controls_tabs(
					'desc_style_tabs'
				);

				$this->start_controls_tab(
						'desc_style_normal_tab',
						[
							'label' => esc_html__( 'Normal', 'ova-brw' ),
						]
					);

					$this->add_control(
						'desc_color',
						[
							'label' => esc_html__( 'Color', 'ova-brw' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-room-slider.template_3 .room-slider .room .content .short-desc' => 'color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
						'desc_style_hover_tab',
						[
							'label' => esc_html__( 'Hover', 'ova-brw' ),
						]
					);

					$this->add_control(
						'desc_color_hover',
						[
							'label' => esc_html__( 'Color', 'ova-brw' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-room-slider.template_3 .room-slider .room:hover .content .short-desc' => 'color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();

		/* Meta */
		$this->start_controls_section(
				'meta_style_section',
				[
					'label' => esc_html__( 'Meta', 'ova-brw' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					'condition' => [
						'template!' => 'template_3',
					],
				]
			);

			$this->add_responsive_control(
				'meta_margin',
				[
					'label' => esc_html__( 'Margin', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ovabrw-room-slider .room-slider .room .content .meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'meta_padding',
				[
					'label' => esc_html__( 'Padding', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ovabrw-room-slider .room-slider .room .content .meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'meta_icon_heading',
				[
					'label' => esc_html__( 'Icon', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
				'meta_icon_size',
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
						'{{WRAPPER}} .ovabrw-room-slider .room-slider .room .content .meta .item i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ovabrw-room-slider .room-slider .room .content .meta .item svg' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs(
					'meta_icon_style_tabs'
				);

				$this->start_controls_tab(
						'meta_icon_style_normal_tab',
						[
							'label' => esc_html__( 'Normal', 'ova-brw' ),
						]
					);

					$this->add_control(
						'meta_icon_color',
						[
							'label' => esc_html__( 'Color', 'ova-brw' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-room-slider .room-slider .room .content .meta .item i' => 'color: {{VALUE}}',
								'{{WRAPPER}} .ovabrw-room-slider .room-slider .room .content .meta .item svg' => 'fill: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
						'meta_icon_style_hover_tab',
						[
							'label' => esc_html__( 'Hover', 'ova-brw' ),
						]
					);

					$this->add_control(
						'meta_icon_color_hover',
						[
							'label' => esc_html__( 'Color', 'ova-brw' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-room-slider .room-slider .room:hover .content .meta .item i' => 'color: {{VALUE}}',
								'{{WRAPPER}} .ovabrw-room-slider .room-slider .room:hover .content .meta .item svg' => 'fill: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_control(
				'meta_text_heading',
				[
					'label' => esc_html__( 'Text', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'content_typography',
					'selector' => '{{WRAPPER}} .ovabrw-room-slider .room-slider .room .content .meta .item',
				]
			);

			$this->start_controls_tabs(
					'meta_text_style_tabs'
				);

				$this->start_controls_tab(
						'meta_text_style_normal_tab',
						[
							'label' => esc_html__( 'Normal', 'ova-brw' ),
						]
					);

					$this->add_control(
						'meta_text_color',
						[
							'label' => esc_html__( 'Color', 'ova-brw' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-room-slider .room-slider .room .content .meta .item' => 'color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
						'meta_text_style_hover_tab',
						[
							'label' => esc_html__( 'Hover', 'ova-brw' ),
						]
					);

					$this->add_control(
						'meta_text_color_hover',
						[
							'label' => esc_html__( 'Color', 'ova-brw' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-room-slider .room-slider .room:hover .content .meta .item' => 'color: {{VALUE}}',
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
					'label' => esc_html__( 'Text Link', 'ova-brw' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					'condition' => [
						'template' => 'template_3',
					],
				]
			);

			$this->add_responsive_control(
				'text_link_margin',
				[
					'label' => esc_html__( 'Margin', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ovabrw-room-slider.template_3 .room-slider .room .content .btn_link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'text_link_padding',
				[
					'label' => esc_html__( 'Padding', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ovabrw-room-slider.template_3 .room-slider .room .content .btn_link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'text_link_typography',
					'selector' => '{{WRAPPER}} .ovabrw-room-slider.template_3 .room-slider .room .content .btn_link',
				]
			);

			$this->start_controls_tabs(
					'text_link_style_tabs'
				);

				$this->start_controls_tab(
						'text_link_style_normal_tab',
						[
							'label' => esc_html__( 'Normal', 'ova-brw' ),
						]
					);

					$this->add_control(
						'text_link_color',
						[
							'label' => esc_html__( 'Color', 'ova-brw' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-room-slider.template_3 .room-slider .room .content .btn_link' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'text_link_bg',
						[
							'label' => esc_html__( 'Background', 'ova-brw' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-room-slider.template_3 .room-slider .room .content .btn_link' => 'background: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
						'text_link_style_hover_tab',
						[
							'label' => esc_html__( 'Hover', 'ova-brw' ),
						]
					);

					$this->add_control(
						'text_link_color_hover',
						[
							'label' => esc_html__( 'Color', 'ova-brw' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-room-slider.template_3 .room-slider .room:hover .content .btn_link' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'text_link_bg_hover',
						[
							'label' => esc_html__( 'Background', 'ova-brw' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-room-slider.template_3 .room-slider .room:hover .content .btn_link' => 'background: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
			ovabrw_get_template('elementor/ovabrw_room_slider.php', $settings );
		?>
		<?php
	}
}