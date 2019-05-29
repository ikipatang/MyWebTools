<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Un calendrier simple du mois en cours, en javascript" />
	<title>Calendrier - le hollandais volant</title>
	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>


@font-face {
  font-family: "icon";
  src: url("icon.woff?") format("woff");
}

*::before,
*::after {
	font-family: "icon"!important;
	vertical-align: middle;
	line-height: 1;
	color: inherit;
}

/* the calendar */
#calendar-table {
	border-collapse: collapse;
	table-layout: fixed;
	empty-cells: hide;
	background: #fafafa;
	margin: 0 auto;
	box-shadow: 10px 10px 20px gray;
}

#calendar-table thead {
	background: #ff5722;
	color: white;
}

#calendar-table > tbody td {
	padding: 0px;
	border-radius: 50%;

}

#calendar-table.yearDisplay > tbody {
	text-transform: uppercase;
}

#calendar-table > thead td {
	width: 60px;
	height: 60px;
	padding: 5px;
}

#calendar-table > tbody td button:hover {
	background: #eee;
}

#calendar-table > thead #month {
	text-align: right;
}
#calendar-table > thead #month span {
	width: 110px;
	display: inline-block;
	text-align: center;
}


#calendar-table > thead #year {
	text-align: left;
}

#calendar-table > thead #year span {
	display: inline-block;
}
#calendar-table > thead td {
	font-weight: bold;
}

#calendar-table > thead td button {
	border: 1px solid transparent;
	font-size: 2.4em;
	overflow: hidden;
	width: 50px;
	height: 50px;
	box-sizing: border-box;
	padding: 0px;
	outline: none;
	color: rgba(255, 255, 255, .9);
	vertical-align: middle;
	line-height: 1;
}

#calendar-table > thead td button:focus,
#calendar-table > thead td button:hover {
	background: rgba(255, 255, 255, .1);
}

#calendar-table > thead td button:active {
	background: rgba(255, 255, 255, .3);
}

#calendar-table #show-full-year::before { content: "\e936"; }
#calendar-table #next-month::before, #calendar-table #next-year::before { content: "\e92d"; }
#calendar-table #prev-month::before, #calendar-table #prev-year::before { content: "\e92b"; }

#calendar-table .dayAbbr th {
	color: rgba(255, 255, 255, .6);
	padding: 10px;
	font-size: 1.2em;
}


#calendar-table td.hasEvent {
	color: white;
	font-weight: bold;
}

#calendar-table td button {
	display: inline-block;
	height: 65px;
	width: 65px;
	border: 0;
	border-radius: 50%;
	background: transparent;
	padding: 0;
	margin: 0;
	font-size: 1em;
	font-weight: normal;
}

#calendar-table td.isToday button {
	font-weight: bold;
	color: white;
	background-color: #ff5722;
	box-shadow: 0px 2px 2px gray;
}

h1 { text-align: center; }

@media (max-width: 800px) {


	#calendar-table > thead td,
	#calendar-table > thead td button,
	#calendar-table td button {
		width: 40px;
		height: 40px;
	}
	#calendar-table > thead #month span {
		width: 70px;
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
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Calendrier du mois</a></p>
</header>


<section id="main-form" class="main-form">
	<h1>Juste un calendrier</h1>

	<div id="calendar-wrapper"></div>

</section>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script>
'use strict'
/* <![CDATA[ */


var initDate = new Date();

