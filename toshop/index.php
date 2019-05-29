<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Retoucher des images en HTML5 et les filtres CSS3." />

	<title>Retoucher une image - le hollandais volant</title>

	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

#capture {
	width: 250px;
}


input[type=range] {
	background-color: white;
	width: 250px;
	cursor: ew-resize;
}

p.parameter {
	text-align: center;
}

p.parameter * {
	vertical-align: middle;
}

p.parameter label {
	display: inline-block;
	width: 100px;
	text-align: right;
}

p.parameter output {
	display: inline-block;
	width: 50px;
}

p.parameter button.button-other {
	box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
}

#dlimg {
	text-align: center;
	margin-top: 40px;
}
#dlimg img {
	margin: 10px;
	width: 250px;
}

#my-image {
	max-width: 100%;
	display: block;
	margin: auto;
}

#drop {
	border: 1px dashed gray;
	display: block;
	height: 50px;
	line-height: 50px;
	background: #eee;
	width: 400px;
	border-radius: 2px;
	margin: 0 auto;
	text-align: center;
	cursor: pointer;
}

#drop:hover {
	background: #ddd;
}

#drop input {
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
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Retoucher une image</a></p>
</header>


<section id="main-form" class="main-form">

<p><img src="image.jpg" alt="" id="my-image"></p>

<label id="drop" ondragover="event.preventDefault();" ondrop="handleDrop(event);"><span>Sélectionnez ou glissez un fichier ici</span><input id="file" type="file" onchange="handleSelect(this.files)" /></label>


<p class="parameter">
	<label for="blur">Blur</label>
	<input type="range" min="0" max="100" value="0" id="blur" step="1" oninput="outputUpdate(value, 'blur',  'px')">
	<output for="blur" id="blur-out"></output>
	<button type="button" class="button button-other" onclick="document.querySelector('#blur').value = 0; outputUpdate(0, 'blur', 'px')">Reset</button>
</p>


<p class="parameter">
	<label for="brightness">Brightness</label>
	<input type="range" min="0" max="10" value="1" id="brightness" step=".01" oninput="outputUpdate(value, 'brightness', '')">
	<output for="brightness" id="brightness-out"></output>
	<button type="button" class="button button-other" onclick="document.querySelector('#brightness').value = 1; outputUpdate(1, 'brightness', '')">Reset</button>
</p>


<p class="parameter">
	<label for="contrast">Contrast</label>
	<input type="range" min="0" max="10" value="1" id="contrast" step=".1" oninput="outputUpdate(value, 'contrast', '')">
	<output for="contrast" id="contrast-out"></output>
	<button type="button" class="button button-other" onclick="document.querySelector('#contrast').value = 1; outputUpdate(1, 'contrast', '')">Reset</button>
</p>


<p class="parameter">
	<label for="grayscale">Grayscale</label>
	<input type="range" min="0" max="1" value="0" id="grayscale" step=".01" oninput="outputUpdate(value, 'grayscale', '')">
	<output for="grayscale" id="grayscale-out"></output>
	<button type="button" class="button button-other" onclick="document.querySelector('#grayscale').value = 0; outputUpdate(0, 'grayscale', '')">Reset</button>
</p>


<p class="parameter">
	<label for="hue-rotate">Hue Rotate</label>
	<input type="range" min="0" max="360" value="0" id="hue-rotate" step="1" oninput="outputUpdate(value, 'hue-rotate', 'deg')">
	<output for="hue" id="hue-rotate-out"></output>
	<button type="button" class="button button-other" onclick="document.querySelector('#hue-rotate').value = 0; outputUpdate(0, 'hue-rotate', 'deg')">Reset</button>
</p>


<p class="parameter">
	<label for="invert">Invert</label>
	<input type="range" min="0" max="1" value="0" id="invert" step=".01" oninput="outputUpdate(value, 'invert', '')">
	<output for="invert" id="invert-out"></output>
	<button type="button" class="button button-other" onclick="document.querySelector('#invert').value = 0; outputUpdate(0, 'invert', '')">Reset</button>
</p>


