<?php
/*
Template Name: shitpost template
*/

/**
 * Template for displaying the shitposting section
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
			 $attachments = get_posts( array(
									'post_type' => 'attachment',
									'posts_per_page' => 5,
									'paged' => $paged,
									'post_parent' => $post->ID,
									'exclude'     => get_post_thumbnail_id()
							) );

											if ( $attachments ) {
													foreach ( $attachments as $attachment ) {
															//var_dump($attachment->post_mime_type);
															$images = array('image/jpeg','image/png','image/gif','image/webp');
															$videos = array('video/mpeg','video/mp4','video/quicktime','video/webm');


															if (in_array($attachment->post_mime_type, $images)) {
																$thumbimg = wp_get_attachment_image( $attachment->ID, 'thumbnail', false );
																$bien = True;
																$type = 'thumbpost';
															} elseif (in_array($attachment->post_mime_type, $videos)) {
																$thumbimg = wp_get_attachment_url( $attachment->ID);
																$bien = True;
																$type = 'vidpost';
															} else {
																$bien = False;
															}
															if ($bien==True) {
																$class = "post-attachment mime-" . sanitize_title( $attachment->post_mime_type );
																qtx_echo_thumb_box($attachment->ID, $type, $class, $thumbimg, $attachment->post_mime_type);
															}
													}
											}
							?>
<?php
//categories
//pre arguments
//TODO make this modificable with dashboard options
//Query paramaeter https://developer.wordpress.org/reference/classes/wp_query/
//https://developer.wordpress.org/reference/functions/query_posts/
$cats_query = array( 'memes','random-es','random-en','memes-es','multimedia','videojuegos','tecnologia','quartexnet' );
if (qtx_is_staff()) {
	//testing if this could work fine
	$statuses = array('publish');
} else {
	$statuses = array('publish');
}

//get_query _var( 'paged' ) - this function basically look for a GET variable in the URL, '?paged=X'
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
//Categories and user IDs arguments for my WP _Query
//This could be within a function with pre-set parameters but those have to be multipurpose or generic.
//TODO do not repeat this code?
//TODO include pending status on unmoderated
$post_query_args = array(
						//we only get roles_query userIDs see above get_users() query
    				'post_type' => 'post',
						'posts_per_page' => 10,
						'post_status' => $statuses,
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
			$type = "random";
			//types are "download", "normal", "feed" just for styles.css
			qtx_echo_post_box($j, $type);
			$j = $j+1;
			?>
			<?php endwhile; ?>
	    <!-- end of the loop -->
			<br>
		</div><!-- #main-posts -->
		<div id="posts-pagination" class="post-pagination">
			<?php wp_pagenavi(array( 'query' => $the_query )); ?>
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
