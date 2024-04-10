<?php
namespace ovabrw_product_elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ovabrw_product_related extends Widget_Base {

	public function get_name() {		
		return 'ovabrw_product_related';
	}

	public function get_title() {
		return esc_html__( 'Product Related', 'ova-brw' );
	}

	public function get_icon() {
		return 'eicon-product-related';
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
			'section_product_related_style',
			[
				'label' => esc_html__( 'Content', 'ova-brw' ),
			]
		);

			$this->add_control(
				'posts_per_page',
				[
					'label' 	=> esc_html__( 'Products Per Page', 'ova-brw' ),
					'type' 		=> Controls_Manager::NUMBER,
					'default' 	=> 3,
				]
			);

			$this->add_control(
				'orderby',
				[
					'label' => esc_html__( 'Order By', 'ova-brw' ),
					'type' 	=> Controls_Manager::SELECT,
					'default' => 'date',
					'options' => [
						'date' 			=> esc_html__( 'Date', 'ova-brw' ),
						'title' 		=> esc_html__( 'Title', 'ova-brw' ),
						'price' 		=> esc_html__( 'Price', 'ova-brw' ),
						'popularity' 	=> esc_html__( 'Popularity', 'ova-brw' ),
						'rating' 		=> esc_html__( 'Rating', 'ova-brw' ),
						'rand' 			=> esc_html__( 'Random', 'ova-brw' ),
						'menu_order' 	=> esc_html__( 'Menu Order', 'ova-brw' ),
					],
				]
			);

			$this->add_control(
				'order',
				[
					'label' => esc_html__( 'Order', 'ova-brw' ),
					'type' 	=> Controls_Manager::SELECT,
					'default' => 'desc',
					'options' => [
						'asc' 	=> esc_html__( 'ASC', 'ova-brw' ),
						'desc' 	=> esc_html__( 'DESC', 'ova-brw' ),
					],
				]
			);

		$this->end_controls_section();

		/* Template Settings */
		$this->start_controls_section(
			'more_options',
			[
				'label' => esc_html__( 'Template Settings', 'ova-brw' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

			$this->add_control(
				'meta_fields',
				[
					'label' 	=> esc_html__( 'Meta Fields', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
				]
			);

			$meta_fields = array(
				'' 					=> esc_html__('Select Meta', 'ova-brw'),
				'adults' 			=> esc_html__('Adults', 'ova-brw'),
				'children' 			=> esc_html__('Children', 'ova-brw'),
				'acreage' 			=> esc_html__('Acreage ', 'ova-brw'),
				'beds' 				=> esc_html__('Beds', 'ova-brw'),
				'baths' 			=> esc_html__('Baths', 'ova-brw'),
			);

			$this->add_control(
				'field_1',
				[
					'label'   	=> esc_html__( 'Field 1', 'ova-brw' ),
					'type'    	=> Controls_Manager::SELECT,
					'default' 	=> 'adults',
					'options' 	=> $meta_fields,
				]
			);

			$this->add_control(
				'field_2',
				[
					'label'   	=> esc_html__( 'Field 2', 'ova-brw' ),
					'type'    	=> Controls_Manager::SELECT,
					'default' 	=> 'acreage',
					'separator' => 'before',
					'options' 	=> $meta_fields,
				]
			);

			$this->add_control(
				'field_3',
				[
					'label'   	=> esc_html__( 'Field 3', 'ova-brw' ),
					'type'    	=> Controls_Manager::SELECT,
					'default' 	=> '',
					'separator' => 'before',
					'options' 	=> $meta_fields,
				]
			);

			$this->add_control(
				'field_4',
				[
					'label'   	=> esc_html__( 'Field 4', 'ova-brw' ),
					'type'    	=> Controls_Manager::SELECT,
					'default' 	=> '',
					'separator' => 'before',
					'options' 	=> $meta_fields,
				]
			);

			$this->add_control(
				'field_5',
				[
					'label'   	=> esc_html__( 'Field 5', 'ova-brw' ),
					'type'    	=> Controls_Manager::SELECT,
					'default' 	=> '',
					'separator' => 'before',
					'options' 	=> $meta_fields,
				]
			);

			$this->add_control(
				'icon_adults',
				[
					'label' => esc_html__( 'Icon Adults', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'far fa-user',
						'library' => 'all',
					],
				]
			);

			$this->add_control(
				'icon_children',
				[
					'label' => esc_html__( 'Icon Children', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'far fa-user-circle',
						'library' => 'all',
					],
				]
			);

			$this->add_control(
				'icon_area',
				[
					'label' => esc_html__( 'Icon Area', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-drafting-compass',
						'library' => 'all',
					],
				]
			);

			$this->add_control(
				'icon_beds',
				[
					'label' => esc_html__( 'Icon Beds', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-bed',
						'library' => 'all',
					],
				]
			);

			$this->add_control(
				'icon_baths',
				[
					'label' => esc_html__( 'Icon Baths', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-bath',
						'library' => 'all',
					],
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

		setup_postdata( $product->get_id() );

		$args = [
			'posts_per_page' 	=> $settings['posts_per_page'],
			'orderby' 			=> $settings['orderby'],
			'order' 			=> $settings['order'],
		];

		if ( ! empty( $settings['posts_per_page'] ) ) {
			$args['posts_per_page'] = $settings['posts_per_page'];
		}

		// Get visible related products then sort them at random.
		$args['related_products'] = array_filter( array_map( 'wc_get_product', wc_get_related_products( $product->get_id(), $args['posts_per_page'], $product->get_upsell_ids() ) ), 'wc_products_array_filter_visible' );

		// Handle orderby.
		$related_products = wc_products_array_orderby( $args['related_products'], $args['orderby'], $args['order'] );

		?>

		<div class="ovabrw-product-ralated">
			<?php if( $related_products ) {
            	foreach ( $related_products as $related_product ) {
					$post_object = get_post( $related_product->get_id() );
					setup_postdata( $GLOBALS['post'] =& $post_object );
					ovabrw_get_template( 'elementor/ovabrw_room_ajax.php', $settings );
				}
				
				$post_object = get_post( $product->get_id() );
				setup_postdata( $GLOBALS['post'] =& $post_object );
	       	} else { 
	       		esc_html_e( 'Not Found', 'ova-brw' );
	       	} ?>
		</div>

		<?php
	}
}