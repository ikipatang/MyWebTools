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
<html lang="fr-fr" manifest="timo.webcam.manifest">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Une page HTML5 qui prend des photos avec votre webcam" />
	<title>Prendre une photo avec la webcam - le hollandais volant</title>
	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

#basic-stream {
	max-width: 480px;
	max-height: 360px;
	width: 98%;
	margin: 0 auto;
	display: block;
	
	background-color: gray;
}

.p-submit {
	text-align: center;
}

#screenshots img {
	width: 50%;
	box-sizing: border-box;
	height: auto;
	border: 5px solid silver;
}



	</style>
</head>
<body>

<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Prendre une photo avec la webcam</a></p>
</header>

<section id="main-form" class="main-form">
	<video id="basic-stream" onplay="controlVideo('start')" controls="true"></video>
	<p class="p-submit"><button onclick="snapshot();" id="capture" class="button button-submit">Prendre une photo</button></p>
	<div id="screenshots"></div>
	<p class="notes">Cette page utilise HTML5, Web RTC et une webcam.<br/><span style="font-size: 80%">Aucun image n’est envoyée ou conservée sur le réseau.</span></p>
</section>


<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>


<script>
/* <![CDATA[ */

/*
 *   Shows the video
 * + allow begin and stoping the flow
 * + detects brwoser capability (moz/webkit/normal).
 *
*/
var localStream = null;
var video = document.getElementById('basic-stream');

function getStream(stream) {
	video.src = stream;
	localStream = stream;
}

function controlVideo(videoEvent) {
	var video = document.getElementById('basic-stream');
	// start video capture and send it to <video> element.
	// if this is not the first clic, the embed player only pauses it.

	if (localStream == null && videoEvent == 'start') {
		var constraints = { audio: false, video: { width: 1280, height: 720 } };
		navigator.mediaDevices.getUserMedia(constraints).then(function(mediaStream) {
			video.srcObject = mediaStream;
		})
		.catch(function(err) { console.log(err.name + ": " + err.message); });
	}
}


/*
 * This is for the screen shot.
 * It takes a picture and place it in an "img" element.
 * 
*/

function snapshot() {
	// canvas to work with and make the image
	var canvas = document.createElement('canvas');
	var context = canvas.getContext('2d');
	// list of the snapshots
	var listImgs = document.getElementById('screenshots');
	// the outside link
	var a = listImgs.appendChild(document.createElement("a"));
		var time = new Date;
		a.download="photo-"+(time.getTime()/1000)+".png";
		a.href = "#";
		a.addEventListener('click', function(){a.href = img.src;}, false);

	// the new image
	var img = a.appendChild(document.createElement("img"));

	// insert it before the others
	listImgs.insertBefore(a, listImgs.getElementsByTagName("a")[0]);

	canvas.width = video.videoWidth;
	canvas.height = video.videoHeight;
	img.height = video.videoHeight;
	img.width = video.videoWidth;

	// 'if' tests if canvas created using the dimentions
	// of the video. If video hasn’t been started yet, dimensins are 0x0
	// and snapshots are impossible.
	if (0 != canvas.width*canvas.height) {
		context.drawImage(video, 0, 0);
		img.src = canvas.toDataURL('image/webp');
		canvas = null;
	}
}

window.addEventListener("load", function() { video.play(); }); 

/* ]]> */
</script>
<!--

# adresse de la page : http://lehollandaisvolant.net/tout/tools/webcam/
#      page créée le : 12 mars 2013
#     mise à jour le : 04 avril 2013

-->
</body>
</html>