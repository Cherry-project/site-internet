<?php
error_reporting(0);
    session_start();
    
//print_r($_POST);

?>
<html>
<head>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gérer les Enfants</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script type='text/javascript' src='script.js'></script>
    <script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="sortable/bootstrap-table.css">
    <script src="sortable/bootstrap-table.js"></script>
    <script src="sortable/ga.js"></script>
    
    <?php 
        $root = "./";
        
        include 'head.php' ;
        require "includes.php";
    ?>

</head>

<body>
    <?php include 'nav.php' ;
        include 'includes.php';
    
        $les_enfants = $_POST['enfant'];
        
     ?>
    
    <div class="container">
        <h1>Gérer des groupes d'enfants</h1>  
        <div class='row'>
            <div class="col-sm-3" style="background-color: lightblue; margin: 1px;">
                <h3 style="text-align: center;">Groupe 1</h3>
            </div>
            <div class="col-sm-3" style="background-color: navajowhite; margin: 1px;">
                <h3  style="text-align: center;">Groupe 2</h3>
            </div>
            <div class="col-sm-3" style="background-color: lightblue; margin: 1px;">
                <h3  style="text-align: center;">Groupe 3</h3>
            </div>
            <div class="col-sm-3" style="background-color: navajowhite; margin: 1px;">
                <h3  style="text-align: center;">Groupe 4</h3>
            </div>
            <div class="col-sm-3" style="background-color: lightblue; margin: 1px;">
                <h3  style="text-align: center;">Groupe 5</h3>
            </div>
        </div>
        <h1>Liste des enfants non groupés</h1>
        <table class="table table-hover sortable"  data-toggle="table"
               data-height="460"
               data-url="sortable/data1.json"
               data-sort-name="price"
               data-sort-order="desc">
          <thead>
            <tr>
              <th data-field="name" data-sortable="true">Nom</th>
              <th>Prénom</th>
              <th>Modification</th>
            </tr>
          </thead>
          <tbody>
            <?php
                $nbr_enf = 0;
                 foreach ($les_enfants as $nom_pre)
                 {
                     $nbr_enf++;
                    $tab_nom_pre = explode('___', $nom_pre);
                    
                    //recherche les infos de l'enfant
                    $childDao = new ChildDAO(DynamoDbClientBuilder::get());
                    $children = $childDao->getALLChildren();                           
                    foreach($children as $child)
                    {
                        if(strpos($tab_nom_pre[0], $child->getFirstname()) !==false)
                        {
                            if(strpos($tab_nom_pre[1], $child->getLastname()) !==false)
                            {
                                $theChild = $child;
                            }
                        }
                    }
                    
                    echo "<tr>
                    <td>".$tab_nom_pre[0]."</td>
                    <td>".$tab_nom_pre[1]."</td>
                    <td>
                    <form class='formB' action='gestionEnfants.php' method='POST' onsubmit='return m_verif_champs();'>
                    <button type='button' class='btn btn-primary' data-toggle='collapse' data-target='#demo2".$nbr_enf."'>
                        <span class='glyphicon glyphicon-pencil' style='margin-right: 10px;'></span>Modifier</button>
                    <div id='demo2".$nbr_enf."' class='collapse' style=' background-color: gainsboro; padding: 10px; margin-bottom: 10px;'>
                        <input name='mail_modif' value='".$theChild->getEmail()."' hidden>
                        <input name='MAJ' value='MAJ' hidden>
                        <label for='nom'>Nom de l'enfant :</label>
                        <input name='nom' class='form-control' id='m_nom' value='".$tab_nom_pre[0]."'>
                        <label for='prenom'>Prénom de l'enfant :</label>
                        <input name='prenom' class='form-control' id='m_prenom' value='".$tab_nom_pre[1]."'>
                        <label for='mail'>E-mail de l'enfant :</label>
                        <input name='mail' class='form-control' id='m_mail' value='".$theChild->getEmail()."'>
                        <label for='password'>Mot de passe de l'enfant :</label>
                        <input name='password' type='password' class='form-control' id='m_password' value='".$theChild->getPassword()."'>
                        <label for='repassword'>Confirmer le mot de passe de l'enfant :</label>
                        <input name='repassword' type='password' class='form-control' id='m_repassword' value='".$theChild->getPassword()."'>
                        <br/><br/>
                        <button type='submit' class='btn btn-success' name='Enregistrer' value='Enregistrer' onclick ><span class='glyphicon glyphicon-floppy-saved' style='margin-right: 7px;'></span>Enregistrer</button>
                    </div>
                    <button type='submit' class='btn btn-danger' name='Supp' value='Supp' onclick ><span class='glyphicon glyphicon-remove'  style='margin-right: 7px;'></span>Supprimer</button> 
                    </form></td>
                    </tr>";
                 }
            
            ?>
          </tbody>
        </table>
      </div>


    
</body>

<footer class="footer">
            <div class="container-fluid">
                <img  height="60px" src="img/logo.jpg"/> 
            </div>
        </footer>

