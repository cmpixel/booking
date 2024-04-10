<?php
namespace ovabrw_product_elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ovabrw_unavailable_time extends Widget_Base {

	public function get_name() {		
		return 'ovabrw_unavailable_time';
	}

	public function get_title() {
		return esc_html__( 'Unavailable Time', 'ova-brw' );
	}

	public function get_icon() {
		return 'eicon-product-price';
	}

	public function get_categories() {
		return [ 'ovatheme' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_demo',
			[
				'label' => esc_html__( 'Demo', 'ova-brw' ),
			]
		);
			$default_product 	= '';
			$arr_product 		= array();

			$products = ovabrw_get_products_rental();
			if ( !empty( $products ) && is_array( $products ) ) {
				$default_product = $products[0];

				foreach( $products as $product_id ) {
					$arr_product[$product_id] = get_the_title( $product_id );
				}
			} else {
				$arr_product[''] = esc_html__( 'There are no rental products', 'ova-brw' );
			}

			$this->add_control(
				'product_id',
				[
					'label' 	=> esc_html__( 'Choose Product', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> $default_product,
					'options' 	=> $arr_product,
				]
			);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_unavailable_time_style',
			[
				'label' => esc_html__( 'Unavailable Time', 'ova-brw' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'wc_style_warning',
				[
					'type' 	=> Controls_Manager::RAW_HTML,
					'raw' 	=> esc_html__( 'The style of this widget is often affected by your theme and plugins. If you experience any such issue, try to switch to a basic theme and deactivate related plugins.', 'ova-brw' ),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);

			$this->add_responsive_control(
				'text_align',
				[
					'label' => esc_html__( 'Alignment', 'ova-brw' ),
					'type' 	=> Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'ova-brw' ),
							'icon' 	=> 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'ova-brw' ),
							'icon' 	=> 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'ova-brw' ),
							'icon' 	=> 'eicon-text-align-right',
						],
					],
					'selectors' => [
						'{{WRAPPER}}' => 'text-align: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'title_options',
				[
					'label' => esc_html__( 'Title Options', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

				$this->add_control(
					'title_color',
					[
						'label' => esc_html__( 'Color', 'ova-brw' ),
						'type' 	=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .elementor-unavailable-time .ovacrs_single_untime h3' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name' 	 	=> 'title_typography',
						'selector' 	=> '{{WRAPPER}} .elementor-unavailable-time .ovacrs_single_untime h3',
					]
				);

				$this->add_responsive_control(
					'title_margin',
					[
						'label' 	 => esc_html__( 'Margin', 'ova-brw' ),
						'type' 		 => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'selectors'  => [
							'{{WRAPPER}} .elementor-unavailable-time .ovacrs_single_untime h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

			$this->add_control(
				'time_options',
				[
					'label' 	=> esc_html__( 'Time Options', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

				$this->add_control(
					'time_color',
					[
						'label' => esc_html__( 'Color', 'ova-brw' ),
						'type' 	=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .elementor-unavailable-time .ovacrs_single_untime ul li' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name' 	 	=> 'time_typography',
						'selector' 	=> '{{WRAPPER}} .elementor-unavailable-time .ovacrs_single_untime ul li',
					]
				);

				$this->add_responsive_control(
					'time_margin',
					[
						'label' 	 => esc_html__( 'Margin', 'ova-brw' ),
						'type' 		 => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'selectors'  => [
							'{{WRAPPER}} .elementor-unavailable-time .ovacrs_single_untime ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

		$this->end_controls_section();
	}

	protected function render() {

		$settings 	= $this->get_settings();

		// Get Product
		$product  = wc_get_product();
		if ( empty( $product ) ) {
			$product_id = $settings['product_id'];
			$product 	= wc_get_product( $product_id );
		}

    	if ( !$product || !$product->is_type('ovabrw_car_rental') ) {
			?>
			<div class="ovabrw_elementor_no_product">
				<span><?php echo $this->get_title(); ?></span>
			</div>
			<?php
			return;
		}

		$product_id = $product->get_id();
		?>
		<div class="elementor-unavailable-time">
			<?php ovabrw_get_template( 'single/unavailable_time.php', array( 'id' => $product_id ) ); ?>
		</div>
		<?php
	}
}