<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Page pour visualiser des regex" />

	<title>Visualiser une regex - le hollandais volant</title>

	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

.code * {
	font-family: "DejaVu Sans Mono",monospace;
}

#inputCt,#errorBox {
	vertical-align: middle;
}
#inputCt div.re {
	border: 1px solid #C0C0C0;
	background: none repeat scroll 0% 0% #FFF;
	border-radius: 5px;
	padding: 5px;
	box-shadow: 0px 0px 3px #C0C0C0 inset;
	margin: 0px 2px;
	text-align: left;
	display: flex;
}

#inputCt .re::before, #inputCt .re::after {
	content: "#";
	color: #aaa;
	padding:0 2px;
	font-size:1.2em;
	line-height: 1.4em;
	height:1.4em;
	font-weight: bold;

}
#inputCt div.re .input {
	color:#3030C0;
	padding:0 2px;
	border:none;
	font-size:1.2em;
	line-height: 1.4em;
	height:1.4em;
	font-weight: bold;
	word-break:break-all;
	word-wrap:break-word;
	margin:0;
	width:100%;
}

#inputCt label {
	cursor:pointer;
	display:inline-block;
}
#inputCt label input {
	margin-right:4px;
}

#visualIt, #exportIt {
	display: block;
	margin: 10px auto;
	height: 1.8em;
	line-height: 1.8em;
	width: 12em;
	font-size: 110%;
	vertical-align: middle;
	text-shadow: 0px 1px 1px rgba(0, 0, 0, 0.3);
	border-radius: 7px;
	box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.506);
	color: #FFF;
	border: 1px solid #F00;
	background: none repeat scroll 0% 0% #FF3030;
}
#errorBox {
	border:2px dashed gray;
	padding:4px;
	color: red;
	white-space: pre;
	word-wrap:normal;
	word-break:keep-all;
	display: none;
	overflow:auto;
	border-radius: 10px;
}

#graphCt {
	margin: 1em 16px;
	overflow: auto;
	cursor:move;
	-webkit-touch-callout: none;
	-webkit-user-select: none;
	-khtml-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
	border: 1px dashed gray;
	border: 1px solid #C0C0C0;
	background: none repeat scroll 0% 0% #FFF;
	padding: 5px;
	box-shadow: 2px 2px 3px #C0C0C0;

}
#graphCt svg {
	display:block;
	margin:0 auto;
}
	</style>
</head>
<body>

<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Visualiser une régex</a></p>
</header>

<section class="main-form">

	<script>
		var params=getParams();

		function trim(s) {
			return s.replace(/^\s+/,'').replace(/\s+$/,'');
		}

		function getParams() {
			var params=location.hash;
			if (!params || params.length<2) {
				params={embed:false,re:"",highlight:true,flags:''};
			} else {
				params=params.slice(2);
				params=params.split("&").reduce(function (p,a) {
					a=a.split("=");
					p[a[0]]=a[1];
					return p;
				},{});
				params.embed=params.embed==='true';
				params.flags=params.flags || '';
				params.re=params.re?trim(decodeURIComponent(params.re)):'';
			}
			return params;
		}
	</script>
	<div id="inputCt">
		<div class="re code">
			<input id="input" class="input" value="(a|b\d+)*c" />
		</div>
		<button id="visualIt">Visualiser</button>
		<label><input type="checkbox" name="flag" value="i" />IgnoreCase</label>
		<label><input type="checkbox" name="flag" value="m" />Multiline</label>
		<label><input type="checkbox" name="flag" value="g" />GlobalMatch</label>
	</div>
	<p id="errorBox" class="code">Error Message</p>
	<div id="graphCt" class="code"></div>
		<button id="exportIt">Exporter l’image</button>


	<div class="notes centrer">
		<p>Cette page utilise <a href="https://github.com/JexCheng/regulex">Regulex</a>, de JexCheng et sous licence Libre MIT.</p>
	</div>

</section>


<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script src="src/libs/require.js" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
function $(id) {return document.getElementById(id)}
function $$(q) {return document.querySelector(q)}

