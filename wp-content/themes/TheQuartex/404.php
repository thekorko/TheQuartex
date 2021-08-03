<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package TheQuartex
 */

get_header();
?>
<style>
#single-page .searchBar {
	background:#FAFAFA !important;
	grid-gap: 2em 10px;
	margin: 0 0em 0 1em !important;
	padding: 0.2em 0.2em;
	padding-left: 0.2em;
}
#single-page .searchBar .search-submit {
	background: #11122B;
}
.entry-content {
	background: #fafafa;
	color: #000;

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
			<section class="error-404 not-found">
				<header class="page-header entry-header">
					<h1 class="page-title entry-title">💀<?php qtx_string_e( 'oops_404' ); ?>💀</h1>
				</header><!-- .page-header -->

				<div class="page-content entry-content">
					<p><?php qtx_string_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?'); ?></p>

					<?php
					get_search_form();
					the_widget( 'WP_Widget_Recent_Posts' );
					?>

					<div class="widget widget_categories">
						<h2 class="widget-title">⭐📂<?php qtx_string_e( 'Most Used Categories' ); ?>📂⭐</h2>
						<ul>
							<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
							?>
						</ul>
					</div><!-- .widget -->
					<p>🗄️📋Try looking in the monthly archives.📋🗄️</p>
					<?php
					/* translators: %1$s: smiley */
					/*$thequartex_archive_content = '' . qtx_string_e( 'Try looking in the monthly archives. %1$s' ) /*sprintf( qtx_string_e( 'Try looking in the monthly archives. %1$s' ), convert_smilies( ':)' ) ) . '';*/
					the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>" );

					the_widget( 'WP_Widget_Tag_Cloud' );
					?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
