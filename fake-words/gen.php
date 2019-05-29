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
		<textarea id="jsonout"></textarea>
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
	// the arrays is of dimension 3. It aims to find the probs of finding the 3rd letter having the the two first.
	probsMatrix.firstLetters = {l1: new Object(), l2: new Object()};
	probsMatrix.lastLetters = new Object(); //[alphabet[i]] = new Object(); // last letter (letter n)

	for (var len = alphabet.length, i=0 ; i < len ; i++) {
		probsMatrix[alphabet[i]] = new Object();
		probsMatrix.lastLetters[alphabet[i]] = new Object(); // last letter (letter n)
		for (var j=0 ; j < len ; j++) {
			probsMatrix.firstLetters.l1[alphabet[j]] = 0; // letter 1
			probsMatrix.firstLetters.l2[alphabet[j]] = new Object(); // letter 2

			probsMatrix[alphabet[i]][alphabet[j]] = new Object();

			probsMatrix.lastLetters[alphabet[i]][alphabet[j]] = 0; // letter n-1


			for (var k=0 ; k < len ; k++) {
				probsMatrix[alphabet[i]][alphabet[j]][alphabet[k]] = 0;
				probsMatrix.firstLetters.l2[alphabet[j]][alphabet[k]] = 0;
			}
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
						for (var k=0 ; k < len ; k++) {
							var letter3 = alphabet[k];
							var matches = occurrences(word, ""+letter+letter2+letter3);
							// add match count to matrix
							if (0!== matches) {
								probsMatrix[letter][letter2][letter3] += matches;
							}
						}
					}
				}
			}
		}
	}


	// for the first letter, the seconth, and the last letter
	for (var wordsCount = words.length, w=0 ; w < wordsCount ; w++) {
		var word = words[w];
		for (var len = alphabet.length, i=0 ; i < len ; i++) {
			var letter = alphabet[i];
			// determins probs of the "letter1" beeing first letter of word
			if (word.startsWith(letter)) {
				probsMatrix.firstLetters.l1[letter] += (1/wordsCount);
				// determins probs of the " letter1-letter2 " beginning the words
				for (var j=0 ; j < len ; j++) {
					var letter2 = alphabet[j];
					// checks the second letter also.
					if (word.startsWith(letter+letter2)) {
						probsMatrix.firstLetters.l2[letter][letter2] += 1;
					}
				}
			}

			// determins probs of the letter beeing n-1 letter of word, then counts the n-letter probability (where n is the last letter).
			if (letter == word.slice(-2, -1)) { // avant dernière lettre.
				for (var j=0 ; j < len ; j++) {
					var letter2 = alphabet[j]
					if (word.endsWith(letter2)) {
						probsMatrix.lastLetters[letter][letter2] += 1;
					}
				}				
			}
		}
	}

	// normalizes numbers in the [i][j][k] position, and in the firstletters.l2[i]
	for (var len = alphabet.length, i=0 ; i < len ; i++) {
		var sumL2 = 0, sumLn = 0;

		// for the main probabs
		for (var j=0 ; j<len ; j++) {
			// calculate sum off occurences
			var sum = 0;
			for (var k=0 ; k<len ; k++) {
				sum += probsMatrix[alphabet[i]][alphabet[j]][alphabet[k]];
			}
			// divides by the sum to get probabilities in range 0..1
			if (0 !== sum) {
				for (var k=0 ; k<len ; k++) {
					probsMatrix[alphabet[i]][alphabet[j]][alphabet[k]] /= sum;
				}
			}

			// for the L2 letters
			sumL2 += probsMatrix.firstLetters.l2[alphabet[i]][alphabet[j]]
			sumLn += probsMatrix.lastLetters[alphabet[i]][alphabet[j]];
		}

		// for the first letters
		if (0 !== sumL2) {
			for (var j=0 ; j<len ; j++) {
				probsMatrix.firstLetters.l2[alphabet[i]][alphabet[j]] /= sumL2;
			}
		}

		// for the last letters
		if (0 !== sumLn) {
			for (var j=0 ; j<len ; j++) {
				probsMatrix.lastLetters[alphabet[i]][alphabet[j]] /= sumLn;
			}
		}

	}

	// removes empty values (i.j.k == 0, for instance).
	// removes i.j.[k]
	for (var len = alphabet.length, i=0 ; i < len ; i++) {
		for (var j=0 ; j<len ; j++) {
			for (var k=0 ; k<len ; k++) {
				if (probsMatrix[alphabet[i]][alphabet[j]][alphabet[k]] === 0) {
					delete probsMatrix[alphabet[i]][alphabet[j]][alphabet[k]];
				}
			}
		}
 	}
	// removes i.[j]
	for (var len = alphabet.length, i=0 ; i < len ; i++) {
		for (var j=0 ; j<len ; j++) {
			if (probsMatrix[alphabet[i]][alphabet[j]] && Object.keys(probsMatrix[alphabet[i]][alphabet[j]]).length === 0) {
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


	
	document.getElementById('jsonout').value = JSON.stringify(probsMatrix);
	console.log(probsMatrix);
}



function inventWords() {
	var wordLength = Math.floor(Math.random() * 6) + 4  ;
	var word = ''

	// begin word with First letter.
	var firstLetter = weightedRand2(probsMatrix.firstLetters.l1);
	word += firstLetter;

	// continue with second letter
	// we do this because the chain is of length 3. So we manually pick 2 letters to begin
	var secondLeter = weightedRand2(probsMatrix.firstLetters.l2[firstLetter]);
	word += secondLeter;

	// we have our two letters to start with. Now use a loop to select more letters
	var letterNminus2 = firstLetter;
	var letterNminus1 = secondLeter;

	for (var i = 0 ; i < (wordLength-2) ; i++) {
		var nextLetter = weightedRand2(probsMatrix[letterNminus2][letterNminus1]);
		word += nextLetter;
		letterNminus2 = letterNminus1;
		letterNminus1 = nextLetter;
	}

	// last letter : check current letter and gives out the array of the last letters that follow current letter
	var lastLetters = probsMatrix.lastLetters[letterNminus1]
	word += weightedRand2(lastLetters);

	console.log(word);
}



</script>
<!--

# adresse de la page : http://lehollandaisvolant.net/tout/tools/fake-words
#      page créée le : 20 août 2018
#     mise à jour le : 20 août 2018

-->
</body>
</html>