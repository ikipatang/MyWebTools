<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Outil pour claculer les paramètres d’un trou noir (taille, radiation de Hawking…)" />

	<title>Calculateur de rayonnement de Hawking - le hollandais volant</title>

	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

td {
	padding: 10px 0;
}

	</style>
</head>
<body>

<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Rayonnement de Hawking</a></p>
</header>

<section id="main-form" class="main-form">


<table> 
	<tr>
		<th>Quantité</th>
		<th>Valeur</th>
		<th>Unités</th>
		<th>Expression</th>
	</tr> 
	<tr>
		<td>Masse</td>
		<td>
			<input value="1" type="text" id="mass_text" size="12" onchange="set_mass()" />
		</td> 
		<td>
			<select id="mass_unit" size="1" onchange="get_mass()"> 
				<option value="plm">Masse de Planck</option> 
				<option value="ug">&micro;g</option> 
				<option value="g">g</option> 
				<option value="kg">kg</option> 
				<option value="mton">tonnes</option> 
				<option value="neuble">neubles</option> 
				<option value="mearth">Masses terrestres</option> 
				<option value="msol" selected="selected">Masses solaires</option> 
			</select>
		</td>
		<td>
			<math display="block" xmlns="http://www.w3.org/1998/Math/MathML"><semantics><mi>M</mi><annotation encoding="TeX">M</annotation></semantics></math>
		</td>
	</tr> 
	<tr>
		<td>Rayon</td>
		<td>
			<input type="text" id="rad_text" size="12" onchange="set_rad()" />
		</td>
		<td> 
			<select id="rad_unit" size="1" onchange="get_rad()"> 
				<option value="pll">Longueur de planck</option> 
				<option value="fm">fm (fermi)</option> 
				<option value="nm">nm</option> 
				<option value="cm">cm</option> 
				<option value="inch">pouces</option> 
				<option value="ft">ft</option> 
				<option value="m" selected="selected">m</option> 
				<option value="km">km</option> 
				<option value="mi">miles</option> 
				<option value="ls">secondes lumière</option> 
				<option value="au">UA</option> 
				<option value="ly">années lumière</option>
			</select>
		</td>
		<td>
			<math display="block" xmlns="http://www.w3.org/1998/Math/MathML"><semantics><mrow><mi>R</mi><mo>=</mo><mi>M</mi><mfrac><mrow><mn>2</mn><mi>G</mi></mrow><msup><mi>c</mi><mn>2</mn></msup></mfrac></mrow><annotation encoding="TeX">R = M \frac{2G}{c^2}</annotation></semantics></math>
		</td>
	</tr> 
	<tr>
		<td>Surface</td>
		<td>
			<input type="text" id="srf_text" size="12" onchange="set_srf()" />
		</td>
		<td> 
			<select id="srf_unit" size="1" onchange="get_srf()"> 
				<option value="pll2">surface de planck</option> 
				<option value="fm2">fm&sup2;</option> 
				<option value="barn">barns</option> 
				<option value="cm2">cm&sup2;</option> 
				<option value="in2">sq. in</option> 
				<option value="ft2">sq. ft</option> 
				<option value="m2" selected="selected">m&sup2;</option> 
				<option value="km2">km&sup2;</option> 
				<option value="mi2">sq. miles</option> 
			</select>
		</td>
		<td>
			<math display="block" xmlns="http://www.w3.org/1998/Math/MathML"><semantics><mrow><mi>A</mi><mo>=</mo><msup><mi>M</mi><mn>2</mn></msup><mfrac><mrow><mn>16</mn><mi>π</mi><msup><mi>G</mi><mn>2</mn></msup></mrow><msup><mi>c</mi><mn>4</mn></msup></mfrac></mrow><annotation encoding="TeX">A = M^2 \frac{16 \pi G^2}{c^4}</annotation></semantics></math>
		</td>
	</tr> 
	<tr>
		<td>Accélération de la pesanteur</td>
		<td>
			<input type="text" id="grv_text" size="12" onchange="set_grv()" />
		</td>
		<td> 
			<select id="grv_unit" size="1" onchange="get_grv()"> 
				<option value="gal">Gals</option> 
				<option value="fps2">ft/s&sup2;</option> 
				<option value="mps2" selected="selected">m/s&sup2;</option> 
				<option value="g0">g</option> 
			</select>
		</td>
		<td>
			<math display="block" xmlns="http://www.w3.org/1998/Math/MathML"><semantics><mrow><mi>κ</mi><mo>=</mo><mfrac><mn>1</mn><mi>M</mi></mfrac><mfrac><msup><mi>c</mi><mn>4</mn></msup><mrow><mn>4</mn><mi>G</mi></mrow></mfrac></mrow><annotation encoding="TeX">\kappa = \frac{1}{M} \frac{c^4}{4G}</annotation></semantics></math>
		</td>
	</tr> 
	<tr>
		<td>Force de marées</td>
		<td>
			<input type="text" id="tid_text" size="12" onchange="set_tid()" />
		</td>
		<td> 
			<select id="tid_unit" size="1" onchange="get_tid()"> 
				<option value="is2" selected="selected">m/s&sup2;/m</option> 
				<option value="gpm">g/m</option> 
				<option value="gpf">g/ft</option>
			</select>
		</td>
		<td>
			<math display="block" xmlns="http://www.w3.org/1998/Math/MathML"><semantics><mrow><mi>d</mi><msub><mi>κ</mi><mi>R</mi></msub><mo>=</mo><mfrac><mn>1</mn><msup><mi>M</mi><mn>2</mn></msup></mfrac><mfrac><msup><mi>c</mi><mn>6</mn></msup><mrow><mn>4</mn><msup><mi>G</mi><mn>2</mn></msup></mrow></mfrac></mrow><annotation encoding="TeX">d\kappa_R = \frac{1}{M^2}\frac{c^6}{4G^2}</annotation></semantics></math>
		</td>
	</tr> 
	<tr>
		<td>Entropie</td>
		<td>
			<input type="text" id="ent_text" size="12" onchange="set_ent()" />
		</td>
		<td>Ø</td>
		<td>
			<math display="block" xmlns="http://www.w3.org/1998/Math/MathML"><semantics><mrow><mi>S</mi><mo>=</mo><msup><mi>M</mi><mn>2</mn></msup><mfrac><mrow><mn>4</mn><mi>π</mi><mi>G</mi></mrow><mrow><mi>ℏ</mi><mi>c</mi></mrow></mfrac></mrow><annotation encoding="TeX">S = M^2 \frac{4\pi G }{\hbar c}</annotation></semantics></math>
		</td>
	</tr>
	<tr>
		<td>Température</td>
		<td>
			<input type="text" id="tmp_text" size="12" onchange="set_tmp()" />
		</td>
		<td> 
			<select id="tmp_unit" size="1" onchange="get_tmp()"> 
				<option value="plT">Température de Planck</option> 
				<option value="K" selected="selected">K</option> 
				<option value="degC">&deg;C</option> 
				<option value="degF">&deg;F</option>
			</select>
		</td>
		<td>
			<math display="block" xmlns="http://www.w3.org/1998/Math/MathML"><semantics><mrow><mi>T</mi><mo>=</mo><mfrac><mn>1</mn><mi>M</mi></mfrac><mfrac><mrow><mi>ℏ</mi><msup><mi>c</mi><mn>3</mn></msup></mrow><mrow><mn>8</mn><mi>π</mi><msub><mi>k</mi><mi>B</mi></msub><mi>G</mi></mrow></mfrac></mrow><annotation encoding="TeX">T = \frac{1}{M}\frac{\hbar c^3}{8\pi k_BG}</annotation></semantics></math>
		</td>
	</tr>
	<tr>
		<td>Photons les plus énergétiques</td>
		<td>
			<input type="text" id="gamma_text" size="12" onchange="set_gamma()" />
		</td>
		<td> 
			<select id="gamma_unit" size="1" onchange="get_gamma()"> 
				<option value="ple">Énergie de Planck</option> 
				<option value="eV" selected="selected">eV</option> 
				<option value="keV">keV</option> 
				<option value="MeV">MeV</option> 
				<option value="GeV">GeV</option> 
				<option value="TeV">TeV</option> 
				<option value="km">km</option> 
				<option value="m">m</option> 
				<option value="mm">mm</option> 
				<option value="micron">&mu;m</option> 
				<option value="nm">nm</option> 
				<option value="A">Angström</option> 
				<option value="mHz">mHz</option> 
				<option value="Hz">Hz</option> 
				<option value="kHz">kHz</option> 
				<option value="MHz">MHz</option> 
				<option value="GHz">GHz</option> 
				<option value="THz">THz</option>
			</select>
		</td>
		<td>
			<math display="block" xmlns="http://www.w3.org/1998/Math/MathML"><semantics><mrow><msub><mi>λ</mi><mrow><mi>l</mi><mi>o</mi><mi>g</mi><mi>p</mi><mi>e</mi><mi>a</mi><mi>k</mi></mrow></msub><mo>=</mo><mfrac><mrow><mi>h</mi><mi>c</mi></mrow><mrow><msub><mi>k</mi><mi>B</mi></msub><mi>T</mi><mo stretchy="false">[</mo><mi>W</mi><mo stretchy="false">(</mo><mo>-</mo><mn>4</mn><msup><mi>e</mi><mrow><mo>-</mo><mn>4</mn></mrow></msup><mo stretchy="false">)</mo><mo>+</mo><mn>4</mn><mo stretchy="false">]</mo></mrow></mfrac></mrow><annotation encoding="TeX">\lambda_{logpeak}=\frac{hc}{k_BT[W(-4e^{-4})+4]}</annotation></semantics></math>
		</td>
	</tr>
	<tr>
		<td>Luminosité</td>
			<td>
				<input type="text" id="lum_text" size="12" onchange="set_lum()" />
			</td>
			<td> 
				<select id="lum_unit" size="1" onchange="get_lum()"> 
				<option value="plp">Puissance de Planck</option> 
				<option value="W" selected="selected">W</option> 
				<option value="cps">cal/s</option> 
				<option value="bps">BTU/s</option> 
				<option value="MW">MW</option> 
				<option value="mts">megatonnes/s</option> 
				<option value="lsol">L&odot;</option>
			</select>
		</td>
		<td>
			<math display="block" xmlns="http://www.w3.org/1998/Math/MathML"><semantics><mrow><mi>L</mi><mo>=</mo><mfrac><mn>1</mn><msup><mi>M</mi><mn>2</mn></msup></mfrac><mfrac><mrow><mi>ℏ</mi><msup><mi>c</mi><mn>6</mn></msup></mrow><mrow><mn>15360</mn><mi>π</mi><msup><mi>G</mi><mn>2</mn></msup></mrow></mfrac></mrow><annotation encoding="TeX">L = \frac{1}{M^2}\frac{\hbar c^6}{15360\pi G^2}</annotation></semantics></math>
		</td>
	</tr>
	<tr> 
		<td>Durée avant singularité</td> 
		<td>
			<input type="text" id="tts_text" size="12" onchange="set_tts()" />
		</td>
		<td> 
			<select id="tts_unit" size="1" onchange="get_tts()"> 
				<option value="plt">temps de Planck</option> 
				<option value="s" selected="selected">s</option> 
				<option value="mn">minutes</option> 
				<option value="h">heures</option> 
				<option value="d">jours</option> 
				<option value="yr">années</option> 
				<option value="Gyr">giga-années</option> 
			</select> 
		</td> 
		<td>
			<math display="block" xmlns="http://www.w3.org/1998/Math/MathML"><semantics><mrow><msub><mi>t</mi><mi>S</mi></msub><mo>=</mo><mfrac><mrow><mi>π</mi><mi>G</mi><mi>M</mi></mrow><msup><mi>c</mi><mn>3</mn></msup></mfrac></mrow><annotation encoding="TeX">t_S = \frac{\pi GM}{c^3}</annotation></semantics></math>
		</td> 
	</tr> 
	<tr>
		<td>Durée de vie</td>
		<td>
			<input type="text" id="tim_text" size="12" onchange="set_tim()" />
		</td>
		<td> 
			<select id="tim_unit" size="1" onchange="get_tim()"> 
				<option value="plt">temps de Planck</option> 
				<option value="s" selected="selected">secondes</option> 
				<option value="mn">minutes</option> 
				<option value="h">heures</option> 
				<option value="d">jours</option> 
				<option value="yr">années</option> 
				<option value="Gyr">giga-années</option> 
			</select>
		</td>
		<td>
			<math display="block" xmlns="http://www.w3.org/1998/Math/MathML"><semantics><mrow><mi>t</mi><mo>=</mo><msup><mi>M</mi><mn>3</mn></msup><mfrac><mrow><mn>5120</mn><mi>π</mi><msup><mi>G</mi><mn>2</mn></msup></mrow><mrow><mi>ℏ</mi><msup><mi>c</mi><mn>4</mn></msup></mrow></mfrac></mrow><annotation encoding="TeX">t = M^3 \frac{5120\pi G^2}{\hbar c^4}</annotation></semantics></math>
		</td>
	</tr>
