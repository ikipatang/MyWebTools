<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Tester sa vitesse de connexion internet" />

	<title>Test de connexion - le hollandais volant</title>

	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

#p-button {
	text-align: center;
}

@keyframes spinner {
	0% {
		transform: rotate(0deg);
	}
	100% {
		transform: rotate(359deg);
	}
}

.button-submit {
	line-height: 2em;
}

.main-form {
	max-width: 500px;
	padding: 10px 5px;
}
#output {
	text-align: center;
	margin: 20px auto;
	padding: 20px 0;
}

.dl, .ul {
	border: 1px solid grey;
	padding: 20px 15px 20px 30px;
	margin: 10px 5px;
	border-radius: 4px;
	display: inline-block;
	width: 115px;
	position: relative;
	line-height: 2em;
}



/* arrows */
.dl::before,
.ul::before {
	content: "↓";
	border: transparent;
	font-size: 2em;
	font-weight: bold;
	position: absolute;
	left: 15px;
	top: 0;
	bottom: 0;
	height: 72px;
	line-height: 72px;
}
.ul::before {
	content: "↑";
 }


/* spinner */
#dl::after,
#ul::after {
	content: "";
	display: inline-block;
	margin: 0 5px 0 0;
	height: 2em;
	width: 2em;
	border: 6px solid rgba(255, 255, 255, 0.5);
	border-top-color: transparent;
	border-radius: 50%;
	animation: spinner 0.6s infinite linear;
	vertical-align: middle;
	box-sizing: border-box;
}


.dl {
	background-image: linear-gradient(to bottom, #eee, #888);
}
.ul {
	background-image: linear-gradient(to top, #eee, #888);
}

	</style>
</head>
<body>

<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Tester sa connexion</a></p>
</header>

<section class="main-form">
	<div id="output"></div>
	<p id="p-button"><button id="testButton" onclick="downloadTest();" class="button button-submit">Tester sa connexion</button></p>
				
	<div class="notes centrer">
		<p>Le test mesure le temps mis pour télécharger une image depuis Wikipédia.</p>
		<p>Le test en sens montant peut ne pas être précis, dépendant du serveur.</p>
	</div>
</section>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script>
/* <![CDATA[ */
"use strict";
var isTest = 0;
var outputNode = document.getElementById('output');
var buttonNode = document.getElementById('testButton');
// download
// Downloads a Wikipedia Image with a known size, and measures the time it takes.
function downloadTest() {
	buttonNode.disabled = true;
	// Result Nodes
	var dlNode = document.createElement('span');
	dlNode.classList.add('dl');
	dlNode.id = 'dl';
	dlNode.appendChild(document.createTextNode(' '));
	outputNode.appendChild(dlNode);
	var ulNode = document.createElement('span');
	ulNode.classList.add('ul');
	ulNode.id = 'ul';
	ulNode.appendChild(document.createTextNode(' '));
	outputNode.appendChild(ulNode);

	var img = new Image();
	var startTimeDL, endTimeDL;
	var url = "https://upload.wikimedia.org/wikipedia/commons/2/2d/Snake_River_%285mb%29.jpg";
	var dataSize = 5245329; //bytes
	url = url + '?nnn=' + (new Date()).getTime(); // avoid browser cache

	img.onerror = function(err, msg) {
		dlNode.id = '';
		dlNode.appendChild(document.createTextNode('Erreur.'));
		buttonNode.disabled = false;
	}

	img.onload = function() {
		endTimeDL = (new Date()).getTime();
		var durationDL = (endTimeDL - startTimeDL) / 1000;
		var bitsLoadedDL = dataSize * 8;
		var speedMbpsDL = ((bitsLoadedDL / durationDL) / 1024 / 1024).toFixed(2);

		dlNode.id = '';
		dlNode.appendChild(document.createTextNode(speedMbpsDL + ' Mbps'));

		// after DL speedtest, start UL test
		window.setTimeout(uploadTest(), 1000);
	}

	startTimeDL = (new Date()).getTime();
	img.src = url;
}



// Upload
// Submits a form with 2 MB of data and measures the time it takes for that to be done.
// The data is not stored and the "upload.php" is an empty file.
function uploadTest() {
	var http = new XMLHttpRequest();
	var startTimeUL, endTimeUL;
	var url = "upload.php";
	var myData = "".padStart(2*1000*1000, "A"); // the raw data to be sent
	var dataSize = myData.length;
	http.open("POST", url, true);
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	var ulNode = document.getElementById('ul')

	http.onerror = function() {
		ulNode.id = '';
		ulNode.appendChild(document.createTextNode('Erreur.'));
		buttonNode.disabled = false;
	}

	http.onreadystatechange = function() {
		if(http.readyState == 4 && http.status == 200) {
			endTimeUL = (new Date()).getTime();

			var durationUL = (endTimeUL - startTimeUL) / 1000; // in milliseconds
			var bitsLoadedUL = dataSize * 8; // in bits
			var speedMbpsUL = ((bitsLoadedUL / durationUL) / 1024 / 1024).toFixed(2); // in Mbps

			ulNode.id = '';
			ulNode.appendChild(document.createTextNode(speedMbpsUL + ' Mbps'));
			buttonNode.disabled = false;
		}
	}
	startTimeUL = (new Date()).getTime();
	http.send(myData);
}

/* ]]> */
</script>
<!--

# adresse de la page : https://lehollandaisvolant.net/tout/tools/speedtest/
#	 page créée le : 16 août 2018
#	mise à jour le : 16 août 2018

-->
</body>
</html>