<?php

// there must be a "date" param
if (!isset($_GET['date'])) {
	header("HTTP/1.0 400 Bad Request"); exit;
}

$date = $_GET['date'];
$url = 'https://eco2mix.rte-france.com/eco2mixhtml5/V2/getEco2MixXml.php?type=mix&dateDeb='.$date.'&dateFin='.$date;


// init cURL for data retreiving.
$curl_handle = curl_init();
curl_setopt($curl_handle, CURLOPT_URL, $url);
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
$file_content = curl_exec($curl_handle);
curl_close($curl_handle);
if ($file_content == NULL) { // impossible request
	header("HTTP/1.0 404 Not Found"); exit;
}


if ($rawdata = new SimpleXMLElement($file_content, LIBXML_NOCDATA)) {

	$productionDate = (string)$rawdata->date_actuelle;

	// liste les sources d’énergie : éolien, nucléaire…
	$productionTypes = $rawdata->mixtr->type;
	$productionTotale = 0;

	$JSON = '{"date": "'.$productionDate.'",'."\n";
	$JSON .= '"sources": ['."\n";

	foreach ($productionTypes as $type) {
		// ne prend que les types de sources globales (pas détaillées en sous-type)
		if ($type->attributes()->granularite == 'Global') {

			// type d’Énergie
			$JSON .= "\t".'{"type": "'.$type->attributes()->v .'", ';

			// conserve la dernière ligne du tableau
			$prodValeurs = $type->valeur;
			$derniereValeur = (int)$prodValeurs[count($prodValeurs)-1];
			$JSON .= '"prod": '. abs($derniereValeur) .' },'."\n";

			// crée une ligne pour la production totale
			$productionTotale += $derniereValeur;

		}
	}

	$JSON .= "\t".'{"type": "total", "prod":'. $productionTotale .' }'."\n";

	$JSON .= "],\n";

	$JSON .= '"total": '. $productionTotale .''."\n";

	$JSON .= '}';
}


// send file to browser
header('Content-Type: text/json');
header('Content-Length: ' . strlen($JSON));
header('Cache-Control: public, max-age=2628000');
echo $JSON;
exit;