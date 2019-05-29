<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Page pour convertir des unités" />

	<title>Convertisseurs d’unités - le hollandais volant</title>

	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

.main-form {
	vertical-align: middle;
}

.oneline {
	display: block;
	text-align: right;
	margin: 15px auto;
	width: 100%;
	background-color: #eee;
	border-radius: 5px;
	padding: 0;
	border: 1px solid silver;
}

#type,
#in-value,
#out-value {
	font-size: 100%;
	border: 1px solid silver;
	background: white;
	padding: 5px;
	box-sizing: border-box;
}

#in-params,
#out-params {
	box-sizing: border-box;
	display: flex;
}


#in-params select,
#out-params select{
	box-sizing: border-box;
	border: none;
	border-left: 1px solid silver;
	background: #fff;
	padding: 5px;
	width: 44%;
	vertical-align: middle;
	flex: 1 1 auto;
}

#in-params label,
#out-params label {
	box-sizing: border-box;
	margin: 0;
	text-align: right;
	display: inline-block;
	vertical-align: middle;
	padding: 5px;
	flex: 0 0 3em;
}

#out-value {
	font-size: 180%;
	border: 1px solid silver;
	border-radius: 4px;
	line-height: 1.8em;
	vertical-align: middle;
	height: 2em;
	padding: 5px 10px;
	text-align: right;
	position: relative;
	box-shadow: 0 0 3px silver inset;

}

#out-value::before {
	content: "=";
	position: absolute;
	left: 10px;
	font-style: italic;
	color: silver;
}

p.oneline input {
	width: 100%;
}

#p-convert  {
	text-align: right;
	padding: 10px 0 20px;
}

	</style>
</head>
<body>


<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Convertisseur d’unités</a></p>
</header>

<section class="main-form">

	<p>La grandeur est :</p>
	<select class="oneline" id="type" onchange="genform();calc();">
		<option value="distance" selected="selected">une distance</option>
		<option value="surface">une surface</option>
		<option value="volume">un volume</option>
		<option value="temps">une durée</option>
		<option value="vitesse">une vitesse</option>
		<option value="energie">une énergie</option>
		<option value="masse">une masse</option>
		<option value="pression">une pression</option>
		<option value="puissance">une puissance</option>
		<option value="angle">un angle</option>
	</select>

	<p class="oneline" id="in-params">
		<label for="in-prefix">De :</label>
		<select id="in-prefix" onchange="calc();">
			<option value="-12">pico</option>
			<option value="-9">nano</option>
			<option value="-6">micro</option>
			<option value="-3">milli</option>
			<option value="-2">centi</option>
			<option value="-1">déci</option>
			<option value="0" selected="selected"></option>
			<option value="1">déca</option>
			<option value="2">hecto</option>
			<option value="3">kilo</option>
			<option value="6">méga</option>
			<option value="9">giga</option>
			<option value="12">tera</option>
		</select><select id="in-unite" onchange="calc();"></select>
	</p>

	<p class="oneline" id="out-params">
		<label for="out-prefix">À :</label>
		<select id="out-prefix" onchange="calc();">
			<option value="-12">pico</option>
			<option value="-9">nano</option>
			<option value="-6">micro</option>
			<option value="-3">milli</option>
			<option value="-2">centi</option>
			<option value="-1">déci</option>
			<option value="0" selected="selected"></option>
			<option value="1">déca</option>
			<option value="2">hecto</option>
			<option value="3">kilo</option>
			<option value="6">méga</option>
			<option value="9">giga</option>
			<option value="12">tera</option>
		</select><select id="out-unite" onchange="calc();"></select>
	</p>

	<p>Je veux convertir :</p>
	<input class="oneline" type="text" id="in-value" value="1" onchange="calc();" />

	<p id="p-convert"><button type="button" class="button button-submit" onclick="calc();">Convertir</button></p>

	<p>Résultat :</p>
	<p class="oneline"><input type="text" id="out-value" readonly /></p>
</section>

<footer id="footer"><a href="/">by <em>Timo Van Neerden</em></a></footer>

<script>
"use strict";

