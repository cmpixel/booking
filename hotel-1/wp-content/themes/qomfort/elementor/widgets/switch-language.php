<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Qomfort_Elementor_Switch_Language extends Widget_Base {

	public function get_name() {
		return 'qomfort_elementor_switch_language';
	}

	public function get_title() {
		return esc_html__( 'Switch Language', 'qomfort' );
	}

	public function get_icon() {
		return 'eicon-select';
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
				'current_language',
				[
					'label' => esc_html__( 'Current Language', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'English', 'qomfort' ),
					'placeholder' => esc_html__( 'Type your language here', 'qomfort' ),
				]
			);

			$this->add_control(
				'icon',
				[
					'label' => esc_html__( 'Icon', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'ovaicon ovaicon-download',
						'library' => 'ovaicon',
					],
				]
			);
			
			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'languages',
				[
					'label' => esc_html__( 'Languages', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'English', 'qomfort' ),
				]
			);

			$this->add_control(
				'item',
				[
					'label' => esc_html__( 'Languages', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'languages' => esc_html__('France', 'qomfort'),
						],
						[
							'languages' => esc_html__('Italy', 'qomfort'),
						],
					],
					'title_field' => '{{{ languages }}}',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'content_typography',
					'selector' => '{{WRAPPER}} .ova-switch-languages .current-language .text , {{WRAPPER}} .ova-switch-languages .dropdown-language .dropdown-item',
				]
			);

			$this->add_control(
				'text_color',
				[
					'label' => esc_html__( 'Text Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-switch-languages .current-language .text ,{{WRAPPER}} .ova-switch-languages .current-language i' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'list_language',
				[
					'label' => esc_html__( 'List Languages ', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'list_language_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-switch-languages .dropdown-language .dropdown-item' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'list_language_color_hover',
				[
					'label' => esc_html__( 'Hover Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-switch-languages .dropdown-language .dropdown-item:hover' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'background_color',
				[
					'label' => esc_html__( 'Background Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-switch-languages .dropdown-language' => 'background-color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();
	}

	// Render Template Here
	protected function render() {
		$settings = $this->get_settings();

		$current_language = $settings['current_language'];

		?>
			<div class="ova-switch-languages">

				<a href="javascript:;" class="current-language">
					<span class="text"><?php echo esc_html( $current_language ); ?></span>
					<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
				</a>

				<div class="dropdown-language">
					<?php foreach ( $settings['item']  as $item ) : ?>

						<a href="javascript:;" class="dropdown-item">
							<?php echo esc_html( $item['languages'] ); ?>
						</a>

					<?php endforeach; ?>
				</div>
			</div>
		<?php
	}

	
}
$widgets_manager->register( new Qomfort_Elementor_Switch_Language() );