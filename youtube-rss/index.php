<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Retrouver un flux RSS de YouTube." />

	<title>Retrouver un flux RSS Youtube - le hollandais volant</title>

	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

.main-form p {
	margin: 50px 0;
}

.main-form .text {
	width: 100%;
	border: 1px solid silver;
	background: #fff;
	box-shadow: 3px 3px 5px silver;
	padding: 10px;
	margin: 0;
	text-align: left;
}

#urlflux {
	color: black;
}

	</style>
</head>
<body>

<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Retrouver un flux RSS Youtube</a></p>
</header>


<section id="main-form" class="main-form">

<p><label for="urlchaine">Entrez l’URL de la chaîne Youtube :</label><br/>
<input class="text" type="url" id="urlchaine" required size="50" placeholder="https://www.youtube.com/channel/…" /></p>

<p><button id="trouver" class="button button-submit">Obtenir le flux RSS</button></p>

<p><label for="urlflux" >Récupérez le flux RSS :</label><br />
<input class="text" type="url" id="urlflux" size="50" /></p>





<div class="notes centrer">
	<p>Les formats d’URL de chaîne qui fonctionnent sont les deux suivants :</p>
	<pre>https://www.youtube.com/<b>channel/UCENv8pH4LkzvuSV_qHIcslg</b>
https://www.youtube.com/<b>user/cestpassorcierftv/</b>featured</pre>
</div>

</section>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script>
'use strict'

document.getElementById('trouver').addEventListener('click', function(){
	var urlchaine = document.getElementById('urlchaine').value;
	if (urlchaine == '') return;
	if (urlchaine.split('channel/')[1]) {
		var channel = "channel_id=" + (urlchaine.split('channel/')[1]).split('/')[0];
	} else {
		channel = "user=" + (urlchaine.split('user/')[1]).split('/')[0];
	}
document.getElementById('urlflux').value="https://www.youtube.com/feeds/videos.xml?" + channel;
	return false;
});


</script>
<!--

# adresse de la page : http://lehollandaisvolant.net/tout/tools/youtube-rss
#      page créée le : 25 novembre 2018
#     mise à jour le : 25 novembre 2018

-->
</body>
</html>