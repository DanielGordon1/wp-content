<?php
/**
 * Classic Blog Template
 *
 * @package nrgblog
 * @since 1.0
 *
 */
$meta_data = get_post_meta( get_the_ID(), 'nrgblog_post_options', true );
$post_style = ( ! empty( $meta_data['post_preview_style'] ) ) ? $meta_data['post_preview_style'] : 'image'; 
get_template_part( 'post-templates/modern-templates/modern', $post_style ); ?>
