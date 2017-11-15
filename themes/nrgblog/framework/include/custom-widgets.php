<?php

/**
 * Display latest Instagram photos.
 */
class Instagram_Widget extends WP_Widget {

  public function __construct() {
    parent::__construct(
      'instagram_widget',
      esc_html__( 'Instagram Widget', 'nrgblog' ),
      array( 'description' => esc_html__( 'Get latest photos', 'nrgblog' ), )
    );
  }

  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = strip_tags( $new_instance['title'] );
    $instance['count_photos'] = strip_tags( $new_instance['count_photos'] );
    return $instance;
  }

  public function form( $instance ) {
  $instance['title'] = ( isset( $instance['title'] ) && ! empty( $instance['title'] ) ) ? $instance['title'] : '';
  $instance['count_photos'] = ( isset( $instance['count_photos'] ) && ! empty( $instance['count_photos'] ) ) ? $instance['count_photos'] : '';
  ?>
    <p>
      <label for="<?php print $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'nrgblog' ); ?></label>
      <input class="widefat" id="<?php print $this->get_field_id( 'title' ); ?>" 
        name="<?php print $this->get_field_name( 'title' ); ?>" type="text" 
        value="<?php print $instance['title']; ?>" />
    </p>
    <p>
      <label for="<?php print $this->get_field_id( 'count_photos' ); ?>"><?php esc_html_e( 'Count photos', 'nrgblog' ); ?></label>
      <input class="widefat" id="<?php print $this->get_field_id( 'count_photos' ); ?>" 
        name="<?php print $this->get_field_name( 'count_photos' ); ?>" type="text" 
        value="<?php print $instance['count_photos']; ?>" />
    </p>
  <?php
  }

  public function widget( $args, $instance ) {
    if ( ! file_exists( ABSPATH . 'wp-content/plugins/nrgblog-plugins/lib/instagram.class.php' ) ) {
      print "<p>" . esc_html__( 'Plaese activate required plugins', 'nrgblog' ) . ".</p>";
    } else {
      $count_photos = ( ! empty( $instance['count_photos'] ) && is_numeric( $instance['count_photos'] ) ) ? $instance['count_photos'] : 2;
      $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
      
      print $args['before_widget'];
      if ( $title ) {
        print $args['before_title'] . $title . $args['after_title'];
      }

      $ajax_url = admin_url('admin-ajax.php');

      $output  = '<div class="popular-photos clearfix widget_intagram_gallery" data-url="' . $ajax_url . '" data-count="' . $count_photos . '">';
      $output .= '<div class="inst"> <div></div> </div>';
      $output .= '</div>';

      print $output;

      print $args['after_widget'];
    }
  }
}

add_action( 'widgets_init', function() {
  register_widget( 'Instagram_Widget' );
});

/**
 * Latest posts.
 */
