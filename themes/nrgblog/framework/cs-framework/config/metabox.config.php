<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// METABOX OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options      = array();
// -----------------------------------------
// POST PREVIEW OPTIONS                    -
// -----------------------------------------
$options[]    = array(
    'id'        => 'nrgblog_post_options',
    'title'     => 'Post preview settings',
    'post_type' => 'post',
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(
        array(
            'name'   => 'section_3',
            'fields' => array(
                array(
                    'id'    => 'post_views_likes',
                    'type'  => 'text',
                    'title' => 'Post likes'
                ),
                array(
                    'id'          => 'post_gallery_to_slider',
                    'type'        => 'select',
                    'title'       => 'Transform defualt gallery',
                    'options'     => array(
                        'none'     => '- Select -',
                        'slider'   => 'Slider',
                        'popup'    => 'Gallery with popup'
                    )
                ),
                array(
                    'type'       => 'notice',
                    'class'      => 'info',
                    'content'    => 'Info: Post preview style available only in Modern shortcode style.'
                ),
                array(
                    'id'          => 'post_preview_style',
                    'type'        => 'select',
                    'title'       => 'Preview style',
                    'options'     => array(
                        'image'    => 'Post image',
                        'slider'   => 'Image slider',
                        'video'    => 'Video'
                    ),
                    'default'     => array( 'image' )
                ),
                /* Video */
                array(
                    'id'          => 'post_vimeo',
                    'type'        => 'text',
                    'title'       => 'Vimeo video',
                    'desc'        => 'Paste full video URL, like https://vimeo.com/140260220',
                    'dependency'  => array( 'post_preview_style', '==', 'video' )
                ),
                array(
                    'id'          => 'post_preview_video_size',
                    'type'        => 'select',
                    'title'       => 'Video preview size',
                    'options'     => array(
                        'medium'   => 'Medium',
                        'small'    => 'Small'
                    ),
                    'default'     => array( 'small' ),
                    'dependency'  => array( 'post_preview_style', '==', 'video' )
                ),
                /* Slider */
                array(
                    'id'          => 'post_slider',
                    'type'        => 'gallery',
                    'title'       => 'Gallery with Custom Title',
                    'add_title'   => 'Add Images',
                    'edit_title'  => 'Edit Images',
                    'clear_title' => 'Remove Images',
                    'dependency'  => array( 'post_preview_style', '==', 'slider' )
                ),
                array(
                    'id'          => 'post_preview_slider_size',
                    'type'        => 'select',
                    'title'       => 'Slider preview size',
                    'options'     => array(
                        'medium'   => 'Medium',
                        'big'      => 'Big'
                    ),
                    'default'     => array( 'medium' ),
                    'dependency'  => array( 'post_preview_style', '==', 'slider' )
                ),
                /* Image  */
                array(
                    'id'          => 'post_preview_image_size',
                    'type'        => 'select',
                    'title'       => 'Image preview size',
                    'options'     => array(
                        'small'    => 'Small - text on the image',
                        'smallu'   => 'Small - text under the image',
                        'medium'   => 'Medium',
                        'big'      => 'Big - text on the image',
                        'bigc'     => 'Big - text on the image(center)',
                        'bigu'     => 'Big - text under the image'
                    ),
                    'default'     => array( 'small' ),
                    'std'         => array( 'small' ),
                    'dependency'  => array( 'post_preview_style', '==', 'image' )
                ),
            )
        )
    )
);

// -----------------------------------------
// POST STYLE                              -
// -----------------------------------------
$options[]    = array(
    'id'        => 'nrgblog_post_style',
    'title'     => 'Post preview settings',
    'post_type' => 'post',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(
        array(
            'name'   => 'section',
            'fields' => array(
                array(
                    'id'          => 'post_style',
                    'type'        => 'select',
                    'title'       => 'Post style',
                    'options'     => array(
                        'classic'  => 'Classic',
                        'modern'   => 'Modern'
                    ),
                    'default'     => array( 'image' )
                ),
                array(
                    'id'          => 'post_sidebar',
                    'type'        => 'switcher',
                    'title'       => 'Post sidebar',
                    'default'     => true,
                    'dependency'  => array( 'post_style', '==', 'classic' )
                ),
                array(
                    'id'          => 'post_popular',
                    'type'        => 'switcher',
                    'title'       => 'Show popular posts',
                    'default'     => false,
                    'dependency'  => array( 'post_style', '==', 'modern' )
                ),
                array(
                    'id'          => 'post_recommend',
                    'type'        => 'switcher',
                    'title'       => 'Show recommend posts',
                    'default'     => false,
                    'dependency'  => array( 'post_style', '==', 'modern' )
                ),
                array(
                    'id'          => 'post_recommend_list',
                    'type'        => 'select',
                    'title'       => 'Custom page list',
                    'options'     => nrgblog_get_all_posts(),
                    'attributes'  => array(
                        'multiple' => 'only-key',
                        'style'    => 'width: 100%; height: 125px;'
                    ),
                    'dependency'  => array( 'post_style|post_recommend', '==|==', 'modern|true' )
                ),
                array(
                    'id'          => 'post_next_prev',
                    'type'        => 'switcher',
                    'title'       => 'Show next/prev posts',
                    'default'     => false,
                    'dependency'  => array( 'post_style', '==', 'modern' )
                ),
                array(
                    'id'          => 'post_related',
                    'type'        => 'switcher',
                    'title'       => 'Show related posts',
                    'default'     => false,
                    'dependency'  => array( 'post_style', '==', 'modern' )
                ),
            )
        )
    )
);


// -----------------------------------------
// PAGE STYLE                              -
// -----------------------------------------
$options[]    = array(
    'id'        => 'nrgblog_page',
    'title'     => 'Post preview settings',
    'post_type' => 'page',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(
        array(
            'name'   => 'section',
            'fields' => array(
                array(
                    'id'          => 'page_header',
                    'type'        => 'select',
                    'title'       => 'Page header',
                    'options'     => array(
                        'default'  => 'Default',
                        'classic'  => 'Classic',
                        'modern'   => 'Modern'
                    )
                ),
                array(
                    'id'          => 'page_footer',
                    'type'        => 'select',
                    'title'       => 'Page footer',
                    'options'     => array(
                        'default'  => 'Default',
                        'classic'  => 'Classic',
                        'modern'   => 'Modern'
                    )
                )
            )
        )
    )
);

CSFramework_Metabox::instance( $options );
