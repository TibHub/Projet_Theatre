<?php

function verif_ident($nom, $num, &$msgErr) {

	// On vÃ©rifie dans la base de donnÃ©es
	if (!preg_match("`^[a-zA-Z\-\']{1,30}$`", $nom)) {
		$msgErr = "Login incorrect";
	}
	else
		if (!preg_match("`^[0-9]{6,8}$`", $num))
		$msgErr = "Mot de passe incorrect";
	if ($msgErr=="")
			return true;
		else
			return false;
}

function ident() {
	$nom=isset($_POST['login'])?$_POST['login']:'';
	$num=isset($_POST['pwd'])?$_POST['pwd']:'';
	$msgErr = "";
	require('./modele/utilisateurBD.php');
	if (!verif_ident($nom, $num, $msgErr) && getIdUser($nom, $num) != NULL) {
		
		header('Location: ' . $_SESSION['url']);
	}
	else {
		//session_start(); // dÃ©marrage de la session
		$_SESSION['login'] = $_POST['login']; // la personne est authentifiÃ©, variable qui perdure et qui est globale.
		echo( $_SESSION['url']);
		header('Location: ' . $_SESSION['url']);

		//Mettre ici l'accueil version identifiÃ©
	}

} 

function profil() {
	require('./modele/utilisateurBD.php');
	
	//$idProfil = $_GET['idP'];
	$idProfil = 3;
	$reserv = getReserv($idProfil);
	
	$msgCom = "";
	
	if(isset($_POST['msgP'])) {
		$confEnvois = sendMessage(mysql_real_escape_string(
										utf8_decode($_POST['msgP'])
										 ), $_SESSION['id'], $idProfil);
		if($confEnvois == true) {
			$msgCom = "Message envoyé";
		}
		else {
			$msgCom = "Erreur lors de la transmission";
		}
	}
		
	$isLogged = false;
	$estAmi = false;
	if(isset($_SESSION['login'])) {
		$isLogged = true;
		$estAmi = sontAmis($_SESSION['id'], $idProfil);
	}
	
	require('./vue/Accueil.html');
	require('./vue/profil.php');
}

function affCompte() {
	$NB_MESS_PAGE = 10;
	$NB_RESERV_PAGE = 3;
	
	if(!isset($_SESSION['login']) && !isset($_SESSION['id']))
		header('Location: index.php');
	$idUser = $_SESSION['id'];
	$numP = $_SESSION['numP'];
	
		
	
	require('./modele/utilisateurBD.php');
	$confEnvois = false;
	$msgConf = "";
	$class = "";
	if(isset($_GET['idDest']) && isset($_POST['repMess'])) {
			$confEnvois = sendMessage(mysql_real_escape_string(
										utf8_decode($_POST['repMess'])
										 ), $idUser, $_GET['idDest']);
			if($confEnvois == true) {
				$class = "valid";
				$msgConf = "Message envoyé";
			}
			else {
				$class = "erreur";
				$msgConf = "Erreur lors de la transmission";
			}
	}
		
	
	
	$infos = infosUser($idUser);
	if(!isset($_GET['idMess'])) {
		$msgDep = ($numP - 1) * $NB_MESS_PAGE;
		$nbMsg = nbMess($idUser);
		$detailMsg = false;
		$messages = getMessages($idUser, $nbMsg - 1, $msgDep, $NB_MESS_PAGE);
	}
	else {
		$detailMsg = true;
		$message = getMessage($_GET['idMess']);
	}
	
	$reserv = getReserv($idUser);
	
	require('vue/Accueil.html');
	require('vue/compte.php');
}

?>

<!-- ajouterUtilisateur -->

<!-- prÃ©voir un index.php frontal de l'application
	toutes les url invoquent index.php mais un paramÃ¨tre supp associÃ© Ã  l'url va prÃ©ciser le service demandÃ© : 
    index.php?action=ident ou index.php?action=listeContact
    On va rÃ©cupÃ©rer $_GET['action'] pour connaitre le nom du service



 -->