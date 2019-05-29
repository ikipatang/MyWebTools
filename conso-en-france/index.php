<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Production électrique en temps réel en France." />

	<title>Production électrique en temps réel en France - le hollandais volant</title>

	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

.main-form {
	vertical-align: middle;
}

#prodtotal {
	font-size: 3em;
	text-align: center;
}

.box {
	border-radius: 2px;
	background: #fefefe;
	max-width: 500px;
	margin: 20px auto;
	box-sizing: border-box;
	box-shadow: 1px 1px 3px 1px silver;
}

.box p {
	margin: 5px;
	font-size: 1.2em;
}

.box.sources {
	display: flex;
	flex-wrap: wrap;
	justify-content: space-evenly;
	padding: 20px 0;
	text-align: center;
}

.box.total,
.box.divers {
	padding: 20px;
}

.box.sources > p {
	margin: 0;
	box-sizing: border-box;
	width: 40%;
	padding: 60px 10px 10px;
	margin-bottom: 5px;
	font-size: 1.1em;
	background: center 10px no-repeat;
	background-size: 48px 48px;
}

#nucl { background-image: url(icones/nucl.jpg); }
#hydr { background-image: url(icones/hydr.jpg); }
#sola { background-image: url(icones/sola.jpg); }
#eoli { background-image: url(icones/eoli.jpg); }
#char { background-image: url(icones/char.jpg); }
#gazz { background-image: url(icones/gazz.jpg); }
#fiou { background-image: url(icones/fiou.jpg); }
#dive { background-image: url(icones/dive.jpg); }



	</style>
</head>
<body>
<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Production électrique en temps réel en France</a></p>
</header>


<section class="main-form">
<div class="box total">
	<p id="prodtotaldate">La production à ——:—— est de :</p>
	<p id="prodtotal">––––– MW</p>
</div>

<div class="box sources">
	<p id="nucl"><span>–––––</span> MW<br/>Nucléaire</p>
	<p id="hydr"><span>–––––</span> MW<br/>Hydraulique</p>
	<p id="sola"><span>–––––</span> MW<br/>Solaire</p>
	<p id="eoli"><span>–––––</span> MW<br/>Eolien</p>
	<p id="char"><span>–––––</span> MW<br/>Charbon</p>
	<p id="gazz"><span>–––––</span> MW<br/>Gaz</p>
	<p id="fiou"><span>–––––</span> MW<br/>Fioul</p>
	<p id="dive"><span>–––––</span> MW<br/>Bioénergies</p>
</div>

<div class="box divers">
	<p>Import/Export : <span id="exportation">–––––</span> MW</p>
	<p>Pompage hydraulique : <span id="pompage">–––––</span> MW</p>
</div>

<div class="notes">
	<p>Données en provenance et propriété de RTE-France, utilisées sous l’application de leur <a href="https://www.rte-france.com/fr/mentions-legales">mentions légales</a>.</p>
	<p>Icônes de <a href="https://www.freepik.com/free-photos-vectors/sun">Macrovector</a> &amp; <a href="https://www.freepik.com/free-photos-vectors/icon">Angbay</a></p>
</div>

</section>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>


<script>
/* <![CDATA[ */
"use strict";

function objectFilter(obj, filter) {
	for (var i=0, len = obj.length ; i<len ; i++) {
		if (obj[i].type == filter) {
			return obj[i].prod;
		}
	}
	return 'N/A';
}

function fillData() {

	var total = document.getElementById('prodtotal');
	total.removeChild(total.childNodes[0])

	total.appendChild(document.createTextNode(donnees.total + ' MW'));

	var totaldate = document.getElementById('prodtotaldate');
	totaldate.removeChild(totaldate.childNodes[0])
	totaldate.appendChild(document.createTextNode('La Production à '+(donnees.date).slice(-8, -3) + ' est de :'));



	var totaldate = document.getElementById('prodtotaldate');

	var nucl = document.querySelector('#nucl > span');
		nucl.removeChild(nucl.childNodes[0]);
		nucl.appendChild(document.createTextNode(objectFilter(donnees.sources, 'Nucléaire')));
	var hydr = document.querySelector('#hydr > span');
		hydr.removeChild(hydr.childNodes[0]);
		hydr.appendChild(document.createTextNode(objectFilter(donnees.sources, 'Hydraulique')));
	var sola = document.querySelector('#sola > span');
		sola.removeChild(sola.childNodes[0]);
		sola.appendChild(document.createTextNode(objectFilter(donnees.sources, 'Solaire')));
	var eoli = document.querySelector('#eoli > span');
		eoli.removeChild(eoli.childNodes[0]);
		eoli.appendChild(document.createTextNode(objectFilter(donnees.sources, 'Eolien')));
	var char = document.querySelector('#char > span');
		char.removeChild(char.childNodes[0]);
		char.appendChild(document.createTextNode(objectFilter(donnees.sources, 'Charbon')));
	var gazz = document.querySelector('#gazz > span');
		gazz.removeChild(gazz.childNodes[0]);
		gazz.appendChild(document.createTextNode(objectFilter(donnees.sources, 'Gaz')));
	var fiou = document.querySelector('#fiou > span');
		fiou.removeChild(fiou.childNodes[0]);
		fiou.appendChild(document.createTextNode(objectFilter(donnees.sources, 'Fioul')));
	var dive = document.querySelector('#dive > span');
		dive.removeChild(dive.childNodes[0]);
		dive.appendChild(document.createTextNode(objectFilter(donnees.sources, 'Autres')));


	var exportation = document.getElementById('exportation');
		exportation.removeChild(exportation.childNodes[0]);
		exportation.appendChild(document.createTextNode(objectFilter(donnees.sources, 'Solde')));
	var pompage = document.getElementById('pompage');
		pompage.removeChild(pompage.childNodes[0]);
		pompage.appendChild(document.createTextNode(objectFilter(donnees.sources, 'Pompage')));

}

// creating date string
var d = new Date();
var formatDate = ('0' + (d.getDate())).slice(-2) + '/' + ('0' + (d.getMonth()+1)).slice(-2) + '/' + d.getFullYear();

// forging URL @ RTE
var urlLocal = 'xhr.php?date=' + formatDate;

// retreiving data with XHR
var donnees = '';

var xhr = new XMLHttpRequest();
xhr.open('GET', urlLocal, true);



xhr.onload = function() {
	var responseJSON = this.responseText;
	donnees = JSON.parse(responseJSON);

	fillData();

};
xhr.send();




/* ]]> */
</script>

<!--
# adresse de la page : https://lehollandaisvolant.net/tout/tools/conso-en-france/
#      page créée le : 10 juin 2018
#     mise à jour le : 10 juin 2018
-->

</body>
</html>
