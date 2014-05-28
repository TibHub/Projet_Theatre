<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>sans titre 1</title>
</head>
<?php
function afficherSpec() {
					
	require ('modele/accueilSpectacle.php');
	// Nombre de pages cliquables avant et aprÃ¨s la page actuelle.
	$NB_BTN_ENCADREMENT = 2;
	$NB_SPEC_PAGE = 3;
	$bareme = "/5";
	$INDICE_TITRE = 2;
	$INDICE_NOTES = 4;
	$INDICE_MOY = 5;

	$nbSpec = getNbSpec();
	if(isset($_SESSION['login']))
	{
		$isLogged = true;
	}
	else
	{
		$isLogged = false;
	}
	
	
	$nbPages = (int) ($nbSpec / $NB_SPEC_PAGE);
	if ($nbSpec % $NB_SPEC_PAGE > 0)
		$nbPages += 1;
	
	if ($nbPages < 1)
		$nbPages = 1;
	
	$numPActuelle = $_SESSION['numP'];
	$_SESSION['url']= $_SERVER["PHP_SELF"];
	$margeInf = ($numPActuelle - 1) * $NB_SPEC_PAGE;
		
	$ref = getPage($margeInf, $NB_SPEC_PAGE, $nbSpec);

	
	$isLogged = true;
	$msgErr = "";
	require("vue/Accueil.html");
	require("vue/testAffichageSpec.php");
}

?>
<body>

</body>

</html>