<p class="parameter">
	<label for="opacity">Opacity</label>
	<input type="range" min="0" max="100" value="100" id="opacity" step="1" oninput="outputUpdate(value, 'opacity', '%')">
	<output for="opacity" id="opacity-out"></output>
	<button type="button" class="button button-other" onclick="document.querySelector('#opacity').value = 100; outputUpdate(100, 'opacity', '%')">Reset</button>
</p>


<p class="parameter">
	<label for="saturate">Saturate</label>
	<input type="range" min="0" max="10" value="1" id="saturate" step=".1" oninput="outputUpdate(value, 'saturate', '')">
	<output for="saturate" id="saturate-out"></output>
	<button type="button" class="button button-other" onclick="document.querySelector('#saturate').value = 1; outputUpdate(1, 'saturate', '')">Reset</button>
</p>


<p class="parameter">
	<label for="sepia">Sepia</label>
	<input type="range" min="0" max="1" value="0" id="sepia" step=".01" oninput="outputUpdate(value, 'sepia', '')">
	<output for="sepia" id="sepia-out"></output>
	<button type="button" class="button button-other" onclick="document.querySelector('#sepia').value = 0; outputUpdate(0, 'sepia', '')">Reset</button>
</p>


<button onclick="snapshot();" id="capture" class="button button-submit centrer" style="">Sauver l’image</button>

<div id="dlimg"></div>


<div class="notes centrer">
	<p>Pour supprimer la transparence d’une image (et la remplacer par du blanc) <a href="../alpha/">utilisez cet autre outil</a>.</p>
</div>

</section>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script>
'use strict'

var image = document.getElementById('my-image');

function outputUpdate(val, effect, unit) {
	document.querySelector('#'+effect+'-out').value = val+unit;
	applyFilters();
}

function applyFilters() {
	var allFiltersStr = 'blur('+document.querySelector('#blur').value+'px) ' +
					'brightness('+document.querySelector('#brightness').value+') ' +
					'contrast('+document.querySelector('#contrast').value+') ' +
					'grayscale('+document.querySelector('#grayscale').value+') ' +
					'hue-rotate('+document.querySelector('#hue-rotate').value+'deg) ' +
					'invert('+document.querySelector('#invert').value+') ' +
					'opacity('+document.querySelector('#opacity').value+'%) ' +
					'saturate('+document.querySelector('#saturate').value+') ' +
					'sepia('+document.querySelector('#sepia').value+')';

	image.style.filter = allFiltersStr;
	image.style["-webkit-filter"] = allFiltersStr;
}

outputUpdate(document.querySelector('#blur').value, 'blur', 'px');
outputUpdate(document.querySelector('#brightness').value, 'brightness', '');
outputUpdate(document.querySelector('#contrast').value, 'contrast', '');
outputUpdate(document.querySelector('#grayscale').value, 'grayscale', '');
outputUpdate(document.querySelector('#hue-rotate').value, 'hue-rotate', 'deg');
outputUpdate(document.querySelector('#invert').value, 'invert', '');
outputUpdate(document.querySelector('#opacity').value, 'opacity', '%');
outputUpdate(document.querySelector('#saturate').value, 'saturate', '');
outputUpdate(document.querySelector('#sepia').value, 'sepia', '');




function snapshot() {
	// canvas to work with and make the image
	var canvas = document.createElement('canvas'), context;

	// if blur : need to add some size to the canvas
	var moreSize = parseInt((document.querySelector('#blur').value)*4);

	// get sizes of source image
	var SrcImgW = image.naturalWidth;
	var SrcImgH = image.naturalHeight;

	canvas.width = SrcImgW+moreSize;
	canvas.height = SrcImgH+moreSize;
	var ctx = canvas.getContext('2d');

	ctx.filter = image.style.filter;

	var listImgs = document.getElementById('dlimg');
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

	ctx.drawImage(image, 0, 0, SrcImgW, SrcImgH, moreSize/2, moreSize/2, SrcImgW, SrcImgH);
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

# adresse de la page : http://lehollandaisvolant.net/tout/tools/toshop/
#      page créée le : 8 mai 2015
#     mise à jour le : 21 juin 2015

-->
</body>
</html>