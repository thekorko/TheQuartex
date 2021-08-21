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

if ( ! is_active_sidebar( 'footer-area' ) ) {
	echo('Sidebar is not active (Or defined as a function)');
	return;
}
?>


	<?php dynamic_sidebar( 'footer-area' ); ?>
<!-- #sin formato -->
