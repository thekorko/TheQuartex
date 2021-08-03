<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package TheQuartex
 */

get_header();
?>
<?php if (have_posts()) : ?>
<section id="primary" class="primary">
	<?php	get_sidebar(); ?>
	<main id="main" class="main-content">
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
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );
			  $j = $j+1;
			endwhile; ?>
		</div><!-- #main-posts -->
		<div id="posts-pagination" class="post-pagination">
		<?php
			qtx_navigation();
			?>

	</main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
else :
	get_template_part('template-parts/content', 'none');
endif;
