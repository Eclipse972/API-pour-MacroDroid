<?php
include 'minute.php';
include 'heure.php';
include 'extractionParametre.php';

# récupération des paramètres de type float
$latitude = extractionParamètre('latitude', $_GET);
if (!$latitude) {
	echo "{ \"erreur\" : \"latitude incorrecte\"}";
	exit;
}

$longitude = extractionParamètre('longitude', $_GET);
if (!$longitude) {
	echo "{ \"erreur\" : \"longitude incorrecte\"}";
	exit;
}

$reponse = requeteAPI($latitude, $longitude);

if (is_string($reponse)) {
	echo "{\"erreur\":\"$reponse\"}";
	exit;
}

if ((is_array($reponse)) && (isset($reponse['heure'])) && (isset($reponse['minute']))) {
	echo "{\"heure\":\"{$reponse['heure']}\", \"minute\":\"{$reponse['minute']}\"}";
	exit;
}

echo "{ \"erreur\" : \"inconnue\"}";
