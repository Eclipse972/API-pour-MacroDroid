<?php
/**
 * extraction d'une valeur d'un tableau associatif contenant des chaines de caractères à partir d'une clé
 * si la chaine de caracrtères correspond à un réel on renvoie ce réel
 * sinon on renvoie false
 * 
 * @param string clé
 * @param array T tableau associatif
 * @return float|bool
 */
function extractionParamètre(string $clé, array $T) : float|bool {
	if (isset($T[$clé]))
		return preg_match('/^-?\d+(\.\d+)?$/', $T[$clé]) ?
				$T[$clé] :
				false;
	else return false;
}