<script type="text/javascript">
         $(".dropdown-menu li a").click(function(){
            $(".dropdown-toggle:first-child").html($(this).text()+' <span class="caret"></span>');
        });
        
        $(document).ready(function() {
            $("ul li a").click(function() {
                text = $(".dropdown-toggle:first-child").html($(this).text()+' <span class="caret"></span>').text();
                $("input[name='enfantExistant']").val(text);
                $(this).parents('.dropdown').find('.dropdown-toggle').html(text+' <span class="caret"></span>');
                
            });
        });
        
        
        function verif_champs(){
            //fonction javascript qui va verifier successivement tous les champs et si pas rempli mesage d'alert et empèche le fomrulaire d'être envoyé
                    //pour les listes déroulantes dont le choix est obligatoire:
            //type client
            var nom=document.getElementById('nom'); //on atteint l'element par son id
            if(nom.value==""){
                    //si value = vide qui correspond à "Choisissez dans la liste déroulante"
                    alert ('L\'enfant doit posséder un nom pour être ajouté à votre liste  !');
                    return false; //on sort de la fonction et on empeche l'envoi du formulaire
            }
            
            var prenom=document.getElementById('prenom'); //on atteint l'element par son id
            if(prenom.value==""){
                    //si value = vide qui correspond à "Choisissez dans la liste déroulante"
                    alert ('L\'enfant doit posséder un prénom pour être ajouté à votre liste  !');
                    return false; //on sort de la fonction et on empeche l'envoi du formulaire
            }
            
            var mail=document.getElementById('mail'); //on atteint l'element par son id
            if(mail.value==""){
                    //si value = vide qui correspond à "Choisissez dans la liste déroulante"
                    alert ('L\'enfant doit posséder un e-mail pour être ajouté à votre liste  !');
                    return false; //on sort de la fonction et on empeche l'envoi du formulaire
            }
            
            var password=document.getElementById('password'); //on atteint l'element par son id
            if(password.value==""){
                    //si value = vide qui correspond à "Choisissez dans la liste déroulante"
                    alert ('L\'enfant doit posséder un mot de passe pour être ajouté à votre liste  !');
                    return false; //on sort de la fonction et on empeche l'envoi du formulaire
            }
            
            var repassword=document.getElementById('repassword'); //on atteint l'element par son id
            if(repassword.value!=password.value){
                    //si value = vide qui correspond à "Choisissez dans la liste déroulante"
                    alert ('Le mot de passe de l\'enfant doit être identique dans les 2 champs "Mot de passe" et "Confirmer le mot de passe" !');
                    return false; //on sort de la fonction et on empeche l'envoi du formulaire
            }
            
            var teacher=document.getElementById('teacher'); //on atteint l'element par son id
            if(teacher)
            {
                if(teacher.value==""){
                        //si value = vide qui correspond à "Choisissez dans la liste déroulante"
                        alert ('L\'enfant doit être lié à l\'e-mail d\'un professeur pour être ajouté à votre liste  !');
                        return false; //on sort de la fonction et on empeche l'envoi du formulaire
                }
            }
            
            var family=document.getElementById('family'); //on atteint l'element par son id
            if(family)
            {
                if(family.value==""){
                        //si value = vide qui correspond à "Choisissez dans la liste déroulante"
                        alert ('L\'enfant doit être lié à l\'e-mail d\'un membre de sa famille pour être ajouté à votre liste  !');
                        return false; //on sort de la fonction et on empeche l'envoi du formulaire
                }
            }
            
            var doctor=document.getElementById('doctor'); //on atteint l'element par son id
            if(doctor)
            {
                if(doctor.value==""){
                        //si value = vide qui correspond à "Choisissez dans la liste déroulante"
                        alert ('L\'enfant doit être lié à l\'e-mail d\'un médecin pour être ajouté à votre liste  !');
                        return false; //on sort de la fonction et on empeche l'envoi du formulaire
                }
            }
            
            //et si on est arrivé la c'est que tout est ok donc
            return true; 
        }
        
        function m_verif_champs(){
            //fonction javascript qui va verifier successivement tous les champs et si pas rempli mesage d'alert et empèche le fomrulaire d'être envoyé
                    //pour les listes déroulantes dont le choix est obligatoire:
            //type client
            var nom=document.getElementById('m_nom'); //on atteint l'element par son id
            if(nom.value==""){
                    //si value = vide qui correspond à "Choisissez dans la liste déroulante"
                    alert ('L\'enfant doit posséder un nom pour être ajouté à votre liste  !');
                    return false; //on sort de la fonction et on empeche l'envoi du formulaire
            }
            
            var prenom=document.getElementById('m_prenom'); //on atteint l'element par son id
            if(prenom.value==""){
                    //si value = vide qui correspond à "Choisissez dans la liste déroulante"
                    alert ('L\'enfant doit posséder un prénom pour être ajouté à votre liste  !');
                    return false; //on sort de la fonction et on empeche l'envoi du formulaire
            }
            
            var mail=document.getElementById('m_mail'); //on atteint l'element par son id
            if(mail.value==""){
                    //si value = vide qui correspond à "Choisissez dans la liste déroulante"
                    alert ('L\'enfant doit posséder un e-mail pour être ajouté à votre liste  !');
                    return false; //on sort de la fonction et on empeche l'envoi du formulaire
            }
            
            var password=document.getElementById('m_password'); //on atteint l'element par son id
            if(password.value==""){
                    //si value = vide qui correspond à "Choisissez dans la liste déroulante"
                    alert ('L\'enfant doit posséder un mot de passe pour être ajouté à votre liste  !');
                    return false; //on sort de la fonction et on empeche l'envoi du formulaire
            }
            
            var repassword=document.getElementById('m_repassword'); //on atteint l'element par son id
            if(repassword.value!=password.value){
                    //si value = vide qui correspond à "Choisissez dans la liste déroulante"
                    alert ('Le mot de passe de l\'enfant doit être identique dans les 2 champs "Mot de passe" et "Confirmer le mot de passe" !');
                    return false; //on sort de la fonction et on empeche l'envoi du formulaire
            }
            
            //et si on est arrivé la c'est que tout est ok donc
            return true; 
        }
        
</script>

</html>

