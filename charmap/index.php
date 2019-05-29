<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="A character map in javascript" />

	<title>Table des caractères - le hollandais volant</title>

	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

#main-form {
	max-width: 1000px;
}
#chartable {
	margin: 2em auto;
	text-align: center;
	vertical-align: middle;
}

#chartable td {
	width: 50px;
	height: 50px;
	position: relative;
}

#chartable td button {
	font-family: "Noto Sans", 'Arial Unicode MS', Arial, sans-serif;
	height: 50px;
	width: 50px;
	font-size: 1.8em;
	position: relative;
}

#chartable td button:hover {
	height: 90px;
	width: 90px;
	position: absolute;
	top: -20px;
	left: -20px;
	z-index:+1;
	font-size: 4em;
	box-shadow: 1px 1px 10px silver;
}

#output {
	background: #eee;
	border: silver 1px solid;
	border-radius: 2px;
	padding: 15px;
	margin: 20px auto
	width: 100%;
}


	</style>
</head>
<body>


<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Table de caractères</a></p>
</header>



<section id="main-form" class="main-form">
<!--<p>HTML: <input id="htmloutput" size="40" readonly="readonly" type="text"><button onclick="htmlify()">Make HTML</button></p>-->
<p class="centrer"><label for="scriptList">Sélectionnez le script que vous voulez :</label>
	<select id="scriptList" name="scriptList" onchange="initTable()">
		<optgroup label="Latin Script">
			<option value="00" selected>00: Basic Latin, Latin 1</option>
			<option value="01">01: Latin ext A, Latin ext B</option>
			<option value="02">02: Latin ext B cont</option>
			<option value="1E">1E: Latin Extended Additional</option>
	   </optgroup>
	   <optgroup label="CJK (Chinese, Japanese, Korean)">
			<option value="2E">2E: CJK Radicals Supplement</option>
			<option value="30">30: CJK Syms+Punct, Hiragana, Katakana</option>
			<option value="32">32: CJK Enclosed Letters and Months</option>
			<option value="4E">4E: CJK Unified Ideographs (1)</option>
			<option value="9F">9F: CJK Unified Ideographs (2)</option>
			<option value="33">33: CJK Compatibility, Physics Units</option>
			<option value="34">34: CJK Unified Ideographs Extension A</option>
			<option value="F9">F9: CJK Compatibility Ideographs (1)</option>
			<option value="FA">FA: CJK Compatibility Ideographs (2)</option>
			<option value="2F">2F: J. Kanji Radicals,Ideographic DescChars</option>
			<option value="31">31: K. Hangul Compat Jamo, Bopomofo</option>
			<option value="11">11: K. Hangul Jamo</option>
			<option value="AC">AC: K. Hangul Syllables (1)</option>
			<option value="AD">AD: K. Hangul Syllables (2)</option>
			<option value="AE">AE: K. Hangul Syllables (3)</option>
			<option value="AF">AF: K. Hangul Syllables (4)</option>
			<option value="B0">B0: K. Hangul Syllables (5)</option>
			<option value="B1">B1: K. Hangul Syllables (6)</option>
			<option value="B2">B2: K. Hangul Syllables (7)</option>
			<option value="B3">B3: K. Hangul Syllables (8)</option>
			<option value="B4">B4: K. Hangul Syllables (9)</option>
			<option value="B5">B5: K. Hangul Syllables (10)</option>
			<option value="B6">B6: K. Hangul Syllables (11)</option>
			<option value="B7">B7: K. Hangul Syllables (12)</option>
			<option value="B8">B8: K. Hangul Syllables (13)</option>
			<option value="B9">B9: K. Hangul Syllables (14)</option>
			<option value="BA">BA: K. Hangul Syllables (15)</option>
			<option value="BB">BB: K. Hangul Syllables (16)</option>
			<option value="BC">BC: K. Hangul Syllables (17)</option>
			<option value="BD">BD: K. Hangul Syllables (18)</option>
			<option value="BE">BE: K. Hangul Syllables (19)</option>
			<option value="BF">BF: K. Hangul Syllables (20)</option>
			<option value="C0">C0: K. Hangul Syllables (21)</option>
			<option value="C1">C1: K. Hangul Syllables (22)</option>
			<option value="C2">C2: K. Hangul Syllables (23)</option>
			<option value="C3">C3: K. Hangul Syllables (24)</option>
			<option value="C4">C4: K. Hangul Syllables (25)</option>
			<option value="C5">C5: K. Hangul Syllables (26)</option>
			<option value="C6">C6: K. Hangul Syllables (27)</option>
			<option value="C7">C7: K. Hangul Syllables (28)</option>
			<option value="C8">C8: K. Hangul Syllables (29)</option>
			<option value="C9">C9: K. Hangul Syllables (30)</option>
			<option value="CA">CA: K. Hangul Syllables (31)</option>
			<option value="CC">CC: K. Hangul Syllables (32)</option>
			<option value="CC">CC: K. Hangul Syllables (33)</option>
			<option value="CD">CD: K. Hangul Syllables (34)</option>
			<option value="CE">CE: K. Hangul Syllables (35)</option>
			<option value="CF">CF: K. Hangul Syllables (36)</option>
			<option value="D0">D0: K. Hangul Syllables (37)</option>
			<option value="D1">D1: K. Hangul Syllables (38)</option>
			<option value="D2">D2: K. Hangul Syllables (39)</option>
			<option value="D3">D3: K. Hangul Syllables (40)</option>
			<option value="D4">D4: K. Hangul Syllables (41)</option>
			<option value="D5">D5: K. Hangul Syllables (42)</option>
			<option value="D6">D6: K. Hangul Syllables (43)</option>
			<option value="D7">D7: K. Hangul Syllables (44)</option>
			<option value="D8">D8: K. Hangul Syllables (45)</option>
			<option value="D9">D9: K. Hangul Syllables (46)</option>

			<option value="35">35: C. Han (1)</option>
			<option value="36">36: C. Han (2)</option>
			<option value="37">37: C. Han (3)</option>
			<option value="38">38: C. Han (4)</option>
			<option value="39">39: C. Han (5)</option>
			<option value="3A">3A: C. Han (6)</option>
			<option value="3B">3B: C. Han (7)</option>
			<option value="3C">3C: C. Han (8)</option>
			<option value="3D">3D: C. Han (9)</option>
			<option value="3E">3E: C. Han (10)</option>
			<option value="3F">3F: C. Han (11)</option>
			<option value="40">40: C. Han (12)</option>
			<option value="41">41: C. Han (13)</option>
			<option value="42">42: C. Han (14)</option>
			<option value="43">43: C. Han (15)</option>
			<option value="44">44: C. Han (16)</option>
			<option value="45">45: C. Han (17)</option>
			<option value="46">46: C. Han (18)</option>
			<option value="47">47: C. Han (19)</option>
			<option value="48">48: C. Han (20)</option>
			<option value="49">49: C. Han (21)</option>
			<option value="4A">4A: C. Han (22)</option>
			<option value="4B">4B: C. Han (23)</option>
			<option value="4C">4C: C. Han (24)</option>
			<option value="4D">4D: C. Han (25)</option>
			<option value="4E">4E: C. Han (26)</option>
			<option value="4F">4F: C. Han (27)</option>
			<option value="50">50: C. Han (28)</option>
			<option value="51">51: C. Han (29)</option>
			<option value="52">52: C. Han (30)</option>
			<option value="53">53: C. Han (31)</option>
			<option value="54">54: C. Han (32)</option>
			<option value="55">55: C. Han (33)</option>
			<option value="56">56: C. Han (34)</option>
			<option value="57">57: C. Han (35)</option>
			<option value="58">58: C. Han (36)</option>
			<option value="59">59: C. Han (37)</option>
			<option value="5A">5A: C. Han (38)</option>
			<option value="5B">5B: C. Han (38)</option>
			<option value="5C">5C: C. Han (40)</option>
			<option value="5D">5D: C. Han (41)</option>
			<option value="5E">5E: C. Han (42)</option>
			<option value="5F">5F: C. Han (43)</option>


	   </optgroup>
	   <optgroup label="Cyrillic">
			<option value="04">04: Cyrillic</option>
			<option value="05">05: Cyrillic Supp., Armenian, Hebrew</option>
	   </optgroup>
	   <optgroup label="Maths, Technical">
			<option value="22">22: Mathematical Operators</option>
			<option value="21">21: Letterlike Symbols, Number Forms, Arrows</option>
			<option value="29">29: Suppl. Arrows, Misc Math Symbols</option>
			<option value="2A">2A: Suppl. Mathematical Operators</option>
			<option value="23">23: Misc. Technical</option>
			<option value="20">20: Punctuation, Sub-Superscripts, Currency</option>
	   </optgroup>
	   <optgroup label="Symbols">
			<option value="25">25: Box Drawing, Block Elem, Geom Shapes</option>
			<option value="27">27: Dingbats, Misc.Math-A, Supp.Arrows-A</option>
			<option value="26">26: Misc. Symbols</option>
			<option value="2B">2B: Misc. Symbols and Arrows</option>
			<option value="24">24: Ctl Picts, OCR, Encl Alphanumerics</option>
			<option value="28">28: Braille</option>
			<option value="E0">E0: Private Use Area (1)</option>
			<option value="F8">F8: Private Use Area (2)</option>
			<option value="FE">FE: (misc)</option>
	   </optgroup>
	   <optgroup label="Greek">
			<option value="03">03: Diacrit, Greek, Coptic</option>
			<option value="1F">1F: Greek Extended</option>
	   </optgroup>

	   <optgroup label="Arabic">
			<option value="06">06: Arabic</option>
			<option value="FB">FB: Alpha &amp; Arabic Presnetation Forms-A (1)</option>
			<option value="FC">FC: Arabic Presnetation Forms-A (2)</option>
			<option value="FD">FD: Arabic Presentation Forms-A (3)</option>
	   </optgroup>

		<option value="07">07: Syriac, Thaana</option>
		<option value="09">09: Devanagari, Bengali</option>
		<option value="0A">0A: Gurmukhi, Gujarati</option>
		<option value="0B">0B: Oriya, Tamil</option>
		<option value="0C">0C: Telugu, Kannada</option>
		<option value="0D">0D: Malayalam, Sinhala</option>
		<option value="0E">0E: Thai, Lao</option>
		<option value="0F">0F: Tibetan</option>
		<option value="10">10: Mayanmar, Georgian</option>
		<option value="12">12: Ethiopic</option>
		<option value="13">13: Ethiopic, Cherokee</option>
		<option value="17">17: Tagalog, Hanunoo, Buhid, Tagbanwa, Khmer</option>
		<option value="18">18: Mongolian</option>
		<option value="19">19: Limbu, Tai Le, Khmer Symbols</option>
		<option value="1D">1D: Phonetic Extensions</option>
		<option value="4D">4D: Yijing Hexagram Symbols</option>
		<option value="A0">A0: Yi Syllables (1)</option>
		<option value="A9">A9: Kayah Li</option>
		<option value="A4">A4: Yi Syllables (2), Yi Radicals</option>
	<!--	<option value="D8">D8: High Surrogates (1)</option>
		<option value="DB">DB: High Surrogates (2)</option>
		<option value="DC">DC: Low Surrogates (1)</option>
		<option value="DF">DF: Low Surrogates (2)</option>-->
		<option value="14">14: Canadian Syllabics (1)</option>
		<option value="15">15: Canadian Syllabics (2)</option>
		<option value="16">16: Canadian Syllabics (3) + Nordics Runes</option>
		<option value="18">18: Canadian Syllabics (4)</option>
		<option value="FF">FF: Halfwidth + Fullwidth Forms, Specials</option>
	</select>
