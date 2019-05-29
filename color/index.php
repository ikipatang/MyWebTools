<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Un sélecteur de couleur en JavaScript." />
	<title>Sélecteur de couleurs - le hollandais volant</title>
	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

:root {
	--saturation: 100%;
}

.main-form {
	text-align: center;
}

/* =====================
   MAIN PICKER (big square) */
#spectrum,
#satbar,
#output-preview {
	border: 1px solid black;
	width: 350px;
	margin: 0 auto;
}
#spectrum-box {
	height: 350px;
	width: 350px;
	margin: 0 auto;
	position: relative;
}
#spectrum {
	width: 100%;
	height: 100%;
	cursor: crosshair;
	/* linear-gradient(to bottom, hsla(0, 100%, 100%, 0), hsla(0, 100%, 100%, 1) 100%) */
	background: linear-gradient(to bottom, hsla(0, 100%, 100%, 1), hsla(0, 0%, 0%, 0), hsla(0, 0%, 0%, 1) 100%),
				linear-gradient(to right, hsl(0,var(--saturation), 50%), hsl(60,var(--saturation), 50%), hsl(120,var(--saturation), 50%), hsl(180, var(--saturation), 50%), hsl(240,var(--saturation),50%), hsl(300,var(--saturation),50%), hsl(360,var(--saturation),50%) 100%);
}

#pointer {
	display: inline-block;
	border: 1px solid black;
	background: transparent;
	border-radius: 50%;
	height: 4px;
	width: 4px;
	position: absolute;
	top: 50%;
	left: 50%;
	margin-left: -4px;
	margin-top: -4px;
	cursor: crosshair;
	box-shadow: 0 0 0 1px white;
}

/* =====================
   SECONDARY BAR (saturation) */

#satbar-box {
	height: 30px;
	width: 350px;
	margin: 10px auto;
	position: relative;
}

#satbar {
	height: 100%;
	width: 100%;
	background: linear-gradient(to right, hsl(0, 0%, 100%), hsl(0, 0%, 0%) 100%);
}

#pointer2 {
	display: inline-block;
	background: black;
	height: 30px;
	width: 2px;
	position: absolute;
	top: 1px;
	left: 0%;
	cursor: col-resize;
}
#pointer2::before {
	content: '';
	width: 0; 
	height: 0; 
	border-left: 5px solid transparent;
	border-right: 5px solid transparent;
	border-top: 5px solid black;
	position: absolute;
	top: -5px;
	left: -4px;

}

#pointer2::after {
	content: '';
	width: 0; 
	height: 0; 
	border-left: 5px solid transparent;
	border-right: 5px solid transparent;
	border-bottom: 5px solid black;
  	position: absolute;
  	bottom: -5px;
  	left: -4px;

}

#output-preview {
	border: 20px solid white;
	height: 70px;
	width: 120px;
	margin: 20px auto;
	background: hsl(150, var(--saturation), 50%);
}


#output-h, #output-s, #output-l,
#output-r, #output-g, #output-b,
#output-c, #output-m, #output-y, #output-k {
	width: 40px;
	padding: 5px;
}
#output-hsl, #output-rgb, #output-cmyk {
	width: 150px;
}
#output-hex {
	width: 100px;
}

	</style>
</head>
<body>

<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Sélecteur de couleurs</a></p>
</header>
<section id="main-form" class="main-form">

<div id="spectrum-box"><span id="pointer"></span><div id="spectrum"></div></div>

<div id="satbar-box"><span id="pointer2"></span><div id="satbar"></div></div>

<div id="output-preview"></div>

<p>HSL :
	<input id="output-h" type="number" min="0" max="360" class="text" value="" onchange="setColor(this)" />
	<input id="output-s" type="number" min="0" max="100" class="text" value="" onchange="setColor(this)" />
	<input id="output-l" type="number" min="0" max="100" class="text" value="" onchange="setColor(this)" />

	<input id="output-hsl" type="text" class="text" value="" onchange="setColor(this)" />
</p>
<p>RGB :
	<input id="output-r" type="number" min="0" max="255" class="text" value="" onchange="setColor(this)" />
	<input id="output-g" type="number" min="0" max="255" class="text" value="" onchange="setColor(this)" />
	<input id="output-b" type="number" min="0" max="255" class="text" value="" onchange="setColor(this)" />

	<input id="output-rgb" type="text" class="text" value="" onchange="setColor(this)" />
