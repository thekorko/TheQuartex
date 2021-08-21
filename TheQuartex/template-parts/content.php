<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TheQuartex
 */

?>
<style>
	.extfeed-source-box {
		color: #eaeaea;
		margin: 3rem;
		padding: 0.5rem 0.5rem 0.3rem 0.5rem;
		border-radius: 7px;
	}
	.extfeed-source-list {
		list-style: none;
	}
	.entry-content {
		background: #f1f1f1;
		color: #161616;
	}
	.singlepost-box {
		margin: none !important;
	}
	.empty-box {
		display:grid;
		width: 15vw;
		height: 45vh;
		background-color: #11122B;
		float: right;
		place-items: center;
		display:none;
	}
	.single-button {
		width: 5vw;
		height: 7vh;
	}
	.post-date {
		padding-left: 10px;
	}
	#single-post-container {
		background: #E7E7E7;
	}
</style>
<div id="row-template-content">
	<?php if (is_singular() or is_page()) : //if this is a single post we will show the entire content, sidebars, etc. ?>
		<div id="single-post-container">

			<article id=" post-<?php the_ID(); ?>" <?php post_class('post'); ?>>

				<!-- entry-header -->
				<header class="entry-header base-box" style="display:grid;">
					<!--titlte div background stripes-->
					<div class="post-title" style="display:grid;">
						<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
					</div>
					<div class="post-date">
					<br>
					<?php
					//we could get a lot of information about the post
					thequartex_posted_on();
					thequartex_posted_by(); ?>
					<!-- entry-header -->
					</div>

					<?php if ('post' === get_post_type()) :	?>
					</header>
					<?php get_sidebar('content-top'); ?>
				<?php endif; ?>
			<div id="entry-content" class="entry-content">
				<?php
				the_content(sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'TheQuartex'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post(get_the_title())
				));

				wp_link_pages(array(
					'before' => '<div class="page-links">' . esc_html__('Pages:', 'TheQuartex'),
					'after'  => '</div>',
				));
				qtxrss_echoExtFeedInformationBox();
				?>

			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<?php get_sidebar('content-bottom'); ?>
			</footer><!-- .entry-footer -->
			</article><!-- #post-<?php the_ID(); ?> -->
		</div>
	<?php else : //if we are on a category or archive we will show little info and some links ?>
		<div id="single-post-container" class="singlepost-box">
			<?php qtx_echo_post_blog(); ?>
		</div>
		<?php endif; ?>

		</div>
