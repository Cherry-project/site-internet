<!DOCTYPE HTML>
<html>
 <head>
<meta charset="utf8">
<title> Bonjour </title>
<body>




<?php 
//print_r($_FILES['files']); 

//echo 'Bonjour  ' . $_FILES['files']['tmp_name'][1];
//  is_uploaded_file($_FILES['files']['tmp_name'][1]);
//echo "Affichage du contenu\n";
$name = $_FILES['files']['name'][1];
echo move_uploaded_file($_FILES['files']['tmp_name'][1],"/var/www/html/".$name);

?>

</body>
</html>

