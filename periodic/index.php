<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Un petit jeu pour tester ou apprendre le tableau périodique des éléments." />

	<title>Connaissez-vous le tableau périodique ? - le hollandais volant</title>

	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>

.main-form {
	max-width: 1400px;
}

table {
	border-spacing: 5px;
	border-collapse: separate;
	text-align: center;
	margin: auto;
}

table td.element {
	border: 1px solid silver;
	border-radius: 3px;
	width: 60px;
	height: 60px;
	cursor: pointer;
}

table td.element > span {
	visibility: hidden;
	display: block;
	font-size: 0.58em;
	height: 1em;
}

/* atomic Symbol */
table td span:nth-of-type(2) {
	font-size: 1em;
}
table td.withsymbols span:nth-of-type(2) {
	visibility: visible;
}

/* atom name */
table td.withnames span:nth-of-type(3) {
	visibility: visible;
}

/* atom number */
table td.withnumbers > span:nth-of-type(1) {
	visibility: visible;
}

table td.element > span[class^=userinput] {
	visibility: visible;
}

table td.color-red {
	background-color: lightcoral;
}
table td.color-green {
	background-color: lightgreen;
}
table td.color-yellow {
	background-color: lightyellow;
}

#outPartiallyRight,
#outRight,
#outWrong {
	text-align: left;
}

#buttons {
	max-width:500px;
	margin: 0 auto;
	text-align: right;
}
#buttons label,
#buttons input {
	vertical-align: middle;
}



.popupWrap {
	position: absolute;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
	display: flex;
	justify-content: center;
	align-items: center;
}

.popup {
	border: 1px solid silver;
	width: 250px;
	border-radius: 3px;
	box-shadow: 10px 10px 30px rgba(0, 0, 0, .4);
	background: white;
	padding: 20px 30px;
	resize: both;
	overflow: hidden;
	display: flex;
	flex-direction: column;
	justify-content: center;
}

.popup > h2 {
	margin-top: 0;
	font-size: 1.2em;
}

.popup > label {
	display: block;
	width: 260px;
	text-align: right;
	padding: 5px 0;
	margin: 0 auto;
}

.popup > label > input {
	width: 140px;
}

.popup button {
	width: 110px;
	margin: 15px auto 0;
	cursor: pointer;
}



</style>
</head>
<body>

<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Connaissez-vous le tableau périodique ?</a></p>
</header>

