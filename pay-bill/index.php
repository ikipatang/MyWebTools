<!DOCTYPE html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Timo van Neerden" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Un outil pour partager, répartir ses dépenses entre amis." />

	<title>Partager des dépenses de groupe - le hollandais volant</title>

	<link rel="stylesheet" href="../0common/common.css" type="text/css" />
	<style>


.main-form {
	text-align: center;
}

#listPeople {
	margin: 0 auto;
	text-align: left;
	width: 100%;
	border-spacing: 5px;
}

#listPeople > tbody > tr:nth-child(1) button {
	display: none;
}

#listPeople button {
	padding: 5px;
	box-sizing: border-box;
	height: 3.4em;
	width: 3.4em;
	text-align: center;
	font: 1em monospace;
}

#listPeople input {
	width: 100%;
	box-sizing: border-box;
	padding: 5px;
	height: 3.4em;
}

#listPeople > tfoot button {
	width: 100%;
}

#output {
	margin: 0 auto;
	text-align: left;
}


	</style>
</head>
<body>

<header id="top-nav">
	<div class="home">
		<a title="Accueil" class="logo" href="/">
		<img src="/index/logo-no-border.png" alt="logo le hollandais volant" /></a>
	</div>
	<p class="navbarlinks"><a href="../">Outils</a>   &gt;   <a href=".">Partager des dépenses de groupe</a></p>
</header>

<section class="main-form">

	<table id="listPeople">
		<thead>
			<tr>
				<th></th>
				<th>Personnes</th>
				<th>Montant avancé</th>
				<th>Nombre de parts</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><button title="Supprimer cette ligne." type="button" onclick="rmRow(this)">−</button></td>
				<td><input type="text" placeholder="Personne 1" value="" class="personName" /></td>
				<td><input type="number" placeholder="0" value="" class="personMoney" /></td>
				<td><input type="number" value="1" class="personShares" min="1" /></td>
			</tr>
			<tr>
				<td><button title="Supprimer cette ligne." type="button" onclick="rmRow(this)">−</button></td>
				<td><input type="text" placeholder="Personne 2" value="" class="personName" /></td>
				<td><input type="number" placeholder="0" value="" class="personMoney" /></td>
				<td><input type="number" value="1" class="personShares" min="1" /></td>
			</tr>
			<tr>
				<td><button title="Supprimer cette ligne." type="button" onclick="rmRow(this)">−</button></td>
				<td><input type="text" placeholder="Personne 3" value="" class="personName" /></td>
				<td><input type="number" placeholder="0" value="" class="personMoney" /></td>
				<td><input type="number" value="1" class="personShares" min="1" /></td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td></td>
				<td colspan="3"><button title="Ajouter une ligne." type="button" onclick="addRow(this)">+</button></td>
			</tr>
		</tfoot>
	</table>

	<p><button type="button" class="button button-submit" onclick="doCumpute()">Calculer</button></p>

	<div id="output"></div>

</section>


<div class="notes centrer">
	<p></p>
</div>

<footer id="footer"><a href="//lehollandaisvolant.net">by <em>Timo Van Neerden</em></a></footer>


<script>
/* <![CDATA[ */
"use strict";

// sort an array of objects.
// Array is sorted based on arr[prop]'s value
function sortArrayByPropertyValue(arr, prop) {
	var sortedArr = arr.slice(0);
	sortedArr.sort(function(a,b) {
		return a[prop] - b[prop];
	});
	return sortedArr;
}

// remove entries from an array of object.
// entrie is removed from Array(arr) if arr[prop] equals 'val'
function removeEntryIfZeroFromArray(arr, prop) {
	for (var key in arr) {
		if (Math.round(arr[key][prop]*10000)/10000 == 0) { // math.round b/c of the "0.1 + 0.2 === 0.3 // false" problem
			arr.splice(key, 1);
		}
	}
	return arr;
}

// returns the entrie of an array
// which property is max() of that table
function findMaxValueOfArray(arr, prop) {
	var elementOfArray = null;
	for (var key in arr) {
		// init
		if (elementOfArray === null) elementOfArray = arr[key];
		// sorting
		if (arr[key][prop] > elementOfArray[prop]) elementOfArray = arr[key];
	}
	return elementOfArray;
}

// returns the entrie of an array
// which property is min() of that table
function findMinValueOfArray(arr, prop) {
	var elementOfArray = null;
	for (var key in arr) {
		// init
		if (elementOfArray === null) elementOfArray = arr[key];
		// sorting
		if (arr[key][prop] < elementOfArray[prop]) elementOfArray = arr[key];
	}
	return elementOfArray;
}

