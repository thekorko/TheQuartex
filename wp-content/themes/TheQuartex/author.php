<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TheQuartex
 */

get_header();
?>

<style>
.singlepost-box {
	border: 2px solid #000;
}
.page-header,.entry-header {
	background: #11122B;

}
.entry-meta {
	padding-left: .8em;
	border: 0px;
}
.page-title,.entry-title {
	margin: 0 !important;
	padding: .5em 1em;
	text-align: start;
}
.sharedaddy {
	text-align: center;
}
.entry-content {
	text-align: start;
	color: black;
	padding: .8em;
	color: #000;
	background: #E7E7E7;

}
</style>

	<div id="primary" class="content-area">
		<?php get_sidebar(); ?>
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

    <div id="single-post" class="base-box singlepost-box">
			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;
			?>
			<div id="posts-pagination" class="post-pagination">
				<?php qtx_navigation(); ?>
			</div>
		<?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
		</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