<section class="main-form">
	<div id="buttons">
		<p><label>Afficher les noms <input type="checkbox" onchange="showNames(this)" /></label>
		<p><label>Afficher les symboles <input type="checkbox" onchange="showSymbols(this)"/></label>
		<p><label>Afficher les numéros atomiques <input type="checkbox" onchange="showNumbers(this)" /></label>
		<p><button type="button" class="button button-other" onclick="resetAll()">Réinitialiser</button> <button type="button" class="button button-submit" onclick="verifyAll()">Vérifier Score</button></p>

	</div>
	<table id="tableau">
	<tbody>
		<tr>
			<td class="element" data-number="1"   data-symbol="H"  data-fullname="Hydrogène"><span>1</span><span>H</span><span>Hydrogène</span></td>
			<td colspan="2"></td>
			<td colspan="8" rowspan="2">
				<table>
					<tr><td id="outRight"> </td></tr>
					<tr><td id="outPartiallyRight"> </td></tr>
					<tr><td id="outWrong"> </td></tr>
				</table>
				
			</td>
			<td colspan="6"></td>
			<td class="element" data-number="2"   data-symbol="He" data-fullname="Hélium"><span>2</span><span>He</span><span>Hélium</span></td>
		</tr>
		<tr>
			<td class="element" data-number="3"   data-symbol="Li" data-fullname="Lithium"><span>3</span><span>Li</span><span>Lithium</span></td>
			<td class="element" data-number="4"   data-symbol="Be" data-fullname="Béryllium"><span>4</span><span>Be</span><span>Béryllium</span></td>
			<td colspan="1"></td>
			<td colspan="1"></td>
			<td class="element" data-number="5"   data-symbol="B"  data-fullname="Bore"><span>5</span><span>B</span><span>Bore</span></td>
			<td class="element" data-number="6"   data-symbol="C"  data-fullname="Carbone"><span>6</span><span>C</span><span>Carbone</span></td>
			<td class="element" data-number="7"   data-symbol="N"  data-fullname="Azote"><span>7</span><span>N</span><span>Azote</span></td>
			<td class="element" data-number="8"   data-symbol="O"  data-fullname="Oxygène"><span>8</span><span>O</span><span>Oxygène</span></td>
			<td class="element" data-number="9"   data-symbol="F"  data-fullname="Fluor"><span>9</span><span>F</span><span>Fluor</span></td>
			<td class="element" data-number="10"  data-symbol="Ne" data-fullname="Néon"><span>10</span><span>Ne</span><span>Néon</span></td>
		</tr>
		<tr>
			<td class="element" data-number="11"  data-symbol="Na" data-fullname="Sodium"><span>11</span><span>Na</span><span>Sodium</span></td>
			<td class="element" data-number="12"  data-symbol="Mg" data-fullname="Magnésium"><span>12</span><span>Mg</span><span>Magnésium</span></td>
			<td colspan="10"></td>
			<td class="element" data-number="13"  data-symbol="Al" data-fullname="Aluminium"><span>13</span><span>Al</span><span>Aluminium</span></td>
			<td class="element" data-number="14"  data-symbol="Si" data-fullname="Silicium"><span>14</span><span>Si</span><span>Silicium</span></td>
			<td class="element" data-number="15"  data-symbol="P"  data-fullname="Phosphore"><span>15</span><span>P</span><span>Phosphore</span></td>
			<td class="element" data-number="16"  data-symbol="S"  data-fullname="Soufre"><span>16</span><span>S</span><span>Soufre</span></td>
			<td class="element" data-number="17"  data-symbol="Cl" data-fullname="Chlore"><span>17</span><span>Cl</span><span>Chlore</span></td>
			<td class="element" data-number="18"  data-symbol="Ar" data-fullname="Argon"><span>18</span><span>Ar</span><span>Argon</span></td>
		</tr>
		<tr>
			<td class="element" data-number="19"  data-symbol="K"  data-fullname="Potassium"><span>19</span><span>K</span><span>Potassium</span></td>
			<td class="element" data-number="20"  data-symbol="Ca" data-fullname="Calcium"><span>20</span><span>Ca</span><span>Calcium</span></td>
			<td class="element" data-number="21"  data-symbol="Sc" data-fullname="Scandium"><span>21</span><span>Sc</span><span>Scandium</span></td>
			<td class="element" data-number="22"  data-symbol="Ti" data-fullname="Titane"><span>22</span><span>Ti</span><span>Titane</span></td>
			<td class="element" data-number="23"  data-symbol="V"  data-fullname="Vanadium"><span>23</span><span>V</span><span>Vanadium</span></td>
			<td class="element" data-number="24"  data-symbol="Cr" data-fullname="Chrome"><span>24</span><span>Cr</span><span>Chrome</span></td>
			<td class="element" data-number="25"  data-symbol="Mn" data-fullname="Manganèse"><span>25</span><span>Mn</span><span>Manganèse</span></td>
			<td class="element" data-number="26"  data-symbol="Fe" data-fullname="Fer"><span>26</span><span>Fe</span><span>Fer</span></td>
			<td class="element" data-number="27"  data-symbol="Co" data-fullname="Cobalt"><span>27</span><span>Co</span><span>Cobalt</span></td>
			<td class="element" data-number="28"  data-symbol="Ni" data-fullname="Nickel"><span>28</span><span>Ni</span><span>Nickel</span></td>
			<td class="element" data-number="29"  data-symbol="Cu" data-fullname="Cuivre"><span>29</span><span>Cu</span><span>Cuivre</span></td>
			<td class="element" data-number="30"  data-symbol="Zn" data-fullname="Zinc"><span>30</span><span>Zn</span><span>Zinc</span></td>
			<td class="element" data-number="31"  data-symbol="Ga" data-fullname="Gallium"><span>31</span><span>Ga</span><span>Gallium</span></td>
			<td class="element" data-number="32"  data-symbol="Ge" data-fullname="Germanium"><span>32</span><span>Ge</span><span>Germanium</span></td>
			<td class="element" data-number="33"  data-symbol="As" data-fullname="Arsenic"><span>33</span><span>As</span><span>Arsenic</span></td>
			<td class="element" data-number="34"  data-symbol="Se" data-fullname="Sélénium"><span>34</span><span>Se</span><span>Sélénium</span></td>
			<td class="element" data-number="35"  data-symbol="Br" data-fullname="Brome"><span>35</span><span>Br</span><span>Brome</span></td>
			<td class="element" data-number="36"  data-symbol="Kr" data-fullname="Krypton"><span>36</span><span>Kr</span><span>Krypton</span></td>
		</tr>
		<tr>
			<td class="element" data-number="37"  data-symbol="Rb" data-fullname="Rubidium"><span>37</span><span>Rb</span><span>Rubidium</span></td>
			<td class="element" data-number="38"  data-symbol="Sr" data-fullname="Strontium"><span>38</span><span>Sr</span><span>Strontium</span></td>
			<td class="element" data-number="39"  data-symbol="Y"  data-fullname="Yttrium"><span>39</span><span>Y</span><span>Yttrium</span></td>
			<td class="element" data-number="40"  data-symbol="Zr" data-fullname="Zirconium"><span>40</span><span>Zr</span><span>Zirconium</span></td>
			<td class="element" data-number="41"  data-symbol="Nb" data-fullname="Niobium"><span>41</span><span>Nb</span><span>Niobium</span></td>
			<td class="element" data-number="42"  data-symbol="Mo" data-fullname="Molybdène"><span>42</span><span>Mo</span><span>Molybdène</span></td>
			<td class="element" data-number="43"  data-symbol="Tc" data-fullname="Technétium"><span>43</span><span>Tc</span><span>Technétium</span></td>
			<td class="element" data-number="44"  data-symbol="Ru" data-fullname="Ruthénium"><span>44</span><span>Ru</span><span>Ruthénium</span></td>
			<td class="element" data-number="45"  data-symbol="Rh" data-fullname="Rhodium"><span>45</span><span>Rh</span><span>Rhodium</span></td>
			<td class="element" data-number="46"  data-symbol="Pd" data-fullname="Palladium"><span>46</span><span>Pd</span><span>Palladium</span></td>
			<td class="element" data-number="47"  data-symbol="Ag" data-fullname="Argent"><span>47</span><span>Ag</span><span>Argent</span></td>
			<td class="element" data-number="48"  data-symbol="Cd" data-fullname="Cadmium"><span>48</span><span>Cd</span><span>Cadmium</span></td>
			<td class="element" data-number="49"  data-symbol="In" data-fullname="Indium"><span>49</span><span>In</span><span>Indium</span></td>
			<td class="element" data-number="50"  data-symbol="Sn" data-fullname="Étain"><span>50</span><span>Sn</span><span>Étain</span></td>
			<td class="element" data-number="51"  data-symbol="Sb" data-fullname="Antimoine"><span>51</span><span>Sb</span><span>Antimoine</span></td>
			<td class="element" data-number="52"  data-symbol="Te" data-fullname="Tellure"><span>52</span><span>Te</span><span>Tellure</span></td>
			<td class="element" data-number="53"  data-symbol="I"  data-fullname="Iode"><span>53</span><span>I</span><span>Iode</span></td>
			<td class="element" data-number="54"  data-symbol="Xe" data-fullname="Xénon"><span>54</span><span>Xe</span><span>Xénon</span></td>
		</tr>
		<tr>
			<td class="element" data-number="55"  data-symbol="Cs" data-fullname="Césium"><span>55</span><span>Cs</span><span>Césium</span></td>
			<td class="element" data-number="56"  data-symbol="Ba" data-fullname="Baryum"><span>56</span><span>Ba</span><span>Baryum</span></td>
			<td></td>
			<td class="element" data-number="72"  data-symbol="Hf" data-fullname="Hafnium"><span>72</span><span>Hf</span><span>Hafnium</span></td>
			<td class="element" data-number="73"  data-symbol="Ta" data-fullname="Tantale"><span>73</span><span>Ta</span><span>Tantale</span></td>
			<td class="element" data-number="74"  data-symbol="W"  data-fullname="Tungstène"><span>74</span><span>W</span><span>Tungstène</span></td>
			<td class="element" data-number="75"  data-symbol="Re" data-fullname="Rhénium"><span>75</span><span>Re</span><span>Rhénium</span></td>
			<td class="element" data-number="76"  data-symbol="Os" data-fullname="Osmium"><span>76</span><span>Os</span><span>Osmium</span></td>
			<td class="element" data-number="77"  data-symbol="Ir" data-fullname="Iridium"><span>77</span><span>Ir</span><span>Iridium</span></td>
			<td class="element" data-number="78"  data-symbol="Pt" data-fullname="Platine"><span>78</span><span>Pt</span><span>Platine</span></td>
			<td class="element" data-number="79"  data-symbol="Au" data-fullname="Or"><span>79</span><span>Au</span><span>Or</span></td>
			<td class="element" data-number="80"  data-symbol="Hg" data-fullname="Mercure"><span>80</span><span>Hg</span><span>Mercure</span></td>
			<td class="element" data-number="81"  data-symbol="Tl" data-fullname="Thallium"><span>81</span><span>Tl</span><span>Thallium</span></td>
			<td class="element" data-number="82"  data-symbol="Pb" data-fullname="Plomb"><span>82</span><span>Pb</span><span>Plomb</span></td>
			<td class="element" data-number="83"  data-symbol="Bi" data-fullname="Bismuth"><span>83</span><span>Bi</span><span>Bismuth</span></td>
			<td class="element" data-number="84"  data-symbol="Po" data-fullname="Polonium"><span>84</span><span>Po</span><span>Polonium</span></td>
			<td class="element" data-number="85"  data-symbol="At" data-fullname="Astate"><span>85</span><span>At</span><span>Astata</span></td>
			<td class="element" data-number="86"  data-symbol="Rn" data-fullname="Radon"><span>86</span><span>Rn</span><span>Radon</span></td>
		</tr>
		<tr>
			<td class="element" data-number="87"  data-symbol="Fr" data-fullname="Francium"><span>87</span><span>Fr</span><span>Francium</span></td>
			<td class="element" data-number="88"  data-symbol="Ra" data-fullname="Radium"><span>88</span><span>Ra</span><span>Radium</span></td>
			<td></td>
			<td class="element" data-number="104" data-symbol="Rf" data-fullname="Rutherfordium"><span>104</span><span>Rf</span><span>Rutherfordium</span></td>
			<td class="element" data-number="105" data-symbol="Db" data-fullname="Dubnium"><span>105</span><span>Db</span><span>Dubnium</span></td>
			<td class="element" data-number="106" data-symbol="Sg" data-fullname="Seaborgium"><span>106</span><span>Sg</span><span>Seaborgium</span></td>
			<td class="element" data-number="107" data-symbol="Bh" data-fullname="Bohrium"><span>107</span><span>Bh</span><span>Bohrium</span></td>
			<td class="element" data-number="108" data-symbol="Hs" data-fullname="Hassium"><span>108</span><span>Hs</span><span>Hassium</span></td>
			<td class="element" data-number="109" data-symbol="Mt" data-fullname="Meitnerium"><span>109</span><span>Mt</span><span>Meitnerium</span></td>
			<td class="element" data-number="110" data-symbol="Ds" data-fullname="Darmstadtium"><span>110</span><span>Ds</span><span>Darmstadtium</span></td>
			<td class="element" data-number="111" data-symbol="Rg" data-fullname="Roentgenium"><span>111</span><span>Rg</span><span>Roentgenium</span></td>
			<td class="element" data-number="112" data-symbol="Cn" data-fullname="Copernicium"><span>112</span><span>Cn</span><span>Copernicium</span></td>
			<td class="element" data-number="113" data-symbol="Nh" data-fullname="Nihonium"><span>113</span><span>Nh</span><span>Nihonium</span></td>
			<td class="element" data-number="114" data-symbol="Fl" data-fullname="Flérovium"><span>114</span><span>Fl</span><span>Flérovium</span></td>
			<td class="element" data-number="115" data-symbol="Mc" data-fullname="Moscovium"><span>115</span><span>Mc</span><span>Moscovium</span></td>
			<td class="element" data-number="116" data-symbol="Lv" data-fullname="Livermorium"><span>116</span><span>Lv</span><span>Livermorium</span></td>
			<td class="element" data-number="117" data-symbol="Ts" data-fullname="Tennesse"><span>117</span><span>Ts</span><span>Tennesse</span></td>
			<td class="element" data-number="118" data-symbol="Og" data-fullname="Oganesson"><span>118</span><span>Og</span><span>Oganesson</span></td>
		</tr>
		<tr>
			<td colspan="18"></td>
		</tr>
		<tr>
			<td colspan="2"></td>
			<td class="element" data-number="57"  data-symbol="La" data-fullname="Lanthane"><span>57</span><span>La</span><span>Lanthane</span></td>
			<td class="element" data-number="58"  data-symbol="Ce" data-fullname="Cérium"><span>58</span><span>Ce</span><span>Cérium</span></td>
			<td class="element" data-number="59"  data-symbol="Pr" data-fullname="Praséodyme"><span>59</span><span>Pr</span><span>Praséodyme</span></td>
			<td class="element" data-number="60"  data-symbol="Nd" data-fullname="Néodyme"><span>60</span><span>Nd</span><span>Néodyme</span></td>
			<td class="element" data-number="61"  data-symbol="Pm" data-fullname="Prométhium"><span>61</span><span>Pm</span><span>Prométhium</span></td>
			<td class="element" data-number="62"  data-symbol="Sm" data-fullname="Samarium"><span>62</span><span>Sm</span><span>Samarium</span></td>
			<td class="element" data-number="63"  data-symbol="Eu" data-fullname="Europium"><span>63</span><span>Eu</span><span>Europium</span></td>
			<td class="element" data-number="64"  data-symbol="Gd" data-fullname="Gadolinium"><span>64</span><span>Gd</span><span>Gadolinium</span></td>
			<td class="element" data-number="65"  data-symbol="Tb" data-fullname="Terbium"><span>65</span><span>Tb</span><span>Terbium</span></td>
			<td class="element" data-number="66"  data-symbol="Dy" data-fullname="Dysprosium"><span>66</span><span>Dy</span><span>Dysprosium</span></td>
			<td class="element" data-number="67"  data-symbol="Ho" data-fullname="Holmium"><span>67</span><span>Ho</span><span>Holmium</span></td>
			<td class="element" data-number="68"  data-symbol="Er" data-fullname="Erbium"><span>68</span><span>Er</span><span>Erbium</span></td>
			<td class="element" data-number="69"  data-symbol="Tm" data-fullname="Thulium"><span>69</span><span>Tm</span><span>Thulium</span></td>
			<td class="element" data-number="70"  data-symbol="Yb" data-fullname="Ytterbium"><span>70</span><span>Yb</span><span>Ytterbium</span></td>
			<td class="element" data-number="71"  data-symbol="Lu" data-fullname="Lutécium"><span>71</span><span>Lu</span><span>Lutécium</span></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="2"></td>
			<td class="element" data-number="89"  data-symbol="Ac" data-fullname="Actinium"><span>89</span><span>Ac</span><span>Actinium</span></td>
			<td class="element" data-number="90"  data-symbol="Th" data-fullname="Thorium"><span>90</span><span>Th</span><span>Thorium</span></td>
			<td class="element" data-number="91"  data-symbol="Pa" data-fullname="Protactinium"><span>91</span><span>Pa</span><span>Protactinium</span></td>
			<td class="element" data-number="92"  data-symbol="U"  data-fullname="Uranium"><span>92</span><span>U</span><span>Uranium</span></td>
			<td class="element" data-number="93"  data-symbol="Np" data-fullname="Neptunium"><span>93</span><span>Np</span><span>Neptunium</span></td>
			<td class="element" data-number="94"  data-symbol="Pu" data-fullname="Plutonium"><span>94</span><span>Pu</span><span>Plutonium</span></td>
			<td class="element" data-number="95"  data-symbol="Am" data-fullname="Américium"><span>95</span><span>Am</span><span>Américium</span></td>
			<td class="element" data-number="96"  data-symbol="Cm" data-fullname="Curium"><span>96</span><span>Cm</span><span>Curium</span></td>
			<td class="element" data-number="97"  data-symbol="Bk" data-fullname="Berkelium"><span>97</span><span>Bk</span><span>Berkelium</span></td>
			<td class="element" data-number="98"  data-symbol="Cf" data-fullname="Californium"><span>98</span><span>Cf</span><span>Californium</span></td>
			<td class="element" data-number="99"  data-symbol="Es" data-fullname="Einsteinium"><span>99</span><span>Es</span><span>Einsteinium</span></td>
			<td class="element" data-number="100" data-symbol="Fm" data-fullname="Fermium"><span>100</span><span>Fm</span><span>Fermium</span></td>
			<td class="element" data-number="101" data-symbol="Md" data-fullname="Mendélévium"><span>101</span><span>Md</span><span>Mendélévium</span></td>
			<td class="element" data-number="102" data-symbol="No" data-fullname="Nobelium"><span>102</span><span>No</span><span>Nobelium</span></td>
			<td class="element" data-number="103" data-symbol="Lr" data-fullname="Lawrencium"><span>103</span><span>Lr</span><span>Lawrencium</span></td>
			<td></td>
		</tr>
	</tbody>
	</table>



	<div class="notes"></div>

