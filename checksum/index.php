<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Génère des sommes de contrôle d’un fichier" />

	<title>Calculer la somme de contrôle d’un fichier ou d’un texte - le hollandais volant</title>

	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>
#data {
	padding: 10px;
	border: 1px solid silver;
	border-radius: 5px;
	text-align: left;
	width: 100%;
	box-sizing: border-box;
}

#givefile {
	margin: 20px auto;
}

#file{
	border: 1px solid silver;
	padding: 4px 10px;
	margin-top: 10px;
	margin-bottom: 10px;
	border-radius: 5px;
}

label[for="data"] {
	display: inline-block;
	margin: 30px auto 15px;
}

#output {
	text-align: left;
	border: 1px solid silver;
	border-radius: 2px;
	padding: 10px;
	background: #f0f0f0;
	margin: 20px auto;
	word-wrap:break-word;

}

#output span {
	background-color: white;
	border: silver 1px solid;
	border-radius: 1px;
	padding: 3px 10px;
	font-family: monospace;
	word-wrap:break-word;
	display: block;
}

	</style>
</head>
<body>

<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Calculer une somme de contrôle</a></p>
</header>

<section id="main-form" class="main-form">

	<label for="data">Entrez votre texte :</label> 
	<textarea name="data" id="data" rows="7" cols="40" placeholder="Placez votre texte ici" class="centrer"></textarea>

	<p style="font-weight: bold;">— OU —</p>
	<div id="givefile">
		<label for="file">Sélectionnez votre fichier :</label><br/>
		<input id="file" type="file" onchange="loadfile(this.files);" />
	</div>

	<button type="button" id="calculer" value="Calculer" class="button button-submit">Calculer</button>

	<div id="output">
	<p>MD5 : <span> </span></p>
	<p>SHA1 : <span> </span></p>
	<p>SHA256 : <span> </span></p>
	<p>SHA512 : <span> </span></p>
	<p>SHA3 : <span> </span></p>
	</div>

	<div class="notes">
		<p>Cet outil utilise <a href="https://code.google.com/p/crypto-js/">Crypto-JS</a>.</p>
	</div>

</section>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script src="crypto-js/rollups/md5.js"></script>
<script src="crypto-js/rollups/sha1.js"></script>
<script src="crypto-js/rollups/sha256.js"></script>
<script src="crypto-js/rollups/sha3.js"></script>
<script src="crypto-js/rollups/sha512.js"></script>

<script>
/* <![CDATA[ */
data = "";

function arrayBufferToWordArray(arrayBuffer) {
	var fullWords = Math.floor(arrayBuffer.byteLength / 4);
	var bytesLeft = arrayBuffer.byteLength % 4;

	var u32 = new Uint32Array(arrayBuffer, 0, fullWords);
	var u8 = new Uint8Array(arrayBuffer);

	var cp = [];
	for (var i = 0; i < fullWords; ++i) {
		cp.push((((u32[i] & 0xFF) << 24) | ((u32[i] & 0xFF00) << 8) | ((u32[i] >> 8) & 0xFF00) | ((u32[i] >> 24) & 0xFF)) >>> 0);
	}
	if (bytesLeft) {
		var pad = 0;
		for (var i = bytesLeft; i > 0; --i) {
			pad = pad << 8;
			pad += u8[u8.byteLength - i];
		}
		for (var i = 0; i < 4 - bytesLeft; ++i) {
			pad = pad << 8;
		}
		cp.push(pad);
	}
	return CryptoJS.lib.WordArray.create(cp, arrayBuffer.byteLength);
}


function getData() {
	if (document.getElementById('data').value != "") {
		data = document.getElementById('data').value;
	}
	if (data.words) {
		var filesize = data.words.length * 4;
		if (filesize > 500000000 ) {
			confirm('Le fichier fait plus de 500 Mo. Le calcul peut être très long. Continuer ?')
		}
		else {
			if (filesize > 50000000 ) {
				confirm('Le calcul peut prendre >2 minutes. Continuer ?')
			}
			else {
				if (filesize > 5000000 ) {
					confirm('Le calcul peut prendre >15m secondes. Continuer ?')
				}
			}
		}
	}
	return data;
}

function checksum() {
	var output = document.getElementById('output');

	var odata = getData();

	var html = '';
	html += '<p>MD5 : <span>'+CryptoJS.MD5(odata)+'</span></p>';
	html += '<p>SHA1 : <span>'+CryptoJS.SHA1(odata)+'</span></p>';
	html += '<p>SHA256 : <span>'+CryptoJS.SHA256(odata)+'</span></p>';
	html += '<p>SHA512 : <span>'+CryptoJS.SHA512(odata)+'</span></p>';
	html += '<p>SHA3 : <span>'+CryptoJS.SHA3(odata)+'</span></p>';

	output.innerHTML = html;
}

function loadfile(files) {
	if (files.length == 0) return;
	var filename = files[0];
	var fr = new FileReader();
	fr.onload = function(e) { data = arrayBufferToWordArray(e.target.result); return data;};
	fr.readAsArrayBuffer(filename);
}

document.getElementById('calculer').addEventListener('click', function() {
	checksum();
});

/* ]]> */
</script>
<!--

# adresse de la page : http://lehollandaisvolant.net/tout/tools/checksum/
#      page créée le : 14 septembre 2013
#     mise à jour le : 16 septembre 2013

-->
</body>
</html>