<?php
include 'minute.php';
include 'heure.php';
include 'extractionParametre.php';
include 'requete.php';

# récupération des paramètres de type float
$latitude = extractionParamètre('latitude', $_GET);
if (!$latitude) {
?>
{"erreur":"latitude incorrecte"}
<?php
	exit;
}

$longitude = extractionParamètre('longitude', $_GET);
if (!$longitude) {
?>
{"erreur":"longitude incorrecte"}
<?php
	exit;
}

$reponse = requeteAPI($latitude, $longitude);

if (is_string($reponse)) {
?>
{"erreur":"<?=$reponse?>"}
<?php
	exit;
}

if ((is_array($reponse)) && (isset($reponse['heure'])) && (isset($reponse['minute']))) {
?>
{"heure":<?=$reponse['heure']?>,"minute":<?=$reponse['minute']?>}
<?php
	exit;
}
?>
{"erreur":"inconnue"}
