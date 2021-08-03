<?php
/*
Template Name: archives template
*/

/**
 * The template for displaying archives, meaning year, category, tags, etc
 * Here we can give format to listed posts in said archives and provide extra functionality
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TheQuartex
 *
 */

get_header();
?>
<style>
#single-page {
	display: grid;
	grid-gap: 2em 10px;
	margin: 0 1em 0 3em;
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
				//get the content
				get_template_part('template-parts/content', get_post_type());
				//get some ads
				get_template_part('template-parts/large-box');
			endwhile;
			?>

			<?php
			if (comments_open() || get_comments_number()) :
				//get the comments
				comments_template();
			endif;
			?>

			<?php get_sidebar('home-area-top'); //we reutilize the home-area-top attention box
			?>
		</div>
	</main>
</div>


<?php
get_footer();
