<!DOCTYPE html>
<html lang="fr-fr" manifest="timo.vcard.manifest">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Générateur de vCard" />
	<link rel="stylesheet" href="../0common/common.css"/>

	<title>Générer une vCard - le hollandais volant</title>
	<style>

#main-form {
	min-width: 350px;
	max-width: 550px;
	box-sizing: border-box;
	width: auto;
	padding: 20px 5px;
}
#main-form p {
	margin: 10px 0;
	box-sizing: border-box;
}

p > input:first-of-type,
p > textarea {
	margin-left: 0;
}

p > input:last-of-type,
p > textarea {
	margin-right: 0;
}


h3 {
	font-size: 100%;
	color: #555;
	margin: 0;
}
h2 {
	font-size: 120%;
	color: #333;
	margin: 27px 0 0;
}

input, textarea {
	border: 1px solid silver;
	background: white;
	border-radius: 5px;
	padding: 5px;
	box-shadow: 0 0 3px silver inset;
	margin: 0 2px;
	box-sizing: border-box;
}
input:focus, textarea:focus {
	border-color: gray;
	box-shadow: 0 0 3px silver inset, 0 0 2px silver;
}

/* NOM, PRÉNOM, TITRE */
#p-nom input {
	font-size: 140%;
}
#titre { width: 60px; }
#prenom { width: calc( ( 100% - 4*2px - 60px ) * 0.4) }
#nom { width: calc( ( 100% - 4*2px - 60px ) * 0.6) }
#surnom { width: 100%; }

/* ANNIV*/
#jour, #mois { width: 50px; }
#annee { width: 100px; }


/* ADRESSE */
.rue input { width: 100%; }
.zip-city input { width: 100px; }
.zip-city input+input { width: calc(100% - 2*2px - 100px); }
.state-land input { width: 200px; }
.state-land input+input { width: calc(100% - 2*2px - 200px); }

/* TEL */
.p-tel input { width: 100%; }

/* EMAIL */
.p-email input { width: 100%; }

/* PRO  -  SOC, SERV, FONC */
#p-ssp input { width: calc( (100% - 4*2px) * 0.333) }

/* ONLINE & RESEAU */

.p-online input { width: 100%; }

/* PHOTO */
#p-data64 { display: none; }
#photo { width: 100%; }

/* NOTES */
#notes {
	width: 100%;
	height: 90px;
}

	</style>
</head>
<body>

<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Générer une vCard</a></p>
</header>

