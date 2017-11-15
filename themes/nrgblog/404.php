<?php
/**
 * 404 Page
 *
 * @package nrgblog
 * @since 1.0
 *
 */
global $nrgblog;
get_header();?>
	<div class="not-founded">
		<div class="not-found-title">
			<span><?php esc_html_e( 'Error 404', 'nrgblog' ); ?></span>
			<h1><?php echo esc_html( $nrgblog['error_title'] ); ?></h1>
		</div>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( $nrgblog['error_btn_text'] ); ?></a>
	</div>
<?php get_footer(); ?>