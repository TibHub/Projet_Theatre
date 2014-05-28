<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Index</title>
</head>

<body>

<?php
	session_start();
	
	if (!isset($_GET['ctrl']) && !isset($_GET['action'])) {
		$ctrl = "accueil";
		$action = "afficherSpec";
	}
	else {
		$ctrl = $_GET['ctrl'];
		$action = $_GET['action'];
	}
		
	if (!isset($_GET['numP']))
		$_SESSION['numP'] = 1;
	else
		$_SESSION['numP'] = $_GET['numP'];
	
		// Vérifier le numéro de page dans ACCUEIL, SPECTACLES, SPECTACLE (commentaires) ET
		// COMPTE (boite de messagerie).
		
		// Le formulaire d'identification est présent dans plusieurs pages, on vérifiera dans 
		// les différents scripts PHP si des informations se rapportant à un formulaire sont dans $_POST.
	
	require("control/" . $ctrl . ".php");
	$action();
?>

</body>

</html>