<div id="main-form" class="main-form">

	<p class="instructions">Remplisez les champs que vous voulez (seuls les nom et prénom sont requis) :</p>
	<div class="names">
		<h2 class="section">Civilité</h2>
		<p id="p-nom">
			<input placeholder="Titre" id="titre" type="text"><input placeholder="Prénom" required id="prenom" type="text"><input required placeholder="Nom" id="nom" type="text">
		</p>
		<p id="p-surnom"><input placeholder="Surnom" id="surnom" type="text"></p>
		<p id="p-anniv">
			<label for="jour">Anniversaire</label>&nbsp;: <input placeholder="JJ" id="jour" type="text"><input placeholder="MM" id="mois" type="text"><input placeholder="AAAA" id="annee" type="text">
		</p>
	</div>

	<div class="adresse">
		<h2 class="section">Coordonnées personnelles</h2>
		<h3 class="section">Adresse</h3>
		<p class="p-addr rue">
			<input placeholder="Rue" id="addr1-rue" type="text">
		</p>
		<p class="p-addr zip-city">
			<input placeholder="Code postal" id="addr1-zip" type="text"><input placeholder="Ville" id="addr1-city" type="text">
		</p>
		<p class="p-addr state-land">
			<input placeholder="État" id="addr1-state" type="text"><input placeholder="Pays" id="addr1-land" type="text">
		</p>
		<p></p>
		<h3 class="section">Téléphone</h3>
		<p class="p-tel">
			<input placeholder="Téléphone portable" id="phone1" type="text">
		</p>
		<p class="p-tel">
			<input placeholder="Téléphone domicile" id="phone3" type="text">
		</p>
		<p class="p-tel">
			<input placeholder="Téléphone (autre)" id="phone4" type="text">
		</p>

		<p></p>
		<h3 class="section">E-mail</h3>
		<p class="p-email">
			<input placeholder="Email personnel" id="email1" type="text">
		</p>
		<p class="p-email">
			<input placeholder="Email (autre)" id="email3" type="text">
		</p>

	</div>


	<div class="pro">
		<h2 class="section">Coordonnées professionnelles</h2>
		<h3 class="section">Entreprise et fonction</h3>
		<p id="p-ssp">
			<input placeholder="Société" id="societe" type="text"><input placeholder="Service" id="service" type="text"><input placeholder="Fonction" id="position" type="text">
		</p>

		<h3 class="section">Adresse professionnelle</h3>
		<p class="p-addr rue">
			<input placeholder="Rue" id="addr2-rue" type="text">
		</p>
		<p class="p-addr zip-city">
			<input placeholder="Code postal" id="addr2-zip" type="text"><input placeholder="Ville" id="addr2-city" type="text">
		</p>
		<p class="p-addr state-land">
			<input placeholder="État" id="addr2-state" type="text"><input placeholder="Pays" id="addr2-land" type="text">
		</p>

		<h3 class="section">Contacts professionnels</h3>
		<p class="p-email">
			<input placeholder="Email professionnel" id="email2" type="text">
		</p>
		<p class="p-tel">
			<input placeholder="Téléphone professionnel" id="phone2" type="text">
		</p>

	</div>

	<div class="enligne">
		<h2 class="section">En ligne &amp; réseaux sociaux</h2>
		<p class="p-online">
			<input placeholder="Site web (http://www.example.com)" id="ol1" type="text">
		</p>
		<p class="p-online">
			<input placeholder="Twitter (nom d’utilisateur)" id="ol2" type="text">
		</p>
		<p class="p-online">
			<input placeholder="Skype (nom d’utilisateur)" id="ol3" type="text">
		</p>
		<p class="p-online">
			<input placeholder="Facebook (nom d’utilisateur)" id="ol4" type="text">
		</p>
	</div>

	<div class="photo">
		<h2 class="section">Informations supplémentaires</h2>
		<h3 class="section">Photo</h3>

		<p id="p-photo"><input id="photo" type="file" accept="image/*" onchange="loadimage(this.files)" /></p>
		<p id="p-data64"><textarea id="base64" cols="50" rows="20"></textarea></p>
		
		<h3 class="section">Notes</h3>
		<p id="p-notes"><textarea id="notes" placeholder="Notes" cols="60" rows="20"/></textarea></p>
	</div>

	<p class="centrer">
		<button onclick="return go(true);" id="gen" type="submit" class="button button-submit">Générer</button>
		<button onclick="return goQrcode();" id="share" type="submit" class="button button-other">QR-Code</button>
	</p>
	<div class="notes">
		<p>Tous les champs ne sont pas obligatoires.<br/>Seuls le nom et le prénom le sont.</p>
	</div>

</div>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>

