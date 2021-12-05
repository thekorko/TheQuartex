<?php
/*
Template Name: post-form
*/

/**
 * The template for the post creation form
 * It displays a form based on the user role
 *
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
 <style>
 #create-post-page {
 	display: grid;
 	grid-gap: 2em 10px;
 	margin: 0 0em 0 1em !important;
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
 	<div id="create-post-page" class="base-box singlepost-box">

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
            if (is_user_logged_in()) {
              $user = wp_get_current_user();
              $publish_roles = array('editor', 'administrator', 'author', 'qtx_user', 'qtx_mod', 'qtx_vip');
              $review_roles = array('qtx_noob', 'subscriber', );
              if ((array_intersect($publish_roles, $user->roles))) {

              } elseif ((array_intersect($review_roles, $user->roles))) {

              } else {

              }
              // code...
            } else {
              echo "<p>";
              qtx_string_e('not_logged_in');
              echo "</p>";
              qtx_social_login("full");
            }
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
