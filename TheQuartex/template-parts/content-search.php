<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TheQuartex
 */
 /*
	* Include the Post-Type-specific template for the content.
	* If you want to override this in a child theme, then include a file
	* called content-___.php (where ___ is the Post Type name) and that will be used instead.
	*/
    $type = "archives";
    $j = 'search';
    qtx_echo_post_box($j, $type);
?>
