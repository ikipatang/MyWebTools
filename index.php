<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Page regroupant tous les mes outils : convertisseurs entre bases, kilooctects, générateur de qrcode, convertisseur de dates et autres." />
	<link rel="stylesheet" href="0common/common.css" type="text/css" />


	<title>Mes petits outils en ligne - le hollandais volant</title>

	<style type="text/css">


#filtrer {
	flex: 0 1 550px;
	margin: 0 15px 0 8px;
	display: flex;
	align-items: stretch;
	color: rgb(0, 0, 0);
	height: 100%;
	border-radius: 2px;
	overflow: hidden;
}

#filtrer #search {
	padding: 0 10px;
	border: 1px solid transparent;
	box-sizing: border-box;
	max-width: 550px;
	flex: 1 1 auto;
	min-width: 0;
	background-color: rgba(255, 255, 255, .7);
	box-sizing: border-box;
	line-height: 48px;
}

#filtrer #search:focus {
	background-color: rgba(255, 255, 255, 1);
	color: black;
}

#main-form {
	max-width: 760px;
	margin: 60px auto;
	padding: 20px;
	text-align: left;
}

#main-form h2 {
	text-align: left;
	font-size: 1.2em;
	margin-left: 5px;
	margin-top: 30px;
}

.bloc {
	text-align: center;
	display: inline-block;
	width: 110px;
	height: 110px;
	font-size: 80%;
	margin: 5px;
	box-shadow: 0px 0px 2px #ddd;
	border-radius: 10px;
	border: 1px solid #eee;
	line-height: 100px;
	text-shadow: 1px 1px 2px silver;
}

.bloc:hover {
	box-shadow: 1px 1px 3px #eee;
}

.bloc a {
	display: inline-block;
	border: 1px dashed transparent;
	height: 80px;
	width: 100px;
	vertical-align: middle;
	line-height: 1.1em;
}

.bloc a img {
	border: none;
	display: block;
	margin: 0 auto;
	width: 48px;
	height: 48px;
}

a img {
	border: none;
}


#footer {
	font-size: 90%;
	color: gray;
}

#footer a, .bloc a, .notes a {
	color: inherit;
	text-decoration: none;
}

#footer a:hover, .notes a:hover {
	text-decoration: underline;
}


@media (max-width: 600px) {
	#top-nav {
		padding: 10px;
		flex-wrap: wrap;
	}
}


	</style>
</head>
<body>


<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>

	<p class="navbarlinks"><a href=".">Mes petits outils en ligne</a></p>
	<form id="filtrer" action="javascript:void(0);">
		<input type="search" id="search" autocomplete="no" size="20" placeholder="Filtre" />
	</form>
</header>

