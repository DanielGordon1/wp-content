<?php
/**
 *
 * Widgets shortcode.
 * @since 1.0.0
 *
 */
function nrgblog_widget( $atts, $content = '', $id = '' ) {

    extract( shortcode_atts( array(
        'sidebar' => 'sidebar'
    ), $atts ) );
    
    ob_start();

    dynamic_sidebar( $sidebar );

    return ob_get_clean();
}
add_shortcode( 'nrgblog_widget', 'nrgblog_widget' );