</p>

<p style="padding-left: 55px;">CMYK :
	<input id="output-c" type="number" min="0" max="100" class="text" value="" onchange="setColor(this)" />
	<input id="output-m" type="number" min="0" max="100" class="text" value="" onchange="setColor(this)" />
	<input id="output-y" type="number" min="0" max="100" class="text" value="" onchange="setColor(this)" />
	<input id="output-k" type="number" min="0" max="100" class="text" value="" onchange="setColor(this)" />

	<input id="output-cmyk" type="text" class="text" value="" onchange="setColor(this)" />
</p>

<p>Hexadécimal :
	<input id="output-hex" type="text" class="text" value="#00FF80" onchange="setColor(this)" />
</p>

</section>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script>
'use strict'

// MAIN COORDS / COLOR VARS
var color = {H: null, S: 100, L: null, R: null, G: null, B: null, HEX: null, C: null, M: null, Y: null, K: null};

// init initial color
window.addEventListener("load", function() {
	setColor(document.getElementById('output-hex'));
});


var picker = document.getElementById('spectrum');
pickerSizes = new Object();
var pickerSizes = {
	w: Math.round(picker.getBoundingClientRect().right - picker.getBoundingClientRect().left),
	h: Math.round(picker.getBoundingClientRect().bottom - picker.getBoundingClientRect().top)
};
var pointer = document.getElementById('pointer');
var outputPreview = document.getElementById('output-preview');

// mouse moves while clicked : update color + hide pointer.
picker.addEventListener("mousemove", function(e) {
	// only when left mouse is clicked :
	if (e.buttons === 1 || e.type == 'mouseup') {
		getColor(e);
	}

});

// mouse clicks : update color + moves pointer
picker.addEventListener("mouseup", function(e){
	// only when left mouse is clicked :
	if (e.buttons === 1 || e.type == 'mouseup') {
		getColor(e);
	}
	movePointer(e)
	pointer.style.display = 'inline-block';
});
picker.addEventListener("mousedown", function(e) {
	pointer.style.display = 'none';
});
picker.addEventListener("mouseout", function(e) {
	if (e.buttons === 1) {
		pointer.style.display = 'inline-block';
		movePointer(e);
	}
});

picker.addEventListener("mouseover", function(e) {
	if (e.buttons === 1) {
		pointer.style.display = 'none';
	}
});


// Get color from manual select (on the picker)
function getColor(e) {
	// DETECT CLICKED POSITION INSIDE BOX
	inBoxCoords = new Object();
	var inBoxCoords = {
		x: e.clientX - picker.getBoundingClientRect().left,
		y: e.clientY - picker.getBoundingClientRect().top
	};

	// HSV
	// get hue from x position
	var hue = inBoxCoords.x * 360 / pickerSizes.w;
	color.H = hue;

	// get saturation from global variable.
	var sat = color.S;

	// get luminance from y position
	var lum =  100 - inBoxCoords.y * 100 / pickerSizes.w;
	color.L = lum;

	updateOutputs();
}



function movePointer(e) {
	InBoxCoords = new Object();
	var InBoxCoords = {
		x: e.clientX - picker.getBoundingClientRect().left,
		y: e.clientY - picker.getBoundingClientRect().top
	};

	pointer.style.left = Math.min(pickerSizes.w , Math.max(1, InBoxCoords.x))+'px';
	pointer.style.top = Math.min(pickerSizes.h, Math.max(1, InBoxCoords.y))+'px';
}


// Saturation bar
var satbar = document.getElementById('satbar');
var pointer2 = document.getElementById('pointer2');

function chooseSat(e) {
	// only when left mouse is clicked :
	if (e.buttons === 1 || e.type == 'mouseup') {

		// DETECT CLICKED POSITION INSIDE BOX
		inBoxCoords = new Object();
		var inBoxCoords = {
			x: e.clientX - satbar.getBoundingClientRect().left,
			y: e.clientY - satbar.getBoundingClientRect().top
		};

		var sat = 100 - (inBoxCoords.x * 100 / pickerSizes.w);

		// MOVE CURSOR
		InBoxCoords = new Object();
		var InBoxCoords = {
			x: e.clientX - satbar.getBoundingClientRect().left,
			y: e.clientY - satbar.getBoundingClientRect().top
		};

		pointer2.style.left = Math.min(pickerSizes.w , Math.max(1, InBoxCoords.x))+'px';

		color.S = sat;

		updateOutputs();
	}
}


