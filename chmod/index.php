<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Un calculateur de chmod en JS" />
	<title>Calculer un Chmod - le hollandais volant</title>
	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

.ugo-perm p,
.spec-perm p,
.output p {
	display: flex;
	justify-content: center;
	align-items: center;
}
.ugo-perm span {
	width: 120px;
	text-align: right;
	padding-right: 20px;
}
.ugo-perm label {
	padding-right: 15px;
}

.spec-perm {
	margin-top: 45px;
}

.spec-perm p label {
	width: 185px;
	text-align: left;
}


input[type=checkbox] {
	position:absolute;
	z-index:-1000;
	left:-1000px;
	overflow: hidden;
	clip: rect(0 0 0 0);
	height:1px;
	width:1px;
	margin:-1px;
	padding:0;
	border:0;
}

input[type=checkbox] + label {
	padding-left:25px;
	height:20px; 
	background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAoAgMAAACDXzJIAAAACVBMVEX/AABmZma7u7uONy94AAAAAXRSTlMAQObYZgAAAD5JREFUCNdjWAUCDBByAQMDAxcNSWS7iLSXBUgKMIgCyRCGUCAZyhgCJEVdA4Aka6gDkGQMBasMAZMChOwFAFbLM0t/GQZyAAAAAElFTkSuQmCC);
	background-repeat:no-repeat;
	background-position: 0 0;
	vertical-align:middle;
	cursor:pointer;

}

input[type=checkbox]:checked + label {
	background-position: 0 -20px;
}


.output {
	width: 350px;
	background: rgba(100, 100, 100, .1);
	box-shadow: 0px 1px 4px rgba(0, 0, 0, .3);
	border-radius: 2px;
	padding: 20px;
	margin: 45px auto;
	box-sizing: border-box;
}
.output span {
	width: 150px;
	text-align: right;
	padding-right: 10px;
	background: rgba(100, 100, 100, .1);
	line-height: 2rem;
}

.output span+span{
	text-align: left;
	font-family: monospace;
}

.spec-perm label,
.spec-perm a {
		vertical-align: middle;

}
.spec-perm a {
	position: relative;
	color: blue;
	outline: none;
}
.spec-perm a span {
	display: none;
	background: rgba(0, 0, 0, .8);
	color: white;
	width: 300px;
	left: 0px;
	top: 0;
	padding: 10px;
	border-radius: 3px;
}

.spec-perm a:focus span {
	display: block;
	position: absolute;
}

	</style>
</head>
<body>

<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Calculer un Chmod</a></p>
</header>

<section id="main-form" class="main-form" onchange="findMod()">

<div class="ugo-perm">
	<p>
		<span>Propriétaire :</span>
		<input type="checkbox" checked id="ur" /><label for="ur">Lecture</label>
		<input type="checkbox" checked id="uw" /><label for="uw">Écriture</label>
		<input type="checkbox"         id="ux" /><label for="ux">Execution</label>
	</p>

	<p>
		<span>Groupe :</span>
		<input type="checkbox" checked id="gr" /><label for="gr">Lecture</label>
		<input type="checkbox"         id="gw" /><label for="gw">Écriture</label>
		<input type="checkbox"         id="gx" /><label for="gx">Execution</label>
	</p>

	<p>
		<span>Autres :</span>
		<input type="checkbox" checked id="or" /><label for="or">Lecture</label>
		<input type="checkbox"         id="ow" /><label for="ow">Écriture</label>
		<input type="checkbox"         id="ox" /><label for="ox">Execution</label>
	</p>
</div>

<div class="spec-perm">
	<p><input type="checkbox" id="uid" /><label for="uid">Forcer l’ID utilisateur<a href="#"><sup> [?]</sup><span>Pour les exécutables : permet d'allouer à l’utilisateur et durant l’exécution, les droits du propriétaire du fichier.</span></a></label></p>
	<p><input type="checkbox" id="gid" /><label for="gid">Forcer l’ID groupe<a href="#"><sup> [?]</sup><span>Pour les exécutables : permet d'allouer à l’utilisateur et durant l’exécution, les droits du groupe du fichier.</span></a></label></p>
	<p><input type="checkbox" id="s" /><label for="s">Sticky<a href="#"><sup> [?]</sup><span>Pour les non-propriétaires d’un répertoire, empêche la suppression des fichiers en conservant, s’ils y sont, les droits de modification.</span></a></label></p>
</div>


<div class="output">
	<p><span>Chmod numéral :</span><span id="numeral"></span></p>
	<p><span>Chmod littéral :</span><span id="litteral"></span></p>
</div>

</section>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script>
/* <![CDATA[ */
'use strict'

function findMod() {
	var boxes = [
		{n: "ur", v: document.getElementById('ur').checked, d: 400},
		{n: "uw", v: document.getElementById('uw').checked, d: 200},
		{n: "ux", v: document.getElementById('ux').checked, d: 100},
		{n: "gr", v: document.getElementById('gr').checked, d: 40},
		{n: "gw", v: document.getElementById('gw').checked, d: 20},
		{n: "gx", v: document.getElementById('gx').checked, d: 10},
		{n: "or", v: document.getElementById('or').checked, d: 4},
		{n: "ow", v: document.getElementById('ow').checked, d: 2},
		{n: "ox", v: document.getElementById('ox').checked, d: 1},
	 ];

	var textView = "";

	for (var i = 0, litChmod = "", numChmod = 0 ; i < 9 ; i++) {
		litChmod += (true === boxes[i].v) ? (boxes[i].n).substr(1,1) : '-';
		numChmod += (true === boxes[i].v) ? boxes[i].d : 0;
	}

	// force UID
	if (document.getElementById('uid').checked) {
		litChmod = litChmod.substr(0, 2) + ((true === boxes[2].v ) ? 's' : 'S') + litChmod.substr(2 + 1);
	}
	// force GID
	if (document.getElementById('gid').checked) {
		litChmod = litChmod.substr(0, 5) + ((true === boxes[5].v ) ? 's' : 'S') + litChmod.substr(5 + 1);
	}
	// sticky
	if (document.getElementById('s').checked) {
		litChmod = litChmod.substr(0, 8) + ((true === boxes[8].v ) ? 't' : 'T') + litChmod.substr(8 + 1);
	}

	document.getElementById('numeral').textContent = String("000" + numChmod).slice(-3); //;
	document.getElementById('litteral').textContent = litChmod;
}

findMod();

/* ]]> */
</script>
<!--

# adresse de la page : http://lehollandaisvolant.net/tout/tools/chmod/
#      page créée le : 6 décembre 2015
#     mise à jour le : 6 décembre 2015

-->
</body>
</html>