<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Outil en ligne pour tracer et visualiser des graphiques" />

	<title>Tracer des graphiques - le hollandais volant</title>

	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

/* --------------------------------------------------- Main graph box styles */

#mainboard {
	padding: 15px;
	overflow: hidden;
	position: relative;
	text-align: center;
}

#graphandbuttons {
	position: relative;
	display: inline-block;
}


#jxgbox {
	resize: both;
	overflow: hidden;
	background-color: #ffffff;
	box-shadow: inset 0 0 10px silver;
	min-width: 400px;
	min-height: 350px;
	width: 600px;
	height: 500px;
	cursor: default;
	margin: 0 auto;
}

#jxgbox:after {
	display: inline-block;
	transform: rotate(45deg);
	background: #222;
	content: '';
	width: 35px;
	height: 35px;
	position: absolute;
	right: -23px;
	bottom: -23px;
}

#jxgbox:active {
	cursor: move;
	cursor: grabbing;
}

/* places buttons over the grid */
#hoverForm {
	text-align: left;
	width: 180px;
	position: absolute;
	top: 10px;
	left: 10px;
	z-index: +1;
}

#hoverForm p {
	display: inline-block;
	margin: 0;
	height: 27px;
	vertical-align: middle;
}


/* --------------------------------------------------- Function input style + main form */

.main-form {
	text-align: center;
	max-width: 90%;
	margin-top: 50px;
}

#inputfunc {
	font-size: 0;
	margin-bottom: 20px;
}

#inputfunc label[for="f"] {
	font-family: serif;
	font-size: 1.4em;
	font-size: 1.4rem;
	vertical-align: middle;
}

#inputfunc input {
	display: inline-block;
	border: 1px silver solid;
	box-sizing: border-box;
	padding: 5px;
	margin: 0;
	height: 2em;
	font-size: 1em;
	font-size: 1rem;
	vertical-align: middle;
	box-shadow: 0 0 4px #ddd;
}

#inputfunc #f {
	border-radius: 5px 0 0 5px;
	color: black;
	background: white;
	width: 200px;
}

#inputfunc input:not(:first-of-type) {
	background: #eee;
	border-left-width: 0;
}

#inputfunc input:not(:first-of-type):hover {
	cursor: pointer;
}

#inputfunc input:not(:first-of-type):active {
	box-shadow: inset 0 0 4px #aaa;
}


#inputfunc input:last-of-type {
	border-radius: 0 5px 5px 0;
}

/* --------------------------------------------------- Graph List button styles */

#list-graphs {
	margin: 10px 10px 0 0px;
	font-size: 15px;
	font-weight: bold;

}

#list-graphs > span {
	background: white;
	padding: 2px 7px 0 2px;
	margin-right: 2px;
	display: inline-block;
	height: 32px;
	line-height: 32px;
	cursor: default;
	position: relative;
	border-bottom: 2px solid black;
}

#list-graphs span span {
	display: none;
}

#list-graphs span:hover {
	box-shadow: 0 0 2px silver;
	z-index: +1;
}
#list-graphs span:hover span {
	position: absolute;
	top: -7px;
	left: -10px;
	box-shadow: inset 0 0 4px silver;
	background: rgb(255, 255, 255);	/* put image BG « x » */
	padding: 0;
	border-radius: 20px;
	text-align: center;
	display: inline-block;
	height: 20px;
	width: 20px;
	line-height: 20px;
	color: #999;
	cursor: pointer;

}

/* --------------------------------------------------- Zoom & Grid buttons styles */

/* Cachons la case à cocher */
#zoomForm [type="radio"],
#optionsForm [type="checkbox"] {
	display: none;
}

/* on prépare le label */
#optionsForm [type="checkbox"] + label,
#zoomForm [type="radio"] + label {
	position: relative; 
	padding-left: 27px;
	cursor: pointer;
	width: 0;
	font-size: 14px;
	height: 27px;
	display: inline-block;
	overflow: hidden;
}

#zoomForm [type="radio"] + label {
	position: absolute; 
}


#zoomForm:hover [type="radio"]:nth-of-type(2) + label {
	left: 26px;
}
#zoomForm:hover [type="radio"]:nth-of-type(3) + label {
	left: 52px;
}

/* Aspect des checkboxes */
#zoomForm [type="radio"] + label:before,
#optionsForm [type="checkbox"] + label:before {
	content: '';
	position: absolute;
	z-index: -1;
	left:0; top: 0;
	width: 25px;
	height: 25px;
	border: 1px solid #868686;
	background: white url(bg.png);
	box-shadow: inset 0 0px 4px silver;
}

