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
?>
<div id="primary" class="primary">
	<!--Primary content area, sidebar, content, posts, galleries,etc-->
	<!--class="content-area"-->
	<!--Esta sidebar es lateral generica, es la default.-->
	<?php get_sidebar('sidebar-1'); ?>
	<main id="main-content" class="main-content">
		<?php get_sidebar('home-area-top'); ?>
		<div id="main-posts" class="main-posts">
			<!--Esta sidebar esta pensada para agregar contenido dinamico de marketing organico dentro de home.php por sobre el contenido-->
			<!--This sidebar could show a list of paragraphs or something like that, like a slider-->
			<?php if (have_posts()) : ?>
				<?php $j = 1;
				$type = "normal";
				?>
				<?php
				if (qtx_is_staff()) {
					//testing if this could work fine
					$statuses = array('publish','pending');
				} else {
					$statuses = array('publish');
				}
				$excludedcats = array();
				$categories = get_categories( array(
					'orderby' => 'name',
					'order'   => 'ASC'
				) );
				$cats_query = array( 'memes','random_es','random_en','memes_es' );
				foreach ($categories as $category) {
					//TODO fix it doesnt work
					if (in_array(strtolower($category->name),$cats_query)) {
						//it never is true
						array_push($excludedcats, $category->term_id);
					}
					//var_dump($excludedcats);
				}

				$post_query_args = array(
						//we only get roles_query userIDs see above get_users() query
				    'post_type' => 'post',
						'posts_per_page' => 15,
						'post_status' => $statuses,
						//get paged, this is a secured wordpress way of getting pages
						'paged' => $paged,
						//tax query to find only posts from the cats_query categories taxonomy
						'category__not_in', $excludedcats
				);
				$query = new WP_Query($post_query_args); ?>
			  <?php while ( $query->have_posts() ) : $query->the_post(); ?>
						<?php qtx_echo_post_box($j, $type); ?>
						<?php if (($j == 1)) :
							$j = $j + 1; //hack horrible y asqueroso arreglar
							//si ponia este if abajo del otro if se rompia todo
						?>
						<div id="featured-<?php echo($j) ?>" class="base-box post-box">
						<!--featured-post-->
						<?php	get_sidebar( 'featured-post' ); ?>
						</div>
						<?php endif; ?>
					<!--TODO reescribir como una funcion -->
						<?php
						//This should be a query cached, otherwise it would be too much
						//This displays 4 downloads on page 1
						//Show the downloads, but cached ;)
						if ( !is_paged() ) {
							//Don't run qtxDownloadsCache, it's a wp-cron
							//qtxDownloadsCache_run_cron();
							qtxEchoDownloads();
						}
						?>

					<?php if (($j % 5) == 0) :
						$j = $j + 1; //hack horrible y asqueroso arreglar
						//si ponia este if abajo del otro if
					?>
							<!--box-ads template-->
							<?php get_template_part('template-parts/box-ads'); ?>
					<?php endif; ?>
				<?php
					$j = $j + 1;
				endwhile;
				?>
				</div><!-- #main-posts -->
				<div id="posts-pagination" class="post-pagination">
					<?php qtx_navigation(); ?>
				</div>
				<?php get_template_part( 'template-parts/large-box' ); ?>
			<?php endif; ?>
	</main>
</div><!-- #primary -->
<?php get_footer(); ?>
