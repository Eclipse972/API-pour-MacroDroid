<?php
include 'public/extractionParametre.php';
function testExtractionParametre() : string {
	$Tvaleur = array(
		'a' => null,
		'b' => false,
		'c' => 3.14,
		'd' => '2.78',
		'e' => '9,32'
	);

	$Tassertion = array(
		array('paramètre' => 'a',	'réponse' => false),
		array('paramètre' => 'b',	'réponse' => false),
		array('paramètre' => 'c',	'réponse' => false),
		array('paramètre' => 'd',	'réponse' => 2.78),
		array('paramètre' => 'e',	'réponse' => false),
		array('paramètre' => 'f',	'réponse' => false)
	);
	foreach ($Tassertion as $assertion) {
		$reponse = extractionParamètre($assertion['paramètre'], $Tvaleur);
		$reponseObtenue = gettype($reponse) == 'boolean' ?
							($reponse ? 'vrai' : 'faux') :
							$reponse;

		$reponseAttendue = gettype($assertion['réponse']) == 'boolean' ?
							($assertion['réponse'] ? 'vrai' : 'faux') :
							$assertion['réponse'];

		if($reponse !== $assertion['réponse'])
			return "Echec pour paramètre {$assertion['paramètre']}: valeur obtenue $reponseObtenue au lieu de $reponseAttendue";
	}
	return 'test extractionParamètre() réussi';
}

echo testExtractionParametre(), "\n";