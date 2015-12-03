<?php
session_start();
$email = $_SESSION['email'];

  include 'includes.php'; 
  
  
 function getNewContentAvailable($child){
    $newContents = array();
    $teaching = $child->getTeachingContent();
    $medical = $child->getMedicalContent();
    $family = $child->getfamilyContent();
    
    if (isNewContent($teaching))
        $newContents[]= "teaching";
    
    if (isNewContent($medical))
        $newContents[]= "medical";
    
    
    if (isNewContent($family))
        $newContents[]= "family";
    return $newContents;
     
 }

 function isNewContent($contents){
     foreach($contents as $content ){
         if(!$content['notified']['B'])
             return true;
       return false;      
     }
 }
 
$childDao = new ChildDAO(DynamoDbClientBuilder::get());
$children = $childDao->getChildrenWithEmail($email);
$contents = getNewContentAvailable($child);
header('Content-Type: application/json');
$response = json_encode($contents);
echo $response;
 

?>


