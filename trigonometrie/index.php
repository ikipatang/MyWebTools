<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Outil en ligne pour visualiser les fonctions trigonométriques." />

	<title>Les fonctions Trigonométriques - le hollandais volant</title>

	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

/* --------------------------------------------------- Main graph box styles */

#mainboard {
	padding: 15px;
	position: relative;
	text-align: center;
}

#graphandbuttons {
	position: relative;
	display: inline-block;
	width: 100%;
}


#jxgbox {
	resize: both;
	overflow: hidden;
	background-color: #ffffff;
	box-shadow: inset 0 0 10px silver;
	min-width: 400px;
	min-height: 350px;
	width: 100%;
	height: 579px;
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

#inputfunc button {
	margin: 20px auto;
}
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

</style>
</head>
<body>

<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Les fonctions trigonométriques</a></p>
</header>

<section class="main-form">
	<p id="inputfunc">
		<label><i>x</i> = <input type="text" id="x" value=""></label>
		<label><i>sin(x)</i> = <input type="text" id="sinx" value=""></label>
		<label><i>cos(x)</i> = <input type="text" id="cosx" value=""></label>
		<label><i>tan(x)</i> = <input type="text" id="tanx" value=""></label>
		<span id="extendedForm" style="display:none">
			<label><i>cot(x)</i> = <input type="text" id="cotx" value=""></label>

			<label><i>sec(x)</i> = <input type="text" id="secx" value=""></label>
			<label><i>csc(x)</i> = <input type="text" id="cscx" value=""></label>

			<label><i>versin(x)</i> = <input type="text" id="versx" value=""></label>
			<label><i>cvs(x)</i> = <input type="text" id="cvsx" value=""></label>

			<label><i>exsec(x)</i> = <input type="text" id="exsx" value=""></label>
			<label><i>exscs(x)</i> = <input type="text" id="excx" value=""></label>
		</span>
		<button type="button" class="button button-submit centrer" onclick="toogleExtended(this);">Plus de fonctions</button>
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
	</div>


<div class="notes">
	<p>Cette page utilise <a href="http://jsxgraph.uni-bayreuth.de/wp/">JSXGraph</a> et <a href="http://dlippman.imathas.com/">MathJS</a>.<br/>
	Cette page fonctionne le mieux dans Firefox.</p>
</div>

</section>



<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>


<script src="jsxgraphcore-0.99.3.js"></script>

<script>
var isExtended = false;
var jxgboxSize = new Array(600, 600);

