<?php
/**
 * Post list style 2
 *
 * @package nrgblog
 * @since 1.0
 *
 */
global $nrgblog;
$post_categories = wp_get_post_categories( get_the_ID() );
$cat = get_category( $post_categories[0] );
?>
<div class="blog-post style-5">
	<div class="bg-easy"></div>
	<?php if ( has_post_thumbnail() ) { ?>
		<?php the_post_thumbnail( 'full', array( 'class' => 'center-image' )); ?>
	<?php } else { ?>
		<img src="<?php echo esc_attr( $nrgblog['default_post_image'] );?>" class="center-image" alt="">
	<?php } ?>
	<div class="content">
		<div class="post-date"><?php the_time( get_option('date_format') ); ?> <a href="<?php echo esc_attr( get_category_link( $cat->term_id ) );?>" class="tag-name"><?php echo esc_html( $cat->name ); ?></a>
		</div>
		<a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a>
		<div class="description ff"><?php the_excerpt(); ?></div>
		<div class="about post-date post-social">
			<a href="<?php print get_author_posts_url( $post->post_author ); ?>" class="auth-img">
				<?php echo get_avatar( $post->post_author, 40 ); ?> 
			</a>
			<?php esc_html_e( 'by', 'nrgblog' ); ?>
			<a href="<?php print get_author_posts_url( $post->post_author ); ?>" class="author">
				<?php the_author_meta('nickname'); ?>
			</a>
			<a class="post-social-link" href="#"><i class="fa fa-heart-o"></i> <?php print nrgblog_get_post_likes( $post->ID );?> <?php esc_html_e( 'Likes', 'nrgblog' ); ?></a>
			<a class="post-social-link" href="#"><i class="fa fa-comment-o"></i> <?php echo esc_html( $post->comment_count );?> <?php esc_html_e( 'Comments', 'nrgblog' ); ?></a>
		</div>
	</div>
</div>