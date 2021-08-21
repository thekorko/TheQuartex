<?php
/**
 * Template part for post toolbar
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TheQuartex
 *
 */

?>
<?php if (1 == 2): ?>

  <div id="post-toolbar" class="row" style=""> <!-- This is the toolbar row for each post box -->

    <!--TODO: This should be a template part-->

    <!-- Each tool contains a button with an image that appeals visually and represents a related feature -->
    <div id="post-upvote" class="col-xs-3 col-md-3 post-toolbar"> <!-- this is a tool container -->
      <button><img src="<?php //echo get_template_directory_uri(); ?>/img/green_skull.png"></button>
      <!-- this green one is the classic upvote, granting something like karma, points or expressing that you trust this post -->
    </div>
    <!--TODO: Fix the size of the icons, create new icons, make this only visible on mouse hover-->


    <div id="post-upvote-vip" class="col-xs-3 col-md-3 post-toolbar"> <!-- this is a tool container meant for vip upvote-->
      <button><img src="<?php //echo get_template_directory_uri(); ?>/img/skull.png"></button>
    </div>


       <div class="col-xs-2 col-md-2 post-toolbar"> <!-- this is a tool container meant for downvoting, this one is tricky because it should be limited -->
      <button><img src="<?php //echo get_template_directory_uri(); ?>/img/arrow_down.png"></button>

    </div>

    <div class="col-xs-1 col-md-2 post-toolbar"> <!-- this is an empty tool container  -->

      <!-- empty -->

    </div>

    <div class="col-xs-1 col-md-2 post-toolbar"> <!-- this is the one meant for personalized content experience -->

      <button><img src="<?php //echo get_template_directory_uri(); ?>/img/destroy.png"></button>

    </div>
    </div>



    <div class="row" style="display:none;">
      <div class="col-xs-9">
        <!--This empty space is supposed to be used for: author, category, tags? -->
      </div>
      <div class="col-xs-3 col-md-3 post-toolbar absolute-box">

        <!--<button><a href="<?php //echo get_site_url(); ?>/dmca"><img src="<?php //echo get_template_directory_uri(); ?>/img/dmca.png"></a></button>--> <!--The tool meant to be chaotic lawful -->

      </div>
    </div>

<?php endif; ?>
