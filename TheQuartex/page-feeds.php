<?php
/*
Template Name:  Feeds & Cate list template
*/

/**
 * The template for a /feeds page
 * It provides all categories and tags in a navigation style, easy, simple and convenient
 *
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TheQuartex
 *
 *
 */

 get_header();
 ?>
 <style>
 #single-page {
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
 	<div id="single-page" class="base-box singlepost-box">

      <?php
      while ( have_posts() ) :
        the_post(); ?>
        <article id="create-post" <?php post_class(); ?>>
          <header class="entry-header">
            <h1 class="entry-title">
            <?php qtx_string_e('create_post_title'); ?>
            </h1>
          </header><!-- .entry-header -->
          <div class="entry-content">
            <?php
            //We get a full list of categories.
            //TODO extend functionality, add tags, and give formating.
            wp_list_categories();
            //echo("This is page-feeds")
            the_content();

            wp_link_pages( array(
              'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'TheQuartex' ),
              'after'  => '</div>',
            ) );
            ?>
          </div>
          <article>
      <?php
      endwhile; // End of the loop.
      ?>
    </div>
 		</main>
 </div>
 <!-- #primary -->

 <?php
 get_footer();
