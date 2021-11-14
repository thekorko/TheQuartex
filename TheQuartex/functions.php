<?php
/**
 * TheQuartex functions and definitions
 * 31/01/21 i changed old default name for TheQuartex
 * All theme functions are now thequartex_
 * And strings parameters are TheQuartex
 *
 *
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package TheQuartex
 *
 */

if ( ! function_exists( 'thequartex_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function thequartex_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on TheQuartex, use a find and replace
		 * to change 'TheQuartex' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'TheQuartex', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size();
        add_image_size( 'post-thumb');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			//For a dropdown menu maybe?
			'menu-1' => esc_html__( 'Primary', 'TheQuartex' ),
			//The navbar
			'header-menu' => __( 'Header Menu', 'TheQuartex' ),
			// Menu for smarthphones
			'header-menu-small' => __( 'Header Small Menu', 'TheQuartex' ),
			//linkintree
			'linktree' => __( 'Linktree', 'TheQuartex' ),
			//Just in case?
			'extra-menu' => __( 'Extra Menu', 'TheQuartex' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'thequartex_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'thequartex_setup' );

/* TODO disable site kit,adsense and monsterinsights on private pages
if (!qtx_is_staff()) {
	$network_wide = True;
	do_action( 'googlesitekit_deactivation', $network_wide );
}
*/

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function thequartex_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'thequartex_content_width', 640 );
}
add_action( 'after_setup_theme', 'thequartex_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function thequartex_widgets_init() {
	/**
	* Default sidebar
	*
	*/
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'TheQuartex' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'TheQuartex' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	/**
	* Header-area sidebar
	* This is a little space where we can put a banner ad, or some user conversion mechanism.
	*/
	register_sidebar(
		array(
				'id'            => 'header-area',
				'name'          => esc_html__( 'Multipurpose Header', 'wpQuartex' ),
				'description'   => esc_html__( 'General purpose header area, uses html.' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
		)
	);
	/**
	* Header navigation menu bar area.
	* We need to create a menu widget, modern, clean, horizontal. for the header.
	*/
	register_sidebar(
		array(
				'id'            => 'header-navbar-area',
				'name'          => esc_html__( 'Header navigation menu bar', 'wpQuartex' ),
				'description'   => esc_html__( 'wordpress link widget, navbar' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
	  )
  );
	/**
	* Home area top just over the content
	* We need to show some html widget, and some cool marketing style for seo and user conversion
	*
	*/
	register_sidebar(
		array(
				'id'            => 'home-area-top',
				'name'          => esc_html__( 'home area top', 'wpQuartex' ),
				'description'   => esc_html__( 'Marketing organic landing media, navbar' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
	  )
  );
	/**
	* Footer-area sidebar
	* Here we can put some links, SEO and marketing stuff.
	*/
	register_sidebar(
		array(
				'id'            => 'footer-area',
				'name'          => esc_html__( 'Multipurpose Footer', 'wpQuartex' ),
				'description'   => esc_html__( 'General purpose footer area, uses html.' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
		)
	);
	/**
	* Footer-area sidebar
	* Here we can put some links, SEO and marketing stuff.
	*/
	register_sidebar(
		array(
				'id'            => 'footer-links',
				'name'          => esc_html__( 'Links in footer', 'wpQuartex' ),
				'description'   => esc_html__( 'General purpose footer area' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
		)
	);
	/**
	* User-area sidebar
	* This is a generic widget area, where we will implement a mini user panel.
	*/
	register_sidebar(
		array(
				'id'            => 'user-area',
				'name'          => esc_html__( 'User Panel.', 'wpQuartex' ),
				'description'   => esc_html__( 'Shows the current user profile or the login' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
		)
	);
	/**
	* Content bottom sidebar
	* In this bottom authorbox we will show important information about the user who posted.
	*/
	register_sidebar(
		array(
				'id'            => 'content-bottom',
				'name'          => esc_html__( 'Content bottom', 'wpQuartex' ),
				'description'   => esc_html__( 'Like an standard wordpress authorbox but extended easy' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
		)
	);
	/*
	* Content top sidebar
	*/
	register_sidebar(
		array(
				'id'            => 'content-top',
				'name'          => esc_html__( 'Content top', 'wpQuartex' ),
				'description'   => esc_html__( 'Like an standard wordpress authorbox but extended easy' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
		)
	);
	/**
  *Featured ads box
	*/
	register_sidebar(
		array(
				'id'            => 'featured-ads',
				'name'          => esc_html__( 'Featured ads', 'wpQuartex' ),
				'description'   => esc_html__( 'Where we can put one small ad from google for example' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
		)
	);
	/**
	*Featured post box
	*/
	register_sidebar(
		array(
				'id'            => 'featured-post',
				'name'          => esc_html__( 'Featured post box', 'wpQuartex' ),
				'description'   => esc_html__( 'Where we can put a featured content list or post(thumb+title)' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'thequartex_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function thequartex_scripts() {
	wp_enqueue_style( 'TheQuartex-style', get_stylesheet_uri() );

	wp_enqueue_script( 'TheQuartex-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'TheQuartex-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'thequartex_scripts' );

function qtx_post_thumb() {
		//outputs
		$types = array('iframe', 'video');
		$filters = apply_filters( 'the_content', get_the_content() );
		$media = get_media_embedded_in_content($filters, $types);
		if ($media && !has_post_thumbnail()) {
			echo $media[0];
		} elseif ( has_post_thumbnail() ) {
			the_post_thumbnail();
		} else { ?>
			<img src="<?php bloginfo('template_directory'); ?>/img/synth.png" alt="<?php the_title(); ?>" /> <!-- This shows a default image -->
			<?php
		}
}
//If polylang exists we register all the strings for the theme
if (function_exists('pll_register_string')) {
	pll_register_string( 'TheQuartex', 'Connect using one of the following social networks:', 'Registro o Login' );
	pll_register_string( 'TheQuartex', 'Its easier and faster', 'Registro o Login' );
	pll_register_string( 'TheQuartex', 'Login', 'Registro o Login' );
	pll_register_string( 'TheQuartex', 'You can use the following form too:', 'Registro o Login' );
	pll_register_string( 'TheQuartex', 'continue_reading', 'blog' );
	pll_register_string( 'TheQuartex', 'blog_entry', 'blog' );
	pll_register_string( 'TheQuartex', 'no_posts_found', 'blog' );
	pll_register_string( 'TheQuartex', 'oops_404', '404' );
	pll_register_string( 'TheQuartex', 'about_user', 'authorbox' );
	pll_register_string( 'TheQuartex', 'quartex_is_amazing', 'authorbox' );
	pll_register_string( 'TheQuartex', 'view_profile', 'authorbox' );
	pll_register_string( 'TheQuartex', 'check_my_site', 'authorbox' );
	pll_register_string( 'TheQuartex', 'not_logged_in', 'generic' );
	pll_register_string( 'TheQuartex', 'create_post_title', 'generic' );
	pll_register_string( 'TheQuartex', 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', '404' );
	pll_register_string( 'TheQuartex', 'Most Used Categories', 'categories' );
	pll_register_string( 'TheQuartex', 'Try looking in the monthly archives. %1$s', 'archives' );
	/*Quartex ads for frontend*/
	pll_register_string( 'TheQuartex', 'featured_content', 'quartexads' );
	pll_register_string( 'TheQuartex', 'buy_this_ad', 'quartexads' );
	pll_register_string( 'TheQuartex', 'get_orange_juice', 'quartexads' );
	pll_register_string( 'TheQuartex', 'quartex_is_libre', 'quartexads' );
} else {
//polylang does not exist
//we could create an array, and even automate the process of translation of the theme using polylang
}
function qtx_category_icon() {
	global $post;
	$icons = array('programming' => 'fa-laptop-code', 'question' => 'fa-question', 'technology' => 'fa-microchip', 'quartexnet_en' => 'fa-robot', 'random_en' => 'fa-random', 'descargas' => 'fa-laptop-code', 'any_category' => 'fa-laptop-code', 'videogames' => 'fa-gamepad', 'internet' => 'fa-network-wired' );
	$iconos = array('pregunta' => 'fa-question', 'programacion' => 'fa-laptop-code', 'random_es' => 'fa-random', 'videojuegos' => 'fa-gamepad', 'multijugador' => 'fa-gamepad', 'tecnologia' => 'fa-microchip', 'quartexnet_es' => 'fa-robot');
	$categoryObjects = get_the_category(get_the_ID());
	//echo ($post->$ID);
	//print_r($categoryObjects);
	$categoryItems = array();
	$categoryIcon = "";
	//$cached = False;
	/*if ($cached = True) {
		//retrieve cache
		return $cached;
	}
	*/
	if (!empty($categoryObjects)) {
		for ($i=0; $i <= count($categoryObjects); $i++) {
			$name = strtolower($categoryObjects[$i]->name);
			//$nicename = $categoryObjects[$i]->nice_name;
			//echo $name."tessss";
			//$slug = $categoryObjects[$i]->slug;
			//echo "slug motherfucker $name slug slug slug";
			//$categoryItems[$slug] = $slug;
			//print_r($categoryItems);
			//array_push($categoryItems, $name => $name, $nicename => $nicename, $slug => $slug);
			//print_r($categoryItems);
			//print_r($icons);
			//echo "im here $i ";
			if (isset($icons[$name]) or array_key_exists($name, $icons) or array_key_exists($name, $iconos)) {
				//echo "i found result";
				//echo $name;
				//var_dump($icons[$name]);
				//$categoryIcon = $icons[$name];
				//$categoryIcon = $icons[$name];
				//icons was empty because it was found on the spanish one, but i asigned the english one(array item).
				//icons was empty because it was found on the spanish one, but i asigned the english one(array item).
				if (!empty($iconos[$name])) {
					$categoryIcon = $iconos[$name];
				} else {
					$categoryIcon = $icons[$name];
				}
				//print_r($icons);
				//TODO cache_it
				break;
			} else {
				//echo "im empty";
				$categoryIcon = $icons['any_category'];
				break;
			}
		}
	}	else {
		//echo "qewqewqew";
		$categoryIcon = $icons['any_category'];
	}
	return "<i class='fas $categoryIcon'></i>";
}

/*
*
*/

function qtx_echo_post_list() { ?>
		<li class="item-post-list">
			<a href="<?php the_permalink() ?>" title="<?php printf(__('Descargar %s', 'kubrick'), the_title_attribute('echo=0')); ?>">
		<?php echo(qtx_category_icon()); ?>
		<?php
			/** This should be rewritten as a function, because we will need more tweaking for the titles, and should be generalistic, so we can apply it to post_excerpt */
			global $post;
			if (strlen($post->post_title) > 32) {
				echo substr(the_title($before = '', $after = '', FALSE), 0, 32) . '...'; } else {
				the_title();
			}
		?>
			</a>
		</li>


<?php
}

/*Receives data about attachments and print a post box*/
function qtx_echo_thumb_box($id, $type, $class, $thumbimg, $mimetype) { ?>
	<!--div clickeable-->
	<a href="<?php /*TODO make attachment post type single page*/ the_permalink($id) ?>" title="<?php printf(__('Memes y random stuff only Quartex %s', 'kubrick'), the_title_attribute('echo=0')); ?>">
	<div id="post-<?php echo($id) ?>" class="base-box post-box post-<?php echo($type); ?>"> <!-- This is the main box for each post within the post loop -->
			<!--End of the upper toolbar -->
			<!--link to the post-->
			<div id="post-title"> <!--This is the title row-->
				<div class="post-title">
				<span><h4 class="post-title-h4">
				<center>
					<?php echo(qtx_category_icon()); ?>
					<?php
						/** This should be rewritten as a function, because we will need more tweaking for the titles, and should be generalistic, so we can apply it to post_excerpt */
						//global $post;
						//if (strlen($post->post_title) > 52) {
						/*TODO fix, function the_title doesn't support passing an $ID*/
						echo(get_the_title($id));
						//echo substr(the_title($before = '', $after = '', FALSE), 0, 52) . '...'; } else {
						//the_title();
						//}
					?>
				</center>
			</div>
		</div>
		<div id="post-thumb" class="row"> <!--Thumbnail image, could it be a background? -->
			<div class="post-thumb">
				<?php
				/*Checks how to embed the content in the box*/
				if ($type == 'thumbpost') {
					echo $thumbimg;
				} elseif($type == 'vidpost') {
					echo('<video controls width="300" height="300">
					    		<source src="'.$thumbimg.'"type="'.$mimetype.'">
					    		Sorry, your browser doesnt support embedded videos.
								</video>');
				}
					/*TODO Check if doing somthing here*/
					/*TODO adds option for upvote, approve etc*/
				?>
			</div>
		</div>
		<center>
		<p><?php echo substr(wp_get_attachment_caption( $id ), 0, 120) . '...'; ?></p>
		</center>
		<!--DMCA-->
		<!--div clickeable-->
	</div>
	<!--div clickeable-->
	</a> <!--link to the post-->
<?php
}

function qtx_echo_post_box($j, $type) { ?>
	<!--div clickeable-->
	<a href="<?php the_permalink() ?>" title="<?php printf(__('Descargar %s', 'kubrick'), the_title_attribute('echo=0')); ?>">
	<div id="post-<?php echo($j) ?>" class="base-box post-box post-<?php echo($type); ?>"> <!-- This is the main box for each post within the post loop -->
			<!--End of the upper toolbar -->
			<!--link to the post-->
			<div id="post-title"> <!--This is the title row-->
				<div class="post-title">
				<span><h4 class="post-title-h4">
				<center>
					<?php echo(qtx_category_icon()); ?>
					<?php
						/** This should be rewritten as a function, because we will need more tweaking for the titles, and should be generalistic, so we can apply it to post_excerpt */
						global $post;
						if (strlen($post->post_title) > 52) {

						echo substr(the_title($before = '', $after = '', FALSE), 0, 52) . '...'; } else {

						the_title();

						}

					?>
				</center>
			</div>
		</div>

		<div id="post-thumb" class="row"> <!--Thumbnail image, could it be a background? -->
			<div class="post-thumb">
				<?php qtx_post_thumb(); ?>
			</div>
		</div>
		<center>
		<p><?php echo substr(get_the_excerpt(), 0, 120) . '...'; ?></p>
		</center>
		<!--DMCA-->
		<!--div clickeable-->
	</div>
	<!--div clickeable-->
	</a> <!--link to the post-->
<?php
}

function qtx_echo_post_blog() { ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<!-- entry-header -->
		<header class="entry-header">
			<!--titlte div background stripes-->
			<div class="post-title">
				<h3><a href="<?php the_permalink() ?>" title="<?php printf(qtx_string_e("blog_entry"), the_title_attribute('echo=0')); ?>"><?php the_title('<h3 class="entry-title">', '</h3>'); ?></a></h3>
			</div>
			<div class="entry-meta">
			<?php
			thequartex_posted_on();
			thequartex_posted_by();
			?>
			</div>
		</header>
			<div class="entry-content">
			<br>
			<a href="<?php esc_url(the_permalink()); ?>">
			<?php qtx_post_thumb(); ?>
			</a>
			<p><?php the_excerpt(); ?></p>
			<h3 class="entry-meta"><a href="<?php esc_url(the_permalink()); ?>" title="<?php printf(qtx_string_e("blog_entry"), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php qtx_string_e("continue_reading..."); the_title();?></a></h3>
			</div>
	</article>

<?php
}

function qtx_navigation($customquery = array()) {
	if ( is_plugin_active( 'wp-pagenavi/wp-pagenavi.php' ) ) {
		//check if wp-pagenavi is active
		if ($customquery) {
			wp_pagenavi($customquery);
		} else {
			if (is_front_page()) {
				wp_pagenavi();
			} else {
				if(!empty($the_query)) {
					//are we on a custom query?
					global $the_query;
				} else {
					//we are on author, archive, etc.
					global $wp_query;
					$the_query = $wp_query;
				}
				wp_pagenavi(array( 'query' => $the_query ));
			}
		}
	} else {
		//fix does not work
		echo "Wp pagenavi is disabled and the posts_navigation does not work<br>";
		previous_posts_link();
		next_posts_link();
		// FIX for some reason it does not work
		//the_posts_navigation(array( 'query' => $the_query ));
	}
}

//pass me a string and i will echo it based on polylang or wordpress native internalization
function qtx_string_e($string_echo = "string cappuccino is empty") {
	$string_echo = sanitize_text_field($string_echo);
	if ($string_echo == "") {
		$string_echo = "string was empty";
	}
	if (function_exists('pll_e')) {
		//Aparently it echoes no matter if it's registered or not -\_o-
		pll_e($string_echo);
	} else {
		_e($string_echo, 'TheQuartex');
	}
}

//This function is meant for displaying the profile image
//It supports gravatar, wsl, and native profile images
/*TODO
function qtx_profile_img() {
	if (1 == 2) {
		//get_avatar($userID);
	}
}
*/

//get all the possible information about a certain user, by passing the ID or from within the loop
//if we are not in the loop it defaults to the user ID 1.
//This is meant for displaying updated user information
function qtx_user_info($userID = 0) {
	//is_singular( 'post' ) &&
	/* Empty evaluates to:
    0
    0.0
    "0"
    ""
    NULL
    FALSE
    array()
		https://www.w3schools.com/php/func_var_empty.asp
	*/
	if (empty($userID)) {
		if (in_the_loop()) {
			//echo "loop";
			$userID = get_the_author_meta('ID');
			//echo $userID;
		} else {
			//global $post;
			//$authorID = $post->post_author;
			//I don't know if this is reliable so i will just display the Quartex user ID 5
			$userID = 5;
			//echo "You are outside of the loop";
		}
	}
	//if null get info from the user id 1
	$user_info = array(
		'gravatar' => $gravatar = get_avatar($userID, 250), //TODO call qtx_profile_img
		'profilelink' => $url = get_author_posts_url($userID),
		'name' => $name = get_the_author_meta('display_name', $userID),
		'bio' => $bio = get_the_author_meta('description', $userID),
		'website' => $website = get_the_author_meta('user_url', $userID),

		//Customs not registered
		//a color for the rank
		//'color' => $color = get_the_author_meta('color', $userID),
		//a standard emoji set
		//'emoji' => $emoji = get_the_author_meta('emoji', $userID),
		//a profile img link
		//'profileimg' => $profileimg = get_the_author_meta('profileimg', $userID),
		//a custom emoji for quartex comments
		//'customemoji' => $customemoji = get_the_author_meta('customemoji', $userID),
		//prefered color scheme
		//'themepreference' => $themepreference = get_the_author_meta('themepreference', $userID),
		//an array of social networks links
		//'socialnetworks' => $socialnetworks = get_the_author_meta('socialnetworks', $userID),
		//an array of patreon, paypal, sendmeacoffe
		//'donatelinks' => $donatelinks = get_the_author_meta('donatelinks', $userID),

		//'email' => $email = get_the_author_meta('email', $userID),
		//Information disclosure
		'nick' => $nick = get_the_author_meta('nickname', $userID),
		//'level' => $level = get_the_author_meta('user_level', $userID),
		//Information disclosure
		'registered' => $registered = get_the_author_meta('user_registered', $userID),
		//'nicename' => $nicename = get_the_author_meta( 'nicename', $userID ),
	);
	//return the array
	return $user_info;
	//when you return a variable from a php function you must asign it to a variable at the moment of
	//calling the function like $information = qtx_user_info()
	//php is loosely tiped language but you can use strict Arguments
	//https://www.tutorialspoint.com/php/php_functions.htm
}

// TODO: custom cache functionality
/*
* Authentication functions
*/
//Checks if user is a staff member
function qtx_is_staff() {
	if (is_user_logged_in()) {
		$user = wp_get_current_user();
		$staff_roles = array('qtx_mod', 'editor', 'administrator');
		if ((array_intersect($staff_roles, $user->roles))) {
			return True;
		} else {
			return False;
		}
	}
}
/*
* Allow certain roles to full downloads
*/
function qtx_downloads_acccess() {
	if (is_user_logged_in()) {
		$user = wp_get_current_user();
		$staff_roles = array('qtx_user', 'qtx_noob', 'qtx_mod', 'qtx_full', 'qtx_pro', 'qtx_vip', 'editor', 'administrator');
		if ((array_intersect($staff_roles, $user->roles))) {
			return True;
		} else {
			return False;
		}
	}
}
/*
* Allow certain roles to moderation
*/
function qtx_moderation_acccess() {
	if (is_user_logged_in()) {
		$user = wp_get_current_user();
		$staff_roles = array('qtx_user', 'qtx_mod', 'qtx_full', 'qtx_pro', 'qtx_vip', 'editor', 'administrator');
		if ((array_intersect($staff_roles, $user->roles))) {
			return True;
		} else {
			return False;
		}
	}
}
/*
* Quartex Only content
* TODO make it better
* https://developer.wordpress.org/reference/functions/do_shortcode/
*/
function qtx_user_check_shortcode($atts, $content = null) {
	if (is_user_logged_in() && !is_null($content)) {
		return do_shortcode($content);
	} else {
		$lang = pll_current_language();
		if (is_singular() or is_page()) {
			if ($lang=='en') {
				echo '<a href="https://quartex.net/en/register"><img class="size-full" loading="lazy" src="'.get_template_directory_uri().'/img/register/exclusive_en.png"></a>';
			} elseif ($lang=='es') {
				echo '<a href="https://quartex.net/es/registrarse"><img class="size-full" loading="lazy" src="'.get_template_directory_uri().'/img/register/exclusive_es.png"></a>';
			}
		} else {
		 qtx_string_e('not_logged_in');
		}
	}
	return;
}
add_shortcode('qtx', 'qtx_user_check_shortcode');
add_shortcode('register', 'qtx_user_check_shortcode');

/*
* Filter random and crap posts from index
* TODO bug in frontpage it does count as post
*/
function qtx_filter_shitpost() {
	global $post;
	//TODO optimize
	//Get the category wp_term array from current post
	$categoryObjects = get_the_category(get_the_ID());
	$disabled = array('memes','random_es','random_en','memes_es');
	//For every object we get the name
	for ($i=0; $i < count($categoryObjects); $i++) {
		$cats = array();
		array_push($cats,strtolower($categoryObjects[$i]->name));
	}
	if (!empty($cats)) {
		if (array_intersect($disabled,$cats)) {
			//The category is shitpost
			return True;
		} else {
			return False;
		}
	} else {
	//The post doesn't have category
	return False;
	}
}
/*
* Display a category widget full and for frontpage
* https://developer.wordpress.org/reference/functions/wp_list_categories/
* TODO doesn't work
*/
function qtx_cat_list($case) {
	$categories = get_categories( array(
		'orderby' => 'name',
		'order'   => 'ASC'
	) );
switch ($case) {
	case 'full':
	foreach ($categories as $category) {
		$name = $category->name;
	}
	case 'front':
	$includecats = array('Videojuegos','Videogames','Software_hub','technology','tecnologia','centro_de_software','descargas','downloads');
	echo "<style>
				.catlist-front {
					font-family: Pirata One;
					font-weight: 800;
					font-size: 1.4rem;
					font-style: italic;
					border-radius: 3px;
					border: dotted 3px;
					border-color: #EE004D;
				}
				</style>";
				//TODO doesn't work
	foreach ($categories as $category) {
		$catname = $category->name;
		$catsnames = array();
		array_push($catsnames, $catname);
	}
	if (array_intersect($catsnames, $includecats)) {
		echo "test";
		echo "<div class='catlist-front'>$catname</div>";
	}
	break;
}
}

//Checks if user is a API member
function qtx_is_API() {
	if (is_user_logged_in()) {
		$user = wp_get_current_user();
		$staff_roles = array('API');
		if ((array_intersect($staff_roles, $user->roles))) {
			return True;
		} else {
			return False;
		}
	}
}

//Prints some tools for logged in users and some tools for logged out users
function qtx_user_tools() {
	//TODO expand functionality
	?>
	<div id="post-title" class="row"> <!--This is the title row-->
		<div class="post-title col-xs-12">
		<span><h4 class="post-title-h4">
			Here display a list of links queried dynamically or hardcoded
		</h4></span>
	</div>
</div>
<?php
}

//Prints full social form and text if user is not loged in
function qtx_full_social() {
	if (!is_user_logged_in()) {
		echo "<p>";
		qtx_string_e('not_logged_in');
		echo "</p>";
		qtx_social_login("full");
	} else {
	//Do nothing
	}
}

//Checks if the current post has content or not
function qtx_post_has_content() {
	$qtx_post_content = get_the_content();
	//returns true if post has content, false if not.
  return !empty($qtx_post_content);
}

function qtx_content_generator() {
	if (qtx_is_staff()) { ?>
		<span><h4 class="post-title-h4">
			Generator test
		</h4></span>
<?php
	}
}

//fontawesome and wp-social-login
//function to render fontawesome into wp-social
function qtx_wsl_fontawesome_full( $provider_id, $provider_name, $authenticate_url )
{
	 ?>
	 <a
			rel           = "nofollow"
			href          = "<?php echo $authenticate_url; ?>"
			data-provider = "<?php echo $provider_id ?>"
			class         = "wp-social-login-provider wp-social-login-provider-<?php echo strtolower( $provider_id ); ?>"
		>
		<span class="social-media-awesome" >
		  <span>
				<i class="fab fa-<?php if( $provider_id == "TwitchTV" ){echo "twitch";}else{echo strtolower( $provider_id );} ?>"></i>
			</span>
			<span style="color:black;font-size: 1.3rem;">
				<?php _e( '', 'TheQuartex' ); ?><?php echo $provider_name; ?>
			</span>
		</span><br>
	 </a>
<?php
}

//this functions render a login/registration social template based on it's args
//it's for templating with fontawesome
//extends wordpress_social_login behaviour
//adds a filter to wsl_render_auth_widget_alter_provider_icon_markup
//calls qtx_wsl_fontawesome_full & qtx_wsl_fontawesome_icons
function qtx_social_login($version = "default") {
	 	//check for plugin existence
		//the plugin alreadt checks for is_user_logged_in
		if (function_exists('wsl_render_auth_widget')) {
			$version = sanitize_text_field($version); //sanitize in case we messed up
			if ($version == "") {
				$version = "default"; //set default for whatever reason
			}
			//reminder use has_filter()
			switch ($version) {
				case "default":
						do_action( 'wordpress_social_login', 'TheQuartex' );
						break;
				case "icons":
						do_action( 'wordpress_social_login', 'TheQuartex' );
						break;
				case "full":
						add_filter( 'wsl_render_auth_widget_alter_provider_icon_markup', 'qtx_wsl_fontawesome_full', 10, 3 );
						do_action( 'wordpress_social_login', 'TheQuartex' );
						remove_filter( 'wsl_render_auth_widget_alter_provider_icon_markup', 'qtx_wsl_fontawesome_full', 10, 3 );
						break;
				}
		} else {
			echo "Wordpress Social Login does not exist or the author of the plugin changed the function identificator";
			wp_login_form();
		}
}

/*
* Remove jetpack menu from dashboard
*/
function pinkstone_remove_jetpack() {
	if( class_exists( 'Jetpack' ) && !current_user_can( 'manage_options' ) ) {
		remove_menu_page( 'jetpack' );
	}
}
add_action( 'admin_init', 'pinkstone_remove_jetpack' );

/*
*Remove WPUF meta boxes from post editor
*/
function plt_hide_wp_user_frontend_metaboxes() {
if( class_exists( 'WP_User_Frontend' ) && !current_user_can( 'manage_options' ) ) {
		$screen = get_current_screen();
		if ( !$screen ) {
			return;
		}
		//Hide the "WPUF Form" meta box.
		remove_meta_box('wpuf-select-form', $screen->id, 'side');
		//Hide the "WPUF Lock User" meta box.
		remove_meta_box('wpuf-post-lock', $screen->id, 'side');
		//Hide the "WPUF Custom Fields" meta box.
		remove_meta_box('wpuf-custom-fields', $screen->id, 'normal');
		//Hide the "Pack Description" meta box.
		remove_meta_box('wpuf-metabox-subscription', $screen->id, 'normal');
		//Hide the "Subscription Options" meta box.
		remove_meta_box('wpuf_subs_metabox', $screen->id, 'advanced');
	}
}
add_action('add_meta_boxes', 'plt_hide_wp_user_frontend_metaboxes', 20);
/*
* Exit the dashboard if the current user is low rank
* redirect dashboard admin interface
*/
function dashboard_redirect() {
$user = wp_get_current_user();
$frontend_roles = array( 'qtx_noob', 'subscriber', 'qtx_user' );
    if( array_intersect($frontend_roles, $user->roles) && is_admin() && !defined('DOING_AJAX') )
    {
        wp_redirect(home_url( '/' ));
    }
}
add_action('init', 'dashboard_redirect');


/**
* We include bootstrap-grid
*/
/* TODO
if (is_page(array( 'about-us', 'contact', 'management' )) ) {
	function flexbox_grid() {
		wp_enqueue_style( 'flexbox_grid',
	  					get_stylesheet_directory_uri() . '/css/bootstrap-grid.min.css',
	  					array(),
	  					'0.0'
	  					);
	}
	add_action( 'wp_enqueue_scripts', 'flexbox_grid');
}
*/


/*
* Redirect author.php to buddypress
*/

//TODO add post list and styles using bootstrap?
function buddydev_author_redirect_to_profile() {

    if ( is_author() && function_exists( 'bp_core_redirect' ) ) {

        $author_id = get_queried_object_id();
        bp_core_redirect( bp_core_get_user_domain( $author_id ) );
    }
}
add_action( 'template_redirect', 'buddydev_author_redirect_to_profile' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
* Plugin loader else load compatibility
*/
define('QTXLoader', True);
$qtx_plugin_loader = get_template_directory() . '/apps/qtx-plugin-loader.php';
if (is_file($qtx_plugin_loader)) {
	require $qtx_plugin_loader;
} else {
	if (!function_exists('qtxEchoDownloads')) {
		function qtxEchoDownloads() {
			return;
		}
	}
}
/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
