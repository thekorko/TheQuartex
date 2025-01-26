<?php
/**
 * Template part for displaying posts like adsense
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TheQuartex
 *
 */
$showPlaceholder = false;
if (!$showPlaceholder): ?>
<div id="ads-featured" class="base-box post-box post-normal">

</div>
<?php else: ?>
<?php
  $image = get_template_directory_uri();
  $randomImage = array("/img/placeholders/juice.png","/img/placeholders/is_libre.png","/img/placeholders/buy_this_ad.png");
  $link = get_site_url()."/contact";
  $randomContent = array("get_orange_juice","quartex_is_libre","buy_this_ad");
  $randomNumber = rand(0, count($randomImage) - 1);
?>
  <a href="<?php echo $link ?>" title="Featured ads from quartex.net">
      <div id="post-title">
        <div class="post-title">
          <span><h4 class="post-title-h4">
            <center>
              <i class="fas fa-ad"></i><?php qtx_string_e("featured_content"); ?> <i class="far fa-star"></i></center>
            </h4></span></div>
          </div>
          <div id="post-thumb" class="row">
            <div class="post-thumb">
              <img src="<?php echo $image.$randomImage[$randomNumber]; ?>"> </div>
            </div>
            <center>
              <p><?php qtx_string_e($randomContent[$randomNumber]); ?></p>
            </center>
        </a>
<?php endif; ?>
