<?php
if (extension_loaded('zlib')) {
	ob_end_clean();
	ob_start("ob_gzhandler");
}
else {
	ob_start("ob_gzhandler");
}
?>
<!DOCTYPE html>
<html lang="fr-fr" manifest="timo.tron.manifest">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Un générateur de blabla en javascript" />
	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<title>Blabla-o-tron (générateur de blabla) - le hollandais volant</title>
	<style>

#tron, #capture {
	margin: 20px auto 20px;
	display: block;
}


#output {
	border: 1px solid silver;
	border-radius: 5px;
	padding: 20px;
	background: #f0f0f0;
	margin: 30px auto;
	display: none;
}

#output span {
	display: block;
	text-align: left;
	font-style: italic;
}

#output span:nth-of-type(even) {
	color: #40f;
}

#output span:nth-of-type(odd) {
	color: #f33;
}

#output span:last-of-type {
	color: black;
}

#output span:nth-of-type(even):before {
	content: 'James : ';
}

#output span:nth-of-type(odd):before {
	content: 'Jessie : ';
}

#output span:last-of-type:before {
	content: 'Miaouss : ';
}

#output span:before {
	color: black;
	font-style: normal;
}

#output p {
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
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Blabla-o-tron</a></p>
</header>

<section id="main-form" class="main-form">
	<select id="tron" onchange="gen();">
		<option value="salutotron" selected="selected">Salut-o-tron</option>
		<option value="insultotron">Insult-o-tron</option>
		<option value="millesabordotron">Capitain Haddock-o-tron</option>
		<option value="rocketotron">Team Rocket-o-tron</option>
		<option value="excusotron">Excusotron pour étudiants</option>
		<option value="lsv">Le saviez-vous-o-tron ?</option>
		<option value="sageotron">Le sage-o-tron a parlé.</option>
		<option value="malouotron">Eddy Malou-o-tron</option>
		<option value="chassotron">Accidents de chasse-o-tron</option>
	</select>
	<button onclick="gen();" id="capture" class="button button-submit">Générer</button>

	<p id="output">&nbsp;</p>

	<div class="notes">Les textes sont pour certains repris de <a href="http://www.charabia.net/gen/full-list.php">Charabia.net</a>. Celui de Malou, sont repris d’<a href="http://eddy-malou.com/">ici</a>, et celui sur la chasse d’une idée de <a href="https://chasseurs.retidurc.fr/index.php">Retidurc</a>.</div>
</section>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script type="text/javascript" src="js/salutotron.js"></script>
<script type="text/javascript" src="js/millesabordotron.js"></script>
<script type="text/javascript" src="js/insultotron.js"></script>
<script type="text/javascript" src="js/rocketotron.js"></script>
<script type="text/javascript" src="js/excusotron.js"></script>
<script type="text/javascript" src="js/lsv.js"></script>
<script type="text/javascript" src="js/sageotron.js"></script>
<script type="text/javascript" src="js/malouotron.js"></script>
<script type="text/javascript" src="js/chassotron.js"></script>

<script>
/* <![CDATA[ */
var output = document.getElementById('output');
var otron = document.getElementById('tron').value;

function gen() {
	otron = document.getElementById('tron').value;
	output.style.display = 'block';

	switch (otron) {
		case 'salutotron':
			salutotron();
			break;

		case 'millesabordotron':
			millesabordotron();
			break;

		case 'insultotron':
			insultotron();
			break;

		case 'rocketotron':
			rocketotron();
			break;

		case 'excusotron':
			excusotron();
			break;

		case 'lsv':
			lsv();
			break;

		case 'sageotron':
			sageotron();
			break;

		case 'malouotron':
			malouotron();
			break;

		case 'chassotron':
			chassotron();
			break;

		default:
			salutotron();
			break;
	}
}

/* ]]> */
</script>
<!--

# adresse de la page : http://lehollandaisvolant.net/tout/tools/tron/
#      page créée le : 1 avril 2013
#     mise à jour le : 13 décembre 2015

-->
</body>
</html>