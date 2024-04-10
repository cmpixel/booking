<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Qomfort_Elementor_Image_Box_2 extends Widget_Base {

	public function get_name() {
		return 'qomfort_elementor_image_box_2';
	}

	public function get_title() {
		return esc_html__( 'Ova Image Box 2', 'qomfort' );
	}

	public function get_icon() {
		return 'eicon-image-box';
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
				]
			);

			$this->add_control(
				'gallery',
				[
					'label' => esc_html__( 'Add Images', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::GALLERY,
					'show_label' => false,
					'default' => [],
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
						'{{WRAPPER}} .ova-image-box-2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'items_bg',
				[
					'label' => esc_html__( 'Background', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-image-box-2' => 'background: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'image_style',
				[
					'label' => esc_html__( 'Image', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
				'image_margin',
				[
					'label' => esc_html__( 'Margin Left', 'qomfort' ),
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
						'{{WRAPPER}} .ova-image-box-2 .gallery li:not(:first-child)' => 'margin-left: {{SIZE}}{{UNIT}};',
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

			$this->add_control(
				'title_margin',
				[
					'label' => esc_html__( 'Margin', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-image-box-2 .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .ova-image-box-2 .title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-image-box-2 .title' => 'color: {{VALUE}}',
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
						'{{WRAPPER}} .ova-image-box-2 .subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'subtitle_typography',
					'selector' => '{{WRAPPER}} .ova-image-box-2 .subtitle',
				]
			);

			$this->add_control(
				'subtitle_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-image-box-2 .subtitle' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();
	}

	// Render Template Here
	protected function render() {
		$settings 	= $this->get_settings();
		$title 		= $settings['title'];
		$subtitle 	= $settings['subtitle'];
		$gallery 	= $settings['gallery'];

		?>
		
			<div class="ova-image-box-2">
				<?php if ( $title ): ?>
					<h3 class="title"><?php echo esc_html( $title ); ?></h3>
				<?php endif; ?>
				<?php if ( $subtitle ): ?>
					<h3 class="subtitle"><?php echo esc_html( $subtitle ); ?></h3>
				<?php endif; ?>
				<?php if ( $gallery ): ?>
					<ul class="gallery">
						<?php foreach ($gallery as $key => $image): ?>
							<?php
							$image_url 	= $image['url'];
							$image_id 	= $image['id'];
							$image_alt 	= '';
							if ( $image_id ) {
								$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
								if ( ! $image_alt ) {
									$image_alt = get_the_title( $image_id );
								}
							}
							?>
							<?php if ( $image_url ): ?>
								<li class="item" style="z-index: <?php echo esc_attr( $key + 1 ); ?>;">
									<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
								</li>
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>

		<?php
	}

	
}
$widgets_manager->register( new Qomfort_Elementor_Image_Box_2() );