class Latest_Posts_Widget extends WP_Widget {
  public function __construct() {
    parent::__construct(
      'latest_posts',
      esc_html__( 'Latest posts', 'nrgblog' ),
      array( 'description' => esc_html__( 'Get latest posts', 'nrgblog' ), )
    );
  }
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = strip_tags( $new_instance['title'] );
    $instance['count_posts'] = strip_tags( $new_instance['count_posts'] );
    $instance['show_image'] = strip_tags( $new_instance['show_image'] );
    return $instance;
  }
  public function form( $instance ) {
    $instance['title'] = ( isset( $instance['title'] ) && ! empty( $instance['title'] ) ) ? $instance['title'] : '';
    $instance['count_posts'] = ( isset( $instance['count_posts'] ) && ! empty( $instance['count_posts'] ) ) ? $instance['count_posts'] : '';
    $instance['show_image'] = ( ! empty( $instance['show_image'] ) ) ? 'checked' : '';
    ?>
    <p>
      <label for="<?php print $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'nrgblog' ); ?></label>
      <input class="widefat" id="<?php print $this->get_field_id( 'title' ); ?>" 
        name="<?php print $this->get_field_name( 'title' ); ?>" type="text" 
        value="<?php print $instance['title']; ?>" />
    </p>
    <p>
      <label for="<?php print $this->get_field_id( 'count_posts' ); ?>"><?php esc_html_e( 'Count posts', 'nrgblog' ); ?></label>
      <input class="widefat" id="<?php print $this->get_field_id( 'count_posts' ); ?>" 
        name="<?php print $this->get_field_name( 'count_posts' ); ?>" type="text" 
        value="<?php print $instance['count_posts']; ?>" />
    </p>
    <p>
      <label for="<?php print $this->get_field_id( 'show_image' ); ?>"><?php esc_html_e( 'Show post images', 'nrgblog' ); ?></label>
      <input type="checkbox" name="<?php print $this->get_field_name( 'show_image' ); ?>" value="show" <?php print $instance['show_image']; ?> />
    </p>
    <?php
  }


  public function widget( $args, $instance ) {

    /** This filter is documented in wp-includes/default-widgets.php */
    $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
    $count_posts = ( ! empty( $instance['count_posts'] ) && is_numeric( $instance['count_posts'] ) ) ? $instance['count_posts'] : 2;
    $show_image = ( ! empty( $instance['show_image'] ) && $instance['show_image'] == 'show' ) ? true : false;

    print $args['before_widget'];
    if ( $title ) {
      print $args['before_title'] . $title . $args['after_title'];
    }
        
    $posts = get_posts( array( 'numberposts' => $count_posts ) );
    if ( $posts ) {
      if( $show_image ) {
        if ( ! file_exists( ABSPATH . 'wp-content/plugins/nrgblog-plugins/lib/aq_resizer.php' ) ) {
          print "<p>" . esc_html__( 'Plaese activate required plugins', 'nrgblog' ) . ".</p>";
        } else {
          include ABSPATH . 'wp-content/plugins/nrgblog-plugins/lib/aq_resizer.php';
          $output  = '<div class="popular-post">';
          $output .= '<ul>';
          foreach ( $posts as $post ) {
            $img_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
            $post_categories = wp_get_post_categories( $post->ID );
            $cats = array();
            foreach($post_categories as $c) {
              $cat = get_category( $c );
              $cats[] = $cat->name;
            }
            $category = implode( ', ', $cats );
            $output .= '<li>';
            $output .= ( ! empty( $img_url ) ) ? '<a class="img" href="' . get_permalink( $post->ID ) . '"><img src="' . aq_resize( $img_url, 70, 70, true, true, true ) . '" alt=""></a>' : '';
            $output .= ( ! empty( $img_url ) ) ? '<div class="content">' : '<div>';
            $output .= '<div class="post-date">';
            $output .= '<span>' . get_the_time( get_option('date_format') ) . ' / ' . $category . '</span>';
            $output .= '</div>';
            $output .= '<a href="' . get_permalink( $post->ID ) . '" class="link">' . $post->post_title . '</a>';
            $output .= '</div>';
            $output .= '</li>';
          }
          $output .= '</ul>';
          $output .= '</div>';
        }
      } else {
        $output = '<div class="recent-posts">';
        foreach ( $posts as $post ) {
          $img_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
          $output .= '<div class="r-post">';
          $output .= '<div class="r-post-date">' . get_the_time( get_option('date_format') ) . '</div>';
          $output .= '<a href="' . get_permalink( $post->ID ) . '" class="r-post-link">' . $post->post_title . '</a>';
          $output .= '</div>';
        }        
          $output .= '</div>';
      }
      print $output;
    }

    print $args['after_widget'];
  }
}

add_action( 'widgets_init', function() {
  register_widget( 'Latest_Posts_Widget' );
});

/**
 * Display Subscribe form.
 */
class Subscribe_Widget extends WP_Widget {

