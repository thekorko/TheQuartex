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
	<style>
	@media screen and (max-width: 390px) {
	  .main-posts {
	    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)) !important;
			margin: 0 0.2em 0 0.2em !important;
			padding: 0.3em !important;
	  }
		.primary {
			grid-template-columns: 1fr !important;
			padding: 0;
			margin: 0 0 !important;
		}
		#header {
			grid-template-columns: 1fr !important;
			grid-template-rows: 1fr !important;
		}
	}
	@media screen and (max-width: 650px) {
		#home-area-top {
			display: none;
		}
	  #header {
	    display: grid !important;
	    grid-template-columns: 1fr 1fr;
	    grid-template-rows: 1fr 1fr;
	  }
	  /* #sidebar {
	    display: none;
	  } */
	  .main-posts {
	    padding-left: 0.0em;
	  }
	  #user-area {
			margin-left:-60px;
			padding-bottom: 1rem;
	    display: none;
	  }
		.large-box {
			margin: 1em 0.2em 1em 0.2em !important;
			padding: 0.3em !important;
		}
		.attention-box {
			margin: 0.5em 0.2em 0.5em 0.2em !important;
			padding: 0.3em !important;
		}
		.post-pagination {
			margin: 1.2em 0 1.2em 0 !important;
		}
	}
	@media screen and (min-width: 651px) {
	  /* #sidebar {
	    display: block;
	  } */
		#home-area-top {
		}
	  .main-posts {
	    padding-left: 0.6em;
	  }
	  #user-area {
			margin-left:-100px;
	    display: block;
	  }
	}
/*
	* Font fonts typeface TODO check licenses
*/
	@import url('https://fonts.googleapis.com/css2?family=Pirata+One&family=Roboto:wght@300;400;700&display=swap');
	</style>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
				</div>
			</div>


		</header><!-- #end of the header parts -->
		<!--class="site-content"-->
		<?php get_search_form(); ?>
