<?php
/**
 *
 * Quote shortcode.
 * @since 1.0.0
 *
 */
function nrgblog_quote( $atts, $content = '', $id = '' ) {

    extract( shortcode_atts( array(
        'text' => ''
    ), $atts ) );

    if( ! empty( $text ) ) {
    	$output  = '<div class="quote simple-article">';
    	$output .= $text;
    	$output .= '</div>';
    	return $output;
    }
}

add_shortcode( 'nrgblog_quote', 'nrgblog_quote' );
