<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$settings      = array(
  'menu_title' => 'Theme Options',
  'menu_type'  => 'add_menu' . '_page',
  'menu_slug'  => 'cs-framework',
  'ajax_save'  => false,
);

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options        = array();

// ----------------------------------------
// general option section
// ----------------------------------------
$options[]      = array(
    'name'        => 'general',
    'title'       => 'General',
    'icon'        => 'fa fa-cog',
    'fields'      => array(
        array(
            'id'      => 'page_preloader',
            'type'    => 'switcher',
            'title'   => 'Page preloader',
            'default' => true
        ),
        array(
            'id'         => 'site_favicon',
            'type'       => 'upload',
            'title'      => 'Browser Favicon (16x16)*',
            'desc'       => 'Upload Favicon icon of size 16x16',
            'default'    => get_template_directory_uri() . '/assets/images/favicon.ico',
        )
    )
);

// ----------------------------------------
// Header option section
// ----------------------------------------
$options[]      = array(
    'name'        => 'header',
    'title'       => 'Header',
    'icon'        => 'fa fa-star',
    'fields'      => array(
        array(
            'id'            => 'header_style',
            'type'          => 'select',
            'title'         => 'Header style',
            'options'       => array(
                'classic'    => 'Classic',
                'modern'     => 'Modern'
            )
        ),
        array(
            'id'      => 'search_form',
            'type'    => 'switcher',
            'title'   => 'Search form',
            'default' => true
        ),
        array(
            'id'         => 'search_form_title',
            'type'       => 'text',
            'title'      => 'Search form',
            'value'      => 'Type the keyword',
            'dependency' => array( 'search_form', '==', true )
        ),
        array(
            'id'         => 'site_logo',
            'type'       => 'upload',
            'title'      => 'Site Logo',
            'default'    => get_template_directory_uri().'/assets/images/logo.png',
            'desc'       => 'Upload any media using the WordPress Native Uploader.',
        ),
        array(
            'id'         => 'img_logo_width',
            'type'       => 'text',
            'title'      => 'Site Logo Width Size*',
            'desc'       => 'By default the logo have 60px width size',
            'dependency' => array( 'img_logo_style_custom|site_logo_imglogo', '==|==', 'true|true' )
        ),
    ) // end: fields
);

// ----------------------------------------
// General option section
// ----------------------------------------
$options[]      = array(
    'name'        => 'custom_css',
    'title'       => 'Custom css',
    'icon'        => 'fa fa-paint-brush',
    'fields'      => array(
        array(
          'id'         => 'custom_css_styles',
          'desc'       => 'Only CSS, without tag &lt;style&gt;.',
          'type'       => 'textarea',
          'title'      => 'Custom css code'
        )
    )
);

