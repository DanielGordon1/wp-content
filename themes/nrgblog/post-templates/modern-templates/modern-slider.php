<?php
/**
 * Modern style template for video post preview.
 *
 * @package nrgblog
 * @since 1.0
 *
 */
global $nrgblog;
$comments_count = wp_count_comments( get_the_ID() );
$meta_data = get_post_meta( get_the_ID(), 'nrgblog_post_options', true );
$post_categories = wp_get_post_categories( get_the_ID() );
$cat = get_category( $post_categories[0] );

$image_ids = explode( ',', $meta_data['post_slider'] );

if ( $meta_data['post_preview_slider_size'] == 'medium' ) { ?>
    <div class="col-md-6 col-sm-12 col-xs-12 isotope-item">
        <div class="blog-post style-3 type-2">
            <div class="swiper-container" data-autoplay="0" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1">
                <div class="swiper-wrapper">
                <?php 
                    foreach ( $image_ids as $id ) {
                        $image = wp_get_attachment_image_src( $id, 'full' ); ?>
                        <div class="swiper-slide">
                            <a href="<?php the_permalink(); ?>" class="img"><img class="center-image" src="<?php echo esc_url( $image[0] );?>" alt=""></a>
                            <div class="bg-vs"></div>
                        </div>
                    <?php }
                ?>
                </div>
                <div class="pagination style-1"></div>
            </div>
            <div class="content">
                <div class="post-date"><?php the_time( get_option('date_format') ); ?> <a href="<?php echo esc_url( get_category_link( $cat->term_id ) );?>" class="tag-name"><?php echo esc_html( $cat->name ); ?></a></div>
                <a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a>
                <div class="description"><?php the_excerpt(); ?></div>
            </div>
        </div>
    </div>
<?php } else if( $meta_data['post_preview_slider_size'] == 'big' ) { ?>
    <div class="col-md-8 col-sm-6 col-xs-12 isotope-item">
        <div class="blog-post style-3">
            <div class="swiper-container" data-autoplay="0" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1">
                <div class="swiper-wrapper">
                <?php 
                    foreach ( $image_ids as $id ) {
                        $image = wp_get_attachment_image_src( $id, 'full' ); ?>
                        <div class="swiper-slide">
                            <a href="<?php the_permalink(); ?>" class="img"><img src="<?php echo esc_url( $image[0] );?>" alt="" /></a>
                        </div>
                    <?php }
                ?>
                </div>
                <div class="pagination style-1"></div>
            </div>
            <div class="content">
                <div class="post-date"><?php the_time( get_option('date_format') ); ?> <a href="<?php echo esc_url( get_category_link( $cat->term_id ) );?>" class="tag-name"><?php echo esc_html( $cat->name ); ?></a></div>
                <a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a>
                <div class="description"><?php the_excerpt(); ?></div>
            </div>
        </div>
    </div>
<?php } ?>