</table> 


<div class="notes centrer">
	<p>Calculateur inspiré de <a href="https://www.vttoth.com/CMS/physics-notes/311-hawking-radiation-calculator">Viktor T. Toth - Hawking radiation calculator</a></p>
</div>

</section>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script>
'use strict'


// Hawking radiation calculator.


// inspired by the calculator by Viktor T. Toth
// at, https://www.vttoth.com/CMS/physics-notes/311-hawking-radiation-calculator
// itself inspirated by the (not available, as of July 1, 2016) Hawking radiation
// calculator of Jim Wisniewski, at http://xaonon.dyndns.org/hawking/ .

var ff = function(x) { return (1 * x).toPrecision(6).replace(/\.0+$/,'').replace(/\.0+e/,'e') }

var m  = 1;
var kg = 1;
var s  = 1;
var K  = 1;

var G    = 6.674e-11 * m * m * m / kg / s / s;
var c    = 299792458 * m / s;
var k    = 1.38064852e-23 * m * m * kg / s / s / K;
var hbar = 1.0545718e-34 * m * m * kg / s;
var pi   = 3.1415926535897932;

var R   = function() {return M * 2 * G / c / c; }
var A   = function() {return M * M * 16 * pi * G * G / c / c / c / c; }
var ka  = function() {return 1 / M * c * c * c * c / 4 / G; }
var dka = function() {return 1 / M / M * c * c * c * c * c * c / 4 / G / G; }
var S   = function() { return M * M * 4 * pi * G / hbar / c; }
var T   = function() { return 1 / M * hbar * c * c * c / 8 / k / pi / G; }
var L   = function() { return 1 / M / M * hbar * c * c * c * c * c * c / 15360 / pi / G / G; }
var t   = function() { return M * M * M * 5120 * pi * G * G / hbar / c / c / c / c; }
var tts = function() { return G * M * pi / c / c / c; }
var MR  = function(R) {return R / (2 * G / c / c); }
var MA  = function(A) {return Math.sqrt(A / (16 * pi * G * G / c / c / c / c)); }
var Mka = function(ka) {return 1 / ka * c * c * c * c / 4 / G; }
var MS  = function(S) { return Math.sqrt(S / (4 * pi * G / hbar / c)); }
var MT  = function(T) { return 1 / T * hbar * c * c * c / 8 / k / pi / G; }
var ML  = function(L) { return Math.sqrt(1 / L * hbar * c * c * c * c * c * c / 15360 / pi / G / G); }
var Mt  = function(t) { return Math.pow(t / 5120 / pi / G / G * hbar * c * c * c * c, 1/3); }

