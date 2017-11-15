<?php
/**
 * High Blog Template
 *
 * @package nrgblog
 * @since 1.0
 *
 */
global $nrgblog;
$post_categories = wp_get_post_categories( get_the_ID() );
$cat = get_category( $post_categories[0] );
?>
<div class="post-grid-entry style-2 col-sm-6 col-xs-12 col-md-4 post-hight">
	<a href="<?php the_permalink(); ?>" class="post-grid-item style-2">
		<?php if ( has_post_thumbnail() ) { ?>
			<?php the_post_thumbnail( 'full', array( 'class' => 'center-image' ) ); ?>
		<?php } else { ?>
			<img src="<?php echo esc_attr( $nrgblog['default_post_image'] );?>" class="center-image" alt="">
		<?php } ?>
		<div class="content">
			<div class="post-cat"><?php echo esc_html( $cat->name ); ?></div>
			<h2 class="post-name"><?php the_title(); ?></h2>
			<div class="post-date"><?php the_time( get_option('date_format') ); ?></div>
		</div>
	</a>
</div>