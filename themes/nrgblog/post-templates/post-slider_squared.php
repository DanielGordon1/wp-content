<?php
/**
 * Slider Blog Template
 *
 * @package nrgblog
 * @since 1.0
 *
 */
global $nrgblog;
$post_categories = wp_get_post_categories( get_the_ID() );
$cat = get_category( $post_categories[0] );
?>
<div class="swiper-slide">
	<a href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ) { ?>
			<?php the_post_thumbnail( 'full', array( 'class' => 'center-image' ) ); ?>
		<?php } else { ?>
			<img src="<?php echo esc_attr( $nrgblog['default_post_image'] );?>" class="center-image" alt="">
		<?php } ?>
		<div class="bg-vs"></div>
		<div class="content">
			<p class="post-date"><?php the_time( get_option('date_format') ); ?> / <?php echo esc_html( $cat->name ); ?></p>
			<p class="title"><?php the_title(); ?></p>
		</div>
	</a>
</div>