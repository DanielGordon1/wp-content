<?php
/**
 *
 * Static posts list.
 * @since 1.0.0
 *
 */
function nrgblog_static_post_lists( $atts, $content = '', $id = '' ) {

    extract( shortcode_atts( array(
        'cats'  => '',
        'style' => 'style1',
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
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
        $args['paged'] = $paged;
    }

    ob_start();

    $post = new WP_Query( $args );

    if ( $post->have_posts() ) {
        while ( $post->have_posts() ) : $post->the_post();
            get_template_part( 'post-templates/list', $style );
        endwhile;
    }

    if( $pager == 'enable' ) { ?>
        <div class="pagination clearfix simple-blocks cs-pager type-2">
            <?php 
            $big = 999999999;
            echo paginate_links( array(
                   'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                   'format'    => '?paged=%#%',
                   'current'   => max( 1, get_query_var('paged') ),
                   'total'     => $post->max_num_pages,
                   'prev_text' => 'prev page',
                   'next_text' => 'next page'
                ) ); 
            ?>
        </div>
    <?php }
    wp_reset_query();

    return ob_get_clean();
}
add_shortcode( 'nrgblog_static_post_lists', 'nrgblog_static_post_lists' );