<script>
/* <![CDATA[ */
function go(dl) {
	var titre = document.getElementById('titre').value;
	var nom = document.getElementById('nom').value;
	var prenom = document.getElementById('prenom').value;
	if (nom == '' || prenom == '') {
		alert('Vous devez renseigner au moins un nom et un prénom.');
		return false;
	}

	var societe = document.getElementById('societe').value;
	var service = document.getElementById('service').value;
	var position = document.getElementById('position').value;

	var surnom = document.getElementById('surnom').value;
	var jour = document.getElementById('jour').value;
	var mois = document.getElementById('mois').value;
	var annee = document.getElementById('annee').value;

	var email1 = document.getElementById('email1').value;
	var email2 = document.getElementById('email2').value;
	var email3 = document.getElementById('email3').value;

	var photo1 = document.getElementById('base64').value;

	var phone1 = document.getElementById('phone1').value;
	var phone2 = document.getElementById('phone2').value;
	var phone3 = document.getElementById('phone3').value;
	var phone4 = document.getElementById('phone4').value;

	var ol1 = document.getElementById('ol1').value;
	var ol2 = document.getElementById('ol2').value;
	var ol3 = document.getElementById('ol3').value;
	var ol4 = document.getElementById('ol4').value;

	var addr1_rue = document.getElementById('addr1-rue').value;
	var addr1_zip = document.getElementById('addr1-zip').value;
	var addr1_city = document.getElementById('addr1-city').value;
	var addr1_state = document.getElementById('addr1-state').value;
	var addr1_land = document.getElementById('addr1-land').value;

	var addr2_rue = document.getElementById('addr2-rue').value;
	var addr2_zip = document.getElementById('addr2-zip').value;
	var addr2_city = document.getElementById('addr2-city').value;
	var addr2_state = document.getElementById('addr2-state').value;
	var addr2_land = document.getElementById('addr2-land').value;

	var notes = document.getElementById('notes').value;

	var VCODE = "";
	VCODE =  "BEGIN:VCARD\n";
	VCODE += "VERSION:4.0\n";
	VCODE += "FN:"+prenom+" "+nom+"\n";
	VCODE += "N:"+nom+";"+prenom+";;"+titre+"\n";
	if (surnom != "") VCODE += "NICKNAME:"+surnom+"\n";
	if (societe != "") VCODE += "ORG:"+societe+";"+service+"\n";
	if (position != "") VCODE += "ROLE:"+position+"\n" + "TITLE:"+position+"\n";
	if (jour != "" && mois != "" && annee != "") VCODE += "BDAY:"+annee+"-"+mois+"-"+jour+"\n";

	if (photo1 != "") VCODE += "PHOTO:"+photo1+"\n";

	if (email1 != "") VCODE += "EMAIL;TYPE=INTERNET;TYPE=PREF:"+email1+"\n";
	if (email2 != "") VCODE += "EMAIL;TYPE=WORK;TYPE=PREF:"+email2+"\n";
	if (email3 != "") VCODE += "EMAIL;TYPE=OTHER;TYPE=PREF:"+email3+"\n";

	if (phone1 != "") VCODE += "TEL;TYPE=CELL;TYPE=PREF:"+phone1+"\n";
	if (phone2 != "") VCODE += "TEL;TYPE=WORK;TYPE=PREF:"+phone2+"\n";
	if (phone3 != "") VCODE += "TEL;TYPE=HOME;TYPE=PREF:"+phone3+"\n";
	if (phone4 != "") VCODE += "TEL;TYPE=OTHER;TYPE=PREF:"+phone4+"\n";

	if (addr1_rue+addr1_zip+addr1_city+addr1_state+addr1_land != "") 
		VCODE += "ADR;TYPE=HOME:;;"+addr1_rue+";"+addr1_city+";"+addr1_state+";"+addr1_zip+";"+addr1_land+"\n";
	if (addr2_rue+addr2_zip+addr2_city+addr2_state+addr2_land != "") 
		VCODE += "ADR;TYPE=WORK:;;"+addr2_rue+";"+addr2_city+";"+addr2_state+";"+addr2_zip+";"+addr2_land+"\n";

	if (ol1 != "") VCODE += "URL:"+ol1+"\n";
	if (ol2 != "") VCODE += "X-TWITTER:"+ol2+"\n";
	if (ol3 != "") VCODE += "X-SKYPE:"+ol3+"\n";
	if (ol4 != "") VCODE += "X-FACEBOOK:"+ol4+"\n";

	if (notes != "") VCODE += "NOTE:"+(notes.replace(/\n/g, "\\n"))+"\n";

	VCODE += "END:VCARD"+"\n";

	// creates a link, with download attribute and with content the Vcard Data (blob)
	// then clics on the link
	if (dl) {
		window.URL = window.webkitURL || window.URL;
		file = new Blob([VCODE], {"type" : "text\/vcard" });
		var a = document.createElement("a");
		a.style.display = 'none';
		a.href = window.URL.createObjectURL(file);
		a.download = 'contact.vcf';

		var evt = document.createEvent("MouseEvents");
		evt.initMouseEvent("click", true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
		a.dispatchEvent(evt);
		evt.preventDefault();
		return false;
	}
	else {
		return VCODE;
	}
}


function imageHandler(d) { 
	document.getElementById('base64').value = ((d.target.result).match(/(.{1,76})/g)).join("\n");
}

function loadimage(files) {
	var filename = files[0];
	var fr = new FileReader();
	fr.onload = imageHandler;
	fr.readAsDataURL(filename);
}

function goQrcode() {
	var code = go(false);
	if (!code) return false;
	var loc = 'http://lehollandaisvolant.net/tout/tools/qrcode/';
	var url = loc+'#'+encodeURIComponent(code);
	window.open(url, '_blank');
	
}
/* ]]> */
</script>
<!--

# adresse de la page : http://lehollandaisvolant.net/tout/tools//
#      page créée le : 13 septembre 2013
#     mise à jour le : 13 septembre 2013

-->
</body>
</html>