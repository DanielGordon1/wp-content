<?php
/**
 * The template for requried actions hooks.
 *
 * @package nrgblog
 * @since 1.0.0
 */

add_action( 'widgets_init', 'nrgblog_register_widgets' );
add_action( 'wp_enqueue_scripts', 'nrgblog_enqueue_scripts');
add_action( 'wp_head', 'nrgblog_custom_styles', 8);
add_action( 'tgmpa_register', 'nrgblog_include_required_plugins' );

define( 'CS_ACTIVE_FRAMEWORK', true );
define( 'CS_ACTIVE_METABOX',   true );
define( 'CS_ACTIVE_SHORTCODE', false );
define( 'CS_ACTIVE_CUSTOMIZE', false );

/*
 * Register sidebar.
 */
function nrgblog_register_widgets() {
	// register sidebars
	register_sidebar(
		array(
			'id' 			=> 'sidebar',
			'name' 			=> esc_html__( 'Sidebar', 'nrgblog' ),
			'before_widget' => '<div class="widjet %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<p class="title-w">',
			'after_title' 	=> '</p>',
			'description' 	=> esc_html__( 'Drag the widgets for sidebars.', 'nrgblog' )
		)
	);
	// register sidebars
	register_sidebar(
		array(
			'id' 			=> 'first-footer-sidebar',
			'name' 			=> esc_html__( 'First footer sidebar', 'nrgblog' ),
			'before_widget' => '',
			'after_widget' 	=> '',
			'before_title' 	=> '<h4 class="widget-title">',
			'after_title' 	=> '</h4>',
			'description' 	=> esc_html__( 'Drag the widgets for sidebars.', 'nrgblog' )
		)
	);
	// register sidebars
	register_sidebar(
		array(
			'id' 			=> 'second-footer-sidebar',
			'name' 			=> esc_html__( 'Second footer sidebar', 'nrgblog' ),
			'before_widget' => '',
			'after_widget' 	=> '',
			'before_title' 	=> '<h4 class="widget-title">',
			'after_title' 	=> '</h4>',
			'description' 	=> esc_html__( 'Drag the widgets for sidebars.', 'nrgblog' )
		)
	);
	// register sidebars
	register_sidebar(
		array(
			'id' 			=> 'third-footer-sidebar',
			'name' 			=> esc_html__( 'Third footer sidebar', 'nrgblog' ),
			'before_widget' => '',
			'after_widget' 	=> '',
			'before_title' 	=> '<h4 class="widget-title">',
			'after_title' 	=> '</h4>',
			'description' 	=> esc_html__( 'Drag the widgets for sidebars.', 'nrgblog' )
		)
	);
	// register sidebars
	register_sidebar(
		array(
			'id' 			=> 'fourth-footer-sidebar',
			'name' 			=> esc_html__( 'Fourth footer sidebar', 'nrgblog' ),
			'before_widget' => '',
			'after_widget' 	=> '',
			'before_title' 	=> '<h4 class="widget-title">',
			'after_title' 	=> '</h4>',
			'description' 	=> esc_html__( 'Drag the widgets for sidebars.', 'nrgblog' )
		)
	);
}

/**
* @ return null
* @ param none
* @ loads all the js and css script to frontend
**/
function nrgblog_enqueue_scripts() {

	// general settings
	if( ( is_admin() ) ) { return; }

	wp_enqueue_script( 'placeholder-js', T_URI . '/assets/js/placeholder.min.js', 		array( 'jquery' ), false, true );
	wp_enqueue_script( 'scripts-js', 	 T_URI . '/assets/js/idangerous.swiper.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'modernizr',  	 T_URI . '/assets/js/isotope.pkgd.min.js', 	    array( 'jquery' ), false, true );
	wp_enqueue_script( 'main-js', 	 	 T_URI . '/assets/js/global.js',				array( 'jquery' ), false, true );

	// add TinyMCE style
	add_editor_style();
	
	wp_enqueue_script( 'jquery-migrate' );

	// including jQuery plugins
	wp_localize_script('jquery-scripts', 'get',
		array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'siteurl' => get_template_directory_uri()
		)
	);

	if ( is_singular() ) {
		wp_enqueue_script( 'comment-reply' );
	}
	// register style

	wp_enqueue_style( 'wp-css',		  T_URI . '/style.css' );
	wp_enqueue_style( 'bootstrap',	  T_URI . '/assets/css/bootstrap.min.css' );
	wp_enqueue_style( 'font-awesomes', T_URI . '/assets/css/font-awesome.min.css' );
	wp_enqueue_style( 'idangerous',	  T_URI . '/assets/css/idangerous.swiper.css' );
	wp_enqueue_style( 'main-css',	  T_URI . '/assets/css/style.css' );
}

/**
* Include plugins
**/
function nrgblog_include_required_plugins() {

	$plugins = array(

		array(
			'name'     				=> esc_html__( 'Contact Form 7', 'nrgblog' ), // The plugin name
			'slug'     				=> 'contact-form-7', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> esc_html__( 'Visual Composer', 'nrgblog' ), // The plugin name
			'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
			'source'   				=> 'http://demo.nrgthemes.com/projects/plugins/js_composer.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> esc_html__( 'NRGBlog Plugins', 'nrgblog' ),// The plugin name
			'slug'     				=> 'nrgblog-plugins', // The plugin slug (typically the folder name)
			'source'   				=> T_PATH .'/framework/importer/plugin/nrgblog-plugins.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
	);

	// Change this to your theme text domain, used for internationalising strings

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> 'tgmpa',         			// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> esc_html__( 'Install Required Plugins', 'tgmpa' ),
			'menu_title'                       			=> esc_html__( 'Install Plugins', 'tgmpa' ),
			'installing'                       			=> esc_html__( 'Installing Plugin: %s', 'tgmpa' ), // %1$s = plugin name
			'oops'                             			=> esc_html__( 'Something went wrong with the plugin API.', 'tgmpa' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'tgmpa' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'tgmpa' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'tgmpa' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'tgmpa' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'tgmpa' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'tgmpa' ),
			'return'                           			=> esc_html__( 'Return to Required Plugins Installer', 'tgmpa' ),
			'plugin_activated'                 			=> esc_html__( 'Plugin activated successfully.', 'tgmpa' ),
			'complete' 									=> esc_html__( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );
}

/*
 * Custom styles from Theme Options.
 */
function nrgblog_custom_styles() {
	global $nrgblog;
	$style = '<!--[if IE 9]><link href="' . T_URI . '/assets/css/ie9.css" rel="stylesheet" type="text/css" /><![endif]-->';

	if ( ! empty( $nrgblog['custom_css_styles'] ) ) {
		$style .= '<style type="text/css" media="screen">';
		$style .= $nrgblog['custom_css_styles'];
		$style .= '</style>';
	}

	print $style;
}
