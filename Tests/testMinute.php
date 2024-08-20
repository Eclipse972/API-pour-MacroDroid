<?php
include 'public/minute.php';

/**
 * Cette fonction prend deux paramètres heure et minute ce donne plus 1440 configuration à tester
 * en tenant compte des valeurs hors intervalle.
 * 
 * Voici le comportement attendu sous forme d'un tableau 
 * 							+-------------------------------------------------------+
 * 							| 						HEURES							|
 * 							|	]-oo; -1]	|	[0;12]	|	[13;23]	|	[24;+oo[	|
 * 		+-------------------+---------------+-----------+-----------+---------------+
 * 		|			]-oo;-1]|						ERREUR zone 1					|
 * 		|			--------+---------------+-----------+-----------+---------------+
 * 		|				0	|				|		chaîne vide		|				|
 * 		|			--------+				+-----------+-----------+				+
 * 		|			[1;12]	|				|			M			|				|
 * 		|			--------+				+-----------+-----------+				+
 * 		|			[13;17]	|				| et quart	|	M		|				|
 * 		| MINUTES	--------+ ERREUR zone 3	+-----------+-----------+ ERREUR zone 4	+
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

		# à l'intérieur des frontières <=> minute = -1
		array('minute' => -1,	'heure' => -3,	'résultat' => false),	# basse 1e partie
		array('minute' => -1,	'heure' => 5,	'résultat' => false),	# basse 2e partie
		array('minute' => -1,	'heure' => 18,	'résultat' => false),	# basse 3e partie
		array('minute' => -1,	'heure' => 28,	'résultat' => false),	# basse 4e partie

		# à l'extérieur des frontières <=> minute = 0
		array('minute' => 0,	'heure' => -3,	'résultat' => false),	# basse 1e partie
		array('minute' => 0,	'heure' => 5,	'résultat' => ''),		# basse 2e partie
		array('minute' => 0,	'heure' => 18,	'résultat' => ''),		# basse 3e partie
		array('minute' => 0,	'heure' => 28,	'résultat' => false),	# basse 4e partie

		# pas de frontière ni en haut, ni a droite ni à gauche

	# Erreur zone 2 <=> minute > 59
		array('minute' => 88,	'heure' => 9,	'résultat' => false),	# dans la zone

		# à l'intérieur des frontières <=> minute = 60
		array('minute' => 60,	'heure' => -3,	'résultat' => false),	# haute 1e partie
		array('minute' => 60,	'heure' => 5,	'résultat' => false),	# haute 2e partie
		array('minute' => 60,	'heure' => 18,	'résultat' => false),	# haute 3e partie
		array('minute' => 60,	'heure' => 28,	'résultat' => false),	# haute 4e partie

		# à l'extérieur des frontières <=> minute = 59
		array('minute' => 59,	'heure' => -3,	'résultat' => false),	# haute 1e partie	
		array('minute' => 59,	'heure' => 5,	'résultat' => '59'),	# haute 2e partie
		array('minute' => 59,	'heure' => 18,	'résultat' => '59'),	# haute 3e partie
		array('minute' => 59,	'heure' => 28,	'résultat' => false),	# haute 4e partie

	#Erreur zone 3 <=> heure < 0 et minute quelconque
		array('heure' => -8,'minute' => 9,	'résultat' => false),	# dans la zone

		# à l'intérieur des frontières <=> heure = -1
		array('heure' => -1,'minute' => 0,	'résultat' => false),	# droite 1e partie	
		array('heure' => -1,'minute' => 5,	'résultat' => false),	# droite 2e partie
		array('heure' => -1,'minute' => 15,	'résultat' => false),	# droite 3e partie
		array('heure' => -1,'minute' => 25,	'résultat' => false),	# droite 4e partie
		array('heure' => -1,'minute' => 30,	'résultat' => false),	# droite 5e partie
		array('heure' => -1,'minute' => 45,	'résultat' => false),	# droite 6e partie

		# à l'extérieur des frontières <=> heure = 0
		array('heure' => 0,	'minute' => 0,	'résultat' => ''),			# droite 1e partie	
		array('heure' => 0,	'minute' => 5,	'résultat' => '5'),			# droite 2e partie
		array('heure' => 0,	'minute' => 15,	'résultat' => 'et quart'),	# droite 3e partie
		array('heure' => 0,	'minute' => 25,	'résultat' => '25'),		# droite 4e partie
		array('heure' => 0,	'minute' => 30,	'résultat' => 'et demi'),	# droite 5e partie
		array('heure' => 0,	'minute' => 45,	'résultat' => '45'),		# droite 6e partie

		# les frontières restantes sont à l'infini ou déjà testées.

	# Erreur zone 4 <=> heure > 23 et minute quelconque
		array('heure' => 28,'minute' => 9,	'résultat' => false),	# dans la zone

		# à l'intérieur des frontières <=> heure = 24
		array('heure' => 24,'minute' => 0,	'résultat' => false),	
		array('heure' => 24,'minute' => 5,	'résultat' => false),
		array('heure' => 24,'minute' => 15,	'résultat' => false),
		array('heure' => 24,'minute' => 25,	'résultat' => false),
		array('heure' => 24,'minute' => 30,	'résultat' => false),
		array('heure' => 24,'minute' => 45,	'résultat' => false),

		# à l'extérieur des frontières <=> heure = 23
		array('heure' => 23,'minute' => 0,	'résultat' => ''),	
		array('heure' => 23,'minute' => 5,	'résultat' => '5'),
		array('heure' => 23,'minute' => 15,	'résultat' => '15'),
		array('heure' => 23,'minute' => 25,	'résultat' => '25'),
		array('heure' => 23,'minute' => 30,	'résultat' => '30'),
		array('heure' => 23,'minute' => 45,	'résultat' => '45'),

	# zone chaine vide <=> minute = 0 et heure quelconque
		array('minute' => 0,	'heure' => 9,	'résultat' => ''),	# dans la zone
		# les frontières droite, gauche et dessus on déjà été testées cf resp. Erreur zone 4, 3 et 1. il reste la frontière du dessous
		array('minute' => 1,	'heure' => 9,	'résultat' => '1'),	# dessous 1e partie

	# zone "et quart" <=> minutes dans [13,17] et heure dans [0;12]
		array('minute' => 15,	'heure' => 9,	'résultat' => 'et quart'),	# dans la zone
		
		# à l'intérieur des frontières <=> heure dans {9h13(dessus), 12h15(droite) 9h17(dessous) 0h15(gauche)}
		array('minute' => 13,	'heure' => 9,	'résultat' => 'et quart'), # dessus
		array('minute' => 15,	'heure' => 12,	'résultat' => 'et quart'), # droite
		array('minute' => 17,	'heure' => 9,	'résultat' => 'et quart'), # dessous
		# la frontière de gauche à déjà été testée dans Erreur zone 3

		# à l'extérieur des frontières
		array('minute' => 12,	'heure' => 9,	'résultat' => '12'), # dessus
		array('minute' => 15,	'heure' => 13,	'résultat' => '15'), # droite
		array('minute' => 18,	'heure' => 9,	'résultat' => '18'), # dessous
		# gauche déjà testé dans Erreur zone 3

	# zone "et demi" <=> minute dans [28;32] et heure dans [0;12]
		array('minute' => 30,	'heure' => 9,	'résultat' => 'et demi'), # dans la zone

		# à l'intérieur des frontières
		array('minute' => 28,	'heure' => 9,	'résultat' => 'et demi'), # haut
		array('minute' => 30,	'heure' => 12,	'résultat' => 'et demi'), # droite
		array('minute' => 32,	'heure' => 9,	'résultat' => 'et demi'), # bas
		array('minute' => 30,	'heure' => 0,	'résultat' => 'et demi'), # gauche
		
		# à l'extérieur des frontières
		array('minute' => 27,	'heure' => 9,	'résultat' => '27'),	# haut
		array('minute' => 30,	'heure' => 13,	'résultat' => '30'),	# droite
		array('minute' => 33,	'heure' => 9,	'résultat' => '33'),	# bas
		array('minute' => 30,	'heure' => -1,	'résultat' => false),	# gauche
	);

	foreach ($Tassertion as $assertion) {
		$reponse = Minute($assertion['heure'], $assertion['minute']);

		if ($reponse === false)	$réponseObtenue = 'false';
		elseif($reponse === '')	$réponseObtenue = 'chaine vide';
		else					$réponseObtenue = $reponse;

		if ($assertion['résultat'] === false)	$réponseAttendue = 'false';
		elseif($assertion['résultat'] === '')	$réponseAttendue = 'chaine vide';
		else									$réponseAttendue = $assertion['résultat'];

		if ($reponse !== $assertion['résultat'])
			return "Echec pour {$assertion['heure']}h{$assertion['minute']} -> $réponseObtenue au lieu de $réponseAttendue";
	}
	return "testTminute() réussi";
 }

echo testMinute(), "\n";
