<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TheQuartex
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<script src="https://kit.fontawesome.com/3a1a757ef1.js" crossorigin="anonymous"></script>
	<?php wp_head(); ?>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5750670113076133" crossorigin="anonymous"></script>
</head>

<body class="site-background">
	<?php wp_body_open(); ?>

	<div id="page" class="site">

		<header id="header" class="header">

			<div class="menu" id="menu-button">
				<button class="menu-button" onclick="togglemenu()"><img src="<?php echo get_template_directory_uri(); ?>/img/button.png" class="menu-button"></button>
			</div>

			<div class="qtx-logo" id="button-logo">
				<?php
				the_custom_logo();
				?>
			</div>

			<div class="nav" id="head-extra">
				<?php get_sidebar('header-navbar-area'); ?>
			</div>

			<div id="languagees" class="languages">
				<?php get_sidebar('header-area'); ?>
			</div>

			<div class="profile" style="padding-left: 1rem;">
				<?php
				if (!is_user_logged_in()) { ?>
					<button id="login-button-head" onclick="togglemenu('user-area')"><i class="fas fa-sign-in-alt"></i> <?php qtx_string_e("Login"); ?></button>
					<div id="user-area" class="base-box" style="position:absolute; display:none; padding: 1rem; border-radius: 7px; border: solid 2px black;">
				<?php
			} else {
				?>
				<div id="user-area" class="" style="padding-top:1rem;">
				<?php
			}
				?>
					<?php get_sidebar('user-area'); ?>
					<a href="<?php get_permalink(); ?>?random=yes"><button style="font-size:10px" class="search-submit">Get lucky!</button></a>
				</div>
			</div>


		</header><!-- #end of the header parts -->
		<!--class="site-content"-->
		<?php get_search_form(); ?>
