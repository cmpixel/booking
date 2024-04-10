<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Qomfort_Elementor_Video_2 extends Widget_Base {

	public function get_name() {
		return 'qomfort_elementor_video_2';
	}

	public function get_title() {
		return esc_html__( 'Ova Video 2', 'qomfort' );
	}

	public function get_icon() {
		return 'eicon-play';
	}

	public function get_categories() {
		return [ 'qomfort' ];
	}

	public function get_script_depends() {
		return [ 'qomfort-elementor-video-2' ];
	}
	
	// Add Your Controll In This Function
	protected function register_controls() {

		/* Video */
		$this->start_controls_section(
				'section_video',
				[
					'label' => esc_html__( 'Video', 'qomfort' ),
				]
			);

			$this->add_control(
				'icon',
				[
					'label' => esc_html__( 'Icon', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-play',
						'library' => 'all',
					],
				]
			);

			$this->add_control(
				'icon_url_video',
				[
					'label' 	=> esc_html__( 'URL Video', 'qomfort' ),
					'type' 		=> Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'Enter your URL', 'qomfort' ) . ' (YouTube)',
					'default' 	=> 'https://www.youtube.com/watch?v=XHOmBV4js_E',
				]
			);

			$this->add_control(
				'title',
				[
					'label' => esc_html__( 'Title', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Watch Latest', 'qomfort' ),
					'placeholder' => esc_html__( 'Type your title here', 'qomfort' ),
					'label_block' => true,
				]
			);

			$this->add_control(
				'subtitle',
				[
					'label' => esc_html__( 'Subitle', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Videos', 'qomfort' ),
					'placeholder' => esc_html__( 'Type your subtitle here', 'qomfort' ),
					'label_block' => true,
				]
			);

	        $this->add_control(
				'video_options',
				[
					'label' 	=> esc_html__( 'Video Options', 'qomfort' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'icon_url_video!' => '',
					],
				]
			);

			$this->add_control(
				'autoplay_video',
				[
					'label' 	=> esc_html__( 'Autoplay', 'qomfort' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Yes', 'qomfort' ),
					'label_off' => esc_html__( 'No', 'qomfort' ),
					'default' 	=> 'yes',
					'condition' => [
						'icon_url_video!' => '',
					],
				]
			);

			$this->add_control(
				'mute_video',
				[
					'label' 	=> esc_html__( 'Mute', 'qomfort' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Yes', 'qomfort' ),
					'label_off' => esc_html__( 'No', 'qomfort' ),
					'default' 	=> 'no',
					'condition' => [
						'icon_url_video!' => '',
					],
				]
			);

			$this->add_control(
				'loop_video',
				[
					'label' 	=> esc_html__( 'Loop', 'qomfort' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Yes', 'qomfort' ),
					'label_off' => esc_html__( 'No', 'qomfort' ),
					'default' 	=> 'yes',
					'condition' => [
						'icon_url_video!' => '',
					],
				]
			);

			$this->add_control(
				'player_controls_video',
				[
					'label' 	=> esc_html__( 'Player Controls', 'qomfort' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Yes', 'qomfort' ),
					'label_off' => esc_html__( 'No', 'qomfort' ),
					'default' 	=> 'yes',
					'condition' => [
						'icon_url_video!' => '',
					],
				]
			);

			$this->add_control(
				'modest_branding_video',
				[
					'label' 	=> esc_html__( 'Modest Branding', 'qomfort' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Yes', 'qomfort' ),
					'label_off' => esc_html__( 'No', 'qomfort' ),
					'default' 	=> 'yes',
					'condition' => [
						'icon_url_video!' => '',
					],
				]
			);

			$this->add_control(
				'show_info_video',
				[
					'label' 	=> esc_html__( 'Show Info', 'qomfort' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Yes', 'qomfort' ),
					'label_off' => esc_html__( 'No', 'qomfort' ),
					'default' 	=> 'no',
					'condition' => [
						'icon_url_video!' => '',
					],
				]
			);

			$this->add_responsive_control(
				'alignment',
				[
					'label' 	=> esc_html__( 'Alignment', 'qomfort' ),
					'type' 		=> \Elementor\Controls_Manager::CHOOSE,
					'options' 	=> [
						'left' => [
							'title' => esc_html__( 'Left', 'qomfort' ),
							'icon' 	=> 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'qomfort' ),
							'icon' 	=> 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'qomfort' ),
							'icon' 	=> 'eicon-text-align-right',
						],
					],
					'toggle' 	=> true,
					'selectors' => [
						'{{WRAPPER}} .ova-video-2' => 'text-align: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		/* General */
		$this->start_controls_section(
				'items_style_section',
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
						'{{WRAPPER}} .ova-video-2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'items_bg',
				[
					'label' => esc_html__( 'Background', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-video-2' => 'background: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		/* Begin section icon style */
		$this->start_controls_section(
				'section_icon_style',
				[
					'label' => esc_html__( 'Icon', 'qomfort' ),
					'tab' 	=> Controls_Manager::TAB_STYLE,
				]
			);	

		    $this->add_responsive_control(
				'icon_font_size',
				[
					'label' 	=> esc_html__( 'Size', 'qomfort' ),
					'type' 		=> Controls_Manager::SLIDER,
					'size_units' => ['px'],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 200,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-video-2 .icon-content-view .content i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);

	        $this->add_responsive_control(
				'margin',
				[
					'label' => esc_html__( 'Margin', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem'],
					'selectors' => [
						'{{WRAPPER}} .ova-video-2 .icon-content-view .content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs( 'tabs_icon_style' );

				$this->start_controls_tab(
		            'tab_icon_normal',
		            [
		                'label' => esc_html__( 'Normal', 'qomfort' ),
		            ]
		        );

		        	$this->add_control(
			            'icon_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'qomfort' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-video-2 .icon-content-view .content i' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_icon_hover',
		            [
		                'label' => esc_html__( 'Hover', 'qomfort' ),
		            ]
		        );

		        	$this->add_control(
			            'icon_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'qomfort' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-video-2 .icon-content-view .content:hover i' => 'color: {{VALUE}};',
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

			$this->add_control(
				'title_margin',
				[
					'label' => esc_html__( 'Margin', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-video-2 .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .ova-video-2 .title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-video-2 .title' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		/* Subtitle */
	    $this->start_controls_section(
				'subtitle_style_section',
				[
					'label' => esc_html__( 'Subtitle', 'qomfort' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'subtitle_margin',
				[
					'label' => esc_html__( 'Margin', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-video-2 .subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'subtitle_typography',
					'selector' => '{{WRAPPER}} .ova-video-2 .subtitle',
				]
			);

			$this->add_control(
				'subtitle_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-video-2 .subtitle' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

	}

	// Render Template Here
	protected function render() {
		$settings = $this->get_settings();
		
		$title 		= $settings['title'];
		$subtitle 	= $settings['subtitle'];
		$icon 		= $settings['icon'];
		$url_video 	= $settings['icon_url_video'];

        // video options
		$autoplay 	= $settings['autoplay_video'];
		$mute 		= $settings['mute_video'];
		$loop 		= $settings['loop_video'];
		$controls 	= $settings['player_controls_video'];
		$modest 	= $settings['modest_branding_video'];
		$show_info 	= $settings['show_info_video'];

		?>
			<div class="ova-video-2">
				<div class="icon-content-view video_active">
					<?php if ( ! empty( $url_video ) ) : ?>
						<div class="content video-btn" 
							data-src="<?php echo esc_url( $url_video ); ?>" 
							data-autoplay="<?php echo esc_attr( $autoplay ); ?>" 
							data-mute="<?php echo esc_attr( $mute ); ?>" 
							data-loop="<?php echo esc_attr( $loop ); ?>" 
							data-controls="<?php echo esc_attr( $controls ); ?>" 
							data-modest="<?php echo esc_attr( $modest ); ?>" 
							data-show_info="<?php echo esc_attr( $show_info ); ?>">
							<?php \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] ); ?>
						</div>
					<?php endif; ?>
				</div>
				<?php if ( $title ): ?>
					<h3 class="title"><?php echo esc_html( $title ); ?></h3>
				<?php endif; ?>
				<?php if ( $subtitle ): ?>
					<h3 class="subtitle"><?php echo esc_html( $subtitle ); ?></h3>
				<?php endif; ?>
				
			</div>
		<?php
	}

	
}
$widgets_manager->register( new Qomfort_Elementor_Video_2() );