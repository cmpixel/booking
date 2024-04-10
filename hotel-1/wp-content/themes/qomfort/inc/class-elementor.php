<?php

class Qomfort_Elementor {
	
	function __construct() {
            
		// Register Header Footer Category in Pane
	    add_action( 'elementor/elements/categories_registered', array( $this, 'qomfort_add_category' ) );

	    add_action( 'elementor/frontend/after_register_scripts', array( $this, 'qomfort_enqueue_scripts' ) );
		
		add_action( 'elementor/widgets/register', array( $this, 'qomfort_include_widgets' ) );
		
		add_filter( 'elementor/controls/animations/additional_animations', array( $this, 'qomfort_add_animations'), 10 , 0 );

		add_action( 'wp_print_footer_scripts', array( $this, 'qomfort_enqueue_footer_scripts' ) );

		// load icons
		add_filter( 'elementor/icons_manager/additional_tabs', array( $this, 'qomfort_icons_filters_new' ), 9999999, 1 );

		//Add accordion custom control style
		add_action( 'elementor/element/accordion/section_toggle_style_title/before_section_end', array( $this, 'qomfort_accordion_title_custom' ), 10, 2 );

		add_action( 'elementor/element/accordion/section_toggle_style_icon/before_section_end', array( $this, 'qomfort_accordion_icon_custom' ), 10, 2 );

		add_action( 'elementor/element/icon/section_style_icon/before_section_end', array( $this, 'qomfort_icon_custom' ), 10, 2 );

		// social icon control style
		add_action( 'elementor/element/social-icons/section_social_hover/after_section_end', array( $this, 'qomfort_social_icons_custom' ), 10, 2 );

		// Add image box custom control style
		add_action( 'elementor/element/image-box/section_style_content/after_section_end', array( $this, 'qomfort_image_box_custom' ), 10, 2 );

		// Add text editor custom control style
		add_action( 'elementor/element/text-editor/section_style/after_section_end', array( $this, 'qomfort_text_editor_custom' ), 10, 2 );

		// Add icon box custom control style
		add_action( 'elementor/element/icon-box/section_style_content/after_section_end', array( $this, 'qomfort_icon_box_custom' ), 10, 2 );

		// Add button custom control style
		add_action( 'elementor/element/button/section_style/after_section_end', array( $this, 'qomfort_button_custom' ), 10, 2 );

	}

	
	function qomfort_add_category(  ) {

	    \Elementor\Plugin::instance()->elements_manager->add_category(
	        'hf',
	        [
	            'title' => __( 'Header Footer', 'qomfort' ),
	            'icon' => 'fa fa-plug',
	        ]
	    );

	    \Elementor\Plugin::instance()->elements_manager->add_category(
	        'qomfort',
	        [
	            'title' => __( 'Qomfort', 'qomfort' ),
	            'icon' => 'fa fa-plug',
	        ]
	    );

	}

	function qomfort_enqueue_scripts(){
        
        $files = glob(get_theme_file_path('/assets/js/elementor/*.js'));
        
        foreach ($files as $file) {
            $file_name = wp_basename($file);
            $handle    = str_replace(".js", '', $file_name);
            $src       = get_theme_file_uri('/assets/js/elementor/' . $file_name);
            if (file_exists($file)) {
                wp_register_script( 'qomfort-elementor-' . $handle, $src, ['jquery'], false, true );
            }
        }


	}

	function qomfort_include_widgets( $widgets_manager ) {
        $files = glob(get_theme_file_path('elementor/widgets/*.php'));
        foreach ($files as $file) {
            $file = get_theme_file_path('elementor/widgets/' . wp_basename($file));
            if (file_exists($file)) {
                require_once $file;
            }
        }
    }

