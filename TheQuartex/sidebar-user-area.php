<?php
/**
 * English:
 * The sidebar (header-area) containing the dynamic widgets and hard-coded elements
 * wpQuartex
 *
 *
 *
 * Español:
 * La idea es implementar una barra de navegacion simple, un widget seria la solucion adecuada.
 * Tambien aprovechar el espacio para funcionalidades que aporten utilidad.
 * Esta forma de hacerlo ayuda a la navegación, usabilidad y SEO.
 * Trato de priorizar que el sitio sea dinamico, modificable desde el administrador de WordPress utilizando widgets.
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

if ( ! is_active_sidebar( 'user-area' ) ) {
	echo(' testing panel user-area. este panel esta diseñado para buddypress widget ' );

	return;
}
?>

	<?php dynamic_sidebar( 'user-area' ); ?>
<!-- #sin formato -->
