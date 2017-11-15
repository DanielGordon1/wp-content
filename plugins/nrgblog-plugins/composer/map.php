<?php
/**
  * WPBakery Visual Composer Shortcodes settings
  *
  * @package VPBakeryVisualComposer
  *
 */

include_once( EF_ROOT . '/composer/params.php' );

function vc_remove_elements( $e = array() ) {
    if ( ! empty( $e ) ) {
        foreach ( $e as $key => $r_this ) {
            vc_remove_element( 'vc_' . $r_this );
        }
    }
}

add_action( 'admin_init', 'vc_remove_elements', 10);

$s_elements = array( 'tta_pageable', 'btn', 'line_chart', 'round_chart', 'tta_accordion', 'tta_tour', 'tta_tabs', 'cta', 'tabs', 'tab', 'accordion', 'accordion_tab', 'custom_heading', 'clients', 'column_text', 'widget_sidebar', 'toggle', 'images_carousel', 'carousel', 'tour', 'gallery', 'posts_slider', 'posts_grid', 'teaser_grid', 'separator', 'text_separator', 'message', 'facebook', 'tweetmeme', 'googleplus', 'pinterest', 'single_image', 'button', 'toogle', 'button2', 'cta_button', 'cta_button2', 'video', 'gmaps', 'flickr', 'progress_bar', 'raw_html', 'raw_js', 'pie', 'wp_search', 'wp_meta', 'wp_recentcomments', 'wp_calendar', 'wp_pages', 'wp_custommenu', 'wp_posts', 'wp_links', 'wp_categories', 'wp_archives', 'wp_rss', 'basic_grid', 'media_grid', 'masonry_grid', 'masonry_media_grid', 'icon', 'wp_tagcloud' );
vc_remove_element( 'client', 'testimonial' );
vc_remove_elements( $s_elements );

// ==========================================================================================
// ANIMATED POST LIST                                                                       -
// ==========================================================================================
vc_map( array(
    'name'            => __( 'Animated posts', 'js_composer' ),
    'base'            => 'nrgblog_animated_post',
    'description'     => __( 'Posts slider', 'js_composer' ),
    'params'          => array(
      array(
        'type'        => 'dropdown',
        'heading'     => __( 'Style', 'js_composer' ),
        'param_name'  => 'style',
        'value'       => array(
          'Carrousel'      => 'carrousel',
          'Modern slider'  => 'modern_slider',
          'Designed'       => 'designed',
          'Slider'         => 'slider',
          'Slider squared' => 'slider_squared'
        )
      ),
      array(
        'type'        => 'attach_image',
        'heading'     => __( 'Bachground image', 'js_composer' ),
        'param_name'  => 'image',
        'dependency'  => array( 'element' => 'style', 'value' => array('modern_slider', 'designed') )
      ),
      array(
        'type'        => 'vc_efa_chosen',
        'heading'     => __( 'Custom Categories', 'js_composer' ),
        'param_name'  => 'cats',
        'placeholder' => 'Choose category (optional)',
        'value'       => nrgblog_element_values(),
        'std'         => '',
        'description' => __( 'You can choose spesific categories for blog, default is all categories', 'js_composer' )
      ),
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Count posts', 'js_composer' ),
        'param_name'  => 'limit',
        'value'       => '',
        'description' => __( 'Default 6 items.', 'js_composer' )
      ),
    )
  )
);

// ==========================================================================================
// STATIC POST LIST                                                                       -
// ==========================================================================================
vc_map( array(
    'name'            => __( 'Static posts', 'js_composer' ),
    'base'            => 'nrgblog_static_post',
    'description'     => __( 'Simple post list', 'js_composer' ),
    'params'          => array(
      array(
        'type'        => 'dropdown',
        'heading'     => __( 'Style', 'js_composer' ),
        'param_name'  => 'style',
        'value'       => array(
          'Classic'    => 'classic',
          'High'       => 'high',
          'Columns'    => 'columns',
          'Square'     => 'square',
          'Modern'     => 'modern'
        )
      ),
      array(
        'type'        => 'vc_efa_chosen',
        'heading'     => __( 'Custom Categories', 'js_composer' ),
        'param_name'  => 'cats',
        'placeholder' => 'Choose category (optional)',
        'value'       => nrgblog_element_values(),
        'std'         => '',
        'description' => __( 'You can choose spesific categories for blog, default is all categories', 'js_composer' ),
      ),
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Count posts', 'js_composer' ),
        'param_name'  => 'limit',
        'value'       => '',
        'description' => __( 'Default 6 items.', 'js_composer' )
      ),
      array(
        'type'        => 'dropdown',
        'heading'     => __( 'Pager', 'js_composer' ),
        'param_name'  => 'pager',
        'value'       => array(
          'Disable' => 'disable',
          'Enable'  => 'enable',
        )
      )
    )
  )
);

// ==========================================================================================
// WIDGETS                                                                                  -
// ==========================================================================================
vc_map( array(
    'name'            => __( 'Sidebar', 'js_composer' ),
    'base'            => 'nrgblog_widget',
    'description'     => __( 'Widgets shortcode', 'js_composer' ),
    'params'          => array(
      array(
        'type'        => 'dropdown',
        'heading'     => __( 'Select sidebar', 'js_composer' ),
        'param_name'  => 'sidebar',
        'value'       => array(
          'Sidebar'               => 'sidebar',
          'First footer sidebar'  => 'first-footer-sidebar',
          'Second footer sidebar' => 'second-footer-sidebar',
          'Third footer sidebar'  => 'third-footer-sidebar',
          'Fourth footer sidebar' => 'fourth-footer-sidebar'
        )
      )
    )
  )
);