var distArr = new Array(['metre', 1], ['pied', 0.3048], ['pouce', 0.0254], ['angström', 10e-10], ['mille', 1609], ['mille nautique', 1853], ['yard', 0.9144], ['lieue', 4828.032], ['unité astronomique', 149597870700], ['année-lumière', 9460730472580800], ['parsec', 30856775814672e3]);
var timeArr = new Array(['seconde', 1], ['minute', 60], ['heure', 3600], ['jour', 86400]);
var enerArr = new Array(['joule', 1], ['calorie', 4.1855], ['electron-volt', 1.60217e-19], ['watt-heure', 3600], ['BTU (I.T.)', 1055.055], ['TEP', 41.868e9]);
var massArr = new Array(['gramme', 1e-3], ['kilogramme', 1], ['tonne', 1000], ['livre', 0.45359], ['once', 0.028349], ['carat', 0.0002]);
var presArr = new Array(['pascal', 1], ['bar', 100000], ['kg/cm²', 98066.5], ['P.S.I.', 6894.75728], ['atmosphère', 101325], ['inHg', 3376.85], ['mmHg', 133.3]);
var voluArr = new Array(['m³', 1], ['dm³', 0.001], ['cm³', 1e-6], ['mm³', 1e-9], ['litre', 0.001], ['tasse', 0.00023658], ['once liquide US', 0.0000295735295625],  ['gallon US', 0.003785411784]);
var viteArr = new Array(['m/s', 1], ['km/h', 1/3.6], ['mach', 340], ['nœuds', 0.514],  ['milles/h', 1609/3600], ['c', 299792458]);
var puisArr = new Array(['Watt', 1], ['Cheval Vapeur', 736], ['J/s', 1]);
var surfArr = new Array(['km²', 1e6], ['m²', 1], ['cm²', 1e-4], ['mm²', 1e-6], ['hectare', 1e4], ['acre', 4046.856422], ['sq inch', 0.00064516], ['sq feet', 10.76391041671], ['sq yard', 1.195990046301], ['sq miles', 2589988.110336]);
var anglArr = new Array(['radian', 1], ['degré', 0.017453293], ['grade', 0.015707963], ['minute d’arc', 0.000290888], ['seconde d’arc', 0.0000048482]);

// À partir du type d’unité choisi (longueurs, temps, masse…)
// Remplit les listes déroulantes avec les unités

// le traitement HTML de genForm
function fillSelect(arr) {
	var inUnit = document.getElementById('in-unite');
	var outUnit = document.getElementById('out-unite');
	inUnit.innerHTML = '';
	outUnit.innerHTML = '';
	for (var i=0, len = arr.length ; i < len ; i++) {
		var option = document.createElement('option');
		option.innerHTML = arr[i][0];
		option.value = arr[i][1];
		inUnit.appendChild(option);
		outUnit.appendChild(option.cloneNode(true));
	}

}

function genform() {
	// selon le type, change les unités
	switch (document.getElementById('type').value) {
		case 'distance':
			fillSelect(distArr); break;
		case 'temps':
			fillSelect(timeArr); break;
		case 'energie':
			fillSelect(enerArr); break;
		case 'masse':
			fillSelect(massArr); break;
		case 'pression':
			fillSelect(presArr); break;
		case 'volume':
			fillSelect(voluArr); break;
		case 'vitesse':
			fillSelect(viteArr); break;
		case 'puissance':
			fillSelect(puisArr); break;
		case 'surface':
			fillSelect(surfArr); break;
		case 'angle':
			fillSelect(anglArr); break;
		default:
			break;
	}
}

function calc() {
	var inValue = document.getElementById('in-value').value.replace(/,/g, '.');
	var inFactor = document.getElementById('in-unite').value;
	var inPrefixFactor = document.getElementById('in-prefix').value;
	var outFactor = document.getElementById('out-unite').value;
	var outPrefixFactor = document.getElementById('out-prefix').value;

	if (isNaN(parseFloat(inValue))) {
		var output = 'Erreur';
	}
	else {
		var output = inValue * inFactor * Math.pow(10, inPrefixFactor) / outFactor / Math.pow(10, outPrefixFactor);
	}

	if (String(output).match(/\./g)) {
		output = output.toPrecision(5);
		output = parseFloat(output).toExponential(5);
	}

	output = parseFloat(output);	
	document.getElementById('out-value').value = String(output).replace(/\./g, ',');

}


(function(){
	genform();
})();

</script>
<!--
# adresse de la page : https://lehollandaisvolant.net/tout/tools/unites/
#      page créée le : 23 août 2014
#     mise à jour le : 14 novembre 2018
-->
</body>
</html>