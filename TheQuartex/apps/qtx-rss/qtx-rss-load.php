
<?php
//This plugin register a new post type, called extfeed, you can use it for other stuff like scraping
//It uses RSS & Atom Feeds for PHP version 1.2 for fetching, saving, displaying, etc rss feeds
//Complete tool for RSS/Atom Fetching
//TODO ability to create scheduled feeds using wp-cron and the custom taxonomies as the source
//TODO ability to use multilanguage dynamically
//load functions necesary to work with feeds
//checks wheather we have the src of feed.php
//check for dependency
//TODO this plugin is set in mastermode which means that is total shit
//set options for xml cache
//don't repeat feeds (hash)?
if (class_exists('Feed', false)) {
  $ispluginenabled = True;
  //load custom post if custompost is set to true
  if ($ispluginenabled) {
    define('LoadFunctions', TRUE);
    require get_template_directory() . '/apps/qtx-rss/custom-post.php';
  }

  //Html for bottom of the posts
  function qtxrss_recursiveTermsName($currentPostID, $taxonomyName, $objectKey = 'name') {
    $terms = get_the_terms( $currentPostID, $taxonomyName);
    if (!empty($terms)) {
      foreach ( $terms as $term ) {
        switch ($objectKey) {
          case 'name':
            //echo $term->slug;
            if (empty($term->name)) {
              return "null";
            }
            return $term->name;
          case 'id':
            //echo $term->slug;
            return $term->id;
          case 'description':
            //echo $term->slug;
            return $term->description;
          case 'slug':
            //echo $term->slug;
            return $term->slug;
          default:
            return NULL;
        }
        return NULL;
      }
    } else {
      return NULL;
    }
  }

  function qtxrss_echoExtFeedInformationBox() {
    global $post;
    if (get_post_type()=='extfeed' && !empty($post->ID)) {
      $currentPostID = $post->ID;

      //Matate wordpresss
      //$srcFeedTerms = get_the_terms( $currentPostID, 'feed_source');
      //$srcTitleTerms = get_the_terms( $post->ID, 'source_title');
      //$srcTitleTerms = get_term( $currentPostID, 'source_title', ARRAY_A );
      //$srcDescTerms = get_the_terms( $currentPostID, 'source_description');
      //$srcDateTerms = get_the_terms( $post->ID, 'source_date');
      //$srcOrigDateTerms = get_the_terms( $post->ID, 'original_date');
      //$srcLinkTerms = get_the_terms( $post->ID, 'source_link');

      //var_dump($srcLinkTerms);
      //var_dump($srcTitleTerms);
      $srcTitle = qtxrss_recursiveTermsName($currentPostID, 'source_title');
      if (!empty($srcTitle)) {
        $srcFeed = qtxrss_recursiveTermsName($currentPostID, 'feed_source');
        $srcDesc = qtxrss_recursiveTermsName($currentPostID, 'source_description');
        $srcDate = qtxrss_recursiveTermsName($currentPostID, 'original_date');
        $srcLink = qtxrss_recursiveTermsName($currentPostID, 'source_link');
      //var_dump($srcTitle);
        $bottomPost = "<!--00_random_korko_comment_00--><div class='extfeed-source-box base-box'>
        <ul class='extfeed-source-list'>
        <li>This <b>Post</b> originally appeared on:</li>
        <li><a href='$srcLink'>$srcTitle</a></li>
        <li>$srcDesc</li>
        <li>Originally dated as:</li>
        <li>$srcDate</li>
        </ul>
        </div><!--00_random_korko_comment_00-->";
        echo($bottomPost);
      } else {
        return NULL;
      }
    }
  }
  //capabilities checks
  if (qtx_is_staff()) {
    $user_name = "QTXFeedsBOT";
    $user_id = username_exists( $user_name );
    if ( ! $user_id ) {
      echo "<br>The user id " . $user_id;
      echo "<br>The user name " . $user_name;
      echo "We are inside the user creation";
      $random_password = wp_generate_password( $length = 20, $include_standard_special_chars = false );
      $user_id = wp_create_user( $user_name, $random_password );
      echo "<br>The user id " . $user_id;
      echo "<br>The user name " . $user_name;
      echo "<br>The user password " . $random_password;
      $post_content = "<br>The user id " . $user_id . "<br>The user name " . $user_name . "<br>The user password " . $random_password . "<br>lenght " . $length;
      $my_post = array(
        'post_title'    => "$user_name data generated by qtxRSS",
        'post_content'  => $post_content,
        'post_status'   => 'draft',
        'post_author'   => 1,
      );
      wp_insert_post( $my_post );
    }
    //echo "<br>" . "<br>" . get_template_directory() . "<br>";

    //load load frontend functions, sanitization, form output TODO
    define('LoadFrontend', TRUE);
    require get_template_directory() . '/apps/qtx-rss/frontend.php';

    //load options page TODO
    //define('LoadOptions', TRUE);
    //require get_template_directory() . '/apps/qtx-rss/options-page.php';

    //plugin initialization
    //load feed profiles functions qtx_current_feed()
    define('LoadProfiles', TRUE);
    require get_template_directory() . '/apps/qtx-rss/feed-profiles.php';

    //Load fetching functions qtx_fetch_source() and qtx_fetch_feed()
    define('LoadFetching', TRUE);
    require get_template_directory() . '/apps/qtx-rss/fetch-feed.php';


    //handle get_post


    //handle tags creation
    function qtx_createTagsArray($arrayInput) {
      $tags = array('');
      $tags_dirty = str_word_count(htmlSpecialChars($arrayInput), 1);
      $j = 0;
      foreach ($tags_dirty as $key => $value) {
        if (strlen($tags_dirty[$j])>5 && $j<=150) {
          array_push($tags, $value);
          if (count($tags)==20) {
            return $tags;
          }
        } elseif ($j>150) {
          return $tags;
        }
        $j=$j+1;
      }
    }

    function qtx_setPostThumbFromURL_simple($inputImageURL, int $insertIntoThisPostID, string $imageDescription = "This image was fetched using Quartex.net Syndication") {
      require_once(ABSPATH . 'wp-admin/includes/media.php');
      require_once(ABSPATH . 'wp-admin/includes/file.php');
      require_once(ABSPATH . 'wp-admin/includes/image.php');
      //echo "we are here<br>";
      if (!empty($inputImageURL)) {
        //returns 'id' from attachment
        //echo "we are in media sideload <br>";
        $featuredImageID = media_sideload_image( $inputImageURL, $insertIntoThisPostID, $imageDescription, 'id' );
        //var_dump($featuredImageID);
        set_post_thumbnail( $insertIntoThisPostID, $featuredImageID );
      }
      //echo "if didnt work";
    }

    //returns $imageURL array of $matches from preg_match
    //$returnArray is boolean for knowing if we return a full array of $matches or just one imageURL
    function qtx_getArrayOfImageFromHTML_simple($returnArray = True, string $inputString) {
      //We get the first image url from the description
      //https://wordpress.stackexchange.com/questions/40301/how-do-i-set-a-featured-image-thumbnail-by-image-url-when-using-wp-insert-post
      //https://developer.wordpress.org/reference/functions/media_sideload_image/
      //https://developer.wordpress.org/reference/functions/set_post_thumbnail/
      //https://stackoverflow.com/questions/41524931/how-to-set-featured-image-programmatically-from-url

      //We perform a preg_match and load the results into $matches($imageURL)
      preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $inputString, $imageURL);
      if ($returnArray==True) {
        //We return the entire array of matches
        //echo $imageURL;
        return $imageURL;
      } else {
        //echo "<br>".$imageURL['src'];
        //We return just one link string
        if (!empty($imageURL['src'])) {
          return $imageURL['src'];
        } else {
          return "";
        }
        //echo $imageURL['src'];
      }
    }
    /*
    function qtxrss_debugPostInsert() {
      echo "<div style='padding-top: 15px; margin-top:14px; display:block;'>";
              var_dump($postContentParsed);
              var_dump($postContentParsed->element);
              echo (string)$postContetnParsed->element.PHP_EOL;
              echo $postContentParsed->asXML();
      echo "</div>";
      //var_dump($one_post);
      //We insert the post and get the current post_id into a variable
      //var_dump($one_post);
    }
    */
    //handle wp_post insertion, we pass it a feed array consisting of individual posts ARRAY_A
    function qtx_rss_insert($fetched_source, $qtx_feed_array, $language, $category, $update = False) {
      $user_name = "QTXFeedsBOT";
      //We get the id for our username, this will be the one who posts
      $user_id = username_exists( $user_name );
          //echo "<br>" . $value;
          //echo "<br>" . "we are inserting";

          //we have an indexted array of ARRAY_A values. so for each of them we operate
          if (empty($qtx_feed_array)) {
            echo "<br>feed_array empty<br>";
            return;
          }
          for ($i=0; $i < count($qtx_feed_array); $i++) {
            //var_dump($qtx_feed_array[$i]);
            $tags = qtx_createTagsArray($qtx_feed_array[$i]['description']);
            //echo "<br>" . $i;
            //echo "<br>" .($qtx_feed_array[$i]['description']); //success
            if ($update) {
              if (qtx_is_staff()) {
                echo "Source data will be updated";
              }
            } else {
              if (qtx_is_staff()) {
                echo "Source data will not be updated only source_date";
              }
            }
            $srcTitle = $fetched_source['source_title'];
            $srcDesc = $fetched_source['source_description'];
            $srcIsAtom = $fetched_source['isatom'];
            $srcIsRSS = $fetched_source['isrss'];
            /*
            this is for the array $taxArray
            */
            $srcFeedXML = $fetched_source['sourcefeedxml'];
            $srcOrigDate = $qtx_feed_array[$i]['original_date'];
            $srcLink = $fetched_source['source_link'];
            $feedSRC = $fetched_source['source_title'];
            $srcDate = $fetched_source['source_date'];
            //Array for tax_input
            if (!$update) {
              $taxArray = array('feed_sources' => $feedSRC, 'source_title' => $srcTitle, 'source_description' => $srcDesc, 'source_date' => $srcDate, 'original_date' => $srcOrigDate, 'source_link' => $srcLink, 'sourcefeedxml' => $srcFeedXML, 'isatom' => $srcIsAtom, 'isrss' => $srcIsRSS );
            } else {
              $taxArray = array('feed_sources' => $feedSRC, 'source_title' => $srcTitle, 'source_description' => $srcDesc, 'source_date' => $srcDate, 'original_date' => $srcOrigDate, 'source_link' => $srcLink, 'sourcefeedxml' => $srcFeedXML, 'isatom' => $srcIsAtom, 'isrss' => $srcIsRSS );
            }
            //Simple concatenation
            $postStatus = 'publish';
            //new code
            /*
            $postContentParsed = $qtx_feed_array[$i]['content']->asXML();
            $patterns = array("<![CDATA[<","]]>");
            $replacements = array("","");
            $postContentParsed = preg_replace($patterns, $replacements, $postContentParsed);
            $postContentParsed = $imageHTML . $postContentParsed;
            */
            $auxPostContentParsed = $qtx_feed_array[$i]['description'];
            $strPostContentParsed = (string)$auxPostContentParsed;
            //print_r($postContentParsed);
            //returns $imageURL array of $matches from preg_match
            $returnArray = False; //this will return a string otherwise an array
            //We get a string with an imageURL
            $imageURL = qtx_getArrayOfImageFromHTML_simple($returnArray, $qtx_feed_array[$i]['description']);
            //echo "we got this image $imageURL";
            // HTML for image
            if (empty($imageURL)) {
              $imageURL = get_site_url()."/wp-content/themes/TheQuartex/img/synth.png";
              //workaraund for dupe image bug
              $isImageDefault = True;
              $imageHTML = "<img src='$imageURL' class='post-thumb'><br>";

              if ($feedSRC == 'PiviGames') {
                $postContentParsed = $auxPostContentParsed;
              } else {
                $postContentParsed = $imageHTML . $strPostContentParsed;
              }
            } else {
              if ($feedSRC == 'PiviGames') {
                $isImageDefault = False;
                $postContentParsed = $auxPostContentParsed;
              } else {
                $isImageDefault = False;
                $postContentParsed = $strPostContentParsed;
              }

            }
            //$imageHTML = "<img src='$imageURL' class='post-thumb'><br>";
            //$postContentParsed = $stringprepostContentParsed;

            print_r($postContentParsed);
            //new code
            if (strlen($postContentParsed) < 120) {
              $postStatus = 'draft';
            }
            $postExcerpt = substr(strip_tags($qtx_feed_array[$i]['description']), 0, 200) . '...';
            /*. $bottomPost;*/
            $one_post = array(
              'post_title'    => strip_tags($qtx_feed_array[$i]['title']),
              'post_content'  => $postContentParsed,
              'post_excerpt'  => $postExcerpt,
              'post_status'   => $postStatus,
              'post_author'   => $user_id,
              'filter'        => true,
              'post_type'     => 'extfeed',
              'ping_status'   => 'closed',
              'comment_status' => 'closed',
              'tags_input'    => $tags,
              'tax_input'     => $taxArray,
              'post_category' => $category,
              //'post_category' => array( 1,2 )
            );
            sleep(1);
            //qtxrss_debugPostInsert();

            $currentID = wp_insert_post($one_post);

            /* Preg replace
            $patterns = array("&lt;![CDATA[","]]&gt;","<![CDATA[<","]]>","<description>","</description>");
            $replacements = array("","","","","","");
            $my_post = get_post($currentID);
            $oldcontent = $content_post->post_content;
            $content_post->post_content = preg_replace($patterns, $replacements, $oldcontent);
            wp_update_post( $my_post );
            */

            //set poly lang language
            pll_set_post_language($currentID, $language);
            /*
            Trying to set the terms language TODO
            foreach ($taxArray as $key => $value) {
              //$terms = get_the_terms($currentID, $key);
              $terms = get_term_by('name', $value, $key);
              if (!empty($terms)) {
                foreach ($terms as $term) {
                  $taxonomyid = $term->id;
                }
              }
              pll_set_term_language($taxonomyid, $language);
            }
            */

            if (!empty($imageURL) && $isImageDefault == False) {
              //echo "we entered here";
              //we set our description otherwise it will use default
              $imageDescription = strip_tags($qtx_feed_array[$i]['title']);
              //We set the post thumbnail
              qtx_setPostThumbFromURL_simple($imageURL, $currentID, $imageDescription);
            } else {
              //Esto es una garcha, no hagas esto. Reestructura el flujo del programa, y acomoda la funcioncita, ok?
              set_post_thumbnail( $currentID, 4839 );
            }
          }
        //}
      //endfor;
    }

    function qtx_feed_handle($arrayOfFeeds, $isatom, $isrss, $language, $category, $lastPostTitle = "", $arrayOfTitles = array(), $full = False) {
      $mastermode = True;
      if ($mastermode) {
        //$rss = qtx_current_feed(); //get current feed we are working
        //$rss_url_force = 'http://localhost/rss-php/rss_euro';
        //$arrayOfFeeds = qtx_get_arrayOfFeeds();
        for ($i=0; $i < count($arrayOfFeeds); $i++) {
          if ($isatom or $isrss) {
            if ($lastPostTitle == "") {
              $url_force = $arrayOfFeeds[$i];
              //echo "<br>" . $url_force;
              $feedObject = qtx_force_feedUrl($url_force, $isatom, $isrss);
              //var_dump($rss);
              //Ah no soy tan pesimo como yo pensaba esto bien programado
              $fetched_source = qtx_fetch_source($feedObject, $url_force, $isatom, $isrss); //Load return value to a variable
              //var_dump($fetched_source); //dump
              //echo "<br>" . "<br><br><br>";
              $qtx_feed_array = qtx_fetch_feed($feedObject, $isatom, $isrss, $lastPostTitle); //Load return value to a variable
              //var_dump($qtx_feed_array);
              //echo "we are about to insert";
              //var_dump($category);
              qtx_rss_insert($fetched_source, $qtx_feed_array, $language, $category);
              //echo "<br>" . "hola";
              //print_r($qtx_feed_array);
            } else {
              /*If we are updating the feed from database*/
              $url_force = $arrayOfFeeds[$i];
              //echo "<br>" . $url_force;
              $feedObject = qtx_force_feedUrl($url_force, $isatom, $isrss);
              //var_dump($rss);
              //Ah no soy tan pesimo como yo pensaba esto bien programado
              $fetched_source = qtx_fetch_source($feedObject, $url_force, $isatom, $isrss); //Load return value to a variable
              //var_dump($fetched_source); //dump
              //echo "<br>" . "<br><br><br>";
              $dates_db = get_terms(array('taxonomy' => 'source_date', 'hide_empty' => false,));
              //var_dump($dates_db);
              foreach ($dates_db as $term) {
                echo "$term->name<br>";
                echo "<br>".$fetched_source['source_date'];
                if (similar_text($fetched_source['source_date'],$term->name)) {
                  echo "The date ".$fetched_source['source_date']."was found in the database, so no running update";
                  return;
                }
              }
              echo "<br>Still here";
              $qtx_feed_array = qtx_fetch_feed($feedObject, $isatom, $isrss, $lastPostTitle, $arrayOfTitles, $full); //Load return value to a variable
              //var_dump($qtx_feed_array);
              //echo "we are about to insert";
              //var_dump($category);
              $update = True;
              qtx_rss_insert($fetched_source, $qtx_feed_array, $language, $category, $update);
              //echo "<br>" . "hola";
              //print_r($qtx_feed_array);
            }
          } else {
            echo "error this feed was not properly handled";
          }
        }
      }
    }

    function mastermode($language = 'en', $category = array(8)) {
      //echo "we are in mastermode";
      //var_dump($category);
      //load filepaths, and other config
      if(!defined('LoadConfig')) {
        define('LoadConfig', TRUE);
      }
      require(get_template_directory() . '/apps/qtx-rss/config.php');
      $first_step = True;
      while (True) {
        if ($first_step) {
          //echo "<br>" . "first step if else";
          $isatom = False;
          $isrss = True;
          $arrayOfFeeds = $rss_feeds;
          if (!empty($arrayOfFeeds)) {
            qtx_feed_handle($arrayOfFeeds, $isatom, $isrss, $language, $category);
            //rename used file and create new one
            $new_rss_filepath = get_template_directory() . '/apps/qtx-rss/mastermode/rss' . rand() . '.txt';
            rename($rss_filepath, $new_rss_filepath);
            file_put_contents($rss_filepath, "");
            echo "<br>" . "succesfully imported rss resources";
          } else {
            echo "<br>" . "file was empty rss";
          }
          //end first step
          $first_step = False;
        } else {
          //echo "<br>" . "second step if else";
          $isatom = True;
          $isrss = False;
          $arrayOfFeeds = $atom_feeds;
          if (!empty($arrayOfFeeds)) {
            qtx_feed_handle($arrayOfFeeds, $isatom, $isrss, $language, $category);
            //rename used file and create new one
            $new_atom_filepath = get_template_directory() . '/apps/qtx-rss/mastermode/atom' . rand() . '.txt';
            rename($atom_filepath, $new_atom_filepath);
            file_put_contents($atom_filepath, "");
            echo "<br>" . "succesfully imported atom resources";
          } else {
            echo "<br>" . "file was empty atom";
          }
          break;
        }
      }
    }


//    function update_file($filepath, $feed_url) {
  //    file_put_contents($filepath, $feed_url); This should not be used like this in a for
  //https://www.php.net/manual/en/function.file-put-contents.php
  //  }

    //handle operation from frontend
    /*function qtx_feed_handle() {
      //feed by feed
      while True {
        if get display {
          require get_template_directory() . '/apps/qtx-rss/display-feed.php';
          return False;
        } elseif get fetch {
          require get_template_directory() . '/apps/qtx-rss/fetch-feed.php';
          return False;
        } elseif get create_posts {

        }
      }
    }*/


  } else {
    function mastermode($language, $category) {
      echo "<br>" . "You've fucked up. GTFO.";
    }
    //echo "<br>" . "You've really fucked up my friend.";
  }
  function qtxrss_execMastermode() {
    global $wp;
    $url = home_url( $wp->request ); //get current url
    if (function_exists('mastermode') && qtx_is_staff()) {
      if (isset($_POST['qtxRSS'])) {
        $language = $_POST['language'];
        $category = array(intval($_POST['cat']));
        //echo $language."and".$category;
        mastermode($language, $category);
      } else {
        echo "qtxRSS is not set in POST variable";
      }
      /*
      $ss = pll_languages_list();
      var_dump($ss)
      */
?>
      <form action="<?php echo($url); ?>" id="mastermode" method="post">
        <input type="hidden" name="qtxRSS" value="yes" />
        <br><label for="category">Choose a category:</label><br>
        <?php wp_dropdown_categories( 'hide_empty=0' ); ?>
        <br><label for="language">Choose a language:</label><br>
        <select name="language" id="language" form="mastermode">
          <option value="en">English</option>
          <option value="es">Spanish</option>
        </select>
       <p><input type="submit" value="Exec Mastermode" /></p>
      </form>
<?php
    } else {
      echo "<br>" . "You are not supposed to view this content.";
    }
  }
  function qtxrss_execFrontendForm() {
    if (function_exists('qtxrss_execFrontForm') && qtx_is_staff()) {
      qtxrss_execFrontForm();
      qtxrss_printFeeds();
      qtxrss_resetFile();
    } else {
      echo "<br>" . "You are not supposed to view this content.";
    }
  }
} else {
  //Error
  if(!defined('QTXRSS')) {
     die('Undefined');
  }
  echo "<br>" . "You are trying to load qtx-rss (Template/Plugins folder) without first loading <br> RSS & Atom Feeds for PHP <br> version 1.2";
  echo "<br>" . "<br>";
  echo "<br>" . "https://github.com/dg/rss-php/releases";
}
?>
