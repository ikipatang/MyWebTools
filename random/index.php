<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="générer un nombre aléatoire." />
	<title>Générer un nombre aléatoire - le hollandais volant</title>
	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

#main-form {
	text-align: center;
}
.text {
	min-width: 50px;
	width: 70px;
}
#result {
	margin: 70px auto 30px;
	height: 120px;
	min-width: 120px;
	font-size: 5em;
	line-height: 1em;
	text-shadow: 1px 2px 0px rgba(200, 200, 200, .7);
	border: 10px solid #222;
	border-radius: 15px;
	background: #000;
	background: linear-gradient(to bottom, rgba(255, 255, 255, .6), rgba(255, 255, 255, 0)), #000;

	animation: lbutton 4s infinite ease-in-out alternate;
	cursor: pointer;
}

@keyframes lbutton {
	  0% { box-shadow: 0px 0px 10px #00f; color: #77f; }
	 40% { box-shadow: 0px 0px 10px #ff0; color: #ff7; }
	 60% { box-shadow: 0px 0px 10px #f00; color: #f77; }
	100% { box-shadow: 0px 0px 10px #0f5; color: #7fb; }
}

#result:active {
	text-shadow: 0px -1px 0px rgba(0, 0, 0, .5);
	box-shadow: 1px 2px 3px gray, 0px 2px 0px #467 inset;
	background: #0098FF;
	background: linear-gradient(to top, rgba(255, 255, 255, .6), rgba(255, 255, 255, 0)), #000;
}

	</style>
</head>
<body>
<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Générer un nombre aléatoire</a></p>
</header>

<section id="main-form" class="main-form">
		<div id="select-rang">
			<p>Générer un nombre entre <input class="text" type="number" id="min" name="min" min="0" step="1" value="1" /> et <input  class="text" type="number" id="max" name="max" min="0" step="1" value="10" /> :</p>
		</div>
		<button id="result" onclick="randomize()" class="centrer">?</button>
</section>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script>
'use strict'

function randomize() {
	var min = document.getElementById('min').value;
	var max = document.getElementById('max').value;
	var rand = Math.floor(Math.min(min, max) + Math.random()*Math.abs(min-max));
	document.getElementById('result').innerHTML = rand;
}

</script>
<!--

# adresse de la page : http://lehollandaisvolant.net/tout/tools/random/
#      page créée le : 30 mars 2013
#     mise à jour le : 4 avril 2013

-->
</body>
</html>