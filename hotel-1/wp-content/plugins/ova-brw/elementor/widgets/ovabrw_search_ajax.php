<?php
namespace ovabrw_product_elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ovabrw_search_ajax extends Widget_Base {


	public function get_name() {		
		return 'ovabrw_search_ajax';
	}

	public function get_title() {
		return esc_html__( 'Room Search Ajax', 'ova-brw' );
	}

	public function get_icon() {
		return 'eicon-search-results';
	}

	public function get_categories() {
		return [ 'ovatheme' ];
	}

	public function get_script_depends() {
		wp_enqueue_script('moment', OVABRW_PLUGIN_URI.'assets/libs/fullcalendar/moment.min.js', array('jquery'),null,true);
		return [ 'script-elementor' ];
	}

	protected function register_controls() {
		
		/* Search Settings */
		$this->start_controls_section(
			'section_setting',
			[
				'label' => esc_html__( 'Search Settings', 'ova-brw' ),
			]
		);
            
            $this->add_control(
				'posts_per_page',
				[
					'label' 	=> esc_html__( 'Posts Per Page', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::NUMBER,
					'min' 		=> 1,
					'step' 		=> 1,
					'default' 	=> 5,
				]
			);

			$this->add_control(
				'orderby',
				[
					'label'   => esc_html__( 'Order By', 'ova-brw' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'title',
					'options' => [
						'title' 	=> esc_html__('Title', 'ova-brw'),
						'ID' 		=> esc_html__('ID', 'ova-brw'),
						'date' 		=> esc_html__('Date', 'ova-brw'),
						'rand' 		=> esc_html__('Random', 'ova-brw'),
					],
				]
			);

			$this->add_control(
				'order',
				[
					'label'   => esc_html__( 'Order', 'ova-brw' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'ASC',
					'options' => [
						'ASC' 	=> esc_html__('Ascending', 'ova-brw'),
						'DESC' 	=> esc_html__('Descending', 'ova-brw'),
					],
				]
			);

			$this->add_control(
				'button_label',
				[
					'label' 	=> esc_html__( 'Text Button', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default'   => esc_html__( 'Search Now', 'ova-brw' ),
					'description' 	=> esc_html__( 'Can use <br> tag html for text button line breaks', 'ova-brw' ),
				]
			);

			$this->add_control(
				'icon_button',
				[
					'label' 	=> __( 'Icon Button', 'ova-brw' ),
					'type' 		=> Controls_Manager::ICONS,
					'default' 	=> [
						'value' 	=> 'ovaicon ovaicon-search',
						'library' 	=> 'all',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_check_in',
			[
				'label' => esc_html__( 'Check-in', 'ova-brw' ),
			]
		);

		   $this->add_control(
				'icon_check_in',
				[
					'label' 	=> esc_html__( 'Icon', 'ova-brw' ),
					'type' 		=> Controls_Manager::ICONS,
				]
			);

			$this->add_control(
				'check_in_label',
				[
					'label' 	=> esc_html__( 'Check-in Label', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Check-in', 'ova-brw' ),
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_check_out',
			[
				'label' => esc_html__( 'Check-out', 'ova-brw' ),
			]
		);

		  	$this->add_control(
				'icon_check_out',
				[
					'label' 	=> esc_html__( 'Icon', 'ova-brw' ),
					'type' 		=> Controls_Manager::ICONS,
				]
			);

			$this->add_control(
				'check_out_label',
				[
					'label' 	=> esc_html__( 'Check-out Label', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Check-out', 'ova-brw' ),
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_adults',
			[
				'label' => esc_html__( 'Adults', 'ova-brw' ),
			]
		);

			$this->add_control(
				'adults_label',
				[
					'label' 	=> esc_html__( 'Label', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Adults', 'ova-brw' ),
				]
			);

			$this->add_control(
				'default_adult_number',
				[
					'label' 	=> esc_html__( 'Default Adult Number', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::NUMBER,
					'min' 		=> 1,
					'step' 		=> 1,
					'default' 	=> 2,
				]
			);

			$this->add_control(
				'max_adult',
				[
					'label' 	=> esc_html__( 'Maximum Adult', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::NUMBER,
					'min' 		=> 1,
					'step' 		=> 1,
					'default' 	=> 5,
				]
			);

			$this->add_control(
				'min_adult',
				[
					'label' 	=> esc_html__( 'Minimum Adult', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::NUMBER,
					'min' 		=> 1,
					'step' 		=> 1,
					'default' 	=> 1,
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_children',
			[
				'label' => esc_html__( 'Children', 'ova-brw' ),
			]
		);

			$this->add_control(
				'children_label',
				[
					'label' 	=> esc_html__( 'Label', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Children', 'ova-brw' ),
				]
			);

			$this->add_control(
				'default_children_number',
				[
					'label' 	=> esc_html__( 'Default Children Number', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::NUMBER,
					'min' 		=> 0,
					'step' 		=> 1,
					'default' 	=> 0,
				]
			);

			$this->add_control(
				'max_children',
				[
					'label' 	=> esc_html__( 'Maximum Children', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::NUMBER,
					'min' 		=> 0,
					'step' 		=> 1,
					'default' 	=> 4,
				]
			);

			$this->add_control(
				'min_children',
				[
					'label' 	=> esc_html__( 'Minimum Children', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::NUMBER,
					'min' 		=> 0,
					'step' 		=> 1,
					'default' 	=> 0,
				]
			);

			$this->add_control(
				'show_children',
				[
					'label' 		=> esc_html__( 'Show', 'ova-brw' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'ova-brw' ),
					'label_off' 	=> esc_html__( 'Hide', 'ova-brw' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'yes',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_beds',
			[
				'label' => esc_html__( 'Beds', 'ova-brw' ),
			]
		);

			$this->add_control(
				'beds_label',
				[
					'label' 	=> esc_html__( 'Label', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Beds', 'ova-brw' ),
				]
			);

			$this->add_control(
				'default_bed_number',
				[
					'label' 	=> esc_html__( 'Default Bed Number', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::NUMBER,
					'min' 		=> 1,
					'step' 		=> 1,
					'default' 	=> 1,
				]
			);

			$this->add_control(
				'max_bed',
				[
					'label' 	=> esc_html__( 'Maximum Bed', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::NUMBER,
					'min' 		=> 1,
					'step' 		=> 1,
					'default' 	=> 5,
				]
			);

			$this->add_control(
				'min_bed',
				[
					'label' 	=> esc_html__( 'Minimum Bed', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::NUMBER,
					'min' 		=> 1,
					'step' 		=> 1,
					'default' 	=> 1,
				]
			);

			$this->add_control(
				'show_bed',
				[
					'label' 		=> esc_html__( 'Show', 'ova-brw' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'ova-brw' ),
					'label_off' 	=> esc_html__( 'Hide', 'ova-brw' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'no',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_baths',
			[
				'label' => esc_html__( 'Baths', 'ova-brw' ),
			]
		);

			$this->add_control(
				'baths_label',
				[
					'label' 	=> esc_html__( 'Label', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Baths', 'ova-brw' ),
				]
			);

			$this->add_control(
				'default_bath_number',
				[
					'label' 	=> esc_html__( 'Default Bath Number', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::NUMBER,
					'min' 		=> 0,
					'step' 		=> 1,
					'default' 	=> 1,
				]
			);

			$this->add_control(
				'max_bath',
				[
					'label' 	=> esc_html__( 'Maximum Bath', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::NUMBER,
					'min' 		=> 0,
					'step' 		=> 1,
					'default' 	=> 3,
				]
			);

			$this->add_control(
				'min_bath',
				[
					'label' 	=> esc_html__( 'Minimum Bath', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::NUMBER,
					'min' 		=> 0,
					'step' 		=> 1,
					'default' 	=> 1,
				]
			);

			$this->add_control(
				'show_bath',
				[
					'label' 		=> esc_html__( 'Show', 'ova-brw' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'ova-brw' ),
					'label_off' 	=> esc_html__( 'Hide', 'ova-brw' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'no',
				]
			);

		$this->end_controls_section();

		/* Filter Settings */
		$this->start_controls_section(
			'section_filter_setting',
			[
				'label' => esc_html__( 'Filter Settings', 'ova-brw' ),
			]
		);

			$this->add_control(
				'show_filter',
				[
					'label' 		=> esc_html__( 'Show Filter', 'ova-brw' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'ova-brw' ),
					'label_off' 	=> esc_html__( 'Hide', 'ova-brw' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'yes',
				]
			);

			$this->add_control(
				'room_found_text',
				[
					'label' 	=> esc_html__( 'Room Found Text', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default'   => esc_html__( 'Rooms found', 'ova-brw' ),
				]
			);

			$this->add_control(
				'clear_filter_text',
				[
					'label' 	=> esc_html__( 'Clear Text', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default'   => esc_html__( 'Clear Filter', 'ova-brw' ),
				]
			);

		$this->end_controls_section();
		/* End Search Settings */

		/* Template Settings */
		$this->start_controls_section(
			'more_options',
			[
				'label' => esc_html__( 'Template Settings', 'ova-brw' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

			$this->add_control(
				'template',
				[
					'label' 	=> esc_html__( 'Template', 'ova-brw' ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 'template1',
					'options' 	=> [
						'template1' => esc_html__( 'Template 1', 'ova-brw' ),
						'template2' => esc_html__( 'Template 2', 'ova-brw' ),
						'template3' => esc_html__( 'Template 3', 'ova-brw' ),
					],
				]
			);

			$this->add_control(
				'meta_fields',
				[
					'label' 	=> esc_html__( 'Meta Fields', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
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
					'separator' => 'before',
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

        // Tab STYLE
		$this->start_controls_section(
			'section_ovabrw_search',
			[
				'label' => __( 'Search Form', 'ova-brw' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

	        $this->add_responsive_control(
	            'search_field_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'ova-brw' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ovabrw-search .ovabrw-search-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

			$this->add_control(
				'search_bgcolor',
				[
					'label' 	=> esc_html__( 'Background Color', 'ova-brw' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ovabrw-search .ovabrw-search-form' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'search_border',
					'label' => esc_html__( 'Border', 'ova-brw' ),
					'selector' => '{{WRAPPER}} .ovabrw-search .ovabrw-search-form',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'search_box_shadow',
					'label' => esc_html__( 'Box Shadow', 'ova-brw' ),
					'selector' => '{{WRAPPER}} .ovabrw-search .ovabrw-search-form',
				]
			);

		$this->end_controls_section();

		/* Begin icon Style */
		$this->start_controls_section(
            'label_style',
            [
                'label' => esc_html__( 'Label', 'ova-brw' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 	 => 'search_label_typography',
					'selector' => '{{WRAPPER}} .ovabrw-search .ovabrw-search-form .ovabrw-s-field .ovabrw-label .label',
				]
			);

			$this->add_control(
				'label_color',
				[
					'label' 	=> esc_html__( 'Color', 'ova-brw' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ovabrw-search .ovabrw-search-form .ovabrw-s-field .ovabrw-label .label' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
	            'label_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'ova-brw' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ovabrw-search .ovabrw-search-form .ovabrw-s-field .ovabrw-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'search_border_between',
					'label' => esc_html__( 'Border', 'ova-brw' ),
					'selector' => '{{WRAPPER}} .ovabrw-search .ovabrw-search-form .ovabrw-s-field .search-field:not(:last-child)',
				]
			);

            $this->add_control(
				'icon_label_heading',
				[
					'label' 	=> esc_html__( 'Icon', 'ova-brw' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before'
				]
			);
            
				$this->add_responsive_control(
					'size_label_icon',
					[
						'label' 		=> esc_html__( 'Size', 'ova-brw' ),
						'type' 			=> Controls_Manager::SLIDER,
						'size_units' 	=> [ 'px'],
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 70,
								'step' => 1,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .ovabrw-search .ovabrw-search-form .ovabrw-s-field .ovabrw-label i' => 'font-size: {{SIZE}}{{UNIT}};',
						],
					]
				);

				$this->add_control(
					'icon_color',
					[
						'label' 	=> esc_html__( 'Color', 'ova-brw' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ovabrw-search .ovabrw-search-form .ovabrw-s-field .ovabrw-label i' => 'color: {{VALUE}};',
						],
					]
				);

        $this->end_controls_section();
		/* End icon style */

		/* Begin Button Search Style */
		$this->start_controls_section(
            'button_style',
            [
                'label' => esc_html__( 'Search Button', 'ova-brw' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 	 => 'search_button_typography',
					'selector' => '{{WRAPPER}} .ovabrw-search .ovabrw-search-form .ovabrw-search-btn button.ovabrw-btn',
				]
			);

			$this->add_control(
				'button_text_color',
				[
					'label' 	=> esc_html__( 'Color', 'ova-brw' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ovabrw-search .ovabrw-search-form .ovabrw-search-btn button.ovabrw-btn' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'button_text_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'ova-brw' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ovabrw-search .ovabrw-search-form .ovabrw-search-btn button.ovabrw-btn:hover' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'button_bgcolor',
				[
					'label' 	=> esc_html__( 'Backgrund Color', 'ova-brw' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ovabrw-search .ovabrw-search-form .ovabrw-search-btn button.ovabrw-btn' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'button_bgcolor_hover',
				[
					'label' 	=> esc_html__( 'Backgrund Color Hover', 'ova-brw' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ovabrw-search .ovabrw-search-form .ovabrw-search-btn button.ovabrw-btn:hover' => 'background-color: {{VALUE}};',
					],
				]
			);

	        $this->add_responsive_control(
	            'button_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'ova-brw' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ovabrw-search .ovabrw-search-form .ovabrw-search-btn button.ovabrw-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'search_button_border',
					'label' => esc_html__( 'Border', 'ova-brw' ),
					'selector' => '{{WRAPPER}} .ovabrw-search .ovabrw-search-form .ovabrw-search-btn button.ovabrw-btn',
				]
			);

        $this->end_controls_section();
		/* End Button Check Availability style */

		/* Begin input Style */
		$this->start_controls_section(
            'input_style',
            [
                'label' => esc_html__( 'Date Input', 'ova-brw' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 	 => 'search_input_typography',
					'selector' => '{{WRAPPER}} .ovabrw-search .ovabrw-search-form .ovabrw-s-field .search-field .ovabrw-input input',
				]
			);

			$this->add_control(
				'input_color',
				[
					'label' 	=> esc_html__( 'Color', 'ova-brw' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ovabrw-search .ovabrw-search-form .ovabrw-s-field .search-field .ovabrw-input input' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'input_placeholder_color',
				[
					'label' 	=> esc_html__( 'Placeholder Color', 'ova-brw' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ovabrw-search .ovabrw-search-form .ovabrw-s-field .search-field .ovabrw-input input::placeholder' => 'color: {{VALUE}};',
					],
				]
			);

        $this->end_controls_section();
		/* End input style */


	}

	protected function render() {

		$settings = $this->get_settings();

		$template = apply_filters( 'ovabrw_ft_element_search_ajax', 'elementor/ovabrw_search_ajax.php' );

		ob_start();
		ovabrw_get_template( $template, $settings );
		echo ob_get_clean();
	}
}