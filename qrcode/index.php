<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Un générateur QR Code en Javascript et HTML." />
	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<title>Générer un QRcode™ - le hollandais volant</title>
	<style>
#output {
	text-align: center;
	margin: 50px 0;
}

#data {
	padding: 10px;
	border: 1px solid silver;
	border-radius: 5px;
	min-width: 200px;
	text-align: left;
	width: 100%;
	box-sizing: border-box;
}

label[for="data"] {
	margin: 30px auto 15px;
	text-align: left;
}

#margin,
#cellsize {
	width: 3em;
}

#outputimg {
	border: none;
	box-shadow: 5px 5px 15px silver;
}

.textright {
	text-align: right;
}
	</style>
</head>
<body>


<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Générer un QR Code™</a></p>
</header>


<section id="main-form" class="main-form">

	<div id="output"><a id="outputlink" href="#" download="image.png" onclick="downloadImage();"><img src="#" id="outputimg" alt="qrcode généré ici"></a></div>

	<label for="data">Entrez votre texte / URL / numéro de téléphone ici : </label> 
	<div id="debug"></div>
	<textarea name="data" id="data" rows="7" cols="40" placeholder="Placez votre texte ici" class="centrer"></textarea>

	<p class="textright">
		<label for="ecclevel">Niveau de redondance des données :</label> 
		<select name="ecclevel" id="ecclevel" onchange="return go();">
			<option value="L">L (faible ~7%)</option>
			<option value="M" selected="selected">M (moyen ~15%)</option>
			<option value="Q">Q (quart ~25%)</option>
			<option value="H">H (haut ~30%)</option>
		</select>
	</p>
	<p class="textright">
		<label for="margin">Taille de bordure :</label> 
		<input type="number" name="margin" min="0" id="margin" onchange="return go();" value="4" />
		</select>
	</p>

	<p class="textright">
		<label for="cellsize">Taille de cellule :</label> 
		<input type="number" name="cellsize" min="1" id="cellsize" onchange="return go();" value="4" />
		</select>
	</p>

	<p>
		<button onclick="go();" id="gen" class="button button-submit">Générer</button>
		<button onclick="popupShare();" id="share" class="button button-other">Partager</button>
	</p>

	<div class="notes">
		<p>Cliquez sur l’image pour la télécharger.</p>
		<p><a href="http://www.denso-wave.com/qrcode/faqpatent-e.html">QR Code™</a> - <a href="http://hg.mearie.org/qrjs/">Généré avec QR-JS</a></p>
	</div>

</section>


<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script type="text/javascript" src="qrcode.js"></script>

<script>
function go() {
	var data = document.getElementById('data').value;
	var options = {
		ecclevel: document.getElementById('ecclevel').value,
		margin: document.getElementById('margin').value,
		modulesize: document.getElementById('cellsize').value
	};
	var url = QRCode.generatePNG(data, options);
	document.getElementById('outputimg').src = url;
	return false;
}

function popupShare() {
	var data = document.getElementById('data').value;
	var loc = document.location.protocol +"//"+ document.location.hostname + document.location.pathname;
	var url = loc+'#'+encodeURIComponent(data);
	window.prompt('Partagez cette URL : ', url);
}

if (window.location.hash.length) {
	document.getElementById('data').value = decodeURIComponent(window.location.hash.substr(1));
}

go();

function downloadImage() {
	data = document.getElementById('outputimg').src;
	document.getElementById('outputlink').href = data;
}
</script>
</body>
</html>