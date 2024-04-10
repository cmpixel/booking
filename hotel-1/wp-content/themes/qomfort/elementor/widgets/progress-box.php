<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Qomfort_Elementor_Progress_Box extends Widget_Base {

	public function get_name() {
		return 'qomfort_elementor_progress_box';
	}

	public function get_title() {
		return esc_html__( 'Ova Progress Box', 'qomfort' );
	}

	public function get_icon() {
		return 'eicon-skill-bar';
	}

	public function get_categories() {
		return [ 'qomfort' ];
	}

	public function get_script_depends() {
		wp_enqueue_script( 'appear', get_theme_file_uri('/assets/libs/appear.js'), array('jquery'), false, true);
		return [ 'qomfort-elementor-progress-box' ];
	}
	
	// Add Your Controll In This Function
	protected function register_controls() {

		/* Begin progress */
		$this->start_controls_section(
				'section_progress',
				[
					'label' => esc_html__( 'Progress', 'qomfort' ),
				]
			);

			$this->add_control(
				'title',
				[
					'label' => esc_html__( 'Title', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'rows' => 3,
					'default' => esc_html__( '25+ Years Of Experience In Hotel Services', 'qomfort' ),
					'placeholder' => esc_html__( 'Type your title here', 'qomfort' ),
				]
			);

			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'list_title',
				[
					'label' => esc_html__( 'Title', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'List Title' , 'qomfort' ),
					'label_block' => true,
				]
			);
			
			$repeater->add_control(
				'percent',
				[
					'label' 	=> esc_html__( 'Percent', 'qomfort' ),
					'type' 		=> \Elementor\Controls_Manager::NUMBER,
					'min' 		=> 0,
					'max' 		=> 100,
					'step' 		=> 5,
					'default' 	=> 60,
				]
			);

			$repeater->add_control(
	            'show_percent',
	            [
	                'label' 	=> esc_html__( 'Show Percent', 'qomfort' ),
	                'type' 		=> \Elementor\Controls_Manager::SWITCHER,
	                'default' 	=> 'yes',
	                'return_value' => 'yes',
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
							'list_title' => esc_html__( 'Quality', 'qomfort' ),
							'percent' => 89,
						],
						[
							'list_title' => esc_html__( 'Performance', 'qomfort' ),
							'percent' => 76,
						],
					],
					'title_field' => '{{{ list_title }}}',
				]
			);

		$this->end_controls_section();
		/* End progress */

		/* General */
		$this->start_controls_section(
				'general_section_style',
				[
					'label' => esc_html__( 'General', 'qomfort' ),
					'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
	            'general_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'qomfort' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-progress' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_control(
				'general_bg',
				[
					'label' => esc_html__( 'Background', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-progress' => 'background: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		/* Begin title style */
		$this->start_controls_section(
				'section_title_style',
				[
					'label' => esc_html__( 'Title', 'qomfort' ),
					'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
	            'title_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'qomfort' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-progress .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'title_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'qomfort' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-progress .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

			$this->add_control(
				'title_color',
				[
					'label' 	=> esc_html__( 'Color', 'qomfort' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-progress .title' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .ova-progress .title',
				]
			);

		$this->end_controls_section();
		/* End title style */

		/* Begin progress style */
		$this->start_controls_section(
				'section_progress_style',
				[
					'label' => esc_html__( 'Progress Bar', 'qomfort' ),
					'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'progress_bg',
				[
					'label' 	=> esc_html__( 'Background', 'qomfort' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-progress .ova-percent-view' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'progress_height',
				[
					'label' 	=> esc_html__( 'Height', 'qomfort' ),
					'type' 		=> \Elementor\Controls_Manager::SLIDER,
					'selectors' => [
						'{{WRAPPER}} .ova-progress .ova-percent-view' => 'height: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
	            'title_alignment',
	            [
	                'label' 	=> esc_html__( 'Alignment List', 'qomfort' ),
	                'type' 		=> \Elementor\Controls_Manager::CHOOSE,
	                'options' 	=> [
	                    'left' 	=> [
	                        'title' => esc_html__( 'Left', 'qomfort' ),
	                        'icon' 	=> 'eicon-text-align-left',
	                    ],
	                    'center' 	=> [
	                        'title' => esc_html__( 'Center', 'qomfort' ),
	                        'icon' 	=> 'eicon-text-align-center',
	                    ],
	                    'right' 	=> [
	                        'title' => esc_html__( 'Right', 'qomfort' ),
	                        'icon' 	=> 'eicon-text-align-right',
	                    ],
	                ],
	                'selectors' => [
	                    '{{WRAPPER}} .ova-progress' => 'text-align: {{VALUE}}',
	                ],
	            ]
	        );

	        $this->add_group_control(
	            \Elementor\Group_Control_Border::get_type(), [
	                'name' 		=> 'progress_border',
	                'selector' 	=> '{{WRAPPER}} .ova-progress .ova-percent-view',
	                'separator' => 'before',
	            ]
	        );

	        $this->add_control(
	            'progress_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'qomfort' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-progress .ova-percent-view' 				=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-progress .ova-percent-view .ova-percent' 	=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$this->end_controls_section();
		/* End progress style */

		/* Begin percent style */
		$this->start_controls_section(
				'section_percent_style',
				[
					'label' => esc_html__( 'Percent', 'qomfort' ),
					'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'percent_bg',
				[
					'label' 	=> esc_html__( 'Background', 'qomfort' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-progress .ova-percent-view .ova-percent' => 'background: {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();
		/* End percent style */

		/* Begin list title style */
		$this->start_controls_section(
				'section_list_title_style',
				[
					'label' => esc_html__( 'Item Title', 'qomfort' ),
					'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'list_title_color',
				[
					'label' 	=> esc_html__( 'Color', 'qomfort' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-progress .ova-percent-view .list_title' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'list_title_typography',
					'selector' 	=> '{{WRAPPER}} .ova-progress .ova-percent-view .list_title',
				]
			);

			$this->add_responsive_control(
				'list_title_top',
				[
					'label' => esc_html__( 'Top', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => -100,
							'max' => 100,
							'step' => 5,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-progress .ova-percent-view .list_title' => 'top: {{SIZE}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
		/* End title style */

		/* Begin percentage style */
		$this->start_controls_section(
				'section_percentage_style',
				[
					'label' => esc_html__( 'Percentage', 'qomfort' ),
					'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'percentage_color',
				[
					'label' 	=> esc_html__( 'Color', 'qomfort' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-progress .ova-percent-view .percentage' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'percentage_typography',
					'selector' 	=> '{{WRAPPER}} .ova-progress .ova-percent-view .percentage',
				]
			);

			$this->add_control(
				'percentage_top',
				[
					'label' 		=> esc_html__( 'Top', 'qomfort' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' 	=> -100,
							'max' 	=> 100,
							'step' 	=> 5,
						],
						'%' => [
							'min' 	=> -100,
							'max' 	=> 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-progress .ova-percent-view .percentage' => 'top: {{SIZE}}{{UNIT}}',
					],
				]
			);

		$this->end_controls_section();
		/* End percentage style */
	}

	// Render Template Here
	protected function render() {
		$settings 			= $this->get_settings();
		$title 				= $settings['title'];
		$list 				= $settings['list'];

		?>

		<div class="ova-progress">
			<?php if ( $title ): ?>
				<h3 class="title"><?php echo esc_html( $title ); ?></h3>
			<?php endif; ?>
			<?php if ( $list ): ?>
				<ul class="list">
					<?php foreach ( $list as $key => $item ): ?>
						<?php
						$list_title 	= $item['list_title'];
						$percent 		= $item['percent'];
						$show_percent 	= $item['show_percent'];
						?>
						<li class="item">
							<div class="ova-percent-view">
								<?php if ( $list_title ): ?>
									<span class="list_title"><?php echo esc_html( $list_title ); ?></span>
								<?php endif; ?>
								<div class="ova-percent" data-percent="<?php echo esc_attr( $percent ); ?>"></div>
								<span class="percentage" data-show-percent="<?php echo esc_attr( $show_percent ); ?>">
									<?php echo esc_html( $percent ); ?>%
								</span>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
		<?php
	}

	
}
$widgets_manager->register( new Qomfort_Elementor_Progress_Box() );