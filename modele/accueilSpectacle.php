<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>sans titre 1</title>
</head>

<body>

<?php

	require('modele/infosSQL.php');

	function getNbSpec() {
		$req = "SELECT Count(*) as nbSpec FROM `spectacle`";
		$ref = mysql_query($req) or die("erreur de requête : " . $req);
		$res = mysql_fetch_assoc($ref);
		return $res['nbSpec'];
	}
	
	function getPage($ligneDep, $nbLignes, $totalLignes) {
		// on vérifie que le nombre d'enregistrement demandé n'outrepasse pas les limites de la table
		if($totalLignes - $ligneDep < $nbLignes)
			$nbLignes = ($totalLignes - $ligneDep) + 1;
			
		/*$req = "SELECT adresseimg, titre, distribution, synopsis, nbavis, moyenne FROM SPECTACLE "
				. "ORDER BY moyenne LIMIT "
				. $ligneDep . "," . $nbLignes;*/
		$req = "SELECT s.adresseimg, s.distribution, s.titre, s.synopsis, COUNT(n.note) as nbNotes," 
				. "AVG( n.note ) AS moyNotes FROM spectacle s LEFT OUTER JOIN note n ON s.id_spec = n.id_spec "
				. "GROUP BY s.titre, s.synopsis ORDER BY (moyNotes) DESC LIMIT "
				. $ligneDep . "," . $nbLignes;

		$ref = mysql_query($req) or die("erreur de requête : " . $req);
		return $ref;
	}


?>

</body>

</html>
