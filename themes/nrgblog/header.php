<?php
/**
 *
 * The Header for our theme
 * @since 1.0.0
 * @version 1.0.0
 *
 */
global $nrgblog;
$option = ( isset( $nrgblog['header_style'] ) ) ? $nrgblog['header_style'] : 'classic' ;
if ( is_page() ) {
  $meta_data = get_post_meta( get_the_ID(), 'nrgblog_page', true );
  $option = ( isset( $meta_data['page_header'] ) && $meta_data['page_header'] != 'default' ) ? $meta_data['page_header'] : $nrgblog['header_style'];
}
$header_style = ( $option != 'classic' ) ? ' style-3 bg-2' : '';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="format-detection" content="telephone=no" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no, minimal-ui"/>
  <?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
    <link rel="shortcut icon" href="<?php echo esc_url( $nrgblog['site_favicon'] ) ;?>">
  <?php } ?>
  <?php wp_head(); ?>
</head>
<body <?php body_class('header style-2' . $header_style ); ?>>
  <?php if( $nrgblog['page_preloader'] ) { ?>
    <!-- LOADER -->
    <div id="loader-wrapper">
      <div id="loader"></div>
    </div>
  <?php } ?>
  <!-- HEADER -->
  <header>
    <div class="container">
      <div class="top-line">
        <a class="logo" href="<?php echo esc_url( home_url( '/' ) );?>"><img src="<?php echo esc_url( $nrgblog['site_logo'] );?>" alt=""></a>
        <button class="cmn-toggle-switch"><span></span></button>                        
      </div>
      <?php if( $nrgblog['search_form'] ) { ?>
        <a class="h-search"><i class="fa fa-search"></i></a>
      <?php } ?>     
      <div class="nav-container">
        <?php nrgblog_site_menu( $option ); ?>
      </div>
    </div>
  </header>
