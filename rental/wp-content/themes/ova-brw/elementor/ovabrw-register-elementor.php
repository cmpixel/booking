<?php
namespace ovabrw_product_elementor;

use ovabrw_product_elementor\widgets\ovabrw_product_images;
use ovabrw_product_elementor\widgets\ovabrw_product_title;
use ovabrw_product_elementor\widgets\ovabrw_product_short_description;
use ovabrw_product_elementor\widgets\ovabrw_product_price;
use ovabrw_product_elementor\widgets\ovabrw_product_meta;
use ovabrw_product_elementor\widgets\ovabrw_product_features;
use ovabrw_product_elementor\widgets\ovabrw_product_table_price;
use ovabrw_product_elementor\widgets\ovabrw_product_calendar;
use ovabrw_product_elementor\widgets\ovabrw_product_booking_form;
use ovabrw_product_elementor\widgets\ovabrw_product_tabs;
use ovabrw_product_elementor\widgets\ovabrw_product_related;
use ovabrw_product_elementor\widgets\ovabrw_product_rating;
use ovabrw_product_elementor\widgets\ovabrw_search_map;
use ovabrw_product_elementor\widgets\ovabrw_unavailable_time;
use ovabrw_product_elementor\widgets\ovabrw_custom_taxonomy;
use ovabrw_product_elementor\widgets\ovabrw_product_category;
use ovabrw_product_elementor\widgets\ovabrw_product_ajax_filter;
use ovabrw_product_elementor\widgets\ovabrw_product_filter;
use ovabrw_product_elementor\widgets\ovabrw_product_map;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main Plugin Class
 *
 * Register new elementor widget.
 *
 * @since 1.0.0
 */
class Ovabrw_Register_Elementor {
	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		$this->add_actions();
	}

	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function add_actions() {
     	// Register Ovatheme Category in Pane
	    add_action( 'elementor/elements/categories_registered', array( $this, 'add_ovatheme_category' ) );
		add_action( 'elementor/widgets/register', [ $this, 'on_widgets_registered' ] );

		/* Add JS for Elementor */
		add_action( 'elementor/frontend/after_register_scripts', array( $this, 'enqueue_scripts_elementor' ) );
	}
	
	public function add_ovatheme_category(  ) {
	    \Elementor\Plugin::instance()->elements_manager->add_category(
	        'ovatheme',
	        [
	            'title' => esc_html__( 'Ovatheme', 'ova-brw' ),
	            'icon' 	=> 'fa fa-plug',
	        ]
	    );

	    \Elementor\Plugin::instance()->elements_manager->add_category(
	        'ovabrw-product',
	        [
	            'title' => esc_html__( 'BRW Product', 'ova-brw' ),
	            'icon' 	=> 'fa fa-plug',
	        ]
	    );
	}

	/**
	 * On Widgets Registered
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function on_widgets_registered() {
		$this->includes();
		$this->register_widget();
	}

	public function enqueue_scripts_elementor() {
		wp_enqueue_script( 'ova-script-elementor', OVABRW_PLUGIN_URI. 'assets/js/frontend/ova-script-elementor.js', [ 'jquery' ], false, true );
	}

	/**
	 * Includes
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function includes() {
		require OVABRW_PLUGIN_PATH . 'elementor/widgets/ovabrw_product_images.php';
		require OVABRW_PLUGIN_PATH . 'elementor/widgets/ovabrw_product_title.php';
		require OVABRW_PLUGIN_PATH . 'elementor/widgets/ovabrw_product_short_description.php';
		require OVABRW_PLUGIN_PATH . 'elementor/widgets/ovabrw_product_price.php';
		require OVABRW_PLUGIN_PATH . 'elementor/widgets/ovabrw_product_meta.php';
		require OVABRW_PLUGIN_PATH . 'elementor/widgets/ovabrw_product_features.php';
		require OVABRW_PLUGIN_PATH . 'elementor/widgets/ovabrw_product_table_price.php';
		require OVABRW_PLUGIN_PATH . 'elementor/widgets/ovabrw_product_calendar.php';
		require OVABRW_PLUGIN_PATH . 'elementor/widgets/ovabrw_product_booking_form.php';
		require OVABRW_PLUGIN_PATH . 'elementor/widgets/ovabrw_product_tabs.php';
		require OVABRW_PLUGIN_PATH . 'elementor/widgets/ovabrw_product_related.php';
		require OVABRW_PLUGIN_PATH . 'elementor/widgets/ovabrw_product_rating.php';
		require OVABRW_PLUGIN_PATH . 'elementor/widgets/ovabrw_search_map.php';
		require OVABRW_PLUGIN_PATH . 'elementor/widgets/ovabrw_unavailable_time.php';
		require OVABRW_PLUGIN_PATH . 'elementor/widgets/ovabrw_custom_taxonomy.php';
		require OVABRW_PLUGIN_PATH . 'elementor/widgets/ovabrw_product_category.php';
		require OVABRW_PLUGIN_PATH . 'elementor/widgets/ovabrw_product_ajax_filter.php';
		require OVABRW_PLUGIN_PATH . 'elementor/widgets/ovabrw_product_filter.php';
		require OVABRW_PLUGIN_PATH . 'elementor/widgets/ovabrw_product_map.php';
	}

	/**
	 * Register Widget
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function register_widget() {
		\Elementor\Plugin::instance()->widgets_manager->register( new ovabrw_product_images() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ovabrw_product_title() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ovabrw_product_short_description() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ovabrw_product_price() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ovabrw_product_meta() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ovabrw_product_features() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ovabrw_product_table_price() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ovabrw_product_calendar() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ovabrw_product_booking_form() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ovabrw_product_tabs() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ovabrw_product_related() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ovabrw_product_rating() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ovabrw_search_map() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ovabrw_unavailable_time() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ovabrw_custom_taxonomy() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ovabrw_product_category() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ovabrw_product_ajax_filter() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ovabrw_product_filter() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ovabrw_product_map() );
	}
}

new Ovabrw_Register_Elementor();