<?php
include '../public/heure.php';

# les assertions à vérifier
$assertions = array(
  0 => 'minuit',
  1 => '1 heure',
  2 => '2 heure', # l'orthographe n'a pas d'importance il faut quelque chose de prononcable par la synthèse vocale
  3 => '3 heure',
  4 => '4 heure',
  5 => '5 heure',
  6 => '6 heure',
  7 => '7 heure',
  8 => '8 heure',
  9 => '9 heure',
  10 => '10 heure',
  11 => '11 heure',
  12 => 'midi',
  13 => '13 heure',
  14 => '14 heure',
  15 => '15 heure',
  16 => '16 heure',
  17 => '17 heure',
  18 => '18 heure',
  19 => '19 heure',
  20 => '20 heure',
  21 => '21 heure',
  22 => '22 heure',
  23 => '23 heure',
);

function testHeure() : string {
  for($heure = 0; $heure < 24; $heure++)
    if (($reponse = Heure($heure)) != $assertion[$heure] {
      return "Réponse attendue pour $heure = {$assertion[$heure]} réponse donnée $reponse";
  
  # test valeur hors intervalle
  if ((Heure(-1) != false) || (Heure(26) != false)) return "valeurs hors intervalle non détectée";
}
