<?php
namespace ovabrw_product_elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ovabrw_product_title extends Widget_Base {

	public function get_name() {		
		return 'ovabrw_product_title';
	}

	public function get_title() {
		return esc_html__( 'Product Title', 'ova-brw' );
	}

	public function get_icon() {
		return 'eicon-t-letter';
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
			'section_title',
			[
				'label' => esc_html__( 'Title', 'ova-brw' ),
			]
		);
		
			$this->add_control(
				'link',
				[
					'label' => esc_html__( 'Link', 'ova-brw' ),
					'type' 	=> Controls_Manager::URL,
					'dynamic' => [
						'active' => true,
					],
					'default' => [
						'url' => '',
					],
					'separator' => 'before',
				]
			);

			$this->add_control(
				'header_size',
				[
					'label' => esc_html__( 'HTML Tag', 'ova-brw' ),
					'type' 	=> Controls_Manager::SELECT,
					'options' => [
						'h1' 	=> 'H1',
						'h2' 	=> 'H2',
						'h3' 	=> 'H3',
						'h4' 	=> 'H4',
						'h5' 	=> 'H5',
						'h6' 	=> 'H6',
						'div' 	=> 'div',
						'span' 	=> 'span',
						'p' 	=> 'p',
					],
					'default' => 'h2',
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
						'{{WRAPPER}} .ovabrw_product_title' => 'text-align: {{VALUE}};',
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_title_style',
				[
					'label' => esc_html__( 'Title', 'ova-brw' ),
					'tab' 	=> Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 	 	=> 'typography',
					'selector' 	=> '{{WRAPPER}} .ovabrw_product_title .ovabrw_title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' => esc_html__( 'Color', 'ova-brw' ),
					'type' 	=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ovabrw_product_title .ovabrw_title' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' 		=> 'text_shadow',
					'selector' 	=> '{{WRAPPER}} .ovabrw_product_title .ovabrw_title',
				]
			);

			$this->add_control(
				'blend_mode',
				[
					'label' => esc_html__( 'Blend Mode', 'ova-brw' ),
					'type' 	=> Controls_Manager::SELECT,
					'options' => [
						'' => esc_html__( 'Normal', 'ova-brw' ),
						'multiply' 	  => 'Multiply',
						'screen' 	  => 'Screen',
						'overlay' 	  => 'Overlay',
						'darken' 	  => 'Darken',
						'lighten' 	  => 'Lighten',
						'color-dodge' => 'Color Dodge',
						'saturation'  => 'Saturation',
						'color' 	  => 'Color',
						'difference'  => 'Difference',
						'exclusion'   => 'Exclusion',
						'hue' 		  => 'Hue',
						'luminosity'  => 'Luminosity',
					],
					'selectors' => [
						'{{WRAPPER}} .ovabrw_product_title .ovabrw_title' => 'mix-blend-mode: {{VALUE}}',
					],
					'separator' => 'none',
				]
			);

			$this->add_responsive_control(
				'title_margin',
				[
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'label' 		=> esc_html__( 'Margin', 'ova-brw' ),
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ovabrw_product_title .ovabrw_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
	}

	protected function render() {
		$settings 	= $this->get_settings();

		// Get link
		$link 	  	= $settings['link']['url'];
		$blank 		= '_blank';
		$target_url = $settings['link']['is_external'];
		if ( empty( $target_url ) ) {
			$blank = '';
		}

		// Get header_size
		$header_size = $settings['header_size'];

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

		$title = $product->get_title();

		if ( $title === '' ) {
			?>
			<div class="ovabrw_elementor_no_product">
				<span><?php echo $this->get_title(); ?></span>
			</div>
			<?php
			return;
		}
		?>
		<div class="ovabrw_product_title">
			<?php if ( !empty( $link ) ): ?>
				<a href="<?php echo $link; ?>" target="<?php echo $blank; ?>">
					<<?php echo $header_size; ?> class="ovabrw_title"><?php echo esc_html( $title ); ?></<?php echo $header_size; ?>>
				</a>
			<?php else: ?>
				<<?php echo $header_size; ?> class="ovabrw_title"><?php echo esc_html( $title ); ?></<?php echo $header_size; ?>>
			<?php endif; ?>

		</div>
		<?php
	}
}