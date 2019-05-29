<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="additionner, soustraire des heures et des dates" />
	<title>Effectuer des opérations sur des dates et des heures - le hollandais volant</title>
	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

.main-form {
	padding: 20px;
	margin: 20px auto;
}

.main-form h2 {
	margin-bottom: 20px;
}

.main-form .text {
	width: 40px;
}

.main-form p.centrer {
	margin: 10px auto;
}

.main-form .longtext {
	width: 200px;
	text-align: right;
}
.main-form .fl {
	display: inline-block;
	width: 110px;
	text-align: left;
}

.main-form #i-y, .main-form #f-y {
	width: 60px;
}


.main-form .submit-centrer.blue {
	border: solid 1px #0098FF;
	background: #0098FF;
}

.main-form .submit-centrer.blue:active {
	color: #ddddff;
	background: #0098FF;
}

.main-form .submit-centrer.green {
	border: solid 1px #00B313;
	background: #44D230;
}

.main-form .submit-centrer.green:active {
	color: #ddddff;
	background: #00B313;
}

.result {
	font-size: 100%;
	font-weight: bold;
}

input:invalid {
  background-color: #ffdddd;
}

.c_result {
	width: 160px;
	display: inline-block;
	text-align: right;
}
.label {
	display: inline-block;
	width: 100px;
	text-align: left;
}

	</style>
</head>
<body>

<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Effectuer des opérations sur des dates et des heures</a></p>
</header>

<section class="main-form">
	<h2>Calculer la différence entre deux dates&nbsp;:</h2>
	<p class="centrer">
		<label for="i-y">Date 1&nbsp;: </label> 
		<input type="number" onkeyup="return calc_dates('diff');" step="1" min="00" max="9999" id="i-y" value="<?php echo date('Y') ?>" name="i-y" placeholder="<?php echo date('Y') ?>" class="text" required /> /
		<input type="number" onkeyup="return calc_dates('diff');" step="1" min="01" max="12" id="i-m" value="<?php echo date('m') ?>" name="i-m" placeholder="<?php echo date('m') ?>" class="text" required /> /
		<input type="number" onkeyup="return calc_dates('diff');" step="1" min="01" max="31" id="i-d" value="<?php echo date('d') ?>" name="i-d" placeholder="<?php echo date('d') ?>" class="text" required /> à
		<input type="number" onkeyup="return calc_dates('diff');" step="1" min="00" max="23" id="i-h" value="<?php echo date('H') ?>" name="i-h" placeholder="<?php echo date('H') ?>" class="text" required />:
		<input type="number" onkeyup="return calc_dates('diff');" step="1" min="00" max="59" id="i-i" value="<?php echo date('i') ?>" name="i-i" placeholder="<?php echo date('i') ?>" class="text" required />:
		<input type="number" onkeyup="return calc_dates('diff');" step="1" min="00" max="59" id="i-s" value="<?php echo date('s') ?>" name="i-s" placeholder="<?php echo date('S') ?>" class="text" required />
	</p>

	<p class="centrer">
		<label for="f-y">Date 2&nbsp;: </label> 
		<input type="number" onkeyup="return calc_dates('diff');" step="1" min="00" max="9999" id="f-y" value="2000" name="f-y" placeholder="2000" class="text" required /> /
		<input type="number" onkeyup="return calc_dates('diff');" step="1" min="01" max="12" id="f-m" value="01" name="f-m" placeholder="01" class="text" required /> /
		<input type="number" onkeyup="return calc_dates('diff');" step="1" min="01" max="31" id="f-d" value="03" name="f-d" placeholder="03" class="text" required /> à
		<input type="number" onkeyup="return calc_dates('diff');" step="1" min="00" max="23" id="f-h" value="09" name="f-h" placeholder="09" class="text" required />:
		<input type="number" onkeyup="return calc_dates('diff');" step="1" min="00" max="59" id="f-i" value="46" name="f-i" placeholder="46" class="text" required />:
		<input type="number" onkeyup="return calc_dates('diff');" step="1" min="00" max="59" id="f-s" value="16" name="f-s" placeholder="16" class="text" required />
	</p>
	<p class="centrer">
		<button type="button" onclick="calc_dates('diff');" name="difference" class="button button-submit">Soustraire</button>
		<button type="button" onclick="calc_dates('summ');" name="somme" class="button button-submit">Additionner</button>
	</p>

	<p id="diffdate">La différence entre ces deux dates est&nbsp;:<br/><span class="result" id="diffdate-res"></span></p>

	<p id="sommdate">La somme de ces deux dates correspond au&nbsp;:<br/><span class="result" id="sommdate-res"></span></p>

	<div class="notes">
		<p>L’intervalle des possibilités va de 0100-01-01, 00:00:00 à 9999-12-31,23:59:59.</p>
	</div>

</section>

<section class="main-form">
	<h2>Convertir un nombre de secondes en minutes, heures, jours&nbsp;:</h2>
	<p class="centrer">
		<span style="visibility:hidden;">+</span><input type="number" step="1" id="n-d" value="0"   min="0" name="n-d" placeholder="0"   class="longtext text" /><label class="fl" for="n-d">jours</label>
	</p>
	<p class="centrer">
		+<input type="number" step="1" id="n-h" value="2"   min="0" name="n-h" placeholder="2"   class="longtext text" /><label class="fl" for="n-h">heures</label>
	</p>
	<p class="centrer">
		+<input type="number" step="1" id="n-i" value="30"  min="0" name="n-i" placeholder="30"  class="longtext text" /><label class="fl" for="n-i">minutes</label>
	</p>
	<p class="centrer">
		+<input type="number" step="1" id="n-s" value="1800" min="0" name="n-s" placeholder="1800" class="longtext text" /><label class="fl" for="n-s">secondes</label>
	</p>
	<p class="centrer">
		<button type="button" onclick="convert();" name="convertir" class="button button-submit">Convertir</button>
	</p>
	<p>Le total est équivalent à chacunne des durées suivantes :</p>
	<ul>
		<li><span id="td"></span> <span>jours,</span></li>
		<li><span id="th"></span> <span>heures,</span></li>
		<li><span id="ti"></span> <span>minutes,</span></li>
		<li><span id="ts"></span> <span>secondes.</span></li>
	</ul>

	<div class="notes">
		<p>Les mois et les années ne sont pas présents ici car tous les mois ne sont pas égaux.</p>
	</div>
