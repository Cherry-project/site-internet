<?php
// Désactiver le rapport d'erreurs
    error_reporting(0);
    session_start();
    
    ?>

<html>
<head>
    <meta charset="utf8">
    <title>Ajout d'un excel de description de scénario</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <?php 
        $root = "./";
        
        include 'head.php' ;
        require "includes.php";
    ?>

</head>

<body>
    <?php include 'nav.php' ;
    include 'includes.php';
    
    
    //test dropdown :
                
                                                                 
                                 
                                 echo '<div class="dropdown">
                                     <input type="hidden" name="Behave[]" class="Behave">
                                     comportement : 
                                    <button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown" style="margin-left: 19px;">comportement 1                                    
                                    <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                      <li ><a href="#" name="swap_behave" style="height: 110px; line-height: 100px;">swap_behave&nbsp;<img  src="img/raconte.png" style="height: 100px; float: right;" /></a></li>
                                      <li ><a href="#" name="question_behave" style="height: 110px; line-height: 100px;">question_behave&nbsp;<img  src="img/questionne.png" style="height: 100px; float: right;" /></a></li>
                                      
                                      <li ><a href="#" name="left_arm_up_behave" style="height: 110px; line-height: 100px;">left_arm_up_behave&nbsp;<img  src="img/explique.png" style="height: 100px; float: right;" /></a></li><li ><a href="#" name="rest_open_behave" style="height: 110px; line-height: 100px;">rest_open_behave&nbsp;<img  src="img/repos.png" style="height: 100px; float: right;" /></a></li>
                                                                           
                                    </ul>
                                    <img  class="img_associee" src="img/raconte.png" style="height: 100px; margin-left: 40px;" />
                                  </div><br/>';
                                 
                                 
    
    
                                    
    
?>
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>  
    <script src="js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
        
        $(document).ready(function() {
            $("ul li a").click(function() {
                text = $(this).parent('.dropdown-toggle').html($(this).text()+' <span class="caret"></span>').text();
                
                text2 = $(this).parents('.dropdown').find('.dropdown-toggle').html($(this).text()+' <span class="caret"></span>').text();
                $(this).parents(".dropdown").find('.Behave').val(text2);
                
                if(text2.indexOf('.PNG')>-1)
                {
                    console.log("c'est un diapo !");console.log(text2.indexOf('.PNG'));
                    $(this).parents(".dropdown").find('.Slide').val(text2);
                }
                else
                {
                    console.log("ce n'est pas un diapo :D");
                    //changer l'image ici !!!
                }
                if($(this).parents(".dropdown").find('.img_associee')){console.log( $(this).parents(".dropdown").find('.img_associee'));}
                $(this).parents(".dropdown").find('.img_associee').attr('src', 'img/raconte.png');
                $(this).parents('.dropdown').find('.dropdown-toggle').html($(this).text()+' <span class="caret"></span>');
                $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
                
            });
        });

        $(".dropdown-menu li a").click(function(){
            //$(this+":first-child").html($(this).text()+' <span class="caret"></span>');
            $(this).parent('.dropdown-toggle').html($(this).text()+' <span class="caret"></span>');
        });
        
       $(document).ready(function(){
            $(".dropdown-toggle").dropdown();
        });
    </script>
    
    <script>
	$(document).ready(function(e) {
        $(".dropdown-menu > li > a").on("click", function(){
			var image = $(this).children('img').attr('src');
			
			$(this).parents('.dropdown').children('img.img_associee').attr('src', image);
		});
    });
</script>
</body>
<footer class="footer">
            <div class="container-fluid">
                <img  height="60px" src="img/logo.jpg"/> 
            </div>
        </footer>
</html>
