<?php 
session_start();
?>
<!doctype html>
<html>
    
    <head>
        <meta charset="utf-8">
        <title>Drag n drop </title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

        <?php
        $root = '../';
        include $root.'includes.php';
        require_once('date.php');
        ?>
    </head>

    <body>
        <?php
        $date = new Date();
        $dates = $date->getAll();
        
        ?>
        <pre><?php $dates ?></pre>
    </body>
        
    <?php include $root.'footer.php' ?>
</html>





