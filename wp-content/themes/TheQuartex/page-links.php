<?php
/*
Template Name: links template
*/

/**
 *
 * Wordpress page template, not much to say, generic way of displaying our content
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TheQuartex
 */

get_header();
?>

<style>
/*
	.site-main {
	display: flex;
	flex-wrap: wrap;
	}

	.sidebar {
	flex: 30%;
	}

	#single-post {
	flex: 70%;
	padding
	}

*/

	/* Responsive layout - makes a one column layout (100%) instead of a two-column layout (50%) */
	@media (max-width: 650px) {
	.sidebar, #single-post {
		flex: 100%;
	}

	}
	.linktree-menu .menu-linktree-container {
		background: #AA00DE;
		padding: 5px;
		border: black;
		border-style: solid;
	}

	.linktree-menu .menu {
		display: grid !important;
	}

	.linktree-menu ul {
		padding: 10px;
  }
	#single-page {
		display: grid;
		grid-gap: 2em 10px;
		margin: 0 1em 0 3em ;
		padding: 0.2em 0.2em;
		padding-left: 0.2em;
	}
	.entry-content {
		background: #fafafa;
		color: #000;
		padding: 1%;
	}
	.post-date {
		padding-left: 10px;
	}
	#single-post-container {
		background: #E7E7E7;
	}
	</style>
	<div id="primary" class="primary">
		<?php get_sidebar(); ?>
		<main id="main" class="main-content">
		<div id="single-page" class="base-box singlepost-box">
			<?php
			while (have_posts()) :
				the_post();

				if (qtx_post_has_content()) {
					//the_content();
					get_template_part('template-parts/content', get_post_type());
				} else {
					qtx_content_generator();
				}

			?>

			<?php
				if (comments_open() || get_comments_number()) :
					comments_template(); //en ese template abri otra row debajo del sidebar y el post
				endif;

			endwhile; // End of the loop.
			?>
		</div>
	</main>
</div>
</div>
<!-- #primary -->

<?php
get_footer();