  public function __construct() {
    parent::__construct(
      'subscribe_widget',
      esc_html__( 'Subscribe Widget', 'nrgblog' ),
      array( 'description' => esc_html__( 'Subscribe Widget', 'nrgblog' ), )
    );
  }

  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = strip_tags( $new_instance['title'] );
    $instance['form_text'] = strip_tags( $new_instance['form_text'] );
    $instance['light_form'] = strip_tags( $new_instance['light_form'] );
    return $instance;
  }

  public function form( $instance ) {
  $instance['title'] = ( isset( $instance['title'] ) && ! empty( $instance['title'] ) ) ? $instance['title'] : '';
  $instance['form_text'] = ( isset( $instance['form_text'] ) && ! empty( $instance['form_text'] ) ) ? $instance['form_text'] : '';
  $instance['light_form'] = ( ! empty( $instance['light_form'] ) ) ? 'checked' : '';
  ?>
    <p>
      <label for="<?php print $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'nrgblog' ); ?></label>
      <input class="widefat" id="<?php print $this->get_field_id( 'title' ); ?>" 
        name="<?php print $this->get_field_name( 'title' ); ?>" type="text" 
        value="<?php print $instance['title']; ?>" />
    </p>
    <p>
      <label for="<?php print $this->get_field_id( 'form_text' ); ?>"><?php esc_html_e( 'Form text', 'nrgblog' ); ?></label>
      <input class="widefat" id="<?php print $this->get_field_id( 'form_text' ); ?>" 
        name="<?php print $this->get_field_name( 'form_text' ); ?>" type="text" 
        value="<?php print $instance['form_text']; ?>" />
    </p>
    <p>
      <label for="<?php print $this->get_field_id( 'light_form' ); ?>"><?php esc_html_e( 'White style', 'nrgblog' ); ?></label>
      <input type="checkbox" name="<?php print $this->get_field_name( 'light_form' ); ?>" value="show" <?php print $instance['light_form']; ?> />
    </p>
  <?php
  }

  public function widget( $args, $instance ) {
    if ( ! file_exists( ABSPATH . 'wp-content/plugins/nrgblog-plugins/lib/MCAPI.class.php' ) ) {
      print "<p>" . esc_html__( 'Plaese activate required plugins', 'nrgblog' ) . ".</p>";
    } else {
      $form_text = ( ! empty( $instance['form_text'] ) ) ? $instance['form_text'] : '';
      $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
      $light_form = ( ! empty( $instance['light_form'] ) && $instance['light_form'] == 'show' ) ? true : false;

      print $args['before_widget'];
      if ( $title ) {
        print $args['before_title'] . $title . $args['after_title'];
      }
      $ajax_url = admin_url('admin-ajax.php');

      if( $light_form ) {
        $output  = '<div class="subscribe-block">';
        $output .= '<div class="subscribe">';
        $output .= '<p class="about">' . $form_text . '</p>';
        $output .= '<form class="subscribe-form" data-url="' . $ajax_url . '">';
        $output .= '<div class="msg light"></div>';
        $output .= '<input type="email" name="email" class="transperent-bg" required="" placeholder="' . esc_html__( 'Enter your email', 'nrgblog') . '">';
        $output .= '<input type="hidden" name="code_nonce" value="' . wp_create_nonce("nrgblog") . '">';
        $output .= '<button type="submit"><i class="fa fa-envelope-o"></i></button>';
        $output .= '</form>';
        $output .= '</div>';
        $output .= '</div>';
      } else {
        $output  = '<div class="subscribe-block">';
        $output .= '<p>' . $form_text . '</p>';
        $output .= '<form class="subscribe-form" data-url="' . $ajax_url . '">';
        $output .= '<div class="msg"></div>';
        $output .= '<input type="email" name="email" placeholder="' . esc_html__( 'Enter your email', 'nrgblog') . '" required="">';
        $output .= '<input type="hidden" name="code_nonce" value="' . wp_create_nonce("nrgblog") . '">';
        $output .= '<input type="submit" value="submit">';
        $output .= '</form>';
        $output .= '</div>';
      }
      print $output;

      print $args['after_widget'];
    }
  }
}

add_action( 'widgets_init', function() {
  register_widget( 'Subscribe_Widget' );
});

/**
 * About me Widget.
 */
class About_Widget extends WP_Widget {

  function About_Widget() {
    $widget_ops = array(
      'classname' => 'About_Widget', 
      'description' => esc_html__( 'Displays image box with text', 'nrgblog' )
    );
    parent::__construct('About_Widget', esc_html__( 'About Me Widget', 'nrgblog' ), $widget_ops);
  }

