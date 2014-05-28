<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<link rel="stylesheet" href="vue/infosSpec.css">
<link rel="stylesheet" href="vue/profil.css">

<title>Profil</title>
</head>

<body>

	<div id="corps"class="profil">
		<div id="banderolle"> 
			Profil de LOSTisaDRUG
		</div>
		<aside id="menu">
			<p class='titreCorps'> Ses Statistiques </p>
			<div id="statistiques">
				<span id="nbSpec"> o 67 spectacles évalués <br/> o <br/> o <br/> o <br/> o </span>
			</div>
			<p class='titreCorps'> Dernière activités </p>

		</aside>		
		<span class="titreRes">Derniers spectacles reservés ou vus</span>
		<section id="reservations">
			<article id="listeRes">
			<?php foreach($reserv as $r) { ?>
					<div class="place">
							<?php 
							echo("<a href='./index.php?ctrl=spectacles&action=infosSpec&nomSpec=" . $r['titre'] . "'>"); 
								echo("<img class='imgPlace' alt='" . $r['titre'] . "' src='" . $r['adresseImg'] . "'>");
							echo("</a>"); 
							?>
							<p class="infosPlace">
								<span class="titre"><?php echo($r['titre'] . "<br/>"); ?></span>
							</p>
					</div>
			<?php } ?>
			</article>
		</section>
		<section id="msgPrive">
			<?php  if($isLogged && $estAmi) {  ?>
			<div id="commentaire">
				<div id="commenter">
					<?php echo("<form id='envoisPrive' action='./index.php?ctrl=utilisateur&action=profil&idP="
					       . $idProfil . "' method='post'>");
							echo("<textarea name='msgP' id='msgP'></textarea>");
						  	echo("<input type='submit' value='Envoyer'>");
						  	echo("</form>");
						  	echo($msgCom);
					?>
				</div>
			</div>
			<?php 
			}
			else {
			?>
			<div id="commentaire">
				<div id="commenter">
					Vous devez être authentifié et être ami avec la personne pour pouvoir lui adresser un message privé.
				</div>
			</div>
			<?php } ?>
		</section>

		
	</div>

</body>

</html>
