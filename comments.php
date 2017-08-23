<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package elif-lite
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( post_password_required() ) { ?>
    <p class="nocomments"><?php esc_attr_e( 'This post is password protected. Enter the password to view comments.', 'elif-lite' ); ?></p>
<?php
    return;
} ?>

<?php if ( have_comments() ) : ?>
<div id="comments" class="comments">
	<div class="section-title">
		<h3 class="total-comments"><?php comments_number( esc_attr__( 'No Comments', 'elif-lite' ), esc_attr__( 'One Comment', 'elif-lite' ),  esc_attr__( '% Comments', 'elif-lite' ) ); ?></h3>
	</div>
	<ol class="commentlist clearfix">
		<div class="navigation">
			<div class="alignleft"><?php previous_comments_link(); ?></div>
			<div class="alignright"><?php next_comments_link(); ?></div>
		</div>
		<?php wp_list_comments( 'type=comment&callback=elif_custom_comments' ); ?>
		<div class="navigation">
			<div class="alignleft"><?php previous_comments_link(); ?></div>
			<div class="alignright"><?php next_comments_link(); ?></div>
		</div>
	</ol>
</div>
<?php else : // this is displayed if there are no comments so far ?>
<?php if ( 'open' == $post->comment_status ) : ?>
<!-- If comments are open, but there are no comments. -->
<?php else : // comments are closed ?>
<!-- If comments are closed. -->
<p class="nocomments"></p>
<?php endif; ?>
<?php endif; ?>

<?php if ( 'open' == $post->comment_status ) : ?>
<div class="comment-form">
		<?php global $aria_req; $comments_args = array(
            'title_reply_before'    => '<div class="section-title"><h3 id="reply-title" class="comment-reply-title">',
            'title_reply_after'     => '</h3></div>',
			'title_reply'           => esc_attr__( 'Leave a Reply', 'elif-lite' ),
            'title_reply_to'        => esc_attr__( 'Leave a Reply to %s', 'elif-lite' ),
			'comment_notes_after'   => '',
			'label_submit'          => esc_attr__( 'Add Comment', 'elif-lite' ),			
			'comment_field'         => '<div class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>',
			'fields'                => apply_filters( 'comment_form_default_fields',
			array(
				'author' => '<div class="comment-form-author">' . '<label style="display:none" for="author">'. esc_attr__( 'Name', 'elif-lite'  ).'<span class="required"></span></label>' . ( $req ? '' : '' ).'<input id="author" name="author" type="text" placeholder="'.esc_attr__( 'Name', 'elif-lite' ).'*" value="'.esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
				'email'  => '<div class="comment-form-email"><label style="display:none" for="email">' . esc_attr__( 'Email', 'elif-lite' ) . '<span class="required"></span></label>' . ($req ? '' : '' ) . '<input id="email" name="email" type="text" placeholder="'.esc_attr__( 'Email', 'elif-lite' ).'*" value="' . esc_attr(  $commenter['comment_author_email'] ).'" size="30"'.$aria_req.' /></div>',
				'url'    => '<div class="comment-form-url"><label style="display:none" for="url">' . esc_attr__( 'Website', 'elif-lite' ).'</label>' . '<input id="url" name="url" type="text" placeholder="'.esc_attr__( 'Website', 'elif-lite' ).'" value="' . esc_url( $commenter['comment_author_url'] ) . '" size="30" /></div>',
			) )
		); 
		comment_form( $comments_args ); ?>
</div>
<?php endif; ?>