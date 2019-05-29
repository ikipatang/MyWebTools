<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Venez récupérer votre ./badge !!" />
	<title>Jeu du Badge-Foudre - le hollandais volant</title>
	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

#game-wrapper {
	text-align: center;
}

#image-wrapper {
	position: relative;
	border: 2px solid tr
	;
	display: inline-block;
	line-height: 0;
}

#image-wrapper > button {
	position: absolute;
	position: absolute;
	height: 43px;
	width: 37px;
	background: transparent;
	border: 1px dashed transparent;
	cursor: pointer;
}

#output {
	display: inline-block;
	position: absolute;
	bottom: 0;
	width: 100%;
	background: white;
	height: 100px;
	left: 0;
	box-sizing: border-box;
	border: 10px double gray;
	border-radius: 10px 10px 0 0;
	text-align: left;
	line-height: 1.65;
	font-size: 1.3em;
	font-family: monospace;
	padding: 5px;
}

#output:empty {
	display: none;
}

#doors {
	opacity: 1;
	width: 96px;
	height: 47px;
	display: inline-block;
	position: absolute;
	top: 218px;
	left: 216px;
	background-image: url(carmin.png);
	background-position: -216px -219px;
}

#doors.open {
	background-position: -216px -173px;
}


	</style>
</head>
<body>
<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Jeu du Badge-Foudre</a></p>
</header>

<section id="main-form" class="main-form">
	<h1></h1>

<div id="game-wrapper">

	<span id="image-wrapper">
		<img id="arene" src="carmin.png" alt="Sprite de l’arène de Carmin-sur-Mer." />
		<button id="b11" class="bins" type="button" style="top: 363px; left: 76px;"></button>
		<button id="b12" class="bins" type="button" style="top: 363px; left: 172px;"></button>
		<button id="b13" class="bins" type="button" style="top: 363px; left: 268px;"></button>
		<button id="b14" class="bins" type="button" style="top: 363px; left: 364px;"></button>
		<button id="b15" class="bins" type="button" style="top: 363px; left: 460px;"></button>
		<button id="b21" class="bins" type="button" style="top: 458px; left: 76px;"></button>
		<button id="b22" class="bins" type="button" style="top: 458px; left: 172px;"></button>
		<button id="b23" class="bins" type="button" style="top: 458px; left: 268px;"></button>
		<button id="b24" class="bins" type="button" style="top: 458px; left: 364px;"></button>
		<button id="b25" class="bins" type="button" style="top: 458px; left: 460px;"></button>
		<button id="b31" class="bins" type="button" style="top: 554px; left: 76px;"></button>
		<button id="b32" class="bins" type="button" style="top: 554px; left: 172px;"></button>
		<button id="b33" class="bins" type="button" style="top: 554px; left: 268px;"></button>
		<button id="b34" class="bins" type="button" style="top: 554px; left: 364px;"></button>
		<button id="b35" class="bins" type="button" style="top: 554px; left: 460px;"></button>
		<span id="doors"></span>

		<button id="bMB" type="button" style="top: 74px; left: 317px;"></button>
		<span id="output"></span>
	</span>


</div>

</section>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script>
'use strict'

var buttons = document.querySelectorAll('#image-wrapper > button.bins');
var out = document.getElementById('output');
var buttonState = 0;
var secondButton = "";

var firstBins = ['b11', 'b13', 'b15', 'b22', 'b24', 'b31', 'b33', 'b35'];

var secondBins = [
	{but1: 'b11', buts2: ['b12'] },
	{but1: 'b13', buts2: ['b12', 'b14', 'b33'] },
	{but1: 'b15', buts2: ['b25'] },
	{but1: 'b22', buts2: ['b23'] },
	{but1: 'b24', buts2: ['b25'] },
	{but1: 'b31', buts2: ['b32'] },
	{but1: 'b33', buts2: ['b32', 'b23', 'b34'] },
	{but1: 'b35', buts2: ['b25'] },
]


var randomizeFirstButton = firstBins[Math.floor(Math.random()*firstBins.length)];

buttons.forEach(function(button) {
	button.addEventListener('click', function() {

		// the game starts or no button has been found
		if (buttonState === 0) {
			// the first button is found
			if (randomizeFirstButton == button.id) {
				buttonState = 1;
				// grep the list of corresponding secondth buttons
				secondButton = secondBins.find(function(bin) {
					return bin.but1 == button.id;
				});
				out.textContent = 'Oh! Un bouton dans la poubelle! Dingue! Le premier verrouillage est levé!';
			}
			// we did not found this time…
			else {
				out.textContent = 'Mmmm! Un joli tas d’ordures... Miam!';
			}
		}

		// a button has been found on the previous try
		else if (buttonState === 1) {
			// selects a secondary button
			var randomizeSecondButton = secondButton.buts2[Math.floor(Math.random()*secondButton.buts2.length)];

			// if the secondary button matches the current one, the door opens
			if (secondButton.buts2.includes(button.id)) {
				out.textContent = 'Le deuxième verrouillage est levé! La porte s’ouvre! Vous avez gagné!';
				document.getElementById('doors').classList.add('open');

				document.getElementById('bMB').addEventListener('click', function() {
					out.textContent = './\nBrAvo, vous venez De Gagner un badgE ! .P mais ce N’est pas la fin de l’éniGme...'

				})
			}
			// else, the doors do not open, and we reset the first button and the button state
			else {
				out.textContent = 'Une poubelle bien dégueulasse. Oups... Les verrouillages sont en place.';
				randomizeFirstButton = firstBins[Math.floor(Math.random()*firstBins.length)];
				buttonState = 0;
			}


		}

	});
});


/* ]]> */
</script>
<!--

# adresse de la page : http://lehollandaisvolant.net/tout/tools/badge-foudre
#      page créée le : 20 mars 2019
#     mise à jour le : 20 mars 2019

-->
</body>
</html>
