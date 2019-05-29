<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Une script qui invente des mots d’une langue donnée." />
	<title>La machine à inventer des mots - le hollandais volant</title>
	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

#main-form {
	text-align: center;
	max-width: 1200px;
}

#output {
	margin: 50px 0px;
	border-top: 1px solid silver;
	padding: 40px 0 0;
	display: flex;
	/*justify-content: space-evenly;*/
	flex-wrap: wrap;
}

#output span {
	padding: 5px 10px;
	margin: 7px;
	border: 1px solid silver;
	border-radius: 5px;
	background: transparent;
	flex: 1 0 auto;
}

#output span[class] {
	animation: 8s fade;
}

@keyframes fade {
	0% {
		background-color: lightblue;
	}
	50% {
		background-color: lightblue;
	}
	100% {
		background-color: transparent;
	}
}

select {
	padding: 5px;
}

button {
	padding: 5px;
	font-weight: bold;
}

	</style>
</head>
<body>
<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">La machine à inventer des mots</a></p>
</header>

<section id="main-form" class="main-form">
	<p>
		<select id="selectLanguage" onchange="downloadTable(this.value);">
			<option value="al">Albanais</option>
			<option value="de">Allemand</option>
			<option value="en">Anglais</option>
			<option value="dk">Danois</option>
			<option value="es">Espagnol</option>			
			<option value="fr" selected="selected">Français</option>
			<option value="el">Grec</option>
			<option value="is">Islandais</option>
			<option value="it">Italien</option>
			<option value="lv">Letton</option>
			<option value="nl">Néerlandais</option>
			<option value="no">Norvégien</option>
			<option value="pl">Polonais</option>
			<option value="pt">Portugais</option>
			<option value="sk">Slovaque</option>
			<option value="se">Suédois</option>
			<option value="uk">Ukrainien</option>
			<!--<option value="cz">Tchèque</option>-->
		</select>

		<select id="selectWordsize">
			<option value="1">1 mot</option>
			<option value="5">5 mots</option>
			<option value="10" selected="selected">10 mots</option>
			<option value="50">50 mots</option>
			<option value="100">100 mots</option>
			<option value="500">500 mots</option>
		</select>

		<button id="result" onclick="inventWords()">Inventer des mots</button>
	</p>
	<div id="output"></div>
	<div class="notes">
		<p>D’après une idée de <a href="https://sciencetonnante.wordpress.com/2015/11/06/la-machine-a-inventer-des-mots-version-ikea/">David Louapre</a>.</p>
		<p>Merci aussi à <a href="http://justclick.re/">Totoyo</a>, pour l’accès au code de <a href="http://justclick.re/generateur.php">son générateur</a>.</p>
		<p>Cette page utilise les <a href="https://cgit.freedesktop.org/libreoffice/dictionaries/tree/">dictionnaires Hunspell</a>.</p>
	</div>

</section>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script>

// TODO : add the .alphabet to the JSON
// TODO : add .language to the JSON
// TODO : add .nbWords to the JSON


'use strict'
/*
	This page only generates words having a table of letter probabilities.
	That table is produced by another script (also in JavaScript).

	Producing that table demands huge CPU ressources and a dictionnary
	 of ~ 100 000 words in a given language. This is why my script
	 produced the tables of letter probabilities and saved them for
	 direct use, instead of having to rebuilt the table every time.

	Each language demands a specific table. So when you choose a language,
	 the corresponding language table is downloaded.

	Having the table of probabilities, this script only needs to generate
	 words, taking in account the probabilities of each letter following
	 each other, until a given length is reached.

	This script, however, goes a bit further, in order to create more
	 realistic words.
	First, words begin with a first-letter. The table contains a
	 probability for "first-letter", since this letter is not following
	 any other.
	Second, since two identical letters can follow each other, this
	 can’t be the case for the begining of a word. Again, the second 
	 letter is manually chosen from a specific line in the table.
	 After the 2nd letter, the word is generated only with probabilies:
	 a letter is determined having the two previous letters.
	Trird, and last, the ending of a word is specifically choosen also,
	 so that the word does not end too oddly. It is choosen on
	 probabilities of a letter to be that last letter chan the previous
	 chosen letter was the letter before the last one.

	Some words might still get a bit odd (that’s somehow the purpose),
	 but with those adjustements, they are much more realistic.

*/

// init the table.
// this will be filled with the data chosed from list, downloaded, unzipped, and parsed for JSON.
var probsMatrix = new Object();

function downloadTable(language) {
	document.getElementById('result').disabled = true;
	var tableURL = 'DICS/' + language + '_table.json'; //?rand=' + Math.random();
	var xhr = new XMLHttpRequest();

	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			probsMatrix = JSON.parse(this.responseText);
			document.getElementById('result').disabled = false;

		}
	};
	xhr.open("GET", tableURL, true);
	xhr.send();
}

// default language : french.
downloadTable('fr');

console.log(probsMatrix);

// the HTML nodes
var outputNode = document.getElementById('output');

// this is used to choose a letter based on the probability this letter has to be chosen.
// the "arr" is an object : {a: 0.05, b: 0.45, c: 0, d: ...}
// it returns the letter it has selected
function weightedRand2(arr) {
	var sum = 0, r = Math.random();
	for (var i in arr) {
		sum += parseFloat(arr[i]);
		if (r <= sum) {
			//console.log(sum);
			return i;
		}
	}
	// in some rare cases, no letter gets selected. If so, goes again for one round.
	// JavaScript has a built in "too many recursion" limit. So, this is dirty, but whatever.
	weightedRand2(arr);
}


// this function builts a word, choosing a first, a second letter,
// then all the others, and finally a last one.
function inventWords() {
	// how much words
	var nb = document.getElementById('selectWordsize').value || 10;
	for (var n=1 ; n<=nb ; n++) {

		// randomize word length.
		// TODO : analyse length of real words and choose a realistic length.
		var wordLength = Math.floor(Math.random() * 6) + 4;
		var word = ''

		// begin word with First letter.
		var firstLetter = weightedRand2(probsMatrix.firstLetters.l1);
		word += firstLetter;

		// continue with second letter
		// we do this because the chain is of length 3. So we manually pick 2 letters to begin
		var secondLetter = weightedRand2(probsMatrix.firstLetters.l2[firstLetter]);
		word += secondLetter;

		// we have our two letters to start with. Now use a loop to select more letters
		var letterNminus2 = firstLetter;
		var letterNminus1 = secondLetter;

		for (var i = 0 ; i < (wordLength-2) ; i++) {
			var nextLetter = weightedRand2(probsMatrix[letterNminus2][letterNminus1]);
			word += nextLetter;
			letterNminus2 = letterNminus1;
			letterNminus1 = nextLetter;
		}

		// last letter : check current letter and gives out the array of the last letters that follow current letter
		var lastLetters = probsMatrix.lastLetters[letterNminus1]
		word += weightedRand2(lastLetters);

		// displays the word.
		var spanNode = document.createElement('span');
		spanNode.appendChild(document.createTextNode( word ));
		outputNode.insertBefore(spanNode, outputNode.firstChild)
		spanNode.classList.add(document.getElementById('selectLanguage').value);

		//console.log(lastLet);
	}
}


</script>
<!--

# adresse de la page : http://lehollandaisvolant.net/tout/tools/fake-words
#      page créée le : 20 août 2018
#     mise à jour le : 24 août 2018

-->
</body>
</html>
