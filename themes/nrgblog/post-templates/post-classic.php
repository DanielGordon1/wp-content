<?php
/**
 * Classic Blog Template
 *
 * @package nrgblog
 * @since 1.0
 *
 */
global $nrgblog;
$comments_count = wp_count_comments( get_the_ID() );
$meta_data = get_post_meta( get_the_ID(), 'nrgblog_post_options', true );

if( ! empty( $meta_data['post_vimeo'] ) ) {
	$video = explode( '/', $meta_data['post_vimeo'] );
}
if( ! empty( $meta_data['post_slider'] ) ) {
	$image_ids = explode( ',', $meta_data['post_slider'] );
}

$post_style = ( ! empty( $meta_data['post_preview_style'] ) ) ? $meta_data['post_preview_style'] : 'image'; 
?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post style-1' ); ?>>
	<div class="post-date"><?php the_time( get_option('date_format') ); ?> / <?php the_category( ', ' ); ?></div>
	<a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a>
	<div class="post-social clearfix">
		<span>
    		<a href="http://twitter.com/home?status=<?php echo esc_url(urlencode(the_title('', '', false))); ?><?php esc_url(the_permalink()); ?>" class="post-social-link soc-n" target="_blank"><i class="fa fa-twitter"></i></a>
			<a href="http://www.facebook.com/sharer.php?u=<?php esc_url( the_permalink() );?>&amp;t=<?php echo esc_attr(urlencode(the_title('', '', false))); ?>" class="post-social-link soc-n" target="_blank"><i class="fa fa-facebook"></i></a>
		</span>
		<span>
			<a class="post-social-link" href="#"><i class="fa fa-heart-o"></i> <?php print nrgblog_get_post_likes( $post->ID );?> <?php esc_html_e( 'Likes', 'nrgblog' ); ?></a>
			<a class="post-social-link" href="#"><i class="fa fa-comment-o"></i> <?php echo esc_html( $comments_count->total_comments );?> <?php esc_html_e( 'Comments', 'nrgblog' ); ?></a>
		</span>
	</div>
	<?php if( $post_style == 'image' ) { ?>
		<a href="<?php the_permalink(); ?>" class="img">
			<?php if ( has_post_thumbnail() ) { ?>
				 <?php the_post_thumbnail( 'full', array( 'class' => 'center-image' )); ?>
			<?php } else { ?>
				<img src="<?php echo esc_attr( $nrgblog['default_post_image'] );?>" class="center-image" alt="">
			<?php } ?>
		</a>
	<?php } else if( $post_style == 'video' ) { ?>
		<div class="video">
			<iframe src="https://player.vimeo.com/video/<?php echo esc_html( end( $video ) );?>?color=ffffff&amp;portrait=0" class="embed-responsive-item"></iframe>
		</div>
	<?php } else if( $post_style == 'slider' ) { ?>
		<div class="slider">
			<div class="swiper-container" data-autoplay="0" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1">
		        <div class="swiper-wrapper">
		        	<?php 
	                    foreach ( $image_ids as $id ) {
	                        $image = wp_get_attachment_image_src( $id, 'full' ); ?>
	                        <div class="swiper-slide">
	                            <img class="center-image" src="<?php echo esc_url( $image[0] );?>" alt="">
	                        </div>
	                    <?php }
	                ?>
		    	</div>
		    	<div class="pagination style-1"></div>
			</div>
		</div>
	<?php } ?>
	<div class="description ff"><?php the_excerpt(); ?></div>
	<a href="<?php the_permalink(); ?>" class="btn"><?php esc_html_e( 'read more', 'nrgblog' ); ?></a>
</div>