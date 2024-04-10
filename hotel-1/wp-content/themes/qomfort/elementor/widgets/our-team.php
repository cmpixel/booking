<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Qomfort_Elementor_Our_Team extends Widget_Base {

	public function get_name() {
		return 'qomfort_elementor_our_team';
	}

	public function get_title() {
		return esc_html__( 'Our Team', 'qomfort' );
	}

	public function get_icon() {
		return 'eicon-person';
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
				'image',
				[
					'label' 	=> esc_html__( 'Choose Image', 'qomfort' ),
					'type' 		=> \Elementor\Controls_Manager::MEDIA,
					'dynamic' 	=> [
						'active' => true,
					],
					'default' 	=> [
						'url' 	=> \Elementor\Utils::get_placeholder_image_src(),
					],
					'separator' => 'before'
				]
			);
				
			$this->add_control(
				'name',
				[
					'label' 	=> esc_html__( 'Name', 'qomfort' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Michael S. Stewart', 'qomfort' ),
				]
			);

			$this->add_control(
				'job',
				[
					'label' 	=> esc_html__( 'Job', 'qomfort' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'CEO & Founder', 'qomfort' ),
				]
			);
            
			// list icons control
			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'icon',
				[
					'label' => esc_html__( 'Icon', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'fab fa-facebook-f',
						'library' => 'all',
					],
				]
			);

			$repeater->add_control(
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

			$repeater->add_control(
				'icon_title', [
					'label' 		=> esc_html__( 'Icon Title', 'qomfort' ),
					'type' 			=> \Elementor\Controls_Manager::TEXT,
					'default' 		=> esc_html__( 'List Icon Title' , 'qomfort' ),
					'label_block' 	=> true,
				]
			);
			
            $this->add_control(
				'social_icon',
				[
					'label' 	=> esc_html__( 'Social Icons', 'qomfort' ),
					'type' 		=> \Elementor\Controls_Manager::REPEATER,
					'fields' 	=> $repeater->get_controls(),
					'default' 	=> [
						[	
							'icon' => [
								'value' => 'fab fa-facebook-f',
							],
							'icon_title' => esc_html__( 'Facebook', 'qomfort' ),
						],
						[	
							'icon' => [
								'value' => 'fab fa-twitter',
							],
							'icon_title' => esc_html__( 'Twitter', 'qomfort' ),
						],
						[	
							'icon' => [
								'value' => 'fab fa-linkedin-in',
							],
							'icon_title' => esc_html__( 'Linkedin', 'qomfort' ),
						],
						[	
							'icon' => [
								'value' => 'fab fa-youtube',
							],
							'icon_title' => esc_html__( 'Youtube', 'qomfort' ),
						],
	
					],
					'title_field' => '{{{ icon_title }}}',
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
				'items_margin',
				[
					'label' => esc_html__( 'Margin', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-our-team .info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'items_padding',
				[
					'label' => esc_html__( 'Padding', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-our-team .info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'items_bg',
				[
					'label' => esc_html__( 'Background', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-our-team .info' => 'background: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		/* Name */
		$this->start_controls_section(
				'name_style_section',
				[
					'label' => esc_html__( 'Name', 'qomfort' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'name_margin',
				[
					'label' => esc_html__( 'Margin', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-our-team .info .name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'name_typography',
					'selector' => '{{WRAPPER}} .ova-our-team .info .name',
				]
			);

			$this->add_control(
				'name_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-our-team .info .name' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		/* Job */
		$this->start_controls_section(
				'job_style_section',
				[
					'label' => esc_html__( 'Job', 'qomfort' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'job_margin',
				[
					'label' => esc_html__( 'Margin', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-our-team .info .job' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'job_typography',
					'selector' => '{{WRAPPER}} .ova-our-team .info .job',
				]
			);

			$this->add_control(
				'job_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-our-team .info .job' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		/* Social Icon */
		$this->start_controls_section(
				'social_style_section',
				[
					'label' => esc_html__( 'Social Icon', 'qomfort' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'social_padding',
				[
					'label' => esc_html__( 'Padding', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-our-team .image .social-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'social_bg',
				[
					'label' => esc_html__( 'Background', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-our-team .image .social-icon' => 'background: {{VALUE}}',
					],
				]
			);

			/* Icon */
			$this->add_control(
				'icon_style',
				[
					'label' => esc_html__( 'Icon', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
				'icon_size',
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
						'{{WRAPPER}} .ova-our-team .image .social-icon .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-our-team .image .social-icon .icon svg' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'icon_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-our-team .image .social-icon .icon i' => 'color: {{VALUE}}',
						'{{WRAPPER}} .ova-our-team .image .social-icon .icon svg' => 'fill: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'icon_color_hover',
				[
					'label' => esc_html__( 'Hover Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-our-team .image .social-icon .icon:hover i' => 'color: {{VALUE}}',
						'{{WRAPPER}} .ova-our-team .image .social-icon .icon:hover svg' => 'fill: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

	}

	// Render Template Here
	protected function render() {
		$settings 		= $this->get_settings();
		$image 			= $settings['image'];
		$social_icon 	= $settings['social_icon'];
		$image_id 		= $image['id'];
		$name 			= $settings['name'];
		$job 			= $settings['job'];
		$image_alt 		= '';
		if ( $image_id ) {
			$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
			if ( ! $image_alt ) {
				$image_alt = get_the_title( $image_id );
			}
		}
		?>
		<div class="ova-our-team">
			<?php if ( $image['url'] ): ?>
				<div class="image">
					<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
					<?php if ( $social_icon ): ?>
						<ul class="social-icon">
							<?php foreach ( $social_icon as $key => $item ): ?>
								<?php
								$link 		= $item['link'];
								$icon_title = $item['icon_title'];
								$nofollow 	= $link['nofollow'] 	? 'rel="nofollow"' 	: '';
								$target 	= $link['is_external'] 	? 'target="_blank"' : '';
								?>
								<?php if ( $item['icon'] ): ?>
									<li>
										<a href="<?php echo esc_url( $link['url'] ); ?>" class="icon"
											title="<?php echo esc_attr( $icon_title ); ?>" <?php printf( '%1$s %2$s', $nofollow, $target ); ?>>
											<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
										</a>
									</li>
								<?php endif; ?>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<div class="info">
				<?php if ( $name ): ?>
					<h3 class="name"><?php echo esc_html( $name ); ?></h3>
				<?php endif; ?>
				<?php if ( $job ): ?>
					<p class="job"><?php echo esc_html( $job ); ?></p>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}

	
}
$widgets_manager->register( new Qomfort_Elementor_Our_Team() );