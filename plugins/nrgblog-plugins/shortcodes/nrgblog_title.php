<?php
/**
 *
 * Widgets shortcode.
 * @since 1.0.0
 *
 */
function nrgblog_title( $atts, $content = '', $id = '' ) {

    extract( shortcode_atts( array(
        'text' => ''
    ), $atts ) );

    if( ! empty( $text ) ) {
    	$output  = '<div class="page-titles">';
        $output .= '<h1 class="title">';
        $output .= $text;
        $output .= '</h1>';
        $output .= '<div class="links">';
        $output .= '<a href="' . get_home_url() . '">Home</a>';
        $output .= '<span>-</span>';
        $output .= '<a href="#">' . $text . '</a>';
        $output .= '</div>';
    	$output .= '</div>';

    	return $output;
    }
}

add_shortcode( 'nrgblog_title', 'nrgblog_title' );
