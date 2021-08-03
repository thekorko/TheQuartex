<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TheQuartex
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() or (is_singular('extfeed') && !comments_open()) ) {
	return;
}
?>

<style>
.comments-area {
  width: 80%;
  padding: 10px;
	display: flex;
}

.comment-body {
	/*position: relative;*/
	/*display: flex;*/
	background: #f1f1f1;
	color: #161616;
	/*padding: 10px;*/
	border-radius: 7px;
	overflow: auto;

}
.fn {

}
.says {

}
.reply {
	padding:5px;
}
.comment-author {
	padding-top: 10px;
}
.comment-metadata {
	padding-top: 10px;
}
.comment-meta {
	/*position: absolute;*/
}
.comment-content {
	padding-left: 80px;
	padding-top: 15px;
	/*position: relative;*/
}
.comment-content span {
	word-wrap: break-word;

}
.comment-respond {
	display: grid;
}
.comment-list {
	padding: 0;
  list-style-type: none;
}
.comment-box-ads {
	min-width: 15%;
}
#comments-login .wp-social-login-provider-list {
	display: flex !important;
}
</style>
<div>
	<h2 class="comments-title" style="display:block;">
		<?php
		$TheQuartex_comment_count = get_comments_number();
		if ( '1' === $TheQuartex_comment_count ) {
			printf(
				/* translators: 1: title. */
				esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'TheQuartex' ),
				'<span>' . wp_kses_post( get_the_title() ) . '</span>'
			);
		} else {
			printf( // WPCS: XSS OK.
				/* translators: 1: comment count number, 2: title. */
				esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $TheQuartex_comment_count, 'comments title', 'TheQuartex' ) ),
				number_format_i18n( $TheQuartex_comment_count ),
				'<span>' . wp_kses_post( get_the_title() ) . '</span>'
			);
		}
		?>
	</h2><!-- .comments-title -->
</div>
<div id="comments" class="comments-area">

		<div id="comment-box" class="comment-box">
			<?php
			// You can start editing here -- including this comment!
			if ( have_comments() ) :
				?>

			<?php the_comments_navigation(); ?>
		<ol class="comment-list">
			<?php
			$comments = wp_list_comments( array(
				//lista de comentarios standart de wp
				'style'      => 'ol',
				'short_ping' => true,
				'echo'			 => false,
				'per_page'   => 8,
				'avatar_size' => 75,
			) );
			echo $comments;
			?>
		</ol><!-- .comment-list -->
		<?php the_comments_navigation(); ?>
	</div>
	<div id="comment-ads" class="comment-box-ads">

	</div>
</div>
<div id="comments-login" class="comments-login">
		<?php
			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() ) :
				?>
				<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'TheQuartex' ); ?></p>
				<?php
			endif;
		endif; // Check for have_comments().

		comment_form();
		?>
</div>
