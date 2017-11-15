<?php
/**
 *
 * ABOUT shortcode.
 * @since 1.0.0
 *
 */
function nrgblog_about( $atts, $content = '', $id = '' ) {

    extract( shortcode_atts( array(
        'image' 	=> '',
        'title' 	=> '',
        'text' 		=> '',
        'social_tw' => '',
        'social_fb' => '',
        'social_in' => '',
        'social_pi' => '',
        'social_gp' => '',
    ), $atts ) );

    $img_url = wp_get_attachment_url( $image );

    $output  = '<div class="simple-article">';
    $output .= '<div class="row">';
    $output .= '<div class="col-md-10 col-md-push-1">';
    $output .= '<img src="' . $img_url . '" alt="" class="contact">';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '<div class="row">';
    $output .= '<div class="col-md-6 col-md-push-3">';
    $output .= '<div class="sm-widjet">';
	if( ! empty( $title ) ) {
	    $output .= '<div class="title-w contact">';
	    $output .= $title;
	    $output .= '</div>';
	}
	if( ! empty( $text ) ) {
	    $output .= '<p class="text-center">';
	    $output .= $text;
	    $output .= '</p>';
	}
    $output .= '<div class="about-me text-center">';
    $output .= '<div class="soc-block">';
    if( ! empty( $social_tw ) ) {
	    $output .= '<a href="' . $social_tw . '">';
	    $output .= '<i class="fa fa-twitter"></i>';
	    $output .= '</a>';
	}
	if( ! empty( $social_fb ) ) {
	    $output .= '<a href="' . $social_fb . '">';
	    $output .= '<i class="fa fa-facebook"></i>';
	    $output .= '</a>';
	}
	if( ! empty( $social_in ) ) {
	    $output .= '<a href="' . $social_in . '">';
	    $output .= '<i class="fa fa-instagram"></i>';
	    $output .= '</a>';
	}
	if( ! empty( $social_pi ) ) {
	    $output .= '<a href="' . $social_pi . '">';
	    $output .= '<i class="fa fa-pinterest-p"></i>';
	    $output .= '</a>';
	}
	if( ! empty( $social_gp ) ) {
	    $output .= '<a href="' . $social_gp . '">';
	    $output .= '<i class="fa fa-google-plus"></i>';
	    $output .= '</a>';
	}
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '<div class="clear"></div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';

    return $output;
}

add_shortcode( 'nrgblog_about', 'nrgblog_about' );
