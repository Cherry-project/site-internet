<?php

    include "includes.php";
    
    $contentDao = new ContentDAO(DynamoDbClientBuilder::get());
    $childDao = new ChildDAO(DynamoDbClientBuilder::get());
    $child = $childDao->get("child1@gmail.com");
    
    $teachingContent = $child->getTeachingContent();
    $length = count($teachingContent);
    
    echo '<ul>';
    for ($i = 0; $i < $length; $i++) {
        //pour l'instant on ne récupère que les teachingContent
        $contentInfo = $teachingContent[$i];
        $name = $contentInfo['M']['name']['S'];
        $owner = $contentInfo['M']['owner']['S'];
        $date = $contentInfo['M']['date']['S'];
        $content = $contentDao->get($name, $owner);
        $url = $content->getUrl();
        echo '<li>'. '<a href='.$url.'>'.$name.'</a>' .'</li>';
    }
    echo '</ul>';