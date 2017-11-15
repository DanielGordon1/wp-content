<?php
/**
 * Requried functions for theme backend.
 *
 * @package nrgblog
 * @subpackage Template
 */

/**
 *
 * Helper Functions
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( !function_exists( 'nrgblog_get_options' ) ) {
  function nrgblog_get_options() {
    global $nrgblog;
    $nrgblog = apply_filters( 'cs_get_option', get_option( CS_OPTION ) );
  }
  add_action( 'wp', 'nrgblog_get_options' );
}

/**
 *
 * Create custom html structure for comments
 *
 */
function nrgblog_comment( $comment, $args, $depth ) {

  $GLOBALS['comment'] = $comment;

  $reply_class = ( $comment->comment_parent ) ? 'indented' : '';
  switch ( $comment->comment_type ):
    case 'pingback':
    case 'trackback':
      ?>
        <div class="pingback">
          <?php esc_html_e( 'Pingback:', 'nrgblog' ); ?> <?php comment_author_link(); ?>
          <?php edit_comment_link( esc_html__( '(Edit)', 'nrgblog' ), '<span class="edit-link">', '</span>' ); ?>
        </div>
      <?php
      break;
    default:
      // generate comments
      ?>
        <li <?php comment_class('ct-part'); ?> id="li-comment-<?php comment_ID(); ?>">
        <div id="comment-<?php comment_ID(); ?>">
          <a href="#" class="img">
            <?php print get_avatar( $comment, 70,'','', array( 'class' => 'comment-img' ) ); ?>
          </a>
          <div class="content">
            <a href="#" class="author">
              <?php comment_author(); ?>
            </a>
            <div class="post-date">
              <?php comment_date( get_option('date_format') );?>
            </div>
            <div class="text">
              <?php comment_text(); ?>
            </div>
            <?php
              comment_reply_link(
                array_merge( $args,
                  array(
                    'reply_text' => esc_html__( 'Reply', 'nrgblog' ),
                    'after' => '',
                    'depth' => $depth,
                    'max_depth' => $args['max_depth']
                  )
                )
              );
            ?>
          </div>
        </div>
       
      <?php
      break;
  endswitch;
}

/*
 * Get site menu.
 */

function nrgblog_site_menu( $option ) {
  if( $option == 'classic' ) {
    $output  = '<nav class="main-nav">';
    $output .= nrgblog_custom_menu( 'left-menu' );
    $output .= '</nav>';
    $output .= '<nav class="sub-nav">';
    $output .= nrgblog_custom_menu( 'right-menu' );
    $output .= '</nav>';
  } else {
    $output  = '<nav class="main-nav">';
    $output .= nrgblog_custom_menu( 'left-menu' );
    $output .= nrgblog_custom_menu( 'right-menu' );
    $output .= '</nav>';
    if ( has_nav_menu( 'dd-menu' ) ) {
      $output .= '<button class="small-menu-btn"><span></span></button>';
      $output .= '<nav class="sub-nav ddm">';
      $output .= nrgblog_custom_menu( 'dd-menu' );
      $output .= '</nav>';
    }
  }
  print $output;
}

/*
 * Return munus list.
 */
function nrgblog_menus_list() {
  $menus = get_terms('nav_menu');
  $list = array( 'none' => 'Select menu');
  foreach ( $menus as $value ) {
    $list[$value->term_id] = $value->name;
  }
  return $list;
}

/*
 * Build footer menu.
 */
function nrgblog_footer_menu( $menu_id ) {
  if( $menu_id != 'none' ) {
    $menu_items = wp_get_nav_menu_items( $menu_id );
    if( ! empty( $menu_items ) && $menu_items ) {
      $output  = '<div class="footer-left">';
      $output .= '<ul class="footer-nav">';
      foreach ( $menu_items as $item ) {
        $output .= '<li><a href="' . $item->url . '">' . $item->title . '</a></li>';
      }
      $output .= '</ul>';
      $output .= '</div>';
      print $output;    
    }
  }
}

/*
 * Footer social items.
 */
