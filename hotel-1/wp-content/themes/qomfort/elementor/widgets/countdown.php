<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Qomfort_Elementor_Countdown extends Widget_Base {

	public function get_name() {
		return 'qomfort_elementor_countdown';
	}

	public function get_title() {
		return esc_html__( 'Ova Counter', 'qomfort' );
	}

	public function get_icon() {
		return 'eicon-counter';
	}

	public function get_categories() {
		return [ 'qomfort' ];
	}

	public function get_script_depends() {
		wp_enqueue_script( 'qomfort-counter-appear', get_theme_file_uri('/assets/libs/appear.js'), array('jquery'), false, true);
		// Odometer for counter
		wp_enqueue_style( 'odometer', get_template_directory_uri().'/assets/libs/odometer/odometer.min.css' );
		wp_enqueue_script( 'odometer', get_template_directory_uri().'/assets/libs/odometer/odometer.min.js', array('jquery'), false, true );
		return [ 'qomfort-elementor-countdown' ];
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
				'template',
				[
					'label' => esc_html__( 'Template', 'qomfort' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'template_1',
					'options' => [
						'template_1' => esc_html__('Template 1', 'qomfort'),
						'template_2' => esc_html__('Template 2', 'qomfort'),
						'template_3' => esc_html__('Template 3', 'qomfort'),
						'template_4' => esc_html__('Template 4', 'qomfort'),
						'template_5' => esc_html__('Template 5', 'qomfort'),
					]
				]
			);

			$this->add_control(
				'icon',
				[
					'label' => esc_html__( 'Icon', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-hotel',
						'library' => 'all',
					],
					'condition' => [
						'template' => 'template_4',
					],
				]
			);

		     $this->add_control(
				'number',
				[
					'label' 	=> esc_html__( 'Number', 'qomfort' ),
					'type'    => Controls_Manager::NUMBER,
					'default' => esc_html__( '49', 'qomfort' ),
				]
			);

			$this->add_control(
				'suffix',
				[
					'label'  => esc_html__( 'Suffix', 'qomfort' ),
					'type'   => Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'Plus', 'qomfort' ),
					'default' => '+',
				]
			);

			$this->add_control(
				'title',
				[
					'label' 	=> esc_html__( 'Title', 'qomfort' ),
					'type' 	=> Controls_Manager::TEXT,
					'default' => esc_html__( 'Luxury Hotels', 'qomfort' ),
					'placeholder' => esc_html__( 'Type your title here', 'qomfort' ),
				]
			);

			$this->add_control(
				'desc',
				[
					'label' => esc_html__( 'Description', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'rows' => 3,
					'default' => esc_html__( 'To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain', 'qomfort' ),
					'placeholder' => esc_html__( 'Type your description here', 'qomfort' ),
					'condition' => [
						'template' => 'template_5',
					],
				]
			);

			$this->add_control(
				'html_tag',
				[
					'label' => esc_html__( 'HTML Tag', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'h2',
					'options' => [
						'h1' => 'H1',
						'h2' => 'H2',
						'h3' => 'H3',
						'h4' => 'H4',
						'h5' => 'H5',
						'h6' => 'H6',
						'div' => 'div',
						'span' => 'span',
						'p' => 'p',
					],
				]
			);

			$this->add_responsive_control(
				'text_align',
				[
					'label' 	=> esc_html__( 'Alignment', 'qomfort' ),
					'type' 		=> Controls_Manager::CHOOSE,
					'options' 	=> [
						'left' 	=> [
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
					'selectors' => [
						'{{WRAPPER}} .ova-countdown' => 'text-align: {{VALUE}};',
					],
				]
			);
			
		$this->end_controls_section();

		/* General */
		$this->start_controls_section(
				'item_style_section',
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
						'{{WRAPPER}} .ova-countdown' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'item_bg',
				[
					'label' => esc_html__( 'Background', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-countdown' => 'background: {{VALUE}}',
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
					'condition' => [
						'template' => 'template_4',
					],
				]
			);

			$this->add_control(
				'icon_size',
				[
					'label' => esc_html__( 'Size', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 80,
							'step' => 5,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-countdown .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-countdown .icon svg' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'icon_left',
				[
					'label' => esc_html__( 'Left', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 200,
							'step' => 5,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-countdown .icon' => 'left: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'icon_bg',
				[
					'label' => esc_html__( 'Background', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-countdown .icon' => 'background: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'icon_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-countdown .icon i' => 'color: {{VALUE}}',
						'{{WRAPPER}} .ova-countdown .icon svg' => 'fill: {{VALUE}}',
						'{{WRAPPER}} .ova-countdown .icon svg path' => 'fill: {{VALUE}}',
					],
				]
			);

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
				'number_padding',
				[
					'label' => esc_html__( 'Padding', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-countdown .number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'number_typography',
					'selector' => '{{WRAPPER}} .ova-countdown .odometer',
				]
			);

			$this->add_control(
				'number_bg',
				[
					'label' => esc_html__( 'Background', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-countdown .number' => 'background: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'number_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-countdown .odometer' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		/* Suffix */
		$this->start_controls_section(
				'suffix_style_section',
				[
					'label' => esc_html__( 'Suffix', 'qomfort' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'suffix_margin',
				[
					'label' => esc_html__( 'Margin', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-countdown .suffix' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'suffix_typography',
					'selector' => '{{WRAPPER}} .ova-countdown .suffix',
				]
			);

			$this->add_control(
				'suffix_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-countdown .suffix' => 'color: {{VALUE}}',
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
				'title_padding',
				[
					'label' => esc_html__( 'Padding', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-countdown .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);


			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'title_border',
					'selector' => '{{WRAPPER}} .ova-countdown .title',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .ova-countdown .title',
				]
			);

			$this->add_control(
				'title_bg',
				[
					'label' => esc_html__( 'Background', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-countdown .title' => 'background: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-countdown .title' => 'color: {{VALUE}}',
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
					'condition' => [
						'template' => 'template_5',
					],
				]
			);

			$this->add_responsive_control(
				'desc_margin',
				[
					'label' => esc_html__( 'Margin', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-countdown .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'desc_typography',
					'selector' => '{{WRAPPER}} .ova-countdown .desc',
				]
			);

			$this->add_control(
				'desc_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-countdown .desc' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();
		
	}

	// Render Template Here
	protected function render() {

		$settings = $this->get_settings();

	     $template   	= $settings['template'];
		$number     	= isset( $settings['number'] ) ? $settings['number'] : '100';
		$suffix     	= $settings['suffix'];
		$title      	= $settings['title'];
		$desc 		= $settings['desc'];
		$html_tag 	= $settings['html_tag'];
		?>
           
          <div class="ova-countdown <?php echo esc_attr( $template ); ?>" 
               data-count="<?php echo esc_attr( $number ); ?>">
               <?php if ( $template == 'template_4' && $settings['icon'] ): ?>
                	<div class="icon">
                		<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                	</div>
               <?php endif; ?>
               <div class="number">
                	<span class="odometer">0</span>
				<span class="suffix"><?php echo esc_html( $suffix ); ?></span>
               </div>
               <?php if ( $template == 'template_5' ): ?>
               	<div class="content">
               <?php endif; ?>
      	     <?php if ( $title ): ?>
				<<?php echo esc_attr( $html_tag ); ?> class="title"><?php echo esc_html( $title ); ?></<?php echo esc_attr( $html_tag ); ?>>
			<?php endif;?>
			<?php if ( $template == 'template_5' && $desc ): ?>
				<p class="desc"><?php echo esc_html( $desc ); ?></p>
			<?php endif; ?>
			 <?php if ( $template == 'template_5' ): ?>
               	</div>
               <?php endif; ?>
          </div>
		 	
		<?php
	}

	
}
$widgets_manager->register( new Qomfort_Elementor_Countdown() );