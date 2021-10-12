<?php
if(!defined('LoadProfiles')) {
    die('Profiles');
}
$mastermode = True;
//echo "<br>" . "mastermode is" . $mastermode . "in feed-profiles.php" . "<br>";
if ($mastermode && qtx_is_staff()) {
  //load custom post if custompost is set to true

  //Check if it's url(user validation)
  //chek if it's rss source

  function qtx_force_feedUrl($feed_url, $isatom, $isrss) {
    if ($isatom) {
      echo "<br>" . "force_feedurl received atom" . "<br>";
      $atom_feedObject = Feed::loadAtom($feed_url);
      return $atom_feedObject;
    } elseif ($isrss) {
      echo "<br>" . "force_feedurl received rss";
      //'http://localhost/rss-php/rss_euro'
      $rss_feedObject = Feed::loadRss($feed_url);
      return $rss_feedObject;
    } else {
      echo "<br>" . "qtx_force_feedUrl received another thing" . "<br>";
    }

  }

  function qtx_extraOptions() {
    Feed::$cacheDir = __DIR__ . '/xml';
    Feed::$cacheExpire = '1 month';
    //You can setup a User-Agent if needed:
    //
    //Feed::$userAgent = "FeedFetcher-Google; (+http://www.google.com/feedfetcher.html)";
  }

} else {

  function qtx_get_arrayOfFeeds($param = "") {
    if ($param == "") {
      $url_listOption = get_option( 'qtxrss_url_list' );
    }
    $url_arrayOfFeeds = preg_split("/[\s,;]+/", $url_listOption);
    //$url_arrayOfFeeds = explode(",", $url_listOption);
    return $url_arrayOfFeeds;
  }

  /*
  *function qtxrss_arrayregex() {
  *
  *}
  */


  /*
  *function qtx_currentFeed($array_feeds) {
  *  get array of feeds from passed variable
  *  $current = something
  *  delete that something from array of feeds
  *  save options
  *  set current feed in options
  *  return;
  *}
  *function qtx_feedUsed() {
  *
  *}
  */
}

?>
