<?php
/**
 * Carrousel Blog Template
 *
 * @package nrgblog
 * @since 1.0
 *
 */
global $nrgblog;
$post_categories = wp_get_post_categories( get_the_ID() );
$cat = get_category( $post_categories[0] );
$comments_count = wp_count_comments( get_the_ID() );
?>
<div class="swiper-slide"> 
	<div class="post-round-item">
		<a class="post-image" href="<?php the_permalink(); ?>">
			<?php if ( has_post_thumbnail() ) { ?>
				<?php the_post_thumbnail( 'nrgblog-post-carrousel', array( 'class' => 'img-responsive' ) ); ?>
			<?php } else { ?>
				<img src="<?php echo esc_attr( $nrgblog['default_post_image'] );?>" class="img-responsive">
			<?php } ?>
		</a>
		<div class="post-date"><?php the_time( get_option('date_format') ); ?> / <a href="<?php echo esc_attr( get_category_link( $cat->term_id ) );?>" class="tag-name"><?php echo esc_html( $cat->name ); ?></a></div>
		<h2><a class="post-round-name" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<div class="post-social post-social-center">
			<a class="post-social-link" href="#"><i class="fa fa-heart-o"></i> <?php print nrgblog_get_post_likes( $post->ID );?> <?php esc_html_e( 'Likes', 'nrgblog' ); ?></a>
			<a class="post-social-link" href="#"><i class="fa fa-comment-o"></i> <?php echo esc_html( $comments_count->total_comments );?> <?php esc_html_e( 'Comments', 'nrgblog' ); ?></a>
		</div>
	</div>
</div> 