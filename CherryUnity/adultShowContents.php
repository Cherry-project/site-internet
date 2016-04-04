<?php 
 // Désactiver le rapport d'erreurs
    error_reporting(0);
    session_start();
    ?>
<!doctype html>
<html>
    
<head>
    <?php include 'head.php' ?>
    <title>Content </title>
</head>

<body>
    <?php include 'nav.php' ?>
   <!-- <h1 style="margin-left: 27px;">Exécution d'un sc&eacute;nario</h1>
    <form class="formB" action="Scenario.php">
        <button type="submit" class="btn btn-primary" style="margin-bottom: 25px; margin-left:40px;">Choisir le scénario</button>
        <div class="dropdown" style="margin-bottom: 33px; margin-left:15px;">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Choisir un scénario&nbsp;
                <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li value="ListeEnfants"><a href="">Liste des Enfants&nbsp;</a></li>
            </ul>
          </div>
        
    </form>-->
    
    <h1 style="margin-left: 27px;">Gestion de contenus</h1>
    
    <div id='contenue' style='margin: 25px 0px 0px 27px'>
    <?php    
    $root = './';
    include "includes.php";
    
    $contentDao = new ContentDAO(DynamoDbClientBuilder::get());
    
    $name_fileToDelete = $_GET['name'];
    $owner_fileToDelete = $_GET['owner'];
    // DELETE File if needed
    if (!empty($name_fileToDelete) &&
        !empty($owner_fileToDelete)) {
        $s3 = new S3Access(S3ClientBuilder::get());
        $s3->deleteFile($name_fileToDelete);
        $contentDao->delete($name_fileToDelete, $owner_fileToDelete);
    }
    /*
    echo "<a href=\"./listOfChildren.php\">Calendriers des enfants</a></br></br>";
    echo "<a href=\"./drop.php\">Ajouter un fichier</a></br></br>";
    echo "<a href=\"./contenueTexte.php\">Créer un contenue texte</a></br></br>";
    */
    echo '<div style="margin-left:15px;">';
    echo '<form class="formB" action="listOfChildren.php"><button type="submit" class="btn btn-default" name="Valider" onclick >Calendriers des enfants</button></form>';
    echo '<form class="formB" action="drop.php"><button type="submit" class="btn btn-default" name="Valider" onclick >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ajouter un fichier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></form>';
    echo '<form class="formB" action="contenueTexte.php"><button type="submit" class="btn btn-default" name="Valider" onclick >Créer un contenu texte</button></form>';
    echo '<form class="formB" action="Excel.php"><button type="submit" class="btn btn-default" name="Valider" onclick >Ajouter un Excel de description d\'un scénario</button></form>';
    echo '</div>';
    
    $userDao = new UserDAO(DynamoDbClientBuilder::get());
    $email = $_SESSION['email'];
    $user = $userDao->get($email);
    
    $contents = $contentDao->getContentsOfUser($email);
    
    $length = count($contents);
    if($length<=1 && $length>0)
        echo '<div style="text-decoration: underline;margin-bottom: 10px; margin-top: 35px;">Voici le document que vous mettez à disposition :</div>';
    else if($length>0)
        echo '<div style="text-decoration: underline;margin-bottom: 10px; margin-top: 35px;">Voici les documents que vous mettez à disposition :</div>';
    
    
    $childDao = new ChildDAO(DynamoDbClientBuilder::get());
    $children = $childDao->getChildren($email);
    $list_children = array();
    $get="";
    foreach($children as $child)
    {
        $list_children[] = $child->getFirstname().'&nbsp;'.$child->getLastname();
        $get .= 'child[]='.$child->getFirstname().'___'.$child->getLastname().'&';
    }
    echo '<div class="dropdown" style="margin-bottom: 33px; margin-left:15px;">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" >Liste des Enfants&nbsp;
                <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li value="ListeEnfants"><a href="#">Liste des Enfants&nbsp;</a></li>
                <li class="divider"></li>';
    foreach ($list_children as $child)
    {
        echo '<li value="'.$child.'"><a href="#">'.$child.'&nbsp;</a></li>';
        //&nbsp;
    }
    echo '<li class="divider"></li>'
        . '<li value="'.$children.'"><a href="gestionEnfants.php?'.$get.'">Gérer les Enfants&nbsp;</a></li>';
    echo '</ul>
          </div></div>';
    
    
    for ($i = 0; $i < $length; $i++) {
        $content = $contents[$i];
        $name = $content->getName();
        $owner = $content->getEmailOwner();
        $url = $content->getUrl();
        $url_post = $url;
        if ($content != null) 
            {
                echo '<ul class="list_contents">';
                //si l'url ressemble a 52.49.63.136/...
                if($url[0]=='5')
                {
                    echo '<li>'
                        . $name
                        .' : '
                        . '&nbsp;&nbsp;&nbsp;<a href=downloadFile.php?name='.$name.'>Download</a>' 
                        . '&nbsp;&nbsp;&nbsp;<a href=adultShowContents.php?name='.$name.'&owner='.$owner.'>Supprimer</a></br>'
                        . '</li>';
                }
                else
                {
                    $valeurs = array();
                    $valeurs[] = $name;
                    $valeurs[] = $_SESSION['email'];
                    $valeurs[] = $url;
                    $valeurs[] = $_SESSION['type'];
                    $childDao = new ChildDAO(DynamoDbClientBuilder::get());
                    $children = $childDao->getChildren($email);
                    $index=0;
                    //print_r($children);
                    $compte=0;
                    foreach($children as $child)
                    {
                        $contentsChild = $child->getContentByType($_SESSION['type']);
                        //print_r($contentsChild);
                        foreach ($contentsChild as $leContent)
                        {
                            $nameDuContenue = $leContent['M']['name']['S'];
                            if($nameDuContenue == $name)
                                $index = $compte;
                        }    
                        $compte++;
                    }
                    $child_mail = $children[$index]->getEmail();
                    $valeurs[] = $child_mail;
                    $temp = $children[$index]->getContentByType($_SESSION['type']);
                    $index2 = 0;
                    $compte = 0;
                    foreach ($temp as $cont)
                    {
                        if($cont['M']['name']['S'] == $name)
                            $index2 = $compte;
                        $compte++;
                    }
                    $dateStart = $temp[$index2]['M']['dateStart']['S'];
                    $valeurs[] = $dateStart;
                    $dateEnd = $temp[$index2]['M']['dateEnd']['S'];
                    $valeurs[] = $dateEnd;
                    
                    //print_r($valeurs);
                    
                    //$valeur = serialize($valeurs);
                    echo '<li>'
                        . $name
                        .' : '
                        . '&nbsp;&nbsp;&nbsp;<a href=adultShowContents.php?name='.$name.'&owner='.$owner.'>Supprimer</a></br>'
                        . '<ul><div style="font-style: italic;">Période de diffusion : &nbsp;&nbsp;du '
                        . $dateStart
                        . '&nbsp;&nbsp;&nbsp;au&nbsp;&nbsp;&nbsp;'
                        .$dateEnd
                        .'<br/>Enfants ayant accès :<br/>';
                    $nbe = 0;
                    foreach($children as $child)
                    {
                        $contentsChild = $child->getContentByType($_SESSION['type']);
                        //print_r($contentsChild);
                        
                        
                        
                        foreach ($contentsChild as $leContent)
                        {
                            $nameDuContenue = $leContent['M']['name']['S'];
                            if($nameDuContenue == $name)
                            {
                                echo '<ul><li>'.$child->getFirstname().'&nbsp;'.$child->getLastname().'</li></ul>';
                                $nbe++;
                            }
                        } 
                    }
                    if($nbe== 0)
                            echo "<ul>Ce contenu n'est lié à aucun enfant !</ul>";
                    
                    //si l'url est un excel
                    $scenario="";;
                    if(($url[0]=='A'&&$url[1]=='r'&&$url[2]=='r'&&$url[3]=='a'&&$url[4]=='y')|| ($url[1]=='A'&&$url[2]=='r'&&$url[3]=='r'&&$url[4]=='a'&&$url[5]=='y') || ($url[2]=='A'&&$url[3]=='r'&&$url[4]=='r'&&$url[5]=='a'&&$url[6]=='y'))
                    {                        
                        //decoupe par info
                        $translate = explode("[",$url );
                        $translArray = array();
                                                          
                        //enleve l'index
                        foreach ($translate as $str)
                        {
                            
                            if($str[1]==']')
                            {
                                $str = substr ($str, 5);          
                                $translArray[] = $str;
                            }
                            else
                            {
                                $str = substr ($str, 6);
                                $translArray[] = $str;
                            }
                                 
                        }
                             
                        //enleve espace genant et "))"
                        $translArray[2] = substr($translArray[2], 0, -12);
                        $translArray[3] = substr($translArray[3], 0, -11);
                        $translArray[4] = substr($translArray[4], 0, -7);                             
                        $translArray[count($translArray)-1] = substr($translArray[count($translArray)-1], 0, -2);
                             
                        $etape = 1;
                        $url = "";
                        for($ligne = 2; $ligne < count($translArray) -4; $line+=4)
                        {
                            $url.= "    --- &Eacute;tape n° ".$etape." :<br/>";
                            $url.= $translArray[2]." : ".$translArray[$ligne+4]."<br/>";
                            $url.= $translArray[3]. ": ".$translArray[$ligne+1+4]."<br/>";
                            //enleve la ')' de fin
                            $pos = strpos($translArray[$ligne+2+4], ')');
                            if($pos!==FALSE)
                            {
                                $translArray[$ligne+2+4] = str_replace(')', '', $translArray[$ligne+2+4]);
                            }
                            
                            $url.= $translArray[4]. ": ".$translArray[$ligne+2+4]."<br/>";
                            $ligne += 4;
                            $etape++;
                        }
                        $scenario = '<form class="formB" action="Scenario.php" method="POST">'
                                . '<button type="submit" class="btn btn-success" name="Valider" onclick style="width: 180px;">'
                                . '<span class="glyphicon glyphicon-play" style="margin-right: 6px;"></span>'
                                . 'Jouer ce scénario&nbsp;&nbsp;</button>'
                                . '<input name="url_post" value="'.$url_post.'" hidden>'
                                . '<input name="url" value="'.$url.'" hidden>'
                                . '</form>';
                    }
                    else if(($url[0]== 'h'  &&  $url[1]== 't'  &&  $url[2]== 't'  &&  $url[3]== 'p'  &&  $url[4]== 's'  &&  $url[5]== ':'  &&  $url[6]== '/'  &&  $url[7]== '/'))
                    {
                        $url = "<a href='".$url."'>".$url."</a>";
                    }
                    
                    //si url est trop long, le coupe...
                    $tempo = "";
                    if(strlen($url) > 260)
                    {
                        $tempo = "<br/><button type='button' class='btn btn-info' data-toggle='collapse' data-target='#demo' style='width: 180px;'>"
                                . "<span class='glyphicon glyphicon-search' style='margin-right: 6px;'></span>";
                        for($u=0; $u<strlen($url); $u++)
                        {
                            if($u<=25)
                                $tempo .= $url[$u];
                        }
                        $tempo .= " ...</button><div id='demo' class='collapse'>".$url."</div>";//
                        $url = $tempo;
                    }
                    
                    echo'</div></ul><ul style="text-align:justify; margin-right:50px;"><p>'
                        .$url
                        .'<form class="formB" action="contenueTexte.php" method="POST">'
                        .'<input name="valeur[]" value="'.$name.'" hidden>'
                        .'<input name="valeur[]" value="'.$_SESSION['email'].'" hidden>'
                        .'<input name="valeur[]" value="'.$url_post.'" hidden>'
                        .'<input name="valeur[]" value="'.$_SESSION['type'].'" hidden>'
                        .'<input name="valeur[]" value="'.$child_mail.'" hidden>'
                        .'<input name="valeur[]" value="'.$dateStart.'" hidden>'
                        .'<input name="valeur[]" value="'.$dateEnd.'" hidden>'
                        .'<button type="submit" class="btn btn-default" name="Modifier" onclick style="width: 181px;"><span class="glyphicon glyphicon-edit" style="margin-right: 6px; "></span>Modifier ce contenu</button></form>'
                        .$scenario
                        .'<br/>'
                        .'</p></ul>'
                        .'</li></ul>';
                }
            }
    }
    if ($content != null) 
        echo '</ul>';
        
    //POUR 1 ENFANT
     $childDao = new ChildDAO(DynamoDbClientBuilder::get());
     $children = $childDao->getChildren($email);
     $index=0;
     $compteur = 0;
     foreach ($children as $child)
     {
         $nomEnfant = $child->getFirstname().'&nbsp;'.$child->getLastname();
         echo '<div id ="'.$nomEnfant.'&nbsp;" value="'.$nomEnfant.'" hidden>';
         $child_mail = $child->getEmail();
         $contentsEnfant = $child->getContentByType($_SESSION['type']);
         foreach ($contentsEnfant as $contentE)
            {
             //si le contenu enfant concerne la personne connectee
             if($contentE['M']['owner']['S'] == $_SESSION['email'])
             {
                 $url = "";
                 //trouve le contenu medecin ayant le meme nom pour recuperer l'url
                 foreach ($contents as $c)
                 {
                     if($c->getName() == $contentE['M']['name']['S'] )
                         $url = $c->getUrl();
                 }
                 
                 echo "<ul style='text-align:justify; margin-right:50px;'><li>"
                 .$contentE['M']['name']['S']
                 ." : "
                 ."&nbsp;&nbsp;&nbsp;<a href='adultShowContents.php?name=".$contentE['M']['name']['S']."&owner=".$contentE['M']['owner']['S']."'>Supprimer</a></br/>"
                 ."<ul><div style='font-style: italic;'>Période de diffusion : &nbsp;&nbsp;du "
                 .$contentE['M']['dateStart']['S']
                 ."&nbsp;&nbsp;&nbsp;au&nbsp;&nbsp;&nbsp;"
                 .$contentE['M']['dateEnd']['S']
                 ."</div>";
                 
                 $scenario="";;
                 if(($url[0]=='A'&&$url[1]=='r'&&$url[2]=='r'&&$url[3]=='a'&&$url[4]=='y')|| ($url[1]=='A'&&$url[2]=='r'&&$url[3]=='r'&&$url[4]=='a'&&$url[5]=='y') || ($url[2]=='A'&&$url[3]=='r'&&$url[4]=='r'&&$url[5]=='a'&&$url[6]=='y'))
                 {                        
                    //decoupe par info
                    $translate = explode("[",$url );
                    $translArray = array();
                                                          
                    //enleve l'index
                    foreach ($translate as $str)
                    {
                            
                        if($str[1]==']')
                        {
                            $str = substr ($str, 5);          
                            $translArray[] = $str;
                        }
                        else
                        {
                            $str = substr ($str, 6);
                            $translArray[] = $str;
                        }
                                 
                    }
                             
                    //enleve espace genant et "))"
                    $translArray[2] = substr($translArray[2], 0, -12);
                    $translArray[3] = substr($translArray[3], 0, -11);
                    $translArray[4] = substr($translArray[4], 0, -7);                             
                    $translArray[count($translArray)-1] = substr($translArray[count($translArray)-1], 0, -2);
                    
                    $etape = 1;
                    $url = "";
                    for($ligne = 2; $ligne < count($translArray) -4; $line+=4)
                    {
                        $url.= "    --- &Eacute;tape n° ".$etape." :<br/>";
                        $url.= $translArray[2]." : ".$translArray[$ligne+4]."<br/>";
                        $url.= $translArray[3]. ": ".$translArray[$ligne+1+4]."<br/>";
                        //enleve la ')' de fin
                        $pos = strpos($translArray[$ligne+2+4], ')');
                        if($pos!==FALSE)
                        {
                            $translArray[$ligne+2+4] = str_replace(')', '', $translArray[$ligne+2+4]);
                        }
                            
                        $url.= $translArray[4]. ": ".$translArray[$ligne+2+4]."<br/>";
                        $ligne += 4;
                        $etape++;
                    }
                    $scenario = '<form class="formB" action="Scenario.php" method="POST">'
                        . '<button type="submit" class="btn btn-success" name="Valider" onclick style="width: 180px;">'
                        . '<span class="glyphicon glyphicon-play" style="margin-right: 6px;"></span>'
                        . 'Jouer ce scénario&nbsp;&nbsp;</button>'
                        . '<input name="url_post" value="'.$url_post.'" hidden>'
                        . '<input name="url" value="'.$url.'" hidden>'
                        . '</form>';
                }
                else if(($url[0]== 'h'  &&  $url[1]== 't'  &&  $url[2]== 't'  &&  $url[3]== 'p'  &&  $url[4]== 's'  &&  $url[5]== ':'  &&  $url[6]== '/'  &&  $url[7]== '/'))
                {
                    $url = "<a href='".$url."'>".$url."</a>";
                }
                    
                //si url est trop long, le coupe...
                $tempo = "";
                if(strlen($url) > 260)
                {
                    $tempo = "<br/><button type='button' class='btn btn-info' data-toggle='collapse' data-target='#demo' style='width: 180px;'>"
                        . "<span class='glyphicon glyphicon-search' style='margin-right: 6px;'></span>";
                    for($u=0; $u<strlen($url); $u++)
                    {
                        if($u<=25)
                            $tempo .= $url[$u];
                    }
                    $tempo .= " ...</button><div id='demo' class='collapse'>".$url."</div>";//
                    $url = $tempo;
                }
                    
                         
                 echo $url
                 ."<p><form class='formB' action='contenueTexte.php' method='POST'>"
                 ."<input name='valeur[]' value='".$contentE['M']['name']['S']."' hidden>"
                 ."<input name='valeur[]' value='".$_SESSION['email']."' hidden>"
                 ."<input name='valeur[]' value='".$url_post."' hidden>"
                 ."<input name='valeur[]' value='".$_SESSION['type']."' hidden>"
                 ."<input name='valeur[]' value='".$child_mail."' hidden>"
                 ."<input name='valeur[]' value='".$contentE['M']['dateStart']['S']."' hidden>"
                 ."<input name='valeur[]' value='".$contentE['M']['dateEnd']['S']."' hidden>"
                 ."<button type='submit' class='btn btn-default' name='Modifier' onclick '>Modifier ce contenue</button></form><br/>"
                 ."</p>"
                 ."</ul></li></ul>";
                 
             }
           }
         echo '</div>';
         
         //echo "<div id ='".$nomEnfant."_' hidden>TEST + id = ".$nomEnfant."</div> ";
     }
          
     ?>
    </div>
    
    <?php include 'footer.php' ?>

     <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript">
         $(".dropdown-menu li a").click(function(){
            $(".dropdown-toggle:first-child").html($(this).text()+' <span class="caret"></span>');
            //console.log($(".dropdown-toggle:first-child").html($(this).text()+' <span class="caret"></span>').text());
            
            var nomEnfant = "#"+$(".dropdown-toggle:first-child").html($(this).text()+' <span class="caret"></span>').text();
            nomEnfant = nomEnfant.toString();
            //console.log(nomEnfant);
            var choice = document.getElementsByClassName("dropdown-menu");
            var i;
            for (i = 0; i < choice.length; i++) 
            {
                var listEnfant;
                for (var member in choice[i]){
                    if(member == "innerText")
                        listEnfant = choice[i][member]
                }
                   
                listEnfant = listEnfant.split(listEnfant[18]);
                //console.log(listEnfant);        
                
                for(var e in listEnfant)
                {
                    //console.log(listEnfant[e]);   
                    if(e!= 0 && listEnfant[e] != "")
                    {
                        var id = listEnfant[e].toString();
                        id = "#"+id;
                        //console.log(id);
                        $(id).hide();                        
                    }
                }
            }   
            
            
            if($(".dropdown-toggle:first-child").html($(this).text()+' <span class="caret"></span>').text() != "Liste des Enfants  ")
            {
               $(".list_contents").hide();
               $(nomEnfant).show();
            }
            else
            {
                $(".list_contents").show();
            }
          });

    </script>
</body>
</html>