// ----------------------------------------
// Footer option section                  -
// ----------------------------------------
$options[]      = array(
    'name'        => 'footer',
    'title'       => 'Footer',
    'icon'        => 'fa fa-copyright',
    'fields'      => array(
        array(
            'id'            => 'footer_style',
            'type'          => 'select',
            'title'         => 'Footer style',
            'options'       => array(
                'classic'    => 'Classic',
                'modern'     => 'Modern'
            )
        ),
        // Classic footer.
        array(
            'id'           => 'footer_menu',
            'type'         => 'select',
            'title'        => 'Footer menu',
            'options'      => nrgblog_menus_list(),
            'default'      => 'none',
            'dependency'  => array( 'footer_style', '==', 'classic' )
        ),
        array(
            'id'           => 'footer_social',
            'type'         => 'group',
            'title'        => 'Footer social links',
            'button_title' => 'Add New',
            'fields'       => array(
                array(
                    'id'          => 'footer_social_link',
                    'type'        => 'text',
                    'title'       => 'Text'
                ),
                array(
                    'id'          => 'footer_social_icon',
                    'type'        => 'icon',
                    'title'       => 'Icon'
                )
            ),
            'default' => array(
                array(
                    'footer_social_link' => 'https://twitter.com/',
                    'footer_social_icon' => 'fa fa-twitter'
                ),
                array(
                    'footer_social_link' => 'https://pinterest.com/',
                    'footer_social_icon' => 'fa fa-pinterest-p'
                ),
                array(
                    'footer_social_link' => 'https://www.facebook.com/',
                    'footer_social_icon' => 'fa fa-facebook'
                ),
                array(
                    'footer_social_link' => 'https://www.linkedin.com/',
                    'footer_social_icon' => 'fa fa-linkedin'
                ),
            ),
            'dependency'  => array( 'footer_style', '==', 'classic' )
        ),
        array(
            'id'            => 'footer_gallery_style',
            'type'          => 'select',
            'title'         => 'Footer gallery',
            'options'       => array(
                'none'       => 'None',
                'custom'     => 'Custom',
                'instagram'  => 'Instagram'
            ),
            'dependency' => array( 'footer_style', '==', 'classic' )
        ),
        array(
            'id'           => 'footer_custom_gallery',
            'type'         => 'group',
            'title'        => 'Footer gallery image',
            'button_title' => 'Add New',
            'fields'       => array(
                array(
                    'id'          => 'footer_gallery_image',
                    'type'        => 'image',
                    'title'       => 'Image'
                )
            ),
            'dependency'  => array( 'footer_style|footer_gallery_style', '==|==', 'classic|custom' )
        ),
        array(
            'type'       => 'notice',
            'class'      => 'info',
            'content'    => 'Info: Theme plugin must be enabled and social settings for Instagram not empty.',
            'dependency' => array( 'footer_style|footer_gallery_style', '==|==', 'classic|instagram' )
        ),
        array(
            'id'         => 'footer_instagram_count_items',
            'type'       => 'number',
            'title'      => 'Count items in gallery',
            'default'    => '18',
            'dependency' => array( 'footer_style|footer_gallery_style', '==|==', 'classic|instagram' )
        ),
        // Modern footer.
        array(
            'id'         => 'modern_footer_copyright',
            'type'       => 'text',
            'title'      => 'Copyright text',
            'default'    => '&copy; NRGblog - my personal blog.',
            'dependency' => array( 'footer_style', '==', 'modern' )
        ),

    ) // end: fields
);

// ----------------------------------------
// 404 Page                               -
// ----------------------------------------
$options[]      = array(
  'name'        => 'error_page',
  'title'       => '404 Page',
  'icon'        => 'fa fa-bolt',

  // begin: fields
  'fields'      => array(
    array(
        'id'      => 'error_title',
        'type'    => 'text',
        'title'   => 'Error Title',
        'default' => 'Page not found',
    ),
    array(
        'id'      => 'error_btn_text',
        'type'    => 'text',
        'title'   => 'Error button text',
        'default' => 'Go home',
    ),
  ) // end: fields
);

// ----------------------------------------
// Blog                                   -
// ----------------------------------------
$options[]      = array(
    'name'        => 'blog',
    'title'       => 'Blog',
    'icon'        => 'fa fa-book',
    'fields'      => array(
        array(
            'id'      => 'single_post_sidebar',
            'type'    => 'switcher',
            'title'   => 'Single post sidebar',
            'default' => true
        ),
        array(
            'id'      => 'default_post_image',
            'type'    => 'upload',
            'title'   => 'Default post image',
            'default' => get_template_directory_uri() . '/assets/images/default_image.jpg'
        ),
        array(
            'id'      => 'single_post_breadcrumbs',
            'type'    => 'switcher',
            'title'   => 'Single post breadcrumbs',
            'default' => true
        ),
        array(
            'id'            => 'blog_style',
            'type'          => 'select',
            'title'         => 'Blog style',
            'options'       => array(
                'classic'    => 'Classic',
                'high'       => 'High cells',
                'columns'    => 'Columns',
                'square'     => 'Square'
            )
        ),
        array(
            'id'      => 'slider_under_blog',
            'type'    => 'switcher',
            'title'   => 'Post slider under blog',
            'default' => true
        ),
        array(
            'id'      => 'slider_under_blog_bg',
            'type'    => 'upload',
            'title'   => 'Slider background image',
            'default' => get_template_directory_uri() . '/assets/images/post_grid.jpg',
            'dependency' => array( 'slider_under_blog', '==', 'true' )
        ),
        array(
            'id'         => 'slider_under_blog_count',
            'type'       => 'number',
            'title'      => 'Count items',
            'default'    => '5',
            'dependency' => array( 'slider_under_blog', '==', 'true' )
        ),
    ) // end: fields 
);

