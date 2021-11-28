<?php

function qtxDownloadsCache_deactivate() {
    wp_clear_scheduled_hook( 'qtxDownloadsCache_cron' );
}
/* For testing purposes, you can create a schedule of one minute
add_filter( 'cron_schedules', 'cron_add_minute' );
function cron_add_minute( $schedules ) {
   // Adds once weekly to the existing schedules.
   $schedules['minute'] = array(
       'interval' => 60,
       'display' => __( 'Once Minute' )
   );
   return $schedules;
}
*/
add_action('init', function() {
    add_action( 'qtxDownloadsCache_cron', 'qtxDownloadsCache_run_cron' );
    register_deactivation_hook( __FILE__, 'qtxDownloadsCache_deactivate' );

    if (! wp_next_scheduled ( 'qtxDownloadsCache_cron' )) {
        wp_schedule_event( time(), 'Daily', 'qtxDownloadsCache_cron' );
    }
});


//This function creates an html with data for front-page-php downloads boxes
/*
function qtxQueryPostsLanguageCategoriesQuantity ($lang, $cats, $quantity) {

}
*/

function qtxDownloadsQuery($language, $quantity) {
  if($language=='en') {
      $cats_query = array( 'descargas', 'downloads', 'downloads-videogames', 'descargas-videojuegos', 'videogames-downloads', 'descargar-videojuegos', 'software-hub', 'centro-de-software' );
      $lang = 'en';
      $new_name = get_template_directory() . '/apps/qtx-cache/cache/front/4-downloads-en'.rand().'.html';
      $cache_file = get_template_directory() . '/apps/qtx-cache/cache/front/4-downloads-en.html';
  } else {
      $cats_query = array( 'descargas', 'downloads', 'downloads-videogames', 'descargas-videojuegos', 'videogames-downloads', 'descargar-videojuegos', 'software-hub', 'centro-de-software' );
      $lang = 'es';
      $cache_file = get_template_directory() . '/apps/qtx-cache/cache/front/4-downloads-es.html';
      $new_name = get_template_directory() . '/apps/qtx-cache/cache/front/4-downloads-es'.rand().'.html';
  }
  if (is_writable($cache_file)) {
  rename($cache_file, $new_name);
  } else {
    if (qtx_is_staff()) {
      echo "file it's not writable";
    }
  }
  $fopenCacheFile = fopen($cache_file, "w");
  if (!$fopenCacheFile) {
    if (qtx_is_staff()) {
      echo "file wasn't open";
    }
  }
  $post_query_args = array(
  		//we only get roles_query userIDs see above get_users() query
      'post_type' => 'post',
  		'posts_per_page' => $quantity,
      'lang'     => $lang,
      'offset' => 5,
      'post_status' => 'publish',
  		//get paged, this is a secured wordpress way of getting pages
  		//tax query to find only posts from the cats_query categories taxonomy
      'tax_query' => array(
          array(
              'taxonomy' => 'category',
              'field'    => 'slug',
              'terms'    => $cats_query,
  						'include_children' => true,
          ),
      ),
  );
  	// the query
  	$the_query = new WP_Query($post_query_args);
  	if ($the_query->have_posts()) {
        $j = 0;
        while ( $the_query->have_posts() ) : $the_query->the_post();
          $j=$j+1;
          $my_post = get_post();
          //var_dump($my_post);
          $type = "downloads";
          $post_id = apply_filters( 'ID', $my_post->ID );
          //fix try to get the permalink
          $permalink = apply_filters( 'guid', $my_post->guid );
          $title_attrib = apply_filters('post_name', $my_post->post_name);
          $post_title = qtx_category_icon() . apply_filters('the_title', $my_post->post_title);
          /*if (strlen($post_title) > 48) {
            $post_title = substr($post_title($before = '', $after = '', FALSE), 0, 52) . '...';
          }*/
          $thumb_url = wp_get_attachment_url(get_post_thumbnail_id());
          if (empty($thumb_url)) {
            $thumb_url = get_template_directory_uri()."/img/synth.png";
          }
          $post_thumb = "<img src='".$thumb_url."'>";
          //$contents = array('');
          if(($j==1) or ($j==3)) {
            $open_div = "<div id='downloads-box-".$j."' class='post-box-downloads'>";
            fwrite($fopenCacheFile, $open_div);
          }
          //echo($j . $type . $permalink . $title_attrib . $post_title);
          if ($post_title&&$permalink) {
            $post_contents = "<div id='download-".$j."' class='base-box post-".$type."-frontpage'>"."\n"."<a href='".$permalink."' "."title='".$title_attrib."'>"."\n"."<div class='post-title-downloads'>"."\n"."<span><h4 class='post-title-h5'>".$post_title."</h4></span></div><div id='post-thumb-".$j."'class='post-thumb-downloads'>".$post_thumb."\n"."</div></a></div>"."\n";
          } else {
            if (qtx_is_staff()) {
              echo "post_title was empty";
            }
          }
          //echo $post_contents;
          fwrite($fopenCacheFile, $post_contents);
          if(($j==2) or ($j==4)) {
            //echo "testing";
            $close_div = "</div>";
            fwrite($fopenCacheFile, $close_div);
          }
        endwhile;
        if ($j==3) {
          $close_div = "</div>";
          fwrite($fopenCacheFile, $close_div);
        }
        //this is for bug in which 3 posts screw the page
        fclose($fopenCacheFile);
        wp_reset_postdata();
    } else {
    fwrite($fopenCacheFile, "No posts found in query");
    fclose($fopenCacheFile);
    }
}

function qtxEchoDownloads() {
  /*
  dumps all crons
  echo '<pre>';
  print_r( _get_cron_array() );
  echo '</pre>';
  */
  if(pll_current_language() == 'en') {
    $lang = "en";
  } else if(pll_current_language() == 'es') {
    $lang = "es";
  }
  $cache_file = get_template_directory() . '/apps/qtx-cache/cache/front/4-downloads-'.$lang.'.html';
  if (is_writable($cache_file)) {
    require($cache_file);
  } else {
    if (qtx_is_staff()) {
      echo "file wasn't open at echoDownloads";
    }
  }
}
function qtxDownloadsCache_run_cron() {
  //echo "qtxDownloadsCache Cron";
  //$content = array('');
  $quantity = 4;
  //echo $quantity;
  //This function creates an html with data for front-page-php downloads boxes
  /*
  for ($i=0; $i < 2; $i++) {
    //echo $i;
    if ($i == 0) {
    } else {
    }
    //echo "Query execution";
  }
  */
  $language = 'en';
  qtxDownloadsQuery($language, $quantity);
  $language = 'es';
  qtxDownloadsQuery($language, $quantity);
}
//This function creates a list of dowloands in html format
//TODO
//This function creates an html file for downloads-page
?>
