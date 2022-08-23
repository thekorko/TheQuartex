<?php

/**
 *
 * The front-page of TheQuartex is the starting point for navigation and presentation convenience
 * There will be multiple type feeds, various sized boxes, fetched syndicated content or
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TheQuartex
 *
 */

//TODO fix col-md-5
get_header();
global $wp;
$currentURL = home_url( $wp->request );
$homeURL = home_url();
?>
<div id="primary" class="primary">
	<!--Primary content area, sidebar, content, posts, galleries,etc-->
	<!--class="content-area"-->
	<!--Esta sidebar es lateral generica, es la default.-->
	<?php get_sidebar('sidebar-1'); ?>

	<main id="main-content" class="main-content">

		<?php get_sidebar('home-area-top'); ?>
			<!--Esta sidebar esta pensada para agregar contenido dinamico de marketing organico dentro de home.php por sobre el contenido-->
			<!--This sidebar could show a list of paragraphs or something like that, like a slider-->
			<?php if (have_posts()) : ?>
				<?php $j = 1;
				$type = "normal";
				?>
				<?php
				$author_exclude = '';
				if (is_user_logged_in()) {
					$statuses = array('publish','private');
				} else {
					$statuses = array('publish');
				} ?>
				<div id="main-posts" class="main-posts">
				<?php
				$post_query_args = array(
						//we only get roles_query userIDs see above get_users() query
				    'post_type' => 'post',
						'posts_per_page' => 16,
						'post__not_in' => get_option( 'sticky_posts' ),
						'ignore_sticky_posts' => 1,
						'post_status' => $statuses,
						'paged' => $paged,
				);
				$query = new WP_Query($post_query_args); ?>
			  <?php while ( $query->have_posts() ) : $query->the_post(); ?>
						<?php qtx_echo_post_box($j, $type); ?>
						<?php if (($j == 1)) :
							$j = $j + 1; ?>
						<div id="featured-<?php echo($j) ?>" class="base-box post-box">
							<?php	get_sidebar( 'featured-post' ); ?>
						</div>
						<?php endif; ?>
					<?php if (($j % 6) == 0) {
						$j = $j + 1;
						get_template_part('template-parts/box-ads');
					} ?>
				<?php
					$j = $j + 1;
				endwhile;
				?>
				</div><!-- #main-posts -->
				<div id="posts-pagination" class="post-pagination">
					<?php qtx_navigation(array('query' => $query)); ?>
				</div>
				<?php get_template_part( 'template-parts/large-box' ); ?>
			<?php else: ?>
	<div id="main-posts" class="main-posts">
			<?php endif; ?>
	</main>
</div><!-- #primary -->
<?php get_footer(); ?>
