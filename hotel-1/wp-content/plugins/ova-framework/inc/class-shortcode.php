<?php if (!defined( 'ABSPATH' )) exit;

if( !class_exists('Qomfort_Shortcode') ){
    
    class Qomfort_Shortcode {

        public function __construct() {

            add_shortcode( 'qomfort-elementor-template', array( $this, 'qomfort_elementor_template' ) );
            
        }

        public function qomfort_elementor_template( $atts ){

            $atts = extract( shortcode_atts(
            array(
                'id'  => '',
            ), $atts) );

            $args = array(
                'id' => $id
                
            );

            if( did_action( 'elementor/loaded' ) ){
                return Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $id );    
            }
            return;

            
        }

        

    }
}



return new Qomfort_Shortcode();

