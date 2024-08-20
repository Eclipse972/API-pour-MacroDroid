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
 * 		|			[1;12]	|				|			M			|				|
 * 		|			--------+				+-----------+-----------+				+
 * 		|			[13;17]	| ERREUR zone 3	| et quart	|	M		| ERREUR zone 4	|
 * 		| MINUTES	--------+				+-----------+-----------+				+
 * 		|			[18;27]	|				|			M			|				|
 * 		|			--------+				+-----------+-----------+				+
 * 		|			[28;32]	|				| et demi	|	M		|				|
 * 		|			--------+				+-----------+-----------+				+
 * 		|			[33;59]	|				|			M			|				|
 * 		|			--------+---------------+-----------+-----------+---------------+
 * 		|			[60;+oo]|						ERREUR zone 2					|
 * 		+-------------------+---------------+-----------+-----------+---------------+
 * M représente la valeur de la minute.
 * 
 * Il y a 32 cases mais seulement 12 zones de comportement.
 * Je consdère le test réussi pour une zone si:
 * - pour une valeur arbiraire non proche des frontières on réussi
 * - pour des valeurs frontalières on donne le bon résultat
 * 
 * Le test est réussi si on détecte correctement les zones
 **/

 function testMinute() : string {
	$Tassertion = array(
		# Erreur zone 1 <=> minute < 0 et heure quelconque
		array('m' => -5,	'h' => 9,	'r' => false),	# dans la zone
		array('m' => -1,	'h' => -3,	'r' => false),	# à l'intérieur des frontières <=> minute = -1
		array('m' => -1,	'h' => 5,	'r' => false),
		array('m' => -1,	'h' => 18,	'r' => false),
		array('m' => -1,	'h' => 28,	'r' => false),
		array('m' => 0,		'h' => -3,	'r' => false),	# à l'extérieur des frontières <=> minute = 0
		array('m' => 0,		'h' => 5,	'r' => 'rien'),
		array('m' => 0,		'h' => 18,	'r' => 'rien'),
		array('m' => 0,		'h' => 28,	'r' => false),
		
		# Erreur zone 2 <=> minute > 59
		array('m' => 88,	'h' => 9,	'r' => false),	# dans la zone
		array('m' => 60,	'h' => -3,	'r' => false),	# à l'intérieur des frontières <=> minute = 60
		array('m' => 60,	'h' => 5,	'r' => false),
		array('m' => 60,	'h' => 18,	'r' => false),
		array('m' => 60,	'h' => 28,	'r' => false),
		array('m' => 59,	'h' => -3,	'r' => false),	# à l'extérieur des frontières <=> minute = 59
		array('m' => 59,	'h' => 5,	'r' => '59'),
		array('m' => 59,	'h' => 18,	'r' => '59'),
		array('m' => 59,	'h' => 28,	'r' => false),

		#Erreur zone 3 <=> heure < 0 et minute quelconque
		array('h' => -8,'m' => 9,	'r' => false),	# dans la zone
		array('h' => -1,'m' => 0,	'r' => false),	# à l'intérieur des frontières <=> heure = -1
		array('h' => -1,'m' => 5,	'r' => false),
		array('h' => -1,'m' => 15,	'r' => false),
		array('h' => -1,'m' => 25,	'r' => false),
		array('h' => -1,'m' => 30,	'r' => false),
		array('h' => -1,'m' => 45,	'r' => false),
		array('h' => 0,	'm' => 0,	'r' => ''),		# à l'extérieur des frontières <=> heure = 0
		array('h' => 0,	'm' => 5,	'r' => '5'),
		array('h' => 0,	'm' => 15,	'r' => 'et quart'),
		array('h' => 0,	'm' => 25,	'r' => '25'),
		array('h' => 0,	'm' => 30,	'r' => 'et demi'),
		array('h' => 0,	'm' => 45,	'r' => '45'),

		# Erreur zone 4 <=> heure > 23 et minute quelconque
		array('h' => 28,'m' => 9,	'r' => false),	# dans la zone
		array('h' => 24,'m' => 0,	'r' => false),	# à l'intérieur des frontières <=> heure = 24
		array('h' => 24,'m' => 5,	'r' => false),
		array('h' => 24,'m' => 15,	'r' => false),
		array('h' => 24,'m' => 25,	'r' => false),
		array('h' => 24,'m' => 30,	'r' => false),
		array('h' => 24,'m' => 45,	'r' => false),
		array('h' => 23,'m' => 0,	'r' => false),	# à l'extérieur des frontières <=> heure = 23
		array('h' => 23,'m' => 5,	'r' => false),
		array('h' => 23,'m' => 15,	'r' => false),
		array('h' => 23,'m' => 25,	'r' => false),
		array('h' => 23,'m' => 30,	'r' => false),
		array('h' => 23,'m' => 45,	'r' => false),

	);
 }