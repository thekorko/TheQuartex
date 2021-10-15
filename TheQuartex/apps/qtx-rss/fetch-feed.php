<?php
/*
*
* Setup Cron Jobs
*
*/
if(!defined('LoadFetching')) {
    die('Fetch');
}
	function qtxRSSFetchAllFeeds_deactivate() {
    	wp_clear_scheduled_hook( 'qtxDownloadsCache_cron' );
		}

	add_action('init', function() {
    	add_action( 'qtxRSSFetchAllFeeds_cron', 'qtxRSSFetchAllFeeds_run_cron' );
    	register_deactivation_hook( __FILE__, 'qtxRSSFetchAllFeeds_deactivate' );

    	if (! wp_next_scheduled ( 'qtxRSSFetchAllFeeds_cron' )) {
        	wp_schedule_event( time(), 'Weekly', 'qtxRSSFetchAllFeeds_cron' );
    	}
		});
	function qtxRSSupdateOldPosts($updateoldposts = False) {
		if (qtx_is_staff() && $updateoldposts) {
			/*Query and fix all posts*/
			$query_all_extfeeds = array(
			'post_type' => 'extfeed',
			'posts_per_page' => '-1',
			'hide_empty' => 1,
			'date_query' => array(
					'before'    => array(
							'year'  => 2021,
							'month' => 8,
							'day'   => 30,
						),
						'inclusive' => true,
				),
			);
			$query_all = new WP_Query( $query_all_extfeeds );
			echo "doing query";
			if ($query_all->have_posts()) {
				echo "have posts";
					$IsAtom = False;
					$IsRSS = True;
					$url_force = "https://www.eurogamer.net/?format=rss&type=news";
					$feedObject = qtx_force_feedUrl($url_force, $IsAtom, $IsRSS);
					$fetched_source = qtx_fetch_source($feedObject, $url_force, $IsAtom, $IsRSS);
				while ( $query_all->have_posts() ) : $query_all->the_post();
					//var_dump($rss);
					//Ah no soy tan pesimo como yo pensaba esto bien programado
					$post_id = get_the_ID();
					echo "Updating $post_id with data:";
					$srcTitle = $fetched_source['source_title'];
					$srcDesc = $fetched_source['source_description'];
					$srcIsAtom = $fetched_source['isatom'];
					$srcIsRSS = $fetched_source['isrss'];
					/*
					this is for the array $taxArray
					*/
					$srcFeedXML = $fetched_source['sourcefeedxml'];
					$srcLink = $fetched_source['source_link'];
					$feedSRC = $fetched_source['source_title'];
					$srcDate = $fetched_source['source_date'];
          $taxArray = array('feed_sources' => $feedSRC, 'source_title' => $srcTitle, 'source_description' => $srcDesc, 'source_date' => $srcDate, 'source_link' => $srcLink, 'sourcefeedxml' => $srcFeedXML, 'isatom' => $srcIsAtom, 'isrss' => $srcIsRSS );
					var_dump($taxArray);
					$one_post = array(
						'ID'        => $post_id,
						'tax_input' => $taxArray,
					);
					wp_update_post($one_post);
				endwhile;
			}
			wp_reset_postdata();

		}
	}
	function qtxRSSFetchAllFeeds_run_cron() {
		echo "<br>inside function";
		if (qtx_is_staff()) {
			//obtener el ultimo post y sus taxonomies
			$allFeeds = get_terms(array('taxonomy' => 'sourcefeedxml', 'hide_empty' => false,));
			//var_dump($allFeeds);
			if (!empty($allFeeds)) {
				echo "<br>allFeeds was not empty";
					$language = 'en';
					$category = array(8);
					foreach ($allFeeds as $term) {
						echo "<br>executed foreach $term->name";
						$feedUrl = $term->slug;
						echo "<br>$feedUrl";

						/*Query full for array of posts titles*/
						$arrayOfTitles = array();
						$post_query_args_rss_full = array(
						'post_type' => 'extfeed',
						'posts_per_page' => 15,
						'hide_empty' => 1,
						'tax_query' => array(
								array(
										'taxonomy' => 'sourcefeedxml',
										'field'    => 'slug',
										'terms'    => $term->slug,
									),
								),
						);
						$query_full = new WP_Query( $post_query_args_rss_full );
						if ($query_full->have_posts()) {
							while ( $query_full->have_posts() ) : $query_full->the_post();
								$PostTitle = get_the_title();
								array_push($arrayOfTitles, $PostTitle);
							endwhile;
						}
						wp_reset_postdata();
						/*Query full for array of posts titles*/
						$full = True;

						$post_query_args_rss = array(
						'post_type' => 'extfeed',
						'posts_per_page' => 1,
						'hide_empty' => 1,
						'tax_query' => array(
								array(
										'taxonomy' => 'sourcefeedxml',
										'field'    => 'slug',
										'terms'    => $term->slug,
									),
								),
						);
						//echo "<br>tax query done";
						$new_query_rss = new WP_Query( $post_query_args_rss );
						//var_dump($new_query);
						if ( $new_query_rss->have_posts() ) {
							while ( $new_query_rss->have_posts() ) : $new_query_rss->the_post();
								$post_id = get_the_ID();
								echo $post_id;
								$isatom = qtxrss_recursiveTermsName($post_id, 'isatom', 'slug');
								$isrss = qtxrss_recursiveTermsName($post_id, 'isrss', 'slug');
								echo "we are in the query";
								if (empty($isrss)) {
									$isrss = 0;
									echo "<br>isrss was empty";
								}
								if (empty($isatom)) {
									$isatom = 0;
									echo "<br>isatom was empty";
								}
								if ($isatom == 1 or $isrss == 1) {
									echo "the feed isatom or isrss";
									echo "the query had posts";
									$arrayOfFeeds = array($term->name);
									/*foreach ($allFeeds as $key => $value) {
										array_push($arrayOfFeeds, $allFeeds[0]->name);
									}*/
									//var_dump($new_query_rss);
									$lastPostTitle = get_the_title();
									echo "<br>$lastPostTitle<br>";
									//Crear un array con un unico feed o con todos los feeds existentes
									qtx_feed_handle($arrayOfFeeds, $isatom, $isrss, $language, $category, $lastPostTitle, $arrayOfTitles, $full);
									wp_reset_postdata();
								} else {
									echo "The has not been set a proper Format like atom or rss";
								}
								endwhile;
						}
					}
					//qtxrss_execMastermode();
			}
		}
	}

	//fetches source information and returns an array
	function qtx_fetch_source($feedObject, $url_force, $isatom, $isrss) {
		//Array declaration is fine this way if you need a valid empty array just $var = array()
		//Ah no soy TAN PESIMO como yo pensaba esto bien programado
		//Si esto lo tengo que fetchear una vez nomas
		//$feed_type =
		$fetched_source = array(
			'isatom' => $isatom,
			'isrss' => $isrss,
			'sourcefeedxml' => $url_force,
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
	function qtx_fetch_feed($feedObject, $isatom, $isrss, $lastPostTitle = "", $arrayOfTitles = array(), $full = False) {
		//we create an empty array otherwise array_push() will output: expected array on parameter 1
		$qtx_feed_array = array();
		//For each item in the rss feed object we check item data and store in an array
		$checkPostTitle = False;
		if (!empty($lastPostTitle)) {
			$checkPostTitle = True;
			echo "<br>check post title is true";
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
							if ($full && !empty($arrayOfTitles)) {
								echo "<br>checking haystack of titles";
								if (in_array($postTitle, $arrayOfTitles)) {
									echo "Found in haystack<br>$lastPostTitle";
									return;
								};
							}
							if ($postTitle == $lastPostTitle) {
								echo "source fetched until last post title: atom <br>$lastPostTitle";
								return;
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
							if ($full && !empty($arrayOfTitles)) {
								echo "<br>checking haystack of titles";
								if (in_array($postTitle, $arrayOfTitles)) {
									echo "<br>Found in haystack<br>$lastPostTitle";
									return;
								};
							}
							if ($postTitle == $lastPostTitle) {
								echo "<br>source fetched until last post title: rss<br>title was:$lastPostTitle<br>";
								return;
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
