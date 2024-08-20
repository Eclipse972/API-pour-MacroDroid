<?php
include 'public/minute.php';

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
		array('minute' => -5,	'heure' => 9,	'résultat' => false),	# dans la zone
		array('minute' => -1,	'heure' => -3,	'résultat' => false),	# à l'intérieur des frontières <=> minute = -1
		array('minute' => -1,	'heure' => 5,	'résultat' => false),
		array('minute' => -1,	'heure' => 18,	'résultat' => false),
		array('minute' => -1,	'heure' => 28,	'résultat' => false),
		array('minute' => 0,	'heure' => -3,	'résultat' => false),	# à l'extérieur des frontières <=> minute = 0
		array('minute' => 0,	'heure' => 5,	'résultat' => ''),
		array('minute' => 0,	'heure' => 18,	'résultat' => ''),
		array('minute' => 0,	'heure' => 28,	'résultat' => false),
		
		# Erreur zone 2 <=> minute > 59
		array('minute' => 88,	'heure' => 9,	'résultat' => false),	# dans la zone
		array('minute' => 60,	'heure' => -3,	'résultat' => false),	# à l'intérieur des frontières <=> minute = 60
		array('minute' => 60,	'heure' => 5,	'résultat' => false),
		array('minute' => 60,	'heure' => 18,	'résultat' => false),
		array('minute' => 60,	'heure' => 28,	'résultat' => false),
		array('minute' => 59,	'heure' => -3,	'résultat' => false),	# à l'extérieur des frontières <=> minute = 59
		array('minute' => 59,	'heure' => 5,	'résultat' => '59'),
		array('minute' => 59,	'heure' => 18,	'résultat' => '59'),
		array('minute' => 59,	'heure' => 28,	'résultat' => false),

		#Erreur zone 3 <=> heure < 0 et minute quelconque
		array('heure' => -8,'minute' => 9,	'résultat' => false),	# dans la zone
		array('heure' => -1,'minute' => 0,	'résultat' => false),	# à l'intérieur des frontières <=> heure = -1
		array('heure' => -1,'minute' => 5,	'résultat' => false),
		array('heure' => -1,'minute' => 15,	'résultat' => false),
		array('heure' => -1,'minute' => 25,	'résultat' => false),
		array('heure' => -1,'minute' => 30,	'résultat' => false),
		array('heure' => -1,'minute' => 45,	'résultat' => false),
		array('heure' => 0,	'minute' => 0,	'résultat' => ''),		# à l'extérieur des frontières <=> heure = 0
		array('heure' => 0,	'minute' => 5,	'résultat' => '5'),
		array('heure' => 0,	'minute' => 15,	'résultat' => 'et quart'),
		array('heure' => 0,	'minute' => 25,	'résultat' => '25'),
		array('heure' => 0,	'minute' => 30,	'résultat' => 'et demi'),
		array('heure' => 0,	'minute' => 45,	'résultat' => '45'),

		# Erreur zone 4 <=> heure > 23 et minute quelconque
		array('heure' => 28,'minute' => 9,	'résultat' => false),	# dans la zone
		array('heure' => 24,'minute' => 0,	'résultat' => false),	# à l'intérieur des frontières <=> heure = 24
		array('heure' => 24,'minute' => 5,	'résultat' => false),
		array('heure' => 24,'minute' => 15,	'résultat' => false),
		array('heure' => 24,'minute' => 25,	'résultat' => false),
		array('heure' => 24,'minute' => 30,	'résultat' => false),
		array('heure' => 24,'minute' => 45,	'résultat' => false),
		array('heure' => 23,'minute' => 0,	'résultat' => false),	# à l'extérieur des frontières <=> heure = 23
		array('heure' => 23,'minute' => 5,	'résultat' => false),
		array('heure' => 23,'minute' => 15,	'résultat' => false),
		array('heure' => 23,'minute' => 25,	'résultat' => false),
		array('heure' => 23,'minute' => 30,	'résultat' => false),
		array('heure' => 23,'minute' => 45,	'résultat' => false),

		# zone rien (chaine vide) <=> minute = 0 et heure quelconque
		array('minute' => 0,	'heure' => 9,	'résultat' => ''),	# dans la zone
		# les frontières droite, gauche et dessus on déjà été testées cf resp. Erreur zone 4, 3 et 1. il reste la frontière du dessous
		array('minute' => 1,	'heure' => 9,	'résultat' => '1'),

		# zone "et quart" <=> minutes dans [13,17] et heure dans [0;12]
		array('minute' => 15,	'heure' => 9,	'résultat' => 'et quart'),	# dans la zone
		
		array('minute' => 13,	'heure' => 9,	'résultat' => 'et quart'), # à l'intérieur des frontières <=> heure dans {9h13(dessus), 12h15(droite) 9h17(dessous) 0h15(gauche)}
		array('minute' => 15,	'heure' => 12,	'résultat' => 'et quart'),
		array('minute' => 17,	'heure' => 12,	'résultat' => 'et quart'),
		# la frontière de gauche (0h15) à déjà été testée dans zone Erreur zone 3
	);

	foreach ($Tassertion as $assertion) {
		$reponse = Minute($assertion['heure'], $assertion['minute']);

		if ($reponse === false)	$réponseObtenue = 'false';
		elseif($reponse === '')	$réponseObtenue = 'chaine vide';
		else					$réponseObtenue = $reponse;

		if ($assertion['résultat'] === false)	$réponseAttendue = 'false';
		elseif($assertion['résultat'] === '')	$réponseAttendue = 'chaine vide';
		else									$réponseAttendue = $reponse;

		if ($reponse !== $assertion['résultat']) return "Echec pour {$assertion['heure']}h{$assertion['minute']} -> $réponseObtenue au lieu de $réponseAttendue";
	}
	return "testTminute() réussi";
 }

echo testMinute(), "\n";
