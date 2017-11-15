<?php
/**
 * Modern Slider Blog Template
 *
 * @package nrgblog
 * @since 1.0
 *
 */
$comments_count = wp_count_comments( get_the_ID() );
?>
<div class="swiper-slide">
	<div class="post-social post-social-center">
		<div class="post-date"><?php the_time( get_option('date_format') ); ?></div>
		<span class="post-social-link"><i class="fa fa-heart-o"></i> <?php print nrgblog_get_post_likes( $post->ID );?> <?php esc_html_e( 'Likes', 'nrgblog' ); ?></span>
		<span class="post-social-link"><i class="fa fa-comment-o"></i> <?php echo esc_html( $comments_count->total_comments );?> <?php esc_html_e( 'Comments', 'nrgblog' ); ?></span>
	</div>
	<a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a>
	<div class="description">
		<?php the_excerpt();?>
	</div>
	<a href="<?php the_permalink(); ?>" class="btn type-2"><?php esc_html_e( 'read more', 'nrgblog' ); ?></a>
</div>