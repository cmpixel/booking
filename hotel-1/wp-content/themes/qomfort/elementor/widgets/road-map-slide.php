<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Qomfort_Elementor_Road_Map_Slide extends Widget_Base {

	public function get_name() {
		return 'qomfort_elementor_road_map_slide';
	}

	public function get_title() {
		return esc_html__( 'Road Map Slide', 'qomfort' );
	}

	public function get_icon() {
		return 'eicon-time-line';
	}

	public function get_categories() {
		return [ 'qomfort' ];
	}

	public function get_script_depends() {
		return [ 'qomfort-elementor-road-map-slide' ];
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

			$repeater = new \Elementor\Repeater();

				$repeater->add_control(
					'image',
					[
						'label' => esc_html__( 'Choose Image', 'qomfort' ),
						'type' => \Elementor\Controls_Manager::MEDIA,
						'default' => [
							'url' => \Elementor\Utils::get_placeholder_image_src(),
						],
					]
				);

				$repeater->add_control(
					'date',
					[
						'label' => esc_html__( 'Date', 'qomfort' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( '1993', 'qomfort' ),
						'placeholder' => esc_html__( 'Type your date here', 'qomfort' ),
					]
				);

				$repeater->add_control(
					'title',
					[
						'label' => esc_html__( 'Title', 'qomfort' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'When We Started', 'qomfort' ),
						'placeholder' => esc_html__( 'Type your title here', 'qomfort' ),
					]
				);

				$repeater->add_control(
					'highlight',
					[
						'label' => esc_html__( 'Highlight Title', 'qomfort' ),
						'type' => \Elementor\Controls_Manager::NUMBER,
					]
				);

				$repeater->add_control(
					'desc',
					[
						'label' => esc_html__( 'Description', 'qomfort' ),
						'type' => \Elementor\Controls_Manager::TEXTAREA,
						'rows' => 5,
						'default' => esc_html__( 'Sit voluptatem accusantium doloremque laudantium totae aperiam eaque inventore', 'qomfort' ),
						'placeholder' => esc_html__( 'Type your description here', 'qomfort' ),
					]
				);

				$repeater->add_control(
					'active',
					[
						'label' => esc_html__( 'Active', 'qomfort' ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label_on' => esc_html__( 'Yes', 'qomfort' ),
						'label_off' => esc_html__( 'No', 'qomfort' ),
						'return_value' => 'yes',
						'default' => 'no',
					]
				);

			$this->add_control(
				'tab_item',
				[
					'label' 	=> esc_html__( 'Items', 'qomfort' ),
					'type' 		=> \Elementor\Controls_Manager::REPEATER,
					'fields' 	=> $repeater->get_controls(),
					'default' 	=> [
						[
							'date' => esc_html__( '1993', 'qomfort' ),
							'title' => esc_html__( 'When We Started', 'qomfort' ),
							'desc' => esc_html__('Sit voluptatem accusantium doloremque laudantium totae aperiam eaque inventore', 'qomfort' ),
						],
						[
							'date' => esc_html__( '1995', 'qomfort' ),
							'title' => esc_html__( 'Join 100+ Employee', 'qomfort' ),
							'highlight' => 2,
							'desc' => esc_html__('Ut enim ad minima veniam quis nostrum exercitatione corporis suscipit laboriosam aliquid', 'qomfort' ),
							'active' => 'yes',
						],
						[
							'date' => esc_html__( '1998', 'qomfort' ),
							'title' => esc_html__( 'Awards Winning', 'qomfort' ),
							'desc' => esc_html__('Quis autem vel eurep ehende qui voluptate quam molestiaey consequatur dolorem eum', 'qomfort' ),
						],
						[
							'date' => esc_html__( '2001', 'qomfort' ),
							'title' => esc_html__( 'Best Dream Company', 'qomfort' ),
							'desc' => esc_html__('Sit voluptatem accusantium doloremque laudantium totae aperiam eaque inventore', 'qomfort' ),
						],
					],
					'title_field' => '{{{ title }}}',
				]
			);

		$this->end_controls_section();

		/* Additional Options */
		$this->start_controls_section(
				'section_additional_options',
				[
					'label' => esc_html__( 'Additional Options', 'qomfort' ),
				]
			);

			$this->add_control(
				'margin_items',
				[
					'label'   => esc_html__( 'Margin Right Items', 'qomfort' ),
					'type'    => \Elementor\Controls_Manager::NUMBER,
					'default' => 40,
				]
				
			);

			$this->add_control(
				'item_number',
				[
					'label'       => esc_html__( 'Item Number', 'qomfort' ),
					'type'        => \Elementor\Controls_Manager::NUMBER,
					'description' => esc_html__( 'Number Item', 'qomfort' ),
					'default'     => 4,
				]
			);

			$this->add_control(
				'slides_to_scroll',
				[
					'label'       => esc_html__( 'Slides to Scroll', 'qomfort' ),
					'type'        => \Elementor\Controls_Manager::NUMBER,
					'description' => esc_html__( 'Set how many slides are scrolled per swipe.', 'qomfort' ),
					'default'     => 1,
				]
			);

			$this->add_control(
				'pause_on_hover',
				[
					'label'   => esc_html__( 'Pause on Hover', 'qomfort' ),
					'type'    => \Elementor\Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'qomfort' ),
						'no'  => esc_html__( 'No', 'qomfort' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'infinite',
				[
					'label'   => esc_html__( 'Infinite Loop', 'qomfort' ),
					'type'    => \Elementor\Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'qomfort' ),
						'no'  => esc_html__( 'No', 'qomfort' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'autoplay',
				[
					'label'   => esc_html__( 'Autoplay', 'qomfort' ),
					'type'    => \Elementor\Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'qomfort' ),
						'no'  => esc_html__( 'No', 'qomfort' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'autoplay_speed',
				[
					'label'     => esc_html__( 'Autoplay Speed', 'qomfort' ),
					'type'      => \Elementor\Controls_Manager::NUMBER,
					'default'   => 3000,
					'step'      => 500,
					'condition' => [
						'autoplay' => 'yes',
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'smartspeed',
				[
					'label'   => esc_html__( 'Smart Speed', 'qomfort' ),
					'type'    => \Elementor\Controls_Manager::NUMBER,
					'default' => 500,
				]
			);

			$this->add_control(
				'dot_control',
				[
					'label'   => esc_html__( 'Show Dots', 'qomfort' ),
					'type'    => \Elementor\Controls_Manager::SWITCHER,
					'default' => 'no',
					'options' => [
						'yes' => esc_html__( 'Yes', 'qomfort' ),
						'no'  => esc_html__( 'No', 'qomfort' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'nav_control',
				[
					'label'   => esc_html__( 'Show Nav', 'qomfort' ),
					'type'    => \Elementor\Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'qomfort' ),
						'no'  => esc_html__( 'No', 'qomfort' ),
					],
					'frontend_available' => true,
				]
			);

		$this->end_controls_section();

		/* General */
		$this->start_controls_section(
				'style_section',
				[
					'label' => esc_html__( 'General', 'qomfort' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'slide_padding',
				[
					'label' => esc_html__( 'Padding', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .road-map-slide .road-map-wrapper .owl-stage-outer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'nav_style',
				[
					'label' => esc_html__( 'Navigation', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'line_color',
				[
					'label' => esc_html__( 'Line Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .road-map-slide .ova-nav' => 'background: {{VALUE}}',
					],
				]
			);

			$this->start_controls_tabs(
					'nav_style_tabs'
				);

				$this->start_controls_tab(
						'nav_style_normal_tab',
						[
							'label' => esc_html__( 'Normal', 'qomfort' ),
						]
					);

					$this->add_control(
						'nav_color',
						[
							'label' => esc_html__( 'Color', 'qomfort' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .road-map-slide .ova-nav .owl-prev i' => 'color: {{VALUE}}',
								'{{WRAPPER}} .road-map-slide .ova-nav .owl-next i' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'nav_bg',
						[
							'label' => esc_html__( 'Background', 'qomfort' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .road-map-slide .ova-nav .owl-prev' => 'background: {{VALUE}}',
								'{{WRAPPER}} .road-map-slide .ova-nav .owl-next' => 'background: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
						'nav_style_hover_tab',
						[
							'label' => esc_html__( 'Hover', 'qomfort' ),
						]
					);

					$this->add_control(
						'nav_color_hover',
						[
							'label' => esc_html__( 'Color', 'qomfort' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .road-map-slide .ova-nav .owl-prev:hover i' => 'color: {{VALUE}}',
								'{{WRAPPER}} .road-map-slide .ova-nav .owl-next:hover i' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'nav_bg_hover',
						[
							'label' => esc_html__( 'Background', 'qomfort' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .road-map-slide .ova-nav .owl-prev:hover' => 'background: {{VALUE}}',
								'{{WRAPPER}} .road-map-slide .ova-nav .owl-next:hover' => 'background: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();

		/* Date */
		$this->start_controls_section(
				'date_style_section',
				[
					'label' => esc_html__( 'Date', 'qomfort' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->start_controls_tabs(
					'date_style_tabs'
				);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'content_typography',
						'selector' => '{{WRAPPER}} .road-map-slide .road-map .date .text',
					]
				);

				$this->start_controls_tab(
						'date_style_normal_tab',
						[
							'label' => esc_html__( 'Normal', 'qomfort' ),
						]
					);

					$this->add_group_control(
						\Elementor\Group_Control_Box_Shadow::get_type(),
						[
							'name' => 'date_box_shadow',
							'selector' => '{{WRAPPER}} .road-map-slide .road-map .date',
						]
					);

					$this->add_control(
						'date_color',
						[
							'label' => esc_html__( 'Color', 'qomfort' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .road-map-slide .road-map .date .text' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'date_bg',
						[
							'label' => esc_html__( 'Background', 'qomfort' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .road-map-slide .road-map .date .text' => 'background: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
						'date_style_active_tab',
						[
							'label' => esc_html__( 'Active', 'qomfort' ),
						]
					);

					$this->add_group_control(
						\Elementor\Group_Control_Box_Shadow::get_type(),
						[
							'name' => 'date_box_shadow_active',
							'selector' => '{{WRAPPER}} .road-map-slide .road-map .date.active',
						]
					);

					$this->add_control(
						'date_color_active',
						[
							'label' => esc_html__( 'Color', 'qomfort' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .road-map-slide .road-map .date.active .text' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'date_bg_active',
						[
							'label' => esc_html__( 'Background', 'qomfort' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .road-map-slide .road-map .date.active .text' => 'background: {{VALUE}}',
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

			$this->add_responsive_control(
				'title_margin',
				[
					'label' => esc_html__( 'Margin', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .road-map-slide .road-map .box .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .road-map-slide .road-map .box .title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .road-map-slide .road-map .box .title' => 'color: {{VALUE}}',
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
						'{{WRAPPER}} .road-map-slide .road-map .box .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'desc_typography',
					'selector' => '{{WRAPPER}} .road-map-slide .road-map .box .desc',
				]
			);

			$this->add_control(
				'desc_color',
				[
					'label' => esc_html__( 'Color', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .road-map-slide .road-map .box .desc' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

	}

	// Render Template Here
	protected function render() {

		$settings 	= $this->get_settings();
		$tab_item 	= $settings['tab_item'];

		$data_options['items']              = $settings['item_number'];
		$data_options['slideBy']            = $settings['slides_to_scroll'];
		$data_options['margin']             = $settings['margin_items'];
		$data_options['autoplayHoverPause'] = $settings['pause_on_hover'] === 'yes' ? true : false;
		$data_options['loop']               = $settings['infinite'] === 'yes' ? true : false;
		$data_options['autoplay']           = $settings['autoplay'] === 'yes' ? true : false;
		$data_options['autoplayTimeout']    = $settings['autoplay_speed'];
		$data_options['smartSpeed']         = $settings['smartspeed'];
		$data_options['dots']               = $settings['dot_control'] === 'yes' ? true : false;
		$data_options['nav']                = $settings['nav_control'] === 'yes' ? true : false;
		$data_options['rtl']				= is_rtl() ? true : false;

		?>
		<?php if ( $tab_item && is_array( $tab_item ) ): ?>
		 	<div class="road-map-slide">
		 		<div class="road-map-wrapper owl-carousel owl-theme" data-options="<?php echo esc_attr( json_encode( $data_options ) ); ?>">
		 			<?php foreach ( $tab_item as $key => $item ): ?>
		 				<?php
		 				$image 		= $item['image'];
		 				$image_id 	= $image['id'];
						$image_alt 	= '';
						if ( $image_id ) {
							$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
							if ( ! $image_alt ) {
								$image_alt = get_the_title( $image_id );
							}
						}
		 				$date 		= $item['date'];
		 				$title 		= $item['title'];
		 				$highlight 	= $item['highlight'];
		 				$desc 		= $item['desc'];
		 				$active 	= $item['active'] == 'yes' ? 'active' : '';
		 				$new_title = '';
		 				if ( $highlight && $title ) {
		 					$str_arr = explode( " ", $title );
		 					$key = ( $highlight - 1 ) >= 0 ? $highlight - 1 : 0;
		 					if ( array_key_exists( $key, $str_arr ) ) {
		 						$new_str = '<span class="bold">' . $str_arr[$key] . '</span>';
		 						$str_arr[$key] = $new_str;
		 						$new_title = implode( " ", $str_arr );
		 					}
		 				}
		 				?>
		 				<div class="item">
		 					<div class="road-map">
		 						<?php if ( $image['url'] ): ?>
		 							<div class="img">
		 								<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
		 							</div>
		 						<?php endif; ?>
			 					<div class="date <?php echo esc_attr( $active ); ?>">
			 						<p class="text"><?php echo esc_html( $date ); ?></p>
			 					</div>
			 					<div class="box">
			 						<?php if ( $title ): ?>
			 							<?php if ( $new_title ): ?>
			 								<h3 class="title"><?php printf('%s', $new_title); ?></h3>
			 							<?php else: ?>
			 								<h3 class="title"><?php echo esc_html( $title ); ?></h3>
			 							<?php endif; ?>
			 						<?php endif; ?>
			 						<?php if ( $desc ): ?>
			 							<p class="desc"><?php echo esc_html( $desc ); ?></p>
			 						<?php endif; ?>
			 					</div>
		 					</div>
		 				</div>
		 			<?php endforeach; ?>
		 		</div>
		 		<div class="ova-nav"></div>
		 	</div>
		<?php
		endif;
	}
}
$widgets_manager->register( new Qomfort_Elementor_Road_Map_Slide() );