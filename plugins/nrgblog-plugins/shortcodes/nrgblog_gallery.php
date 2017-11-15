<?php
/**
 *
 * Gallery shortcode.
 * @since 1.0.0
 *
 */
function nrgblog_gallery( $atts, $content = '', $id = '' ) {

    global $nrgblog;

    extract( shortcode_atts( array(
        'image' => ''
    ), $atts ) );

    if( ! empty( $image ) ) {
    	$ids = explode( ',', $image);
    	$output = '<div class="about-galerry">';
    	foreach ($ids as $id) {
        	$img_url = wp_get_attachment_url( $id );
    		$output .= '<img src=' . $img_url . ' alt="">';
    	}
    	$output .= '</div>';
    	return $output;
    }
}

add_shortcode( 'nrgblog_gallery', 'nrgblog_gallery' );
