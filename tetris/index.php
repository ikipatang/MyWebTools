<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="" />

	<title>Jouer à Tetris - le hollandais volant</title>

	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

#main {
	display: flex;
	justify-content: center;
}

canvas{
	border: 1px solid black;
}

div#sidepanel {
	padding: 10px;
	vertical-align:top;
	display: inline-block;
	text-align: left;
	border: 1px solid black; 
	margin-left: 10px;
	height: 100%
}

div#points{
	font-size: 15px;
	font-weight: bold;
}
div#bottom {
	padding: 10px;
	width: 600px;
	margin: 10px auto;
}
	</style>
</head>
<body>

<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Tétris</a></p>
</header>

<section class="main-form">
	<div id="main"></div>
	<div class="notes">
	<p>Le code est adapté de <a href="https://code.google.com/p/e-tris/">e-Tris</a>, sous licence BSD.</p>
</div>
</section>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script src="script.js"></script>
<!--
# adresse de la page : http://lehollandaisvolant.net/tout/tools/tetris/
#      page créée le : 20 juin 2015
#     mise à jour le : 20 juin 2015
-->
</body>
</html>