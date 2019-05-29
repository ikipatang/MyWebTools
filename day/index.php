<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />

	<title>Quel jour était-il le… ? - le hollandais volant</title>

	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

.main-form {
	vertical-align: middle;
}

#date {
	text-align: center;
	font-size: 1.3em;
}
#date input {
	padding: 10px 0px;
	width: 5em;
	height: 2em;
	font-size: 1em;
}
#response {
	font-weight: bold;
	font-size: 130%;
}

p.right {
	text-align: right;
	padding-top: 1em;
}

	</style>
</head>
<body>

<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Quel jour était-il ?</a></p>
</header>

<section class="main-form">
	<form id="date">
		<p style="text-align: left;">Quel jour était-il le…</p>
		<p>
			<input type="number" min="1" max="31" onchange="getDayOfWeek();" class="text" value="01" placeholder="01" id="d" /> / 
			<input type="number" min="1" max="12" onchange="maxDay(); getDayOfWeek();" class="text" value="01" placeholder="01" id="m" /> / 
			<input type="number" mon="1" max="2999" onchange="maxDay(); getDayOfWeek();" class="text" value="2000" placeholder="2000" id="y" /> ?
		</p>
		<p class="right">Le <span id="strdate">1/1/2000</span> était un <span id="response">nd</span>.</p>
	</form>
</section>

<div class="notes centrer">
	<p></p>
</div>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script>
/* <![CDATA[ */
"use strict";

var input_d = document.getElementById('d');
var input_m = document.getElementById('m');
var input_y = document.getElementById('y');

function maxDay() {
	var D = input_d.value;
	var M = input_m.value;
	var Y = input_y.value;

	var d = new Date(Y, M, D);
	var lastd = new Date(Y, M, 0);
	lastd = lastd.getDate();
	console.log(lastd);
	document.getElementById("d").setAttribute('max', lastd);
	if (D > lastd) {
		input_d.value = lastd;
	}
}

function getDayOfWeek() {
	var dayOfWeek;
	var D = input_d.value;
	var M = input_m.value-1;
	var Y = input_y.value;

	var d = new Date(Y, M, D);
	switch (d.getDay()) {
		case 1: dayOfWeek = 'lundi'; break;
		case 2: dayOfWeek = 'mardi'; break;
		case 3: dayOfWeek = 'mercredi'; break;
		case 4: dayOfWeek = 'jeudi'; break;
		case 5: dayOfWeek = 'vendredi'; break;
		case 6: dayOfWeek = 'samedi'; break;
		case 0: dayOfWeek = 'dimanche'; break;
	}
	console.log(dayOfWeek);
	document.getElementById('response').innerHTML = dayOfWeek;
	document.getElementById('strdate').innerHTML = d.getDate().toString()+'/'+(d.getMonth()+1).toString()+'/'+d.getFullYear().toString();

}

getDayOfWeek();

/* ]]> */
</script>
<!--
# adresse de la page : http://lehollandaisvolant.net/tout/tools/day/
#      page créée le : 18 décembre 2014
#     mise à jour le : 18 décembre 2014
-->

</body>
</html>