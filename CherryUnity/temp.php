<?php

    include "includes.php";
    
    $contentDao = new ContentDAO(DynamoDbClientBuilder::get());
    $childDao = new ChildDAO(DynamoDbClientBuilder::get());
    $child = $childDao->get("child1@gmail.com");
    
    $teachingContent = $child->getTeachingContent();
    $length = count($teachingContent);
    
    echo '<ul>';
    for ($i = 0; $i < 1 /*$length*/; $i++) {
        //pour l'instant on ne récupère que les teachingContent
        $contentInfo = $teachingContent[$i];
        $name = $contentInfo['M']['name']['S'];
        $owner = $contentInfo['M']['owner']['S'];
        $date = $contentInfo['M']['date']['S'];
        $content = $contentDao->get($name, $owner);
        if ($content != null) {
            echo '<li>'. '<a href=downloadFile.php?name='.$name.'>'.$name.'</a>' .'</li>';
        }
    }
    echo '</ul>';