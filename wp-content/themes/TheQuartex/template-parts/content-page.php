<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TheQuartex
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php //thequartex_post_thumbnail(); ?>

	<div class="entry-content" style="display: grid;justify-content: center;place-items:center;">
		<?php
		/*Maybe do this from a Template*/
		if ( ! is_user_logged_in() && is_page( array( 'register', 'register-account', 'registro', 'registrar', 'registrarse', 'join-us', 'unete', 'conectarse', 'login', 'iniciar-sesion' ) ) ) : ?>

			<br><h4><?php qtx_string_e( 'Connect using one of the following social networks:'); ?></h4><br>
			<div id="social-media-login" class="row">
			<?php qtx_social_login("full"); ?>
			</div>
			<br><h5><?php qtx_string_e( 'Its easier and faster', 'TheQuartex' ); ?></h5><br>
			<br><h5><?php qtx_string_e( 'You can use the following form too:', 'TheQuartex' ); ?></h5><br>
		<?php endif; ?>

		<?php
		if (is_page('links','enlaces','linkinbio','linktree')) { ?>
			<div class="links-box" style="max-width: 250px;">

			<nav id="linktree" class="sidebar-menu" style="max-width: 250px;">
				<?php
				wp_nav_menu(array(
					'theme_location' => 'linktree',
					'menu_id'        => 'Linktree',
				));
				?>
				<!--Outputs an ul list of links managed from main-navigation styles-->
			</nav>
			</div>
		<?php
		}
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'TheQuartex' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'TheQuartex' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
