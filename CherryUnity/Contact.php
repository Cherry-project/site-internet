<?php 
 // Désactiver le rapport d'erreurs
    error_reporting(0);
    session_start();
    ?>
<!doctype html>
<html>
    <head>  
        <meta charset="utf8">
        <title>Contact</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script type='text/javascript' src='script.js'></script>
    </head>

<body>
    <?php include 'nav.php' ?>
    
    <div class="container">
        <h1 style="margin-left: 27px;">Contact</h1>

        <div class="jumbotron">
            <p style="text-align: center;"><img  height="60px" src="img/logo_sogeti.png" style="text-align: center; "/> </p>
            <p><span class="glyphicon glyphicon-globe" style="margin: 0 15px 0 5px;"></span><a href="http://www.fr.sogeti.com/">www.fr.sogeti.com</a></p>
            <p><span class="glyphicon glyphicon-phone-alt" style="margin: 0 15px 0 5px;"></span>Tel : +33 (0)1 55 00 12 00</p>
            <p><span class="glyphicon glyphicon-map-marker" style="margin: 0 15px 0 5px;"></span>Siège social : 22-24  rue du Gouverneur Général Eboué 92136 Issy-les-Moulineaux </p>
        </div>    
    </div>
    
    <?php include 'footer.php' ?>

   </body>
</html>