  function widget( $args, $instance ) {
    // Widget output

    extract($args, EXTR_SKIP);

    $title = empty($instance['title']) ? ''  : apply_filters('widget_title', $instance['title']);
    $form_text = ( ! empty( $instance['form_text'] ) ) ? $instance['form_text'] : '';
    $twitter = ( ! empty( $instance['twitter'] ) ) ? $instance['twitter'] : '';
    $facebook = ( ! empty( $instance['facebook'] ) ) ? $instance['facebook'] : '';
    $instagram = ( ! empty( $instance['instagram'] ) ) ? $instance['instagram'] : '';
    $pinterest = ( ! empty( $instance['pinterest'] ) ) ? $instance['pinterest'] : '';
    $google = ( ! empty( $instance['google'] ) ) ? $instance['google'] : '';
    $image = empty($instance['image']) ? ' ' : $instance['image'];
    
    echo $args['before_widget'];

    $output  = '<div class="about-me">';
    $output .= '<a href="#" class="ava">';
    $output .= '<img src=' . esc_attr( $image ) . ' alt="">';
    $output .= '</a>';
    $output .= ( ! empty( $title ) ) ? '<p class="title">' . $title . '</p>' : '';
    $output .= ( ! empty( $form_text ) ) ? '<p class="text">' . $form_text . '</p>' : '';
    $output .= '<div class="soc-block">';
    $output .= ( ! empty( $twitter ) ) ? '<a href="' . $twitter . '"> <i class="fa fa-twitter"></i> </a>' : '';
    $output .= ( ! empty( $facebook ) ) ? '<a href="' . $facebook . '"> <i class="fa fa-facebook"></i> </a>' : '';
    $output .= ( ! empty( $instagram ) ) ? '<a href="' . $instagram . '"> <i class="fa fa-instagram"></i> </a>' : '';
    $output .= ( ! empty( $pinterest ) ) ? '<a href="' . $pinterest . '"> <i class="fa fa-pinterest-p"></i> </a>' : '';
    $output .= ( ! empty( $google ) ) ? '<a href="' . $google . '"> <i class="fa fa-google-plus"></i> </a>' : '';
    $output .= '</div>';
    $output .= '</div>';

    echo $output;

    echo $args['after_widget'];
  }

  function update( $new_instance, $old_instance ) {
    // Save widget options
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['form_text'] = $new_instance['form_text'];
    $instance['twitter'] = $new_instance['twitter'];
    $instance['facebook'] = $new_instance['facebook'];
    $instance['instagram'] = $new_instance['instagram'];
    $instance['pinterest'] = $new_instance['pinterest'];
    $instance['google'] = $new_instance['google'];
    $instance['image'] = $new_instance['image'];
    return $instance;
  }

  function form( $instance ) {
    // Output admin widget options form
    $instance = wp_parse_args( (array) $instance, array( 
      'title' => '',
      'form_text' => '',
      'twitter' => '',
      'facebook' => '',
      'instagram' => '',
      'pinterest' => '',
      'google' => '',
      'image' => ''
      ) 
    );
    $title = $instance['title'];
    $form_text = $instance['form_text'];
    $twitter = $instance['twitter'];
    $facebook = $instance['facebook'];
    $instagram = $instance['instagram'];
    $pinterest = $instance['pinterest'];
    $google = $instance['google'];
    $image = $instance['image'];

    ?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:','nrgblog'); ?>
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('form_text'); ?>">
        <?php esc_html_e( 'Text:','nrgblog'); ?>
        <textarea class="widefat" id="<?php echo $this->get_field_id('form_text'); ?>" 
        name="<?php echo $this->get_field_name('form_text'); ?>"><?php echo esc_attr($form_text); ?></textarea>
      </label>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('twitter'); ?>">
        <?php esc_html_e( 'twitter:','nrgblog'); ?>
        <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" 
        name="<?php echo $this->get_field_name('twitter'); ?>" 
        type="text" value="<?php echo esc_attr($twitter); ?>" />
      </label>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('facebook'); ?>">
        <?php esc_html_e( 'facebook:','nrgblog'); ?>
        <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" 
        name="<?php echo $this->get_field_name('facebook'); ?>" 
        type="text" value="<?php echo esc_attr($facebook); ?>" />
      </label>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('instagram'); ?>">
        <?php esc_html_e( 'instagram:','nrgblog'); ?>
        <input class="widefat" id="<?php echo $this->get_field_id('instagram'); ?>" 
        name="<?php echo $this->get_field_name('instagram'); ?>" 
        type="text" value="<?php echo esc_attr($instagram); ?>" />
      </label>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('pinterest'); ?>">
        <?php esc_html_e( 'pinterest:','nrgblog'); ?>
        <input class="widefat" id="<?php echo $this->get_field_id('pinterest'); ?>" 
        name="<?php echo $this->get_field_name('pinterest'); ?>" 
        type="text" value="<?php echo esc_attr($pinterest); ?>" />
      </label>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('google'); ?>">
        <?php esc_html_e( 'google plus:','nrgblog'); ?>
        <input class="widefat" id="<?php echo $this->get_field_id('google'); ?>" 
        name="<?php echo $this->get_field_name('google'); ?>" 
        type="text" value="<?php echo esc_attr($google); ?>" />
      </label>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('image'); ?>">
        <?php esc_html_e('Background title image:','nrgblog'); ?>
        <input name="<?php echo $this->get_field_name('image'); ?>" type="text" name="attachment_url" class="widefat custom_media_url" value="<?php echo esc_attr($image); ?>">
        <a href="#" style="margin-top:10px;" class="button button-primary widget-control-save custom_media_upload">Select Image</a>
      </label>
    </p>
    <?php
  }
}

