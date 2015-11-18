<?php

    include "includes.php";

    echo 'temp.php</br>';
    
    // INSERT SUR DYNAMO
    $contentDao = new ContentDAO(DynamoDbClientBuilder::get());
    $content = new Content();
    $content->setEmailOwner("nicolas@enseirb.fr");
    $content->setName("tutu.txt");
    $content->setType("teaching");
    $content->setUrl("urlblabla");
    $children = array (
        array ('email' => 'child1@gmail.com', 'date' => '2016-02-12')
    );
    echo $children[0]['email'];
    echo 'avant create</br>';
    $contentDao->create($content, $children);
    echo 'fin Dynamo</br>';
    