<?php function display_feed_default($rss_feedObject) { ?>

<h1><?php echo htmlSpecialChars($rss_feedObject->title) ?></h1>

<p><i><?php echo htmlSpecialChars($rss_feedObject->description) ?></i></p>

<?php foreach ($rss_feedObject->item as $item): ?>
	<h2><a href="<?php echo htmlSpecialChars($item->link) ?>"><?php echo htmlSpecialChars($item->title) ?></a>

	<?php if (isset($item->{'content:encoded'})): ?>
		<div><?php echo $item->{'content:encoded'} ?></div>
	<?php else: ?>
		<p><?php echo ($item->description) ?></p>
	<?php endif ?>
<?php endforeach;
//$qtx_post_array = array($title, $description, $content, $link, $author); //a wordpress post
//$qtx_feed_array = array($qtx_post_array); //array of fetched feed posts
}
?>