</section>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script>
'use strict'

var table = document.getElementById('tableau');
var elements = table.querySelectorAll('.element');

elements.forEach(function(currentNode) {
	currentNode.addEventListener('click', function(e){
		if (e.target == currentNode || e.target.nodeName == 'SPAN') {
			var popupWrap = document.createElement('div');
			popupWrap.classList.add('popupWrap');
			popupWrap.addEventListener('click', function(ev) {
				if (ev.target == popupWrap) {
					currentNode.removeChild(popupWrap);
				}
			});
			var popup = document.createElement('div');
			popup.classList.add('popup');

			var titleNumber = document.createElement('h2');
			titleNumber.appendChild(document.createTextNode('Élément №' + currentNode.dataset.number));
			popup.appendChild(titleNumber);

			var labelSymbol = document.createElement('label');
			labelSymbol.appendChild(document.createTextNode('Symbole : '));
			labelSymbol.classList.add('inputsymbol');
			var inputSymbol = document.createElement('input');
			inputSymbol.type = 'text';
			inputSymbol.size = 2;
			// has already been specified by user?
			var userDefinedSymbol = currentNode.querySelector('span.userinputsymbol');
			if (userDefinedSymbol) {
				inputSymbol.value = userDefinedSymbol.textContent;
			}
			labelSymbol.appendChild(inputSymbol);
			popup.appendChild(labelSymbol);

			var labelName = document.createElement('label');
			labelName.appendChild(document.createTextNode('Nom : '));
			labelName.classList.add('inputname');
			var inputName = document.createElement('input');
			inputName.type = 'text';
			inputName.size = 12;
			// has already been specified by user?
			var userDefinedName = currentNode.querySelector('span.userinputname');
			if (userDefinedName) {
				inputName.value = userDefinedName.textContent;
			}
			labelName.appendChild(inputName);
			popup.appendChild(labelName);

			var buttonValider = document.createElement('button');
			buttonValider.addEventListener('click', function(ev) {
				// updates the Symbol
				var symbolSpan = currentNode.querySelector('span:nth-of-type(2)');
				if (inputSymbol.value !== "") {
					symbolSpan.classList.add('userinputsymbol');
					while (symbolSpan.firstChild) {symbolSpan.removeChild(symbolSpan.firstChild);}
					symbolSpan.appendChild(document.createTextNode(inputSymbol.value));
				} else {
					if (symbolSpan.classList.contains('userinputsymbol')) {
						while (symbolSpan.firstChild) {symbolSpan.removeChild(symbolSpan.firstChild);}
					}
					symbolSpan.classList.remove('userinputsymbol');
				}

				// updates the name
				var nameSpan = currentNode.querySelector('span:nth-of-type(3)');
				if (inputName.value !== "") { // if !empty, update value
					nameSpan.classList.add('userinputname');
					while (nameSpan.firstChild) {nameSpan.removeChild(nameSpan.firstChild);}
					nameSpan.appendChild(document.createTextNode(inputName.value));
				} else { // if empty
					if (nameSpan.classList.contains('userinputname')) { // if already has been updated : do empty
						while (nameSpan.firstChild) {nameSpan.removeChild(nameSpan.firstChild);}
					}
					nameSpan.classList.remove('userinputname');
				}
				currentNode.removeChild(popupWrap);
			})

			buttonValider.appendChild(document.createTextNode('Valider'));

			var buttonReset = document.createElement('button');
			buttonReset.addEventListener('click', function(ev) {
				inputSymbol.value = "";
				inputName.value = "";
			})
			buttonReset.appendChild(document.createTextNode('Vider'));


			var p = document.createElement('p');
			p.appendChild(buttonValider);
			p.appendChild(buttonReset);
			popup.appendChild(p);

			popupWrap.appendChild(popup);
			currentNode.appendChild(popupWrap);
		}

	})
});