// JSXG Board Init
var board = JXG.JSXGraph.initBoard('jxgbox', {
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


function Plot() {

	var ax = board.create('line',[[0,0],[1,0]],{visible:false});
	var ay = board.create('line',[[0,0],[0,1]],{visible:false});
	 
	var p0 = board.create('point',[0,0],{fixed:true,visible:false});
	var p1 = board.create('point',[1,0],{name:'',visible:false,fixed:true});

	var c = board.create('circle',[p0,p1],{strokeWidth:2,});

	var p2 = board.create('glider',[1.3,1.0,c],{name:'',withLabel:false});
	var p3 = board.create('point',[function(){return p2.X();},0.0],{visible:true,name:'',withLabel:false, fillColor: 'green', strokeColor: 'green'});
	var p4 = board.create('point',[0.0,function(){return p2.Y();}],{visible:true,name:'',withLabel:false, fillColor: 'violet', strokeColor: 'violet'});
	var t = board.create('tangent',[p2],{visible:false});
	var p5 = board.create('intersection',[t,ax,0],{visible:true,name:'',withLabel:false, fillColor: 'orange', strokeColor: 'orange'});


	var x = board.create('angle', [p1,p0,p2], {type:'sector', orthoType:'square', orthoSensitivity:0, radius:0.5, name: 'x'});
	 

	board.create('line',[p0,p2],{straightFirst:false,straightLast:false,strokeColor:'red' , strokeWidth:1 });   // Hypotenuse

	// sin
	board.create('line',[p0,p4],{straightFirst:false,straightLast:false,strokeColor:'violet', strokeWidth:2, dash: 2 });
	board.create('text',[0.02,function(){return (p2.Y()+p3.Y())*0.5;},'sin'],{strokeColor:'violet'});
	// cos
	board.create('line',[p0,p3],{straightFirst:false,straightLast:false,strokeColor:'green', strokeWidth:2, dash: 2 });
	board.create('text',[function(){return (p2.X()+p4.X())*0.5;},0.05,'cos'],{strokeColor:'green'});
	// tan
	board.create('line',[p2,p5],{straightFirst:false,straightLast:false, strokeColor:'orange'});
	board.create('text',[function(){return 0.1+(p2.X()+p5.X())*0.5;},function(){return 0.1+(p2.Y()+p5.Y())*0.5;},'tan'],{strokeColor: 'orange'});

	if (isExtended == true) {
		// csc
		var p6 = board.create('intersection',[t,ay,0],{visible:true,name:'',withLabel:false, fillColor: 'cyan', strokeColor: 'cyan'});
		var csc = board.create('line',[p0,p6],{straightFirst:false,straightLast:false,strokeColor:'#4BB358', strokeWidth:2});
		board.create('text',[function(){return -0.2+(p0.X()+p6.X())*0.5;},function(){return (p0.Y()+p6.Y())*0.5;},'csc'],{strokeColor:'#4BB358'});

		// sec
		var sec = board.create('line',[p0,p5],{straightFirst:false,straightLast:false,strokeColor:'#CFBE0B', strokeWidth:2});
		board.create('text',[function(){return (p0.X()+p5.X())*0.5;}, function(){return (p0.Y()+p5.Y())*0.5-0.08;},'sec'],{strokeColor:'#CFBE0B'});

		// versin
		var p7 = board.create('intersection',[sec, c, 0],{visible:false,withLabel:false, fillColor: 'black', strokeColor: 'black'});
		board.create('line',[p3,p7],{straightFirst:false,straightLast:false,strokeColor:'#53C09B', strokeWidth:2, dash: 2 });
		board.create('text',[function(){return (p7.X()+p3.X())*0.5-0.1;}, 0.05,'versin'],{strokeColor:'#53C09B'});

		// cvs
		var p8 = board.create('intersection',[csc, c, 0],{visible:false,withLabel:false, fillColor: 'black', strokeColor: 'black'});
		board.create('line',[p4,p8],{straightFirst:false,straightLast:false,strokeColor:'#C05367', strokeWidth:2, dash: 2 });
		board.create('text',[0.02, function(){return (p8.Y()+p4.Y())*0.5;},'cvs'],{strokeColor:'#C05367'});

		// exsec
		board.create('line',[p5,p7],{straightFirst:false,straightLast:false,strokeColor:'black', strokeWidth:2, dash: 2 });
		board.create('text',[function(){return (p7.X()+p5.X())*0.5-0.1;}, 0.05,'exsec'],{strokeColor:'black'});

		// excsc
		board.create('line',[p6,p8],{straightFirst:false,straightLast:false,strokeColor:'#FF343B', strokeWidth:2, dash: 2 });
		board.create('text',[0.02, function(){return (p8.Y()+p6.Y())*0.5;},'exscs'],{strokeColor:'#FF343B'});

		// cot
		board.create('line',[p2,p6],{straightFirst:false,straightLast:false, strokeColor:'cyan'});
		board.create('text',[function(){return 0.1+(p2.X()+p6.X())*0.5;},function(){return 0.1+(p2.Y()+p6.Y())*0.5;},'cot'],{strokeColor: 'cyan'});
	}

	board.on('update', function () {
		var c = p3.X(), s = p2.Y(), angle;
		if (s > 0 && c > 0) {
			angle = Math.asin(p2.Y())* 180/ Math.PI;
		} else if (s > 0 && c < 0) {
			angle = (90 - Math.asin(p2.Y())* 180/ Math.PI) + 90;
		} else if (s < 0 && c < 0) {
			angle = -Math.asin(p2.Y())* 180/ Math.PI + 180;
		} else {
			angle = Math.asin(p2.Y())* 180/ Math.PI + 360;
		}

		document.querySelector('#x').value = angle;

		document.querySelector('#sinx').value = p2.Y();
		document.querySelector('#cosx').value = p3.X();
		document.querySelector('#tanx').value = p2.Y()/p3.X();

		if (isExtended == true) {
			console.log('extended2');
			document.querySelector('#cotx').value = p3.X()/p2.Y();

			document.querySelector('#secx').value = p5.X();
			document.querySelector('#cscx').value = p6.Y();

			document.querySelector('#versx').value = p7.X()-p3.X();
			document.querySelector('#cvsx').value = p8.Y()-p2.Y();

			document.querySelector('#exsx').value = p5.X()-p7.X();
			document.querySelector('#excx').value = p6.Y()-p8.Y();
		}
	});



//var h1 = board.create('hyperbola',[[1,0],[-1,0],[1,1]],{strokeWidth:2,}); // hyperbola

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
