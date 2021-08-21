<?php
/**
 * English:
 * The sidebar or widget area for the bottom of single.php
 * It's like an authorbox
 * wpQuartex
 *
 *
 *
 * Español:
 * La idea es implementar un authorbox con links del usuario
 *
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TheQuartex
 */

?>
<!--sidebar content top, where we can add dynamic content about the post and author -->
<div id="sidebar-content-top" class="content-top-box" style="float:right;">
		<!-- post data for whatever information we would like to add about the post for example the_excerpt-->
		<div id="post-data" style="display:none;float:right;">
				<!--we put here some front media like a thumb-->
				<div id="single-post-thumb" class="" style="">
					<!--we could use the function we used in home.php to get some media on the front-->
					<?php //qtx_post_thumb(); ?>
				</div>
				<!-- entry-meta and permalinks -->
				<div class="entry-meta post-title" style="">
					<div id="excerpt">
					<br>
					<?php	//the_excerpt(); ?>
					</div>
						<div class="post-toolbar">
							<button class="single-button"><a href="<?php //echo get_site_url(); ?>/dmca"><img src="<?php //echo get_template_directory_uri(); ?>/img/dmca.png"></a></button> <!--The tool meant to be chaotic lawful -->
						</div>
					</div>
				<!--finally we put the widget-->
				<div id="content-top-dynamic" class="col-xs-12">
					<?php	//if ( is_active_sidebar( 'content-top' ) ) {
						//dynamic_sidebar( 'content-top' );
					//} ?>
				</div>
		</div>
	<!--here we present some little bits of info about the author for example an image and social net-->

	<div id="post-author-data" class="empty-box base-box post-title" style="float:right;">
		<button class="single-button" onclick='togglemenu("post-data")' style="">
		<h4>+</h4>
		</button>
		<button class="single-button" onclick='toggledark()' style="">
		<h4>dark</h4>
		</button>
		<?php	//echo(get_avatar(get_the_author_meta('ID'), 250)); ?>
		<br>
		<p>Some user text</p>
		<p>Some user text</p>
		<p>Some user text</p>
		<p>Some user text</p>
	</div>
</div>
<!-- #sin formato -->
