
<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />	<meta name="description" content="Afficher sur une seule page les informations relatives à votre navigateur : IP, Navigateur, version, système d'exploitation, cookies, javascript" />
	<title>Trouver les informations de votre navigateur - le hollandais volant</title>
	<link rel="stylesheet" href="../0common/common.css"/>
	<style type="text/css">

#results {
	min-width: 300px;
	width: 70%;
	max-width: 700px;
	margin: 0 auto 50px;
}

.info-block {
	display: inline-block;
	width: 300px;
	height: 110px;
	overflow: hidden;
	margin: 5px;
	background-color: #f7f7f7;
	background-image: -webkit-linear-gradient(top, #f7f7f7, #e7e7e7); 
	background-image: -moz-linear-gradient(top, #f7f7f7, #e7e7e7); 
	background-image: -ms-linear-gradient(top, #f7f7f7, #e7e7e7); 
	background-image: -o-linear-gradient(top, #f7f7f7, #e7e7e7); 
	background-image: linear-gradient(top, #f7f7f7, #e7e7e7); 
	border-radius: 10px;
	position: relative;
	text-shadow: 0px 1px 0 white;
	box-shadow: 0px 3px 8px #aaa, inset 0px 2px 3px #fff;
}
.info-block h2 {
	font-size: 105%;
	margin-top: 23px;
	text-align: left;
	margin-left: 72px;
	color: #222;
}

.info-block .icon {
	border-right: 1px solid white;
	float: left;
	height: 110px;
	line-height: 110px;
	width: 65px;
	margin:0;
	box-shadow: 1px 0 0px #ccc;
}

.info-block .icon img {
	vertical-align: middle;
	max-height: 48px;
	max-width: 48px;
}

.info-block .text {
	margin-top: -5px;
	text-align: left;
	margin-left: 75px;
	color: #444;
	position: absolute;
	right: 0;
	width: 225px;
}

.small {
	font-size: 70%;
	line-height: 1em;
	overflow: hidden;
	width: 235px;
}

.notes {
	padding-top: 30px;
	font-size: 70%;
}

.share-this {
	margin-top: 30px;
	font-size: 80%;
}

.share-this input {
	border: 1px solid silver;
	padding: 3px;
	background: white;
	color: black;
	border-radius: 4px;
	box-shadow: 1px 1px 3px silver inset;
	width: 250px;
}


/* audio codecs list */

#audiocodecs-list {
	display: block;
	margin: 0;
	margin-top: -5px;
	padding: 0;
	font-size: 0;

}
#audiocodecs-list li {
	font-size: 0.8rem;
	display: inline-block;
	width: 55px;
	margin: 0;
	padding-left: 20px;
}

.unknown {
	background: url(icons/question.png) no-repeat left center;
}
.error {
	background: url(icons/cross.png) no-repeat left center;
}
.success {
	background: url(icons/tick.png) no-repeat left center;
}
	</style>
</head>
<body>


<header id="header">
	<h1 class="titre">Trouver les informations de votre navigateur</h1>
</header>

<section id="results">

<div id="audiocodecs" class="info-block">
	<p class="icon"><img src="icons/audio-x-generic.png" alt="Les codecs supportés"/></p>
	<h2>Codecs Audio</h2>
	<ul id="audiocodecs-list" class="text">
		<li class="unknown" id="c-audio">&lt;audio/&gt;</li>
		<li class="unknown" id="c-opus">Opus</li>
		<li class="unknown" id="c-weba">WebA</li>
		<li class="unknown" id="c-ogg">Ogg</li>
		<li class="unknown" id="c-mp3">MP3</li>
		<li class="unknown" id="c-flac">Flac</li>
		<li class="unknown" id="c-aac">AAC</li>
		<li class="unknown" id="c-wave">Wave</li>
		<li class="unknown" id="c-wma">WMA</li>
	</ul>
</div>



<p class="notes">Icones de <a href="http://code.google.com/p/faenza-icon-theme">Thiteum</a>, <a href="http://www.iKingyo.com">Kingyo</a>, <a href="http://linux.softpedia.com/developer/Oliver-Scholtz-93.html">Oliver Sholtz</a>, <a href="http://www.iconshock.com">IconShock</a>, <a href="http://deleket.deviantart.com/">Deleket</a>, <a href="http://vsx47.deviantart.com">vsx47</a>, <a href="http://www.iconarchive.com/artist/draseart.html">draseart</a>.</p>

</section>


<footer id="footer"><a href="http://lehollandaisvolant.net/">Timo Van Neerden</a> - <a href="../">autres outils</a></footer>

<script type="text/javascript">

function checkAudioFormats() {
	var audioElement = document.createElement('audio');

	var setCompatibility = function(id, isCompatible) {
		var el = document.getElementById(id);
		el.className = (isCompatible ? 'success' : 'error');
	};

	var audioCompatible = audioElement && audioElement.canPlayType; 
	setCompatibility('c-audio', audioCompatible);
	setCompatibility('c-opus', audioElement && audioElement.canPlayType && audioElement.canPlayType('audio/ogg; codecs="opus"'));
	setCompatibility('c-weba', audioElement && audioElement.canPlayType && audioElement.canPlayType('audio/webm'));
	setCompatibility('c-ogg', audioElement && audioElement.canPlayType && audioElement.canPlayType('audio/ogg; codecs="vorbis"'));
	setCompatibility('c-mp3', audioElement && audioElement.canPlayType && audioElement.canPlayType('audio/mpeg'));
	setCompatibility('c-flac', audioElement && audioElement.canPlayType && audioElement.canPlayType('audio/flac'));
	setCompatibility('c-aac', audioElement && audioElement.canPlayType && audioElement.canPlayType('audio/aac'));
	setCompatibility('c-wave', audioElement && audioElement.canPlayType && audioElement.canPlayType('audio/wav'));
	setCompatibility('c-wma', audioElement && audioElement.canPlayType && audioElement.canPlayType('audio/wma'));
}
checkAudioFormats();

</script>

<!--

# adresse de la page : http://lehollandaisvolant.net/tout/tools/browser/
#      page créée le : 5 mars 2013
#     mise à jour le : 27 avril 2014

-->
</body>
</html>
