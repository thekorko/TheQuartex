<?php
/*
Template Name: blog
*/

/**
 * The template for displaying /blog-en and /blog-es
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TheQuartex
 */

get_header();
?>
<style>
#blog-page {
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
	<div id="blog-page" class="base-box singlepost-box">

<?php
//roles__in get _users() parameter
//we want to query a blog by user role and categories
//pre arguments
$roles_query = array('Administrator', 'Editor');


//Arguments to filter out users by user role in this case
//arguments
$user_query_args = array(
	'role__in' => $roles_query,
);

//We store our user IDs in an array() and set a counter to acces it.
$userIDs = array();
$count = 0;
//Approach one: get _users()
//If we have a wordpress function meant for this we should use i instead of wp_User_Query
//											we pass arguments
$user_query = get_users( $user_query_args );
// Array of WP_User objects.
//this could be a function but would have to be qtx_get_users_id_by_role
//it's not generic..
if ( ! empty( $user_query ) ) {
	foreach ( $user_query as $user ) {
			$userIDs[$count] = $user->ID;
			$count++;
		}
	} else {
		echo 'No users found.';
	}

//categories
//pre arguments
$cats_query = array( 'blog-en', 'blog-es', 'blog', 'inventa-wordpress-en', 'inventa-wordpress-es', 'inventa_wordpress', 'quartexnet-es', 'quartexnet-en', 'quartexnet' );
//get_query _var( 'paged' ) - this function basically look for a GET variable in the URL, '?paged=X'
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
//Categories and user IDs arguments for my WP _Query
//This could be within a function with pre-set parameters but those have to be multipurpose or generic.
$post_query_args = array(
		//we only get roles_query userIDs see above get_users() query
		'author__in' => $userIDs,
    'post_type' => 'post',
		'posts_per_page' => 6,
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
	    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<?php qtx_echo_post_blog(); ?>
			<?php endwhile; ?>
	    <!-- end of the loop -->
			<br>
			<?php wp_pagenavi(array( 'query' => $the_query )); ?>
	    <!-- pagination here -->

	    <?php wp_reset_postdata(); ?>

	<?php else : ?>
	    <p><?php qtx_string_e("no_posts_found"); ?></p>
	<?php endif; ?>
</div>
	</main>
</div>
<!-- #primary -->

<?php
get_footer();
