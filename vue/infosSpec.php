<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>info spectacle</title>
<link rel="stylesheet" href="vue/infosSpec.css">

<script type="text/javascript">
	window.onload = function() {
		var listLi = window.document.getElementsByClassName("seance");
 		var validForm = window.document.getElementById("validForm");
 		var reserv = window.document.getElementById("reservchx");
 		var sprix = window.document.getElementById("prix");
 		for(var i=0; i < listLi.length; i++) {
 			listLi[i].onclick = function() {
   									sprix.innerHTML = "25 €";
   									validForm.action += "&idRes=" + this.id;
   									alert(validForm.action);
   									reserv.style.visibility = 'visible';
  								}
 		}
	}
</script>

</head>

<body>


	<section id="corps">
	
	<div id="rubrique" class="gradient"> Le spectacle </div>

	<article id="infos">
		
		<div id="img">
			<!--figure id="fig"-->
			<?php
				echo("<img id='imgSpec' alt='" . $infos['titre'] 
						. "' src='" . $infos['adresseimg'] . "'/>");
			?>
			<!--/figure-->
		</div>	
		<div id="spec">
			<h1><?php echo($infos['titre']); ?></h1>
			<p> 
			<?php 
				echo(utf8_encode($infos['libelle']) . "<br/>");
				echo("Du 13/05/13 au 15/08/13 <br/>");
				echo("Salle Vulpian <br/>");
				echo("Evaluation <br/>");
				echo($infos['moyNotes'] . "<br/>");
				echo($infos['nbNotes'] . " personnes ont déposés un avis sur ce spectacle.")
			?>
			</p>
		</div>
	</article>
	
	<div id="rubrique" class="gradient"> Synopsis </div>
	
	<article id="synopsis">
		<div id="resume">
			<p>
				<?php //modif !
				 echo($infos['synopsis']) ?>
			</p>
		</div>
	</article>
	
	<br /> <div id="rubrique" class="gradient"> Synopsis </div> <br />

	<article id="synopsis">
		<div>
		</div>
	</article>

	<br /><div id="rubrique" class="gradient"> Reservation </div> <br />
	<div id="reservblock">
		<article id="reserv">
				<?php foreach($rep as $cle => $t) { ?>
				<div id="mois-1">
					<h1 class="mois"> <?php echo($cle) ?> </h1>
					<ul class="ulMois">
					<?php foreach($t as $cle2 => $seance)
					
						echo("<li class='seance' id='" . $seance[$ID_REP] . "' >" . $seance[$ID_INFOS] . "</li>")
						
					?>
					</ul>
				</div>
                
				<?php } 
				if (empty($rep))
					echo("Aucune représentation disponible pour le moment.");
				?>
		</article>
		<?php
		if($reservee) {
			echo("<span id='confirmation' class='" . $class . "'>" . $msgConf . "</span>");
		}
		?>
    	<article id="reservchx">
    			<span> Vous allez acheter une place à </span>
    			<span id="prix"> </span>
    			<?php
				echo("<form id='validForm' action='./index.php?ctrl=spectacles&action=infosSpec&nomSpec="
				 . $infos['titre'] . "' method='post'>");
					echo("<input type='submit' value='Confirmer'>");
				echo("</form>");
				?>
    	</article>
	</div>
	<br /> <div id="rubrique" class="gradient"> Avis </div> <br />

	<article id="Avis">
		<?php  if($NOT_CONNECT) {  ?>
		<div id="commentaire">
			<div id="user" class="bloque">
				<h1>ET VOUS ?</h1>
			</div>
			<div id="commenter">
				Vous devez vous <a href="#auth"> identifier </a> pour pouvoir déposer un commentaire.
			</div>
		</div>
		<?php 
		}
		else {
		?>
		<div id="commentaire">
			<div id="user" class="bloque">
				<h1>ET VOUS ?</h1>
			</div>
			<div id="commenter">
				
				<?php echo("<form id='envoisCom' action='./index.php?ctrl=spectacles&action=infosSpec&nomSpec="
				       . $infos['titre'] . "' method='post'>");
				       	echo("<select name='eval' id='eval'>"
				       			. "<option selected='selected'>0</option>"
				       			. "<option>1</option>"
				       			. "<option>2</option>"
								. "<option>3</option>"
								. "<option>4</option>"
								. "<option>5</option>"
								. "</select>");
						echo("<textarea name='com' id='com'></textarea>");
					  	echo("<input type='submit' value='Envoyer'>");
					  	echo("</form>");
					  	echo($msgCom);
				?>
			</div>
		</div>

		<?php }

		while($c = mysql_fetch_assoc($avis)) { 
		?>
		<div id="commentaire">
			<div id="user">
				<?php 
					echo($c['login'] . "<br/>");
					echo($c['date'] . "<br/>");
					echo($c['note'] . "<br/>");
				?>
			</div>
			<div id="text">
				<?php echo(utf8_encode(nl2br($c['texte']))); ?>
			</div>
		</div>
		<?php } ?>
        	<nav id="navPages">
            <ul id="listePages">
			<?php
			// Nombre de pages cliquables avant et aprÃ¨s la page actuelle.
			$NB_BTN_ENCADREMENT = 2; 
			
			//  Bouton de navigation précédent
			if ($numPActuelle == 1)
				echo("<li class='btnBloque'> &lt; </li>");
			else {
				echo("<li class='btnPrec'><a href='./index.php?ctrl=spectacles&action=infosSpec&nomSpec="
							. $nomSpec . "&numP="
							. ($numPActuelle - 1) . "'> &lt; </a></li>");
				echo("<li class='btnPage'><a href='./index.php?ctrl=spectacles&action=infosSpec&nomSpec="
							. $nomSpec . "&numP=1'> 1 </a></li>");
			}
			
				
			if ($numPActuelle - 1 > $NB_BTN_ENCADREMENT)
				echo("<li id='etc'> ... </li>");
					
			$num = $numPActuelle - 1;
			for($i = 0; $i < $NB_BTN_ENCADREMENT && $num > 1; $i++, $num--)
				echo("<li class='btnPage'><a href='./index.php?ctrl=spectacles&action=infosSpec&nomSpec="
							. $nomSpec . "&numP=" . $num . "'>" . $num . "</a></li>");

			echo("<li id='PageAct'>" . $numPActuelle . "</li>");
					
			$num = $numPActuelle + 1;
			for($i = 0; $i < $NB_BTN_ENCADREMENT && $num < $nbPages; $i++, $num++)
				echo("<li class='btnPage'><a href='./index.php?ctrl=spectacles&action=infosSpec&nomSpec="
							. $nomSpec . "&numP=" . $num . "'>" . $num . "</a></li>");
					
			if ($nbPages - $numPActuelle > $NB_BTN_ENCADREMENT)
				echo("<li id='etc'> ... </li>");
				
			if ($nbPages > 1 && $nbPages > $numPActuelle) {
				echo("<li class='btnPage'> <a href='./index.php?ctrl=spectacles&action=infosSpec&nomSpec="
							. $nomSpec . "&numP=" . $nbPages . "'>" . $nbPages . "</a> </li>");
				$btn = "<li class='btnPrec'><a href='./index.php?ctrl=spectacles&action=infosSpec&nomSpec="
							. $nomSpec . "&numP=". ($numPActuelle + 1) . "'> &gt; </a></li>";
			}
			else
				$btn = "<li class='btnBloque'> &gt; </li>";
				
			echo($btn);

			?>
			</ul>
		</nav>
	</article>


	
	</section>
	<?php 
	if(!$NOT_CONNECT)
	{ ?>
		<aside id="logBloc">
			<a href="./index.php?ctrl=utilisateur&action=affCompte"></a>
        </aside>

	<?php } 
	else
	{?>
        <aside id="auth">
        	<fieldset>
            	<form action="./index.php?ctrl=utilisateur&action=ident" method="post">
	            	<label class="lbl"> Login </label> <input name="login" id="login" type="text"> 
	            	<hr/>
	                <label class="lbl"> Mot de passe </label> <input name="pwd" id="pwd" type="text">
	                <hr/>
        	    	<input class="gradient" id="btn" type="submit" value="ok"/>
                    <div id ="msgErr"> <?php echo (htmlspecialchars($msgErr)); ?> </div>
                </form>
            </fieldset>
        </aside>
<?php } ?>



</body>

</html>