var raphael='src/libs/raphael';
var visualize='src/visualize';
var parse='src/parse';
var Kit='src/Kit';
/*
var visualize='dest/visualize';
var parse='dest/parse';
var Kit='dest/Kit';
//var raphael="http://cdn.staticfile.org/raphael/2.1.2/raphael-min.js";
var raphael="http://libs.useso.com/js/raphael/2.1.2/raphael-min.js";
*/
require([raphael,visualize,parse,Kit],function (R,visualize,parse,K) {

var paper = R('graphCt', 10, 10);
var input=$('input');
var inputCt=$('inputCt');
var visualBtn=$('visualIt');
var exportBtn=$('exportIt');
var errorBox=$('errorBox');
var flags=document.getElementsByName('flag');
var flagBox=$('flagBox');
var getInputValue=function () {
		return input.value=trim(input.value);
};
var setInputValue=function (v) {
	return input.value=trim(v);
};
if (params.flags) {
	setFlags(params.flags);
}
if (params.re) {
	setInputValue(params.re);
}

initListeners();
dragGraph($('graphCt'));



visualIt();

function visualIt() {
	var re=getInputValue();
	if (!re) return false;
	changeHash();
	hideError();
	var ret;
	try {ret=parse(re)}
	catch (e) {
		if (e instanceof parse.RegexSyntaxError) {
			showError(re,e);
		} else throw e;
		return false;
	}
	visualize(ret,getFlags(),paper);
	return true;
}

function hideError() {
	errorBox.style.display='none';
}
function showError(re,err) {
	errorBox.style.display='block';
	var msg=["Error:"+err.message,""];
	if (typeof err.lastIndex==='number') {
		msg.push(re);
		msg.push(K.repeats('-',err.lastIndex)+"^");
	}
	setInnerText(errorBox,msg.join("\n"));
}

function changeHash() {
	var re=getInputValue();
	var flags=getFlags();
	location.hash="#!embed=false&flags="+flags+"&re="+encodeURIComponent(params.re=re);
}

function initListeners() {
	var LF='\n'.charCodeAt(0),CR='\r'.charCodeAt(0);
	input.addEventListener('keydown',onEnter);
	visualBtn.addEventListener('click',function () {
		visualIt();
	});
	exportBtn.addEventListener('click',function () {
		exportImage();
	});


	/*
	window.addEventListener('hashchange',function () {
		if (manualHash) return;
		var p=getParams();
		if (p.re && p.re!==params.re) {
			params.re=p.re;
			setInputValue(p.re);
			visualIt();
		}
	});*/
	for (var i=0,l=flags.length;i<l;i++) {
		flags[i].addEventListener('change',onChangeFlags);
	}

	function onChangeFlags(e) {
		setInnerText(flagBox,getFlags());
		visualIt();
		changeHash();
	}
	function onEnter(e) {
		if (e.keyCode===LF || e.keyCode===CR) {
			e.preventDefault();
			e.stopPropagation();
		} else return;
		visualIt();
	}
}

function getFlags() {
	var fg='';
	for (var i=0,l=flags.length;i<l;i++) {
		if (flags[i].checked) fg+=flags[i].value;
	}
	return fg;
}

function setFlags(fg) {
	for (var i=0,l=fg.length;i<l;i++) {
		if (~fg.indexOf(flags[i].value)) flags[i].checked=true;
		else flags[i].checked=false;
	}
	setInnerText(flagBox,fg);
}

function exportImage() {
	svg = graphCt.getElementsByTagName('svg')[0];
	var canvas = document.createElement( "canvas" );
	var ctx = canvas.getContext( "2d" );
	var img = new Image;
	img.setAttribute('src',svgDataURL(svg));
	canvas.setAttribute('width',svg.clientWidth || parseInt(getComputedStyle(svg).width));
	canvas.setAttribute('height',svg.clientHeight || parseInt(getComputedStyle(svg).height));
	img.onload=function () {
		ctx.drawImage( img, 0, 0 );
		location.href=canvas.toDataURL( "image/png" );
	};
}

function svgDataURL(svg) {
	var svgAsXML = (new XMLSerializer).serializeToString(svg);
	return "data:image/svg+xml," + encodeURIComponent(svgAsXML);
}



function dragGraph(g) {
	g.addEventListener('mousedown',startMove);

	function startMove(e) {
		clearSelect();
		var x=e.clientX,y=e.clientY;
		g.addEventListener('mousemove',onMove);

		document.addEventListener('mouseup',unbind,true);
		window.addEventListener('mouseup',unbind,true);
		function unbind(e) {
			g.removeEventListener('mousemove',onMove);
			document.removeEventListener('mouseup',unbind,true);
			window.removeEventListener('mouseup',unbind,true);
		}

		function onMove(e) {
			var dx=x-e.clientX,dy=y-e.clientY;
			if (dx>0 && g.scrollWidth-g.scrollLeft-g.clientWidth<2
					|| dx<0 && g.scrollLeft<1) {
				document.documentElement.scrollLeft+=dx;
				document.body.scrollLeft+=dx;
			} else {
				g.scrollLeft+=dx;
			}
			if (dy>0 && g.scrollHeight-g.scrollTop-g.clientHeight<2
					|| dy<0 && g.scrollTop<1) {
				document.documentElement.scrollTop+=dy;
				document.body.scrollTop+=dy;
			} else {
				g.scrollTop+=dy;
			}
			x=e.clientX;
			y=e.clientY;
		}
	}
}

function getInnerText(ele) {
	if (!ele) return '';
	var node=ele.firstChild,results=[];
	if (!node) return '';
	do {
		if (node.nodeType===document.TEXT_NODE) results.push(node.nodeValue);
		else results.push(getInnerText(node));
	} while (node=node.nextSibling);
	return results.join('');
}
function setInnerText(ele,s) {
	ele.innerHTML='';
	var t=document.createTextNode('');
	t.nodeValue=s;
	ele.appendChild(t);
	return s;
}

function clearSelect() {
	if (window.getSelection) {
		if (window.getSelection().empty) {	// Chrome
			window.getSelection().empty();
		} else if (window.getSelection().removeAllRanges) {	// Firefox
			window.getSelection().removeAllRanges();
		}
	} else if (document.selection) {	// IE
		document.selection.empty();
	}
}
});

</script>
<!--
# adresse de la page : http://lehollandaisvolant.net/tout/tools/regex/
#			page créée le : 01 décembre 2014
#		 mise à jour le : 01 décembre 2014
-->
</body>
</html>