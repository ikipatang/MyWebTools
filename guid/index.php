<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Génère un GUID en javascript" />

	<title>Générer un GUID - le hollandais volant</title>

	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

#output {
	border: 1px solid silver;
	border-radius: 5px;
	padding: 20px;
	background: #f0f0f0;
	text-align: center;
	font-size: 120%;
	font-family: monospace;
}

#p-button {
	text-align: center;
}
	</style>
</head>
<body>

<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Générer un GUID</a></p>
</header>

<section class="main-form">
	<p>Voici votre GUID :</p>
	<p id="output"></p>
	<p id="p-button"><button onclick="generateUUID();" class="button button-submit">Produire un autre GUID</button></p>

	<div class="notes centrer">
		<p>Il est improbable qu’un GUID généré sur cette page soit reproduit ailleurs. Le vôtre est donc unique.<br/>À cause des limitations du JavaScript, les GUID de cette page ne sont pas <em>cryptographiquement</em> sûrs.</p>
	</div>
</section>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script>
/* <![CDATA[ */
"use strict";


function generateUUID() {
	var d = new Date().getTime();
	var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
		var r = (d + Math.random()*16)%16 | 0;
		d = Math.floor(d/16);
		return (c=='x' ? r : (r&0x7|0x8)).toString(16);
	});

	document.getElementById('output').innerHTML = uuid;
};
generateUUID();

/* ]]> */
</script>
<!--

# adresse de la page : http://lehollandaisvolant.net/tout/tools/guid/
#      page créée le : 15 septembre 2014
#     mise à jour le : 20 septembre 2014

# see also : http://www.wasteaguid.info/

-->
</body>
</html>