var plm    = Math.sqrt(hbar * c / G);
var ug     = 1e-9 * kg;
var g      = 1e-3 * kg;
var mton   = 1e3 * kg;
var neuble = 1e12 * kg;
var mearth = 5.972e24 * kg;
var msol   = 1.989e30 * kg;
var M      = msol;

var ple = plm * c * c;

var pll  = Math.sqrt(hbar * G / c / c / c);
var fm   = 1e-15 * m;
var nm   = 1e-9 * m;
var cm   = 1e-2 * m;
var inch = 0.0254 * m;
var ft   = 0.3048 * m;
var km   = 1e3 * m;
var mi   = 1609.344 * m;
var ls   = c * s;
var au   = 149597870700 * m;
var ly   = 9460730472580800 * m;

var pll2 = pll * pll;
var fm2  = fm * fm;
var barn = 1e-28 * m * m;
var cm2  = cm * cm;
var in2  = inch * inch;
var ft2  = ft * ft;
var m2   = m * m;
var km2  = km * km;
var mi2  = mi * mi;

var gal  = cm / s / s;
var fps2 = ft / s / s;
var mps2 = m / s / s;
var g0   = 9.80665 * m / s / s;

var is2 = 1 / s / s;
var gpm = g / m;
var gpf = g / ft;