add_action( 'widgets_init', function() {
  register_widget( 'About_Widget' );
});

/**
 * Display last user twitts.
 */
class Twitter_Widget extends WP_Widget {
  public function __construct() {
    parent::__construct(
      'twitter_widget',
      esc_html__( 'Twitter Widget', 'nrgblog' ),
      array( 'description' => esc_html__( 'Get latest tweets', 'nrgblog' ), )
    );
  }
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = strip_tags( $new_instance['title'] );
    $instance['count_twitts'] = strip_tags( $new_instance['count_twitts'] );
    return $instance;
  }

  public function form( $instance ) {
    $instance['title'] = ( isset( $instance['title'] ) && ! empty( $instance['title'] ) ) ? $instance['title'] : '';
    $instance['count_twitts'] = ( isset( $instance['count_twitts'] ) && ! empty( $instance['count_twitts'] ) ) ? $instance['count_twitts'] : '';
    ?>
      <p>
        <label for="<?php print $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'nrgblog' ); ?></label>
        <input class="widefat" id="<?php print $this->get_field_id( 'title' ); ?>" 
          name="<?php print $this->get_field_name( 'title' ); ?>" type="text" 
          value="<?php print $instance['title']; ?>" />
      </p>
      <p>
        <label for="<?php print $this->get_field_id( 'count_twitts' ); ?>"><?php esc_html_e( 'Count twitts', 'nrgblog' ); ?></label>
        <input class="widefat" id="<?php print $this->get_field_id( 'count_twitts' ); ?>" 
          name="<?php print $this->get_field_name( 'count_twitts' ); ?>" type="text" 
          value="<?php print $instance['count_twitts']; ?>" />
      </p>
    <?php
  }

  public function widget( $args, $instance ) {

    if ( ! file_exists( ABSPATH . 'wp-content/plugins/nrgblog-plugins/lib/TwitterApi.php' ) ) {
      print "<p>" . esc_html__( 'Plaese activate required plugins', 'nrgblog' ) . ".</p>";
    }
    else {
      global $nrgblog;
      $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
      $count_twitts = ( ! empty( $instance['count_twitts'] ) && is_numeric( $instance['count_twitts'] ) ) ? $instance['count_twitts'] : 2;
      
      print $args['before_widget'];
      if ( $title ) {
        print $args['before_title'] . $title . $args['after_title'];
      }

      $twitts = nrgblog_get_twitts( $count_twitts );

      $output  = '<div class="swiper-container twit-slider" data-autoplay="0" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1">';
      $output .= '<div class="swiper-wrapper">';
      foreach ( $twitts as $twitt ) {
        $output .= '<div class="swiper-slide">';
        $output .= '<a href="https://twitter.com/' . $nrgblog['twitter_user_name'] . '" class="author-tw" target="_blank">';
        $output .= '<i class="fa fa-twitter"></i>';
        $output .= '@ ' . $nrgblog['twitter_user_name'];
        $output .= '</a>';
        $output .= '<div class="twit-text">' . $twitt->text . '</div>';
        $output .= '<div class="twit-time">';
        $output .= nrgblog_time_elapsed_string( strtotime( $twitt->created_at ) );
        $output .= '</div>';
        $output .= '</div>';
      }
      $output .= '</div>';
      $output .= '<div class="pagination style-2"> </div>';
      $output .= '</div>';

      print $output;
      print $args['after_widget'];
    }
  }
}

add_action( 'widgets_init', function() {
  register_widget( 'Twitter_Widget' );
});
?>
