<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Page avec un minuteur et alarme en JS" />

	<title>Minuteur et alarme - le hollandais volant</title>

	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

.main-form {
	text-align: center;
	margin-top: 50px;
}

.main-form input.text {
	width: 3em;
	padding: .5em;
	border-width: 0 1px;
}

.main-form input.text:focus {
	box-shadow: 0 0 10px gray;
}

.main-form input:first-of-type {
	margin-left: 0;
	border-left-width: 0;
	border-radius: 4px;
}

.main-form span.onliner {
	white-space: nowrap;
	display: inline-block;
	border: 1px solid silver;
	background: #eee;
	height: auto;
	padding: 0 10px 0 0;
	border-radius: 4px;
}

.main-form p {
	line-height: 2em;
}
.clock-ended {
	color: red;
}
.clock-ended input {
	font-weight: bold;
	color: red;
}

.clock-10s, .clock-10s input {
	text-decoration: blink;
	color: red;
}

#playPauseButtons {
	padding-top: 25px;
}
#playPauseButtond > button {
	min-width: 0;
	position: relative;
}
#buttonPlay {
	display: inline;
}
#buttonPlay::before {
	content: "";
	border: 6px solid white;
	height: 0;
	width: 0;
	display: block;
	border-color: transparent transparent transparent white;
	position: absolute;
	left: 25px;
	top: 9px;
}

#buttonPause {
	display: none;
}
#buttonPause::before {
	content: "";
	border: 5px solid white;
	height: 10px;
	width: 3px;
	display: block;
	border-width: 0 3px;
	position: absolute;
	left: 25px;
	top: 10px;
}





#player {
	cursor: pointer;
	display: inline-block;
	padding: 20px;
	margin-top: 30px;
}
#player button {
}

#audio_file {
	display: none;
}

#changemusic {
	box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
}

	</style>
</head>
<body>

<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Minuteur avec alarme</a></p>
</header>

<section class="main-form">

	<div id="horloge">
		<p>Faire sonner l’alarme dans :</p>
		<p>
			<span class="onliner"><input type="text" class="text" value="01" placeholder="01" id="h" />h <input type="text" class="text" value="00" placeholder="00" id="m" />m <input type="text" class="text" value="00" placeholder="00" id="s" />s</span>
		</p>
	</div>

	<p id="playPauseButtons">
		<button class="button button-submit" id="buttonPlay" onclick="timer = setInterval(function () {myTimer()}, 1000); switchButtons(0, 1);">Lancer</button>
		<button class="button button-submit" id="buttonPause" onclick="clearInterval(timer); switchButtons(1, 0); player.pause();">Pauser</button>
	</p>

	<div id="player" onclick="chooseFile();">
		<p><button type="button" id="changemusic" class="button button-other">Choisir une musique à vous ?</button></p>
		<p><span id="musicName"></span><audio id="audio_player" loop preload="auto" src="alarm.ogg"></audio></p>
	</div>
	<input id="audio_file" type="file" accept="audio/*" />

</section>


<div class="notes centrer">
	<p></p>
</div>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>


<script>
/* <![CDATA[ */
"use strict";

var timer;

// Dom elements
var h = document.getElementById('h');
var m = document.getElementById('m');
var s = document.getElementById('s');
var clock = document.getElementById("horloge");
var docTitle = document.title;

// Sound stuff
var player = document.getElementById('audio_player'); //'alarm.ogg'

// Sound buttons
function switchButtons(play, pause) {
	if (play == 1) document.getElementById('buttonPlay').style.display = 'inline';
	else document.getElementById('buttonPlay').style.display = 'none'

	if (pause == 1) document.getElementById('buttonPause').style.display = 'inline';
	else document.getElementById('buttonPause').style.display = 'none'
}

// Choose file
function chooseFile() {
	var evt = document.createEvent("MouseEvents"); // créer un évennement souris
	evt.initMouseEvent("click", true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
	document.getElementById('audio_file').dispatchEvent(evt);
	evt.preventDefault();
}

audio_file.onchange = function(){
	var files = this.files;
	var file = URL.createObjectURL(files[0]); 
	player.src = file;
	document.getElementById('musicName').innerHTML = 'Son : <em>'+audio_file.value.split(/(\\|\/)/g).pop()+'</em>';
};

function myTimer() {
	var totalSeconds = parseInt(h.value*60*60) + parseInt(m.value*60) + parseInt(s.value);

	if (totalSeconds-1 >= 0) totalSeconds--;

	var newh = Math.floor(totalSeconds / 3600);
	var newm = Math.floor((totalSeconds%3600) / 60);
	var news = totalSeconds % 60;

	h.value = newh;
	m.value = newm;
	s.value = news;


	document.title = ( (newh == 0) ? ( (newm == 0) ? news+'sec' : newm+'min' ) : newh+'h') +' - '+ docTitle;
	if (totalSeconds < 10) {
		clock.classList.add('clock-10s');
	}

	if (totalSeconds <= 0) {
		clearInterval(timer);
		player.play();
		clock.classList.add('clock-ended');
	}
}


//myTimer();
/* ]]> */
</script>
<!--
# adresse de la page : http://lehollandaisvolant.net/tout/tools/timer/
#      page créée le : 2 septembre 2014
#     mise à jour le : 5 septembre 2014
-->
</body>
</html>