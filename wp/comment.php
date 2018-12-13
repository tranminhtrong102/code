<?php
/**
* The template for displaying comments
*
* This is the template that displays the area of the page that contains both the current comments
* and the comment form.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package themesprite
*/

/*
* If the current post is protected by a password and
* the visitor has not yet entered the password we will
* return early without loading the comments.
*/
if ( post_password_required() ) {
	return;
}
?>

<div class="comments comments-area mg-50">

	<?php
    // You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="main-title reset-line-height text-left font-size-48"><?php echo get_comments_number(get_the_ID()); ?> Comments</h2>

		<?php the_comments_navigation(); ?>

		<ul class="list-comments">
			<?php
			wp_list_comments( 
				"callback=ts_custom_comments"
			);
			?>
		</ul><!-- .comment-list -->

		<?php the_comments_navigation();

        // If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'themesprite' ); ?></p>
			<?php
		endif;

    endif; // Check for have_comments().
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $fields =  array(
    	'author' =>'<p class="comment-form-author">' .( $req ? '' : '' ) .'<input class="form-control" id="author" name="author" placeholder="Your Name" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
    	'" size="30"' . $aria_req . ' /></p>',
    	'email' => '<p class="comment-form-email"> ' . ( $req ? '' : '' ) . '<input class="form-control" id="email" name="email" placeholder="Your Email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    	'" size="30"' . $aria_req . ' /></p>',
    );
    $args=array(
    	'id_form'           => 'commentform',
    	'id_submit'         => 'submit',
    	'title_reply'       => __( '<h2 class="main-title mg-bt-50 reset-line-height text-left font-size-48">Leave A Comment</h2>' ),
    	'title_reply_to'    => __( 'Leave a Reply to %s' ),
    	'cancel_reply_link' => __( 'Cancel Reply' ),
    	'label_submit'      => __( 'Post Comment' ),
    	'fields'=>$fields, 
    	'comment_notes_after'=>'',
    	'comment_notes_before'=>'',
    	'comment_field'=>'<p class="comment-form-comment"><textarea class="form-control" placeholder="Your Message" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>'		
    );

//this tag output complete comment form
    comment_form($args);
    ?>

</div><!-- #comments -->
<?php
if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
}
function ts_custom_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>" class="author  clearfix comment-body">
			<div class="avatar comment-author vcard comment-avatar">
				<?php echo get_avatar($comment,$size='full',$default='<path_to_url>' ); ?>
				<!-- <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>','themesprite'), get_comment_author_link()) ?> -->
			</div>
			<?php if ($comment->comment_approved == '0') : ?>
				<em><?php _e('Your comment is awaiting moderation.','themesprite') ?></em>
				<br />
			<?php endif; ?>

      <!-- <div class="comment-meta commentmetadata">
          <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
          	<?php printf(__('%1$s at %2$s','themesprite'), get_comment_date(),  get_comment_time()) ?> -->
          </a>
          <!-- <?php edit_comment_link(__('(Edit)','themesprite'),'  ','') ?>
      </div> -->
      <div class="desc">
      	<span class="time-ago float-right">
      		<i class="fa fa-clock-o"> </i>
      		<?php printf( _x( '%s trước', '%s = human-readable time difference', 'your-text-domain' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?>
      	</span>
      	<a href="" class="author-title"><?php comment_author(); ?></a>

      	<?php comment_text() ?>
      </div>
      <div class="btn-rep float-right"><i class="fa fa-reply"> </i><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
  </div>
  <?php
}
?>






<?php comments_template( '', true ); ?>