function nrgblog_footer_social( $social_items ) {
  if ( ! empty( $social_items ) ) {
    $output  = '<div class="footer-right">';
    $output .= '<div class="footer-social">';
    foreach ( $social_items as $link ) {
      $output .= '<a href="' . $link['footer_social_link'] . '"><i class="' . $link['footer_social_icon'] . '"></i></a>';
    }
    $output .= '</div>';
    $output .= '</div>';
    print $output;
  }
}

/**
 * Return @count last photos from Instagram.
 * @resolution - thumbnail (150 x 150), low_resolution (320 x 320), standard_resolution (640 x 640).
 */
function nrgblog_get_instagram_photos( $count = 1 ) {
  if ( ! file_exists( ABSPATH . 'wp-content/plugins/nrgblog-plugins/lib/instagram.class.php' ) ) {
    return false;
  }

  //global $nrgblog;
  $nrgblog = apply_filters( 'cs_get_option', get_option( CS_OPTION ) );
  require_once ABSPATH . 'wp-content/plugins/nrgblog-plugins/lib/instagram.class.php';
  
  $config = array(
      'apiKey'      => $nrgblog['instagram_api_key'],
      'apiSecret'   => '',
      'apiCallback' => ''
  );

  $instagram = new Instagram( $config );

  // Get user data
  $user = $instagram->searchUser( $nrgblog['instagram_user_name'], 1 );

  // Get user media by user id
  $media = $instagram->getUserMedia( $user->data[0]->id, $count );

  return $media->data;
}

/**
 * Create footer Instagram gallery.
 */
function nrgblog_footer_intagram_gallery( $count ) {
  global $nrgblog;
  if( ! empty( $nrgblog['instagram_user_name']) && ! empty( $nrgblog['instagram_api_key'] ) ) {
    $ajax_url = admin_url('admin-ajax.php');

    $output  = '<div id="footer_intagram_gallery" data-url="' . $ajax_url . '" data-count="' . $count . '">';
    $output .= '<div class="inst"> <div></div> </div>';
    $output .= '</div>';

    print $output;
  } else {
    esc_html_e( 'Intagram API key and user name are Required! Please set this values in Theme Options.', 'nrgblog' );
  }

}

/**
 * Create custom footer gallery.
 */
function nrgblog_footer_custom_gallery( $items ) {
  $output  = '<div class="footer-slider">';
  $output .= '<div class="swiper-container" data-autoplay="0" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="auto">';
  $output .= '<div class="swiper-wrapper">';
  foreach( $items as $item ) {
    $url = ( is_numeric( $item['footer_gallery_image'] ) && ! empty( $item['footer_gallery_image'] ) ) ? wp_get_attachment_url( $item['footer_gallery_image'] ) : '';
    $output .= '<div class="swiper-slide open-modal-popup active" data-val="0" data-src="' . $url . '">';
    $output .= '<a href="#"><img height="160" class="img-responsive img-full" src="' . $url . '" alt=""></a>';
    $output .= '</div>';
  }
  $output .= '<div class="pagination"></div>';
  $output .= '<div class="swiper-arrow-left"><i class="fa fa-caret-left"></i></div>';
  $output .= '<div class="swiper-arrow-right"><i class="fa fa-caret-right"></i></div>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';
  print $output;
}

/*
 * MailChimp Subscribe function.
 */
function nrgblog_subscribe_user() {
    if( !isset( $_POST['code_nonce'] ) || ! wp_verify_nonce( $_POST['code_nonce'], 'nrgblog' ) ) {
      die( esc_html__( 'Permission denied', 'nrgblog' ) );
    }

    $email = $_POST['email'];

    if( ! $email ) {
      esc_html_e( 'No email address provided.', 'nrgblog' );
    }

    if( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
      esc_html_e( 'Email address is invalid.', 'nrgblog' );
      wp_die();
    }

    $mailchimp_api_key = cs_get_option('mailchimp_api_key');
    $mailchimp_list_id = cs_get_option('mailchimp_list_id');
    $mailchimp_success = cs_get_option('mailchimp_success');

    require_once ABSPATH . 'wp-content/plugins/nrgblog-plugins/lib/MCAPI.class.php';

    $api = new MCAPI( $mailchimp_api_key );
    
    if( $api->listSubscribe( $mailchimp_list_id, $email ) === true ) {
      print $mailchimp_success;
    } else {
      print esc_html( 'Error: ', 'nrgblog' ) . $api->errorMessage;
    }
    wp_die();
}
add_action( 'wp_ajax_nrgblog_subscribe_user', 'nrgblog_subscribe_user' );
add_action( 'wp_ajax_nopriv_nrgblog_subscribe_user', 'nrgblog_subscribe_user' );

