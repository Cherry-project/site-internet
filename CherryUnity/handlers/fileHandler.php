<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf8">
    <title>Upload</title>
    <?php 
        session_start();
        $root = "../";
        require "../includes.php";
    ?>
</head>

<body>
<?php
    //get the children from the request

    $children =  array();
    $length = count($_POST['children']);
    for($i = 0; $i < $length; $i++) {
        $string = $_POST['children'][$i];
        print 'DEBUG>> : $string vaut '.$string;
        $email = split(",", $string)[0];
        print 'DEBUG>> : $email vaut '.$email;
        $date = split(",", $string)[1];
        print 'DEBUG>> : $date vaut '.$date;
        $children[] = array('email' => $email, 'date' => $date);
        //$children[] = array('email' => "enfant@gmail.com", 'date' => "01/01/1901");
    }

    $size = count($_FILES['files']['tmp_name']);
    
    for($i = 1; $i < $size; $i++){//Iterate over the files(start 1)
        // UPLOAD SUR EC2
        $path = "/var/www/html/";
        $name = $_FILES['files']['name'][$i];
        $path = $path.$name;
        echo move_uploaded_file($_FILES['files']['tmp_name'][$i], $path);

        // UPLOAD SUR S3
        $s3 = new S3Access(S3ClientBuilder::get());
        $url = $s3->createFile($name, $path);
        
        // INSERT SUR DYNAMO
        $emailOwner = $_SESSION['email'];
        $type = $_SESSION['type'];
        $contentDao = new ContentDAO(DynamoDbClientBuilder::get());
        $content = new Content();
        $content->setUrl($url);
        $content->setEmailOwner($emailOwner);
        $content->setName($name);
        $content->setType($type);
        $contentDao->create($content, $children);
    }
    
    ?>
</body>
</html>
