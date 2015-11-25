<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf8">
    <title> Bonjour </title>
    <?php include '../includes.php'; ?>
</head>

<body>
<?php
    echo 'File handler</br>';

    //get the children from the request
     $children =  array();
     for($i=0;$i<count($_POST['children']);$i++)
     $children[] = $_POST['children'][$i];
    
    //print_r($_FILES['files']); 

    //echo 'Bonjour  ' . $_FILES['files']['tmp_name'][1];
    //  is_uploaded_file($_FILES['files']['tmp_name'][1]);
    //echo "Affichage du contenu\n";

     $size = count($_FILES['files']['tmp_name']);
     
     for($i=1;$i<$size;$i++){//Iterate over the files(start 1)
     
    // UPLOAD SUR EC2
    $path = "/var/www/html/";
    $name = $_FILES['files']['name'][$i];
    $path = $path.$name;
    echo move_uploaded_file($_FILES['files']['tmp_name'][$i], $path);
    echo 'name = '.$name.'</br>';
    echo 'path = '.$path.'</br>';
    echo 'fin EC2</br>';
    
    // UPLOAD SUR S3
    $s3 = new S3Access(S3ClientBuilder::get());
    $url = $s3->createFile($name, $path);
    echo 'fin S3 url = '.$url.'</br>';
    
    // INSERT SUR DYNAMO
    $contentDao = new ContentDAO(DynamoDbClientBuilder::get());
    $content = new Content();
    $content->setEmailOwner("nicolas@enseirb.fr");
    $content->setName($name);
    $content->setType("teaching");
    $content->setUrl($url);
   /* $children = array (
        array ("child1@gmail.com", "2016-02-12")
    );*/
    $contentDao->create($content, $children);
    echo 'fin Dynamo</br>';
    }
    ?>
</body>
</html>
