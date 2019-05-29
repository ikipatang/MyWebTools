<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Supprimer la transparence d’une image." />

	<title>Supprimer le canal alpha d’une image - le hollandais volant</title>

	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

#main-form {
	text-align: center;
}

#dlimg img {
	margin: 10px;
	width: 250px;
	max-width: 100%;
	
	background: url(data:image/gif;base64,R0lGODdhEAAQAIACAGZmZpmZmSwAAAAAEAAQAAACH4RvoauIzNyBSyYaLMDZcv15HAaSIlWiJ5Sya/RWVgEAOw==);
	border: 1px solid silver;
}

#my-image {
	max-width: 100%;
	background: url(data:image/gif;base64,R0lGODdhEAAQAIACAGZmZpmZmSwAAAAAEAAQAAACH4RvoauIzNyBSyYaLMDZcv15HAaSIlWiJ5Sya/RWVgEAOw==);
}
	

#drop {
	border: 1px dashed gray;
	display: block;
	line-height: 50px;
	background: #eee;
	width: 400px;
	max-width: 100%;
	border-radius: 2px;
	margin: 0 auto;
	cursor: pointer;
}

#drop:hover {
	background: #ddd;
}

#drop input {
	display: none;
}


#capture {
	margin: 30px auto;
	width: auto;
}

	</style>
</head>
<body>

<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Supprimer le canal alpha</a></p>
</header>

<section id="main-form" class="main-form">

<p><img src="moon.png" alt="" id="my-image"></p>

<label id="drop" ondragover="event.preventDefault();" ondrop="handleDrop(event);"><span>Sélectionnez ou glissez un fichier ici</span><input id="file" type="file" onchange="handleSelect(this.files)" /></label>

<button onclick="snapshot();" id="capture" class="centrer button button-submit" style="">Supprimer la transparence</button>

<div id="dlimg"></div>


<div class="notes centrer">
	<p>Pour retoucher une image plus en profondeur <a href="../toshop/">utilisez cet autre outil</a>.</p>
</div>

</section>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script>
'use strict'

var image = document.getElementById('my-image');

function snapshot() {
	// get the $element that will contain or snapshots
	var listImgs = document.getElementById('dlimg');

	// the outside link
	var a = listImgs.appendChild(document.createElement("a"));
		var time = new Date;
		a.download="photo-"+(time.getTime()/1000)+".png";
		a.href = "#";
		a.title = "Cliquez pour télécharger le fichier !";
		a.addEventListener('click', function(){a.href = img.src;}, false);

	// the new image
	var img = a.appendChild(document.createElement("img"));

	// insert it before the others
	listImgs.insertBefore(a, listImgs.getElementsByTagName("a")[0]);



	// canvas to work with and make the image
	var canvas = document.createElement('canvas'), context;

	// get sizes of source image
	var SrcImgW = image.naturalWidth;
	var SrcImgH = image.naturalHeight;
	// put them on canvas
	canvas.width = SrcImgW;
	canvas.height = SrcImgH;

	// create canvas
	var ctx = canvas.getContext('2d');

	// fill with plain white
	ctx.fillStyle = "rgba(255, 255, 255, 1)";
	ctx.fillRect(0, 0, canvas.width, canvas.height);

	// place image on top of white background
	ctx.drawImage(image, 0, 0, SrcImgW, SrcImgH, 0, 0, SrcImgW, SrcImgH);
	img.src = canvas.toDataURL('image/png');
}



/* Drag & Drop handler */
function handleDrop(event) {
	event.preventDefault();

	// list of files droped
	var filelist = event.dataTransfer.files;
	if (!filelist || !filelist.length) return false;
	// keep only the first file
	var dropimage = filelist[0];
	// detects if file is an image
	if (!dropimage.type.match('image.*')) {
		return false;
	}
	// get the data of the file 
	var reader = new FileReader();
	reader.onload = function() {
		var dataURL = reader.result;
		image.src = dataURL;
		document.querySelector('#drop span').innerHTML = escape(dropimage.name);
	}
	reader.readAsDataURL(dropimage);
}

/* Manual selection handler */
function handleSelect(filelist) {
	// keep only the first file
	var selImage = filelist[0];

	var reader = new FileReader();
	reader.onload = function() {
		var dataURL = reader.result;
		image.src = dataURL;
		document.querySelector('#drop span').innerHTML = escape(selImage.name);
	}
	reader.readAsDataURL(selImage);
}

</script>
<!--

# adresse de la page : https://lehollandaisvolant.net/tout/tools/alpha/
#      page créée le : 7 février 2017
#     mise à jour le : 7 février 2017

-->
</body>
</html>