</section>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script>
'use strict'
/* <![CDATA[ */

function getdate1() {
	var date = new Array();
	date['y'] = parseInt(document.getElementById('i-y').value);
	date['m'] = parseInt(document.getElementById('i-m').value);
	date['d'] = parseInt(document.getElementById('i-d').value);
	date['h'] = parseInt(document.getElementById('i-h').value);
	date['i'] = parseInt(document.getElementById('i-i').value);
	date['s'] = parseInt(document.getElementById('i-s').value);
	return date;
}

function getdate2() {
	var date = new Array();
	date['y'] = parseInt(document.getElementById('f-y').value);
	date['m'] = parseInt(document.getElementById('f-m').value);
	date['d'] = parseInt(document.getElementById('f-d').value);
	date['h'] = parseInt(document.getElementById('f-h').value);
	date['i'] = parseInt(document.getElementById('f-i').value);
	date['s'] = parseInt(document.getElementById('f-s').value);
	return date;
}

function parseDateFromVar(diff) {
	var date = new Array();
	date['y'] = diff.getFullYear();
	date['m'] = diff.getMonth();
	date['d'] = diff.getDate();
	date['h'] = diff.getHours();
	date['i'] = diff.getMinutes();
	date['s'] = diff.getSeconds();
	return date;

}

function d2(val) {
	if (val.toString().length == 1) {
		val = '0' + val.toString();
	}
	return val;
}

/* Main operating fonction */
function calc_dates(op) {
	// get dates
	var date1 = getdate1();
	var date2 = getdate2();

	var idate = new Date(date1['y'], date1['m'], date1['d'], date1['h'], date1['i'], date1['s']);
	var fdate = new Date(date2['y'], date2['m'], date2['d'], date2['h'], date2['i'], date2['s']);

	// difference between the two dates
	if (op == 'diff') {
		document.getElementById('diffdate').style.display = 'block';
		document.getElementById('sommdate').style.display = 'none';
		var diff = idate;
		diff.setFullYear(idate.getFullYear()-fdate.getFullYear());
		diff.setMonth(idate.getMonth()-fdate.getMonth());
		diff.setDate(idate.getDate()-fdate.getDate());
		diff.setHours(idate.getHours()-fdate.getHours());
		diff.setMinutes(idate.getMinutes()-fdate.getMinutes());
		diff.setSeconds(idate.getSeconds()-fdate.getSeconds());

		var dd = parseDateFromVar(diff);

		// print formated diff date on document.
		document.getElementById('diffdate-res').innerHTML = dd['y']+' années '+dd['m']+' mois '+dd['d']+' jours '+dd['h']+' heures '+dd['i']+' minutes '+dd['s']+' secondes';

	}
	else {
		var fdate = date2;
		document.getElementById('diffdate').style.display = 'none';
		document.getElementById('sommdate').style.display = 'block';

		var diff = idate;
		diff.setSeconds(diff.getSeconds()+fdate['s']);
		diff.setMinutes(diff.getMinutes()+fdate['i']);
		diff.setHours(diff.getHours()+fdate['h']);
		diff.setDate(diff.getDate()+fdate['d']);
		diff.setMonth(diff.getMonth()+fdate['m']);
		diff.setFullYear(diff.getFullYear()+fdate['y']);

		var dd = parseDateFromVar(diff);

		// print formated diff date on document.
		document.getElementById('sommdate-res').innerHTML = d2(dd['y'])+'/'+d2(dd['m'])+'/'+d2(dd['d'])+' à '+d2(dd['h'])+':'+d2(dd['i'])+':'+d2(dd['s']);
	}
	return false;
}

calc_dates('diff');

function convert() {
	var date = new Array();
	date['d'] = parseInt(document.getElementById('n-d').value); date['d'] = (String(date['d']) == 'NaN') ? 0 : date['d'];
	date['h'] = parseInt(document.getElementById('n-h').value); date['h'] = (String(date['h']) == 'NaN') ? 0 : date['h'];
	date['i'] = parseInt(document.getElementById('n-i').value); date['i'] = (String(date['i']) == 'NaN') ? 0 : date['i'];
	date['s'] = parseInt(document.getElementById('n-s').value); date['s'] = (String(date['s']) == 'NaN') ? 0 : date['s'];
	var nsec = date['d']*24*60*60 + date['h']*60*60 + date['i']*60 + date['s'];
	document.getElementById('ts').innerHTML = nsec;
	document.getElementById('ti').innerHTML = String(parseFloat((nsec/60).toFixed(12))).replace(/\./g, ',');
	document.getElementById('th').innerHTML = String(parseFloat((nsec/60/60).toFixed(12))).replace(/\./g, ',');
	document.getElementById('td').innerHTML = String(parseFloat((nsec/60/60/24).toFixed(12))).replace(/\./g, ',');
	return false;
}

convert();

/* ]]> */
</script>
<!--

# adresse de la page : http://lehollandaisvolant.net/tout/tools/dates/
#      page créée le : 5 mars 2013
#     mise à jour le : 12 août 2018

-->
</body>
</html>