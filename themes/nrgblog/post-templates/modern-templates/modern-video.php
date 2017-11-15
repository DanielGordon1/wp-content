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

$video = explode( '/', $meta_data['post_vimeo'] );

switch ( $meta_data['post_preview_video_size'] ) {
    case 'medium': ?>
        <div class="col-md-6 col-sm-12 col-xs-12 isotope-item">
            <div class="blog-post style-3 type-2">
                <a href="<?php the_permalink(); ?>" class="img">
                    <?php if ( has_post_thumbnail() ) {
                        the_post_thumbnail( 'full', array( 'class' => 'center-image' ) );
                    } else {
                        print '<img src="' . esc_attr( $nrgblog['default_post_image'] ) . '" class="center-image" alt="">';
                    } ?>
                    <span class="video-play" data-src="https://player.vimeo.com/video/<?php echo esc_html( end($video) );?>"></span>
                </a>
                <div class="bg-vs"></div>
                <div class="content">
                    <div class="post-date"><?php the_time( get_option('date_format') ); ?> <a href="<?php echo esc_url( get_category_link( $cat->term_id ) );?>" class="tag-name"><?php echo esc_html( $cat->name ); ?></a></div>
                    <a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a>
                    <div class="description"><?php the_excerpt(); ?></div>
                </div>
            </div>
        </div>
    <?php break;

    case 'small': ?>
        <div class="col-md-4 isotope-item col-sm-12 col-xs-12">
            <div class="post-block-item style-3 small-post">
                <a class="post-image" href="<?php the_permalink(); ?>">
                    <span class="video-play" data-src="https://player.vimeo.com/video/<?php echo esc_html( end($video) );?>"></span>
                    <?php if ( has_post_thumbnail() ) {
                        the_post_thumbnail( 'full', array( 'class' => 'img-responsive img-full' ) );
                    } else {
                        print '<img src="' . esc_attr( $nrgblog['default_post_image'] ) . '" class="img-responsive img-full">';
                    } ?>
                </a>
                <div class="post-block-category"><a href="<?php echo esc_url( get_category_link( $cat->term_id ) );?>" class="tag-name"><?php echo esc_html( $cat->name ); ?></a></div>
                <h2><a class="post-block-name" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="description"><?php the_excerpt(); ?></div>
                <div class="post-social clearfix">
                    <div class="post-social-left">
                        <div class="post-date">
                            <span><?php the_time( get_option('date_format') ); ?></span>           
                        </div>
                    </div>
                    <div class="post-social-right">
                        <a class="post-social-link" href="#"><i class="fa fa-heart-o"></i> <?php print nrgblog_get_post_likes( $post->ID );?> <?php esc_html_e( 'Likes', 'nrgblog' ); ?></a>
                        <a class="post-social-link" href="#"><i class="fa fa-comment-o"></i> <?php echo esc_html( $comments_count->total_comments );?> <?php esc_html_e( 'Comments', 'nrgblog' ); ?></a>
                    </div>
                </div>
            </div>
        </div>
    <?php break;
}
?>