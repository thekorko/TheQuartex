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
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5750670113076133"
      crossorigin="anonymous"></script>
 <ins class="adsbygoogle"
      style="display:block"
      data-ad-format="fluid"
      data-ad-layout-key="-cv-1g-4t+7i+c3"
      data-ad-client="ca-pub-5750670113076133"
      data-ad-slot="2346393941"></ins>
 <script>
      (adsbygoogle = window.adsbygoogle || []).push({});
 </script>
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