</p>
<table id="chartable"></table>

<p id="output">Récupérez vos caractères : <input id="myinput" size="60" type="text"/></p>


<div class="notes">
<p>Inspiré d’une idée d’Alan Iwi <a href="http://www.certifiedchinesetranslation.com/openaccess/charmap.htm">Table Unicode en ligne</a>, sous licence GPL.</p>
<p>Le rendu est optimal avec la police <a href="https://en.wikipedia.org/wiki/Arial_Unicode_MS">Arial Unicode MS</a> ou les polices du projet Noto.</p>
</div>
</section>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script>
'use strict';

//---------------------
var chartable = document.querySelector('#chartable');

//---------------------
// Generates HTML table
function initHtmlTable() {
	var table = document.getElementById('chartable');

	// first row : "xX" content
	var firstRow = document.createElement('tr');
	var firstCell = document.createElement('td'); // empty
	firstRow.appendChild(firstCell);

	// gen first row TDs
	for (var c=0 ; c<=15 ; c++) {
		var cell = document.createElement('td');
		cell.textContent = 'x'+c.toString(16).toUpperCase();
		firstRow.appendChild(cell);
	}
	table.appendChild(firstRow);
	
	// gen other rows
	for (var r=0 ; r<=15 ; r++) {
		var row = document.createElement('tr');
		// first cell : "Xx" content
		var cell = document.createElement('td');
		cell.textContent = r.toString(16).toUpperCase()+'x';
		row.appendChild(cell);

		// gen cells
		for (var c=0 ; c<=15 ; c++) {
			var cell = document.createElement('td');
			var button = document.createElement('button');
			button.addEventListener("click", function(){ insert(this); }, false);
			button.id = 'c'+r.toString(16).toUpperCase()+''+c.toString(16).toUpperCase();

			cell.appendChild(button);	
			row.appendChild(cell);
		}
		table.appendChild(row);
	}

	// append table to document
	var mainForm = document.getElementById('main-form');
	//mainForm.appendChild(table);

}