#optionsForm [type="checkbox"] + label:before {
	z-index: 0;
	background: #f8f8f8 url(bg.png);
	box-shadow: inset 0 1px 3px rgba(0,0,0,.2);
}
 




#zoomForm:hover [type="radio"] + label:before {
	box-shadow: inset 0 0px 4px gray;
}

/* Aspect si "pas cochée" */
#zoomForm:hover [type="radio"]:not(:checked) + label:before {
	border-color: #777;
	box-shadow: none;
}

/* aspect au focus de l'élément */
#zoomForm [type="radio"]:focus + label:before {
	border: 1px solid gray;
}

#zoomForm {
	font-size: 0; /* firefox bug with \t and \n creating some stupid margin */
	width: 27px;
	height: 27px;
	overflow: hidden;
	position: relative;
	transition: width .2s;
}

#zoomForm:hover {
	width: 79px;
}
#zoomForm:hover, #optionsForm label:hover {
	box-shadow: 1px 1px 4px silver;
}

#zoomForm [type="radio"] + label:hover::before {
	border: 1px solid #333;
}

#zoomForm [type="radio"]:checked + label {
	z-index: +1;
}


/* Aspect général de la coche */
#optionsForm [type="checkbox"] + label:after {
	content: '✔';
	position: absolute;
	top: 0; left: 4px;
	font-size: 24px;
	color: #868686;
}
/* Aspect si "pas cochée" */
#optionsForm [type="checkbox"]:not(:checked) + label:before {
	border-color: #777;
}

#optionsForm [type="checkbox"]:not(:checked) + label:after {
	opacity: 0;
}

/* aspect désactivée */
#optionsForm [type="checkbox"]:disabled + label:before {
	box-shadow: none;
	border-color: #bbb;
	background-color: #ddd;
}

/* styles de la coche (si cochée/désactivée) */
#optionsForm [type="checkbox"]:disabled:checked + label:after {
	color: #bbb;
}
/* on style aussi le label quand désactivé */
#optionsForm [type="checkbox"]:disabled + label {
	color: #aaa;
}
 
/* aspect au focus de l'élément */
#optionsForm [type="checkbox"]:focus + label:before {
	border: 1px solid #868686;
}


/* boutons particuliers */
#zoomForm #zoomX + label:before {
	background-position: -79px -1px;
}

#zoomForm #zoomY + label:before {
	background-position: -105px -1px;
}

#zoomForm #zoomXY + label:before {
	background-position: -53px -1px;
}

#optionsForm #gridbox + label:before {
	background-position: -1px -1px;
}
#optionsForm #axisbox + label:before {
	background-position: -27px -1px;
}



#resetForm input {
	width: 27px;
	height: 27px;
	border: 1px solid #868686;
	background: white url(bg.png);
	padding: 0;
	box-shadow: inset 0 0px 4px silver;
	cursor: pointer;
	background-position: -131px -1px;
}

#resetForm:hover {
	box-shadow: 1px 1px 4px silver;
}

.notes {
	max-width: 700px;
	text-align: left;
	margin: 70px auto 0;
	border-top: 1px dotted #C0C0C0;
	padding-top: 10px;
}

</style>
</head>
<body>


<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Tracer des graphiques</a></p>
</header>