// removes a row from the table
function rmRow(button) {
	var row = button.parentNode.parentNode;
	// rm row
	row.parentNode.removeChild(row);

}

// adding a row to the table
function addRow(button) {
	var row = button.parentNode.parentNode;
	// rm row
	var newRow = document.querySelector('#listPeople > tbody > tr').cloneNode(true);
	console.log(newRow.querySelector('.personName'));
	newRow.querySelector('.personName').value = "";
	newRow.querySelector('.personMoney').value = '';
	newRow.querySelector('.personShares').value = 1;

	document.querySelector('#listPeople > tbody').appendChild(newRow);

}

var outputDom = document.getElementById('output');



function doCumpute() {
	// the list of people in the DOM
	var listPeople = document.querySelectorAll('#listPeople > tbody > tr');

	// empty the output node
	while (output.firstChild) {output.removeChild(output.firstChild);}
	var outputHTML = '';

	// amount of people
	var howMuchPeople = listPeople.length;

	// amount of shares
	// total amount of money
	var howMuchShares = 0;
	var totalMoney = 0;
	listPeople.forEach(function(currentNode) {
		howMuchShares += parseFloat( currentNode.querySelector('input.personShares').value, 10);
		totalMoney += parseFloat( currentNode.querySelector('input.personMoney').value, 10);
	});

	//console.log(totalMoney);
	if (howMuchShares == 0 || howMuchPeople <= 1 || isNaN(totalMoney)) return;

	outputHTML += '<p>Le montant total s’élève à <strong>' + totalMoney.toFixed(2) + ' €</strong>.<br/>';

	// calculate one share
	var oneShare = totalMoney / howMuchShares;

	outputHTML += 'Une part revient à <strong>' + oneShare.toFixed(2) + ' €</strong>, pour un total de <strong>'+ howMuchShares +'</strong> parts.</p>';


	// Create Array with people
	var objPeople = new Array();
	// Sort the Array with respect to the moneyBalance.
	listPeople.forEach(function(currentNode) {
		var personMoney = parseFloat(currentNode.querySelector('input.personMoney').value);
		var personShares = parseInt(currentNode.querySelector('input.personShares').value);

		objPeople.push({
			id: ((Math.random() +1).toString(16)).substring(7),
			name: currentNode.querySelector('input.personName').value,
			money: personMoney,
			share: personShares,
			balance: personMoney - (oneShare * personShares),
		});
	});
	objPeople = sortArrayByPropertyValue(objPeople, 'balance');

	(function(){var clone = JSON.parse( JSON.stringify(objPeople) ); console.log(clone);})();

	// if people with balance is 0 : remove 
	objPeople = removeEntryIfZeroFromArray(objPeople, 'balance');



	/*
		To balance everything out, the person with the lowest balance gives money to the person with the most.
		The giver of the money should not give more money than he ows (no more than its balance).
		The receiver of the money should not receive more money than he must receive.
		After each transaction :
			– we sort the table
			– rule out people whose balance is 0.
	*/
	var i=0;

	outputHTML += '<p>Une solution : </p><ul>';
	while (objPeople.length > 1 && i < 50) {
		var transactionFrom = findMinValueOfArray(objPeople, 'balance');
		var transactionTo = findMaxValueOfArray(objPeople, 'balance');
		var transactionAmount = Math.abs(Math.min(transactionFrom.balance, transactionTo.balance));

		// the transaction
		for (var j in objPeople) {
			// debit trom
			if (objPeople[j].id === transactionFrom.id) {
				objPeople[j].balance += transactionAmount;
			}
			// credit to
			if (objPeople[j].id === transactionTo.id) {
				objPeople[j].balance -= transactionAmount;
			}
		}

		outputHTML += '<li>' + transactionFrom.name + ' paye ' + transactionAmount.toFixed(2) + ' € à ' + transactionTo.name + '.</li>';

		objPeople = removeEntryIfZeroFromArray(objPeople, 'balance');
		i++;
	}
	outputHTML += '</ul>';

	output.innerHTML = outputHTML;
}


/* ]]> */
</script>
<!--
# adresse de la page : https://lehollandaisvolant.net/tout/tools/pay-bill/
#      page créée le : 28 août 2018
#     mise à jour le : 30 août 2018
-->
</body>
</html>