<?php
/*
Template Name: template archive classic
*/

/**
 * The template for displaying archive pages, automatically done by wordpress template hierarchy
 * if you are looking for the categories and tag list check out page-feeds.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lessismore
 */

get_header();
?>

<!-- This is? -->
<div id="primary" class="primary">
	<?php get_sidebar('sidebar-1'); ?>
	<main id="main" class="main-content">
		<style>
		.posts-archive {
			display: grid;
			grid-gap: 2em 10px;
			margin: 0 1em 0 3em;
			padding: 2em 1em;
    	padding-left: 1em;
		}
		.entry-meta {
			border: 0px;
			color: #000;
		}
		</style>
		<div id="archive-posts" class="posts-archive base-box">
		<?php if (have_posts()) : ?>
				<header class="page-header">
					<?php
					// qtx_archive_image();
					the_archive_title('<h1 class="page-title entry-title">', '</h1>');
					the_archive_description('<div class="archive-description">', '</div>');
					?>
				</header><!-- .page-header -->
			<?php
			/* Start the Loop */
			while (have_posts()) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part('template-parts/content', get_post_type());
			endwhile;

			qtx_navigation();

		else :
			get_template_part('template-parts/content', 'none');
		endif;
			?>
			</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
