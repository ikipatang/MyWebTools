<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<title>Post-it - le hollandais volant</title>

	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Prendre des notes dans le navigateur." />
	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<link rel="stylesheet" href="styles/inline.css" type="text/css" />
	<link rel="manifest" href="manifest.json">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-title" content="NotesWall">
	<link rel="apple-touch-icon" href="images/icons/icon-256x256.png">
	<meta name="msapplication-TileImage" content="images/icons/icon-256x256.png">
	<meta name="msapplication-TileColor" content="#00C853">

</head>
<body>

<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="../0common/lhv-384x384.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Mes Post-It</a></p>
	<button type="button" disabled="" id="enregistrer"></button>

</header>

<div class="main-form">
	<div id="post-new-note">
		<div class="contain">Créer une note…</div>
	</div>
	<div id="list-notes"></div>

	<div class="notes centrer">
		<p>Les notes sont sauvegardées en local dans votre navigateur, même si vous fermez la page.</p>
		<p>Cette page est compatible Web-App (PGA).</p>
	</div>

</div>

<footer id="footer"><a href="https://lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script src="scripts/app.js" async></script>

<!--

# adresse de la page : https://lehollandaisvolant.net/tout/tools/notes/
#      page créée le : 23 novembre 2018
#     mise à jour le : 23 novembre 2018

-->
</body>
</html>