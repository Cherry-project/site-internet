<?php 
session_start();
?>
<!doctype html>
<html>
    
    <head>
        <title>Calendar</title>
        
        <?php
        $root = '../';
        include $root.'head.php';
        include $root.'includes.php';
        require_once('date.php');
        ?>
        
    </head>

    <body>
    
        <?php include $root.'nav.php' ?>
        
        <?php
        $date = new Date();
        $dates = $date->getAll();
        
        ?>
        
        <pre><?php $dates ?></pre>
    
    </body>
        
    <?php include $root.'footer.php' ?>
    
</html>
