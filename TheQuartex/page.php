<?php

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
				//fix this not working properly
				the_post();
				get_template_part('template-parts/content', get_post_type());
				get_template_part('template-parts/large-box');
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
