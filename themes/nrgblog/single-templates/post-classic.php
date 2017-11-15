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
$single_post_sidebar = $nrgblog['single_post_sidebar'];
get_header();
while ( have_posts() ) : the_post();

    $comments_count = wp_count_comments( get_the_ID() );
    $post_categories = wp_get_post_categories( get_the_ID() );
    $cat = get_category( $post_categories[0] );
    $ajax_url = admin_url('admin-ajax.php');

    $meta_data = get_post_meta( get_the_ID(), 'nrgblog_post_options', true );
    
    $post_style = get_post_meta( get_the_ID(), 'nrgblog_post_style', true );
    if( isset( $post_style['post_sidebar'] ) && $post_style['post_sidebar'] == false ) {
        $content_width_class = 12;
        $single_post_sidebar = false;
    }
    
    if( isset( $meta_data['post_gallery_to_slider'] ) && $meta_data['post_gallery_to_slider'] !== 'none' ) {
        nrgblog_kill_default_gallery();
    }
?>
    <div id="content-wrapper">
        <div class="container"> 
            <div class="content-wrapper-content big-block type-3">
                <?php if( $nrgblog['single_post_breadcrumbs']) { ?>
                    <div class="page-titles">
                        <h1 class="title">
                            <?php echo esc_html( $cat->name );?>
                        </h1>
                        <div class="links">
                            <a href="<?php echo esc_url( home_url( '/' ) );?>"><?php esc_html_e( 'Home', 'nrgblog' ); ?></a>
                            <span>-</span>
                            <a href="<?php echo esc_url( get_category_link( $cat->term_id ) );?>"><?php echo esc_html( $cat->name );?></a>
                            <span>-</span>
                            <a href="#"><?php the_title(); ?></a>
                        </div>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-<?php echo esc_attr( $content_width_class );?>">
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
                            <div class="simple-article post-type-<?php echo get_post_format( $post->ID ); ?>">
                                <?php the_content(); ?>
                                <?php wp_link_pages('before=<div class="post-nav"> <span>' . esc_html__( "Page:", "bodo" ) . ' </span> &after=</div>'); ?>
                            </div>
                        </div>
                        <?php if( has_tag() ) { ?>
                            <div class="sm-widjet">
                                <h3 class="title-w">
                                    <?php esc_html_e( 'tags', 'nrgblog' ); ?>
                                </h3>
                                <div class="tag-box">
                                    <?php the_tags( '', '', '' );?>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="sm-widjet">
                            <h3 class="title-w">
                                <?php esc_html_e( 'Catregory', 'nrgblog' ); ?>
                            </h3>
                            <div class="tag-box category-list">
                                <?php the_category( '' );?>
                            </div>
                        </div>
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
                        <?php
                        $related = get_posts( array( 'category__in' => wp_get_post_categories( $post->ID ), 'numberposts' => 3, 'post__not_in' => array( $post->ID ) ) );
                        if( $related ) :
                        ?>
                            <div class="sm-widjet">
                                <h3 class="title-w releated">
                                    <?php esc_html_e( 'releated posts', 'nrgblog' ); ?>
                                </h3>
                                <div class="row">
                                    <?php
                                    foreach( $related as $post ) {
                                        $post_categories = wp_get_post_categories( $post->ID );
                                        $cat = get_category( $post_categories[0] );
                                        setup_postdata( $post ); ?>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="r-post">
                                                <div class="blog-post style-6">
                                                <?php if ( has_post_thumbnail() ) { ?>
                                                    <?php $img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
                                                    <a href="<?php the_permalink() ?>" class="img background-block" style="background-image: url(<?php echo esc_attr( $img_url );?>);">
                                                        <img src="<?php echo esc_attr( $img_url );?>" class="center-image" alt="<?php the_title(); ?>" style="display: none;">
                                                    </a>
                                                <?php } ?>
                                                    <a href="<?php echo esc_url( get_category_link( $cat->term_id ) );?>" rel="category tag"><?php echo esc_html( $cat->name );?></a>
                                                    <a href="<?php the_permalink() ?>" class="title"><?php the_title(); ?></a>
                                                    <div class="about post-date">
                                                        <span class="date"><?php the_time( get_option( 'date_format' ) ); ?></span>
                                                            <?php esc_html_e( 'by', 'nrgblog' ); ?>
                                                        <a href="<?php print get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="author">
                                                            <?php the_author(); ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php endif;
                        wp_reset_postdata(); ?>
                        <?php if ( comments_open() ) { ?>
                            <div class="comments sm-widjet" id="comments-area">
                                <?php comments_template( '', true ); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <?php if( $single_post_sidebar ) { ?>
                        <div class="col-md-3 col-md-push-1">
                            <?php if( is_active_sidebar( 'sidebar' ) ) { ?>
                                <?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar('sidebar') ); ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; ?>
<?php get_footer(); ?>