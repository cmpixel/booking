<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Qomfort_Elementor_Heading extends Widget_Base {

	public function get_name() {
		return 'qomfort_elementor_heading';
	}

	public function get_title() {
		return esc_html__( 'Ova Heading', 'qomfort' );
	}

	public function get_icon() {
		return 'eicon-heading';
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
				'content_section',
				[
					'label' => esc_html__( 'Content', 'qomfort' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);

			$this->add_control(
				'subtitle',
				[
					'label' => esc_html__( 'Subtitle', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'About Company', 'qomfort' ),
					'placeholder' => esc_html__( 'Type your subtitle here', 'qomfort' ),
					'label_block' => true,
				]
			);

			$this->add_control(
				'title',
				[
					'label' => esc_html__( 'Title', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'rows' => 3,
					'default' => esc_html__( 'World Class Luxury Hotel & Restaurant Near City', 'qomfort' ),
					'placeholder' => esc_html__( 'Type your title here', 'qomfort' ),
				]
			);

			$this->add_control(
				'desc',
				[
					'label' => esc_html__( 'Description', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'rows' => 5,
					'default' => esc_html__( 'We denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment', 'qomfort' ),
					'placeholder' => esc_html__( 'Type your description here', 'qomfort' ),
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
					'label' => esc_html__( 'Alignment', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'qomfort' ),
							'icon' => 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'qomfort' ),
							'icon' => 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'qomfort' ),
							'icon' => 'eicon-text-align-right',
						],
					],
					'toggle' => true,
					'selectors' => [
						'{{WRAPPER}} .ova-heading' => 'text-align: {{VALUE}};',
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

			$this->add_responsive_control(
				'subtitle_margin',
				[
					'label' => esc_html__( 'Margin', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-heading .subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'subtitle_padding',
				[
					'label' => esc_html__( 'Padding', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-heading .subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'subtitle_typography',
					'selector' => '{{WRAPPER}} .ova-heading .subtitle',
				]
			);

			$this->add_control(
				'subtitle_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-heading .subtitle' => 'color: {{VALUE}}',
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
				'title_margin',
				[
					'label' => esc_html__( 'Margin', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-heading .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .ova-heading .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .ova-heading .title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-heading .title' => 'color: {{VALUE}}',
						'{{WRAPPER}} .ova-heading .title a' => 'color: {{VALUE}}',
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
				]
			);

			$this->add_responsive_control(
				'desc_margin',
				[
					'label' => esc_html__( 'Margin', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-heading .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'desc_padding',
				[
					'label' => esc_html__( 'Padding', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-heading .desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'desc_typography',
					'selector' => '{{WRAPPER}} .ova-heading .desc',
				]
			);

			$this->add_control(
				'desc_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-heading .desc' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();
	}

	// Render Template Here
	protected function render() {
		$settings 	= $this->get_settings();
		$subtitle 	= $settings['subtitle'];
		$title 		= $settings['title'];
		$desc 		= $settings['desc'];
		$link 		= $settings['link'];
		$nofollow 	= $link['nofollow'] 	? 'rel="nofollow"' 	: '';
		$target 	= $link['is_external'] 	? 'target="_blank"' : '';
		$html_tag 	= $settings['html_tag'];

		// replace % to %% avoid printf error
		if(strpos($title, '%') !== false){
		    $title = str_replace('%', '%%', $title);
		}

	?>

		<div class="ova-heading">
			<?php if ( $subtitle ): ?>
				<p class="subtitle"><?php echo esc_html( $subtitle ); ?></p>
			<?php endif; ?>
			<?php if ( $title ): ?>

				<?php if ( $link['url'] ): ?>
					<<?php echo esc_attr( $html_tag ); ?> class="title"><a href="<?php echo esc_url( $link['url'] ); ?>"
						title="<?php echo esc_attr( $title ); ?>" <?php printf( '%1$s %2$s', $nofollow, $target ); ?>><?php printf( $title ); ?></a></<?php echo esc_attr( $html_tag ); ?>>
				<?php else: ?>
					<<?php echo esc_attr( $html_tag ); ?> class="title"><?php printf( $title ); ?></<?php echo esc_attr( $html_tag ); ?>>
				<?php endif ?>

			<?php endif; ?>
			<?php if ( $desc ): ?>
				<p class="desc"><?php echo esc_html( $desc ); ?></p>
			<?php endif; ?>
		</div>

		<?php
	}

	
}
$widgets_manager->register( new Qomfort_Elementor_Heading() );