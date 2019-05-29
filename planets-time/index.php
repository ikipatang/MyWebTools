<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Clocks for other planets of the solar system." />
	<title>What time is it on the other planets? - le hollandais volant</title>
	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

html{
  height: 100%;
}
body {
  min-height: 100%;
}

body.mercury { background-image: url(bg/mercury.jpg);}
body.venus   { background-image: url(bg/venus.jpg);}
body.earth   { background-image: url(bg/earth.jpg);}
body.mars    { background-image: url(bg/mars.jpg);}
body.jupiter { background-image: url(bg/jupiter.jpg);}
body.saturn  { background-image: url(bg/saturn.jpg);}
body.uranus  { background-image: url(bg/uranus.jpg);}
body.neptune { background-image: url(bg/neptune.jpg);}

body {
	background-color: #222;
	background-position: top 30%;
	background-size: cover;
}

#top-nav {
	background: transparent;
	color: white;
}

.main-form {
	text-align: center;
	position: relative;
	max-width: none;
}

#planet {
	position: absolute;
	top: 0;
	left: 20px;
	margin: 0;
	background: transparent;
	box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
	color: inherit;
	font-weight: bold;
	border: 1px solid white;
	border-radius: 2px;
	color: white;
	padding: 6px 12px;
	overflow: hidden;
	-webkit-appearance: none;
	-moz-appearance: none;
	appearance: none;
}

#planet > option {
	background: white;
	color: black;
}

#time, #date, .info {
	line-height: 1;
	font-weight: normal;
	color: white;
	text-shadow: .05em .05em .1em black, 0em 0em 1em black, 0em 0em 1.2em black, 0em 0em 1.5em black;
}

#time {
	font-size: 6vw;
	margin-top: 1em;
	margin-bottom: 0;
}

#date {
	font-size: 3vw;
}


@media (max-width: 900px) {
	#time {
		font-size: 9vw;
	}
	#date {
		font-size: 7vw;
	}
}

@media (max-width: 500px) {
	#time {
		font-size: 12vw;
	}
	#date {
		font-size: 8.5vw;
	}
}

p.info {
	position: absolute;
	top: 0px;
	right: 20px;
	border: 2px solid white;
	height: 1em;
	width: 1em;
	margin: 0;
	line-height: 1em;
	vertical-align: middle;
	text-align: center;
	border-radius: 50%;
	box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
	color: white;
	text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
	font-size: 1.5em;
}

#infotooltip {
	visibility: hidden;
	background: rgba(0, 0, 0, .8);
	width: 90%; max-width: 800px;
	padding: 15px 30px;
	margin: 5px auto 15px;
	color: white;
	border-radius: 10px;
	box-shadow: .5em .5em 2em black inset;
	text-align: left;
}

p.info:hover + #infotooltip {
	visibility: initial;
}

#footer {
	color: white;
	text-shadow: 0 0 .1em black, 0 0 .2em black;
}
	</style>
</head>
<body>

<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">What time is it on Mars ?</a></p>
</header>

<section class="main-form">

	<select id="planet" onchange="planet=this.value;updateTime();">
		<option value="mercury">Mercury</option>
		<option value="venus">Venus</option>
		<option value="earth">Earth</option>
		<option value="mars" selected="selected">Mars</option>
		<option value="jupiter">Jupiter</option>
		<option value="saturn">Saturn</option>
		<option value="uranus">Uranus</option>
		<option value="neptune">Neptune</option>
	</select>

	<h1 id="time"></h1>
	<h2 id="date"></h2>

	<p class="info">?</p>
	<div id="infotooltip">
		<p>On this page, only the Martian time really the “official” Martian MTC time. The [Julian] date is extrapolated.<br/>
		For the other planets, time is evaluated using the same method as for the Martian time, though they are not “official”.<br/>
		Year 1 AD is considered year 1 for all planets. 1 revolution equals 1 year.</p>
	</div>

</section>


<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>


<script>
/* <![CDATA[ */
'use strict'