// ----------------------------------------
// Social
// ----------------------------------------
$options[]   = array(
    'name'     => 'social',
    'title'    => 'Social',
    'icon'     => 'fa fa-share-alt',
    'fields'   => array(
        array(
            'id'         => 'instagram_user_name',
            'type'       => 'text',
            'title'      => 'Instagram user name',
            'default'    => 'bodotheme'
        ),
        array(
            'id'         => 'instagram_api_key',
            'type'       => 'text',
            'title'      => 'Instagram API key',
            'default'    => '1e2759b12eda4309a6f8c31bbd6d50fb'
        ),
        array(
            'id'         => 'twitter_user_name',
            'type'       => 'text',
            'title'      => 'Twitter user name',
            'default'    => 'bodotheme'
        ),
        array(
            'id'         => 'twitter_api_key',
            'type'       => 'text',
            'title'      => 'Twitter API key',
            'default'    => 'ebVifSd9qmmLHNyYKDqZPj4G3'
        ),
        array(
            'id'         => 'twitter_api_secret',
            'type'       => 'text',
            'title'      => 'Twitter API Secret',
            'default'    => 'dZJ63AZoyxKFn3eS2Et2wX3vZ1nhVBIxv5igNtXPSfRK0t1xWv'
        )
    )  // end: fields
);

// ----------------------------------------
// General option section
// ----------------------------------------
$options[]      = array(
    'name'        => 'mailchimp',
    'title'       => 'MailChimp',
    'icon'        => 'fa fa-envelope',
    'fields'      => array(
        array(
            'id'         => 'mailchimp_api_key',
            'type'       => 'text',
            'title'      => 'MailChimp API key',
            'default'    => 'b30181daf394ecf20543180c7e316441-us11'
        ),
        array(
            'id'         => 'mailchimp_list_id',
            'type'       => 'text',
            'title'      => 'MailChimp list ID',
            'default'    => 'e53c05fab6'
        ),
        array(
            'id'         => 'mailchimp_success',
            'type'       => 'text',
            'title'      => 'MailChimp success subscribe',
            'default'    => 'Subscribe success'
        ),
    )
);

// ----------------------------------------
// Backup
// ----------------------------------------
$options[]   = array(
  'name'     => 'backup_section',
  'title'    => 'Backup',
  'icon'     => 'fa fa-shield',

  // begin: fields
  'fields'   => array(

    array(
        'type'    => 'notice',
        'class'   => 'warning',
        'content' => 'You can save your current options. Download a Backup and Import.',
    ),
    
    array(
        'type'    => 'backup',
    ),

  )  // end: fields
);

// ----------------------------------------
// Documentation
// ----------------------------------------
$options[]   = array(
    'name'     => 'documentation_section',
    'title'    => 'Documentation',
    'icon'     => 'fa fa-info-circle',
    'fields'   => array(
        array(
          'type'    => 'heading',
          'content' => 'Documentation'
        ),
        array(
          'type'    => 'content',
          'content' => 'To view the documentation, go to <a href="http://demo.nrgthemes.com/projects/themes-doc/nrgblog/index.html" target="_blank">documentation page</a>.',
        ),
    )
);
CSFramework::instance( $settings, $options );
