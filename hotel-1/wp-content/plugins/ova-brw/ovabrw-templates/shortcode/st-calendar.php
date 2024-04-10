<? 
/**
 * The template for displaying booking form content within single
 *
 * This template can be overridden by copying it to yourtheme/ovabrw-templates/shortcode/st-calendar.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit();

/**
$args['id']
$args['class']
**/
?>

<div class="<?php echo esc_attr( $args['class'] ); ?>">
	<?php ovabrw_get_template( 'single/calendar.php', array( 'id' => $args['id'] ) ); ?>	
</div>