var W    = m * m * kg / s / s / s;
var cps  = 4.184 * W;
var bps  = 1055.056 * W;
var MW   = 1e6 * W;
var mts  = 4.184e15 * W;
var lsol = 3.828e26 * W;
var plp  = c * c * c * c * c / G;

var plt = Math.sqrt(hbar * G / c / c / c / c / c);
var sh  = 1e-8 * s;
var mn  = 60 * s;
var h   = 3600 * s;
var d   = 86400 * s;
var yr  = 365.25 * d;
var Gyr = 1e9 * yr;

var plT = Math.sqrt(hbar * c * c * c * c * c / G / k / k);

var hc  = 2 * pi * hbar * c;
var JeV = 1.602176565e-19;

function init() {
	get_all();
}

function get_mass() { document.getElementById("mass_text").value = ff(M / eval(document.getElementById("mass_unit").value)); }
function  get_rad() { document.getElementById("rad_text").value  = ff(R() / eval(document.getElementById("rad_unit").value)); }
function  get_srf() { document.getElementById("srf_text").value  = ff(A() / eval(document.getElementById("srf_unit").value)); }
function  get_grv() { document.getElementById("grv_text").value  = ff(ka() / eval(document.getElementById("grv_unit").value)); }
function  get_tid() { document.getElementById("tid_text").value  = ff(dka() / eval(document.getElementById("tid_unit").value)); }
function  get_ent() { document.getElementById("ent_text").value  = ff(S()); }
function  get_lum() { document.getElementById("lum_text").value  = ff(L() / eval(document.getElementById("lum_unit").value)); }
function  get_tim() { document.getElementById("tim_text").value  = ff(t() / eval(document.getElementById("tim_unit").value)); }
function  get_tts() { document.getElementById("tts_text").value  = ff(tts() / eval(document.getElementById("tts_unit").value)); }

