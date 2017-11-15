<?php
/**
 * Index Page
 *
 * @package nrgblog
 * @since 1.0
 *
 */
global $nrgblog;
$case = ( ! empty( $nrgblog['blog_style'] ) ) ? $nrgblog['blog_style'] : 'classic';
get_header(); ?>
<div id="content-wrapper">
	<?php if ( have_posts() ) { ?>
	<?php
		switch ( $case ) {
			case 'classic': ?>
				<div class="content-wrapper-content big-block type-2">
           			<div class="container">
	           			<div class="row">
		           			<div class="col-md-9">
			           			<div class="post-list type-2">
				           			<?php while ( have_posts() ) : the_post(); ?>
				           				<?php get_template_part( 'post-templates/post', 'classic' ); ?>
				           			<?php endwhile;?>
			           			</div>
		           			</div>
		           			<div class="col-md-3">
	                            <?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar('sidebar') ); ?>
	                        </div>
	           			</div>
           			</div>
           		</div>
			<?php break;

			case 'high': ?>
				<div class="container">
					<div class="content-wrapper-content">
						<div class="simple-block style-2 post-grid-wrapper three-collumn">
	                		<div class="row high">
		                		<?php while ( have_posts() ) : the_post(); ?>
		                			<?php get_template_part( 'post-templates/post', $nrgblog['blog_style'] ); ?>
	                			<?php endwhile;?>
	                		</div>
	            		</div>
	            	</div>
	            </div>
			<?php break;
				
			case 'columns': ?>
				<div class="container">
					<div class="content-wrapper-content">
						<div class="simple-block">
							<div class="post-block-wrapper">
								<div class="isotope-grid row">
									<div class="grid-sizer col-mob-12 col-xs-6 col-md-4 col-lg-3"></div>
									<?php while ( have_posts() ) : the_post(); ?>
										<?php get_template_part( 'post-templates/post', $nrgblog['blog_style'] ); ?>
									<?php endwhile;?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php break;
				
			case 'square': ?>
				<div class="container">
					<div class="content-wrapper-content big-block">
						<div class="row">
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'post-templates/post', $nrgblog['blog_style'] ); ?>
							<?php endwhile;?>
						</div>
					</div>
				</div>
			<?php break;

			default: ?>
				<div class="content-wrapper-content big-block type-2">
           			<div class="container">
	           			<div class="row">
		           			<div class="col-md-9">
			           			<div class="post-list type-2">
				           			<?php while ( have_posts() ) : the_post(); ?>
				           				<?php get_template_part( 'post-templates/post', 'classic' ); ?>
				           			<?php endwhile;?>
			           			</div>
		           			</div>
		           			<div class="col-md-3">
	                            <?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar('sidebar') ); ?>
	                        </div>
	           			</div>
           			</div>
           		</div>
			<?php break;
		}
	} else { ?>
		<div class="empty-post-list">
            <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'nrgblog' ); ?></p>
            <?php get_search_form( true ); ?>
        </div>
    <?php } ?>
</div>
<div id="content"> 
	<div class="container">
		<?php 
        $paginate_links = paginate_links();
        if ( $paginate_links ) { ?>
            <div class="pagination clearfix simple-blocks">
                <?php print paginate_links( array( 'prev_text' => 'prev page', 'next_text' => 'next page' ) ); ?>
            </div>
        <?php } ?>
		<?php if( $nrgblog['slider_under_blog'] ) { ?>
		<div class="simple-block">
			<div class="post-grid-item style-3">
				<img class="center-image" src="<?php echo esc_attr( $nrgblog['slider_under_blog_bg'] );?>" alt="">
				<div class="swiper-container" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="1">
					<div class="swiper-wrapper">
						<?php
						$related = get_posts( array( 'numberposts' => $nrgblog['slider_under_blog_count'] ) );
						foreach( $related as $post ) {
							$comments_count = wp_count_comments( get_the_ID() );
							?>
							<div class="swiper-slide"> 
								<div class="post-date"><?php the_time( get_option( 'date_format' ) ); ?></div>
								<h2 class="post-name"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
								<div class="post-social post-social-center">
		 							<span class="post-social-link"><i class="fa fa-heart-o"></i> <?php print nrgblog_get_post_likes( $post->ID );?> <?php esc_html_e( 'Likes', 'nrgblog' ); ?></span>
									<span class="post-social-link"><i class="fa fa-comment-o"></i> <?php echo esc_html( $comments_count->total_comments );?> <?php esc_html_e( 'Comments', 'nrgblog' ); ?></span>
								</div>
							</div>
						<?php } ?>
						<?php wp_reset_postdata(); ?>
					</div>
					<div class="pagination style-1"></div>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>
<?php get_footer(); ?>
