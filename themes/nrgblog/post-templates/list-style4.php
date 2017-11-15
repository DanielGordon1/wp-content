<?php
/**
 * Post list style 4
 *
 * @package nrgblog
 * @since 1.0
 *
 */
global $nrgblog;
$meta_data = get_post_meta( get_the_ID(), 'nrgblog_post_options', true );
$post_categories = wp_get_post_categories( get_the_ID() );
$cat = get_category( $post_categories[0] );

$post_style = ( ! empty( $meta_data['post_preview_style'] ) ) ? $meta_data['post_preview_style'] : 'image';

if( ! empty( $meta_data['post_vimeo'] ) ) {
	$video = explode( '/', $meta_data['post_vimeo'] );
}
if( ! empty( $meta_data['post_slider'] ) ) {
	$image_ids = explode( ',', $meta_data['post_slider'] );
}

?>
<?php if( $post_style == 'slider' ) { ?>
	<div class="blog-post style-7">
		<div class="swiper-container slider" data-autoplay="0" data-loop="1" data-speed="500"  data-center="0" data-slides-per-view="1">
			<div class="swiper-wrapper">
				<?php 
	            foreach ( $image_ids as $id ) {
	                $image = wp_get_attachment_image_src( $id, 'full' ); ?>
	                <div class="swiper-slide">
	                	<div class="photo">
		                    <img class="center-image" src="<?php echo esc_url( $image[0] );?>" alt="">
		                </div>
	                </div>
	            <?php } ?>
			</div>
			<div class="pagination style-1"></div>
		</div>
		<div class="content">
			<div class="post-date">
				<span class="date"><?php the_time( get_option('date_format') ); ?></span>
				<a href="<?php echo esc_attr( get_category_link( $cat->term_id ) );?>" class="tag-name"><?php echo esc_html( $cat->name ); ?></a>
				<span class="by">
					<?php esc_html_e( 'by', 'nrgblog' ); ?>
					<a href="<?php print get_author_posts_url( $post->post_author ); ?>" class="author">
						<?php the_author_meta('nickname'); ?>
					</a>
				</span>
			</div>
			<a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a>
	       	<div class="description ff"><?php the_excerpt(); ?></div>
	        <div class="post-social clearfix">
	        	<div class="post-social-left">
	            	<a href="http://twitter.com/home?status=<?php echo esc_url(urlencode(the_title('', '', false))); ?><?php esc_url(the_permalink()); ?>" class="post-social-link" target="_blank"><i class="fa fa-twitter"></i></a>
					<a href="http://www.facebook.com/sharer.php?u=<?php esc_url( the_permalink() );?>&amp;t=<?php echo esc_attr(urlencode(the_title('', '', false))); ?>" class="post-social-link" target="_blank"><i class="fa fa-facebook"></i></a>
	        	</div>
	        	<div class="post-social-right">
	            	<a class="post-social-link" href="#"><i class="fa fa-heart-o"></i> <?php print nrgblog_get_post_likes( $post->ID );?> <?php esc_html_e( 'Likes', 'nrgblog' ); ?></a>
	            	<a class="post-social-link" href="#"><i class="fa fa-comment-o"></i> <?php echo esc_html( $post->comment_count );?> <?php esc_html_e( 'Comments', 'nrgblog' ); ?></a>
	        	</div>
	    	</div>
		</div>
	</div>
<?php } else if( $post_style == 'image' ) { ?>
	<div class="blog-post style-7">
		<a href="<?php the_permalink(); ?>" class="img">
			<?php if ( has_post_thumbnail() ) { ?>
				<?php the_post_thumbnail( 'full', array( 'class' => 'center-image' ) ); ?>
			<?php } else { ?>
				<img src="<?php echo esc_attr( $nrgblog['default_post_image'] );?>" class="center-image" alt="">
			<?php } ?>
		</a>
		<div class="content">
			<div class="post-date">
				<span class="date"><?php the_time( get_option('date_format') ); ?></span>
				<a href="<?php echo esc_attr( get_category_link( $cat->term_id ) );?>" class="tag-name"><?php echo esc_html( $cat->name ); ?></a>
				<span class="by">
	            	<?php esc_html_e( 'by', 'nrgblog' ); ?>
	                <a href="<?php print get_author_posts_url( $post->post_author ); ?>" class="author">
						<?php the_author_meta('nickname'); ?>
					</a>
	            </span>
	        </div>
			<a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a>
			<div class="description ff"><?php the_excerpt(); ?></div>
			<div class="post-social clearfix">
				<div class="post-social-left">
	            	<a href="http://twitter.com/home?status=<?php echo esc_url(urlencode(the_title('', '', false))); ?><?php esc_url(the_permalink()); ?>" class="post-social-link" target="_blank"><i class="fa fa-twitter"></i></a>
					<a href="http://www.facebook.com/sharer.php?u=<?php esc_url( the_permalink() );?>&amp;t=<?php echo esc_attr(urlencode(the_title('', '', false))); ?>" class="post-social-link" target="_blank"><i class="fa fa-facebook"></i></a>
	        	</div>
	        	<div class="post-social-right">
	            	<a class="post-social-link" href="#"><i class="fa fa-heart-o"></i> <?php print nrgblog_get_post_likes( $post->ID );?> <?php esc_html_e( 'Likes', 'nrgblog' ); ?></a>
	            	<a class="post-social-link" href="#"><i class="fa fa-comment-o"></i> <?php echo esc_html( $post->comment_count );?> <?php esc_html_e( 'Comments', 'nrgblog' ); ?></a>
	        	</div>
			</div>
		</div>
	</div>
<?php } else if( $post_style == 'video' ) { ?>
	<div class="blog-post style-7">
		<a href="#" class="img">
			<span class="video-play" data-src="https://player.vimeo.com/video/<?php echo esc_html( end( $video ) );?>"></span> 
			<?php if ( has_post_thumbnail() ) { ?>
				<?php the_post_thumbnail( 'full', array( 'class' => 'center-image' ) ); ?>
			<?php } else { ?>
				<img src="<?php echo esc_attr( $nrgblog['default_post_image'] );?>" class="center-image" alt="">
			<?php } ?>
		</a>
		<div class="content">
			<div class="post-date">
				<span class="date"><?php the_time( get_option('date_format') ); ?></span>
				<a href="<?php echo esc_attr( get_category_link( $cat->term_id ) );?>" class="tag-name post-date"><?php echo esc_html( $cat->name ); ?></a>
				<span class="by">
					<?php esc_html_e( 'by', 'nrgblog' ); ?>
					<a href="<?php print get_author_posts_url( $post->post_author ); ?>" class="author">
						<?php the_author_meta('nickname'); ?>
					</a>
				</span>
			</div>
			<a href="blog-deatil1.html" class="title"><?php the_title(); ?></a>
			<div class="description ff"><?php the_excerpt(); ?></div>
			<div class="post-social clearfix">
				<div class="post-social-left">
	            	<a href="http://twitter.com/home?status=<?php echo esc_url(urlencode(the_title('', '', false))); ?><?php esc_url(the_permalink()); ?>" class="post-social-link" target="_blank"><i class="fa fa-twitter"></i></a>
					<a href="http://www.facebook.com/sharer.php?u=<?php esc_url( the_permalink() );?>&amp;t=<?php echo esc_attr(urlencode(the_title('', '', false))); ?>" class="post-social-link" target="_blank"><i class="fa fa-facebook"></i></a>
	        	</div>
	        	<div class="post-social-right">
	            	<a class="post-social-link" href="#"><i class="fa fa-heart-o"></i> <?php print nrgblog_get_post_likes( $post->ID );?> <?php esc_html_e( 'Likes', 'nrgblog' ); ?></a>
	            	<a class="post-social-link" href="#"><i class="fa fa-comment-o"></i> <?php echo esc_html( $post->comment_count );?> <?php esc_html_e( 'Comments', 'nrgblog' ); ?></a>
	        	</div>
			</div>
		</div>
	</div>
<?php } ?>