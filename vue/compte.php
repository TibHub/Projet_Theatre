<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<link rel="stylesheet" href="vue/compte.css">
<link rel="stylesheet" href="vue/infosSpec.css">
<title>Mon compte</title>
</head>

<body>
	<div id="corps">
		<section id="stats">
		<p class='titreCorps'> Mes Statistiques </p>
		</section>
		
		<section id="boiteRec">
			<p class='titreCorps'> Ma Messagerie </p>
			<?php 
			if(!$detailMsg) { ?>
				<table id="tabMsg">
					<tr class="haut">
						<th class="gradientNoir"> De </th>
						<th class="gradientNoir"> Reçu </th>
						<th class="gradientNoir"> Action </th>
					</tr>
					<?php
						foreach($messages as $msg) {
							if($msg['estLu'])
								$class = "estLu";
							else
								$class = "pasLu";
							echo("<tr class='" . $class . "'>");
								echo("<td> <a href='./index.php?ctrl=utilisateur&action=profil&idP=" 
									. $msg['id_utilisateur'] . "'>" . $msg['login'] . "</a> </td>");
								echo("<td>" . $msg['date'] . "</td>");
								echo("<td><a href='./index.php?ctrl=utilisateur&action=affCompte&idMess=" 
									. $msg['id_mess'] . "'>Lire</a></td>");
							echo("</tr>");
						}
					?>
					<tr class="bas">
						<th class="gradientNoir"></th>
						<th class="gradientNoir"></th>
						<th class="gradientNoir"></th>
					</tr>
				</table>
			<?php }
			else { ?>
				<article>
					<div id="mess">
						<div id="entete" class="gradientNoir"><?php echo("Reçu :" . $message['date']) ?></div>
						<p>
							<?php echo(utf8_encode(
								nl2br($message['texte'])
								)); ?>
						</p>
					</div>
					<?php echo("<form id='repondre' action='./index.php?ctrl=utilisateur&action=affCompte&idDest="
				       . $message['id_exp'] . "' method='post'>");
						echo("<textarea name='repMess' id='repMess'></textarea>");
					  	echo("<input id='btnRep' class='gradientNoir' type='submit' value='Repondre'>");
					  	echo("</form>");
					?>
				</article>
			<?php } ?>
		</section>
		<?php 
			if($confEnvois) {
			echo("<span id='confirmation' class='" . $class . "'>" . $msgConf . "</span>");
			}
		?>
		
		<section id="reservations">
			<p class='titreCorps'> Mes Réservations </p>
			<article id="listeRes">
			<?php foreach($reserv as $r) { ?>
					<div class="place">
						<!--figure id="img"-->
							<?php 
							echo("<a href='./index.php?ctrl=spectacles&action=infosSpec&nomSpec=" . $r['titre'] . "'>"); 
								echo("<img class='imgPlace' alt='" . $r['titre'] . "' src='" . $r['adresseImg'] . "'>");
							echo("</a>"); ?>
						<!--/figure-->
						<p class="infosPlace">
							<span class="titre"><?php echo($r['titre'] . "<br/>"); ?></span>
							<?php 
							echo($r['date'] . "<br/>" . "Salle " . $r['nom'] . "<br/>" . "Place n° " . $r['num']);
							?>
						</p>
					</div>
			<?php } ?>
			</article>
		</section>
		<section id="Coord">
			<p class='titreCorps'> Modifier mes Coordonnées </p>
		</section>
	</div>
</body>

</html>
