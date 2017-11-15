<?php

/**
 *
 * NRGBlog Comment Form
 *
 * @package nrgblog
 * @since 1.0.0
 * @version 1.0.0
 */

if ( post_password_required() ) { return; }
?>
  <h3 class="title">
    <span class="count"><?php print get_comments_number();?></span>
    <?php esc_html_e( 'comments', 'nrgblog' ); ?>
  </h3>
  <div class="comments-block">
    <?php wp_list_comments( array( 'callback' => 'nrgblog_comment' ) ); ?>
  </div>

  <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
      <h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'nrgblog' ); ?></h1>
      <div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'nrgblog' ) ); ?></div>
      <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'nrgblog' ) ); ?></div>
    </nav>
  <?php endif; ?>

<?php
  $fields =  array(
    'author' => '<div class="cus-row"><div class="cus-col"><input name="author" type="text" placeholder="' . esc_attr__( 'Your name', 'nrgblog' ) . '" required=""></div>',
    'email'  => '<div class="cus-col"><input type="email" name="email" placeholder="Your email" required=""></div></div>',
  );
  $comments_args = array(
    'id_form' => 'comment-form',
    'fields'  =>
      $fields,
      'comment_field' => '<textarea cols="30"  name="comment" rows="10" placeholder="' . esc_attr__( 'Your comment', 'nrgblog' ) . '" required=""></textarea>',
      'must_log_in' => '',
      'logged_in_as' => '',
      'comment_notes_before' => '',
      'comment_notes_after' => '',
      'title_reply' => '',
      'title_reply_to' => esc_html__( 'Leave a Reply to %s', 'nrgblog' ),
      'cancel_reply_link' => esc_html__( 'Cancel', 'nrgblog' ),
      'label_submit' => esc_html__( 'submit message', 'nrgblog' ),
      'submit_field'  => '%1$s %2$s',
  );

  comment_form($comments_args);
?>
