<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Outil en ligne pour visualiser les fonctions trigonométriques." />

	<title>Tracer un pentagramme - le hollandais volant</title>

	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style type="text/css">

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
	width: 850px;
	height: 600px;
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

#inputfunc label {
	font-family: serif;
	display: block;
	width: 500px;
	margin: 0 auto;
	text-align: right;
	vertical-align: middle;
}

#inputfunc label input {
	border: 1px solid silver;
	vertical-align: middle;
//	border: 0;
	background: white;
	color: black;
	font-family: sans-serif;
	padding: 5px;
	border-radius: 4px;
	text-align: left;
	width: 300px;
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
	color: #808080;
}

</style>
</head>
<body>

<header id="header">
	<h1 class="titre">Tracer un pentagramme</h1>
</header>


<form onsubmit="return(false);" id="mainform">

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
	</div>

</form>


<div class="notes centrer">
	<p>Cette page utilise <a href="http://jsxgraph.uni-bayreuth.de/wp/">JSXGraph</a> et <a href="http://dlippman.imathas.com/">MathJS</a>.<br/>
	Cette page fonctionne le mieux dans Firefox.</p>
</div>


<footer id="footer"><a href="/">Timo Van Neerden</a> - <a href="../">autres outils</a></footer>


<script src="jsxgraphcore-0.99.3.js"></script>

<script type="text/javascript">
var isExtended = false;
var jxgboxSize = new Array(850, 600);

// JSXG Board Init
var board = JXG.JSXGraph.initBoard('jxgbox', {
	axis:true,
	boundingbox:[-4, 3, 2.5, -2], // -x, y, x, -y
	showCopyright: false,
	showNavigation: false,
	keepaspectratio: true,
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
});


function Plot() {

	var ox = board.create('line',[[0,0],[1,0]],{visible:true, strokeWidth: 1, strokeColor: 'black'});
	var oy = board.create('line',[[0,0],[0,1]],{visible:true, strokeWidth: 1, strokeColor: 'black'});


	/* square */
	var A = board.create('point', [0, 0], {visible: true});
	var B = board.create('point', [0, 1], {visible: true});
	var C = board.create('point', [1, 1], {visible: true});
	var D = board.create('point', [1, 0], {visible: true});

	board.create('polygon', [A, B, C, D], {fillColor: 'none', visible: true});

	/* drawing small rectagle*/
	var E = board.create('point', [0.5, 0], {visible: true});

	var c1 = board.create('circle', [E,C],{visible: true});
	var F = board.create('intersection',[c1,ox,0],{visible:false});
	var a1 = board.create('angle', [F,E,C], {radius: F.X() - E.X(), withLabel: false, visible: true});
	var G = board.create('point', [F.X(), B.Y()], {visible: true});

	board.create('polygon', [C, G, F, D], {visible: true});

	/* drawing golden rectangle */
	board.create('polygon', [A, B, G, F], {fillColor: 'none', strokeColor: 'black', visible: true});

	/* drawing golden triangle */
	board.create('segment', [A,F],{visible:false, strokeWidth:1});
	var c2 = board.create('circle', [A, F], {visible: true});
	board.create('segment', [B,G],{visible:false, strokeWidth:1});
	var c3 = board.create('circle', [B, G], {visible: true});

	var a2 = board.create('angle', [F, A, G], {radius: F.X(), withLabel: false, visible: true});
	var a3 = board.create('angle', [F, B, G], {radius: G.X(), withLabel: false, visible: true});

	var H = board.create('intersection',[c2,c3],{visible:false});

	board.create('polygon', [A,B,H],{visible:false});

	/* drawing 3rd point of pentagon */
	var bh = board.create('line', [B,H],{visible:false, strokeWidth:1});
	var c5 = board.create('circle', [A, H], {visible: true});
	var I = board.create('intersection',[c5, bh, 1], {visible: true});
	var a4 = board.create('angle', [H, A, I], {radius: F.X(), withLabel: false, visible: true});

	/* drawing 4th point of pentagon */
	var ah = board.create('line', [A,H],{visible:false, strokeWidth:1});
	var c4 = board.create('circle', [B, H], {visible: true});
	var J = board.create('intersection',[c4, ah, 1], {visible: true});
	var a5 = board.create('angle', [J, B, H], {radius: F.X(), withLabel: false, visible: true});

	/* drawing 2nd branch of pentagram */
	var c5 = board.create('circle', [I, A], {visible: true});
	var K = board.create('intersection',[c5, c3, 1], {visible: true});
	var a7 = board.create('angle', [A, I, K], {radius: F.X(), withLabel: false, visible: true});
	var a8 = board.create('angle', [H, B, K], {radius: F.X(), withLabel: false, visible: true});
	board.create('polygon', [I,B,K],{visible:false});

	/* drawing 3rd branch of pentagram */
	var c6 = board.create('circle', [J, B], {visible: true});
	var L = board.create('intersection',[c6, c2, 0], {visible: true});
	var a6 = board.create('angle', [L, J, B], {radius: F.X(), withLabel: false, visible: true});
	var a9 = board.create('angle', [L, A, H], {radius: F.X(), withLabel: false, visible: true});
	board.create('polygon', [A,J,L],{visible:false});

	/* drawing 5th point pentagon */
	var ki = board.create('line', [K,I],{visible:false, strokeWidth:1});
	var jl = board.create('line', [J,L],{visible:false, strokeWidth:1});
	var M = board.create('intersection', [ki, jl, 0], {visible: true});

	/* drawing 4th branch of pentagram */
	var N = board.create('intersection', [bh, jl, 0], {visible: true});
	board.create('polygon', [I,N,M],{visible:false});

	/* drawing 5th branch of pentagram */
	var O = board.create('intersection', [ki, ah, 0], {visible: true});
	board.create('polygon', [O,M,J],{visible:false});

	/* outlining final pentagramm */
	board.create('polygon', [H, N, L, K, O],{visible:true, withLines: true});



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
		board.defaultAxes.x.setAttribute({visible: true});
		board.defaultAxes.y.setAttribute({visible: true});
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
	board.setBoundingBox([-5,3,5,-3], true);
}


// init graph
document.body.onload = Plot();


// toogleExtended functions
function toogleExtended(button) {
	var extForm = document.getElementById("extendedForm");

	// toogle variable
	if (!isExtended) {
		isExtended = true;
		extForm.style.display = "inline";
		button.textContent = "Moins de fonctions";
	} else {
		isExtended = false;
		extForm.style.display = "none";
		button.textContent = "Plus de fonctions";
	}

	// clear, reinit, redraw
	JXG.JSXGraph.freeBoard(board);

	// JSXG Board Init
	board = JXG.JSXGraph.initBoard('jxgbox', {
		axis:true,
		boundingbox:[-1.25, 2, 4.2, -1.25], // -x, y, x, -y
		showCopyright: false,
		showNavigation: false,
		keepaspectratio: true,
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
	});

	Plot();
}

</script>


</body>
</html>