<section id="main-form">


	<h2>Encodage, décodage</h2>
	<div class="bloc" data-description="qrcode flashcode créer image">
		<a href="qrcode/">
			<img src="qrcode/icon.png" alt="icon"/>
			Créer un<br/>QR-Code
		</a>
	</div>
	<div class="bloc" data-description="un qrcode qr-code flashcode décoder flashed webcam photo">
		<a href="rqrcode/">
			<img src="rqrcode/icon.png" alt="icon"/>
			Décoder un<br/>QR-Code
		</a>
	</div>
	<div class="bloc" data-description="convertisseur conversion base64 bases">
		<a href="base64/">
			<img src="base64/icon.png" alt="icon"/>
			En/décoder<br/>du base64
		</a>
	</div>
	<div class="bloc" data-description="chiffrement codage encodage décodage de césar cesar vigenère">
		<a href="cesar/">
			<img src="cesar/icon.png" alt="icon"/>
			Chiffrement<br/>de César
		</a>
	</div>
	<div class="bloc" data-description="character caractère encodage utf8 utf-8 utf 8 unicode emoji code">
		<a href="charcode/">
			<img src="charcode/icon.png" alt="icon"/>
			Encodage d’un<br/>caractère
		</a>
	</div>




	<h2>Convertisseurs numérique</h2>
	<div class="bloc" data-description="mathématique bases convertisseur entre binaire hexadécimal octal décimal">
		<a href="bases/">
			<img src="bases/icon.png" alt="icon"/>
			Conversions entre bases
		</a>
	</div>
	<div class="bloc" data-description="convertisseur d'unités unités mathématique physique">
		<a href="unites/">
			<img src="unites/icon.png" alt="icon"/>
			Convertisseur<br/>d’unités
		</a>
	</div>
	<div class="bloc" data-description="convertisseur mathématiques unités numérique octect kilooctet mégaoctet">
		<a href="mo-mio/">
			<img src="mo-mio/icon.png" alt="icon"/>
			Unités numériques
		</a>
	</div>



	<h2>Générateurs en tout genre</h2>
	<div class="bloc" data-description="générateur générer un nom aléatoire mathématiques">
		<a href="random/">
			<img src="random/icon.png" alt="icon"/>
			Générateur de<br/>nombre&nbsp;aléatoire
		</a>
	</div>
	<div class="bloc" data-description="générateur de blabla tron insultotron">
		<a href="tron/">
			<img src="tron/icon.png" alt="icon"/>
			Générateur<br/>de blabla
		</a>
	</div>
	<div class="bloc" data-description="générateur générer une vCard contact">
		<a href="vcard/">
			<img src="vcard/icon.png" alt="icon"/>
			Générateur<br/>de&nbsp;vCard
		</a>
	</div>
	<div class="bloc" data-description="ressource de faux texte lorem ipsum générateur">
		<a href="ipsum/">
			<img src="ipsum/icon.png" alt="icon"/>
			Générateur de<br/>faux-texte
		</a>
	</div>
	<div class="bloc" data-description="générateur mathématique générer un carré magique nombres">
		<a href="magic/">
			<img src="magic/icon.png" alt="icon"/>
			Générateur<br/>carré-magique
		</a>
	</div>
	<div class="bloc" data-description="générateur de tonalités téléphone musique son dtmf musique">
		<a href="dtmf/">
			<img src="dtmf/icon.png" alt="icon"/>
			Générateur<br/>de tonalités
		</a>
	</div>
	<div class="bloc" data-description="générateur générer un guid unique id">
		<a href="guid/">
			<img src="guid/icon.png" alt="icon"/>
			Générateur<br/>de GUID
		</a>
	</div>
	<div class="bloc" data-description="générateur mots langues lettres vocabulaire fake words inventer">
		<a href="fake-words/">
			<img src="fake-words/icon.png" alt="icon"/>
			Générateur<br/>des mots
		</a>
	</div>



	<h2>Photos &amp; couleurs</h2>
	<div class="bloc" data-description="webcam prendre un photo">
		<a href="webcam/">
			<img src="webcam/icon.png" alt="icon"/>
			Prendre une photo
		</a>
	</div>
	<div class="bloc" data-description="sélecteur de couleurs html hsl rgb color picker">
		<a href="color/">
			<img src="color/icon.png" alt="icon"/>
			Sélecteur<br/>de couleur
		</a>
	</div>
	<div class="bloc" data-description="retoucher une image photo effets jpg png">
		<a href="toshop/">
			<img src="toshop/icon.png" alt="icon"/>
			Retoucher<br>une image
		</a>
	</div>
	<div class="bloc" data-description="photo transparence alpha supprimer retouche gif png">
		<a href="alpha/">
			<img src="alpha/icon.png" alt="icon"/>
			Supprimer la transparence<br/>d’une image
		</a>
	</div>
	<div class="bloc" data-description="convertisseur calculer couleurs des résistors résistances physique informatique">
		<a href="resistor/">
			<img src="resistor/icon.png" alt="icon"/>
			Couleurs des<br/>résistors
		</a>
	</div>



	<h2>Dates &amp; heures</h2>
	<div class="bloc" data-description="mathématique additionner des dates calendrier">
		<a href="dates/">
			<img src="dates/icon.png" alt="icon"/>
			Additionner<br/>des dates
		</a>
	</div>
	<div class="bloc" data-description="calendrier du mois jours année dates">
		<a href="calendar/">
			<img src="calendar/icon.png" alt="icon"/>
			Calendrier<br/>du mois
		</a>
	</div>
	<div class="bloc" data-description="générateur minuteur avec alarme son musique fichiers">
		<a href="timer/">
			<img src="timer/icon.png" alt="icon"/>
			Minuteur<br/>avec alarme
		</a>
	</div>
	<div class="bloc" data-description="avez vous 1Gs gigaseconde temps unité">
		<a href="giga-second/">
			<img src="giga-second/icon.png" alt="icon"/>
			Avez-vous<br/>1&nbsp;Gs&nbsp;?
		</a>
	</div>
	<div class="bloc" data-description="heure date planète mars jupiter système solaire calendrier">
		<a href="planets-time/">
			<img src="planets-time/icon.png" alt="icon"/>
			Quelle heure<br/>sur Mars&nbsp;?
		</a>
	</div>
	<div class="bloc" data-description="heure date planète mars jupiter système solaire calendrier">
		<a href="day/">
			<img src="day/icon.png" alt="icon"/>
			Quel jour était-il le … ?
		</a>
	</div>
	<div class="bloc" data-description="heure jour date progression année temps horloge pourcentage">
		<a href="progression-calendar/">
			<img src="progression-calendar/icon.png" alt="icon"/>
			L’horloge en<br/>pourcentage
		</a>
	</div>



	<h2>Programmation</h2>
	<div class="bloc" data-description="calculer une checksum informatique fichier image md5 sha1 sha">
		<a href="checksum/">
			<img src="checksum/icon.png" alt="icon"/>
			Calculer une<br/>checksum
		</a>
	</div>
	<div class="bloc" data-description="générateur imager une regex informatique">
		<a href="regex/">
			<img src="regex/icon.png" alt="icon"/>
			Imager<br/>une Regex
		</a>
	</div>
	<div class="bloc" data-description="calculer un chmod mode unix linux 777 rwxrwxrwx">
		<a href="chmod/">
			<img src="chmod/icon.png" alt="icon"/>
			Calculer<br>un chmod
		</a>
	</div>
	<div class="bloc" data-description="informatique table des caractères générateur charmap character unicode">
		<a href="charmap/">
			<img src="charmap/icon.png" alt="icon"/>
			Table des<br/>caractères
		</a>
	</div>
	<div class="bloc" data-description="validateur email valider vérifier une adresse mail">
		<a href="rfc-valid/">
			<img src="rfc-valid/icon.png" alt="icon"/>
			Valider une email
		</a>
	</div>



	<h2>Jeux</h2>
	<div class="bloc" data-description="jouer à 2048 jeux informatique">
		<a href="2048/">
			<img src="2048/icon.png" alt="icon"/>
			Jouer à<br>2048
		</a>
	</div>
	<div class="bloc" data-description="jouer à tetris tétris jeux informatique">
		<a href="tetris/">
			<img src="tetris/icon.png" alt="icon"/>
			Jouer à<br>Tetris
		</a>
	</div>
	<div class="bloc" data-description="chimie tableau périodique mendeléièv jeux">
		<a href="periodic/">
			<img src="periodic/icon.png" alt="icon"/>
			Tableau périodique
		</a>
	</div>



	<h2>Divers</h2>
	<div class="bloc" data-description="informations votre navigateur informatique">
		<a href="browser/">
			<img src="browser/icon.png" alt="icon"/>
			Informations de<br/>votre navigateur
		</a>
	</div>
	<div class="bloc" data-description="speedtest test de connexion adsl fibre">
		<a href="speedtest/">
			<img src="speedtest/icon.png" alt="icon"/>
			Tester<br/>votre connexion
		</a>
	</div>
	<!--	<div class="bloc">
		<a href="dl/">
			<img src="dl/icon.png" alt="icon"/>
			Télécharger<br/>une page
		</a>
	</div>-->
	<div class="bloc" data-description="tracer un graphique mathématique générateur">
		<a href="graph/">
			<img src="graph/icon.png" alt="icon"/>
			Tracer<br>un graphique
		</a>
	</div>
	<div class="bloc" data-description="fonctions trigonometrie trigonométriques mathématique graphique sinus cosinus">
		<a href="trigonometrie/">
			<img src="trigonometrie/icon.png" alt="icon"/>
			Les fonctions<br>trigonométriques
		</a>
	</div>
	<div class="bloc" data-description="Production électrique énergie en France consommation électricité statistiques">
		<a href="conso-en-france/">
			<img src="conso-en-france/icon.png" alt="icon"/>
			Production électrique<br>en France
		</a>
	</div>
	<div class="bloc" data-description="Partager des dépenses share costs argent">
		<a href="pay-bill/">
			<img src="pay-bill/icon.png" alt="icon"/>
			Partager des<br>dépenses d’amis
		</a>
	</div>
	<div class="bloc" data-description="Mur de notes, notepad, post-it, notes">
		<a href="notes-wall/">
			<img src="notes-wall/icon.png" alt="icon"/>
			Un mur<br/>de notes
		</a>
	</div>
	<div class="bloc" data-description="Mur de notes, notepad, post-it, notes">
		<a href="post-it/">
			<img src="post-it/icon.png" alt="icon"/>
			Un bloc note<br>en post-it
		</a>
	</div>
	<div class="bloc" data-description="youtube rss atom flux">
		<a href="youtube-rss/">
			<img src="youtube-rss/icon.png" alt="icon"/>
			Récupérer un flux RSS Youtube
		</a>
	</div>
	<div class="bloc" data-description="trou noir black hole hawking radiation masse énergie">
		<a href="blackhole/">
			<img src="blackhole/icon.png" alt="icon"/>
			Calculateur de trou noir
		</a>
	</div>


	<h2>Écrans de veille</h2>
	<div class="bloc" data-description="quelle couleur est il images">
		<a href="color-second/">
			<img src="color-second/icon.png" alt="icon"/>
			Quelle couleur<br/>est-il&nbsp;?
		</a>
	</div>
	<div class="bloc" data-description="matrix code rain pluie japonais">
		<a href="matrix/">
			<img src="matrix/icon.png" alt="icon"/>
			Matrix<br/>code rain
		</a>
	</div>



