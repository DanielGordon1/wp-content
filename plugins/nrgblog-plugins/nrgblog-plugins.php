<?php
/*
Plugin Name: NRGBlog Plugins
Plugin URI: http://nrgthemes.com/
Author: NrgThemes
Author URI: http://nrgthemes.com
Version: 1.0
Description: Includes Portfolio Custom Post Type and Visual Composer Shortcodes
Text Domain: nrgblog
*/

// Define Constants

defined( 'EF_ROOT' )	or define( 'EF_ROOT', dirname(__FILE__) );
defined( 'EF_VERSION' )	or define( 'EF_VERSION', '1.0' );

if( ! class_exists('NRGBlog_Plugins') ) {

	class NRGBlog_Plugins {

		private $assets_js;

		public function __construct() {
			$this->assets_js	= plugins_url( '/composer/js', __FILE__);
			add_action( 'admin_init', array($this, 'nrgblog_load_map'));
			add_action( 'admin_print_scripts-post.php', array($this, 'vc_enqueue_scripts'), 99);
			add_action( 'admin_print_scripts-post-new.php', array($this, 'vc_enqueue_scripts'), 99);
			$this->nrgblog_load_shortcodes();
		}

		public function nrgblog_load_map() {
			if(class_exists('Vc_Manager')) {
				require_once( EF_ROOT .'/'. 'composer/map.php');
				require_once( EF_ROOT .'/'. 'composer/init.php');
			}
		}

		public function nrgblog_load_shortcodes() {

			foreach( glob( EF_ROOT . '/'. 'shortcodes/nrgblog_*.php' ) as $shortcode ) {
				require_once(EF_ROOT .'/'. 'shortcodes/'. basename( $shortcode ) );
			}

		}

		public function vc_enqueue_scripts() {
			wp_enqueue_script( 'vc-script', $this->assets_js .'/vc-script.js' ,  array('jquery'), '1.0.0', true );
		}

	} // end of class

	new NRGBlog_Plugins;
} // end of class_exists
