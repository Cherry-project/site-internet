<?php
// Désactiver le rapport d'erreurs
    error_reporting(0);
    session_start();
    
    if(count($_POST)==0)
        $_POST = $_SESSION['post'];
    else
        $_SESSION['post']= $_POST;
    //print_r($_SESSION);
    ?>
<html>
<head>
    <meta charset="utf8">
    <title>Ajout d'un excel de description de scénario</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script type='text/javascript' src='script.js'></script>
    <script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
    <?php 
        $root = "./";
        
        include 'head.php' ;
        require "includes.php";
    ?>

</head>

<body>
    <?php include 'nav.php' ;
    include 'includes.php';
    
    
    //print_r($_POST);
    //print_r($_POST['url_post']);
    //echo "<br/><br/>";
    //print_r($_POST['url']);
    
    $all = explode( "--- ", $_POST['url']);    
    $etape = array();
    for($i=1; $i< count($all); $i++)
    {
        $etape[] = $all[$i];
    }
    
    $br = $etape[0][14].$etape[0][15].$etape[0][16].$etape[0][17].$etape[0][18];
    
    $all2 = explode($br,$_POST['url'] );

    for($i=0; $i<count($all2); $i += 4)
    {
        $all2[$i] = str_replace("--- ", "", $all2[$i]);
        $all2[$i+1] = str_replace("Behave : ", "", $all2[$i+1]);
        $all2[$i+2] = str_replace("Text   : ", "", $all2[$i+2]);
        $all2[$i+3] = str_replace("Slide          : ", "", $all2[$i+3]);
    }
    
    //print_r($all2);echo "<br/><br/>";
    
    $datas = array();
    $sous_data = array();
    
    for($i=0; $i<count($all2); $i += 4)
    {
        if($all2[$i]!="")
        {
            $sous_data["num_etape"] = $all2[$i];
            $sous_data["Behave"] = $all2[$i+1];
            $sous_data["Text"] = $all2[$i+2];
            $sous_data["Slide"] = $all2[$i+3];
            
            //echo json_encode($sous_data);

            $datas[] = $sous_data;
        }
    }    
    $transfere = json_encode($datas);
    
   
    ?>
    <div class='container'>
        
    <?php
    
    
    //echo $string;
    $data = explode("___", $string); 
    //echo "<br/>DATA<br/>";
    //print_r($data);
    $gtran = str_replace("'", "&acute;", $transfere);
    //echo "<br/>DATA<br/>";
    //print_r($data);
   
        
    if(isset($_GET['json']))
    {
        make_curl_request("POST", "192.168.1.102:8080/jsonreader", $gtran );
    }
    ?>
        <div style="padding: 20px; margin: 10px 0 20px 120px;"><div style="background-color: limegreen; width: 180px; height: 40px; padding: 10px 0 0 0;"><a href='Scenario.php?json=true' style="color:white; margin: 0px 0px 0px 20px;"><span class="glyphicon glyphicon-play" style="margin-right: 6px;"></span>Jouer ce scénario </a></div></div>
        
    <?php    
   
    //affichage
    $tab_url = explode("---", $_POST["url"]);
    //print_r($tab_url);
    
    echo "<h1 style='margin-left: 25px'>Description du Scénario :</h1>";
    foreach ($tab_url as $une_etape)
    {
        $mvt_robot = "http://127.0.0.1:8080/test/behave?name=";
        if(strpos($une_etape, "question_behave")!== false)
        {
            $img = "img/questionne.png";
            $mvt = "question_behave";
        }
        else if(strpos($une_etape, "swap_behave")!== false)
        {
            $img = "img/raconte.png";
            $mvt = "swap_behave";
        }
        else if(strpos($une_etape, "point_arm_left_behave ")!== false)
        {
            $img = "img/designe.png";
            $mvt = "point_arm_left_behave";
        }
        else if(strpos($une_etape, "left_arm_up_behave")!== false)
        {
            $img = "img/explique.png";
            $mvt = "left_arm_up_behave";
        }
        else if(strpos($une_etape, "rest_open_behave ")!== false)
        {
            $img = "img/repos.png";
            $mvt = "rest_open_behave";
        }
        else if(strpos($une_etape, "head_idle_motion ")!== false)
        {
            $img = "img/head_idle_motion.png";
            $mvt = "head_idle_motion";
        }
        else if(strpos($une_etape, "double_me_behave ")!== false)
        {
            $img = "img/double_me_behave.png";
            $mvt = "double_me_behave";
        }
        else if(strpos($une_etape, "torso_idle_motion ")!== false)
        {
            $img = "img/torso_idle_motion.png";
            $mvt = "torso_idle_motion";
        }
        $mvt_robot.=$mvt;
        
        if($une_etape!=$tab_url[0])
            echo "<div class='col-sm-8'><p style='margin-left: 12px;margin-top: 15px;'>".$une_etape."</div><div class='col-sm-4'><a href='Scenario.php?demo=".$mvt."' onclick='LanceRobot(\"".$mvt."\")'><img  src='".$img."' style='height: 100px; margin-bottom: 15px;' /></a></div><br/><HR size=1 width ='80%' align=center><br/>";
    }
    
    //print_r($_POST['url']);
    echo '<div class="col-sm-8"><form class="formB" action="adultShowContents.php"><button type="submit" class="btn btn-danger" name="Valider" onclick style="margin: 0 0 20px 20px;" >Retour aux contenus</button></form>';
    echo '</div></p>';
    
    ?>
        
        </div>
    
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>  
    <script type="text/javascript">
       
        
        function LanceRobot(elemnt)
        {
            /*$.ajax({
                 url: "http://127.0.0.1:8080/test/behave?name=question_behave";
             });*/
        console.log(elemnt);
        $.ajax({
                 url: "http://127.0.0.1:8080/test/behave?name="+elemnt
                 
            });
             console.log("ok");
             
        }
        </script>

<footer class="footer">
            <div class="container-fluid">
                <img  height="60px" src="img/logo.jpg"/> 
            </div>
        </footer>
</html>
