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
 * @version 0.1
 *
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
  width: 100%;
  padding: 10px;
	display: grid;
	grid-template-columns: 65% 30%;
}
.comment-box {
	/*width:75%;*/
}
.comment-box-ads {
	margin-left: 1em;
	/*min-width: 300px !important;
	width: 25%;*/
}
@media screen and (max-width: 768px) {
	.comments-area {
	  width: 100%;
	  padding: 10px;
		display: grid;
		grid-template-columns: 90%;
	}
	.comment-box-ads {
		display: none;
	}
	.adsbygoogle {
		display: none;
	}
	.comment-box {
		/*width: 90%;*/
	}
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
.comment-meta {
	display: inherit;
	grid-template-rows: unset;
}
.comment-metadata {
	font-size: 12px;
	font-weight: 600;
}
.comment-metadata time {
	color: grey;
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
	padding-left: 10px;
	padding-right: 10px;
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
	margin: 0.2em 0 0.2em 0.2em;
  list-style-type: none;
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
	<?php if ( have_comments() ): ?>
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
	<?php endif; //if have commments ?>
		<div id="comments-login" class="comments-login">
			<?php if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'TheQuartex' ); ?></p>
			<?php endif; ?>
			<?php comment_form(); ?>
		</div>
	</div>
	<div id="comment-ads" class="comment-box-ads">
		<?php if ( intval($TheQuartex_comment_count) > 3 ): ?>
		<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5750670113076133"
		     crossorigin="anonymous"></script>
		<!-- comments -->
		<ins class="adsbygoogle"
		     style="display:block"
		     data-ad-client="ca-pub-5750670113076133"
		     data-ad-slot="4676472993"
		     data-ad-format="auto"
		     data-full-width-responsive="true"></ins>
		<script>
		     (adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	<?php endif; //comment count ?>
	</div>
</div>
