<?php
/**
 * renvoie le texte correspondant à la partie minute
 * @param int heure
 * @param int minute
 * @return string|bool le texte pour la partie heure ou false si une erreur est survenue
 **/
function Minute(int $heure, int $minute) : string|bool {
  if (($heure < 0) || ($heure > 23) || ($minute < 0) || ($minute > 59)) return false;
  if ($minute == 0) return '';
  return "$minute";
}