    function qomfort_add_animations(){
    	$animations = array(
            'Qomfort' => array(
                'ova-move-up' 		=> esc_html__('Move Up', 'qomfort'),
                'ova-move-down' 	=> esc_html__( 'Move Down', 'qomfort' ),
                'ova-move-left'     => esc_html__('Move Left', 'qomfort'),
                'ova-move-right'    => esc_html__('Move Right', 'qomfort'),
                'ova-scale-up'      => esc_html__('Scale Up', 'qomfort'),
                'ova-flip'          => esc_html__('Flip', 'qomfort'),
                'ova-helix'         => esc_html__('Helix', 'qomfort'),
                'ova-popup'			=> esc_html__( 'PopUp','qomfort' )
            ),
        );

        return $animations;
    }

    function qomfort_accordion_title_custom( $element, $args ) {

    	$element->add_control(
			'title_additional_options',
			[
				'label' => esc_html__( 'Additional Options', 'qomfort' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$element->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'ova_title_border',
				'selector' => '{{WRAPPER}} .elementor-accordion .elementor-tab-title,{{WRAPPER}} .elementor-accordion .elementor-tab-title.elementor-active',
			]
		);
    }

    function qomfort_accordion_icon_custom( $element, $args ) {

    	$element->add_control(
			'icon_additional_options',
			[
				'label' => esc_html__( 'Additional Options', 'qomfort' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$element->add_control(
			'ova_icon_size',
			[
				'label' => esc_html__( 'Size', 'qomfort' ),
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
					'{{WRAPPER}} .elementor-accordion .elementor-tab-title .elementor-accordion-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-accordion .elementor-tab-title .elementor-accordion-icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
    }

    function qomfort_icon_custom( $element, $args ) {

    	$element->add_control(
			'icon_options',
			[
				'label' => esc_html__( 'Additional Options', 'qomfort' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

    	$element->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ova_icon_box_shadow',
				'selector' => '{{WRAPPER}} .elementor-icon',
			]
		);
    }

    function qomfort_social_icons_custom ( $element, $args ) {
		/** @var \Elementor\Element_Base $element */
		$element->start_controls_section(
			'ova_social_icons',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Ova Social Icon', 'qomfort' ),
			]
		);

			$element->add_responsive_control(
	            'ova_social_icons_display',
	            [
	                'label' 	=> esc_html__( 'Display', 'qomfort' ),
	                'type' 		=> \Elementor\Controls_Manager::CHOOSE,
	                'options' 	=> [
	                    'inline-block' => [
	                        'title' => esc_html__( 'Block', 'qomfort' ),
	                        'icon' 	=> 'eicon-h-align-left',
	                    ],
	                    'inline-flex' => [
	                        'title' => esc_html__( 'Flex', 'qomfort' ),
	                        'icon' 	=> 'eicon-h-align-center',
	                    ],
	                ],
	                'selectors' => [
	                    '{{WRAPPER}} .elementor-icon.elementor-social-icon' => 'display: {{VALUE}}',
	                ],
	            ]
	        );

	        $element->add_control(
	            'social_icons_color_hover',
	            [
	                'label' 	=> esc_html__( 'Color Hover', 'qomfort' ),
	                'type' 		=> \Elementor\Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .elementor-grid-item .elementor-social-icon:hover i' => 'color: {{VALUE}};',
	                ],
	            ]
	        );

			$element->add_control(
	            'social_icons_bg_hover',
	            [
	                'label' 	=> esc_html__( 'Background Hover', 'qomfort' ),
	                'type' 		=> \Elementor\Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .elementor-grid-item .elementor-social-icon:before' => 'background-color: {{VALUE}};',
	                ],
	            ]
	        );

	        $element->add_control(
	            'icon_before_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'qomfort' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .elementor-grid-item .elementor-social-icon:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$element->end_controls_section();
	}

	function qomfort_image_box_custom( $element, $args ) {
		$element->start_controls_section(
			'ova_add_section',
			[
				'label' => esc_html__( 'Additional Options', 'qomfort' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$element->add_control(
			'ova_add_gap',
			[
				'label' => esc_html__( 'Gap', 'qomfort' ),
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
					'{{WRAPPER}} .elementor-image-box-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$element->end_controls_section();

	}

	// Ova text-editor custom 
    function qomfort_text_editor_custom( $element, $args ) {
		/** @var \Elementor\Element_Base $element */
		$element->start_controls_section(
			'ova_tabs',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Ova Text Editor', 'qomfort' ),
			]
		);

			$element->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'link_typography',
					'selector' => '{{WRAPPER}} a',
				]
			);
            
            $element->add_control(
	            'link_color',
	            [
	                'label' 	=> esc_html__( 'Link Color', 'qomfort' ),
	                'type' 		=> \Elementor\Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} a' => 'color: {{VALUE}};',
	                ],
	            ]
	        );

	        $element->add_control(
	            'link_color_hover',
	            [
	                'label' 	=> esc_html__( 'Link Color Hover', 'qomfort' ),
	                'type' 		=> \Elementor\Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} a:hover' => 'color: {{VALUE}};',
	                ],
	            ]
	        );

			$element->add_responsive_control(
				'text_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'qomfort' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em' ],
					'selectors' 	=> [
					'{{WRAPPER}}  p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$element->add_responsive_control(
		        'text_padding',
		        [
		            'label' 		=> esc_html__( 'Padding', 'qomfort' ),
		            'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		            'size_units' 	=> [ 'px', '%', 'em' ],
		            'selectors' 	=> [
		             '{{WRAPPER}}  p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            ],
		         ]
		    );

		$element->end_controls_section();
	} 

	function qomfort_icon_box_custom( $element, $args ) {
		$element->start_controls_section(
			'ova_add_section',
			[
				'label' => esc_html__( 'Ova Icon Box', 'qomfort' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$element->add_control(
			'ova_add_gap',
			[
				'label' => esc_html__( 'Gap', 'qomfort' ),
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
					'{{WRAPPER}} .elementor-icon-box-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$element->add_responsive_control(
			'ova_box_title_margin',
			[
				'label' 		=> esc_html__( 'Title Margin', 'qomfort' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
				'{{WRAPPER}} .elementor-icon-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$element->end_controls_section();

	}

	function qomfort_button_custom( $element, $args ) {
		$element->start_controls_section(
			'ova_add_section',
			[
				'label' => esc_html__( 'Additional Options', 'qomfort' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$element->add_control(
			'ova_add_gap',
			[
				'label' => esc_html__( 'Gap', 'qomfort' ),
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
					'{{WRAPPER}} .elementor-button-content-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$element->end_controls_section();

	}

	function qomfort_enqueue_footer_scripts(){
		 // Font Icon
	    wp_enqueue_style('ovaicon', QOMFORT_URI.'/assets/libs/ovaicon/font/ovaicon.css', array(), null);

	    // Flaticon Qomfort
	    wp_enqueue_style('qomforticon', QOMFORT_URI.'/assets/libs/qomfort-icon/font/flaticon_qomfort.css', array(), null);
	}
	
	public function qomfort_icons_filters_new( $tabs = array() ) {
		$newicons = [];

		$font_data['json_url'] = QOMFORT_URI.'/assets/libs/ovaicon/ovaicon.json';
		$font_data['name'] = 'ovaicon';

		$newicons[ $font_data['name'] ] = [
			'name'          => $font_data['name'],
			'label'         => esc_html__( 'Default', 'qomfort' ),
			'url'           => '',
			'enqueue'       => '',
			'prefix'        => 'ovaicon-',
			'displayPrefix' => '',
			'ver'           => '1.0',
			'fetchJson'     => $font_data['json_url'],
			
		];

		$qomfort_data['json_url'] = QOMFORT_URI.'/assets/libs/qomfort-icon/qomfort.json';
		$qomfort_data['name'] = 'qomfort';

		$newicons[ $qomfort_data['name'] ] = [
			'name'          => $qomfort_data['name'],
			'label'         => esc_html__( 'Qomfort', 'qomfort' ),
			'url'           => '',
			'enqueue'       => '',
			'prefix'        => 'qomfort-',
			'displayPrefix' => '',
			'ver'           => '1.0',
			'fetchJson'     => $qomfort_data['json_url'],
			
		];

		return array_merge( $tabs, $newicons );
	}
}

return new Qomfort_Elementor();