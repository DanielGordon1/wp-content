<?php
/**
* Single post
*
* @package nrgblog
* @since 1.0
*
*/
global $nrgblog;
$content_width_class = ( $nrgblog['single_post_sidebar'] ) ? 8 : 12;
get_header();
while ( have_posts() ) : the_post();
    $comments_count = wp_count_comments( get_the_ID() );
    $post_categories = wp_get_post_categories( get_the_ID() );
    $cat = get_category( $post_categories[0] );
    $ajax_url = admin_url('admin-ajax.php');

    $post_options = get_post_meta( get_the_ID(), 'nrgblog_post_style', true );
    $meta_data = get_post_meta( get_the_ID(), 'nrgblog_post_options', true );
    if( isset( $meta_data['post_gallery_to_slider'] ) && $meta_data['post_gallery_to_slider'] != 'none' ) {
        nrgblog_kill_default_gallery();
    }
?>
        <div id="content-wrapper">
        <div class="container"> 
            <div class="content-wrapper-content big-block type-3">
                <div class="row">
                    <div  class="col-md-8 col-md-push-2">
                        <div class="page-titles">
                            <h1 class="title">
                                <?php the_title(); ?>
                            </h1>
                            <div class="links">
                                <a href="<?php echo esc_url( home_url( '/' ) );?>"><?php esc_html_e( 'Home', 'nrgblog' ); ?></a>
                                <span>—</span>
                                <a href="<?php echo esc_url( get_category_link( $cat->term_id ) );?>"><?php echo esc_html( $cat->name );?></a>
                                <span>—</span>
                                <a href="#"><?php the_title(); ?></a>
                            </div>
                        </div>
                        <div class="simple-article-block">
                            <div class="post-date">
                                <span class="date"><?php the_time( get_option('date_format') ); ?></span>
                                <a class="post-social-link like-it" data-url="<?php echo esc_html( $ajax_url ); ?>" data-post="<?php echo esc_html( $post->ID );?>" href="#"><i class="fa fa-heart-o"></i> <?php print nrgblog_get_post_likes( $post->ID );?> <?php esc_html_e( 'Likes', 'nrgblog' ); ?></a>
                                <a class="post-social-link" href="#comments-area" id="scroll-link"><i class="fa fa-comment-o"></i> <?php echo esc_html( $comments_count->total_comments );?> <?php esc_html_e( 'Comments', 'nrgblog' ); ?></a>
                            </div>
                            <div class="article-title">
                                <h2 class="title">
                                    <?php the_title(); ?>
                                </h2>
                            </div>
                            <div class="simple-article">
                                <?php the_content(); ?>
                            </div>
                        </div>
                        <div class="sm-widjet">
                            <h3 class="title-w">
                                <?php esc_html_e( 'tags', 'nrgblog' ); ?>
                            </h3>
                            <div class="tag-box">
                                <?php the_tags( '', '', '' );?>
                            </div>
                        </div>
                        <?php if( $post_options['post_next_prev'] ) { ?>
                        <div class="sm-widjet">
                            <div class="same-post">
                                <?php
                                $prev_post = get_previous_post();
                                if ( ! empty( $prev_post ) ) :
                                    $img_url = wp_get_attachment_url( get_post_thumbnail_id( $prev_post->ID ) );
                                    $post_categories = wp_get_post_categories( $prev_post->ID );
                                    $cat = get_category( $post_categories[0] );
                                    ?>
                                    <div class="left">
                                        <?php if ( has_post_thumbnail( $prev_post->ID ) ) { ?>
                                            <a href="<?php print get_permalink( $prev_post->ID ); ?>" class="img" style="background-image:url(<?php echo esc_attr( $img_url );?>);"></a>
                                        <?php } ?>
                                        <div class="content">
                                            <div class="post-date"><span class="date"><?php print get_the_time( get_option('date_format'), $prev_post->ID ); ?></span> / <a href="<?php echo esc_url( get_category_link( $cat->term_id ) );?>"><?php echo esc_html( $cat->name );?></a></div>
                                            <a href="<?php print get_permalink( $prev_post->ID ); ?>" class="title"><?php echo esc_html( $prev_post->post_title); ?></a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php
                                $next_post = get_next_post();
                                if ( ! empty( $next_post ) ) :
                                    $img_url = wp_get_attachment_url( get_post_thumbnail_id( $next_post->ID ) );
                                    $post_categories = wp_get_post_categories( $next_post->ID );
                                    $cat = get_category( $post_categories[0] );
                                    ?>
                                    <div class="right">
                                        <?php if ( has_post_thumbnail( $next_post->ID ) ) { ?>
                                            <a href="<?php print get_permalink( $next_post->ID ); ?>" class="img" style="background-image:url(<?php echo esc_attr( $img_url );?>);"></a>
                                        <?php } ?>
                                        <div class="content">
                                            <div class="post-date"><span class="date"><?php print get_the_time( get_option('date_format'), $next_post->ID ); ?></span> / <a href="<?php echo esc_url( get_category_link( $cat->term_id ) );?>"><?php echo esc_html( $cat->name );?></a></div>
                                            <a href="<?php print get_permalink( $next_post->ID ); ?>" class="title"><?php echo esc_html( $next_post->post_title); ?></a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php } ?>
                        <?php
                        if( $post_options['post_related'] ) {
                            $related = get_posts( array( 'category__in' => wp_get_post_categories( $post->ID ), 'numberposts' => 5, 'post__not_in' => array( $post->ID ) ) );
                            if( $related ) :
                                ?>
                                <div class="sm-widjet">
                                    <h3 class="title-w releated">
                                        <?php esc_html_e( 'releated posts', 'nrgblog' ); ?>
                                    </h3>
                                    <div class="swiper-container releated" data-autoplay="0" data-loop="1" data-speed="500" 
                                    data-center="0" data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="2" data-lg-slides="2" data-add-slides="2" >
                                        <div class="swiper-wrapper">
                                            <?php 
                                            foreach( $related as $post ) {
                                                $post_categories = wp_get_post_categories( $post->ID );
                                                $cat = get_category( $post_categories[0] );
                                                setup_postdata( $post ); ?>
                                                <div class="swiper-slide">
                                                    <div class="img-post type-2 small-post">
                                                        <div class="small-bg"></div>
                                                        <?php if ( has_post_thumbnail() ) { ?>
                                                            <?php $img_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>
                                                            <a href="<?php the_permalink() ?>" class="background-block">
                                                                <img src="<?php echo esc_attr( $img_url );?>" alt="" class="center-image">
                                                            </a>
                                                        <?php } else { ?>
                                                            <img src="<?php echo esc_attr( $nrgblog['default_post_image'] );?>" class="center-image">
                                                        <?php } ?>
                                                        <p>
                                                            <span class="about"><?php the_time( get_option( 'date_format' ) ); ?> / <?php echo esc_html( $cat->name );?></span>
                                                            <span class="description"><?php the_title(); ?></span>
                                                        </p>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="pagination style-2"></div>
                                    </div>
                                </div>
                            <?php endif;
                            wp_reset_postdata(); 
                        } ?>
                        <?php if ( comments_open() ) { ?>
                            <div class="comments sm-widjet" id="comments-area">
                                <?php comments_template( '', true ); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <?php if( $post_options['post_popular'] ) { ?>
                        <div class="col-sm-6 col-md-2 col-md-pull-8">
                            <div class="widjet text-l">
                                <div class="title-w">
                                    <?php esc_html_e( 'popular posts', 'nrgblog' ); ?>
                                </div>
                                <?php
                                $q = get_posts(
                                    array(  
                                            'numberposts'    => '2',
                                            'post_type'      => 'post',
                                            'order'          => 'DESC',
                                            'meta_key'       => 'post_views_likes',
                                            'post__not_in'   => array( get_the_ID( ) ),
                                            'orderby'        => 'meta_value_num',
                                        )
                                    ); 
                                foreach( $q as $popular ) {
                                    $post_categories = wp_get_post_categories( $popular->ID );
                                    $cat = get_category( $post_categories[0] );
                                    setup_postdata( $popular ); ?>
                                    <div class="blog-post style-6 type-r">
                                        <?php if ( has_post_thumbnail( $popular->ID ) ) { ?>
                                            <?php $img_url = wp_get_attachment_url( get_post_thumbnail_id( $popular->ID ) ); ?>
                                            <a href="<?php echo esc_url( get_post_permalink( $popular->ID ) ); ?>" class="img background-block">
                                                <img src="<?php echo esc_attr( $img_url );?>" alt="" class="center-image">
                                            </a>
                                        <?php } ?>
                                        <a href="<?php echo esc_attr( get_category_link( $cat->term_id ) );?>" class="tag-name post-date"><?php echo esc_html( $cat->name );?></a>
                                        <a href="<?php echo esc_url( get_post_permalink($popular->ID ) ); ?>" class="title"><?php echo get_the_title( $popular->ID ); ?></a>
                                    </div>
                                <?php } ?>
                                <?php wp_reset_postdata(); ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if( $post_options['post_recommend'] && ! empty( $post_options['post_recommend_list'] ) ) { ?>
                        <div class="col-sm-6 col-md-2">
                            <div class="widjet text-r">
                                <div class="title-w">
                                    <?php esc_html_e( 'we recommend', 'nrgblog' ); ?>
                                </div>
                                <?php 
                                foreach ($post_options['post_recommend_list'] as $id) {
                                    $post_categories = wp_get_post_categories( $id );
                                    $cat = get_category( $post_categories[0] );
                                    $post = get_post( $id ); ?>
                                    <div class="blog-post style-6 type-r ">
                                        <?php if ( has_post_thumbnail( $id ) ) { ?>
                                            <?php $img_url = wp_get_attachment_url( get_post_thumbnail_id( $id ) ); ?>
                                            <a href="<?php echo esc_url( get_post_permalink( $id) ); ?>" class="img background-block">
                                                <img src="<?php echo esc_attr( $img_url );?>" alt="" class="center-image">
                                            </a>
                                        <?php } ?>
                                        <a href="<?php echo esc_attr( get_category_link( $cat->term_id ) );?>" class="tag-name post-date"><?php echo esc_html( $cat->name );?></a>
                                        <a href="<?php echo esc_url( get_post_permalink( $id ) ); ?>" class="title"><?php echo esc_html( $post->post_title ); ?></a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; ?>
<?php get_footer(); ?>