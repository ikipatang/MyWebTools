<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Une pluie de chiffres chinois comme dans Matrix" />
	<title>Écran de veille façon Matrix - le hollandais volant</title>
	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

html {
	height: 100%;
}
body {
	min-height: 100%;
	background-color: transparent;
	text-shadow: 0 0 5px black;
	color: white;
}

@keyframes fadeout {
	from {
		opacity: 1;
	}

	to {
		opacity: .1;
	}
}


#top-nav {
	background-color: rgba(0, 0, 0, .5);
	box-shadow: 0 2px 5px rgba(255, 255, 255, 0.5);
	color: white;
}

#top-nav,
#footer,
.main-form > #fullscreen {
	animation-name: fadeout;
	animation-delay: 5s;
	animation-duration: 5s;
	animation-fill-mode: forwards;
}

#top-nav:hover,
#top-nav:hover + .main-form > #fullscreen,
#top-nav:hover ~ #footer {
	animation: none;
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
	background-color: rgba(0, 0, 0, .2);
	box-shadow: 0 2px 5px rgba(255, 255, 255, 0.5);
	color: inherit;
	font-weight: bold;
}

#c {
	width: 100%;
	height: 100%;
	position: fixed;
	top: 0;
	z-index: -1;
	background-color: black;
	left: 0;
}

#footer {
	position: absolute;
	bottom: 0;
	left: 0;
	right: 0;
}

	</style>

</head>
<body>

<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Écran de veille façon Matrix</a></p>
</header>

<div class="main-form">
	<button type="button" class="button button-other" id="fullscreen">Plein écran</button>
	<canvas id="c"></canvas>
</div>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>


<script>
'use strict'

// CODE from : https://codepen.io/P3R0/pen/MwgoKv

// init vars
var c, ctx, columns, drops;

//chinese/japanese characters
var chinese = "由甲申甴电甶男甸甹町画甼甽畍畎畏畐畑アイウエオカキクケコサシスセソチテナニヌネノハヒヘホマミムメモヤラリルレロヱヲ".split("");
var chineseLen = chinese.length;
var font_size = 14;



c = document.getElementById("c");
ctx = c.getContext("2d");

// set canvas fullscreen
c.height = window.innerHeight;
c.width = window.innerWidth;

//number of columns for the rain
columns = c.width/font_size;

//an array of drops - one per column
drops = [];

//x below is the x coordinate
//1 = y co-ordinate of the drop(same for every drop initially)
for (var x = 0; x < columns; x++) {
	drops[x] = 1; 
}


//drawing the characters
function draw() {

	//Black BG for the canvas
	//translucent BG to show trail
	ctx.fillStyle = "rgba(0, 0, 0, 0.05)";
	ctx.fillRect(0, 0, c.width, c.height);
	
	ctx.fillStyle = "#0F0"; //green text
	ctx.font = font_size + "px arial";
	//looping over drops
	for (var i = 0, len=drops.length; i < columns; i++) {
		//a random chinese character to print
		var text = chinese[Math.floor(Math.random()*chineseLen)];
		//x = i*font_size, y = value of drops[i]*font_size
		ctx.fillText(text, i*font_size, drops[i]*font_size);
		
		//sending the drop back to the top randomly after it has crossed the screen
		//adding a randomness to the reset to make the drops scattered on the Y axis
		if(drops[i]*font_size > c.height && Math.random() > 0.985)
			drops[i] = 0;
		
		//incrementing Y coordinate
		drops[i]++;
	}
}

var drawing = setInterval(draw, 50);


document.getElementById('fullscreen').addEventListener('click', function() {
	if (!document.fullscreenElement) {
		document.documentElement.requestFullscreen();
	} else {
		if (document.exitFullscreen) {
			document.exitFullscreen(); 
		}
	}

});


</script>
<!--

# adresse de la page : https://lehollandaisvolant.net/tout/tools/matrix/
#      page créée le : 14 novembre 2018
#     mise à jour le : 14 novembre 2018

-->
</body>
</html>