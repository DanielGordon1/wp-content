<?php
/**
*
* Animated post.
* @since 1.0.0
*
*/
function nrgblog_animated_post( $atts, $content = '', $id = '' ) {

    global $nrgblog;
    extract( shortcode_atts( array(
        'cats'  => '',
        'style' => 'carrousel',
        'limit' => '',
        'image' => ''
        ), $atts ) );

    $category = '';
    $limit = ( empty( $limit ) || ! is_numeric( $limit ) ) ? 6 : $limit;
    
    // Blog by category.
    if ( ! empty( $cats) ) {
        $category = array(
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => explode( ',', $cats )
        );
    }

    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $limit,
        'tax_query'      => array(
            $category
        )
    );
    ob_start();
    $post = new WP_Query( $args );

    switch ( $style ) {
        case 'carrousel': ?>
            <div class="style-2">
                <div class="post-round-slider">
                    <div class="swiper-container" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="3" data-lg-slides="4" data-add-slides="4">
                        <div class="swiper-wrapper">
                            <?php
                            if ( $post->have_posts() ) {
                                while ( $post->have_posts() ) : $post->the_post();
                                    get_template_part( 'post-templates/post', $style );
                                endwhile;
                            }
                            ?>
                        </div>
                        <div class="pagination"></div>
                        <div class="swiper-arrow-left"><i class="fa fa-caret-left"></i></div>
                        <div class="swiper-arrow-right"><i class="fa fa-caret-right"></i></div>
                    </div>
                </div>
            </div>
        <?php break;

        case 'slider_squared': ?>
            <div class="content-wrapper-content type-2">
                <div class="swiper-container link-slider big-block" data-autoplay="0" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="4" data-md-slides="5" data-lg-slides="6" data-add-slides="6">
                    <div class="swiper-wrapper">
                        <?php
                        if ( $post->have_posts() ) {
                            while ( $post->have_posts() ) : $post->the_post();
                                get_template_part( 'post-templates/post', $style );
                            endwhile;
                        }
                        ?>
                    </div>
                    <div class="pagination hide"></div>
                </div>
            </div>
        <?php break;
        
        case 'modern_slider': 
            $image = ( ! empty( $image ) ) ? wp_get_attachment_url( $image ) : $nrgblog['slider_under_blog_bg']; ?>
            <div class="content-wrapper-content type-2">
                <div class="big-slider big-block">
                    <img class="center-image" src="<?php echo esc_attr( $image );?>" alt="">
                    <div class="bg-vs"></div>
                    <div class="swiper-container " data-autoplay="0" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1">
                        <div class="swiper-wrapper">
                            <?php
                            if ( $post->have_posts() ) {
                                while ( $post->have_posts() ) : $post->the_post();
                                    get_template_part( 'post-templates/post', $style );
                                endwhile;
                            }
                            ?>
                        </div>
                        <div class="pagination style-1"></div>
                    </div>
                </div>
            </div>
        <?php break;
        
        case 'slider': ?>
            <div class="content-wrapper-content row">
                <div class="main-post-slider type-2 small-post col-md-12">
                    <div class="swiper-container" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="1">
                        <div class="swiper-wrapper">
                        <?php
                        if ( $post->have_posts() ) {
                            while ( $post->have_posts() ) : $post->the_post();
                                get_template_part( 'post-templates/post', $style );
                            endwhile;
                        }
                        ?>
                        </div>
                        <div class="pagination"></div>
                        <div class="swiper-arrow-left type-2"></div>
                        <div class="swiper-arrow-right type-2"></div>
                    </div>
                </div>
            </div>
        <?php break;        
        case 'designed': 
            $image = ( ! empty( $image ) ) ? wp_get_attachment_url( $image ) : $nrgblog['slider_under_blog_bg']; ?>
            <div class="post-grid-item style-3">
                <img class="center-image" src="<?php echo esc_attr( $image );?>" alt="">
                <div class="swiper-container" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="1">
                    <div class="swiper-wrapper">
                        <?php
                        if ( $post->have_posts() ) {
                            while ( $post->have_posts() ) : $post->the_post();
                                get_template_part( 'post-templates/post', $style );
                            endwhile;
                        }
                        ?>
                    </div>
                    <div class="pagination style-1"></div>
                </div>
            </div>
        <?php break;
    }

    wp_reset_query();
    return ob_get_clean();
}

add_shortcode( 'nrgblog_animated_post', 'nrgblog_animated_post' );
