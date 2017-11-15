<?php
/**
 * Designed Slider Blog Template
 *
 * @package nrgblog
 * @since 1.0
 *
 */
$comments_count = wp_count_comments( get_the_ID() );
?>
<div class="swiper-slide"> 
	<div class="post-date"><?php the_time( get_option('date_format') ); ?></div>
	<h2 class="post-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<div class="post-social post-social-center">
		<span class="post-social-link"><i class="fa fa-heart-o"></i> <?php print nrgblog_get_post_likes( $post->ID );?> <?php esc_html_e( 'Likes', 'nrgblog' ); ?></span>
		<span class="post-social-link"><i class="fa fa-comment-o"></i> <?php echo esc_html( $comments_count->total_comments );?> <?php esc_html_e( 'Comments', 'nrgblog' ); ?></span>
	</div>
</div>