// Generates unicode chars in table
function initTable() {
	var d3 = document.querySelector('#scriptList').value.charAt(0);
	var d2 = document.querySelector('#scriptList').value.charAt(1);

	for (var row=0 ; row<16 ; row++) {

		var d1 = row.toString(16).toUpperCase();
		var ctrl=(d3==0 && d2==0 && d1<=1); // remove escape chars (tab, space, \n, etc.)
		for (var cell=0 ; cell<16 ; cell++) {
			var d0 = cell.toString(16).toUpperCase();
			document.querySelector('#c'+d1+d0).textContent = "";
			if (!ctrl) {
				document.querySelector('#c'+d1+d0).textContent = String.fromCharCode(parseInt(d3+d2+d1+d0,16));
			}
		}
		
	}
}


//---------------------
function utf8(text) 
{
    // NB this function is valid up to uFFFF; would need extending
    // for >2 byte characters 
    var enc = "";
    for(var pos=0; pos<text.length; pos++)
    {
        var c=text.charCodeAt(pos);
	if (c<128)
	{
	    enc += escape(text.charAt(pos));
	}
	else if(c<2048)
	{
	    enc += hex((c>>6)|192);
	    enc += hex((c&63)|128);
	}
	else
	{
	    enc += hex((c>>12)|224);
	    enc += hex(((c>>6)&63)|128);
	    enc += hex((c&63)|128);
	}
    }
    return enc;
}

//---------------------
function html(text) {
	var enc = "";
	for(var pos=0; pos<text.length; pos++)
	{
		var c=text.charCodeAt(pos);
		if (c==60) {
			enc += "&lt;";
		}
		else if (c==62) {
			enc += "&gt;";
		}
		else if (c==38) {
			enc += "&amp;";
		}
		else if (c>=32 && c<128) {
			enc += text.charAt(pos);
		}
		else {
			enc += "&#"+c+";";
		}
	}
	return enc;
}

//---------------------

function insert(button) {
	document.querySelector('#myinput').value += button.textContent;
}

//---------------------

function htmlify() {
	document.querySelector('#htmloutput').value=html(document.querySelector('#myinput').value);
	document.querySelector('#htmloutput').focus();
}

//---------------------
// Generates table and populate it with unicode date
(function(){
	initHtmlTable();
	initTable();
})();

//---------------------
//-->

</script>
<!--

# adresse de la page : https://lehollandaisvolant.net/tout/tools/charmap/
#      page créée le : 30 mai 2015
#     mise à jour le : 7 novembre 2018

-->
</body>
</html>