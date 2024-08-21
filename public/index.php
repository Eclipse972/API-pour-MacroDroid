<?php
include 'minute.php';
include 'heure.php';
include 'extractionParametre.php';

# récupération des paramètres de type float
$latitude = extractionParamètre('latitude', $_GET);
$longitude = extractionParamètre('longitude', $_GET);
 
if ((!$latitude) || (!$longitude)) { ?>
{ "erreur" : "paramètres incorrects"}
<?php exit;
}