function EventAgenda() {
	var _this = this;

	/***********************************
	** Some properties & misc actions
	*/

	// get some DOM elements
	this.calRow = document.getElementById('cal-row');
	this.calWrap = document.getElementById('calendar-wrapper');
	this.domPage = document.getElementById('page');
	this.notifNode = document.getElementById('message-return');


	/**************************************
	 * Draw the MONTHLY calendar
	*/
	this.rebuiltMonthlyCal = function() {
			// empties the node
			if (document.getElementById('calendar-table')) {
				this.calWrap.removeChild(document.getElementById('calendar-table'));
			}

			// reference datetime
			var date = initDate;
			var dateToday = new Date();

			/*******************
			** the frame + thead
			*/
			// the calendar block
			var calendar = document.createElement('table');
			calendar.id = 'calendar-table';
			calendar.classList.add('monthDisplay');

			// thead-tr with prev-next buttons
			var calThead = calendar.createTHead();
			var tr = calThead.insertRow();
			tr.classList.add('monthrow');

			td = tr.insertCell();
			td.id = 'year';
			td.colSpan = 3;

			var button = document.createElement('button');
			button.id = 'show-full-year';
			button.addEventListener('click', function(e){ _this.rebuiltYearlyCal(); });
			td.appendChild(button);
			td.appendChild( (document.createElement('span')).appendChild(document.createTextNode(date.getFullYear())).parentNode);

			td = tr.insertCell();
			td.id = 'month';
			td.colSpan = 4;
			var button = document.createElement('button');
			button.id = 'prev-month';
			button.addEventListener('click',
				function(e){
					initDate = new Date(initDate.getFullYear(), initDate.getMonth()-1, initDate.getDate());
					_this.rebuiltMonthlyCal();
				});
			td.appendChild(button);
			td.appendChild( (document.createElement('span')).appendChild(document.createTextNode( date.toLocaleDateString('fr-FR', {month: "long"}) )).parentNode);



			var button = document.createElement('button');
			button.id = 'next-month';
			button.addEventListener('click',
				function(e){
					initDate = new Date(initDate.getFullYear(), initDate.getMonth()+1, initDate.getDate());
					_this.rebuiltMonthlyCal();
				});
			td.appendChild(button);

			// thead-tr with date abbr
			var tr = calThead.insertRow();
			tr.classList.add('dayAbbr');
			for (var jour of new Array('L', 'M', 'M', 'J', 'V', 'S', 'D')) {
				tr.appendChild((document.createElement('th')).appendChild(document.createTextNode(jour)).parentNode);
			}

			var calBody = document.createElement('tbody');
			calendar.appendChild(calBody);


			/*******************
			** the days
			*/
			var firstDay = (new Date(date.getFullYear(), date.getMonth(), 1));
			var lastDay = (new Date(date.getFullYear(), date.getMonth() + 1, 0));

			// in JS Sunday = 0th day of week. I need 7th, since sunday is last collumn in table
			var nthDayOfWeek = (firstDay.getDay() == 0) ? 7 : firstDay.getDay();

			for (var cell = 1; cell < lastDay.getDate() + nthDayOfWeek ; cell++) {
				// starts new line every %7 days
				if (cell % 7 == 1) {
					var tr = calBody.appendChild(document.createElement("tr"));
				}
				// add an empty cell if first day does not coincide with first cell
				if (cell < nthDayOfWeek) {
					tr.appendChild(document.createElement('td'));
				}
				// else add a cell.
				else {
					var td = tr.appendChild(document.createElement('td'));
					var dateOfCell = new Date(date.getFullYear(), date.getMonth(), cell-(nthDayOfWeek-1) );

					td.id = 'i' + dateOfCell.getDate();
					if (cell-nthDayOfWeek == (dateToday.getDate()-1)) {
						td.classList.add('isToday');
					}
					var button = document.createElement('button');
					button.appendChild(document.createTextNode( dateOfCell.getDate() ) );
					button.dataset.date = dateOfCell.toString();
					td.appendChild(button);

				}
			}

			this.calWrap.appendChild(calendar);

			// saves calendar size
			this.calWrap.dataset.calendarSizeW = calendar.getBoundingClientRect().width;
			this.calWrap.dataset.calendarSizeH = calendar.getBoundingClientRect().height;
	}

	// Init events lists (default in "calendar" view)
	this.rebuiltMonthlyCal();


	/**************************************
	 * Draw the YEARLY calendar
	*/
	this.rebuiltYearlyCal = function() {
			// empties the node
			if (document.getElementById('calendar-table')) {
				this.calWrap.removeChild(document.getElementById('calendar-table'));
			}

			// reference datetime
			var date = initDate;
			var dateToday = new Date();
			var tempDate = new Date();

			/*******************
			** the frame + thead
			*/
			// the calendar block
			var calendar = document.createElement('table');
			calendar.id = 'calendar-table';
			calendar.classList.add('yearDisplay');

			// thead-tr with prev-next buttons
			var calThead = calendar.createTHead();
			var tr = calThead.insertRow();
			tr.classList.add('monthrow');

			var td = tr.insertCell();
			td.id = 'year';
			td.colSpan = 4;
			var button = document.createElement('button');
			button.id = 'prev-year';
			button.addEventListener('click',
				function(e){
					initDate = new Date(initDate.getFullYear()-1, initDate.getMonth(), initDate.getDate());
					_this.rebuiltYearlyCal();
				});
			td.appendChild(button);
			td.appendChild( (document.createElement('span')).appendChild(document.createTextNode( date.getFullYear() )).parentNode);

			var button = document.createElement('button');
			button.id = 'next-year';
			button.addEventListener('click',
				function(e){
					initDate = new Date(initDate.getFullYear()+1, initDate.getMonth(), initDate.getDate());
					_this.rebuiltYearlyCal();
				});
			td.appendChild(button);

			var calBody = document.createElement('tbody');
			calendar.appendChild(calBody);

			calendar.style.height = this.calWrap.dataset.calendarSizeH + 'px';
			calendar.style.width = this.calWrap.dataset.calendarSizeW + 'px';

			/*******************
			** the Months
			*/

			for (var cell = 0; cell < 12 ; cell++) {

				// starts new line every %4 months
				if (cell % 4 == 0) {
					var tr = calBody.appendChild(document.createElement("tr"));
				}

				var td = tr.appendChild(document.createElement('td'));
				td.dataset.datetime = (new Date(date.getFullYear(), cell, date.getDate() ) );
				if (cell == (dateToday.getMonth())) {
					td.classList.add('isToday');
				}
				var button = document.createElement('button');
				tempDate.setMonth(cell);
				button.appendChild(document.createTextNode( tempDate.toLocaleDateString('fr-FR', {month: "short"}) ));

				button.addEventListener('click', function(e){
					initDate = new Date( this.parentNode.dataset.datetime );
					_this.rebuiltMonthlyCal();
				});
				td.appendChild(button);
			}
			this.calWrap.appendChild(calendar);
	}

}

var Agenda = new EventAgenda();

/* ]]> */
</script>
<!--

# adresse de la page : http://lehollandaisvolant.net/tout/tools/calendar/
#      page créée le : 29 mars 2013
#     mise à jour le : 14 août 2018

-->
</body>
</html>