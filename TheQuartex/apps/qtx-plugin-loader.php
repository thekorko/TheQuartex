<?php
/**
* Sources for quartex apps
* Plugin loader
* Every plugin it's individually secured
*/
/**
* Add support for various mime types
*/
if(!defined('QTXLoader')) {
    die('');
}
$qtx_add_mime_types_load = get_template_directory() . '/apps/qtx-wpfilters/quartex-add-mime-types.php';
if (is_file($qtx_add_mime_types_load)) {
	require $qtx_add_mime_types_load;
}
/**
* Require authentication for REST API
*/
$qtx_rest_api_filters_load = get_template_directory() . '/apps/qtx-wpfilters/quartex-rest-api-filters.php';
if (is_file($qtx_rest_api_filters_load)) {
	require $qtx_rest_api_filters_load;
}
/**
* RSS feed source code
* rss-php
*/
$script_feed_load = get_template_directory() . '/inc/src/rss/Feed.php';
if (is_file($script_feed_load)) {
	require $script_feed_load;
}
/**
* simple_scraper_dom source code
* scraper
*/
$simple_html_dom_load = get_template_directory() . '/inc/src/scraper/simple_html_dom.php';
if (is_file($simple_html_dom_load)) {
	require $simple_html_dom_load;
}
/**
* Load qtx-rss plugin/app
*/
define('QTXRSS', True);
$qtx_rss_load = get_template_directory() . '/apps/qtx-rss/qtx-rss-load.php';
if (is_file($qtx_rss_load)) {
	require $qtx_rss_load;
}
/**
* Load qtx-anonymize plugin/app
*/
$qtx_anonymize_load = get_template_directory() . '/apps/qtx-anonymize/anonymize-load.php';
if (is_file($qtx_anonymize_load)) {
	require $qtx_anonymize_load;
}
/**
* Load qtx-cache plugin/app
*/
$qtx_cache_load = get_template_directory() . '/apps/qtx-cache/qtx-cache-load.php';
if (is_file($qtx_cache_load)) {
	require $qtx_cache_load;
}
?>
