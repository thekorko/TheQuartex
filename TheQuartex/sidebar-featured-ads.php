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

if ( ! is_active_sidebar( 'featured-ads' ) ) {
	echo('Sidebar featured-ads is not active (Or defined as a function)');
	return;
}
?>

<div id="featured-ads-sidebar" class="ads-post-box post-box">
	<!--TODO hacer un template part con las ads o un sidebar-->
	<?php dynamic_sidebar( 'featured-ads' ); ?>
</div>

<!-- #sin formato -->
