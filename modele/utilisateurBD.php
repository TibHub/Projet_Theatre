<?php

require('./modele/infosSQL.php');

function getIdUser($nom, $num) {
	$req = "SELECT `ID_UTILISATEUR` FROM `utilisateur` WHERE `LOGIN` = '$login' AND `MDP` = '$pwd'";
	$res = mysql_query($req) or die("erreur de requete :" . $req);
	if (mysql_num_rows($res) == 0) 
		return NULL;
	else {
		$T = mysql_fetch_assoc($res);
		$id = $T['ID_UTILISATEUR'];
		return $id;
	}
}

//#################################################### MODIFICATIONS ##################################################

function infosUser($idUser) {
	$req = "SELECT login, mdp FROM utilisateur WHERE id_utilisateur = " . $idUser;
	$res = mysql_query($req) or die("erreur de requête : " . $req . mysql_error());
	while($ligne = mysql_fetch_assoc($res)) {
		$t[] = $ligne;
	}
	return $t;
}

function nbMess($idUser) {
	$req = "SELECT COUNT(id_mess) as nbMsg FROM message WHERE id_dest =" . $idUser;
	$res = mysql_query($req) or die("erreur de requête : " . $req);
	$ret = mysql_fetch_assoc($res);
	return $ret['nbMsg'];
}

// MODIFICATIONS !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
function getMessages($idUser, $numLastMsg, $msgDep, $nbMsg) {
	if($numLastMsg - $msgDep < $nbMsg)
		$nbMsg = $numLastMsg - $msgDep + 1;
	
	$req = "SELECT m.id_mess, m.date, m.estLu, exp.id_utilisateur, exp.login FROM message m, utilisateur exp"
			. " WHERE id_dest =" . $idUser
			. " AND exp.id_utilisateur = m.id_exp"
			. " ORDER BY date DESC LIMIT " . $msgDep . ", " . $nbMsg;
	$res = mysql_query($req) or die("erreur de requête : " . $req);
	$t = array();
	while($ligne = mysql_fetch_assoc($res)) {
		$t[] = $ligne;
	}
	return $t;
}

function getMessage($idMess) {
	$req = "SELECT texte, date, estLu, id_exp FROM message WHERE id_mess = " . $idMess;
	$res = mysql_query($req) or die("erreur de requête : " . $req);
	$msg = mysql_fetch_assoc($res);
	
	if ($msg['estLu'] == 0) {
		$req = "UPDATE message SET estLu = 1 WHERE id_mess =" . $idMess;
		mysql_query($req) or die("erreur de requête : " . $req);
	}
	return $msg;
}

function sendMessage($texte, $idExp, $idDest) {
	$req = "INSERT INTO message(id_mess, texte, date, estLu, id_exp, id_dest) "
			. "VALUES(NULL, '" . $texte . "', NOW(), 0, " . $idExp . ", " . $idDest . ")";
	if(mysql_query($req)) //or die("erreur de requête : " . $req);
		return true;
	return false;
}

function getReserv($idUser) {
	$req = "SELECT sp.adresseImg, sp.titre, r.date, s.nom, p.num, p.prix"
			. " FROM spectacle sp, representation r, place p, salle s, utilisateur u"
			. " WHERE sp.id_spec = r.id_spec"
			. " AND r.id_representation = p.id_representation"
			. " AND p.id_utilisateur = u.id_utilisateur"
			. " AND r.date > NOW()"
			. " AND u.id_utilisateur = " . $idUser
			. " ORDER BY r.date ASC";
	$res = mysql_query($req) or die("erreur de requête : " . $req);
	$t = array();
	while($l = mysql_fetch_assoc($res)) {
		$t[] = $l;
	}
	return $t;
}

function sontAmis($idUser1, $idUser2) {
	$req = "SELECT COUNT(*) as sontAmis FROM utilisateur u1, utilisateur u2, amis a"
			. " WHERE a.id_utilisateur1 = u1.id_utilisateur"
			. " AND a.id_utilisateur2 = u2.id_utilisateur"
			. " AND u1.id_utilisateur =" . $idUser1
			. " AND u2.id_utilisateur =" . $idUser2;
	$res = mysql_query($req) or die("erreur de requête : " . $req);
	$sontAmis = mysql_fetch_assoc($res);
	if ($sontAmis['sontAmis'] == 1) 
		return true;
	return false;
}

// ############################################## FIN MODIFICATIONS ###################################################
?>

<!-- insÃ©rerUtilisateur -->