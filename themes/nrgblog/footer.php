<?php
/**
 *
 * Footer
 * @since 1.0.0
 * @version 1.0.0
 *
 */
global $nrgblog;
$footer = ( ! empty( $nrgblog['footer_style'] ) ) ? $nrgblog['footer_style'] : 'classic';
if ( is_page() ) {
  $meta_data = get_post_meta( get_the_ID(), 'nrgblog_page', true );
  $footer = ( isset( $meta_data['page_footer'] ) && $meta_data['page_footer'] != 'default' ) ? $meta_data['page_footer'] : $footer;
}
?>
    	<!-- FOOTER -->
    <?php if( $footer == 'classic' ) { ?>
    	<footer class="footer style-2">
	        <div class="container">
	            <?php nrgblog_footer_menu( $nrgblog['footer_menu'] );?>
	            <?php nrgblog_footer_social( $nrgblog['footer_social'] );?>
	        </div>
	        <?php if( isset( $nrgblog['footer_gallery_style'] ) && $nrgblog['footer_gallery_style'] != 'none' ) { ?>
		        <?php if( $nrgblog['footer_gallery_style'] == 'instagram' && is_numeric( $nrgblog['footer_instagram_count_items'] ) && $nrgblog['footer_instagram_count_items'] > 0 ) { ?>
		        	<?php nrgblog_footer_intagram_gallery( $nrgblog['footer_instagram_count_items'] );?>
	        	<?php } ?>
		        <?php if( $nrgblog['footer_gallery_style'] == 'custom' && ! empty( $nrgblog['footer_custom_gallery'] ) ) { ?>
		        	<?php nrgblog_footer_custom_gallery( $nrgblog['footer_custom_gallery'] );?>
	        	<?php } ?>
	        <?php } ?> 
	    </footer>
	<?php } else { ?>
		<footer class="footer style-3">
	        <div class="container">
	            <div class="row">
	                <div class="col-xs-12 col-sm-3">
	                	<?php if( is_active_sidebar( 'first-footer-sidebar' ) ) { ?>
	                		<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar('first-footer-sidebar') ); ?>
	                	<?php } ?>
	                </div>
	                <div class="col-xs-12 col-sm-3">
	                	<?php if( is_active_sidebar( 'second-footer-sidebar' ) ) { ?>
	                		<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar('second-footer-sidebar') ); ?>
	                	<?php } ?>
	                </div>

	                <div class="col-xs-12 col-sm-3">
	                	<?php if( is_active_sidebar( 'third-footer-sidebar' ) ) { ?>
	                		<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar('third-footer-sidebar') ); ?>
	                	<?php } ?>
	                </div>

	                <div class="col-xs-12 col-sm-3">
	                	<?php if( is_active_sidebar( 'fourth-footer-sidebar' ) ) { ?>
	                		<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar('fourth-footer-sidebar') ); ?>
	                	<?php } ?>
	                </div>
	            </div>
		        <div class="row copyright">
	            	<?php if( ! empty( $nrgblog['modern_footer_copyright'] ) ) { ?>
		            	<div class="col-md-12">
		            		<?php echo esc_html( $nrgblog['modern_footer_copyright'] );?>
		            	</div>
	            	<?php } ?>
		        </div>
	        </div>
	    </footer>
	<?php } ?>
	    <?php if( $nrgblog['search_form'] ) { ?>
		    <!-- search popup -->
		    <div class="search-popup popup search-block">
		        <div class="title"><?php echo esc_html( $nrgblog['search_form_title'] ); ?></div>
		        <form action="<?php echo esc_url( home_url( '/' ) );?>" method="get">
		            <input type="text" placeholder="<?php esc_html_e( 'Search...', 'nrgblog' ); ?>" required="" name="s">
		            <div class="h-search"><i class="fa fa-search"></i>
		                <input type="submit">
		            </div>   
		        </form>
		        <button class="close"><i class="fa fa-times"></i></button>
		    </div>
		    <div class="popup-bg popup">
		    </div>
	    <?php } ?>
        <div class="video-popup popup">
            <div class="embed-responsive embed-responsive-16by9 video">
                <iframe class="embed-responsive-item"> </iframe>
            </div>
            <button class="close"><i class="fa fa-times"></i></button>
        </div>

        <div class="modal-popup">
		    <div class="modal-overflow">
		        <div class="close-layer"></div>
			    <div class="modal-table">
			        <div class="modal-cell">
				        <div class="modal-popup-content">
			                <img src="#" alt="">
			                <a class="close-button">+</a>
		                </div>  
	                </div>
			    </div>
			</div>
		</div>
	   	<?php wp_footer(); ?>
	</body>
</html>