<form onsubmit="return(false);" class="main-form">
	<p id="inputfunc">
		<label for="f"><i>f</i><sub>(<i>x</i>)</sub> = </label>
		<input type="text" id="f" value="cos(x)" list="example-functions">
		<datalist id="example-functions">
			<option>sin(x)</option>
			<option>cos(x)</option>
			<option>exp(x)</option>
			<option>tan(x)</option>
			<option>arccos(x)</option>
			<option>arcsin(x)</option>
			<option>cosh(x)</option>
			<option>sinh(x)</option>
			<option>abs(x)</option>
			<option>floor(x)</option>
			<option>log(x)</option>
			<option>cos(x)*exp(x)</option>
			<option>cos(sin(x))</option>
			<option></option>
		</datalist>
		<input type="submit" value="Tracer" onclick="draw('cartesian')">
		<input type="button" value="Tracer en polaire" onclick="draw('polar')">
	</p>

	<div id="mainboard">
		<div id="graphandbuttons">
			<div id="hoverForm">
				<p id="optionsForm">
					<input name="gridbox" id="gridbox" type="checkbox" checked><label for="gridbox" title="Afficher la grille">Grille</label>
					<input name="axisbox" id="axisbox" type="checkbox" checked><label for="axisbox" title="Afficher les axes">Axes</label>
				</p>
				<p id="resetForm">
					<input type="button" name="resetZoom" id="resetZoom" value="" onclick="resetZoom" title="Revenir à l’origine" />
				</p>
				<p id="zoomForm">
					<input type="radio" name="zoommode" id="zoomXY" value="zoomXY" onclick="updateZoommode(this.value)" checked="checked" /><label for="zoomXY" title="Zoom vertical et horizontal">zoom-xy</label>
					<input type="radio" name="zoommode" id="zoomX" value="zoomX" onclick="updateZoommode(this.value)"/><label for="zoomX" title="Zoom horizontal">zoom-x</label>
					<input type="radio" name="zoommode" id="zoomY" value="zoomY" onclick="updateZoommode(this.value)"/><label for="zoomY" title="Zoom vertical">zoom-y</label>
					<input type="hidden" id="zoommode" value="zoomXY"/>
				</p>
			</div>
			<div id="jxgbox" class="jxgbox"></div>
		</div>
		<div id="list-graphs"></div>
	</div>


<div class="notes">
	<p>Cette page utilise <a href="http://jsxgraph.uni-bayreuth.de/wp/">JSXGraph</a> et <a href="http://dlippman.imathas.com/">MathJS</a> et fonctionne de façon optimale dans Firefox.</p>
	<p>Toutes les fonctions usuelles sont supportées&nbsp;: sin(x), arcsin(x), sinh(x), cos(x), tan(x), cot(x), exp(x), ln(x), log(x), abs(x), floor(x), sign(x), x^2… ainsi que les compositions de fonctions.</p>
</div>
</form>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script src="mathjs.js"></script>
<script src="jsxgraphcore-0.99.3.js"></script>

<script>

/*
	converts input (ie: « cos(x) ») into JS syntax (ie: « Math.cos(x) »),
	using MathJS by David Lippman http://dlippman.imathas.com/
*/
function math2js(fun) {
	return mathjs(fun);
	//return eval("g = function(x){ with(Math) return " + mathjs(fun) + " }");
}


//	List of colors for the functions
var colors = new Array("#FF4848", "#0086FF", "#13BC13", "#464646", "#C453C4", "#FF2F80", "#FF8A3C", "#3C9C91", "#61D561", "#444484");

var nthfunction=0;
var jxgboxSize = new Array(600, 600);
var defaultStrokeWidth = 2;

// JSXG Board Init
board = JXG.JSXGraph.initBoard('jxgbox', {
	axis:true,
	boundingbox:[-9,2,9,-2], // -x, y, x, -y
	showCopyright: false,
	showNavigation: false,
	keepaspectratio: false,
	rendered: "svg",
	zoom: {
		factorX: 1.25,
		factorY: 1.25,
		wheel: true,
		needShift: false,
		eps: 0.001, // zoom out max
	},
	pan: {
		needShift: false,
		enabled: true,
		needTwoFingers: true
	},

/*	axis: {
		withLabel: true
	},*/
});


/* This plots a normal xy graph (Cartesian coordinate)
	and adds it’s glider
*/
function Plot(func) {
	var curColor = colors[nthfunction%9];
	var curve = board.create('functiongraph',
		[math2js(func)], {
		name: 'i'+nthfunction,
		strokeWidth: defaultStrokeWidth,
		strokeColor: curColor,
		withLabel: false,
		highlight: false
	});

	var gliderPt = board.create('glider', [0, 0, curve], {
		name: 'iglider'+nthfunction,
		fillColor: curColor,
		strokeColor: curColor,
		withLabel: false,
		highlight: false,
	});
	nthfunction++;
}


/* This plots a polar graph (polar coordinate)
	and adds it’s glider
*/
function PolarPlot(func) {
	var curColor = colors[nthfunction%9];
	var curve = board.createElement('curve',
		[math2js(func), [0,0], 0, 50*3.14], { // from 0 to 50×Pi
		name: 'i'+nthfunction,
		strokeWidth: defaultStrokeWidth,
		curveType:'polar',
		strokeColor: curColor,
		withLabel: false,
		highlight: false
	});

	var gliderPt = board.create('glider', [0, 0, curve], {
		name: 'iglider'+nthfunction,
		fillColor: curColor,
		strokeColor: curColor,
		withLabel: false,
		highlight: false,

	});
	nthfunction++;
}