satbar.addEventListener("mousemove", chooseSat);
satbar.addEventListener("mouseup", function(e){
	chooseSat(e);
});



// set color on the picker from a textual input // TODO
function setColor(t) {

	// the main working color-representation is HSL
	// so we first need to get HSL colors from whatever input has been edited by user.
	switch (t.id) {

		// if we modified H, S, L or HSL, just update.
		case 'output-h':
			color.H = parseFloat(t.value);
			break;
		case 'output-s':
			color.S = parseFloat(t.value);
			break;
		case 'output-l':
			color.L = parseFloat(t.value);
			break;
		case 'output-hsl':
			color.HSL = t.value;
			hslToHSL(color);
			break;

		// if we changed Hex, update Hex and compute new HSL.
		case 'output-hex':
			color.HEX = t.value;
			hexToHsl(color);
			break;

		// if we changed R, G, B, or RGB, update R,G,B and compute new HSL.
		case 'output-r':
			color.R = parseFloat(t.value);
			rgbToHsl(color);
			break;
		case 'output-g':
			color.G = parseFloat(t.value);
			rgbToHsl(color);
			break;
		case 'output-b':
			color.B = parseFloat(t.value);
			rgbToHsl(color);
			break;
		case 'output-rgb':
			color.RGB = t.value;
			rgbToRGB(color);
			rgbToHsl(color);
			break;

		// if we changed C, M, Y, K, or CMYK, update C,M,Y,K and compute HSL
		case 'output-c':
			color.C = parseFloat(t.value);
			cmykToHsl(color);
			break;
		case 'output-m':
			color.M = parseFloat(t.value);
			cmykToHsl(color);
			break;
		case 'output-y':
			color.Y = parseFloat(t.value);
			cmykToHsl(color);
			break;
		case 'output-k':
			color.K = parseFloat(t.value);
			cmykToHsl(color);
			break;
		case 'output-cmyk':
			color.CMYK = t.value;
			cmykToCMYK(color);
			cmykToHsl(color);
			break;

	}



	// compute the other new values in $color & update the onscreen values
	updateOutputs();

	// compute new position of the pointers in the pickers
	// H : x in main picker
	var hx = color.H * pickerSizes.w / 360;
	pointer.style.left = Math.min(pickerSizes.w , Math.max(1, hx))+'px';

	// L : -y in main picker
	var ly = (100 - color.L ) * pickerSizes.h / 100;
	pointer.style.top = Math.min(pickerSizes.h , Math.max(1, ly))+'px';

	// S : -x in secondary picker
	var sx = ( 100 - color.S ) * pickerSizes.w / 100;
	pointer2.style.left = Math.min(pickerSizes.w , Math.max(1, sx))+'px';

}



function updateOutputs() {
	// update in $var
	hslToRgb(color);
	rgbToHex(color);
	rgbToCmyk(color);

	// update in CSS
	document.documentElement.style.setProperty('--saturation', color.S+'%');

	// preview
	outputPreview.style.background = 'hsl('+Math.round(color.H)+', '+(color.S).toFixed(2)+'%, '+(color.L).toFixed(2)+'%)';


	document.getElementById('output-h').value = Math.round(color.H);
	document.getElementById('output-s').value = Math.round(color.S);
	document.getElementById('output-l').value = Math.round(color.L);
	document.getElementById('output-hsl').value = 'hsl('+Math.round(color.H)+','+Math.round(color.S)+'%,'+Math.round(color.L)+'%)';

	document.getElementById('output-r').value = Math.round(color.R);
	document.getElementById('output-g').value = Math.round(color.G);
	document.getElementById('output-b').value = Math.round(color.B);
	document.getElementById('output-rgb').value = 'rgb('+Math.round(color.R)+','+Math.round(color.G)+','+Math.round(color.B)+')';

	document.getElementById('output-c').value = Math.round(color.C);
	document.getElementById('output-m').value = Math.round(color.M);
	document.getElementById('output-y').value = Math.round(color.Y);
	document.getElementById('output-k').value = Math.round(color.K);
	document.getElementById('output-cmyk').value = 'cmyk('+Math.round(color.C)+'%,'+Math.round(color.M)+'%,'+Math.round(color.Y)+'%,'+Math.round(color.K)+'%)';

	document.getElementById('output-hex').value = color.HEX;

}


