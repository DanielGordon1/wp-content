<?php
/**
 * The template includes necessary functions for theme.
 *
 * @package nrgblog
 * @since 1.0.0
 */

if ( ! isset( $content_width ) ) {
    $content_width = 960; /* pixels */
}

defined( 'T_URI' )  or define( 'T_URI',  get_template_directory_uri() );
defined( 'T_PATH' ) or define( 'T_PATH', get_template_directory() );
defined( 'F_PATH' ) or define( 'F_PATH', T_PATH . '/framework' ); 

// Framework integration
// ----------------------------------------------------------------------------------------------------
require_once F_PATH . '/include/actions-config.php';
require_once F_PATH . '/include/helper-functions.php';
require_once F_PATH . '/include/custom-widgets.php';
require_once F_PATH . '/cs-framework/cs-framework.php';
require_once F_PATH . '/class-tgm-plugin-activation.php';
require_once F_PATH . '/importer/init.php';

function nrgblog_after_setup() {
    register_nav_menus( 
        array( 
            'left-menu'  => esc_html__( 'Left Menu', 'nrgblog' ),
            'right-menu' => esc_html__( 'Right Menu', 'nrgblog' ),
            'dd-menu'    => esc_html__( 'Dropdown Menu - only for Modern header style.', 'nrgblog' )
        ) 
    );
    add_theme_support( 'post-formats', array('video', 'gallery', 'audio', 'quote', 'link'));
    add_theme_support( 'custom-header' );
    add_theme_support( 'custom-background' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    add_image_size( 'nrgblog-post-carrousel', 128, 128, true );
}
add_action( 'after_setup_theme', 'nrgblog_after_setup' );

/**
 * Сustom nrgblog menu.
 */
function nrgblog_custom_menu( $menu ) {
    if ( has_nav_menu( $menu ) ) {
        return wp_nav_menu( array( 'container' => '', 'theme_location' => $menu, 'echo' => false ) );
    } 
}