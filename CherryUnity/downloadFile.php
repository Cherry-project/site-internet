<?php
    
    include "includes.php";

    $name = $_GET['name'];

    $s3 = new S3Access(S3ClientBuilder::get());
    $result = $s3->getFile($name);
    header("Content-Type: {$result['ContentType']}");
    header("Content-Disposition: attachment; filename=\"$name\"");
    echo $result['Body'];
    