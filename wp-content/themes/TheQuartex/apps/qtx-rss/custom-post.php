<?php
/**
 * Create two taxonomies, genres and writers for the post type "book".
 *
 * @see register_post_type() for registering custom post types.
 */
function qtxrss_registerSourceTaxonomies() {
    // Add new taxonomy, make non-hierarchical like tags
    $labels = array(
        'name'              => _x( 'Feed Sources', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Feed Source', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Sources', 'textdomain' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => false,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'feed_sources' ),
    );
    register_taxonomy( 'feed_sources', array( 'extfeed' ), $args );

    // Add new taxonomy, make non-hierarchical like tags
    $labels = array(
        'name'              => _x( 'Source Dates', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Source Date', 'taxonomy singular name', 'textdomain' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => false,
        'query_var'         => true,
    );
    register_taxonomy( 'source_date', array( 'extfeed' ), $args );
    // Add new taxonomy, make non-hierarchical like tags
    $labels = array(
        'name'              => _x( 'Source Titles', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Source Title', 'taxonomy singular name', 'textdomain' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
    );
    register_taxonomy( 'source_title', array( 'extfeed' ), $args );

    // Add new taxonomy, make non-hierarchical like tags
    $labels = array(
        'name'              => _x( 'Original Date', 'taxonomy general name', 'textdomain' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => false,
        'query_var'         => true,
    );
    register_taxonomy( 'original_date', array( 'extfeed' ), $args );

    // Add new taxonomy, make non-hierarchical like tags
    $labels = array(
        'name'              => _x( 'Source Links', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Source Link', 'taxonomy singular name', 'textdomain' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => false,
        'query_var'         => true,
    );
    register_taxonomy( 'source_link', array( 'extfeed' ), $args );

    // Add new taxonomy, make non-hierarchical like tags
    $labels = array(
        'name'              => _x( 'Source Description', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Sources Descriptions', 'taxonomy singular name', 'textdomain' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => false,
        'query_var'         => true,
    );
    register_taxonomy( 'source_description', array( 'extfeed' ), $args );
    /*
    *
    *
    *
    */

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => false,
        'query_var'         => true,
    );
    register_taxonomy( 'isatom', array( 'extfeed' ), $args );
    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => false,
        'query_var'         => true,
    );
    register_taxonomy( 'isrss', array( 'extfeed' ), $args );
    
    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => false,
        'query_var'         => true,
    );
    register_taxonomy( 'sourceFeedXML', array( 'extfeed' ), $args );

}
add_action( 'init', 'qtxrss_registerSourceTaxonomies', 0 );
// custom post type custom_post_type register custom post
// custom post type for external feeds, rss and scraping
function qtx_post_type_extfeed() {

    register_post_type( 'extfeed',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'ExternalFeeds' ),
                'singular_name' => __( 'ExtFeed' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'external-feeds'),
            'show_in_rest' => true,
						'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', /*'comments',*/'revisions', 'custom-fields', ),
		        // You can associate this CPT with a taxonomy or custom taxonomy.
		        'taxonomies' => array( 'source_link', 'source_date', 'source_title', 'source_description', 'original_date', 'feed_sources', 'category', 'post_tag',  ),
            //Taxonomies from fetched source we need to create them
        )
    );
}
// Hooking up our function to theme setup
// Only if custom post is enabled in qtx-rss-load.php
$custompost = True;
if ($custompost) {
  add_action( 'init', 'qtx_post_type_extfeed' );
}


?>
