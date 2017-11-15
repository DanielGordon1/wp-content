<?php
/**
* Single post
*
* @package nrgblog
* @since 1.0
*
*/
global $nrgblog;
get_header();
while ( have_posts() ) : the_post();
    $comments_count = wp_count_comments( get_the_ID() );
    $content = get_the_content();
    if ( ! stristr( $content, 'vc_' ) ) {
        ?>
        <div class="container"> 
            <div class="content-wrapper-content big-block type-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="simple-article-block pt">
                            <div class="article-title">
                                <h2 class="title">
                                    <?php the_title(); ?>
                                </h2>
                            </div>
                            <div class="post-date">
                                <span class="date"><?php the_time( get_option('date_format') );?></span>
                                <a class="post-social-link" href="#">
                                    <i class="fa fa-comment-o"></i> 
                                    <?php echo esc_html( $comments_count->total_comments );?> 
                                    <?php esc_html_e( 'Comments', 'nrgblog' ); ?>
                                </a>
                            </div>
                            <div class="simple-article">
                                <?php the_content(); ?>
                            </div>
                        </div>
                        <?php if ( comments_open() ) { ?>
                            <div class="comments sm-widjet" id="comments-area">
                                <?php comments_template( '', true ); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div id="content-wrapper">
            <div class="container">
                <?php the_content(); ?>
            </div>
        </div>
    <?php } ?>
<?php endwhile; ?>
<?php get_footer(); ?>