</section>

<footer id="footer"><a href="/">Timo Van Neerden</a> - <a href="cgu.php">à propos</a> - <a href="http://tiheum.deviantart.com/">Icônes par Tiheum</a></footer>

<script type="text/javascript">
'use strict'

var searchbox = document.getElementById('search');
var listtools = document.querySelectorAll('#main-form > .bloc');

// little search engine to filter the tools
function filtertools() {
	// split words of query in array[]
	var q = searchbox.value.toLowerCase().split(" ");

	// for each tool
	for (var i=0, len = listtools.length ; i<len ; i++) {
		var isfound = true;

		// for each word in query
		for (var j=0, lenj = q.length ; (j<lenj) && (isfound == true) ; j++) {
			// tests if $word is in $tool.description
			if (listtools[i].dataset.description.indexOf(q[j]) == -1) {
				isfound = false;
			}
		}

		// if $word not found, hide the block
		if (isfound == false) {
			listtools[i].style.display = 'none';
		// else show it (this is need to redisplay a block for a second query, as tools might’ve been hidden)
		} else {
			listtools[i].style.display = 'inline-block';
		}
	}

}


searchbox.addEventListener('keyup', filtertools, false);


</script>


<!--

# adresse de la page : http://lehollandaisvolant.net/tout/tools/
#      page créée le : 15 mars 2013
#     mise à jour le : 30 mars 2017

-->
</body>
</html>