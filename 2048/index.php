<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="" />

	<title>2048 - le hollandais volant</title>

	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<link href="style/main.css" rel="stylesheet" type="text/css">
	<style>
body {
	margin: 0;
}
.main-form {
	margin-bottom: 35px;
}
.main-form .notes {
	margin-top: 20px;
}

	</style>
</head>
<body>

<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">2048</a></p>
</header>

<section class="main-form">
	<div class="container">
		<div class="heading">
			<div class="scores-container">
				<div class="score-container">0</div>
				<div class="best-container">0</div>
			</div>
		</div>
		<div class="game-container">
			<div class="game-message">
				<p></p>
				<div class="lower">
					<a class="keep-playing-button">Continuez</a>
					<a class="retry-button">Essayez encore</a>
				</div>
			</div>

			<div class="grid-container">
				<div class="grid-row">
					<div class="grid-cell"></div>
					<div class="grid-cell"></div>
					<div class="grid-cell"></div>
					<div class="grid-cell"></div>
				</div>
				<div class="grid-row">
					<div class="grid-cell"></div>
					<div class="grid-cell"></div>
					<div class="grid-cell"></div>
					<div class="grid-cell"></div>
				</div>
				<div class="grid-row">
					<div class="grid-cell"></div>
					<div class="grid-cell"></div>
					<div class="grid-cell"></div>
					<div class="grid-cell"></div>
				</div>
				<div class="grid-row">
					<div class="grid-cell"></div>
					<div class="grid-cell"></div>
					<div class="grid-cell"></div>
					<div class="grid-cell"></div>
				</div>
			</div>

			<div class="tile-container">

			</div>
		</div>


<div class="notes centrer">
	<p>Utilisez les <strong>flèches du clavier</strong> pour jouer.</p>
	<p>Jeu créé par <a href="http://gabrielecirulli.com">Gabriele Cirulli</a>. Code source de <a href="http://framagames.org/">FramaGames</a></p>
</div>

</section>


<footer id="footer"><a href="/">Timo Van Neerden</a> - <a href="../">autres outils</a></footer>

<!--<script src="js/animframe_polyfill.js"></script>-->
<script src="js/keyboard_input_manager.js"></script>
<script src="js/html_actuator.js"></script>
<script src="js/grid.js"></script>
<script src="js/tile.js"></script>
<script src="js/local_score_manager.js"></script>
<script src="js/game_manager.js"></script>
<script src="js/application.js"></script>
<!--

# adresse de la page : http://lehollandaisvolant.net/tout/tools/2048/
#      page créée le : 19 juin 2015
#     mise à jour le : 19 juin 2015

-->
</body>
</html>