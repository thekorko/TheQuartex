<?php
/**
 * English:
 * The sidebar or widget area for the bottom of single.php
 * It's like an authorbox
 * wpQuartex
 *
 *
 *
 * Español:
 * La idea es implementar un authorbox con links del usuario
 *
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TheQuartex
 */

if ( ! is_active_sidebar( 'featured-post' ) ) {
	echo('Sidebar featured-post is not active (Or defined as a function)');
	return;
}
?>

	<!--Adsense-->
  <?php dynamic_sidebar( 'featured-post' ); ?>
	<div id="single-post-list-container" class="singlepost-list-box">
	<style>
	.mini-post-list ul li a {
		display: block;
	}
	.mini-post-list .item-post-list {
		border-bottom: solid 2px #EE004D;
	}
	/*Esto esta todo como el orto sacha arreglalo*/
	.mini-post-list.fas {
		color: #E0DDEC
	}

	</style>
	<ul class="mini-post-list">
<?php
	$stickies = get_option( 'sticky_posts' );
	// Make sure we have stickies to avoid unexpected output
	if ( $stickies ) {
	    $args = [
	        'post_type'           => 'post',
	        'post__in'            => $stickies,
	        'posts_per_page'      => 5,
	        'ignore_sticky_posts' => 1
	    ];
	    $list_query = new WP_Query($args);

	    if ( $list_query->have_posts() ) {
	        while ( $list_query->have_posts() ) {
	            $list_query->the_post();
							qtx_echo_post_list();
					    //get_template_part('list', 'minimal' );
	        }
	        wp_reset_postdata();
	    }
	}
	?>
		</ul>
		</div>

<!--</div>-->

<!-- #sin formato -->