/* This removes a graph from the board
*/
function Reset(func) {
	board.removeObject(func);
}


/* Handles the plotings + the buttons
 */
function draw(curveType) {
	var func = document.getElementById('f').value;

	switch (curveType) {
		case 'cartesian':
			Plot(func);
			break;
		case 'polar':
		default:
			PolarPlot(func);
			break;
	}

	// adding a button with the function name in the list
	var span = document.createElement('span');
	span.id = 'i'+(nthfunction-1);
	span.textContent = func;
	span.onmouseover = function() {
			var curve = this.id;
			board.select(curve).setAttribute({strokeWidth: defaultStrokeWidth+1});
		};
	span.onmouseout = function() {
			var curve = this.id;
			board.select(curve).setAttribute({strokeWidth: defaultStrokeWidth});
		};
	span.style.color = colors[(nthfunction-1)%9];
	span.style.borderColor = colors[(nthfunction-1)%9];

	// adding a close button to delete graph
	var close = document.createElement('span');
	close.onclick = function() {
			var curve = this.parentNode.id;
			board.removeObject(curve);
			this.parentNode.parentNode.removeChild(this.parentNode);
		};
	close.textContent = 'x';
	span.appendChild(close);
	document.querySelector('#list-graphs').appendChild(span);

}

/* If div box is resized, needs refresh board */
document.querySelector('#jxgbox').onclick = function() {
	var oldW = jxgboxSize[0];
	var oldH = jxgboxSize[1];
	var newW = parseInt(window.getComputedStyle(this).width);
	var newH = parseInt(window.getComputedStyle(this).height);
	if (oldW != newW || oldH != newH) {
		// needs to refresh (the first alone is not complete and the secondth alone stretches the scale…)
		board.resizeContainer(newW, newH, true, true);
		board.resizeContainer(newW, newH, false, false);
		jxgboxSize[0] = newW;
		jxgboxSize[1] = newH;
		board.fullUpdate();
	}

};

/* displays and shows the grid (no, we are not in Tron ;) */
document.querySelector('#gridbox').onchange = function() {
	if (this.checked) {
		board.defaultAxes.x.defaultTicks.setAttribute({majorHeight: -1});
		board.defaultAxes.y.defaultTicks.setAttribute({majorHeight: -1});

	} else {
		board.defaultAxes.x.defaultTicks.setAttribute({majorHeight: 10});
		board.defaultAxes.y.defaultTicks.setAttribute({majorHeight: 10});
	}
}

/* displays and shows the axes */
document.querySelector('#axisbox').onchange = function() {
	if (this.checked) {
		board.defaultAxes.x.setAttribute({visible: true});
		board.defaultAxes.y.setAttribute({visible: true});
		document.querySelector('#gridbox').disabled = false;
	} else {
		board.defaultAxes.x.setAttribute({visible: false});
		board.defaultAxes.y.setAttribute({visible: false});
		document.querySelector('#gridbox').disabled = true;
	}

}

/* zoom mode : horizontal, vertical, both */
function updateZoommode(val) {
	var z = document.querySelector('#zoommode');
	z.value = val;
	z.onchange();
}
document.querySelector('#zoommode').onchange = function() {
		 board.attr.zoom.factorx = 1.25;
		 board.attr.zoom.factory = 1.25;
	 if (this.value == 'zoomX') {
			board.attr.zoom.factory = 1.0;
	 } else if (this.value == 'zoomY') {
			board.attr.zoom.factorx = 1.0;
	 }
}

/* Reset to origin and reset zoom mode */
document.querySelector('#resetZoom').onclick = function() {
	board.setBoundingBox([-9,2,9,-2], false);
}


// init;
document.body.onload = function() { draw('cartesian') };

// moves the glider with mouse hover
/*
function moveGlider(e) {
	var pos = board.getUsrCoordsOfMouse(e);
	var activeGlider = 'iglider' + (nthfunction-1).toString();
	board.select((activeGlider)).setGliderPosition(pos[0]);

}
document.getElementById('jxgbox').onmousemove = moveGlider;
*/



</script>

<!--

# adresse de la page : http://lehollandaisvolant.net/tout/tools/graph/
#      page créée le : 20 juin 2015
#     mise à jour le : 5 juillet 2015

-->


</body>
</html>