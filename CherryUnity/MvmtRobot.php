<?php 
 // Désactiver le rapport d'erreurs
    error_reporting(0);
    session_start();
    ?>
<!doctype html>
<html>
    <head>  
        <meta charset="utf8">
        <title>Biblio' de mouvements</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <!--<script type='text/javascript' src='script.js'></script>-->
    </head>

<body>
    <?php include 'nav.php';
     $root = "./";
        
        include 'head.php' ;
        include 'includes.php';
        
        $mvt_robot = "http://".$ip.":8080/test/behave?name=";
    ?>
    
    <div class="container">
        <h1 style="margin-left: 27px; margin-bottom: 20px;">Bibliothèque de mouvement du Robot</h1>
        <div class="jumbotron" style="height: 280px;">
            <div class="col-sm-2">
                <p style="text-align: center;"><img  height="60px" src="img/cherry.png" style="text-align: center; height: 150px;"/> </p></div> <div class="col-sm-1"></div><div class="col-sm-8">
        <p>&nbsp;</p>
        <p class="text-muted" style="text-align: justify; color: white;">Ici vous pouvez voir tous les mouvements que le robot peut exécuter.</p>
        <p class="text-muted" style="text-align: justify; color: white;">En cliquant sur un pictogramme correspondant à un mouvement, vous pouvez visualiser ce même mouvement sur le robot.</p></div>
        </div>
       <?php
       //question_behave
        $img = "img/question_behave.png";
        $mvt = "question_behave";
        echo "<div class='col-sm-2'><a href='MvmtRobot.php' onclick='LanceRobot(\"".$mvt."\")'><img  src='".$img."' style='height: 100px; margin-bottom: 15px;' /></a></div>";
        //swap_behave
        $img = "img/swap_behave.png";
        $mvt = "swap_behave";
        echo "<div class='col-sm-2'><a href='MvmtRobot.php' onclick='LanceRobot(\"".$mvt."\")'><img  src='".$img."' style='height: 100px; margin-bottom: 15px;' /></a></div>";
        //point_arm_left_behave
        $img = "img/point_arm_left_behave.gif";
        $mvt = "point_arm_left_behave";
        echo "<div class='col-sm-2'><a href='MvmtRobot.php' onclick='LanceRobot(\"".$mvt."\")'><img  src='".$img."' style='height: 100px; margin-bottom: 15px;' /></a></div>";
        //left_arm_up_behave
        $img = "img/left_arm_up_behave.png";
        $mvt = "left_arm_up_behave";
        echo "<div class='col-sm-2'><a href='MvmtRobot.php' onclick='LanceRobot(\"".$mvt."\")'><img  src='".$img."' style='height: 100px; margin-bottom: 15px;' /></a></div>";
        //rest_open_behave
        $img = "img/rest_open_behave.png";
        $mvt = "rest_open_behave";
        echo "<div class='col-sm-2'><a href='MvmtRobot.php' onclick='LanceRobot(\"".$mvt."\")'><img  src='".$img."' style='height: 100px; margin-bottom: 15px;' /></a></div>";
        //head_idle_motion
        $img = "img/head_idle_motion.png";
        $mvt = "head_idle_motion";
        echo "<div class='col-sm-2'><a href='MvmtRobot.php' onclick='LanceRobot(\"".$mvt."\")'><img  src='".$img."' style='height: 100px; margin-bottom: 15px;' /></a></div>";
        //double_me_behave
        $img = "img/double_me_behave.png";
        $mvt = "double_me_behave";
        echo "<div class='col-sm-2'><a href='MvmtRobot.php' onclick='LanceRobot(\"".$mvt."\")'><img  src='".$img."' style='height: 100px; margin-bottom: 15px;' /></a></div>";
        //torso_idle_motion
        $img = "img/torso_idle_motion.png";
        $mvt = "torso_idle_motion";
        echo "<div class='col-sm-2'><a href='MvmtRobot.php' onclick='LanceRobot(\"".$mvt."\")'><img  src='".$img."' style='height: 100px; margin-bottom: 15px;' /></a></div>";
       
       ?>
    
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>  
    <script type="text/javascript">
       
        
        function LanceRobot(elemnt)
        {
            /*$.ajax({
                 url: "http://127.0.0.1:8080/test/behave?name=question_behave";
             });*/
        console.log(elemnt);
        $.ajax({
                 url: "http://"+<?php echo '"'.$ip.'"'; ?>+":8080/test/behave?name="+elemnt
                 
            });
             console.log("ok : "+"http://"+<?php echo '"'.$ip.'"'; ?>+":8080/test/behave?name="+elemnt);
             
        }
        </script>
    
    <?php include 'footer.php' ?>

   </body>
</html>