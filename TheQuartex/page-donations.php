<?php
/*
Template Name: Donations
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

      <?php
      while ( have_posts() ) :
        the_post(); ?>
        <article id="create-post" <?php post_class(); ?>>
          <header class="entry-header">
            <h1 class="entry-title">
            <?php the_title(); ?>
            </h1>
          </header><!-- .entry-header -->
          <div class="entry-content">
            <?php
            if (isset($_GET['platform']) && isset($_GET['success'])) {
              if (is_user_logged_in()) {
                $myplatform = htmlspecialchars($_GET['platform'], ENT_QUOTES);
                $mysuccess = htmlspecialchars($_GET['success'], ENT_QUOTES);
                $type_sub = htmlspecialchars($_GET['type'], ENT_QUOTES);
                $types = array('libresub','fixedsub');
                $platforms = array('mp','paypal');
              } else {
                echo "<p>No estas loggeado.</p>";
              }
            }
            if (is_user_logged_in()) {
              $lang = pll_current_language();
              if ($lang == 'en') {
                echo "<p>This page is still not publicly available o supported, only for people within <a href='https://quartex.net/es/donaciones'>Argentina</a><p>
                  </p>But if you do contact me vía discord, i can accept a donation vía Paypal <strong>thekorko#5622</strong>. <br>Thank you.</p>
                  <p>Discord QTX: <a href='https://discord.gg/rQMxNBCq'>https://discord.gg/rQMxNBCq</a></p>
                  <p>Community: <a href='https://quartex.net/es/comunidad/'>https://quartex.net/es/community/</a></p>";
              } else {
              ?>
              <p>Sí sos de <strong>Argentina</strong> y usás <strong>MercadoPago</strong> pódes <strong>Subscribirte</strong> a QuartexNet de manera voluntaria, usando el siguiente botón y luego ingresá el monto que vos quieras.</p>
              <a mp-mode="dftl" href="https://www.mercadopago.com.ar/subscriptions/checkout?preapproval_plan_id=2c9380847d70946c017d89a478cd0d7a" name="MP-payButton" class='blue-ar-l-rn-none'>Suscribirme</a><script type="text/javascript">   (function() {      function $MPC_load() {         window.$MPC_loaded !== true && (function() {         var s = document.createElement("script");         s.type = "text/javascript";         s.async = true;         s.src = document.location.protocol + "//secure.mlstatic.com/mptools/render.js";         var x = document.getElementsByTagName('script')[0];         x.parentNode.insertBefore(s, x);         window.$MPC_loaded = true;      })();   }   window.$MPC_loaded !== true ? (window.attachEvent ? window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;   })();</script>
              <p>Sí el botón no te funciona te dejo el link de <a alt="https://www.mercadopago.com.ar/subscriptions/checkout?preapproval_plan_id=2c9380847d70946c017d89a478cd0d7a" href="https://www.mercadopago.com.ar/subscriptions/checkout?preapproval_plan_id=2c9380847d70946c017d89a478cd0d7a">MercadoPago</a></p>
              <p>El dinero recibido se utilizara para QuartexNet, en especial para gastos del servidor. Muchísimas Gracias por tu colaboración.</p>
              <p>Otra opción sería invitarme un cafecito usando esta app que está genial <a href='https://cafecito.app/thekorko'>CafecitoAPP</a></p>
              <p>Sí preferis hacer una donación por transferencia de CVU/CBU escríbime por discord: <strong>thekorko#5622</strong></p>
              <p>Por el momento, no hay rangos, ni puntos, ni recompensas establecidas. Estoy maquinando algún tipo de sistema de recompensas, pero hay mucho trabajo que hacer.  Ósea que en un futuro va a haber un boton re copado de sub, ahí arriba.</p>
              <p>De todas formas, <b>si donás hablame por discord</b> y seguramente te programo algún <b>premio</b> dentro de la web.</p>
              <p>Sí todavía no tenés billetera en Ripio y me queres regalar un referido te dejo mi link: <a href='https://join.ripio.com/ref/guillermosebastian_s_4'>Ripio App</a> por cada uno me dan alrededor de (150RPC) cada RCP vale como 2 pesos y algo, así que bueno es algo.<br>Además si te vas a registrar en ripio pódes hacer las misiones de la app.</p>
              <p>De momento eso es todo, tengo una cuenta paypal, si me queres donar por ahi, lo mismo escribíme al discord, y billeteras de cryto realmente no uso. Si se te ocurre otro medio de pago, comentame por discord. </p>
              <p>Cualquier duda te dejo mi discord: <strong>thekorko#5622</strong></p>
              <p>Discord de QTX: <a href="https://discord.gg/rQMxNBCq">https://discord.gg/rQMxNBCq</a></p>
              <p>Comunidad: <a href="https://quartex.net/es/comunidad/">https://quartex.net/es/comunidad/</a></p>
            <?php
             }
           } else {
              the_content();
              qtx_social_login("full");
            }
            wp_link_pages( array(
              'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'TheQuartex' ),
              'after'  => '</div>',
            ) );
            ?>
          </div>
          <article>
      <?php
      endwhile; // End of the loop.
      ?>
    </div>
 		</main>
 </div>
 <!-- #primary -->

 <?php
 get_footer();
