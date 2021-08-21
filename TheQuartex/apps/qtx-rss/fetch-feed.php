<?php
/*
*
* Setup Cron Jobs
*
*/
/*
	function qtxRSSFetchAllFeeds_deactivate() {
    	wp_clear_scheduled_hook( 'qtxDownloadsCache_cron' );
		}

	add_action('init', function() {
    	add_action( 'qtxRSSFetchAllFeeds_cron', 'qtxRSSFetchAllFeeds_run_cron' );
    	register_deactivation_hook( __FILE__, 'qtxRSSFetchAllFeeds_deactivate' );

    	if (! wp_next_scheduled ( 'qtxRSSFetchAllFeeds_cron' )) {
        	wp_schedule_event( time(), 'Daily', 'qtxRSSFetchAllFeeds_cron' );
    	}
		});
	function qtxRSSFetchAllFeeds_run_cron() {
		if (qtx_is_staff()) {
			//obtener el ultimo post y sus taxonomies
			$allFeeds = get_terms('sourceFeedXML');
			if (!empty($allFeeds)) {
				$arrayOfFeeds = array();
				foreach ($variable as $key => $value) {
					array_push($arrayOfFeeds, $AllFeeds[0]->name);
				}
			}
			//Crear un array con un unico feed o con todos los feeds existentes
			qtx_feed_handle($arrayOfFeeds, $isatom, $isrss, $language, $category, $lastPostTitle);
		}
	}
	*/
	//fetches source information and returns an array
	function qtx_fetch_source($feedObject, $url_force, $isatom, $isrss) {
		//Array declaration is fine this way if you need a valid empty array just $var = array()
		//Ah no soy TAN PESIMO como yo pensaba esto bien programado
		//Si esto lo tengo que fetchear una vez nomas
		$feed_type =
		$fetched_source = array(
			'isatom' => $isatom,
			'isrss' => $isrss,
			'sourceFeedXML' => $url_force,
			'source_title' => $source_title = htmlSpecialChars($feedObject->title), //Website title
			'source_description' => $source_description = htmlSpecialChars($feedObject->description), //Website description
			//'owned' => $source_owned_tag => "Korkunç", //fun
			'source_link' => $source_link = htmlSpecialChars($feedObject->link), //Web Url
			'source_date' => $source_date = htmlSpecialChars($feedObject->lastBuildDate), //lAST date feed was built
		);
		echo "source fetched";
		return $fetched_source; //return array of data
	}

	//$qtx_post_array = array($title,$description,$content,$link,$author_name); //This creates an array with array[0] Null
	//$qtx_feed_array = array(); //array of fetched feed posts //This creates an empty array

	//fetches a feed for posts
	function qtx_fetch_feed($feedObject, $isatom, $isrss, $lastPostTitle = "") {
		//we create an empty array otherwise array_push() will output: expected array on parameter 1
		$qtx_feed_array = array();
		//For each item in the rss feed object we check item data and store in an array
		$checkPostTitle = False;
		if (!empty($lastPostTitle)) {
			$checkPostTitle = True;
		}
		if ($isatom) {
			foreach ($feedObject->entry as $entry):
						if ($entry->content['type'] == 'html') {
							$atom_content = $entry->content;
						} else {
							$atom_content = htmlSpecialChars($entry->content);
						}
						$postTitle = htmlSpecialChars($entry->title);
						if ($checkPostTitle) {
							if ($postTitle == $lastPostTitle) {
								echo "source fetched";
								break;
							}
						}
						//Individual post/item array (we will store it in an array of posts array)
						$qtx_post_array = array(
						'title' => $title = $postTitle, //post title
						'description' => $description = $entry->summary, //post content
						'content' => $content = $atom_content, //post content we could use some scraping or data generation
						'link' => $link = htmlSpecialChars($entry->link['href']), //original link
						'author_name' => $author_name = htmlSpecialChars($feedObject->title), //website title(original source)
						'original_date'=> $source_published = htmlSpecialChars($entry->updated),
					); //an individual wordpress post array
					//array_push($qtx_feed_array, $qtx_post_array); //array of fetched feed posts
					//var_dump($qtx_post_array);
					array_push($qtx_feed_array, $qtx_post_array); //array of fetched feed wordpress posts
			endforeach;
			//print_r($qtx_feed_array);
    } elseif ($isrss) {
			foreach ($feedObject->item as $item):
						$postTitle = htmlSpecialChars($item->title);
						if ($checkPostTitle) {
							if ($postTitle == $lastPostTitle) {
								echo "source fetched";
								break;
							}
						}
						//Individual post/item array (we will store it in an array of posts array)
						$qtx_post_array = array(
						'title' => $title = $postTitle, //post title
						'description' => $description = $item->description, //post content
						'content' => $content = $item->description, //post content we could use some scraping or data generation
						'link' => $link = htmlSpecialChars($item->link), //original link
						'author_name' => $author_name = htmlSpecialChars($feedObject->title), //website title(original source)
						'original_date'=> $source_published = htmlSpecialChars($item->pubDate),
					); //an individual wordpress post array
					//var_dump($qtx_post_array);
					//array_push($qtx_feed_array, $qtx_post_array); //array of fetched feed posts
					array_push($qtx_feed_array, $qtx_post_array); //array of fetched feed wordpress posts
			endforeach;
			//print_r($qtx_feed_array);
    } else {
      echo "fuck you";
    }
		echo "source fetched";
		return $qtx_feed_array; //return lol

	}
?>
