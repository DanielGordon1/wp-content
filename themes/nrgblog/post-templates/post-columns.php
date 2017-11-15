<?php
/**
 * Columns Blog Template
 *
 * @package nrgblog
 * @since 1.0
 *
 */
global $nrgblog;
$post_categories = wp_get_post_categories( get_the_ID() );
$meta_data = get_post_meta( get_the_ID(), 'nrgblog_post_options', true );
$cat = get_category( $post_categories[0] );
$video = false;
if( $meta_data['post_preview_style'] == 'video' ) {
	$video = explode( '/', $meta_data['post_vimeo'] );
}
?>
<div class="isotope-item post-block-entry style-2 col-mob-12 col-xs-6 col-md-4 col-lg-3">
	<div class="post-block-item style-2">
		<a class="post-image" href="<?php the_permalink(); ?>">
			<?php if( $video ) { ?>
				<span class="video-play" data-src="https://player.vimeo.com/video/<?php echo esc_html( end($video) );?>"></span>
			<?php } ?>
			<?php if ( has_post_thumbnail() ) { ?>
				<?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive img-full' ) ); ?>
			<?php } else { ?>
				<img src="<?php echo esc_attr( $nrgblog['default_post_image'] );?>" class="img-responsive img-full" alt="">
			<?php } ?>
		</a>
		<div class="post-block-category"><a href="<?php echo esc_attr( get_category_link( $cat->term_id ) );?>" class="tag-name"><?php echo esc_html( $cat->name ); ?></a></div>
		<h2><a class="post-block-name" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<div class="post-date">
			<span><?php the_time( get_option('date_format') ); ?></span>                                        
			<span><?php esc_html_e( 'by', 'nrgblog' ); ?> <a href="#" class="author-name"><?php the_author(); ?></a></span>
		</div>
	</div>
</div>