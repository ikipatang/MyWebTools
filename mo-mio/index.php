<!DOCTYPE html>
<html lang="fr-fr" manifest="timo.mo-mio.manifest">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Un convertisseur de kilooctet, megaoctet dans tous les sens en javascript" />
	<title>Convertisseur d’unités informatique - le hollandais volant</title>
	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

#source {
	width: 150px;
}

label[for="source"] {
	font-size: 1.2em;
}

.convert-button {
	text-align: center;
	margin: 30px 0 50px;
}

.main-form .text {
	text-align: right;
	padding: 6px;
}

#all_units p {
	margin: 0;
	display: flex;
	flex-wrap: wrap;
	justify-content: center;
}

#all_units span {
	background: #eee;
	border: 1px solid silver;
	border-width: 1px 1px 0;
}

#all_units .text {
	text-align: right;
	margin-left: 0;
	margin-right: 0px;
	border-width: 0 1px 0 0;
	padding: 6px;
	width: 18em;
}

#all_units p:first-of-type .text {
	width: calc( 36em + 12px + 40px + 10px - 2px );
}
#all_units p:last-of-type span:first-of-type {
	border-radius: 0 0 0 4px;
}
#all_units p:last-of-type span:last-of-type {
	border-radius: 0 0 4px 0;
}

#all_units p:first-of-type span:first-of-type {
	border-radius: 4px 4px 0 0;
}


#all_units p:last-of-type span {
	border-width: 1px;
}


#all_units label {
	width: 30px;
	display: inline-block;
	text-align: center;
	padding-right: 10px;
}

abbr[title] {
	cursor: help;
	border-bottom: 1px dotted #999;
}

	</style>
</head>
<body>


<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Convertisseur d’unités informatique</a></p>
</header>

<section id="main-form" class="main-form">
	<label for="source">Quantité : </label><br/>
	<input type="number" onchange="convert();" step="1" min="2" max="10000000000" id="source" value="1024" name="source" placeholder="1024" class="text" />
	<select name="unite_i" id="unite_i" onchange="convert();">
		<optgroup label="Préfixes normaux">
			<option value="o">o (octet)</option>
			<option value="k" selected>ko (kilooctet)</option>
			<option value="m">Mo (mégaoctet)</option>
			<option value="g">Go (gigaoctet)</option>
			<option value="t">To (téraoctet)</option>
			<option value="p">Po (pétaoctet)</option>
			<option value="e">Eo (exaoctet)</option>
			<option value="z">Zo (zettaoctet)</option>

		</optgroup>
		<optgroup label="Préfixes binaires">
			<option value="ki">kio (kibioctet)</option>
			<option value="mi">Mio (mébioctet)</option>
			<option value="gi">Gio (gibioctet)</option>
			<option value="ti">Tio (tebioctet)</option>
			<option value="pi">Po (pétaoctet)</option>
			<option value="ei">Eo (exaoctet)</option>
			<option value="zi">Zo (zettaoctet)</option>
		</optgroup>
	</select>

	<p class="convert-button"><button onclick="convert();" id="convertir" class="button button-submit">Convertir</button></p>

	<div id="all_units">
		<p>
			<span class="bloc">
				<input readonly type="text" id="o" class="text" />
				<label for="o"><abbr title="octet">o</abbr></label> 
			</span>
		</p>
		<p>
			<span class="bloc">
				<input readonly type="text" id="k" class="text" />
				<label for="k"><abbr title="kilooctet">ko</abbr></label> 
			</span>
			<span class="bloc">
				<input readonly type="text" id="ki" class="text" />
				<label for="ki"><abbr title="kibioctet">kio</abbr></label> 
			</span>
		</p>
		<p>
			<span class="bloc">
				<input readonly type="text" id="m" class="text" />
				<label for="m"><abbr title="mégaoctet">Mo</abbr></label> 
			</span>
			<span class="bloc">
				<input readonly type="text" id="mi" class="text" />
				<label for="mi"><abbr title="mébioctet">Mio</abbr></label> 
			</span>
		</p>
		<p>
			<span class="bloc">
				<input readonly type="text" id="g" class="text" />
				<label for="g"><abbr title="gigaoctet">Go</abbr></label> 
			</span>
			<span class="bloc">
				<input readonly type="text" id="gi" class="text" />
				<label for="gi"><abbr title="gibioctet">Gio</abbr></label> 
			</span>
		</p>
		<p>
			<span class="bloc">
				<input readonly type="text" id="t" class="text" />
				<label for="t"><abbr title="téraoctet">To</abbr></label> 
			</span>
			<span class="bloc">
				<input readonly type="text" id="ti" class="text" />
				<label for="ti"><abbr title="tébioctet">Tio</abbr></label> 
			</span>
		</p>
		<p>
			<span class="bloc">
				<input readonly type="text" id="p" class="text" />
				<label for="p"><abbr title="pétaoctet">Po</abbr></label> 
			</span>
			<span class="bloc">
				<input readonly type="text" id="pi" class="text" />
				<label for="pi"><abbr title="pébioctet">Pio</abbr></label> 
			</span>
		</p>
		<p>
			<span class="bloc">
				<input readonly type="text" id="e" class="text" />
				<label for="e"><abbr title="exaoctet">Eo</abbr></label> 
			</span>
			<span class="bloc">
				<input readonly type="text" id="ei" class="text" />
				<label for="ei"><abbr title="exbioctet">Eio</abbr></label> 
			</span>
		</p>
		<p>
			<span class="bloc">
				<input readonly type="text" id="z" class="text" />
				<label for="z"><abbr title="zettaoctet">Zo</abbr></label> 
			</span>
			<span class="bloc">
				<input readonly type="text" id="zi" class="text" />
				<label for="zi"><abbr title="zébioctet">Zio</abbr></label> 
			</span>
		</p>
	</div>

	<div class="notes centrer">
		<p>1 To = 1&thinsp;000 Go = 1&thinsp;000&thinsp;000 Mo = 1&thinsp;000&thinsp;000&thinsp;000 ko = 1&thinsp;000&thinsp;000&thinsp;000&thinsp;000 o<br/>
