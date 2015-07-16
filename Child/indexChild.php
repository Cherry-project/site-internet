<!DOCTYPE html>
<html>
    <head>
        <title>Cherry -- Village</title>
		<!--[if lt IE 9]>
            <script src="http://github.com/aFarkas/html5shiv/blob/master/dist/html5shiv.js"></script>
        <![endif]-->
		<!--BOOTSTRAP-->
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<meta charset="utf-8" />
		<link rel="stylesheet" href="indexChild.css" />
		<link rel="icon" href="../Affichage/favicon.png">
    </head>

	
	<body> 
        	
		<div class="container-fluid">
		
		    <header>
					
				<div class="page-header">
					<img src="../Affichage/avatar1.png" class="avatar" alt="avatar" />
					<img src="../Affichage/rouages.png" class="parametre" alt="paramètres" />
					<img src="../Affichage/compte.png" class="compte" alt="compte" />
				</div>
				
			</header>
			
			<!-- Images batiments -->			
			<section>
			<img src="image/logo/stand.jpg" id="cafe" class="imageflottante" alt="cafe" />
			<img src="image/logo/playground.png" id="jeux" class="imageflottante" alt="jeux" />
			<img src="image/building/hospital.png" id="hopital" class="imageflottante" alt="Hôpital" />
			<img src="image/logo/livres.png" id="bib" class="imageflottante" alt="Bibliothèque" />
			<img src="image/logo/ecole.jpg" id="ecole" class="imageflottante" alt="école" />			
			</section>
			<!-- Points d exclamation -->
			<img src="image/logo/exclam.gif" id="ex_cafe" class="exclam" alt="Nouveau contenu!" />
			<img src="image/logo/exclam.gif" id="ex_jeux" class="exclam" alt="Nouveau contenu!" />
			<img src="image/logo/exclam.gif" id="ex_hopital" class="exclam" alt="Nouveau contenu!" />
			<img src="image/logo/exclam.gif" id="ex_bib" class="exclam" alt="Nouveau contenu!" />
			<img src="image/logo/exclam.gif" id="ex_ecole" class="exclam" alt="Nouveau contenu!" />

    		<!-- avatar, lieu recupere de l url -->
    		<?php
    		if (isset($_GET['lieu'] ))
    		{
    			?>
    			<div id="personnage" class= "<?php echo $_GET['lieu'].'_sortie'?>"> </div>
    			<?php
    		}
    		else 
    		{
    			?>
    			<div id="personnage" class= "hopital_sortie"> </div>
    			<?php
    		}
    		?>
			

			<!-- scripts -->
			<script src="../jquery.js"></script>
			<script src="indexChild.js"></script> 
              
			<footer>
			 <p> <a href="../Accueil/index.html"> <img src="image/logo/disconnect.png" class="image1" alt="Déconnexion" /></a></p>
			</footer>
		
		</div>
    </body>
</html>