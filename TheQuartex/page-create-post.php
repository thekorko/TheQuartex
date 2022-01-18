<?php
/*
Template Name: create-post
*/

/**
 * The template for the post creation form
 * It displays a form based on the user role
 *
 *
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TheQuartex
 *
 */

 get_header();
 $post_type = '';
 $message = '';
 $post_value = '';
 ?>
 <style>
 #create-post-page {
 	display: grid;
 	grid-gap: 2em 10px;
 	margin: 0 0em 0 1em !important;
 	padding: 0.2em 0.2em;
 	padding-left: 0.2em;
 }
 .entry-content {
 	background: #fafafa;
 	color: #000;
 	padding: 1%;
 }
 .post-date {
 	padding-left: 10px;
 }
 #single-post-container {
 	background: #E7E7E7;
 }
 </style>
 <div id="primary" class="primary">
 	<?php get_sidebar(); ?>
 	<main id="main" class="main-content">
 	<div id="create-post-page" class="base-box singlepost-box">
        <article id="create-post" <?php post_class(); ?>>
          <header class="entry-header">
            <h1 class="entry-title">
            <?php qtx_string_e('create_post_title'); ?>
            </h1>
          </header><!-- .entry-header -->
          <div class="entry-content">
            <?php
            if (is_user_logged_in()) {
              if (isset($_GET['post_type'])) {
                $post_type = post_type($_GET['post_type']);
                if (isset($_GET['message'])) {
                  $message = message($_GET['message']);
                }
              }
              $user = wp_get_current_user();
              $publish_roles = array('editor', 'administrator', 'author', 'qtx_user', 'qtx_mod', 'qtx_vip');
              $review_roles = array('qtx_noob', 'subscriber', );

              //Old post fomr from wpuf
              if (empty($post_type)) {
                if ((array_intersect($publish_roles, $user->roles))) {
                  //post form
                  echo do_shortcode( "[wpuf_form id='629']" );
                } elseif ((array_intersect($review_roles, $user->roles))) {
                  //noob post form
                  echo do_shortcode( "[wpuf_form id='880']" );
                } else {
                  //noob
                  echo do_shortcode( "[wpuf_form id='880']" );
                }

              } else {
                //Switcdh case of form type, form type is based on the post_type we are dealing with
                $editor_class = "wp-core-ui wp-editor-wrap tmce-active";
                $editor_name = "post_form";
                switch ($post_type):
                    case 'random':
                        $editor_settings = [
                            'textarea_rows' => 10,
                            'quicktags'     => false,
                            'media_buttons' => false,
                            'plugins' => 'tabfocus,image,editimage,paste,media,fullscreen,wordpress,wpeditimage,wpgallery,wplink,wpdialogs,emoticons',
                            'tinymce'       => array(
                                'toolbar1'      => 'blockquote,image,media,link,unlink,italic,bold,underline,alignleft,aligncenter,alignright,undo,redo,charmap,emoticons',
                                'toolbar2'      => '',
                                'toolbar3'      => '',
                              ),
                            'teeny'         => false,
                            'editor_class'  => $editor_class,
                            'textarea_name' => $editor_name,
                        ];
                        break;
                    case 1:
                        echo "i equals 1";
                        break;
                    case 2:
                        echo "i equals 2";
                        break;
                    default:
                    $editor_settings = [
                        'textarea_rows' => 10,
                        'quicktags'     => false,
                        'media_buttons' => true,
                        'teeny'         => true,
                        'editor_class'  => $editor_class,
                        'textarea_name' => $editor_name,
                    ];
                endswitch;
                $share_imgur = get_template_directory_uri().'/img/share/imgur.png';
                $img_share_imgur = '<a href="https://imgur.com/upload"><img src="'.$share_imgur.'"></img></a>';
                $textarea_id = 'random_post';
                $input_post_title = '<input class="textfield" id="post_title" type="text" name="post_title" placeholder="Ingresa el título del post" value="" size="40">';
                // Turn on the output buffer
                ob_start();

                // Echo the editor to the buffer
                wp_editor( $post_value, $textarea_id, $editor_settings );

                // Store the contents of the buffer in a variable
                $editor_contents = ob_get_clean();

                // Return the content you want to the calling function
                //return $editor_contents;
                $input_post_tags = '<input class="textfield" id="post_tags" type="text" name="post_tags" placeholder="" value="" size="40" autocomplete="off">';
                $input_post_submit = '<input class="textfield" id="post_publish" type="submit" name="post_publish" value="Submit" size="10">';

                echo "$img_share_imgur<br>$input_post_title<br>$editor_contents<br>$input_post_tags<br>$input_post_submit";
              }

            } else {
              echo "<p>";
              qtx_string_e('not_logged_in');
              echo "</p>";
              qtx_social_login("full");
            }
            the_content();
            wp_link_pages( array(
              'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'TheQuartex' ),
              'after'  => '</div>',
            ) );
            ?>
          </div>
        </article>
    </div>
 		</main>
 </div>
 <!-- #primary -->

 <?php
 get_footer();
