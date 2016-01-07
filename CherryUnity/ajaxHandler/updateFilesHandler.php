<?php
session_start();

$root = '../';
include $root.'includes.php';


$childDao = new ChildDAO(DynamoDbClientBuilder::get());

$email = $_POST['childEmail'];
$child = $childDao->get($email);
$fileName = $_POST['file'];
$adultEmail = $_POST['adultEmail'];
$type = $_POST['type'];

if(!empty($_POST['dateEnd'])){
    $dateEnd = $_POST['dateEnd'];
    $dateStart = $_POST['dateStart'];
    echo $dateEnd . '  ' .$dateStart;
    addFile($fileName, $child, $dateStart, $dateEnd, $type, $adultEmail);
}

else
deleteFile($child, $type,$adultEmail,$fileName);
//echo $child->getTeacherId();
echo $type. $adultEmail . $fileName ; 


function addFile($fileName,$child,$dateStart, $dateEnd,$type,$adultEmail){
    $content = new $Content();
    $content.setName($fileName);
    $content.setEmailOwner($adultEmail);
    $content.setType($type);
    $child->addContent($content, $dateStart, $dateEnd);
}



function deleteFile($child,$type,$adultEmail,$fileName){
    $child->deleteContent($fileName, $adultEmail, $type);
    
}



?>



