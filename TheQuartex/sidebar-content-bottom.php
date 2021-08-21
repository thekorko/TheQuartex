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

<style>
.author-box {
	grid-area: authorimage;
	background: #11122B;
}
.about-author { grid-area: authorcontent; }


/*.content-area {
  display: flex !important;
}*/
.about-author-image {
/*	display: grid !important;*/
}
.author-box {
  width: 100%;
  display: grid !important;
  grid-template-areas:
    'authorimage authorcontent authorcontent authorcontent authorcontent authorcontent';
  grid-gap: 0px;
  padding: 10px;
}

.author-box > div {
  padding: 10px 0;
}
/* Rectangle 43 */
.button-author {
	width: 79px;
	height: 44px;
	background: linear-gradient(0deg, #BD0071, #BD0071), #BD0071;
	border: 2px solid #11122B;
	box-sizing: border-box;
	border-radius: 7px;
	float: right;
	right: -5px;
	top: -5px;
}
</style>


	<div class="entry-meta">
	<?php thequartex_entry_footer(); ?>
	</div>
<div class="footer-container">	
	<div class="content-bottom">
	<?php
	if ( is_active_sidebar( 'content-bottom' ) ) {
		dynamic_sidebar( 'content-bottom' );
	} else {

	}
	?>
	</div>
<?php $user_info = qtx_user_info(); ?>
<div class="author-box base-box">
<div class="about-author-image">
<a href="<?php
if (! empty($user_info['website'])) {
	echo $user_info['website'];
} else {
	echo $user_info['profilelink'];
}
?>" rel="ugc"><?php echo $user_info['gravatar']; ?></a>
</div>

<div class="post-title about-author">
	<!--<div class="button-author">
		<p>Puntos</p>
	</div>
	<div class="button-author">
		<p>Gift</p>
	</div>
	<div class="button-author">
		<p>Report</p>
	</div>-->
<h3><?php qtx_string_e("about_user"); echo " " . $user_info['name']; ?></h3>
<p>
<a href="<?php echo $user_info['website']; ?>" rel="ugc"><?php qtx_string_e("check_my_site"); ?></a>
</p>
<p>
<?php
if (! empty($user_info['bio'])) {
echo $user_info['bio'];
} else {
	qtx_string_e("quartex_is_amazing");
}
?>
</p>
<a href="<?php echo $user_info['profilelink']; ?>"> <?php qtx_string_e("view_profile"); echo " " . $user_info['name']; ?></a>
</div>
</div>
</div>



<!-- #sin formato -->
