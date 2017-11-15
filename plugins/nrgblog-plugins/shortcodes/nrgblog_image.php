<?php
/**
 *
 * Image shortcode.
 * @since 1.0.0
 *
 */
function nrgblog_image( $atts, $content = '', $id = '' ) {

    extract( shortcode_atts( array(
        'image' => ''
    ), $atts ) );

    if( is_numeric( $image ) && ! empty( $image ) ) {
        $img_url = wp_get_attachment_url( $image );
    	return '<img src=' . $img_url . ' class="simple-article" alt="">';
    }
}

add_shortcode( 'nrgblog_image', 'nrgblog_image' );
