<?php
/**
 *
 * Static posts.
 * @since 1.0.0
 *
 */
function nrgblog_static_post( $atts, $content = '', $id = '' ) {

    global $nrgblog;
    global $wp_query;
    extract( shortcode_atts( array(
        'cats'  => '',
        'style' => 'classic',
        'image' => '',
        'pager' => 'disable',
        'limit' => ''
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

    if( $pager == 'enable' ) {
        $paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
        $args['paged'] = $paged;
    }

    ob_start();

    $post = new WP_Query( $args );

    switch ( $style ) {
        case 'classic': ?>
            <div class="post-list">
                <?php
                if ( $post->have_posts() ) {
                    while ( $post->have_posts() ) : $post->the_post();
                        get_template_part( 'post-templates/post', $style );
                    endwhile;
                }
                ?>
            </div>
        <?php break;

        case 'high': ?>
            <div class="content-wrapper-content row">
                <div class="style-2 post-grid-wrapper three-collumn">
                    <?php if ( $post->have_posts() ) {
                        while ( $post->have_posts() ) : $post->the_post();
                            get_template_part( 'post-templates/post', $style );
                        endwhile;
                    } ?>
                </div>
            </div>
        <?php break;

        case 'columns': ?>
            <div class="content-wrapper-content row">
                <div class="style-2 post-grid-wrapper three-collumn">
                    <div>
                        <div class="post-block-wrapper">
                            <div class="isotope-grid">
                                <div class="grid-sizer col-mob-12 col-xs-6 col-md-4 col-lg-3"></div>
                                <?php if ( $post->have_posts() ) {
                                    while ( $post->have_posts() ) : $post->the_post();
                                        get_template_part( 'post-templates/post', $style );
                                    endwhile;
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php break;

        case 'square': ?>
            <div class="content-wrapper-content row">
                <?php if ( $post->have_posts() ) {
                    while ( $post->have_posts() ) : $post->the_post();
                        get_template_part( 'post-templates/post', $style );
                    endwhile;
                } ?>
            </div>
        <?php break;

        case 'modern': ?>
            <div class="content-wrapper-content spm row">
                <div class="isotope-grid">
                    <div class="grid-sizer col-md-2 col-xs-2 col-mob-2 col-lg-2"></div>
                    <?php if ( $post->have_posts() ) {
                        while ( $post->have_posts() ) : $post->the_post();
                            get_template_part( 'post-templates/post', $style );
                        endwhile;
                    } ?>
                </div>
            </div>
        <?php break;
    } 
    
    if( $pager == 'enable' ) { ?>
        <div>
            <div class="pagination clearfix simple-block cs-pager type-2">
                <?php 
                $big = 999999999;
                echo paginate_links( array(
                   'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                   'format'    => '?paged=%#%',
                   'current'   => max( 1, get_query_var('page') ),
                   'total'     => $post->max_num_pages,
                   'prev_text' => 'prev page',
                   'next_text' => 'next page'
                 ) ); 
                ?>
            </div>
        </div>
    <?php }
    wp_reset_query();

    return ob_get_clean();
}

add_shortcode( 'nrgblog_static_post', 'nrgblog_static_post' );