function h_to_hms(x) {
	var hh = Math.floor(x / 3600);
	if (hh.toString().length < 2) hh = "0" + hh;
	var y = x % 3600;
	var mm = Math.floor(y / 60);
	if (mm.toString().length < 2) mm = "0" + mm;
	var ss = Math.round(y % 60);
	if (ss.toString().length < 2) ss = "0" + ss;
	return hh + ":" + mm + ":" + ss;
}
function getDayOfYear() {
	var now = new Date();
	var start = new Date(now.getFullYear(), 0, 0);
	var diff = now - start;
	var oneDay = 1000 * 60 * 60 * 24;
	var day = Math.ceil(diff / oneDay);
	return day;
}

// dayLenFactor:  dayOnPlanet÷dayOnEarth (ex for Mars: 1 MarsDay = 1.027491252 EarthDay)
// yearLenFactor: yearOnPlanet÷yearOnEarth (ex for Mars: 1 Mars year = 1.8808 EarthYear)
// yearDaysRatio: yearOnPlanet÷dayOnPlanet (ex for Mars: 1 Mars year = 669.579816 Mars days)
// dayToEpoch:    days from UNIX-Epoch to December 29, 1873 at noon. (ex for Mars: 34127.2954262 Mars Days from UNIX-Epoch to December 29, 1873 at noon)

var planets = {
	"mercury" : {dayLenFactor: 58.6462,     yearLenFactor: 0.240846927,    yearDaysRatio: 1.5,              dayToEpoch: 597.915977506},
	"venus"   : {dayLenFactor: -243.023,    yearLenFactor: 0.61519781,     yearDaysRatio: -669.579816,      dayToEpoch: -144.28881217},
	"earth"   : {dayLenFactor: 1,           yearLenFactor: 1,              yearDaysRatio: 365.25,           dayToEpoch: 35088},
	"mars"    : {dayLenFactor: 1.027491252, yearLenFactor: 1.8808,         yearDaysRatio: 669.579816,       dayToEpoch: 34127.2954262},
	"jupiter" : {dayLenFactor: 0.41351,     yearLenFactor: 11.862,         yearDaysRatio: 10484.27970303,   dayToEpoch: 84799.642088462},
	"saturn" : {dayLenFactor: 0.448,        yearLenFactor: 29.453077344,   yearDaysRatio: 24012.8046875,    dayToEpoch: 78271.205357143},
	"uranus" : {dayLenFactor: -0.718 ,      yearLenFactor: 84.016846,      yearDaysRatio: -42739.763231198, dayToEpoch: -48837.743732591},
	"neptune" : {dayLenFactor: 0.67125,     yearLenFactor: 164.886799726,  yearDaysRatio: 89720.526778399,  dayToEpoch: 52239.106145251},
 };

var planet = 'mars';

function updateTime() {
	document.body.className = '';
	document.body.classList.add(planet);
	// init
	var timestamp = Date.now() / 1000; // Current Timestamp.
	var TAI_UTC = 36 // TAI (International Atomic Time) is currently (16/01/2016) 36 seconds ahead of UTC.

	// Local Time on the planet
	var PSD = (timestamp + (TAI_UTC)) / (planets[planet].dayLenFactor*86400) + Math.abs(planets[planet].dayToEpoch); // Planet-days since astronomical Epoch (for mars : Mars Sol Day " MSD ")
	var PTC = ((PSD % 1) * 86400); // amount of seconds since last midnight ; equivalent of UTC on earth. Mars has Mars Time Coordinate (MTC).

	document.getElementById('time').innerHTML = h_to_hms(PTC);

	// Planet-Years since J.-C.
	var dateNow = new Date();
	var planetYearsSinceY1 = (dateNow.getFullYear())/planets[planet].yearLenFactor
	var planetDaysSinceY1 = ((dateNow.getFullYear())*365.2425 + getDayOfYear())/planets[planet].dayLenFactor;
	var dayOfYearOnPlanet = (planetDaysSinceY1+0.5) % planets[planet].yearDaysRatio;

	document.getElementById('date').innerHTML = 'Year J'+Math.floor(planetYearsSinceY1)+' AD, day '+Math.ceil(dayOfYearOnPlanet);
}

updateTime();
setInterval(function(){ updateTime();}, 500);

/* ]]> */
</script>
<!--

# adresse de la page : http://lehollandaisvolant.net/tout/tools/planetsclock/
#      page créée le : 16 janvier 2016
#     mise à jour le : 16 janvier 2016

-->
</body>
</html>