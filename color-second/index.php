<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Quelle couleur correspond à l’heure ?" />
	<title>Quelle couleur est-il ? - le hollandais volant</title>
	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

@font-face {
	font-family: "Open Sans";
	font-style: normal;
	font-weight: 300;
	src: local("Open Sans Light"), local("OpenSans-Light"), url("open-sans.woff") format("woff");
}

html{
  height: 100%;
}
body {
  min-height: 100%;
}

body {
	transition: all 0.8s ease;
	text-align: center;
	box-sizing: border-box;
	border-bottom: 1px solid transparent;
}

#top-nav {
    background: transparent;
    text-align: left;
    margin: 0;
}

.main-form {
	max-width: none;
	position: relative;
}
.main-form .button-other {
	position: absolute;
	top: 0;
	right:20px;
	margin: 0;
	background: transparent;
	box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
	color: inherit;
	font-weight: bold;
}

#colorspace {
	position: absolute;
	top: 0;
	left: 20px;
	margin: 0;
	background: transparent;
	box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
	color: inherit;
	font-weight: bold;
	border: 1px solid transparent;
	padding: 6px 12px;
	overflow: hidden;
	-webkit-appearance: none;
	-moz-appearance: none;
	appearance: none;


}

#t, #rgb, #hex {
	font-family: "open sans";
	line-height: 1;
}

.font-light {
	color: white;
	text-shadow: 1px 1px 10px gray;
}

#t {
	font-size: 8vw;
	line-height: 1;
	margin-top: 1.5em;
	margin-bottom: 0;
}
#rgb {
	font-size: 2em;
}

#footer {
	margin-top: 100px;
}

@media all and (max-width: 960px) {
	#t {
    font-size: 17vw;
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
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Quelle couleur est-il ?</a></p>
</header>

<section class="main-form">
	<button type="button" class="button button-other" id="fullscreen">Plein écran</button>

		<select id="colorspace">
			<option value="toRgb" selected>RGB</option>
			<option value="toHsl">HSL</option>
			<option value="toHslOnHue">HSL (plus coloré)</option>
		</select>


	<h1 id="t"></h1>
	<h2 id="rgb"></h2>
</section>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script>
/* <![CDATA[ */

var colorSystem = 'toRgb';


function adjustColor() {
	// in CSS, the computed color is always in RGB.
	// Here I avoid manual conversion and directly parse the computed value.
	var computedRgb = document.body.style.backgroundColor;
    var digits = computedRgb.match(/(.*?)rgb\((\d+), ?(\d+), ?(\d+)\)/);

    var r = parseInt(digits[2]);
    var g = parseInt(digits[3]);
    var b = parseInt(digits[4]);

    // I use YIQ color scheme to determine is a color is dark or light
	var yiq = ((r*299)+(g*587)+(b*114))/1000;

	if (yiq >= 128) {
		document.body.classList.remove('font-light');
	} else {
		document.body.classList.add('font-light');
	}
}

function dotime(){
	document.body.style.background = 'white';

	var d = new Date();
	var hours = d.getHours();
	var mins = d.getMinutes();
	var secs = d.getSeconds();

	var colorString = getColor(hours, mins, secs);

	
	hours.toString();
	mins.toString();
	secs.toString();
		
	document.getElementById('t').textContent = (((hours < 10) ? "0" : '')+ hours) +" : "+ (((mins < 10) ? "0" : '')+ mins) +" : "+ (((secs < 10) ? "0" : '')+ secs);
	document.getElementById('rgb').textContent = colorString;
}

function getColor(hh, mm, ss) {
	colorString = '';

	if (colorSystem == 'toRgb') {
		var r = parseInt(hh * 255 / 23); // hours from 0->23 expanded to 0->255
		var g = parseInt(mm * 255 / 60); // same for 0->59 min to 0->255
		var b = parseInt(ss * 255 / 60); // same for secs

		var rgb_str = 'rgb('+r+', '+g+', '+b+')';
		colorString = rgb_str;
	}

	if (colorSystem == 'toHsl' || colorSystem == 'toHslOnHue') {

		if (colorSystem == 'toHslOnHue') {
			// the seconds now applies on hue instead of lightness (more colorful)
			hh ^= ss; //
			ss ^= hh; // these 3 lines reverse a variable w/o the use of a "temp" variable.
			hh ^= ss; //
			hh = hh * 23 / 60;
			ss = ss * 60 / 23;
			// for even more colors, pump the saturation a bit
			mm = (mm + 120) / 3; // 00 to 59 min operate on a scale from 66% to 100%
			// and make the lightness stay around 50% (00 to 59 min is now concealed in a range 25% to 75%)
			ss = ss/2 + 15;
		}

		var h = hh * 360 / 23; // hours from 0->23 expanded to 0->360
		var s = mm * 100 / 60; // same for 0->59 min to 0->100
		var l = ss * 100 / 60; // same for secs
		var hsl = 'hsl('+parseInt(h)+', '+parseInt(s)+'%, '+parseInt(l)+'%)';
		colorString = hsl;
	}
	document.body.style.background = colorString;
	// adjust text color
	adjustColor();
	return colorString;
}

dotime();
setInterval(function(){ dotime();}, 1000);


document.getElementById('colorspace').addEventListener('change', function(){
	colorSystem = this.value;
	dotime();
});

document.getElementById('fullscreen').addEventListener('click', function(){
	var elem = document.documentElement;
	if (elem.requestFullscreen) {
		elem.requestFullscreen();
	} else if (elem.mozRequestFullScreen) { /* Firefox */
		elem.mozRequestFullScreen();
	} else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
		elem.webkitRequestFullscreen();
	} else if (elem.msRequestFullscreen) { /* IE/Edge */
		elem.msRequestFullscreen();
	}
});

/* ]]> */
</script>
<!--

# adresse de la page : https://lehollandaisvolant.net/tout/tools/color-second/
#      page créée le : 2 janvier 2015
#     mise à jour le : 12 août 2018

-->
</body>
</html>