1 Tio = 1&thinsp;024 Gio = 1&thinsp;048&thinsp;576 Mio = 1&thinsp;073&thinsp;741&thinsp;824 kio = 1&thinsp;099&thinsp;511&thinsp;627&thinsp;776 o</p>
	</div>

</section>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script>
/* <![CDATA[ */

function convert() {
	var nombre_i = document.getElementById('source').value;
	var unite_i = document.getElementById('unite_i').value;
	var nombre_f_o = 0;

	// switch en octets pour commencer.
	switch(unite_i) {
		case 'o':  nombre_f_o = nombre_i;break;
		case 'k':  nombre_f_o = nombre_i*1000; break;
		case 'm':  nombre_f_o = nombre_i*1000*1000; break;
		case 'g':  nombre_f_o = nombre_i*1000*1000*1000; break;
		case 't':  nombre_f_o = nombre_i*1000*1000*1000*1000; break;
		case 'p':  nombre_f_o = nombre_i*1000*1000*1000*1000*1000; break;
		case 'e':  nombre_f_o = nombre_i*1000*1000*1000*1000*1000*1000; break;
		case 'z':  nombre_f_o = nombre_i*1000*1000*1000*1000*1000*1000*1000; break;
		case 'ki': nombre_f_o = nombre_i*1024; break;
		case 'mi': nombre_f_o = nombre_i*1024*1024; break;
		case 'gi': nombre_f_o = nombre_i*1024*1024*1024; break;
		case 'ti': nombre_f_o = nombre_i*1024*1024*1024*1024; break;
		case 'pi': nombre_f_o = nombre_i*1024*1024*1024*1024*1024; break;
		case 'ei': nombre_f_o = nombre_i*1024*1024*1024*1024*1024*1024; break;
		case 'zi': nombre_f_o = nombre_i*1024*1024*1024*1024*1024*1024*1024; break;
	}

	document.getElementById('o').value = nombre_f_o;
	document.getElementById('k').value = String(parseFloat((nombre_f_o/1000).toFixed(12))).replace(/\./g, ',');
	document.getElementById('m').value = String(parseFloat((nombre_f_o/1000/1000).toFixed(12))).replace(/\./g, ',');
	document.getElementById('g').value = String(parseFloat((nombre_f_o/1000/1000/1000).toFixed(12))).replace(/\./g, ',');
	document.getElementById('t').value = String(parseFloat((nombre_f_o/1000/1000/1000/1000).toFixed(12))).replace(/\./g, ',');
	document.getElementById('p').value = String(parseFloat((nombre_f_o/1000/1000/1000/1000/1000).toFixed(12))).replace(/\./g, ',');
	document.getElementById('e').value = String(parseFloat((nombre_f_o/1000/1000/1000/1000/1000/1000).toFixed(12))).replace(/\./g, ',');
	document.getElementById('z').value = String(parseFloat((nombre_f_o/1000/1000/1000/1000/1000/1000/1000).toFixed(12))).replace(/\./g, ',');

	document.getElementById('ki').value = String(parseFloat((nombre_f_o/1024).toFixed(12))).replace(/\./g, ',');
	document.getElementById('mi').value = String(parseFloat((nombre_f_o/1024/1024).toFixed(12))).replace(/\./g, ',');
	document.getElementById('gi').value = String(parseFloat((nombre_f_o/1024/1024/1024).toFixed(12))).replace(/\./g, ',');
	document.getElementById('ti').value = String(parseFloat((nombre_f_o/1024/1024/1024/1024).toFixed(12))).replace(/\./g, ',');
	document.getElementById('pi').value = String(parseFloat((nombre_f_o/1024/1024/1024/1024/1024).toFixed(12))).replace(/\./g, ',');
	document.getElementById('ei').value = String(parseFloat((nombre_f_o/1024/1024/1024/1024/1024/1024).toFixed(12))).replace(/\./g, ',');
	document.getElementById('zi').value = String(parseFloat((nombre_f_o/1024/1024/1024/1024/1024/1024/1024).toFixed(12))).replace(/\./g, ',');

	return false;
}

convert();

/* ]]> */
</script>
<!--

# adresse de la page : https://lehollandaisvolant.net/tout/tools/mo-mio/
#      page créée le : 3 mars 2013
#     mise à jour le : 14 novembre 2018

-->
</body>
</html>