function get_tmp() {
	var tmp = T();
	switch (document.getElementById("tmp_unit").value) {
		case "C": tmp -= 273.15; break;
		case "F": tmp = tmp * 9 / 5 - 459.67; break;
		case "plT": tmp /= plT; break;
	}
	document.getElementById("tmp_text").value = ff(tmp);
}

function get_gamma() {
	var tmp = T();
	// var l = 2.8977729e-3 / tmp;
	var l = 3.669704081e-3 / tmp;

	switch (document.getElementById("gamma_unit").value)
	{
		case "km":
			l *= 0.001;
			break;
		case "mm":
			l *= 1000.0;
			break;
		case "micron":
			l *= 1e6;
			break;
		case "nm":
			l *= 1e9;
			break;
		case "A":
			l *= 1e10;
			break;
		case "mHz":
			l = 299792458e3 / l;
			break;
		case "Hz":
			l = 299792458 / l;
			break;
		case "kHz":
			l = 299792458e-3 / l;
			break;
		case "MHz":
			l = 299792458e-6 / l;
			break;
		case "GHz":
			l = 299792458e-9 / l;
			break;
		case "THz":
			l = 299792458e-12 / l;
			break;
		case "ple":
			l = hc / l / ple;
			break;
		case "eV":
			l = hc / l / JeV;
			break;
		case "keV":
			l = 1e-3 * hc / l / JeV;
			break;
		case "MeV":
			l = 1e-6 * hc / l / JeV;
			break;
		case "GeV":
			l = 1e-9 * hc / l / JeV;
			break;
		case "TeV":
			l = 1e-12 * hc / l / JeV;
			break;
	}
	document.getElementById("gamma_text").value = ff(l);
}

