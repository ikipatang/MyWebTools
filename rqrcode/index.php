<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Un lecteur de QR Code en Javascript et HTML. Il fonctionne avec la Webcam (avec WebRTC) et avec un fichier d’entrée." />
	<title>Lire un QRcode™ - le hollandais volant</title>
	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

p.buttons {
	text-align: center;
}

p.buttons .button {
	padding: 20px;
	margin: 5px;
	font-size: 110%;
}
#result {
	margin: 20px;
	padding: 10px;
	border: 1px solid silver;
	background: #eee;
	border-radius: 15px;
	word-break: break-all;
}

#select-infile {
	background: rgba(0, 0, 0, .06);
	border-radius: 2px;
	text-align: center;
	padding: 5px;
}

#outputimg {
	max-width: 500px;
	height: auto;
	margin: 15px auto;

}

	</style>
</head>
<body>
<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Décoder un QR Code™</a></p>
</header>



<div id="main-form" class="main-form">
	<div id="mainbody">
		<p class="buttons">
			<button onclick="setimg();" class="button button-submit">À partir d’un fichier</button>
			<button onclick="setwebcam();" class="button button-submit">Avec la webcam</button>
		</p>

		<div id="select-infile" style="display:none;">
			<img id="outputimg" class="centrer" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="read"/>
			Sélectionnez un fichier<br/><input type="file" id="getFromFileInput" />
		</div>

		<div id="video-preview" class="centrer" style="display:none;"><video id="v" autoplay style="height: 320px;"></video></div>

		<div id="result" contenteditable style="display: none;">Le résultat sera affiché ici.</div>

	</div>
	<div id="debug"></div>
	<div class="notes centrer">
		<a href="http://www.denso-wave.com/qrcode/faqpatent-e.html">QR Code™</a> - <a href="https://github.com/LazarSoft/jsqrcode">Généré avec JS-QRcode</a>
	</div>
</div>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script type="text/javascript" src="qrdecodecode.js"></script>

<script>

var gCtx = null;
var gCanvas = null;
var imageData = null;
var c = 0;
var stype = 0;
var gUM = !1;
var v = null;

function handleFile() {
	var a = this.files;
	var d = new FileReader;
	d.onload = function () {
		return function (a) {
			gCtx.clearRect(0, 0, gCanvas.width, gCanvas.height), qrcode.decode(a.target.result)
		}
	// read given file as base64 data.
	}(a[0]);
	d.readAsDataURL(a[0]);
}


  document.getElementById('getFromFileInput').addEventListener('change', handleFile);


function initCanvas(a, b) {
	gCanvas = document.createElement("canvas");
	var c = a, d = b;
	gCanvas.style.width = c + "px", gCanvas.style.height = d + "px", gCanvas.width = c, gCanvas.height = d, gCtx = gCanvas.getContext("2d"), gCtx.clearRect(0, 0, c, d), imageData = gCtx.getImageData(0, 0, 320, 240)
}

function passLine(a) {
	for (var d = a.split("-"), e = 0; 320 > e; e++) {
		var f = parseInt(d[e]);
		r = 255 & f >> 16, g = 255 & f >> 8, b = 255 & f, imageData.data[c + 0] = r, imageData.data[c + 1] = g, imageData.data[c + 2] = b, imageData.data[c + 3] = 255, c += 4
	}
	if (c >= 307200) {
		c = 0, gCtx.putImageData(imageData, 0, 0);
		try {
			qrcode.decode()
		} catch (h) {
			console.log(h), setTimeout(captureToCanvas, 500)
		}
	}
}

function captureToCanvas() {
	if (stype == 1) if (gUM) {
		gCtx.drawImage(v, 0, 0);
		try {
			qrcode.decode();
		} catch (a) {
			console.log(a), setTimeout(captureToCanvas, 100)
		}
	}
}

function htmlEntities(a) {
	return (a + "").replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/ ?>/g, "&gt;").replace(/"/g, "&quot;");
}

function read(a) {
	document.getElementById("result").innerHTML = a
}

function isCanvasSupported() {
	var a = document.createElement("canvas");
	return !(!a.getContext || !a.getContext("2d"))
}
function error() {
	gUM = false;
}

function load() {
	isCanvasSupported() && window.File && window.FileReader ? (initCanvas(800, 600), qrcode.callback = read) : (document.getElementById("debug").innerHTML = 'Désolé, votre navigateur est incompatible (essayez avec Opera, Firefox ou Chromium.');
}

function setwebcam() {
	document.getElementById("select-infile").style.display= "none";
	document.getElementById("result").style.display= "block";
	document.getElementById('video-preview').style.display = 'block';
	if (document.getElementById("result").innerHTML = "", stype == 1) {
		setTimeout(captureToCanvas, 500);	
		return;
	}

	// for WEBRTC
	var constraints = { audio: false, video: { width: 1280, height: 720 } };
	v = document.getElementById("v");


	navigator.mediaDevices.getUserMedia(constraints).then(function(mediaStream) {
		v.srcObject = mediaStream;
		gUM = true;
		setTimeout(captureToCanvas, 100);
	})
	.catch(function(err) { console.log(err.name + ": " + err.message); });


	stype = 1;
//	setTimeout(captureToCanvas, 100);
}


function setimg() {
	document.getElementById('video-preview').style.display = 'none';
	document.getElementById("result").style.display= "block";

	if (document.getElementById("result").innerHTML = "", stype != 2) {
		document.getElementById("select-infile").style.display= "block";
	}
}

/*function seturl() {
	if (document.getElementById("result").innerHTML = "", stype != 2) {
		document.getElementById("outdiv").innerHTML = imgurl;
	}
}*/

load();
</script>
</body>
</html>