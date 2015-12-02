<?php session_start() ?>
<!doctype html>
<html>
    
<head>
    <?php include 'head.php' ?>
    <title>Connection </title>
</head>

<body>
    <?php include 'nav.php' ?>
    <h1>Gestion de contenus pédagogiques</h1>
    
    
    <?php

    include "includes.php";
    
    $contentDao = new ContentDAO(DynamoDbClientBuilder::get());
    $childDao = new ChildDAO(DynamoDbClientBuilder::get());
    $email = $_SESSION('email');
    $child = $childDao->get($email);
    
    // Paramètre envoyé dans l'URL
    // parametre type, valeurs possibles : {teacher, family, doctor}
    $type = $_GET['type'];
    
    if($type == 'teacher') {
        $contents = $child->getTeachingContent();
    } else if ($type == 'family') {
        $contents = $child->getFamilyContent();
    } else if ($type == 'doctor') {
        $contents = $child->getMedicalContent();
    }
    
    $length = count($contents);
    
    echo '<ul>';
    for ($i = 0; $i < $length; $i++) {
        $contentInfo = $contents[$i];
        $name = $contentInfo['M']['name']['S'];
        $owner = $contentInfo['M']['owner']['S'];
        $date = $contentInfo['M']['date']['S'];
        $content = $contentDao->get($name, $owner);
        if ($content != null) {
            echo '<li>'. '<a href=downloadFile.php?name='.$name.'>'.$name.'</a>' .'</li>';
        }
    }
    echo '</ul>';
    ?>
    
    
    
    <?php include 'footer.php' ?>

</body>
</html>