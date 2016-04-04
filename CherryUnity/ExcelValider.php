<?php
// Désactiver le rapport d'erreurs
    error_reporting(0);
    session_start();
    ?>
<html>
<head>
    <meta charset="utf8">
    <title>Ajout d'un excel de description de scénario</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script type='text/javascript' src='script.js'></script>
    <?php 
        session_start();
        $root = "./";
        require "includes.php";
    ?>
</head>

<body>
    <?php include 'nav.php';  
    
    include 'simplexlsx.class.php';
           
    $xlsx = new SimpleXLSX($_FILES['avatar']['tmp_name']);
    
    $name = $_FILES['avatar']['name'];
    $names = explode('.',$name);
    $nameFinal = "";
    $i = 0;
    for($i = 0; $i<count($names)-1; $i++)
    {
        $nameFinal .= $names[$i];   
    }
    $email_owner = $_SESSION['email'];
    $url_txt = print_r($xlsx->rows(),true);
   // echo $url_txt;
    echo '<br/>';
    $_type = $_SESSION['type'];
    
    $contentDao = new ContentDAO(LocalDBClientBuilder::get());
    $content = new Content();
    $content->setName($nameFinal);
    $content->setEmailOwner($email_owner);
    $content->setUrl($url_txt);
    $content->setType($_type);
    
    $children =  array();
    $children[] = array('email' => $_POST['child'], 'dateStart' => $_POST['date_debut'], 'dateEnd' => $_POST['date_fin']);
    
    $contentDao->create($content, $children);
    echo '<p style="margin-left:20px;">Votre texte a bien été enregistré.</p><br/>';
    
    /*echo '<br/><br/><h1>$xlsx->rows()</h1>';
    echo '<pre>';
    print_r( $xlsx->rows() );
    echo '</pre>';*/
    
      ?>
    
    <a href="adultShowContents.php"  style="margin-left:20px;">Revenir à la page de Gestion de contenus</a>
</body>

<footer class="footer">
            <div class="container-fluid">
                <img  height="60px" src="img/logo.jpg"/> 
            </div>
        </footer>
</html>
