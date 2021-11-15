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
				if (qtx_moderation_acccess()) {
					//testing if this could work fine
					//Save links in this array using array_push or something
					$links = array('moderation' => "$currentURL/?moderation=yes", );
					//echo this link
					$moderation_link = '<a href="'.$links['moderation'].'">Moderation</a>';
					if (isset($_GET['moderation']) && (htmlspecialchars($_GET['moderation']) == 'yes')) {
						$statuses = array('pending');
						if (!qtx_is_staff()) {
							$author_exclude = '-1';
						}
					} else {
						$statuses = array('publish','private');
					}
				} else {
					if (is_user_logged_in()) {
						$statuses = array('publish','private');
					} else {
						$statuses = array('publish');
					}
				} ?>
				<div id="quartex-buttons" class="home-buttons-top">
					<?php if (pll_current_language()=='en'): ?>
						<a href="<?=$homeURL?>"><img class="qtxbtn" src="<?php bloginfo('template_directory'); ?>/img/sections/home.png"></a>
						<a href="<?=$homeURL.'/downloads'?>"><img class="qtxbtn" src="<?php bloginfo('template_directory'); ?>/img/sections/downloads.png"></a>
						<a href="<?=$homeURL.'/random_en'?>"><img class="qtxbtn" src="<?php bloginfo('template_directory'); ?>/img/sections/randomposts.png"></a>
						<?php if (qtx_moderation_acccess()): ?>
							<a href="<?=$links['moderation']?>"><img class="qtxbtn" src="<?php bloginfo('template_directory'); ?>/img/sections/moderation.png"></a>
						<?php endif; ?>
					<?php else: ?>
						<a href="<?=$homeURL?>"><img class="qtxbtn" src="<?php bloginfo('template_directory'); ?>/img/sections/home.png"></a>
						<a href="<?=$homeURL.'/descargas'?>"><img class="qtxbtn" src="<?php bloginfo('template_directory'); ?>/img/sections/descargas.png"></a>
						<a href="<?=$homeURL.'/random_es'?>"><img class="qtxbtn" src="<?php bloginfo('template_directory'); ?>/img/sections/posteosrandom.png"></a>
						<?php if (qtx_moderation_acccess()): ?>
						<a href="<?=$links['moderation']?>"><img class="qtxbtn" src="<?php bloginfo('template_directory'); ?>/img/sections/moderacion.png"></a>
						<?php endif; ?>
					<?php endif; ?>
					<?php if (qtx_is_staff()): ?>
					<a style="background:#448884;color:#BB0070 !important;margin:0px;padding:7px;border:solid 3px #BB0070;border-radius:3px;height:25px;font-size:0.8rem;" href="<?=$currentURL.'/?qtxcache=yes'?>">Update DDL Cache</a>
					<a style="background:#448884;color:#BB0070 !important;margin:0px;padding:7px;border:solid 3px #BB0070;border-radius:3px;height:25px;font-size:0.8rem;" href="<?=$currentURL.'/?qtxrss=yes'?>">Update RSS Feeds</a>
					<a style="background:#448884;color:#BB0070 !important;margin:0px;padding:7px;border:solid 3px #BB0070;border-radius:3px;height:25px;font-size:0.8rem;" href="<?=$currentURL.'/?qtxrssupdateoldposts=yes'?>">Update Old Posts</a>
						<?php
						if (isset($_GET['qtxcache'])&&(htmlspecialchars($_GET['qtxcache'])=='yes')) {
							qtxDownloadsCache_run_cron();
							echo "<br>success running update downloads cache";
						}
						if (isset($_GET['qtxrss'])&&(htmlspecialchars($_GET['qtxrss'])=='yes')) {
							qtxRSSFetchAllFeeds_run_cron();
							echo "<br>success running update qtxrss cache";
						}
						if (isset($_GET['qtxrssupdateoldposts'])&&(htmlspecialchars($_GET['qtxrssupdateoldposts'])=='yes')) {
							$updateoldposts = True;
							qtxRSSupdateOldPosts($updateoldposts);
							echo "<br>Fixing old posts";
						}
					 	?>
					<?php endif; ?>
				</div>
				<div id="main-posts" class="main-posts">
				<?php
				$excludedcats = array();
				$categories = get_categories( array(
					'orderby' => 'name',
					'order'   => 'ASC'
				) );
				$cats_query = array( 'memes','random_es','random_en','memes-es','memes-en','random-en','random-es','random','trash-bin','papelera-de-reciclaje' );
				$counter = 0;
				foreach ($categories as $category) {
					//TODO fix it doesnt work
					if (in_array(strtolower($category->name),$cats_query)) {
						//it never is true
						$excludedcats[$counter] = $category->term_id;
						//array_push($excludedcats, $category->term_id);
						//var_dump($category->term_id);
						$counter++;
					}
				}
				//print_r($excludedcats);

				$post_query_args = array(
						//we only get roles_query userIDs see above get_users() query
				    'post_type' => 'post',
						'posts_per_page' => 15,
						'post__not_in' => get_option( 'sticky_posts' ),
						'ignore_sticky_posts' => 1,
						'post_status' => $statuses,
						'author' => $author_exclude,
						//get paged, this is a secured wordpress way of getting pages
						'paged' => $paged,
						//tax query to find only posts from the cats_query categories taxonomy
						'category__not_in' => $excludedcats
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
						if ( !is_paged() && $j == 2) {
							$j = $j + 1;
							//Don't run qtxDownloadsCache, it's a wp-cron
							//qtxDownloadsCache_run_cron();
							qtxEchoDownloads();
						}
						?>

					<?php if (($j % 6) == 0) :
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
					<?php qtx_navigation(array('query' => $query)); ?>
				</div>
				<?php get_template_part( 'template-parts/large-box' ); ?>
			<?php else: ?>
	<div id="main-posts" class="main-posts">
			<?php endif; ?>
	</main>
</div><!-- #primary -->
<?php get_footer(); ?>
