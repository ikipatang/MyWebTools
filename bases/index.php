<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Un convertisseur en javascript de nombres entre bases numériques" />
	<title>Convertir un nombre entier dans différentes bases - le hollandais volant</title>
	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

#resultat {
	font-size: 200%;
	border: 1px solid silver;
	border-radius: 4px;
	line-height: 2em;
	vertical-align: middle;
	height: 2em;
	padding: 5px 20px;
	text-align: right;
}

#source, #destination {
	width: 50px;
}

#nombre {
	width: 100px;
}
	</style>
</head>
<body>

<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Convertir un nombre dans différentes bases</a></p>
</header>

<div id="main-form" class="main-form">
	
	<p>Convertir
		<label for="nombre">le nombre</label> 
		<input onchange="convert()" type="text" id="nombre" value="42" name="nombre" placeholder="2" class="text" />

		<label for="source">de la base</label> 
		<input onchange="convert()" type="number" step="1" min="2" max="36" id="source" value="10" name="source" placeholder="10" class="text" />

		<label for="destination">vers la base </label> 
		<input onchange="convert()" type="number" step="1" min="2" max="36" id="destination" value="2" name="destination" placeholder="2" class="text" />

	</p>

	<button onclick="return convert();" id="convertir" class="button button-submit">convertir</button>

	<p id="resultat"></p>

	<div class="notes">
		<p>Les bases vont de 2 à 36.</p>
		<p>Le nombre entré est entier et peut aller de 0 à 2&nbsp;147&nbsp;483&nbsp;647.</p>
	</div>

</div>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script>
/* <![CDATA[ */

function convert() {
	var valeur = document.getElementById('nombre').value;
	var base_source = document.getElementById('source').value;
	var base_destin = document.getElementById('destination').value;
	var result = parseInt(valeur, base_source).toString(base_destin);
	if (String(result) == 'NaN') {
		result = 'la base '+base_source+' est impossible pour '+valeur; // par exemple "3" est impossible en binaire, où il n’y a que 0 et des 1.
	}
	document.getElementById('resultat').innerHTML = result;
	return false;
}

convert();

/* ]]> */
</script>
<!--

# adresse de la page : http://lehollandaisvolant.net/tout/tools/bases/
#      page créée le : 25 février 2013
#     mise à jour le : 4 avril 2013

-->
</body>
</html>