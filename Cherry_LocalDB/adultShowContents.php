<?php
// Désactiver le rapport d'erreurs
error_reporting(0);
session_start() ?>
<!doctype html>
<html>
    
<head>
    <?php include 'head.php' ?>
    <title>Content </title>
</head>

<body>
    <?php include 'nav.php' ?>
    <h1>Gestion de contenus</h1>
    
    <?php    
    $root = './';
    include "includes.php";
    
    $contentDao = new ContentDAO(LocalDBClientBuilder::get());//DynamoDbClientBuilder::get());
    
    $name_fileToDelete = $_GET['name'];
    $owner_fileToDelete = $_GET['owner'];
    // DELETE File if needed
    if (!empty($name_fileToDelete) &&
        !empty($owner_fileToDelete)) {
        $s3 = new S3Access(S3ClientBuilder::get());
        $s3->deleteFile($name_fileToDelete);
        $contentDao->delete($name_fileToDelete, $owner_fileToDelete);
    }
    
    echo "<a href=\"./listOfChildren.php\">Calendriers des enfants</a></br>";
    echo "<a href=\"./drop.php\">Ajouter un fichier</a>";
    
    $userDao = new UserDAO(LocalDBClientBuilder::get());//DynamoDbClientBuilder::get());
    $email = $_SESSION['email'];
    $user = $userDao->get($email);
    
    $contents = $contentDao->getContentsOfUser($email);
    
    $length = count($contents);
    
    echo '<ul>';
    for ($i = 0; $i < $length; $i++) {
        $content = $contents[$i];
        $name = $content->getName();
        $owner = $content->getEmailOwner();
        if ($content != null) {
            echo '<li>'
                . $name
                . ' - <a href=downloadFile.php?name='.$name.'>Download</a>' 
                . ' - <a href=adultShowContents.php?name='.$name.'&owner='.$owner.'>Delete</a>' 
                . '</li>';
        }
    }
    echo '</ul>';
        
    ?>
    
    <?php include 'footer.php' ?>

</body>
</html>