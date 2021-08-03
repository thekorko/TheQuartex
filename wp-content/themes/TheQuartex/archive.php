<?php

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
<div id="primary" class="primary">
	<?php	get_sidebar(); ?>
	<main id="main" class="main-content">
		<?php if (have_posts()) : ?>
				<div id="main-posts" class="main-posts">
					<header class="page-header" style="display:none;">
						<?php
						//qtx_archive_image();
						//the_archive_title('<h3 class="page-title entry-title">', '</h3>');
						//the_archive_description('<div class="archive-description">', '</div>');
						?>
					</header>
					<!-- .page-header -->
			<?php
			/* Start the Loop */
			$j = 1;
			while (have_posts()) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				$type = "archives";
				qtx_echo_post_box($j, $type);
				$j = $j+1;
			endwhile; ?>
			</div><!-- #main-posts -->
			<div id="posts-pagination" class="post-pagination">
			<?php
			qtx_navigation();
		else :
			get_template_part('template-parts/content', 'none');
		endif;
			?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
