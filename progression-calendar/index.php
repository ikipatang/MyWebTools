<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Montre l’avancement dans l’année" />

	<title>Où en sommes nous dans l’année ? - le hollandais volant</title>

	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

/* literal date display*/
#date-time {
	text-align: center;
	margin-bottom: 50px;
	text-shadow: 1px 1px 0px white, 0px 0px 20px black;
}
#date-time time {
	display: block;
}

#time {
	font-size: 4em;
}
#date {
	font-size: 1.2em;
}

/* The bars display */
#bars .bar {
	width: 100%;
	border: 1px solid black;
	padding: 5px;
	margin: 1px 0;
	background-image: linear-gradient(to right, rgb(255, 170, 51) 0%, rgb(220, 20, 60) 100%);
	background-repeat: no-repeat;
	background-size: 0%;
	box-sizing: border-box;
	border-radius: 5px;
	transition: background-size linear 1s;
	position: relative;
	box-shadow: 0 0 4px gray;
}

#bars .bar::after {
	content: attr(data-what);
	position: absolute;
	right: 5px;
	padding: 0 5px;
	background: rgba(255, 255, 255, .8);
	border-radius: 5px;
	box-shadow: 0 0 1px 0 black inset;
}


#sector-container {
	position: relative;
	margin-top: 50px;
	width: 100%;
	--startWidth: 800px;
	--bandgap: 40px;
}

#sectors {
	position: relative;
	height: calc(var(--startWidth)/2 + 5px);
	margin: 0 auto;
	width: var(--startWidth);
}
.sector {
	--angle: 0deg;
    height: calc(var(--startWidth) / 2);
    width: var(--startWidth);
    overflow: hidden;
    position: relative;
    background: crimson;
	background: linear-gradient(to right, rgb(255, 170, 51) 0%, crimson);
    border-radius: calc(var(--startWidth)/2) calc(var(--startWidth)/2) 0 0;
    border: 1px solid black;
    position: absolute;
    bottom: 0;
	left: var(--bandgap);
	box-sizing: border-box;
	border-bottom-width: 0;
	box-shadow: 0 0 10px rgba(0, 0, 0, .5);
}

.sector::after {
	content: attr(data-what);
	position: absolute;
	padding: 0 5px;
	background: rgba(255, 255, 255, .8);
	border-radius: 5px;
	top: 9px;
	left: 50%;
	transform: translateX(-50%);
}

.sector::before {
    height: inherit;
    width: inherit;
    position: absolute;
    content: "";
    background-color: white;
    transform-origin: 50% 100%;
    transform: rotate(var(--angle));
    transition: transform linear 1s;
}


#sector-i {
	border-bottom-width: 1px;
	left: 0;
}
#sector-h {
	height: calc(var(--startWidth)/2 - var(--bandgap));
	width: calc(var(--startWidth) - var(--bandgap)*2);
	border-radius: calc(var(--startWidth)/2 - var(--bandgap)) calc(var(--startWidth)/2 - var(--bandgap)) 0 0;
}
#sector-d {
	height: calc(var(--startWidth)/2 - var(--bandgap)*2);
	width: calc(var(--startWidth) - var(--bandgap)*4);
	border-radius: calc(var(--startWidth)/2 - var(--bandgap)*2) calc(var(--startWidth)/2 - var(--bandgap)*2) 0 0;
}
#sector-m {
	height: calc(var(--startWidth)/2 - var(--bandgap)*3);
	width: calc(var(--startWidth) - var(--bandgap)*6);
	border-radius: calc(var(--startWidth)/2 - var(--bandgap)*3) calc(var(--startWidth)/2 - var(--bandgap)*3) 0 0;
}
#sector-y {
	height: calc(var(--startWidth)/2 - var(--bandgap)*4);
	width: calc(var(--startWidth) - var(--bandgap)*8);
	border-radius: calc(var(--startWidth)/2 - var(--bandgap)*4) calc(var(--startWidth)/2 - var(--bandgap)*4) 0 0;
}

#sector-y::after {
	top: 50%;
}

