<?php if (!defined( 'ABSPATH' )) exit;

if( !class_exists('Qomfort_Widgets') ){
	
	class Qomfort_Widgets {

		function __construct(){

			/**
			 * Regsiter Widget
			 */
			add_action( 'widgets_init', array( $this, 'qomfort_register_widgets' ) );

		}
		

		function qomfort_register_widgets() {
		  
		  $args_blog = array(
		    'name' => esc_html__( 'Main Sidebar', 'qomfort'),
		    'id' => "main-sidebar",
		    'description' => esc_html__( 'Main Sidebar', 'qomfort' ),
		    'class' => '',
		    'before_widget' => '<div id="%1$s" class="widget %2$s">',
		    'after_widget' => "</div>",
		    'before_title' => '<h3 class="widget-title">',
		    'after_title' => "</h3>",
		  );
		  register_sidebar( $args_blog );

		  if( qomfort_is_woo_active() ){
		    $args_woo = array(
		      'name' => esc_html__( 'WooCommerce Sidebar', 'qomfort'),
		      'id' => "woo-sidebar",
		      'description' => esc_html__( 'WooCommerce Sidebar', 'qomfort' ),
		      'class' => '',
		      'before_widget' => '<div id="%1$s" class="widget woo_widget %2$s">',
		      'after_widget' => "</div>",
		      'before_title' => '<h3 class="widget-title">',
		      'after_title' => "</h3>",
		    );
		    register_sidebar( $args_woo );
		  }

		 
		  

		}


	}
}

return new Qomfort_Widgets();