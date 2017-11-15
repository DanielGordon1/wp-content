<?php
/**
 * Slider Blog Template
 *
 * @package nrgblog
 * @since 1.0
 *
 */
global $nrgblog;
$comments_count = wp_count_comments( get_the_ID() );
?>
<div class="swiper-slide"> 
	<div class="bg"></div>
	<?php if ( has_post_thumbnail() ) { ?>
		<?php the_post_thumbnail( 'full', array( 'class' => 'center-image' ) ); ?>
	<?php } else { ?>
		<img src="<?php echo esc_attr( $nrgblog['default_post_image'] );?>" class="center-image" alt="">
	<?php } ?>
	<div class="post-block-item">
		<div class="post-social clearfix">
			<div class="post-social-left">
				<span class="date"><?php the_time( get_option('date_format') ); ?></span>
				<a class="post-social-link" href="#"><i class="fa fa-heart-o"></i> <?php print nrgblog_get_post_likes( $post->ID );?> <?php esc_html_e( 'Likes', 'nrgblog' ); ?></a>
				<a class="post-social-link" href="#"><i class="fa fa-comment-o"></i> <?php echo esc_html( $comments_count->total_comments );?> <?php esc_html_e( 'Comments', 'nrgblog' ); ?></a>
			</div>
		</div>
		<h2>
			<a class="post-block-name" href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>
		<div class="description">
			<?php the_excerpt();?>
		</div>
		<a href="<?php the_permalink(); ?>" class="btn type-2"><?php esc_html_e( 'read more', 'nrgblog' ); ?></a>
	</div>
</div>