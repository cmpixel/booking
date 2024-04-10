<?php
namespace ovabrw_product_elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ovabrw_product_short_description extends Widget_Base {

	public function get_name() {		
		return 'ovabrw_product_short_description';
	}

	public function get_title() {
		return esc_html__( 'Short Description', 'ova-brw' );
	}

	public function get_icon() {
		return 'eicon-product-description';
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
			'section_product_short_description_style',
			[
				'label' => esc_html__( 'Style', 'elementor' ),
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
				'align',
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
						'justify' => [
							'title' => esc_html__( 'Justified', 'ova-brw' ),
							'icon' 	=> 'eicon-text-align-justify',
						],
					],
					'default' => '',
					'selectors' => [
						'{{WRAPPER}}' => 'text-align: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'text_color',
				[
					'label'  	=> esc_html__( 'Color', 'ova-brw' ),
					'type' 	 	=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ovabrw-product-details__short-description p' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 	 	=> 'text_typography',
					'selector' 	=> '{{WRAPPER}} .ovabrw-product-details__short-description p',
				]
			);

			$this->add_responsive_control(
				'text_margin',
				[
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'label' 		=> esc_html__( 'Margin', 'ova-brw' ),
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		<div class="elementor-short-description">
			<?php ovabrw_get_template( 'single/short-description.php', array( 'id' => $product_id ) ); ?>
		</div>
		<?php
	}
}