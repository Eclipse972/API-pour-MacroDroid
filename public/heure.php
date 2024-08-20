<?php
/**
 * renvoie le texte correspondant à la partie heure
 * @param int heure
 * @return string|bool le texte pour la partie heure ou false si une erreur est survenue
 **/
function Heure(int $heure) : string|bool {
	if ($heure == 0) return 'minuit';
	if ($heure == 12) return 'midi';
	if (($heure < 0) || ($heure > 23)) return false;
	return "$heure heure";
}
