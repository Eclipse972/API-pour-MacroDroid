<?php
include 'public/requete.php';
$reponse = requeteAPI();
echo gettype($reponse) == 'array' ?
		"il est {$reponse['heure']}:{$reponse['minute']}\n" :
		$reponse;