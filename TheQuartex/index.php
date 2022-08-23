<?php
/*
Template Name: index0r
*/

/**
 *
 * This is the index file, this is Index0r in quartex, it has generic functionality, and will display a massive index0r
 * The purpose of this file in wordpress is a fallback when there is nothing to display, it's not supposed to happen in TheQuartex
 * But when it happens we will show a generic post, some random information
 * In any other case we will display the Index0r mode, template Index0r
 *
 *
 * @package TheQuartex

 */

get_header();
?>

	<div id="primary" class="row"> <!--Primary content area, sidebar, content, posts, galleries,etc--><!--class="content-area"-->

		<!--Esta sidebar es lateral generica, es la default.-->
		<?php get_sidebar( 'sidebar-1' ); ?>




		<main id="main-content"> <!--class="site-main"-->


			<div id="main-posts" >
				<div id="block-filler" style="display:none;">

					<div  class="post-box">

					</div>
				</div>
				<!--Esta sidebar esta pensada para agregar contenido dinamico de marketing organico dentro de home.php por sobre el contenido-->
				<!--This sidebar could show a list of paragraphs or something like that, like a slider-->
				<?php get_sidebar ('home-area-top'); ?>

				<div id="block-filler" style="display:none;">

					<div  class="post-box">

					</div>
				</div>

				<?php if (have_posts()) : ?>

					<?php $j = 1; ?>

		<?php while (have_posts()) : the_post(); ?>
		<?php	qtx_echo_post_box(); ?>

				<!--TODO reescribir como una funcion -->
				<?php if (($j==1)) :
										$j = $j+1; //hack horrible y asqueroso arreglar
										//si ponia este if abajo del otro if se rompia todo
				?>
							<div id="featured-<?php echo($j) ?>" class="post-box base-box">
									<!--featured-post-->
									<?php	get_sidebar( 'featured-post' ); ?>

							</div>

				<?php endif; ?>
		<?php if (($j%5)==0) :
								$j = $j+1; //hack horrible y asqueroso arreglar
								//si ponia este if abajo del otro if
			?>
					<div id="ads-featured" class="post-box base-box">
						<!--box-ads template-->
						<?php get_template_part( 'template-parts/box-ads' ); ?>

					</div>

		<?php endif; ?>

		<?php if (($j%3)==0) : ?>

				<div id="block-filler" style="display:none;">

					<div class="post-box">
						<!--TODO aprovechar este espacio de una manera mas optima, considerar eliminarlo-->
					</div>

				</div>
		<?php endif; ?>


	<?php

	$j = $j+1;

	endwhile;

	?>
	<div id="posts-pagination" class="post-pagination">
	<?php
	if ( is_plugin_active( 'wp-pagenavi/wp-pagenavi.php' ) ) {
    //check if wp-pagenavi is active
		wp_pagenavi();

	} else {
		the_posts_navigation();
	} ?>
	</div>
	<?php get_template_part( 'template-parts/large-box' ); ?>
	<?php endif; ?>

			</div><!-- #main-posts -->
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