function get_all() {
	get_mass();
	get_rad();
	get_srf();
	get_grv();
	get_tid();
	get_ent();
	get_lum();
	get_tim();
	get_tts();
	get_tmp();
	get_gamma();
}

function set_mass() { M =      document.getElementById("mass_text").value * eval(document.getElementById("mass_unit").value); get_all(); }
function set_rad() {  M =   MR(document.getElementById("rad_text").value  * eval(document.getElementById("rad_unit").value)); get_all(); }
function set_srf() {  M =   MA(document.getElementById("srf_text").value  * eval(document.getElementById("srf_unit").value)); get_all(); }
function set_grv() {  M =  Mka(document.getElementById("grv_text").value  * eval(document.getElementById("grv_unit").value)); get_all(); }
function set_tid() {  M = Mdka(document.getElementById("tid_text").value  * eval(document.getElementById("tid_unit").value)); get_all(); }
function set_ent() {  M =   MS(document.getElementById("ent_text").value);                                                    get_all(); }
function set_lum() {  M =   ML(document.getElementById("lum_text").value  * eval(document.getElementById("lum_unit").value)); get_all(); }
function set_tim() {  M =   Mt(document.getElementById("tim_text").value  * eval(document.getElementById("tim_unit").value)); get_all(); }
function set_tts() {  M = Mtts(document.getElementById("tts_text").value  * eval(document.getElementById("tts_unit").value)); get_all(); }

function set_tmp() {
	var T = document.getElementById("tmp_text").value * 1.0;
	switch (document.getElementById("tmp_unit").value)
	{
		case "C": T += 273.15; break;
		case "F": T = (T + 459.67) * 5 / 9; break;
		case "plT": T *= plT; break;
	}
	M = MT(T);
	get_all();
}

function set_gamma() {
	var l = document.getElementById("gamma_text").value * 1.0;

	switch (document.getElementById("gamma_unit").value)
	{
		case "km":
			l *= 1000.0;
			break;
		case "mm":
			l *= 0.001;
			break;
		case "micron":
			l *= 1e-6;
			break;
		case "nm":
			l *= 1e-9;
			break;
		case "A":
			l *= 1e-10;
			break;
		case "mHz":
			l = 299792458e3 / l;
			break;
		case "Hz":
			l = 299792458 / l;
			break;
		case "kHz":
			l = 299792458e-3 / l;
			break;
		case "MHz":
			l = 299792458e-6 / l;
			break;
		case "GHz":
			l = 299792458e-9 / l;
			break;
		case "THz":
			l = 299792458e-12 / l;
			break;
		case "ple":
			l = hc / l / ple;
			break;
		case "eV":
			l = hc / l / JeV;
			break;
		case "keV":
			l = 1e-3 * hc / l / JeV;
			break;
		case "MeV":
			l = 1e-6 * hc / l / JeV;
			break;
		case "GeV":
			l = 1e-9 * hc / l / JeV;
			break;
		case "TeV":
			l = 1e-12 * hc / l / JeV;
			break;
	}
	// var T = 2.898e-3 / l;
	var T = 3.669704081e-3 / l;
	M = MT(T);
	get_all();
}

init(); 

</script>
<!--


# adresse de la page : https://lehollandaisvolant.net/tout/tools/blackhole/
#      page créée le : 27 mai 2019
#     mise à jour le : 27 mai 2019

-->
</body>
</html>
