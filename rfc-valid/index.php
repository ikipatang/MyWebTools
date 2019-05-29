<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Un validateur d’Email en ligne, qui tient compte des RFC correspondants" />
	<title>Vérifier la validité d’une adresse email - le hollandais volant</title>
	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

#main-form .text {
	border: 1px solid silver;
	border-radius: 2px;
	margin-left: 0;
	text-align: left;
}

b.green {
	color: green;
}
b.red {
	color: red;
}

#response {
	font-size: 110%;
}
	</style>
</head>
<body>


<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Vérifier la validité d’une adresse email</a></p>
</header>

<section id="main-form" class="main-form" onsubmit="test();">
	<p><label for="mail">Email à tester&nbsp;:</label></p>
	<p><input type="text" id="mail" value="" required name="mail" placeholder="mail@example.com" class="text" /></p>
	<button onclick="test();" id="d" class="button button-submit" type="button">Vérifier</button>
	<p id="response"></p>

	<div class="notes">
		<p>Ce script utilise <a href="http://code.google.com/p/isemail/">Isemail</a>, sous license BSD.</p>
		<p>Isemail respecte les RFC <a href="http://tools.ietf.org/html/rfc5321">5321</a>, <a href="http://tools.ietf.org/html/rfc3696">3696</a>, <a href="http://tools.ietf.org/html/rfc2822">2822</a>.</p>
		<p>La résolution du nom de domaine n’est pas testée.</p>
	</div>
</section>

<footer id="footer"><a href="/">Timo Van Neerden</a> - <a href="../">autres outils</a></footer>

<script>
/* <![CDATA[ */
'use strict'

// create and send form
function test() {
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'rex.php');
	xhr.onload = function() {
		if (this.responseText == 'TRUE') {
			document.getElementById('response').innerHTML = 'L’adresse email est <b class="green">valide</b>.';
		} else {
			document.getElementById('response').innerHTML = 'L’adresse email est <b class="red">invalide</b>.';
		}
	};
	// prepare and send FormData
	var formData = new FormData();  
	formData.append( 'm', document.getElementById('mail').value );
	xhr.send(formData);

	return false;
}
/* ]]> */
</script>
<!--
# adresse de la page : http://lehollandaisvolant.net/tout/tools/rfc-valid/
#      page créée le : 25 février 2013
#     mise à jour le : 4 avril 2013
-->
</body>
</html>