/*
 * Show count post likes.
 */
function nrgblog_get_post_likes( $postID ) {
  $count_key = 'post_views_likes';
  $count = get_post_meta( $postID, $count_key, true );
  if( $count == '' ){
    delete_post_meta( $postID, $count_key );
    add_post_meta( $postID, $count_key, '0' );
    return "0";
  }
  return $count;
}

/*
 * Show count likes in admin panel.
 */
function nrgblog_add_meta_box() {
  add_meta_box( 'post_views_likes', 'Post likes', 'nrgblog_view_meta_box', 'post', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'nrgblog_add_meta_box' );

/*
 * Show count likes form in admin panel.
 */
function nrgblog_view_meta_box() {
  global $post;
  $values = get_post_custom( $post->ID );

  $post_views_likes = isset( $values['post_views_likes'] ) ? esc_attr( $values['post_views_likes'][0] ) : '';
  ?>
    <label for="post_views_likes"><?php esc_html_e( 'Coutn likes', 'nrgblog' ); ?></label>
    <input type="text" name="post_views_likes" id="post_views_likes" value="<?php echo $post_views_likes; ?>" />
  <?php  
}

/*
 * Save count likes in admin panel.
 */
function nrgblog_meta_box_save( $post_id ) {
    if( isset( $_POST['post_views_likes'] ) ) {
      update_post_meta( $post_id, 'post_views_likes', $_POST['post_views_likes'] );
    }
}
add_action( 'save_post', 'nrgblog_meta_box_save' );

/*
 * Make like.
 */
function nrgblog_post_like() {
  $post_id = $_POST['id'];
  $count = get_post_meta( $post_id, 'post_views_likes', true );
  $likes = array();

  if( ! empty( $_COOKIE['likes'] ) ) {
    $likes = explode( ',', rawurldecode($_COOKIE['likes']) );
  }

  if( ! in_array($post_id, $likes) ) {
    $count++;
    update_post_meta( $post_id, 'post_views_likes', $count );
    $cookie = ( isset( $_COOKIE['likes'] ) ) ? $_COOKIE['likes'] . ',' . $post_id : $post_id;
    setcookie( 'likes', $cookie, time()+60*60*24*30, '/' );
  }
  print '<i class="fa fa-heart-o"></i> ' . $count . ' ' . esc_html__( 'Likes', 'nrgblog' );
  wp_die();
}
add_action( 'wp_ajax_nrgblog_post_like', 'nrgblog_post_like' );
add_action( 'wp_ajax_nopriv_nrgblog_post_like', 'nrgblog_post_like' );

// Custom filter function to modify default gallery shortcode output
function nrgblog_gallery_to_slider( $atts, $content = '', $id = '' ) {
  $meta_data = get_post_meta( get_the_ID(), 'nrgblog_post_style', true );
  $post_gallery_type = get_post_meta( get_the_ID(), 'nrgblog_post_options', true );
  $post_style = ( ! empty( $meta_data['post_style'] ) ) ? $meta_data['post_style'] : 'classic'; 

  extract( shortcode_atts( array(
    'ids' => ''
  ), $atts ) );
  $ids = explode( ',', $ids );

  if( $post_gallery_type['post_gallery_to_slider'] == 'slider' || ! in_array( $post_gallery_type['post_gallery_to_slider'], array('slider', 'popup')) ) {
    if( $post_style == 'classic' ) {
      $output = '<div class="swiper-container" data-autoplay="0" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1">';
      $output .= '<div class="swiper-wrapper">';
      foreach ( $ids as $id ) {
        $img_url = wp_get_attachment_url( $id );
        $output .= '<div class="swiper-slide">';
        $output .= '<img src="' . $img_url . '" alt="">';
        $output .= '</div>';
      }
      $output .= '</div>';
      $output .= '<div class="pagination style-1"></div>';
      $output .= '</div>';
    } else {
      $output  = '<div class="large-sliders">';
      $output .= '<div class="swiper-container thumbnails" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="responsive" data-xs-slides="3" data-sm-slides="5" data-md-slides="5" data-lg-slides="7" data-add-slides="7">';
      $output .= '<div class="swiper-wrapper">';
      $i = 0;
      foreach ( $ids as $id ) {
        $img_url = wp_get_attachment_url( $id );
        $current = ( $i == 0 ) ? 'current' : '';
        $output .= '<div class="swiper-slide ' . $current . ' active" data-val="' . $i . '">';
        $output .= '<img src="' . $img_url . '" class="center-image" alt="">';
        $output .= '</div>';
        $i++;
      }
      $output .= '</div>';
      $output .= '<div class="pagination hidden"></div>';
      $output .= '</div>';
      $output .= '<div class="swiper-container thumbnails-preview" data-autoplay="0" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1">';
      $output .= '<div class="swiper-wrapper">';
      $i = 0;
      foreach ( $ids as $id ) {
        $img_url = wp_get_attachment_url( $id );
        $output .= '<div class="swiper-slide active" data-val="' . $i . '">';
        $output .= '<img class="img-responsive img-full" src="' . $img_url . '" alt="">';
        $output .= '</div>';
        $i++; 
      }
      $output .= '</div>';
      $output .= '<div class="pagination hidden"></div>';
      $output .= '</div>';
      $output .= '</div>';
    }
  } else {
    $output  = '<div class="post-custom-gallery isotope-grid">';
    $output .= '<div class="grid-sizer blog-list"></div>';
    foreach ( $ids as $id ) {
      $img_url = wp_get_attachment_url( $id );
      $output .= '<div class="isotope-item custom-gallery">';
      $output .= '<a href="#" class="open-modal-popup" data-src="' . $img_url . '">';
      $output .= '<img class="img-responsive img-full" src="' . $img_url . '" alt="">';
      $output .= '</a>';
      $output .= '</div>';
    }
    $output .= '</div>';
  }
  return $output;
} 

function nrgblog_kill_default_gallery() {
  remove_shortcode('gallery');
  $create_new_shortcode = 'add' . '_' . 'shortcode';
  $create_new_shortcode('gallery', 'nrgblog_gallery_to_slider');
}

function nrblog_wp_link_pages() {
  get_post_format();
}

if( ! function_exists('nrgblog_enqueue') ) {
  function nrgblog_enqueue() {
    if ( function_exists('wp_enqueue_media') ) {
      wp_enqueue_media();
    } else {
      wp_enqueue_style('thickbox');
      wp_enqueue_script('media-upload');
      wp_enqueue_script('thickbox');
      }
      wp_enqueue_script('YVP_jq');
  }
  add_action('admin_enqueue_scripts', 'nrgblog_enqueue');
}

// add scripts for widget categories
if( ! function_exists('nrgblog_add_widget_script') ) {
  function nrgblog_add_widget_script() {
      echo '<script>
         jQuery(\'.custom_media_upload\').click(function() {
             var send_attachment_bkp = wp.media.editor.send.attachment;
             wp.media.editor.send.attachment = function(props, attachment) {
                 jQuery(\'.custom_media_url\').val(attachment.url);
                 wp.media.editor.send.attachment = send_attachment_bkp;
             }
             wp.media.editor.open();
             window.send_to_editor = function (html) {
                 jQuery("#xls-uploader-input").val(attachment.url);
                 tb_remove();
             };
             return false;
         });
      </script>';
  }
  add_action('admin_footer', 'nrgblog_add_widget_script');
}

/**
 * Helper function for getting twitts.
 */
function nrgblog_get_twitts( $count_twitts = 2 ) {
  if ( ! file_exists( ABSPATH . 'wp-content/plugins/nrgblog-plugins/lib/TwitterApi.php' ) ) {
    return false;
  }
  global $nrgblog;
  require_once ABSPATH . 'wp-content/plugins/nrgblog-plugins/lib/TwitterApi.php';

  $config = array(
    'api_key'    => $nrgblog['twitter_api_key'],
    'api_secret' => $nrgblog['twitter_api_secret']
  );

  $twitterApi = new Tang\TwitterRestApi\TwitterApi( $config );

  $twitterApi->authenticate();

  $data = $twitterApi->get('statuses/user_timeline', array(
      'screen_name'     => $nrgblog['twitter_user_name'],
      'count'           => $count_twitts,
      'exclude_replies' => true
  ), true);

  return $data;
}

/**
 * Helper function for converting date to format "time ago".
 */
function nrgblog_time_elapsed_string( $time ) {
  $etime = time() - $time;

  if ( $etime < 1 ) {
    return '0 seconds';
  }

  $a = array( 365 * 24 * 60 * 60  =>  'year',
              30  * 24 * 60 * 60  =>  'month',
                    24 * 60 * 60  =>  'day',
                         60 * 60  =>  'hour',
                              60  =>  'minute',
                               1  =>  'second'
                );
  $a_plural = array( 'year'   => esc_html__( 'years', 'nrgblog' ),
                     'month'  => esc_html__( 'months', 'nrgblog' ),
                     'day'    => esc_html__( 'days', 'nrgblog' ),
                     'hour'   => esc_html__( 'hours', 'nrgblog' ),
                     'minute' => esc_html__( 'minutes', 'nrgblog' ),
                     'second' => esc_html__( 'seconds', 'nrgblog' )
              );

  foreach ( $a as $secs => $str ) {
    $d = $etime / $secs;
    if ( $d >= 1 ) {
      $r = round($d);
      return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ' . esc_html__( 'ago', 'nrgblog' );
    }
  }
}

/**
 *
 * Get categories for shortcode.
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function nrgblog_element_values() {

  $args = array(
    'type'     => 'post',
    'taxonomy' => 'category'
  ); 

  $categories = get_categories( $args );
  $list = array();

  foreach ( $categories as $category ) {
    $list[$category->name] = $category->slug;
  }
  return $list;
}

function nrgblog_excerpt_more( $more ) {
  return '';
}
add_filter('excerpt_more', 'nrgblog_excerpt_more');

function nrgblog_get_all_posts() {
  $posts = get_posts( array( 'posts_per_page' => -1, 'post_type' => 'post' ) );
  $options = array();
  foreach ( $posts as $post ) {
    $options[$post->ID] = $post->post_title;
  }
  return $options;
}

/*
 * Instagram helper function.
 */
function ngrblog_instagram_helper(){

    $count = $_POST['count'];
    $place = $_POST['place'];

    $items = nrgblog_get_instagram_photos( $count );

    if( $place == 'footer-gallery' ) {
      if( ! empty( $items ) ) {
        $output  = '<div class="footer-slider">';
        $output .= '<div class="swiper-container" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="auto">';
        $output .= '<div class="swiper-wrapper">';
        foreach ( $items as $item ) {
          $output .= '<div class="swiper-slide open-modal-popup active" data-val="0" data-src="' . $item->images->standard_resolution->url . '">';
          $output .= '<img class="img-responsive img-full" src="' . $item->images->thumbnail->url . '" alt="">';
          $output .= '</div>';
        }
        $output .= '</div>';
        $output .= '<div class="pagination"></div>';
        $output .= '<div class="swiper-arrow-left"><i class="fa fa-caret-left"></i></div>';
        $output .= '<div class="swiper-arrow-right"><i class="fa fa-caret-right"></i></div>';
        $output .= '</div>';
        $output .= '</div>';
        print $output;
      } else {
        esc_html_e( 'Some error happend.', 'nrgblog' );
      }
    } 
    if( $place == 'widget-gallery' ) {
      if( ! empty( $items ) ) {
        $output = '';
        foreach ( $items as $item ) {
          $output .= '<a href="#"><img class="img-responsive img-full" src="' . $item->images->thumbnail->url . '" height="83" width="83" alt=""></a>';
        }
        print $output;
      } else {
        esc_html_e( 'Some error happend.', 'nrgblog' );
      }
    } 
    wp_die();
}
add_action( 'wp_ajax_ngrblog_instagram_helper', 'ngrblog_instagram_helper' );
add_action( 'wp_ajax_nopriv_ngrblog_instagram_helper', 'ngrblog_instagram_helper' );