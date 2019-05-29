<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="When will I be one billon seconds old ?" />

	<title>When will I be one billion seconds old? - le hollandais volant</title>

	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

.main-form {
	max-width: 500px;
}

.main-form label {
	display: block;
	margin: 10px 0 5px;
}

.main-form input.four-digit {
	width: 60px;
}
.main-form input.two-digit {
	width: 40px;
}

.main-form input,
.main-form select {
	border: 1px solid #aaa;
	border-radius: 4px;
	background: #eee;
	margin-right: 5px;
	background-image: linear-gradient(to bottom, #bababa, white);
	box-shadow: 0 0 2px #aaa;
	padding: 4px;
}

.main-form .events h2 {
	font-size: 1.2em;
	margin: 1em 0;
}

.main-form .events h3 {
	font-size: 1.0em;
	margin: .7em 0 0;
}

.main-form .events p {
	margin: .3em;
	padding-left: 20px;
	background-position: left center;
	background-repeat: no-repeat;
}

.main-form .events h3+p {
	background-image: url(calendar.png);
}
.main-form .events h3+p+p {
	background-image: url(clock.png);
}

.main-form #age-in-seconds {
	font-style: oblique;
}

.main-form .submit-centrer {
	text-shadow: none;
	border-radius: 4px;
	color: #222;
	border: 1px solid #aaa;
	background: #eee;
	background-image: linear-gradient(to bottom, white, #bababa);
	box-shadow: 0 0 2px #aaa;

}

.main-form .submit-centrer:active {
	background-image: linear-gradient(to bottom, #bababa, white);
	color: gray;

}
	</style>
</head>
<body>

<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">When will I be one billion seconds old?</a></p>
</header>


<section class="main-form">
	<h1>When will I be one billion seconds old?</h1>
	<label for="in-year">Enter your birthday:</label>
	<input class="four-digit" type="number" min="0000" id="in-year" value="2000" size="4" />
	<select id="in-month">
		<option value="00" selected>January</option>
		<option value="01">February</option>
		<option value="02">March</option>
		<option value="03">April</option>
		<option value="04">May</option>
		<option value="05">June</option>
		<option value="06">July</option>
		<option value="07">August</option>
		<option value="08">September</option>
		<option value="09">October</option>
		<option value="10">November</option>
		<option value="11">December</option>
	</select>
	<input class="two-digit" type="number" min="1" max="31" id="in-day" value="1" size="2" />

	<label for="in-hours">Enter your birthtime (optional):</label>
	<input class="two-digit" type="number" min="0" max="23" id="in-hours" value="00" size="2" />
	<input class="two-digit" type="number" min="0" max="59" id="in-minutes" value="00" size="2" />
	<input class="two-digit" type="number" min="0" max="59" id="in-seconds" value="00" size="2" />

	<p class="oneline" id="p-convert"><button type="button" class="submit-centrer" onclick="calc();">Calculate</button></p>


	<p class="events" id="age-in-seconds"></p>
	<div class="events" id="past-event"></div>
	<div class="events" id="future-event"></div>

	<div class="notes">
		<p>Based on your computer time.</p>
		<p>Leap-seconds may not been taken into account.</p>
	</div>

</section>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script>
/* <![CDATA[ */
"use strict";

function calc() {
	// save current date
	var curDate = new Date();

	// get input values
	var inY = document.getElementById('in-year').value;
	var inM = document.getElementById('in-month').value;
	var inD = document.getElementById('in-day').value;
	var inH = document.getElementById('in-hours').value;
	var inI = document.getElementById('in-minutes').value;
	var inS = document.getElementById('in-seconds').value;
	// make a date from input values
	var inDate = new Date(inY, inM, inD, inH, inI, inS);

	// load html output nodes
	var pastNode = document.getElementById('past-event');
	var futureNode = document.getElementById('future-event');
	pastNode.innerHTML = futureNode.innerHTML = '';

	// calculates dates

	// Millions
	var m1Date = new Date(inDate.getTime() + 1000000*1000); // 1 M // *1000 = 'cause JS calculates in milliseconds
	var m10Date = new Date(inDate.getTime() + 10000000*1000); // 10 M
	var m100Date = new Date(inDate.getTime() + 100000000*1000); // 100 M

	// Billions
	var g1Date = new Date(inDate.getTime() + 1000000000*1000); // 1 G // *1000 = 'cause JS calculates in milliseconds
	var g2Date = new Date(inDate.getTime() + 2000000000*1000); // 2 G
	var g3Date = new Date(inDate.getTime() + 3000000000*1000); // 3 G



	var m1Text = '<h3>One million seconds old</h3>'+
						'<p>On '+literalDay(m1Date.getDay())+', '+literalMonth(m1Date.getMonth())+' '+m1Date.getDate()+', '+m1Date.getFullYear()+'</p>'+
						'<p>At '+m1Date.toLocaleTimeString()+'</p>';
	var m10Text = '<h3>Ten million seconds old</h3>' +
						'<p>On '+m10Date.toDateString()+'</p>'+
						'<p>At '+m10Date.toLocaleTimeString()+'</p>';
	var m100Text = '<h3>Hundred millions seconds old</h3>' +
						'<p>On '+m100Date.toDateString()+'</p>'+
						'<p>At '+m100Date.toLocaleTimeString()+'</p>';

	var g1Text = '<h3>One billion seconds old</h3>'+
						'<p>On '+literalDay(g1Date.getDay())+', '+literalMonth(g1Date.getMonth())+' '+g1Date.getDate()+', '+g1Date.getFullYear()+'</p>'+
						'<p>At '+g1Date.toLocaleTimeString()+'</p>';
	var g2Text = '<h3>Two billion seconds old</h3>' +
						'<p>On '+g2Date.toDateString()+'</p>'+
						'<p>At '+g2Date.toLocaleTimeString()+'</p>';
	var g3Text = '<h3>Three billion seconds old</h3>' +
						'<p>On '+g3Date.toDateString()+'</p>'+
						'<p>At '+g3Date.toLocaleTimeString()+'</p>';

	var pastEventsText = "";
	var futureEventsText = "";

	var aIS = new Date(curDate - inDate); // age in seconds

	document.getElementById('age-in-seconds').innerHTML = 'You are '+ ((Date.UTC(aIS.getFullYear(),aIS.getMonth(),aIS.getDate(),aIS.getHours(),aIS.getMinutes(),aIS.getSeconds() ))/1000).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+' seconds old.';

	// Generate millions seconds millestones output text (only if in the future)
	if (m1Date > curDate) { // 1 Ms is in the future, so will be 10 Ms and 100 Ms
		futureEventsText += m1Text;
		futureEventsText += m10Text;
		futureEventsText += m100Text;
	}
	else if (m10Date > curDate) { // 1 Ms is in the past, but 10 Ms might be in the future, so will be 100 Ms
		futureEventsText += m10Text;
		futureEventsText += m100Text;
	}
	else if (m100Date > curDate) { // 100 Ms only is in the future
		futureEventsText += m100Text;
	}

	// Generate billions seconds output text.
	if (g1Date < curDate) { // 1 Gs was in the past
		pastEventsText += g1Text;

		if (g2Date < curDate) { // 2 Gs was also in the past
			pastEventsText += g2Text;

			if (g3Date < curDate) { // 3 Gs was also in the past (Congrats, you are very old !)
				pastEventsText += g3Text;
			}
			else {
				futureEventsText += g3Text;
			}
		}

		else { // 2 Gs is in the future, so 3 Gs will also be
			futureEventsText += g2Text;
			futureEventsText += g3Text;
		}
	}

	else { // 1 Gs is in future, so will be 2 Gs and 3 Gs
		futureEventsText += g1Text;
		futureEventsText += g2Text;
		futureEventsText += g3Text;
	}

	if (pastEventsText !== "") {
		pastNode.innerHTML = '<h2>You were…</h2>';
		pastNode.innerHTML += pastEventsText;
	}
	if (futureEventsText !== "") {
		futureNode.innerHTML = '<h2>You will be…</h2>';
		futureNode.innerHTML += futureEventsText;
	}

}


function literalDay(day) {
	switch (day+1) {
		case 1: return 'Monday';
		case 2: return 'Tuesday';
		case 3: return 'Wednesday';
		case 4: return 'Thursday';
		case 5: return 'Friday';
		case 6: return 'Saturday';
		case 7: return 'Sunday';
	}
}

function literalMonth(month) {
	switch (month+1) {
		case 1: return 'January';
		case 2: return 'February';
		case 3: return 'March';
		case 4: return 'April';
		case 5: return 'May';
		case 6: return 'June';
		case 7: return 'July';
		case 8: return 'August';
		case 9: return 'September';
		case 10: return 'October';
		case 11: return 'November';
		case 12: return 'December';
	}

}


/* ]]> */
</script>
<!--
# adresse de la page : http://lehollandaisvolant.net/tout/tools/giga-second/
#      page créée le : 15 février 2015
#     mise à jour le : 15 février 2015
-->
</body>
</html>