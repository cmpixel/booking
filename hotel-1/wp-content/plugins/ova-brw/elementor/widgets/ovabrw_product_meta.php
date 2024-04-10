<?php
namespace ovabrw_product_elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ovabrw_product_meta extends Widget_Base {
	public function get_name() {		
		return 'ovabrw_product_meta';
	}

	public function get_title() {
		return esc_html__( 'Product Meta', 'ova-brw' );
	}

	public function get_icon() {
		return 'eicon-product-meta';
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

			$this->add_control(
				'area_icon',
				[
					'label' => esc_html__( 'Area Icon', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'ovaicon ovaicon-price-tag',
						'library' => 'all',
					],
				]
			);

			$this->add_control(
				'area_label',
				[
					'label' 	=> esc_html__( 'Area Label', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Size:', 'ova-brw' ),
				]
			);

			$this->add_control(
				'beds_icon',
				[
					'label' => esc_html__( 'Beds Icon', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'ovaicon ovaicon-price-tag',
						'library' => 'all',
					],
				]
			);

			$this->add_control(
				'beds_label',
				[
					'label' 	=> esc_html__( 'Beds Label', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Beds:', 'ova-brw' ),
				]
			);

			$this->add_control(
				'bath_icon',
				[
					'label' => esc_html__( 'Bath Icon', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'ovaicon ovaicon-price-tag',
						'library' => 'all',
					],
				]
			);

			$this->add_control(
				'bath_label',
				[
					'label' 	=> esc_html__( 'Bath Label', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Bathrooms:', 'ova-brw' ),
				]
			);

			$this->add_control(
				'adults_label',
				[
					'label' 	=> esc_html__( 'Adults Label', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Adults:', 'ova-brw' ),
				]
			);

			$this->add_control(
				'adults_icon',
				[
					'label' => esc_html__( 'Adults Icon', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'ovaicon ovaicon-price-tag',
						'library' => 'all',
					],
				]
			);

			$this->add_control(
				'children_label',
				[
					'label' 	=> esc_html__( 'Children Label', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Children:', 'ova-brw' ),
				]
			);

			$this->add_control(
				'children_icon',
				[
					'label' => esc_html__( 'Children Icon', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'ovaicon ovaicon-price-tag',
						'library' => 'all',
					],
				]
			);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_price_style',
			[
				'label' => esc_html__( 'Product Meta', 'ova-brw' ),
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

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 	 	=> 'typography',
					'selector' 	=> '{{WRAPPER}} .ovabrw-product-meta',
				]
			);

			$this->add_control(
				'product_meta_color',
				[
					'label'  => esc_html__( 'Color', 'ova-brw' ),
					'type' 	 => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ovabrw-product-meta' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'icon_meta_color',
				[
					'label' 	=> esc_html__( 'Icon Color', 'ova-brw' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ovabrw-product-meta i' => 'color: {{VALUE}}',
						'{{WRAPPER}} .ovabrw-product-meta svg' => 'fill: {{VALUE}}',
						'{{WRAPPER}} .ovabrw-product-meta svg path' => 'fill: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();
	}

	protected function render() {

		$settings 	= $this->get_settings();

		$area_icon  = $settings['area_icon'];
		$area_label = $settings['area_label'];

		$beds_icon  = $settings['beds_icon'];
		$beds_label = $settings['beds_label'];

		$bath_icon  = $settings['bath_icon'];
		$bath_label = $settings['bath_label'];

		$adults_icon  = $settings['adults_icon'];
		$adults_label = $settings['adults_label'];

		$adults_icon  = $settings['adults_icon'];
		$adults_label = $settings['adults_label'];

		$children_icon  = $settings['children_icon'];
		$children_label = $settings['children_label'];


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

			<div class="elementor-product-meta">
				<?php ovabrw_get_template( 'single/meta.php', 
						array( 'id' => $product_id ,
							'area_icon' => $area_icon,
							'area_label' => $area_label,
							'beds_icon' => $beds_icon,
							'beds_label' => $beds_label,
							'bath_icon' => $bath_icon,
							'bath_label' => $bath_label,
							'adults_icon' => $adults_icon,
							'adults_label' => $adults_label,
							'children_icon' => $children_icon,
							'children_label' => $children_label,
						) 
					); 
				?>
			</div>

		<?php
	}
}