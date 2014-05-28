<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>sans titre 1</title>
</head>

<body>

<?php

	require('modele/infosSQL.php');
	
	
	function infosSpecBD($nomSpec) {
		$req = "SELECT s.adresseimg, s.distribution, s.titre, s.synopsis, g.libelle, COUNT(n.note) as nbNotes," 
				. "AVG( n.note ) AS moyNotes FROM genre g, spectacle s LEFT OUTER JOIN note n ON s.id_spec = n.id_spec "
				. "WHERE g.id_genre = s.id_genre "
				. "AND s.titre = '" . $nomSpec . "' GROUP BY s.titre, s.synopsis"; 
		$res = mysql_query($req) or die("erreur de requête : " . $req);
		return mysql_fetch_assoc($res);
	}

	
	
	function getSeances($nomSpec) {		
		$req = "SELECT UNIX_TIMESTAMP(r.date) as date, r.id_representation, COUNT(p.refPlace) as nbPlaces "
			. "FROM representation r, spectacle s, place p "
			. "WHERE r.id_spec = s.id_spec "
			. "AND p.id_representation = r.id_representation "
			. "AND p.id_utilisateur is null "
			. "AND s.titre = '" . $nomSpec 
			. "' GROUP BY r.date, r.id_representation"
			. " ORDER BY (r.date) ASC";
		$res = mysql_query($req) or die("erreur de requete : " . $req);
		return $res;
	}
	
	//Changement function
	
	function getAvis($nomSpec, $ligneDep, $nbLignes, $totalLignes) {
		if($totalLignes - $ligneDep < $nbLignes)
			$nbLignes = ($totalLignes - $ligneDep) + 1;	

		$req = "SELECT u.login, c.date, c.note, c.texte FROM spectacle s, utilisateur u, commentaire c"
				. " WHERE s.id_spec = c.id_spec"
				. " AND u.id_utilisateur = c.id_utilisateur"
				. " AND s.titre LIKE('" . $nomSpec . "') ORDER BY c.date DESC LIMIT "
				. $ligneDep . "," . $nbLignes;
				
		$res = mysql_query($req);
		return $res;
	}
	
	function getIdS($nomSpec) {
		$req = "SELECT id_spec FROM spectacle WHERE titre = '" . $nomSpec . "'";
		$res = mysql_query($req) or die("erreur de requête : " . $req);
		$ret = mysql_fetch_assoc($res);
		return $ret['id_spec'];
	}
	
	function getNbAvis($nomSpec) {
			$req = "SELECT Count(*) as nbAvis FROM commentaire c, spectacle s"
			 	. " WHERE s.id_spec = c.id_spec"
				. " AND s.titre LIKE('" . $nomSpec . "')";
			$ref = mysql_query($req) or die("erreur de requête : " . $req);
			$res = mysql_fetch_assoc($ref);
			return $res['nbAvis'];
	}
		
	function addComment($com, $note, $idUser, $spectacle) {
		$s = getIdS($spectacle);
		$req = "INSERT INTO COMMENTAIRE (id_com, texte, note, date, id_utilisateur, id_spec)"
				. " VALUES (NULL, '" . $com . "', " . $note . ",  NOW(), " . $idUser . ", " . $s . ")"; 
		$res = mysql_query($req) or die("erreur de requete : " . $req);
	}
	
	function addRes($idUser, $nomSpec, $res) {
		$req = "SELECT P.refPlace FROM PLACE P, SPECTACLE S, REPRESENTATION R "
				. "WHERE R.id_spec = S.id_spec "
				. "AND R.id_representation = p.id_representation "
				. "AND S.titre = '" . $nomSpec 
				. "' AND R.id_representation = " . $res
				. " AND P.id_utilisateur is null"
				. " ORDER BY (P.refPlace) ASC"
				. " LIMIT 0,1";
		//$res = mysql_query($req) or die("erreur de requete : " . $req);
		$res = mysql_query($req) or die("erreur de requête : " . $req);
		
		$t = mysql_fetch_assoc($res);
		$idp = $t['refPlace'];
		$req = "UPDATE PLACE SET id_utilisateur = " . $idUser . " WHERE refPlace = " . $idp;
		//mysql_query($req) or dir("erreur de requete : " . $req);
		if(mysql_query($req) < 0)
			return false;
		return true;
	}
?>

</body>

</html>
