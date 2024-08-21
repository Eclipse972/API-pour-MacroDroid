<?php
# requête vers timeAPI
$ch = curl_init();

$url = "https://www.timeapi.io/api/time/current/coordinate?latitude=49&longitude=2";

// Configuration des options cURL
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Optionnel : Spécifier que vous attendez du JSON dans la réponse
$headers = [
    'Accept: application/json',
];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Exécution de la requête
$response = curl_exec($ch);

// Gestion des erreurs
if (curl_errno($ch)) {
    echo 'Erreur cURL : ' . curl_error($ch);
} else {
   // Décoder la réponse JSON en tableau PHP
   $data = json_decode($response, true);
}

// Fermeture de la session cURL
curl_close($ch);

echo "il est {$data['hour']}:{$data['minute']}\n";