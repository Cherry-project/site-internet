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
			<img src="image/fond/cafe.png" id="cafe" class="batiment" alt="cafe" />
			<img src="image/logo/playground.png" id="jeux" class="batiment" alt="jeux" />
			<img src="image/fond/hopital.png" id="hopital" class="batiment" alt="Hôpital" />
			<img src="image/logo/livres.png" id="bib" class="batiment" alt="Bibliothèque" />
			<img src="image/logo/ecole.jpg" id="ecole" class="batiment" alt="école" />			

			<!-- Images iles -->			
			<img src="image/fond/cafe_ile.png" id="ile_cafe" class="ile" alt="cafe" />
			<img src="image/fond/hopital_ile.png" id="ile_hopital" class="ile" alt="Hôpital" />
			<!-- <img src="image/logo/playground.png" id="ile_jeux" class="ile" alt="jeux" />
			<img src="image/building/hospital.png" id="ile_hopital" class="ile" alt="Hôpital" />
			<img src="image/logo/livres.png" id="ile_bib" class="ile" alt="Bibliothèque" />
			<img src="image/logo/ecole.jpg" id="ile_ecole" class="ile" alt="école" /> -->
			<!-- Points d exclamation -->
			<img src="image/logo/exclam.gif" id="ex_cafe" class="exclam" alt="Nouveau contenu!" />
			<img src="image/logo/exclam.gif" id="ex_jeux" class="exclam" alt="Nouveau contenu!" />
			<img src="image/logo/exclam.gif" id="ex_hopital" class="exclam" alt="Nouveau contenu!" />
			<img src="image/logo/exclam.gif" id="ex_bib" class="exclam" alt="Nouveau contenu!" />
			<img src="image/logo/exclam.gif" id="ex_ecole" class="exclam" alt="Nouveau contenu!" />

			<!-- Destination du personnage -->
			<div id = "dest" class = "def"> </div>

    		<!-- avatar, lieu recupere de l url -->
    		<?php
    		if (isset($_GET['lieu'] ))
    		{
    			?>
    			<div id="personnage" class= "<?php echo $_GET['lieu']?>">
    			<div id="perso_image"></div>
    			<img src="image/sprites/mong.png" id="mongolfiere" />
    			</div>
    			<?php
    		}
    		else 
    		{
    			?>
    			<div id="personnage" class= "hopital"> </div>
    			<?php
    		}
    		?>
			
			<!-- autres animations -->
			<img src="image/fond/hopital_arbre.png" id="arbre_hopital" />
			<img src="image/logo/exclam.gif" id="oiseaux" />
			<img src="image/logo/exclam.gif" id="helico" />
			<img src="image/logo/exclam.gif" id="dauphin" />


			<!-- scripts -->
			<script src="../jquery.js"></script>
			<script src="jquery.animateSprite.min.js"></script>
			<script src="indexChild.js"></script> 
              
			<footer>
			 <p> <a href="../Accueil/index.html"> <img src="image/logo/disconnect.png" class="image1" alt="Déconnexion" /></a></p>
			</footer>
		
		</div>
    </body>
</html>