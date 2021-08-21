<?php
/**
 * The sidebar (footer-area) containing the dynamic widgets and hard-coded elements
 * wpQuartex
 *
 *
 *
 * La idea es organizar enlaces estilo sitemap, siguiendo estandares del internet y marketing modernos.
 * Tambien aprovechar el espacio para funcionalidades que aporten utilidad.
 * Esta forma de hacerlo ayuda a la navegación, usabilidad y SEO.
 * Trato de priorizar que el sitio sea dinamico, modificable desde el administrador de WordPress
 * O como minimo indispensable, agregando un archivo php como este mismo.
 *
 * 12-10-2020
 *
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TheQuartex
 */

if ( ! is_active_sidebar( 'footer-links' ) ) {
?>

<span>This is an example because you didn't add any content to this widgetized area</span><br>
<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'wpQuartex' ) ); ?>">
	<?php
	/* translators: %s: CMS name, i.e. WordPress. */
	printf( esc_html__( 'Proudly powered by %s', 'wpQuartex' ), 'WordPress' );
	?>
</a>
<span class="sep"> | </span>
	<?php
	/* translators: 1: Theme name, 2: Theme author. */
	printf( esc_html__( 'Theme: %1$s by %2$s.', 'TheQuartex' ), 'TheQuartex', '<a href="http://underscores.me/">Underscores.me</a>' );
	?>
	<!-- delete -->
	<!--<img src="/** php bloginfo('template_directory'); */ /img/qtx_foot.png" style="width: 500px;"></img>-->
	<!-- delete -->

<?php	echo('Sidebar footer-area is not active (Or defined as a function)');
	return;
}
?>

	<?php dynamic_sidebar( 'footer-links' ); ?>
<!-- #sin formato -->
