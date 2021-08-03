<?php
$rss_filepath = get_template_directory() . '/apps/qtx-rss/mastermode/rss.txt';
$rss_feeds = file($rss_filepath, FILE_IGNORE_NEW_LINES);
//var_dump($rss_feeds);
$atom_filepath = get_template_directory() . '/apps/qtx-rss/mastermode/atom.txt';
$atom_feeds = file($atom_filepath, FILE_IGNORE_NEW_LINES);
?>