// ==========================================================================================
// QUOTE                                                                                    -
// ==========================================================================================
vc_map( array(
    'name'            => __( 'Quote', 'js_composer' ),
    'base'            => 'nrgblog_quote',
    'description'     => __( 'Quote shortcode', 'js_composer' ),
    'params'          => array(
      array(
        'type'        => 'textarea',
        'heading'     => __( 'Quote text', 'js_composer' ),
        'param_name'  => 'text',
      ),
    )
  )
);

// ==========================================================================================
// TITLE                                                                                    -
// ==========================================================================================
vc_map( array(
    'name'            => __( 'Title', 'js_composer' ),
    'base'            => 'nrgblog_title',
    'description'     => __( 'Title and breadcrumb', 'js_composer' ),
    'params'          => array(
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Title text', 'js_composer' ),
        'param_name'  => 'text',
      ),
    )
  )
);

// ==========================================================================================
// SIMPLE IMAGE                                                                             -
// ==========================================================================================
vc_map( array(
    'name'            => __( 'Image', 'js_composer' ),
    'base'            => 'nrgblog_image',
    'params'          => array(
      array(
        'type'        => 'attach_image',
        'heading'     => __( 'Image', 'js_composer' ),
        'param_name'  => 'image',
      ),
    )
  )
);

// ==========================================================================================
// SIMPLE GALLERY                                                                           -
// ==========================================================================================
vc_map( array(
    'name'            => __( 'Simple Gallery', 'js_composer' ),
    'base'            => 'nrgblog_gallery',
    'params'          => array(
      array(
        'type'        => 'attach_images',
        'heading'     => __( 'Image', 'js_composer' ),
        'param_name'  => 'image',
      ),
    )
  )
);

// ==========================================================================================
// ABOUT ME                                                                                 -
// ==========================================================================================
vc_map( array(
    'name'            => __( 'About Me', 'js_composer' ),
    'base'            => 'nrgblog_about',
    'params'          => array(
      array(
        'type'        => 'attach_image',
        'heading'     => __( 'Image', 'js_composer' ),
        'param_name'  => 'image',
      ),
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Title', 'js_composer' ),
        'param_name'  => 'title',
      ),
      array(
        'type'        => 'textarea',
        'heading'     => __( 'Text', 'js_composer' ),
        'param_name'  => 'text',
      ),
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Twitter', 'js_composer' ),
        'param_name'  => 'social_tw',
        'value'       => '#',
        'description' => __( 'Enter Twitter social link url.', 'js_composer' ),
        'group'       => 'Social URL'
      ),
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Facebook', 'js_composer' ),
        'param_name'  => 'social_fb',
        'value'       => '#',
        'description' => __( 'Enter facebook social link url.', 'js_composer' ),
        'group'       => 'Social URL'
      ),
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Instagram', 'js_composer' ),
        'param_name'  => 'social_in',
        'value'       => '#',
        'description' => __( 'Enter Instagram social link url.', 'js_composer' ),
        'group'       => 'Social URL'
      ),
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Pinterest', 'js_composer' ),
        'param_name'  => 'social_pi',
        'value'       => '#',
        'description' => __( 'Enter Pinterest social link url.', 'js_composer' ),
        'group'       => 'Social URL'
      ),
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Google plus', 'js_composer' ),
        'param_name'  => 'social_gp',
        'value'       => '#',
        'description' => __( 'Enter Google plus social link url.', 'js_composer' ),
        'group'       => 'Social URL'
      ),
    )
  )
);


// ==========================================================================================
// STATIC POST LIST                                                                       -
// ==========================================================================================

vc_map( array(
    'name'            => __( 'Posts list', 'js_composer' ),
    'base'            => 'nrgblog_static_post_lists',
    'description'     => __( 'Also static post list', 'js_composer' ),
    'params'          => array(
      array(
        'type'        => 'dropdown',
        'heading'     => __( 'Style', 'js_composer' ),
        'param_name'  => 'style',
        'value'       => array(
          'Style 1'    => 'style1',
          'Style 2'    => 'style2',
          'Style 3'    => 'style3',
          'Style 4'    => 'style4',
        )
      ),
      array(
        'type'        => 'vc_efa_chosen',
        'heading'     => __( 'Custom Categories', 'js_composer' ),
        'param_name'  => 'cats',
        'placeholder' => 'Choose category (optional)',
        'value'       => nrgblog_element_values(),
        'std'         => '',
        'description' => __( 'You can choose spesific categories for blog, default is all categories', 'js_composer' ),
      ),
      array(
        'type'        => 'textfield',
        'heading'     => __( 'Count posts', 'js_composer' ),
        'param_name'  => 'limit',
        'value'       => '',
        'description' => __( 'Default 6 items.', 'js_composer' )
      ),
      array(
        'type'        => 'dropdown',
        'heading'     => __( 'Pager', 'js_composer' ),
        'param_name'  => 'pager',
        'value'       => array(
          'Disable' => 'disable',
          'Enable'  => 'enable',
        )
      )
    )
  )
);