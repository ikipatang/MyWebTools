<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Encoder un caractère (en unicode, bytecode, xml…)." />

	<title>Encoder un caractère (en unicode, bytecode, xml…) - le hollandais volant</title>

	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

.main-form {
	max-width: 600px;
}

#outputs {
	margin: 50px auto;
	text-align: right;
}

#outputs input {
	width: 350px;
}


	</style>
</head>
<body>

<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Encoder un caractère</a></p>
</header>

<section id="main-form" class="main-form">

	<p><label for="intext">Caractère :</label> <input id="intext" value="" placeholder="A" maxlength="4" size="1" type="text" tabindex="1" /></p>
	<button id="encode" class="button button-submit">Valider</button>

	<div id="outputs">

	<p><label>Caractère :</label>
	<input readonly type="text" id="out-char" value="" placeholder="A" /></p>

	<p><label for="out-codepoint">Hex Code Point :</label>
	<input readonly type="text" id="out-codepoint" value="" placeholder="U+41" /></p>

	<p><label for="out-xml-10">Entité XML décimal :</label>
	<input readonly type="text" id="out-xml-10" value="" placeholder="&#65;" /></p>

	<p><label for="out-URL">Percent-encoding :</label>
	<input readonly type="text" id="out-URL" value="" placeholder="A" /></p>
	<p><label for="out-URL">Percent-encoding (intégral) :</label>
	<input readonly type="text" id="out-all-URL" value="" placeholder="%41" /></p>

	<p><label for="out-json">JSON échappé :</label>
	<input readonly type="text" id="out-json" value="" placeholder="A" /></p>

	<p><label for="out-utf8">Octets UTF-8 :</label>
	<input readonly type="text" id="out-utf8" value="" placeholder="41" />
	<input readonly type="text" id="out-utf8-esc" value="" placeholder="0x41" /></p>

	<p><label for="out-oct">Octets UTF-8 Octal :</label>
	<input readonly type="text" id="out-oct" value="" placeholder="101" />
	<input readonly type="text" id="out-oct-esc" value="" placeholder="\101" /></p>

	<p><label for="out-bin">Octets UTF-8 Binaire :</label>
	<input readonly type="text" id="out-bin" value="" placeholder="1000001" /></p>

	<p><label for="out-b64">Base64 :</label>
	<input readonly type="text" id="out-b64" value="" placeholder="QQ==" /></p>

	</div>

<div class="notes centrer">
</div>

</section>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script>
'use strict'

var inNode = document.getElementById('intext');

function convertAll() {
	var char = inNode.value;
	if (char == "") return;

	// Code Point (hexa)
	var charCodePoint = char.codePointAt(0);
	// UTF8 Bytes
	var encoded = new TextEncoder("utf-8").encode(char);

	var outChar = document.getElementById('out-char');
	var outUtf8 = document.getElementById('out-utf8');
	var outUtf8Esc = document.getElementById('out-utf8-esc');

	var outCodePoint = document.getElementById('out-codepoint');

	var outURL = document.getElementById('out-URL');
	var outAllURL = document.getElementById('out-all-URL');
	
	var outOctal = document.getElementById('out-oct');
	var outOctalEsc = document.getElementById('out-oct-esc');

	var outBin = document.getElementById('out-bin');

	var outXML10 = document.getElementById('out-xml-10');
	//var outXML16 = document.getElementById('out-xml-16');

	var outB64 = document.getElementById('out-b64');

	var outJSON = document.getElementById('out-json');


	var utf8ByteStr = "", utf8ByteStrEsc = "";
	var utf8OctByteStr = "", utf8OctByteStrEsc = "";
	var utf8BinByteStr = "";
	var percentEnco = "";

	for (var i=0, len=encoded.length; i < len; i++) {
		utf8ByteStr += (parseInt(encoded[i], 10).toString(16)).toUpperCase() + " ";
		utf8ByteStrEsc += "0x" + (parseInt(encoded[i], 10).toString(16)).toUpperCase() + " ";

		percentEnco += "%" + (parseInt(encoded[i], 10).toString(16)).toUpperCase() + " "

		utf8OctByteStr += (parseInt(encoded[i], 10).toString(8)) + " ";
		utf8OctByteStrEsc += "\\" + (parseInt(encoded[i], 10).toString(8)) + " ";

		utf8BinByteStr += (parseInt(encoded[i], 10).toString(2)) + " ";
	}


	// FILL OUTPUTS IN FORM

	// direct char
	outChar.value = char;

	// UTF8 bytes
	// hexadecimal
	outUtf8.value = utf8ByteStr;
	outUtf8Esc.value = utf8ByteStrEsc;
	// octal
	outOctal.value = utf8OctByteStr;
	outOctalEsc.value = utf8OctByteStrEsc;

	// U+ code
	outCodePoint.value = 'U+' + (parseInt(charCodePoint, 10).toString(16)).toUpperCase();

	// XML decimal entity
	outXML10.value = '&#' + charCodePoint + ';';

	// URL encoding
	outURL.value = encodeURI(char);
	outAllURL.value = percentEnco;

	// UTF8 Binaire
	outBin.value = utf8BinByteStr;

	// Base 64
	outB64.value = window.btoa(unescape(encodeURIComponent(char)));

	// JSON
	outJSON.value = JSON.stringify(char);




}



inNode.addEventListener('input', convertAll);
document.getElementById('encode').addEventListener('click', convertAll);


</script>
<!--

# adresse de la page : https://lehollandaisvolant.net/tout/tools/charcode/
#      page créée le : 26 novembre 2018
#     mise à jour le : 25 février 2019

-->
</body>
</html>