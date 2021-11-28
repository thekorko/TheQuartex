<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TheQuartex
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">

		<div id="site-info" class="site-info foot-box">
			<?php	get_sidebar( 'footer-area' ); ?>
		</div><!-- .site-info -->

		<div class="site-info foot-box">

		<?php	get_sidebar( 'footer-links' ); ?>
		<ul style="margin-left: auto;">
			<li>
				<b style="padding:0.5em;">Awesomely made possible by:</b>
				<ul id="menu-footer_multipurpose" class="menu" style="padding:0.5em;grid-gap:0.5em;">
					<li id="menu-item-999" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-999"><a href="https://github.com/thekorko"><i class="fas fa-radiation" style="color:black;"></i>TheKorko</a></li>
					<li id="menu-item-1000" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1000"><a href="https://www.lorddesert.xyz/"><i class="fas fa-user" style="color:black;"></i>Lorddesert</a></li>
					<li id="menu-item-1002" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1002"><a href="https://mrks.cf/"><i class="fas fa-user" style="color:black;"></i>Markski</a></li>
				</ul>
			<ul class="menu" style="padding:0.5em;grid-gap:0.5em;">
				<li class="menu-item"><i class="fab fa-wordpress"></i></li><li><i class="fab fa-php"></i></li><li><i class="fab fa-html5"></i><li><i class="fab fa-font-awesome"></i></li></li><li><i class="fab fa-digital-ocean"></i></li>
			</ul>
			<a style="padding: 0.5em;margin: 0.5em;" href="https://mynickname.com/id1720041"><img src="https://mynickname.com/img.php?nick=thekorko&sert=24&text=t5" alt="Nickname thekorko registred!" /></a>
			</li>
		</ul>

		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

<script type="text/javascript">
	/**
	* toggles sidebar div (mainmenu).
 	*/
	 function togglemenu(arg1) {
		 if (arg1 === undefined) {
	   var arg1 = "sidebar";
	   }
  		var x = document.getElementById(arg1);
  		if (x.style.display === "block") {
   			x.style.display = "none";
 		} else {
   			x.style.display = "block";
  	}
	}

	function toggledark(arg1) {
		if (arg1 === undefined) {
		var arg1 = "entry-content";
		//var arg2 = "single-post-container";
		}
  	var element = document.getElementById(arg1);
  	element.classList.toggle("dark-mode");
		//var element = document.getElementById(arg2);
		//element.classList.toggle("dark-mode");
	}

</script>

</html>
