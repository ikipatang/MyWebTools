<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Encoder et décoder des données en base64" />

	<title>Encoder et décoder des données en base64 - le hollandais volant</title>

	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>


#input-text, #output {
	padding: 10px;
	border: 1px solid silver;
	width: 100%;
	border-radius: 2px;
	min-width: 280px;
	text-align: left;
	background: white;
	box-sizing: border-box;

}

#output {
	background: #eee;
	cursor: not-allowed;
}



#givefile {
	margin: 20px auto;
}

#file {
	border: 1px solid silver;
	padding: 4px 10px;
	margin-top: 10px;
	margin-bottom: 10px;
	border-radius: 5px;
}

.separator {
	margin: 50px 0;
	height: 0;
	line-height: 0px;
	border: 1px solid grey;
	vertical-align: middle;
}

.separator > span {
	vertical-align: middle;
	height: 0;
	position: relative;
	background-color:  #FAFAFA;
	margin-left: 20px;
	padding: 0 10px;
	font-weight: bold;
	font-style: italic;
}

	</style>
</head>
<body>

<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Encoder et décoder du Base64</a></p>
</header>

<section id="main-form" class="main-form">

	<label for="input-text">Entrez votre texte :</label> 
	<textarea name="input-text" id="input-text" rows="7" cols="40" placeholder="Placez votre texte ici" class="centrer"></textarea>

	<p><button id="encode-text" class="button button-submit"><b>En</b>coder</button> <button id="decode-text" class="button button-submit"><b>Dé</b>coder</button></p>

	<p class="separator"><span>OU</span></p>
	<div id="givefile">
		<label for="file">Sélectionnez votre fichier :</label><br/>
		<input id="file" type="file" />
	</div>

	<label for="output">Le résultat :</label> 
	<textarea id="output" rows="8" cols="50" placeholder="Le résultat sera ici" readonly class="centrer"></textarea>

	<div class="notes">
		<p>Cet outil utilise <a href="https://code.google.com/p/crypto-js/">Crypto-JS</a>.</p>
	</div>

</section>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script>
'use strict'
// See https://developer.mozilla.org/en-US/docs/Web/API/WindowOrWorkerGlobalScope/btoa
// ucs-2 string to base64 encoded ascii
function encodeBase64(str) {
    return window.btoa(unescape(encodeURIComponent(str)));
}
// base64 encoded ascii to ucs-2 string
function decodeBase64(str) {
	var ret = window.atob(str);
	try {
		var retUnicode = decodeURIComponent(escape(ret));
	}
	catch (e) {
		console.log('DecodeURIComponent failed; palling back to raw output.')
		return ret;
	}
    return retUnicode;
}

function encodeBase64file(files) {
	var filename = files[0];
	var fr = new FileReader();
	var result = "";
	fr.addEventListener('load', function() {
		document.getElementById('output').value = this.result;
	});
	fr.readAsDataURL(filename);

	return fr.result;
}

document.getElementById('encode-text').addEventListener('click', function() {
	var str = document.getElementById('input-text').value;
	document.getElementById('output').value = encodeBase64(str);

});

document.getElementById('decode-text').addEventListener('click', function() {
	var str = document.getElementById('input-text').value;
	document.getElementById('output').value = decodeBase64(str);
});

document.getElementById('file').addEventListener('change', function() {
	encodeBase64file(this.files);
});


</script>
<!--

# adresse de la page : http://lehollandaisvolant.net/tout/tools/base64/
#      page créée le : 14 mars 2013
#     mise à jour le : 19 mars 2019

-->
</body>
</html>
