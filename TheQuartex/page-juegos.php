<?php
/*
Template Name: Juegos
*/
/**
 *
 * Wordpress page template, not much to say, generic way of displaying our content
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TheQuartex
 */

get_header();
?>
<style>
#single-page {
	display: grid;
	grid-gap: 2em 10px;
	margin: 0 1em 0 3em;
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

		<?php
		//Embeds
		$minecraft = '
		<iframe id="EmbedClassicMinecraft"
				title="Embedded Classic Minecraft in quartex.net"
				style="min-width:1024px;min-height:768px;max-width:1920px;max-height:1080px;width:100%"
				src="https://classic.minecraft.net/">
		</iframe>
		';
		$krunker = '
		<iframe id="EmbedKrunkerIO"
				title="Embedded krunker.io videogame"
				style="min-width:1024px;min-height:768px;max-width:1920px;max-height:1080px;width:100%"
				src="https://krunker.io/">
		</iframe>
		';
		//Two dimensional array of games and meta
		$playableGames = array(
			'minecraft'=>array(
				'title'=>'Minecraft Classic',
				'embed'=>$minecraft,
				'img'=>'https://i.imgur.com/jLNXc.png',
				'description'=>'Entendemos por "Minecraft Classic" la versión primigenia, la publicada antes de la versión con cambios de 2011. Y, cuando hablamos de "versión original", es "versión original", ya que lo que podemos jugar ahora es la versión con los 32 bloques, el modo creativo y los bugs que tenía aquella versión.'
			),
			'krunker'=>array(
				'title'=>'Krunker IO',
				'embed'=>$krunker,
				'img'=>'https://i.imgur.com/32ouvcp.jpg',
				'description'=>'Krunker.io se define como un shooter para navegadores, aún en fase beta. Haciendo uso de la primera persona, traslada al jugador al campo de batalla con un objetivo simple de entender: seguir en pie hasta agotarse el tiempo, preferiblemente, con un buen puñado de puntos.'
			),
		);
		//The game is note set
		$isSetGame = False;
		if (isset($_GET['playgame'])) {
			//Clean
			$playGame = preg_replace('/[^A-Za-z0-9\-]/', '', $_GET['playgame']);
			//Find the key in the array
			if (array_key_exists($playGame,$playableGames)) {
				//The game is set
				$isSetGame = True;
				echo '<div id="single-page" class="base-box singlepost-box">';
				echo $playableGames[$playGame]['title'];
				echo "<br>";
				echo $playableGames[$playGame]['embed'];
				echo '</div>';
			} else {
				echo "<p>404</p>";
			}
		}
		if (!$isSetGame) {
			$blogURL = home_url();
			echo '<div id="main-posts" class="main-posts">';
			foreach ($playableGames as $key => $Game) {
				$gametitle = $Game['title'];
				$gameimg = $Game['img'];
				$playGame = $key;
				$gamedesc = $Game['description'];
				echo '
				<a href="'.$blogURL.'es/juegos/?playgame='.$playGame.'" title="'.$gametitle.'">
					<div id="post-"'.$playGame.'" class="base-box post-box post-normal">
						<div id="post-title">
							<div class="post-title">
								<span><h4 class="post-title-h4">
									<center>
										<i class="fas fa-gamepad" aria-hidden="true"></i> '.$gametitle.'
									</center>
								</h4></span></div>
							</div>
						<div id="post-thumb" class="row">
							<div class="post-thumb">
								<img src="'.$gameimg.'" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" loading="lazy" width="450" height="95"> </div>
							</div>
							<center>
							<p>'.$gamedesc.'</p>
							</center>
					</div>
				</a>
				';
			}
			echo '</div>';
		}
		?>
		</div>
	</main>
</div>
</div>
<!-- #primary -->

<?php
get_footer();