function hslToRgb(color) {
	var h = color.H/360;
	var s = color.S/100;
	var l = color.L/100;

    var r, g, b;

    if (s == 0) {
        r = g = b = l; // achromatic
    } else {
        var hue2rgb = function hue2rgb(p, q, t){
            if (t < 0) t += 1;
            if (t > 1) t -= 1;
            if (t < 1/6) return p + (q - p) * 6 * t;
            if (t < 1/2) return q;
            if (t < 2/3) return p + (q - p) * (2/3 - t) * 6;
            return p;
        }

        var q = l < 0.5 ? l * (1 + s) : l + s - l * s;
        var p = 2 * l - q;
        r = hue2rgb(p, q, h + 1/3);
        g = hue2rgb(p, q, h);
        b = hue2rgb(p, q, h - 1/3);
    }

    color.R = r * 255;
    color.G = g * 255;
    color.B = b * 255;
}

function rgbToHsl(color) {

	var r = color.R / 255;
	var g = color.G / 255;
	var b = color.B / 255;

    var max = Math.max(r, g, b), min = Math.min(r, g, b);
    var h, s, l = (max + min) / 2;

    if (max == min) {
        h = s = 0; // achromatic
    } else {
        var d = max - min;
        s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
        switch (max) {
            case r: h = (g - b) / d + (g < b ? 6 : 0); break;
            case g: h = (b - r) / d + 2; break;
            case b: h = (r - g) / d + 4; break;
        }
        h /= 6;
    }

    color.H = h*360;
    color.S = s*100;
    color.L = l*100;
}

function rgbToHex(color) {
	var r = Math.round(color.R);
	var g = Math.round(color.G);
	var b = Math.round(color.B);

    color.HEX =  "#" + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1,7);
}
function hexToRgb(color) {
	color.R = parseInt((color.HEX).substr(1,2),16);
	color.G = parseInt((color.HEX).substr(3,2),16);
	color.B = parseInt((color.HEX).substr(5,2),16);    
}

function hexToHsl(color) {
	hexToRgb(color);
	rgbToHsl(color);
}

function rgbToRGB(color) {
	[color.R, color.G, color.B] = (color.RGB.replace(/rgb|\(|\)| /g, '')).split(',', 3);
	[color.R, color.G, color.B] = [parseInt(color.R, 10), parseInt(color.G, 10), parseInt(color.B, 10)]
}


function hslToHSL(color) {
	[color.H, color.S, color.L] = (color.HSL.replace(/hsl|\(|\)| |\%/g, '')).split(',', 3);
	[color.H, color.S, color.L] = [parseFloat(color.H), parseFloat(color.S), parseFloat(color.L)]
}

function cmykToCMYK(color) {
	[color.C, color.M, color.Y, color.K] = (color.CMYK.replace(/cmyk|\(|\)| |\%/g, '')).split(',', 4);
	[color.C, color.M, color.Y, color.K] = [parseFloat(color.C), parseFloat(color.M), parseFloat(color.Y), parseFloat(color.K)]
}

function rgbToCmyk(color) {
	var r = color.R/255;
	var g = color.G/255;
	var b = color.B/255;

	var k = 1-Math.max(r, g, b);
	if (k == 1) {
		color.K = 100;
		color.C = color.M = color.Y = 0;
	}
	else {
		color.K = k * 100;
		color.C = (1-r-k)/(1-k) * 100;
		color.M = (1-g-k)/(1-k) * 100;
		color.Y = (1-b-k)/(1-k) * 100;
	}
}

function cmykToRgb(color) {
	var c = color.C/100
	var m = color.M/100
	var y = color.Y/100
	var k = color.K/100

	var r, g, b;

	r = ( 1 - c ) * ( 1 - k );
	g = ( 1 - m ) * ( 1 - k );
	b = ( 1 - y ) * ( 1 - k );

    color.R = r * 255;
    color.G = g * 255;
    color.B = b * 255;
}

function cmykToHsl(color) {
	cmykToRgb(color);
	rgbToHsl(color);
}


/* ]]> */
</script>
<!--

# adresse de la page : https://lehollandaisvolant.net/tout/tools/color/
#      page créée le : 31 mars 2013
#     mise à jour le : 10 novembre 2018

-->
</body>
</html>