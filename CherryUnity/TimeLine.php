<?php
// Désactiver le rapport d'erreurs
    error_reporting(0);
    session_start();
    $root = "./";
    include 'includes.php'; 
    include 'head.php';
print_r($_POST);


//EXEMPLE :
echo "<br/><br/><br/><br/><br/><br/>Exemple : Voici l'affichage de la 1ère slide :";
$images = explode("{{", $_POST['timeline']);
$images[0]="_";
//echo "<br/><br/>";print_r($images);echo "<br/><br/>";
$_images = explode("}}", $images[1]);
//print_r($_images);echo "<br/><br/>";
$img="";
for($i=0; $i<strlen($_images[0]); $i++)
{
    $img .= $_images[0][$i];
}
echo "<br/><br/><img  src='".$img."' style='height: 500px; margin-bottom: 15px;' />";
echo "<br/>lien : ".$img;

//redecoupage
echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>Redécoupage de la chaîne de caractère pour sauvegarde dans la BDD :<br/>";

$lignes = array();
$colonnes=array();
$colonnes[] = "Behave";
$colonnes[] = "Text";
$colonnes[] = "Slide";
$lignes[] = $colonnes;
$colonnes = array();
$slides = explode("{{", $_POST["timeline"]);
//print_r($slides);echo"<br/><br/>^SLIDES<br/>vSPLIT<br/>";
unset($slides[0]);
//print_r($slides);echo"<br/><br/>";
//print_r($slides);echo "<br/><br/>";
//pour chaque slide decoupe en etapes
foreach ($slides as $slide)
{
    //recuperation du diapo
    $slide = explode("}}", $slide);
    //print_r($slide); echo"<br/><br/>";
    $diapo = str_replace("http://localhost/PhpProject_test/uploads/", "", $slide[0]);
    //echo "DIAPO : ".$diapo."<br/><br/>UNE ETAPE :<br/>";
    
    //decoupe en etapes
    $etapes = explode("[[", $slide[1]);
    unset($etapes[0]);
    //print_r($etapes); echo "<br/><br/>";
    foreach ($etapes as $etape)
    {
        $etape = explode("]]", $etape);
        $etape[] = $diapo;
        //print_r($etape);echo "<br/><br/>ALL en construction : <br/>";
        $lignes[] = $etape;
        //print_r($lignes);echo "<br/><br/>";
    }
    
    
}
echo "<br/>";
$url = print_r($lignes, true);
echo $url;

//si ce contenu existe      
        //getItem
        $emailOwner = $_SESSION['email'];
        $name = $_POST['name'];
        $contentDao = new ContentDAO(LocalDBClientBuilder::get());
        $contentDAOExist = $contentDao->get($name, $emailOwner);
        echo '<br/><br/>URL EXISTANTE :';
        //print_r($contentDAOExist);
        $contentExist = new Content();
        $contentExist = $contentDAOExist;
        $urlExist = $contentExist->getUrl();
        $typeExist = $contentExist->getType();
        $dateExistDebut = $_POST['dateDebut0'];
        $dateExistFin = $_POST['dateFin0'];
        echo '<br/><br/>';
        echo $urlExist;
        
        /*
         * MISE A JOUR
        $contentExist->setUrl($url);
        
        //alors le met a jour
                $contentDao->UpDate($content, $children);
                echo '<p>Ce contenu a été correctement mis à jour !</p><br/>';
         * 
         */