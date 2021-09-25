<?php
/*
Template Name: downloads template
*/

/**
 * The template for displaying downloads type pages
 * In english it will display automagically on /downloads
 * But in other languages you'll have to setup manually as a page-template
 *
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TheQuartex
 *
 */

get_header();
?>
<div id="primary" class="primary">
	<?php	get_sidebar(); ?>
	<main id="main" class="main-content">
		<div id="main-posts" class="main-posts">
<?php
//categories
//pre arguments
//TODO make this modificable with dashboard options
$cats_query = array( 'descargas', 'downloads' );

//get_query _var( 'paged' ) - this function basically look for a GET variable in the URL, '?paged=X'
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
//Categories and user IDs arguments for my WP _Query
//This could be within a function with pre-set parameters but those have to be multipurpose or generic.
//TODO do not repeat this code?
$post_query_args = array(
		//we only get roles_query userIDs see above get_users() query
    'post_type' => 'post',
		'posts_per_page' => 10,
		//get paged, this is a secured wordpress way of getting pages
		'paged' => $paged,
		//tax query to find only posts from the cats_query categories taxonomy
    'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => $cats_query,
						'include_children' => true,
        ),
    ),
);

	// the query
	$the_query = new WP_Query($post_query_args); ?>

	<?php if ( $the_query->have_posts() ) : ?>

	    <!-- pagination here -->

	    <!-- the loop -->
			<?php $j = 1; ?>
	    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<?php
			//j is just a counter, so we have post-1 to post-x
			$type = "downloads";
			//types are "download", "normal", "feed" just for styles.css
			qtx_echo_post_box($j, $type);
			$j = $j+1;
			?>
			<?php endwhile; ?>
	    <!-- end of the loop -->
			<br>
		</div><!-- #main-posts -->
		<div id="posts-pagination" class="post-pagination">
			<?php qtx_navigation(array( 'query' => $the_query )); ?>
			<?php wp_reset_postdata(); ?>
			<!-- pagination here -->
		</div>
	<?php else : ?>
		</div><!-- #main-posts -->
	    <p><?php qtx_string_e("no_posts_found"); ?></p>
	<?php endif; ?>

	</main>

</div>
<!-- #primary -->

<?php
get_footer();
