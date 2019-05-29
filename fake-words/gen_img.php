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
	max-width: none;
}

table {
	margin: 0 auto;
	border-collapse: collapse;
}

td {
	width: 20px;
	height: 20px;
	background: red;
	border: none;
	filter: contrast(0%);
	font-size: 10px;
}

table tr:first-of-type > td,
table tr > td:first-of-type {
	filter: initial;
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
		<p><input type="file" name="file" id="file" /></p>
		<p><button id="result" onclick="populateTable()" class="centrer">Calculer la table des probabilités</button></p>
		<table id="tableout"></table>
		<p><button id="result" onclick="inventWords()" class="centrer">Inventer des mots</button></p>
		<div class="notes">
			<p>D’après une idée de <a href="https://sciencetonnante.wordpress.com/2015/11/06/la-machine-a-inventer-des-mots-version-ikea/">David Louapre</a></p>
		</div>

</section>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script>
'use strict'

// grep the words
var words = new Array();
// latin
var alphabet = 'abcdefghijklmnopqrstuvwxyzðỳýéàáâçèêäëûôōòóõøöåůïĩíìîæœþůúùüñşščžťľßăńřćãāśňĐďĺŕěũũųėģķīąņŗļęŋŧ'.split('');
// cyrillic
// var alphabet = 'абвгдеёжзийклмнопрстуфхцчшщъыьэюяієїґ'.split('');
// greek
// var alphabet = 'αβγδεζηθικλμνξοπρστυφχψωάϊόέήίώύΰΐϋ'.split('');

console.log(alphabet)
var probsMatrix = new Object();


// filereader : reads a dictionnary of Words and put then in an array.
document.getElementById('file').onchange = function(){
	words = new Array();
	var file = this.files[0];
	var reader = new FileReader();
	reader.onload = function(progressEvent){
	// By lines
	var lines = this.result.split('\n');
	for(var line = 0; line < lines.length; line++){
		words.push((lines[line]).toLowerCase());
	}
	//populateTable();
	};
	reader.readAsText(file);
};


// This functions counts the nb of occurences of "subString" in "string".
// It if much, much faster than RegExp(string, subString, 'gi').
function occurrences(string, subString) {
    string += "";
    subString += "";
    if (subString.length <= 0) return (string.length + 1);

    var n = 0,
        pos = 0,
        step = 1; //subString.length;

    while (true) {
        pos = string.indexOf(subString, pos);
        if (pos >= 0) {
            ++n;
            pos += step;
        } else break;
    }
    return n;
}


// this allows us to choose a letter based on the probability this letter needs to be chosen.
// the "arr" is an object : {a: 0.05, b: 0.45, c: 0, d: ...}
// it returns the letter it has selected
function weightedRand2(arr) {
	var sum = 0, r = Math.random();
	for (var i in arr) {
		sum += parseFloat(arr[i]);
		if (r <= sum) return i;
	}
}


/*
	parse the words.
*/
// for each letter, determines the probability of a sequense of two letters beeing followed by any other.
// the result is put in an object table with probabilities.
function populateTable() {

	// inits the array of probabilities.
	// the arrays is of dimension 2. It aims to find the probs of finding the 2nd letter having the first one

	for (var len = alphabet.length, i=0 ; i < len ; i++) {
		probsMatrix[alphabet[i]] = new Object();
		for (var j=0 ; j < len ; j++) {
			probsMatrix[alphabet[i]][alphabet[j]] = 0;
		}
	}


	// parse the words.
	for (var wordsCount = words.length, w=0 ; w < wordsCount ; w++) {
		var word = words[w];

		// creates the table
		for (var len = alphabet.length, i=0 ; i < len ; i++) {
			var letter = alphabet[i];
			// if letter in word
			if (0 <= word.indexOf(letter)) {
				for (var j=0 ; j < len ; j++) {
					var letter2 = alphabet[j];
					if (0 <= word.indexOf(letter+letter2)) {
						var matches = occurrences(word, ""+letter+letter2);
						// add match count to matrix
						if (0!== matches) {
							probsMatrix[letter][letter2] += matches;
						}
					}
				}
			}
		}
	}

	// normalizes numbers in the [i][j] position
	for (var len = alphabet.length, i=0 ; i < len ; i++) {
		var sumL2 = 0, sumLn = 0;
		var sum = 0;

		// for the main probabs
		for (var j=0 ; j<len ; j++) {
			// calculate sum of occurences
			sum += probsMatrix[alphabet[i]][alphabet[j]];
		}
		for (var j=0 ; j<len ; j++) {
			// divides by the sum to get probabilities in range 0..1
			if (0 !== sum) {
				probsMatrix[alphabet[i]][alphabet[j]] /= sum;
			}
		}
	}




	// removes empty values (i.j == 0, for instance).
	// removes i.[j]
	for (var len = alphabet.length, i=0 ; i < len ; i++) {
		for (var j=0 ; j<len ; j++) {
			if (probsMatrix[alphabet[i]][alphabet[j]] === 0) {
				delete probsMatrix[alphabet[i]][alphabet[j]];
			}
		}
 	}
 	// removes [i]
	for (var len = alphabet.length, i=0 ; i < len ; i++) {
		if (probsMatrix[alphabet[i]] && Object.keys(probsMatrix[alphabet[i]]).length === 0) {
			delete probsMatrix[alphabet[i]];
		}
 	}

	console.log(probsMatrix);





	var table = document.getElementById('tableout');
	var row = table.insertRow(-1);
	var cell = row.insertCell(-1);
	var keys = Object.keys(probsMatrix);
	for (var len = keys.length, i=0; i < len ; i++) {
		var cell = row.insertCell(-1);
		cell.textContent = keys[i];
	}		


	for (var len = keys.length, i=0 ; i < len ; i++) {
		var row = table.insertRow(-1);
		var cell = row.insertCell(-1);
		cell.textContent = keys[i];

		for (var j=0 ; j < len ; j++) {
			var cell = row.insertCell(-1);
			cell.style.filter = 'contrast(' + probsMatrix[keys[i]][keys[j]]*200 + '%)';
		}		
	}




}




















</script>
<!--

# adresse de la page : http://lehollandaisvolant.net/tout/tools/fake-words
#      page créée le : 20 août 2018
#     mise à jour le : 20 août 2018

-->
</body>
</html>