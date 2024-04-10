<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Qomfort_Elementor_Gallery_Slide_3 extends Widget_Base {

	public function get_name() {
		return 'qomfort_elementor_gallery_slide_3';
	}

	public function get_title() {
		return esc_html__( 'Ova Gallery Slide 3', 'qomfort' );
	}

	public function get_icon() {
		return 'eicon-slider-push';
	}

	public function get_categories() {
		return [ 'qomfort' ];
	}

	public function get_script_depends() {
		wp_enqueue_style( 'fancybox', get_template_directory_uri().'/assets/libs/fancybox/fancybox.css' );
		wp_enqueue_script( 'fancybox', get_template_directory_uri().'/assets/libs/fancybox/fancybox.umd.js', array('jquery'), false, true );
		return [ 'qomfort-elementor-gallery-slide-3' ];
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

			$this->add_control(
				'icon',
				[
					'label' => esc_html__( 'Icon', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'ovaicon-diagonal-arrow',
						'library' => 'all',
					],		
				]
			);

			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'title',
				[
					'label' => esc_html__( 'Title', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'rows' => 3,
					'default' => esc_html__( 'Swimming Pool', 'qomfort' ),
					'placeholder' => esc_html__( 'Type your title here', 'qomfort' ),
				]
			);

			$repeater->add_control(
				'image',
				[
					'label' => esc_html__( 'Gallery Image', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);

			$repeater->add_control(
				'image_popup',
				[
					'label' => esc_html__( 'Popup Image', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
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
							'title' => esc_html__( 'Swimming Pool', 'qomfort' ),
						],
						[
							'title' => esc_html__( 'Swimming Pool', 'qomfort' ),
						],
						[
							'title' => esc_html__( 'Swimming Pool', 'qomfort' ),
						],
						[
							'title' => esc_html__( 'Swimming Pool', 'qomfort' ),
						],
					],
					'title_field' => '{{{ title }}}',
				]
			);

			$this->add_control(
				'show_title',
				[
					'label' => esc_html__( 'Show Title', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'qomfort' ),
					'label_off' => esc_html__( 'Hide', 'qomfort' ),
					'return_value' => 'yes',
					'default' => 'no',
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
					'type'    => Controls_Manager::NUMBER,
					'default' => 70,
				]
			);


			$this->add_control(
				'item_number',
				[
					'label'       => esc_html__( 'Item Number', 'qomfort' ),
					'type'        => Controls_Manager::NUMBER,
					'description' => esc_html__( 'Number Item', 'qomfort' ),
					'default'     => 4,
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
					'default' => 'no',
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
					'default' => 'no',
					'options' => [
						'yes' => esc_html__( 'Yes', 'qomfort' ),
						'no'  => esc_html__( 'No', 'qomfort' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'nav_control',
				[
					'label'   => esc_html__( 'Show Nav', 'qomfort' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'no',
					'options' => [
						'yes' => esc_html__( 'Yes', 'qomfort' ),
						'no'  => esc_html__( 'No', 'qomfort' ),
					],
					'frontend_available' => true,
				]
			);

		$this->end_controls_section();
	    
		//SECTION TAB STYLE General
		$this->start_controls_section(
				'section_general_style',
				[
					'label' => esc_html__( 'General', 'qomfort' ),
					'tab' 	=> Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'icon_box_padding',
				[
					'label' => esc_html__( 'Padding', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-slide-3 .gallery-slide .gallery-box .list-gallery .icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
					'image_heading',
					[
						'label' => esc_html__( 'Image', 'qomfort' ),
						'type' => \Elementor\Controls_Manager::HEADING,
					]
				);

				$this->add_responsive_control(
					'image_height',
					[
						'label' => esc_html__( 'Height', 'qomfort' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'size_units' => [ 'px' ],
						'range' => [
							'px' => [
								'min' => 150,
								'max' => 500,
								'step' => 1,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .ova-gallery-slide-3 .gallery-slide .gallery-box .list-gallery img' => 'height: {{SIZE}}{{UNIT}};',
						],
					]
				);

			$this->add_control(
				'icon_heading',
				[
					'label' => esc_html__( 'Icon', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before'
				]
			);

			$this->add_responsive_control(
				'icon_box_size',
				[
					'label' => esc_html__( 'Icon Size', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 10,
							'max' => 70,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-slide-3 .gallery-slide .gallery-box .list-gallery .icon-box .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-gallery-slide-3 .gallery-slide .gallery-box .list-gallery .icon-box .icon svg' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'icon_box_color',
				[
					'label' => esc_html__( 'Icon Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-slide-3 .gallery-slide .gallery-box .list-gallery .icon-box .icon i' => 'color: {{VALUE}}',
						'{{WRAPPER}} .ova-gallery-slide-3 .gallery-slide .gallery-box .list-gallery .icon-box .icon svg' => 'fill: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'icon_box_background_color',
				[
					'label' => esc_html__( 'Background Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-slide-3 .gallery-slide .gallery-box .list-gallery .icon-box' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'overlay_heading',
				[
					'label' => esc_html__( 'Overlay', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before'
				]
			);

			$this->add_control(
				'image_overlay_hover',
				[
					'label' => esc_html__( 'Background Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-slide-3 .gallery-slide .gallery-box .list-gallery:before' => 'background-color: {{VALUE}}',
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
					'condition' => [
						'show_title' => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'title_margin',
				[
					'label' => esc_html__( 'Margin', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-slide-3 .gallery-slide .gallery-box .list-gallery .icon-box .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'title_padding',
				[
					'label' => esc_html__( 'Padding', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-slide-3 .gallery-slide .gallery-box .list-gallery .icon-box .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .ova-gallery-slide-3 .gallery-slide .gallery-box .list-gallery .icon-box .title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-slide-3 .gallery-slide .gallery-box .list-gallery .icon-box .title' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'title_color_separator',
				[
					'label' => esc_html__( 'Separator Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-slide-3 .gallery-slide .gallery-box .list-gallery .icon-box .title:before' => 'background: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();
		
		//SECTION TAB STYLE DOTS
		$this->start_controls_section(
			'section_dots',
			[
				'label' 	=> esc_html__( 'Dots', 'qomfort' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'dot_control' => 'yes',
				],
			]
		);

			$this->add_responsive_control(
			 	'position_dots',
			  	[
				  	'label' 	=> esc_html__( 'Position', 'qomfort' ),
				  	'type' 		=> \Elementor\Controls_Manager::CHOOSE,
				  	'options' 	=> [
					  	'absolute' => [
						  	'title' => esc_html__( 'Absolute', 'qomfort' ),
						  	'icon' 	=> 'eicon-text-align-left',
					  	],
					  	'relative' => [
						  	'title' => esc_html__( 'Relative', 'qomfort' ),
						  	'icon' 	=> 'eicon-text-align-center',
					  	],
					  	 
				  	],
				  	'toggle' 	=> true,
				  	'selectors' => [
					  	'{{WRAPPER}} .ova-gallery-slide-3 .gallery-slide .owl-dots' => 'position: {{VALUE}};',
				  	],
			  	]
			);

			$this->add_responsive_control(
				'position_bottom',
				[
					'label' 		=> esc_html__( 'Position Bottom', 'qomfort' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px' ],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 70,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-gallery-slide-3 .gallery-slide .owl-dots' => 'bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'dots_margin',
				[
					'label' => esc_html__( 'Margin', 'qomfort' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-slide-3 .gallery-slide .owl-dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'position_dots' => 'relative',
					],
				]
			);


			$this->add_control(
				'style_dots',
				[
					'label' 	=> esc_html__( 'Dots', 'qomfort' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'dot_control' => 'yes',
					],
				]
			);

			$this->add_control(
				'dot_color',
				[
					'label'     => esc_html__( 'Dot Color', 'qomfort' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-slide-3 .owl-carousel .owl-dots button' => 'background-color : {{VALUE}};',
						
					],
					'condition' => [
						'dot_control' => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'dot_width',
				[
					'label' 		=> esc_html__( 'Dots width', 'qomfort' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px' ],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 70,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-gallery-slide-3 .gallery-slide .owl-dots button' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'dot_height',
				[
					'label' 		=> esc_html__( 'Dots Height', 'qomfort' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px' ],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 70,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-gallery-slide-3 .gallery-slide .owl-dots button' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'border_radius_dot',
				array(
					'label'      => esc_html__( 'Border Radius', 'qomfort' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .ova-gallery-slide-3 .gallery-slide .owl-dots button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

			$this->add_control(
				'style_dot_active',
				[
					'label' 	=> esc_html__( 'Dots Active', 'qomfort' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'dot_control' => 'yes',
					],
				]
			);

			$this->add_control(
				'dot_color_active',
				[
					'label'     => esc_html__( 'Dot Color Active', 'qomfort' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-slide-3 .gallery-slide .owl-dots button.active' => 'background-color : {{VALUE}};',
						
					],
					'condition' => [
						'dot_control' => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'dot_width_active',
				[
					'label' 		=> esc_html__( 'Dots Width Active', 'qomfort' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px' ],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 70,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-gallery-slide-3 .gallery-slide .owl-dots button.active' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'dot_height_active',
				[
					'label' 		=> esc_html__( 'Dots Height Active', 'qomfort' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px' ],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 70,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-gallery-slide-3 .gallery-slide .owl-dots button.active' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);


		$this->end_controls_section();
		//END SECTION TAB STYLE DOTS
		
		//SECTION TAB STYLE NAV
		$this->start_controls_section(
			'section_nav',
			[
				'label' 	=> esc_html__( 'Nav', 'qomfort' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'nav_control' => 'yes',
				],
			]
		);

			$this->add_responsive_control(
				'nav_size',
				[
					'label' 		=> esc_html__( 'Nav Size', 'qomfort' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px' ],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 70,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-gallery-slide-3 .gallery-slide .owl-nav button' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'icon_size',
				[
					'label' 		=> esc_html__( 'Icon Size', 'qomfort' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px' ],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 30,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-gallery-slide-3 .gallery-slide .owl-nav button i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);


			$this->add_responsive_control(
				'border_radius_nav',
				array(
					'label'      => esc_html__( 'Border Radius', 'qomfort' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .ova-gallery-slide-3 .gallery-slide .owl-nav button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

			$this->start_controls_tabs( 'tabs_nav_style' );

				$this->start_controls_tab(
		            'tab_nav',
		            [
		                'label' => esc_html__( 'Normal', 'qomfort' ),
		            ]
		        );

					$this->add_control(
						'nav_color',
						[
							'label'     => esc_html__( 'Color', 'qomfort' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-gallery-slide-3 .gallery-slide .owl-nav button' => 'color : {{VALUE}};',		
							],
							'condition' => [
								'nav_control' => 'yes',
							],
						]
					);

					$this->add_control(
						'nav_bg',
						[
							'label'     => esc_html__( 'Background', 'qomfort' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-gallery-slide-3 .gallery-slide .owl-nav button' => 'background-color : {{VALUE}};',
							],
							'condition' => [
								'nav_control' => 'yes',
							],
						]
					);

				$this->end_controls_tab();

			    $this->start_controls_tab(
		            'tab_hover',
		            [
		                'label' => esc_html__( 'Hover', 'qomfort' ),
		            ]
		        );
		        	$this->add_control(
						'nav_next_color_hover',
						[
							'label'     => esc_html__( 'Color', 'qomfort' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-gallery-slide-3 .gallery-slide .owl-nav button:hover ' => 'color : {{VALUE}};',		
							],
							'condition' => [
								'nav_control' => 'yes',
							],
						]
					);

					$this->add_control(
						'nav_bg_hover',
						[
							'label'     => esc_html__( 'Background', 'qomfort' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-gallery-slide-3 .gallery-slide .owl-nav button:hover' => 'background-color : {{VALUE}};',
								
							],
							'condition' => [
								'nav_control' => 'yes',
							],
						]
					);

				$this->end_controls_tab();
			$this->end_controls_tabs();

		$this->end_controls_section();
		// END SECTION TAB STYLE NAV
		
	}

	// Render Template Here
	protected function render() {

		$settings 	= $this->get_settings_for_display();
		$list 		= $settings['list'];
		$show_title = $settings['show_title'];

        // data option for slide
		$data_options['items']         		= $settings['item_number'];
		$data_options['margin']         	= $settings['margin_items'];
		$data_options['slideBy']            = $settings['slides_to_scroll'];
		$data_options['autoplayHoverPause'] = $settings['pause_on_hover'] === 'yes' ? true : false;
		$data_options['loop']               = $settings['infinite'] === 'yes' ? true : false;
		$data_options['autoplay']           = $settings['autoplay'] === 'yes' ? true : false;
		$data_options['autoplayTimeout']    = $settings['autoplay_speed'];
		$data_options['smartSpeed']         = $settings['smartspeed'];
		$data_options['dots']               = $settings['dot_control'] === 'yes' ? true : false;
		$data_options['nav']                = $settings['nav_control'] === 'yes' ? true : false;
		$data_options['rtl']                = is_rtl() ? true : false;	

		?>

		<?php if ( !empty($list) ) : ?>

			<div class="ova-gallery-slide-3">

				<div class="gallery-slide owl-carousel" data-options="<?php echo esc_attr(json_encode($data_options)); ?>" >

					<?php foreach ( $list as $key => $item ) :

						$title 			= $item['title'];
						$image_id 		= $item['image']['id']; 
                        $url 	  		= $item['image']['url'] ;
                        $img_popup_id 	= $item['image_popup']['id'];
                        $img_popup_url 	= $item['image_popup']['url'];
                        $alt 			= get_post_meta($image_id, '_wp_attachment_image_alt', true) ? get_post_meta($image_id, '_wp_attachment_image_alt', true) : esc_html__('Gallery Slide','qomfort');  
                        $caption        = wp_get_attachment_caption( $image_id );
                        if ( ! $img_popup_url ) {
                        	$img_popup_url = $img_url;
                        }
                        if ( $caption == '') {
                        	$caption = $alt;
                        }
                        
						if ( $url ): ?>
							<a href="#" data-fancybox="gallery-slide-3" data-src="<?php echo esc_url( $img_popup_url ); ?>"
								data-caption="<?php echo esc_attr( $caption ); ?>">

								<div class="gallery-box ">

									<div class="list-gallery">
		                                
										<img src="<?php echo esc_url( $url ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
										
										<div class="icon-box">
											
											<div class="icon">
												<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
											</div>
											<?php if (  $show_title == 'yes' && $title ): ?>
												<h3 class="title"><?php echo esc_html( $title ); ?></h3>
											<?php endif; ?>
										</div>

									</div>

								</div>

							</a>
						<?php endif;
					endforeach; ?>

				</div>

			</div>

		<?php endif; ?>
		 	
		<?php
	}

	
}
$widgets_manager->register( new Qomfort_Elementor_Gallery_Slide_3() );