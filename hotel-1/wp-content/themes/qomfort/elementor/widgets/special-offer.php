<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Qomfort_Elementor_Special_Offer extends Widget_Base {

	public function get_name() {
		return 'qomfort_elementor_special_offer';
	}

	public function get_title() {
		return esc_html__( 'Ova Special Offer', 'qomfort' );
	}

	public function get_icon() {
		return ' eicon-image-rollover';
	}

	public function get_categories() {
		return [ 'qomfort' ];
	}

	public function get_script_depends() {
		return [ '' ];
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
				'image',
				[
					'label' => esc_html__( 'Choose Image', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);

			$this->add_control(
				'subtitle',
				[
					'label' => esc_html__( 'Subtitle', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Weekly Deal', 'qomfort' ),
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
					'default' => esc_html__( '25% Off For All Furniture Products', 'qomfort' ),
					'placeholder' => esc_html__( 'Type your title here', 'qomfort' ),
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
				'text_link',
				[
					'label' => esc_html__( 'Text Link', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Shop Now', 'qomfort' ),
					'placeholder' => esc_html__( 'Type your text here', 'qomfort' ),
					'label_block' => true,
				]
			);

		$this->end_controls_section();

		/* Style */
		$this->start_controls_section(
			'general_style_section',
			[
				'label' => esc_html__( 'General', 'qomfort' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'general_margin',
			[
				'label' => esc_html__( 'Margin', 'qomfort' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .ova-special-offer .content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'general_padding',
			[
				'label' => esc_html__( 'Padding', 'qomfort' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .ova-special-offer .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'general_background',
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .ova-special-offer .image:before',
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
						'{{WRAPPER}} .ova-special-offer .content .subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .ova-special-offer .content .subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'subtitle_typography',
					'selector' => '{{WRAPPER}} .ova-special-offer .content .subtitle',
				]
			);

			$this->add_control(
				'subtitle_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-special-offer .content .subtitle' => 'color: {{VALUE}}',
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
						'{{WRAPPER}} .ova-special-offer .content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .ova-special-offer .content .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .ova-special-offer .content .title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-special-offer .content .title' => 'color: {{VALUE}}',
						'{{WRAPPER}} .ova-special-offer .content .title a' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		/* Text Link */
		$this->start_controls_section(
				'text_link_style_section',
				[
					'label' => esc_html__( 'Text Link', 'qomfort' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'text_link_margin',
				[
					'label' => esc_html__( 'Margin', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-special-offer .content .text_link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'text_link_typography',
					'selector' => '{{WRAPPER}} .ova-special-offer .content .text_link',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'text_link_border',
					'selector' => '{{WRAPPER}} .ova-special-offer .content .text_link',
				]
			);

			$this->start_controls_tabs(
					'text_link_style_tabs'
				);

				$this->start_controls_tab(
						'text_link_style_normal_tab',
						[
							'label' => esc_html__( 'Normal', 'qomfort' ),
						]
					);

					$this->add_control(
						'text_link_color',
						[
							'label' => esc_html__( 'Color', 'qomfort' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-special-offer .content .text_link' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'text_link_bg',
						[
							'label' => esc_html__( 'Background', 'qomfort' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-special-offer .content .text_link' => 'background: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
						'text_link_style_hover_tab',
						[
							'label' => esc_html__( 'Hover', 'qomfort' ),
						]
					);

					$this->add_control(
						'text_link_color_hover',
						[
							'label' => esc_html__( 'Color', 'qomfort' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-special-offer .content .text_link:hover' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'text_link_bg_hover',
						[
							'label' => esc_html__( 'Background', 'qomfort' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-special-offer .content .text_link:hover' => 'background: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();
	}

	// Render Template Here
	protected function render() {
		$settings 	= $this->get_settings();
		$image_url 	= $settings['image']['url'];
		$subtitle 	= $settings['subtitle'];
		$title 		= $settings['title'];
		$text_link 	= $settings['text_link'];
		$link 		= $settings['link'];
		$nofollow 	= $link['nofollow'] 	? 'rel="nofollow"' 	: '';
		$target 	= $link['is_external'] 	? 'target="_blank"' : '';
		?>
		<div class="ova-special-offer">
			<?php if ( $image_url ): ?>
				<div class="image" style="background-image: url('<?php echo esc_url( $image_url ); ?>');"></div>
			<?php endif; ?>
			<div class="content">
				<?php if ( $subtitle ): ?>
					<p class="subtitle"><?php echo esc_html( $subtitle ); ?></p>
				<?php endif; ?>
				<?php if ( $title ): ?>
					<h3 class="title"><?php echo esc_html( $title ); ?></h3>
				<?php endif; ?>
				<?php if ( $text_link ): ?>
					<a href="<?php echo esc_url( $link['url'] ); ?>" class="text_link"
						title="<?php echo esc_attr( $text_link ); ?>"
						<?php printf( '%1$s %2$s', $nofollow, $target ); ?>>
						<?php echo esc_html( $text_link ); ?>
						<i class="fas fa-angle-right" aria-hidden="true"></i>
					</a>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}

	
}
$widgets_manager->register( new Qomfort_Elementor_Special_Offer() );