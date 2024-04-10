<?php
namespace ovabrw_product_elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ovabrw_product_booking_form extends Widget_Base {

	public function get_name() {		
		return 'ovabrw_product_booking_form';
	}

	public function get_title() {
		return esc_html__( 'Product Booking Form', 'ova-brw' );
	}

	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	public function get_categories() {
		return [ 'ovatheme' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_booking_settings',
			[
				'label' => esc_html__( 'Settings', 'ova-brw' ),
			]
		);

			$this->add_control(
				'show_booking',
				[
					'label' => esc_html__('Show Booking', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'tab',
					'options' => [
						'tab'             => esc_html__('Tabs', 'ova-brw' ),
						'booking'         => esc_html__('Booking Form', 'ova-brw' ),
						'request_booking' => esc_html__('Request Booking', 'ova-brw' ),
					],
				]
			);

			$this->add_control(
				'label_booking',
				[
					'label' => esc_html__('Booking Label', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__('Booking Form', 'ova-brw' ),
					'label_block' => true
				]
			);

			$this->add_control(
				'label_request_booking',
				[
					'label' => esc_html__('Request Booking Label', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__('Inquiry', 'ova-brw' ),
					'label_block' => true
				]
			);


		$this->end_controls_section();

		
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
			'section_booking_form_style',
			[
				'label' => esc_html__( 'Booking Form', 'ova-brw' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

	        $this->add_control(
				'booking_bgcolor',
				[
					'label'  => esc_html__( 'Background Color', 'ova-brw' ),
					'type' 	 => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ovabrw-forms-booking-tab .ovabrw_request_booking, {{WRAPPER}} .ovabrw-forms-booking-tab .ovabrw_booking_form' => 'background-color: {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings();

		$show_booking  = $settings['show_booking'];
		$label_booking = $settings['label_booking'];

		$label_request_booking = $settings['label_request_booking'];

		// Get Product
		global $product;
		
		if ( empty( $product ) ) {
			$product_id = $settings['product_id'];
			$product 	= wc_get_product( $product_id );
		}

    	if ( ! $product || !$product->is_type('ovabrw_car_rental') ) {
			?>
			<div class="ovabrw_elementor_no_product">
				<span><?php echo $this->get_title(); ?></span>
			</div>
			<?php
			return;
		}

		$product_id = $product->get_id();

		?>

			<?php if( $show_booking === "tab" ) : ?>

				<div class="ovabrw-forms-booking-tab">
					<ul class="tabs">
						<li class="item booking active" data-form="ovabrw_booking_form"><?php echo esc_html( $label_booking ); ?></li>
						<li class="item request-booking" data-form="ovabrw_request_booking"><?php echo esc_html( $label_request_booking ); ?></li>
					</ul>
					
					<?php ovabrw_get_template( 'single/booking-form.php', array( 'id' => $product_id ) ); ?>
					<?php ovabrw_get_template( 'single/request_booking.php', array( 'id' => $product_id ) ); ?>
				</div>

	        <?php elseif( $show_booking === "booking" ): ?>

	        	<div class="ovabrw-forms-booking-tab ovabrw-not-tabs">
					<ul class="tabs">
						<li class="item booking" data-form="ovabrw_booking_form"><?php echo esc_html( $label_booking ); ?></li>
					</ul>
					<?php ovabrw_get_template( 'single/booking-form.php', array( 'id' => $product_id ) ); ?>
				</div>

			<?php else: ?>

				<div class="ovabrw-forms-booking-tab ovabrw-not-tabs">
					<ul class="tabs">
						<li class="item request-booking" data-form="ovabrw_request_booking"><?php echo esc_html( $label_request_booking ); ?></li>
					</ul>
					<?php ovabrw_get_template( 'single/request_booking.php', array( 'id' => $product_id ) ); ?>
				</div>

			<?php endif;?>

		<?php
	}
}