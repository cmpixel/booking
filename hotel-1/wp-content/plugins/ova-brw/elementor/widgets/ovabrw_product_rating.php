<?php
namespace ovabrw_product_elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ovabrw_product_rating extends Widget_Base {

	public function get_name() {		
		return 'ovabrw_product_rating';
	}

	public function get_title() {
		return esc_html__( 'Product Rating', 'ova-brw' );
	}

	public function get_icon() {
		return 'eicon-product-rating';
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
	}

	protected function render() {
		$settings = $this->get_settings();

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

		<div class="elementor-rating">
			<?php ovabrw_get_template( 'single/rating.php', array( 'id' => $product_id ) ); ?>
		</div>

		<?php
	}
}