@media (max-width: 900px ) {

	#sector-container {
		--startWidth: 350px;
		--bandgap: 30px;
	}
	.sector::after {
		font-size: .7em;
		width: 80px;
		text-align: center;
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
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Où en sommes nous dans l’année ?</a></p>
</header>


<section class="main-form">
	<div id="date-time">
		<time id="time"></time>
		<time id="date"></time>
	</div>
	<div id="bars">
		<div class="bar" id="bar-i" data-what="minute"></div>
		<div class="bar" id="bar-h" data-what="heure"></div>
		<div class="bar" id="bar-d" data-what="jour"></div>
		<div class="bar" id="bar-m" data-what="mois"></div>
		<div class="bar" id="bar-y" data-what="année"></div>
	</div>

	<div id="sector-container">
		<div id="sectors">
			<div class="sector" id="sector-i" data-what="minute">
				<div class="sector" id="sector-h" data-what="heure">
					<div class="sector" id="sector-d" data-what="jour">
						<div class="sector" id="sector-m" data-what="mois">
							<div class="sector" id="sector-y" data-what="année"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</section>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>


<script>
/* <![CDATA[ */
"use strict";

Date.prototype.isLeapYear = function() {
	var y = this.getFullYear();
	return !(y % 4) && (y % 100) || !(y % 400);
};

// Get Day of Year
Date.prototype.getDayOfYear = function() {
	var dayCount = [0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334];
	var mn = this.getMonth();
	var dn = this.getDate();
	var dayOfYear = dayCount[mn] + dn;
	if(mn > 1 && this.isLeapYear()) dayOfYear++;
	return dayOfYear;
};





function computeDate() {
	// current date-time
	var now = new Date();

	var timeNode = document.getElementById('time');
	var dateNode = document.getElementById('date');

	if (timeNode.firstChild) timeNode.removeChild(timeNode.firstChild);
	timeNode.appendChild(document.createTextNode( (now).toLocaleTimeString('fr-FR', {hour: '2-digit', minute:'2-digit', second: '2-digit'} ) )).parentNode;
	if (dateNode.firstChild) dateNode.removeChild(dateNode.firstChild);

	dateNode.appendChild(document.createTextNode( (now).toLocaleDateString('fr-FR', {weekday: "long", year: "numeric", month: "long", day: "numeric"}) ));

	// amount of days in current month
	var daysInMonth = new Date(now.getYear(), now.getMonth(), 0).getDate();
	// amount of days in current year
	var daysInYear = now.isLeapYear() ? 366 : 365;


	// Get nodes
	// bars
	var barMin = document.getElementById('bar-i');
	var barHou = document.getElementById('bar-h');
	var barDay = document.getElementById('bar-d');
	var barMon = document.getElementById('bar-m');
	var barYea = document.getElementById('bar-y');

	// sectors
	var sectorMin = document.getElementById('sector-i');
	var sectorHou = document.getElementById('sector-h');
	var sectorDay = document.getElementById('sector-d');
	var sectorMon = document.getElementById('sector-m');
	var sectorYea = document.getElementById('sector-y');


	// the progress (in percent of the current minute, current hour, etc.)
	var progressMin = Math.round(1/60 * 100 * now.getSeconds() *100)/100;
	var progressHou = Math.round(1/3600 * 100 * ( 60 * now.getMinutes() + now.getSeconds() ) *100)/100; // with sec. precision
	var progressDay = Math.round(1/24/60 * 100 * (60 * now.getHours() + now.getMinutes() ) *100)/100; // with min. precision
	var progressMon = Math.round(1/daysInMonth/24 * 100 * (24 * now.getDate() + now.getHours() ) *100)/100; // with day precision.
	var progressYea = Math.round(1/daysInYear * 100 * now.getDayOfYear() *100)/100; // with day precision


	// for the bars
	// the actual progression is the background of the box growwing from left (0%) to right (100%)
	barMin.style.backgroundSize = progressMin + '% 100%';
	barHou.style.backgroundSize = progressHou + '% 100%';
	barDay.style.backgroundSize = progressDay + '% 100%'; 
	barMon.style.backgroundSize = progressMon + '% 100%';
	barYea.style.backgroundSize = progressYea + '% 100%';

	// displays the percentage in the actual bar.
	if (barMin.firstChild) barMin.removeChild(barMin.firstChild); // remove the existing text.
	barMin.appendChild(document.createTextNode(progressMin.toFixed(2) + ' % de cette minute')); // append the new value.
	barMin.dataset.what = now.getSeconds() + '/60';

	if (barHou.firstChild) barHou.removeChild(barHou.firstChild);
	barHou.appendChild(document.createTextNode(progressHou.toFixed(2) + ' % de cette heure'))
	barHou.dataset.what = now.getMinutes() + '/60';

	if (barDay.firstChild) barDay.removeChild(barDay.firstChild);
	barDay.appendChild(document.createTextNode(progressDay.toFixed(2) + ' % du ' + (now).toLocaleDateString('fr-FR', {weekday: "long", month: "long", day: "numeric"})))
	barDay.dataset.what = now.getHours() + '/24';

	if (barMon.firstChild) barMon.removeChild(barMon.firstChild);
	barMon.appendChild(document.createTextNode(progressMon.toFixed(2) + ' % de ' + (now).toLocaleDateString('fr-FR', {month: "long"})))
	barMon.dataset.what = now.getDate() + '/' + daysInMonth;

	if (barYea.firstChild) barYea.removeChild(barYea.firstChild);
	barYea.appendChild(document.createTextNode(progressYea.toFixed(2) + ' % de ' + now.getFullYear()))
	barYea.dataset.what = (now.getMonth()+1) + '/12';
	//barYea.dataset.what = 'année ' + now.getFullYear();


	// for the sectors
	// the actual progression is the angle of orientation of the white part above the colored from left (0°) et right (180°).
	sectorHou.style.setProperty('--angle', Math.round(progressHou * 180 / 100) + 'deg');
	sectorMin.style.setProperty('--angle', Math.round(progressMin * 180 / 100) + 'deg');
	sectorDay.style.setProperty('--angle', Math.round(progressDay * 180 / 100) + 'deg');
	sectorMon.style.setProperty('--angle', Math.round(progressMon * 180 / 100) + 'deg');
	sectorYea.style.setProperty('--angle', Math.round(progressYea * 180 / 100) + 'deg');

	// displays the percentage in the circle
	sectorMin.dataset.what = 'seconde ' + now.getSeconds() + '/59'; // this is for the ::after of the bars
	sectorHou.dataset.what = 'minute ' + now.getMinutes() + '/59';
	sectorDay.dataset.what = 'heure ' + now.getHours() + '/23';
	sectorMon.dataset.what = 'jour ' + now.getDate() + '/' + daysInMonth;
	sectorYea.dataset.what = 'année ' + now.getFullYear();

}

computeDate();
setInterval(function(){ computeDate();}, 1000);





/* ]]> */
</script>
<!--
# adresse de la page : https://lehollandaisvolant.net/tout/tools/progression-calendar/
#      page créée le : 18 août 2018
#      mise à jour le : 19 août 2018
-->
</body>
</html>