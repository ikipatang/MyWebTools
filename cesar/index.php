<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Effectuer un chiffrement de César ou Vigenère." />

	<title>Effectuer un chiffrement de César ou Vigenère - le hollandais volant</title>

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
	margin: 5px 0;
}

.buttons {
	margin: 50px 0;
	text-align: center;
}

#forKeyVigenere {
	display: none;
}

	</style>
</head>
<body>

<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Chiffrement de César</a></p>
</header>

<section id="main-form" class="main-form">

	<p>
		<label for="key">Chiffrement :</label> 
		<select id="ciphertype">
			<option value="cesar" selected>de César</option>
			<option value="vigenere">de Vigenère</option>
		</select>
	</p>


	<label for="input-text">Entrez votre texte :</label> 
	<textarea name="input-text" id="input-text" rows="7" cols="40" placeholder="Placez votre texte ici" class="centrer"></textarea>
	<p id="forKeyCesar">
		<label for="keyCesar">Choisissez une clé (décallage) :</label> 
		<select id="keyCesar">
			<option value="A" selected>A</option>
			<option value="B">B</option>
			<option value="C">C</option>
			<option value="D">D</option>
			<option value="E">E</option>
			<option value="F">F</option>
			<option value="G">G</option>
			<option value="H">H</option>
			<option value="I">I</option>
			<option value="J">J</option>
			<option value="K">K</option>
			<option value="L">L</option>
			<option value="M">M</option>
			<option value="N">N</option>
			<option value="O">O</option>
			<option value="P">P</option>
			<option value="Q">Q</option>
			<option value="R">R</option>
			<option value="S">S</option>
			<option value="T">T</option>
			<option value="U">U</option>
			<option value="V">V</option>
			<option value="W">W</option>
			<option value="X">X</option>
			<option value="Y">Y</option>
			<option value="Z">Z</option>
		</select>
	</p>
	<p id="forKeyVigenere">
		<label for="keyVigenere">Choisissez une clé :</label>
		<input id="keyVigenere" type="text" value="CLE" required onchange="this.value = this.value.toUpperCase()" />
	</p>


	<p class="buttons"><button id="encode-text" class="button button-submit">Encoder (+)</button> <button id="decode-text" class="button button-submit">Décoder (−)</button></p>

	<label for="output">Le résultat :</label> 
	<textarea id="output" rows="8" cols="50" placeholder="Le résultat sera ici" readonly class="centrer"></textarea>


<div class="notes centrer">
	<p>Le chiffrement de César ou de Vigenère est amusant mais facile à décrypter.</p>
	<p>Les caractères non-alphabétiques ou accentués sont ignorés.</p>
</div>

</section>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script>
'use strict'

function getKey() {
	if (document.getElementById('ciphertype').value == 'cesar') {
		var key = document.getElementById('keyCesar').value;
	} else {
		var key = document.getElementById('keyVigenere').value;
	}
	return key;
}

function cesarCipher(text, key, direction) {
	var output = "";

	for (var i=0, len=text.length; i<len; i++) {
		// for Vigenere, the current "key" is at the $i position in the $key string
		var k = key.charAt((i%key.length));
		// direction : 1=encoding ; -1=decoding
		if (direction == 1) {
			var shift = (k.charCodeAt(0) - 65);
		} else {
			var shift = 26 - (k.charCodeAt(0) - 65);
		}

		// for char $i
		var c = text.charCodeAt(i);

		// if uppercase (between A and Z)
		if (c >= 65 && c <=  90) {
			output += String.fromCharCode((c - 65 + shift) % 26 + 65);
		}
		// for lowercase (between a and z)
		else if (c >= 97 && c <= 122) {
			output += String.fromCharCode((c - 97 + shift) % 26 + 97);
		}
		// anything that is not alphabetic
		else {
			output += text.charAt(i); // ignore
		}
	}
	return output;
}

// ENCODE
document.getElementById('encode-text').addEventListener('click', function() {
	var inputText = document.getElementById('input-text').value;
	document.getElementById('output').value = cesarCipher(inputText, getKey(), +1);
});
// reencode if key is changed
document.getElementById('keyCesar').addEventListener('change', function() {
	var inputText = document.getElementById('input-text').value;
	document.getElementById('output').value = cesarCipher(inputText, getKey(), +1);
});
document.getElementById('keyVigenere').addEventListener('change', function() {
	var inputText = document.getElementById('input-text').value;
	document.getElementById('output').value = cesarCipher(inputText, getKey(), +1);
});

// DECODE
document.getElementById('decode-text').addEventListener('click', function() {
	var inputText = document.getElementById('input-text').value;
	document.getElementById('output').value = cesarCipher(inputText, getKey(), -1);
});

// CHANGE CIPHER TYPE
document.getElementById('ciphertype').addEventListener('change', function() {
	if (this.value == 'vigenere') {
		document.getElementById('forKeyVigenere').style.display = 'block';
		document.getElementById('forKeyCesar').style.display = 'none';
	} else {
		document.getElementById('forKeyVigenere').style.display = 'none';
		document.getElementById('forKeyCesar').style.display = 'block';

	}

});
</script>
<!--

# adresse de la page : https://lehollandaisvolant.net/tout/tools/cesar/
#      page créée le : 25 novembre 2018
#     mise à jour le : 25 novembre 2018

-->
</body>
</html>