function showNames(checkbox) {
	elements.forEach(function(currentNode) {
		if (checkbox.checked == 1) currentNode.classList.add('withnames');
		else currentNode.classList.remove('withnames');
	});
}


function showSymbols(checkbox) {
	elements.forEach(function(currentNode) {
		if (checkbox.checked == 1) currentNode.classList.add('withsymbols');
		else currentNode.classList.remove('withsymbols');
	});
}

function showNumbers(checkbox) {
	elements.forEach(function(currentNode) {
		if (checkbox.checked == 1) currentNode.classList.add('withnumbers');
		else currentNode.classList.remove('withnumbers');
	});
}

function verifyAll() {
	var correctAnswers = 0;
	var partiallyCorrectAnswers = 0;
	var wrongAnswers = 0;
	var unAnswered = 0;

	elements.forEach(function(currentNode) {
		currentNode.classList.remove('color-red', 'color-green', 'color-yellow');

		var elementScore = 0;
		if (currentNode.querySelectorAll('[class^=userinput]').length == 0) unAnswered += 1;
		else {
			var rightName = currentNode.dataset.fullname.toLowerCase();
			var rightSymb = currentNode.dataset.symbol.toLowerCase();
			var guessedName = (currentNode.querySelector('.userinputname')) ? currentNode.querySelector('.userinputname').textContent.toLowerCase() : false;
			var guessedSymb = (currentNode.querySelector('.userinputsymbol')) ? currentNode.querySelector('.userinputsymbol').textContent.toLowerCase() : false;

			if (guessedName && guessedName == rightName) {
				elementScore +=1;
			}
			if (guessedSymb && guessedSymb == rightSymb) {
				elementScore +=1;
			}

			if (elementScore == 0) {
				wrongAnswers +=1
				currentNode.classList.add('color-red');
			}
			if (elementScore == 1) {
				partiallyCorrectAnswers +=1;
				currentNode.classList.add('color-yellow');
			}
			if (elementScore == 2) {
				correctAnswers +=1;
				currentNode.classList.add('color-green');
			}
		}
	});

	document.getElementById('outRight').firstChild.nodeValue = 'Réponses correctes : ' + correctAnswers + ' (' + Math.round(correctAnswers/elements.length*1000) /10 + '%).';
	document.getElementById('outPartiallyRight').firstChild.nodeValue = 'Réponses partiellement correctes : ' + partiallyCorrectAnswers + ' (' + Math.round(partiallyCorrectAnswers/elements.length*1000) /10 + '%).';
	document.getElementById('outWrong').firstChild.nodeValue = 'Réponses fausses : ' + wrongAnswers + ' (' + Math.round(wrongAnswers/elements.length*1000) /10 + '%).';

}


function resetAll() {
	elements.forEach(function(currentNode) {
		// reset values
		currentNode.querySelector('span:nth-of-type(2)').firstChild.nodeValue = currentNode.dataset.symbol;
		currentNode.querySelector('span:nth-of-type(3)').firstChild.nodeValue = currentNode.dataset.fullname;

		// remove all classes
		currentNode.classList.remove('color-green', 'color-yellow', 'color-red');
	});

	table.querySelectorAll('.userinputsymbol').forEach(function(currentNode) {
		currentNode.classList.remove('userinputsymbol');
	});
	table.querySelectorAll('.userinputname').forEach(function(currentNode) {
		currentNode.classList.remove('userinputname');
	});
}

</script>
<!--

# adresse de la page : https://lehollandaisvolant.net/tout/tools/periodic
#      page créée le : 1er septembre 2018
#     mise à jour le : 1er septembre 2018

-->
</body>
</html>