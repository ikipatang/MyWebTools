<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Générer une ligne de commande FFMpeg" />

	<title>Générer une commande FFMpeg - le hollandais volant</title>

	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

.main-form {
	max-width: 600px;
}

input, select, label {
	vertical-align: middle;
	line-height: 1;
}

input:invalid {
	color: red;
}

.param-section {
	border: 1px solid silver;
	padding: 10px;
	margin: 10px;
}

.param-section p {
	padding: 5px 0;
}

.param-section input[type="text"] {
	width: 150px;
	margin: 0 1em;
}

#video-yes:not(.visible),
#cut-yes:not(.visible),
#v-dims:not(.visible),
#audio-yes:not(.visible) {
	display: none;
}


	</style>
</head>
<body>

<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Générer une commande FFMpeg</a></p>
</header>

<section id="main-form" class="main-form">

	<div class="param-section" id="params-main">

		<p><label for="input-file">Nom du fichier d’entrée :</label>
			<input required type="text" id="input-file" value="input.mp4" placeholder="input.mp4" /></p>

		<p><label for="output-file">Nom du fichier de sortie :</label>
			<input required type="text" id="output-file" value="output.mp4" placeholder="output.mp4" /></p>
	</div>

	<div class="param-section" id="params-cut">
		<p><label for="media-cut">Extraire une portion du média : </label><input type="checkbox" id="media-cut" /></p>
		<div id="cut-yes">
			<p><label for="media-cut-begin">Début :</label><input type="text" pattern="[0-9]{1,}:[0-9]{2}:[0-9]{2}(\.[0-9]{3})?" id="media-cut-begin" value="00:00:00.000" placeholder="00:00:00.000" /></p>
			<p><label for="media-cut-end">Fin (ou laissez vide) :</label><input type="text" pattern="[0-9]{1,}:[0-9]{2}:[0-9]{2}(\.[0-9]{3})?" id="media-cut-end" value="" placeholder="00:03:14.159" /></p>
		</div>
	</div>


	<div class="param-section" id="params-video">

		<p><label for="v-activate">Activer l’image :</label><input type="checkbox" id="v-activate" /></p>

		<div id="video-yes">
			<p><label for="v-codec">Codec vidéo :</label>
				<select id="v-codec">
					<option value="copy">Identique à l’original</option>
					<option value="flv1">Flash (flv1)</option>
					<option value="libxh264">H.264 (libxh264)</option>
					<option value="libtheora">Theora (libtheora)</option>
					<option value="libvpx">VP8 (libvpx)</option>
					<option value="libvpx-vp9">VP9 (libvpx-vp9)</option>
					<!--<option value="-1">Autre (à préciser)</option>-->
				</select>
			</p>
			<p><label for="v-bitrate">Débit vidéo (ou laissez vide) :</label><input type="text" id="v-bitrate" value="" placeholder="1500k, 2M…" /></p>


			<div class="param-section" id="params-video-resize">
				<p><label for="v-change-dimensions">Modifier la dimension de l’image : </label><input type="checkbox" id="v-change-dimensions" /></p>
				<div id="v-dims">
					<p><label for="v-dims-w">Largeur, en px (ou -1 pour auto):</label><input type="text" id="v-dims-w" value="" placeholder="1280" /></p>
					<p><label for="v-dims-h">Hauteur, en px (ou -1 pour auto):</label><input type="text" id="v-dims-h" value="" placeholder="720" /></p>
				</div>
			</div>
		</div>


	</div>

	<div class="param-section" id="params-audio">

		<p><label for="a-activate">Activer le son :</label><input type="checkbox" id="a-activate" /></p>

		<div id="audio-yes">
			<p><label for="a-codec">Codec audio :</label>
				<select id="a-codec">
					<option value="copy">Identique à l’original</option>
					<option value="aac">AAC (aac)</option>
					<option value="flac">FLAC (flac)</option>
					<option value="libmp3lame">MP3 (libmp3lame)</option>
					<option value="libopus">Opus (libopus)</option>
					<option value="libvorbis">Vorbis (libvorbis)</option>
					<!--<option value="-1">Autre (à préciser)</option>-->
				</select>
			</p>

			<p><label for="a-bitrate">Débit audio (ou laissez vide) :</label><input type="text" id="a-bitrate" value="" placeholder="128k, 320k…" /></p>
		</div>
	</div>


	<p><button type="button" id="compute">Générer la ligne de commande</button></p>

	<p><input type="text" id="output" value=""/></p>





</section>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script>
'use strict'

// switches (checkbox)
document.getElementById('media-cut').addEventListener('change', function() {
	if (this.checked) {
		document.getElementById('cut-yes').classList.add('visible');
	} else {
		document.getElementById('cut-yes').classList.remove('visible');
	}
});

document.getElementById('v-activate').addEventListener('change', function() {
	if (this.checked) {
		document.getElementById('video-yes').classList.add('visible');
	} else {
		document.getElementById('video-yes').classList.remove('visible');
	}
});

document.getElementById('v-change-dimensions').addEventListener('change', function() {
	if (this.checked) {
		document.getElementById('v-dims').classList.add('visible');
	} else {
		document.getElementById('v-dims').classList.remove('visible');
	}
});

document.getElementById('a-activate').addEventListener('change', function() {
	if (this.checked) {
		document.getElementById('audio-yes').classList.add('visible');
	} else {
		document.getElementById('audio-yes').classList.remove('visible');
	}
});



document.getElementById('compute').addEventListener('click', function() {

	var codeLine = 'ffmpeg';
	// input name
	codeLine = codeLine + ' -i "' + document.getElementById('input-file').value +'"';

	// begin time
	if (document.getElementById('media-cut').checked && document.getElementById('media-cut-begin').value !=='' ) {
		codeLine = codeLine + ' -ss ' + document.getElementById('media-cut-begin').value;
	}
	// end time
	if (document.getElementById('media-cut').checked && document.getElementById('media-cut-end').value !=='' ) {
		codeLine = codeLine + ' -to ' + document.getElementById('media-cut-end').value;
	}

	// video
	if (document.getElementById('v-activate').checked) {
		// video codec
		codeLine = codeLine + ' -c:v ' + document.getElementById('v-codec').value;

		// video bitrate
		if (document.getElementById('v-bitrate').value !== '') {
			codeLine = codeLine + ' -b:v ' + document.getElementById('v-bitrate').value;
		}

		if (document.getElementById('v-change-dimensions').checked) {
			codeLine = codeLine + ' -vf scale=' + document.getElementById('v-dims-w').value + ':' + document.getElementById('v-dims-h').value;
		}

	}
	else {
		codeLine = codeLine + ' -vn ';
	}


	// audio
	if (document.getElementById('a-activate').checked) {
		// audio codec
		codeLine = codeLine + ' -c:a ' + document.getElementById('a-codec').value;

		// audio bitrate
		if (document.getElementById('a-bitrate').value !== '') {
			codeLine = codeLine + ' -b:a ' + document.getElementById('a-bitrate').value;
		}

	}
	else {
		codeLine = codeLine + ' -an ';
	}


	// output file
	codeLine = codeLine + ' "' + document.getElementById('output-file').value + '"';


	// print output
	document.getElementById('output').value = codeLine;
	console.log(codeLine);

});



</script>
<!--

# adresse de la page : https://lehollandaisvolant.net/tout/tools/ffmpeg/
#      page créée le : 3 avril 2019
#     mise à jour le : 12 mai 2019

-->
</body>
</html>
