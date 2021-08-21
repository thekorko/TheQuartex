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
