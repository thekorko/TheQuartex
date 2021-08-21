<?php
/*
Template Name: dashboard template
*/
/**
 *
 * Wordpress page template, not much to say, generic way of displaying our content
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TheQuartex
 */

get_header();
?>

	<div id="primary" class="primary">
		<?php get_sidebar(); ?>
		<main id="main" class="main-content">
		<div id="single-page" class="base-box singlepost-box">
			<div class="links-box base-box">
				<?php if (qtx_is_staff()) { ?>
				<?php	qtxrss_execFrontendForm(); ?>
				<?php qtxrss_execMastermode(); ?>
				<?php
				} else {
				wp_redirect( admin_url() );
				exit;
				} ?>
		  </div>
		</div>
	</main>
</div>
</div>
<!-- #primary -->

<?php
get_footer();
