<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>sans titre 1</title>
</head>

<body>

<?php
	
	
	function infosSpec() {
		$jours = array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");
		$mois = array("Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre"
					, "Novembre", "Decembre");
		
		$ID_INFOS = 0;		
		$ID_REP = 1;
					
		// Info reçue du script de connexion
		if(isset($_SESSION['login'])) {
			$NOT_CONNECT = false;
		} else {
			$NOT_CONNECT = true; 
		}
		
		$numPActuelle = $_SESSION['numP'];
		$nomSpec = $_GET['nomSpec'];
		
		require('modele/spectaclesBD.php');
		$msgCom = "";
		if (isset($_POST['com']) && isset($_SESSION['login'])) {
			if(empty($_POST['com']))
				$msgCom = "Vous ne pouvez pas déposer un commentaire vide.";
			else
				addComment(utf8_decode($_POST['com']), $_POST['eval'], $_SESSION['id'], $nomSpec);
		}
		

		$NB_AVIS_PAGE = 5;
		$margeInf = ($numPActuelle - 1) * $NB_AVIS_PAGE;
	
		$nbAvis = getNbAvis($nomSpec);
		$nbPages = (int) ($nbAvis / $NB_AVIS_PAGE);
		if ($nbAvis % $NB_AVIS_PAGE > 0)
			$nbPages += 1;
	
		if ($nbPages < 1)
			$nbPages = 1;
		
		
		$reservee = false;
		$msgConf = "";
		$class = "";
		if (isset($_GET['idRes']) && isset($_SESSION['login'])) {
			$reservee = addRes($_SESSION['id'], $_GET['nomSpec'], $_GET['idRes']);
			if($reservee == true) {
				$class = "valid";
				$msgConf = "Place ajoutée à vos reservations.";
			}
			else {
				$class = "erreur";
				$msgConf = "Une erreur s'est produite lors de la reservation.";
			}
		}
			
		// Info reçue du script de reservation
		/*if(isset($_GET['reserv'])) {
			$reservation = true;
			if($_GET['reserv'] == true)
				$class = "valid";
			else
				$class = "erreur";
		else
			$reservation = false;*/	
		
		// AFFICHAGE
		$infos = infosSpecBD($nomSpec);
		$res = getSeances($nomSpec);
		
		$init = false;
		$rep = array();
		$t = array();
		while($s = mysql_fetch_assoc($res)) {
			$timestamp = $s['date'];
			$indMois = date("n", $timestamp) - 1;
			$m = $mois[$indMois];
			
			if(!$init) {
				$reserve = $m;
				$init = true;
			} 

				if ($m != $reserve) {
					$rep[$reserve] = $t;
					$reserve = $m;
					$t = array();
				}
				$seance = array(($jours[date("N", $timestamp)] . " " . date("d/m/Y H\hi", $timestamp) 
								. " " . $s['nbPlaces'] . " place(s) libre(s)")
								, $s["id_representation"]);
				$t[] = $seance;
		}
		if($init != false)
		$rep[$m] = $t;
		
		$avis = getAvis($nomSpec, $margeInf, $NB_AVIS_PAGE, $nbAvis);
		require("vue/Accueil.html");
		require('vue/infosSpec.php');
	}
		
		// obtenir les commentaires sur un spectacle
	
?>

</body>

</html>
