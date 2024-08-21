<?php
include 'minute.php';
include 'heure.php';
include 'extractionParametre.php';
include 'requete.php';

# récupération des paramètres de type float
$latitude = extractionParamètre('latitude', $_GET);
$longitude = extractionParamètre('longitude', $_GET);

if ((!$latitude) || (!$longitude)) {
?>
{"heure":"coordonnée gps incorrecte"}
<?php
	exit;
}

$reponse = requeteAPI($latitude, $longitude);

if (is_string($reponse)) {
?>
{"heure":"<?=$reponse?>"}
<?php
	exit;
}

if ((!is_array($reponse)) || (!isset($reponse['heure'])) || (!isset($reponse['minute']))) {
?>
{"heure":"réponse API incorrecte"}
<?php
	exit;
}

$heure = Heure($reponse['heure']);
$minute = Minute($reponse['heure'], $reponse['minute']);

if ((!$heure) || (!$minute)) {
?>
{"heure":"Une erreur est survenue dans le calcul de la réponse"}
<?php
	exit;
}

if((is_string($heure)) && is_string($minute)) {
?>
{"heure":"<?=$heure?> <?=$minute?>"}
<?php
	exit;
}
?>
{"heure":"erreur inconnue"}
