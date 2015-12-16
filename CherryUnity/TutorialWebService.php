<?php
$root = "./";
include 'includes.php'; 


$Adao = new AchievementsDAO(DynamoDbClientBuilder::get());
if(!empty($_GET['email'])){
$email = $_GET['email'];
if(empty($_GET['tuto'])){
$tuto = $Adao->getTutorial($email);
header('Content-Type: application/json');
$response = json_encode([$tuto]);
echo $response;
}
else{
    $tuto = $_GET['tuto'];
    $Adao->updateTutorial($email, $value);
}
}
?>

