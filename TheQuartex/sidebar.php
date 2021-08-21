<?php

/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TheQuartex
 */

if (!is_active_sidebar('sidebar-1')) {
	return;
}
?>
<style>
.sidebar-box {
	margin-bottom: 10%;
	height: auto;
	overflow-wrap: break-word;
}
#sidebar-element-2 {
	padding: 10px;
}
.menu li .fas,.menu li .far {
    padding: 5px;
    background: #145e98;
    border-radius: 9px;
    margin-right: 5px;
    border: solid 2px;
    color: #49e3f3;
}
</style>
<div id="sidebar" class="sidebar">
	<!-- #sidebar where we put for example categories sidebar -->

	<div id="sidebar-element-1" class="sidebar-box">
		<?php qtx_social_login() ?>

		<nav id="sidebar-menu" class="sidebar-menu">
			<?php
			wp_nav_menu(array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'Primary',
			));
			?>
			<!--Outputs an ul list of links managed from main-navigation styles-->
		</nav>
			<?php get_sidebar('featured-ads'); ?>
	</div>

	<div id="sidebar-element-2" class="sidebar-box">
		<div id="sidebar-1" class="sidebar-1">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div>
	</div>

</div>
