<?php
/**
 * renvoie l'heure locale pour des coordonées GPS données
 * @param float latitude
 * @param float longitude
 * @return array|string tableau associatif contenant heure et minute ou un message d'erreur
 */
function requeteAPI(float $latitude = 51.50735, float $longitude = -0.127758) : array|string {
	$requeteCURL = curl_init();
	curl_setopt(
		$requeteCURL,
		CURLOPT_URL,
		"https://www.timeapi.io/api/time/current/coordinate?latitude=$latitude&longitude=$longitude" # requête vers timeAPI
	);
	curl_setopt($requeteCURL, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($requeteCURL, CURLOPT_HTTPHEADER, ['Accept: application/json']);
	$reponse = curl_exec($requeteCURL);

	// Gestion des erreurs
	if (curl_errno($requeteCURL)) {
		$message = 'Erreur cURL : ' . curl_error($requeteCURL);
	} else {
		$data = json_decode($reponse, true);
		$message = false;
	}
	curl_close($requeteCURL);
	return !$message ? # si pas de message ?
			array('heure' => intval($data['hour']), 'minute'=> intval($data['minute'])) :
			$message;
}