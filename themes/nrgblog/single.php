<?php
/**
* Post main file.
*
* @package nrgblog
* @since 1.0
*
*/
$meta_data = get_post_meta( get_the_ID(), 'nrgblog_post_style', true );
$post_style = ( ! empty( $meta_data['post_style'] ) ) ? $meta_data['post_style'] : 'classic'; 
get_template_part( 'single-templates/post', $post_style ); ?>