<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Cette page permet de générer les tonalités de numéros de téléphone, utilisant les fréquences DTMF" />

	<title>Générer des tonalités DTMF - le hollandais volant</title>

	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>


.main-form {
	text-align: center;
}
input.text:focus {
	box-shadow: 0 0 3px silver inset, 0 0 2px silver;
}

input#numero {
	width: 160px;
}

button.submit {
	box-shadow: 0 0 3px silver;
	background: #FFEC85;
}

label span {
	display: none;
}

table {
	margin: 20px auto;
	border-collapse: collapse;
}


table td button {
	margin: 3px;
	height: 45px;
	width: 50px;
	border: 1px solid silver;
	border-radius: 5px;
	box-shadow: 2px 4px 0 silver;
	position: relative;
	background: #f0f0f0;
	font-size: 18px;
}

input:focus, button:focus {
	border-color: gray;
}

table td button:active {
	box-shadow: 1px 1px 1px silver;
	left: 1px;
	top: 2px;
	outline: none;
}

	</style>
</head>
<body>

<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Générer des tonalités DTMF</a></p>
</header>

<section class="main-form">
	<label><span>Votre numéro : </span><input type="text" id="numero" autofocus value="" placeholder="08 001 23 4 56" class="text" /></label>
	<button type="button" onclick="playNum(); return false;" class="button button-submit">Jouer !</button>

	<table>
		<tr>
			<td><button type="button" onclick="add('1')">1</button></td>
			<td><button type="button" onclick="add('2')">2</button></td>
			<td><button type="button" onclick="add('3')">3</button></td>
		</tr>
		<tr>
			<td><button type="button" onclick="add('4')">4</button></td>
			<td><button type="button" onclick="add('5')">5</button></td>
			<td><button type="button" onclick="add('6')">6</button></td>
		</tr>
		<tr>
			<td><button type="button" onclick="add('7')">7</button></td>
			<td><button type="button" onclick="add('8')">8</button></td>
			<td><button type="button" onclick="add('9')">9</button></td>
		</tr>
		<tr>
			<td><button type="button" onclick="add('*')">*</button></td>
			<td><button type="button" onclick="add('0')">0</button></td>
			<td><button type="button" onclick="add('#')">#</button></td>
		</tr>

		<tr>
			<td></td>
			<td><button type="button" onclick="add(' ')">_</button></td>
			<td></td>
		</tr>
	</table>

	<div class="notes centrer">
		<p>444565 46554 444565 46554 555522 54321 444565 46554<br/>12312234431231223451<br/>86 86 86 86 8687 8687 87 87 87 87 888 777 6 888 777 6 888 777 6 666 777 888777 6<br/>3334554321123322334554321123211 22312 343 12 343 12 343 334554321123211</p>
	</div>

</section>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script>
/* <![CDATA[ */

/*
	TODO:
	‑ long sounds
	- on sound play : stylize button press :p
*/

"use strict";

var s1 = new Audio('audio/Dtmf1.ogg');
var s2 = new Audio('audio/Dtmf2.ogg');
var s3 = new Audio('audio/Dtmf3.ogg');
var s4 = new Audio('audio/Dtmf4.ogg');
var s5 = new Audio('audio/Dtmf5.ogg');
var s6 = new Audio('audio/Dtmf6.ogg');
var s7 = new Audio('audio/Dtmf7.ogg');
var s8 = new Audio('audio/Dtmf8.ogg');
var s9 = new Audio('audio/Dtmf9.ogg');
var s0 = new Audio('audio/Dtmf0.ogg');
var ss = new Audio('audio/DtmfStar.ogg');
var sS = new Audio('audio/DtmfSharp.ogg');
var sN = new Audio('audio/DtmfSilence.ogg');

var audioHandler = new Audio();

function playNum() {
	var numeros = document.getElementById('numero').value.split('');
	if (numeros.length === 0) return;


	function loadNext() {
		var num = numeros.shift();

		switch(num) {
			case '0': audioHandler.src = 'audio/Dtmf0.ogg'; break;
			case '1': audioHandler.src = 'audio/Dtmf1.ogg'; break;
			case '2': audioHandler.src = 'audio/Dtmf2.ogg'; break;
			case '3': audioHandler.src = 'audio/Dtmf3.ogg'; break;
			case '4': audioHandler.src = 'audio/Dtmf4.ogg'; break;
			case '5': audioHandler.src = 'audio/Dtmf5.ogg'; break;
			case '6': audioHandler.src = 'audio/Dtmf6.ogg'; break;
			case '7': audioHandler.src = 'audio/Dtmf7.ogg'; break;
			case '8': audioHandler.src = 'audio/Dtmf8.ogg'; break;
			case '9': audioHandler.src = 'audio/Dtmf9.ogg'; break;
			case '*': audioHandler.src = 'audio/DtmfStar.ogg'; break;
			case '#': audioHandler.src = 'audio/DtmfSharp.ogg'; break;
			case ' ': audioHandler.src = 'audio/DtmfSilence.ogg'; break;
			default: audioHandler.src = 'audio/DtmfSilence.ogg'; break;
		}

		audioHandler.load();
		audioHandler.play();


	}
	audioHandler.addEventListener('ended', function() { loadNext();} );
	loadNext();


}


function add(val) {
	document.getElementById('numero').value += val;
}
/* ]]> */
</script>
<!--
# adresse de la page : http://lehollandaisvolant.net/tout/tools/dtmf/
#      page créée le : 20 novembre 2013
#     mise à jour le : 3 septembre 2017
-->
</body>
</html>