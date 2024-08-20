<?php
include 'public/minutes.php';

/**
 * Cette fonction prend deux paramètres heure et minute ce donne plus 1440 configuration à tester
 * en tenant compte des valeurs hors intervalle.
 * 
 * Voici le comportement attendu sous forme d'un tableau 
 * 							+-------------------------------------------------------+
 * 							| 						HEURES							|
 * 							|	]-oo; 0]	|	[0;12]	|	[13;23]	|	[24;+oo[	|
 * 		+-------------------+---------------+-----------+-----------+---------------+
 * 		|			]-oo;-1]|						ERREUR zone 1					|
 * 		|			--------+---------------+-----------+-----------+---------------+
 * 		|				0	|				|		rien			|				|
 * 		|			--------+				+-----------+-----------+				+
 * 		|			[1;12]	|				|		M minutes		|				|
 * 		|			--------+				+-----------+-----------+				+
 * 		|			[13;17]	| ERREUR zone 3	| et quart	| M minutes	| ERREUR zone 4	|
 * 		| MINUTES	--------+				+-----------+-----------+				+
 * 		|			[18;27]	|				|		M minutes		|				|
 * 		|			--------+				+-----------+-----------+				+
 * 		|			[28;32]	|				| et demi	| M minutes	|				|
 * 		|			--------+				+-----------+-----------+				+
 * 		|			[33;59]	|				|		M minutes		|				|
 * 		|			--------+---------------+-----------+-----------+---------------+
 * 		|			[60;+oo]|						ERREUR zone 2					|
 * 		+-------------------+---------------+-----------+-----------+---------------+
 * Il y a 32 cases mais seulement 12 zones de comportement.
 * Je consdère le test réussi pour une zone si:
 * - pour une valeur arbiraire non proche des frontières on réussi
 * - pour des valeurs frontalières on donne le bon résultat
 * 
 * Le test est réussi si on détecte correctement les zones
 **/

 