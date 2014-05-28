<html>
<head>
<link rel="stylesheet" href="vue/testAffichageSpec.css"/>
</head>

<body>

<script type="text/javascript">
	window.onload = function() {
		var numP = window.document.getElementById("PageAct")
	}

</script>

<section id='corps'>
	
	<p id='titreCorps'> Les spectacles Ã  l'affiche </p>
<?php
    	while($spec = mysql_fetch_assoc($ref)) { 
    	 ?>
    		<article class='blockSpec'> 
    			<div id="divSpec">
    				<figure class='figSpec'> 
    					<?php
    					$aff = "<img class='imgSpec' alt='Image du spectacle'";
    				
    					$index = key($spec);
    					$link = " src='" . $spec[$index] . "'/>";
    					next($spec);
    				
    					$aff = $aff . $link;
    					echo($aff);
    					?>
    				</figure>
    				<div id="distribution"> 
    					<?php
    					echo($spec[key($spec)]);
    					next($spec); 
    					?>
    				</div>
    			</div>
    			<div id="infoSpec">
    				<p id="infos">
    					<?php
     	   				for($i = 2; $i < count($spec); $i++) {
							$index = key($spec);
							if ($i == $INDICE_TITRE) {
								?>
								<h3 id='titreSpec'> 
									<?php
										//Changement 1er echo
										echo("<a class='lienSpec' href='./index.php?ctrl=spectacles"
												. "&action=infosSpec&numP=1&nomSpec=" . $spec[$index] . "'>");
										echo($spec[$index]);
										echo("</a>"); 
									?>
								</h3>
								<?php	
								next($spec);
								continue;
							}
     	   					if($i == $INDICE_NOTES) {
     	   						if( $spec[$index] == 0) {
     	   							$mess = "Soyez le ou la première à noter ce spectacle !";
     	   							echo "<p>" . htmlspecialchars($mess) . "</p>";
     	   							break;
     	   						}
     	   						echo($spec[$index] . " note(s)"); 
     	   						next($spec);
     	   						continue;
     	   					}
     	   					
     	   					echo($spec[$index]);
							if($i == $INDICE_MOY) 
								 echo( $bareme . "<br/>");
							else
								echo "<br/>";
     	   					next($spec);
						} 
						?>
					</p>
				</div>    		
			</article>
		<?php
		}
		?>
		<nav id="navPages">
			<ul id="listePages">
			<?php 
			//  Bouton de navigation précédent
			if ($numPActuelle == 1)
				echo("<li class='btnBloque'> &lt; </li>");
			else {
				echo("<li class='btnPrec'><a href='./index.php?numP=" 
							. ($numPActuelle - 1) . "'> &lt; </a></li>");
				echo("<li class='btnPage'><a href='./index.php?numP=1'> 1 </a></li>");
			}
			
				
			if ($numPActuelle - 1 > $NB_BTN_ENCADREMENT)
				echo("<li id='etc'> ... </li>");
					
			$num = $numPActuelle - 1;
			for($i = 0; $i < $NB_BTN_ENCADREMENT && $num > 1; $i++, $num--)
				echo("<li class='btnPage'><a href='./index.php?numP=" . $num . "'>" . $num . "</a></li>");

			echo("<li id='PageAct'>" . $numPActuelle . "</li>");
					
			$num = $numPActuelle + 1;
			for($i = 0; $i < $NB_BTN_ENCADREMENT && $num < $nbPages; $i++, $num++)
				echo("<li class='btnPage'><a href='./index.php?numP=" . $num . "'>" . $num . "</a></li>");
					
			if ($nbPages - $numPActuelle > $NB_BTN_ENCADREMENT)
				echo("<li id='etc'> ... </li>");
				
			if ($nbPages > 1 && $nbPages > $numPActuelle) {
				echo("<li class='btnPage'> <a href='./index.php?numP=" 
					. $nbPages . "'>" . $nbPages . "</a> </li>");
				$btn = "<li class='btnPrec'><a href='./index.php?numP=" 
					. ($numPActuelle + 1) . "'> &gt; </a></li>";
			}
			else
				$btn = "<li class='btnBloque'> &gt; </li>";
				
			echo($btn);

			?>
			</ul>
		</nav>
		
</section>
<?php 
	if($isLogged)
	{ ?>
		<aside id="logBloc">
			<div><a id="compte" href="./index.php?ctrl=utilisateur&action=affCompte">Mon compte</a></div>
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