<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package TheQuartex
 */

get_header();
?>

<style>
	.site-main>div {
		padding: 0 !important;
	}

	.single-post article {
		padding: .5em;
		color: #cfcfcf;
		float: left;
	}

	.embed-youtube {
		display: grid !important;
		place-items: center;
	}

	.entry-content {
		text-align: start;
		color: #cfcfcf;
		padding: .8em;
	}
	.entry-meta {
		color: black;
		border: 0px;
	}
	.sharedaddy {
		text-align: center;
	}

	.main {
		display: flex;
	}

	.author-box {
		display: grid;
		place-items: center;
	}

	.author-box .post-title {
		margin-top: .5em;
		text-align: start;
	}

	.post-author-data {
		display: flex;
		grid-gap: 1em;
	}
	.cat-links {
		display: block;
	}
	.tags-links {
		display: block;
	}
	.robots-nocontent .sd-title {
		color: black;
	}
	.singlepost-box {
		border: 2px solid #000;
	}
	@media screen and (min-width: 1101px) {
		#content-and-comments {
			display: grid;
			grid-gap: 0.5em 10px;
			margin: 0 0 0 1.2em;
			padding: 0.4em 0.4em 0.4em 0.4em;
		}
	}
	@media screen and (max-width: 1100px) {
		#content-and-comments {
			display: grid;
			grid-gap: 0.5em 10px;
			margin: 0 0 0 0.8em;
			padding: 0.2em 0.2em 0.2em 0.2em;
		}
	}

</style>
<div id="primary" class="primary">
	<?php get_sidebar('sidebar-1'); ?>
	<main id="main" class="main-content">
		<!--<div id="primary" class="content-area">
			<main id="main" class="site-main">-->
		<div id="content-and-comments" class="base-box singlepost-box">
			<?php
			while (have_posts()) :
				the_post();
				//get the content
				qtxAnon_initialize();
				if (qtx_is_staff()) {
					echo ("<a href='".get_delete_post_link(get_the_ID())."'>DELETE</a>");
					echo("<a href='".get_site_url()."/wp-admin/post.php?post=".get_the_ID()."&action=edit'>EDIT</a>");
					//$test = get_edit_post_link();
					//$test2 = get_the_ID();
					//var_dump($test2);
					//edit_post_link( __( 'edit', 'textdomain' ), '<p>', '</p>', get_the_ID() );
					//var_dump($test);
				}
				if (get_post_type()=='extfeed') {
					get_template_part('template-parts/content');
				} else {
					get_template_part('template-parts/content', get_post_type());
				}
			//get some ads
			// get_template_part('template-parts/large-box');
			endwhile;
			?>

			<?php
			if (comments_open() || get_comments_number()) :
				//get the comments
				comments_template();
			endif;
			?>

		</div>
		<?php
		//get_sidebar('home-area-top');
		//we reutilize the home-area-top attention box
		?>
	</main>
</div>


<?php
get_footer();
