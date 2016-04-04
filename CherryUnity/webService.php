<?php
session_start();

$root = "./";
include 'includes.php'; 




function getNewContentAvailable($child){
    $newContents = array();
    $teaching = $child->getTeachingContent();
    $medical = $child->getMedicalContent();
    $family = $child->getfamilyContent();

    if (isNewContent($teaching))
        {
            $newContents[]= "teaching";
            foreach($child->getTeachingContent() as $element)
            {
                foreach ($element as $elem2)
                {
                    $newContents[]= $elem2["name"];
                }
            }
        } 
        //$newContents[]= "teaching";

    if (isNewContent($medical))
        {
            $newContents[]= "medical";
            foreach($child->getMedicalContent() as $element)
            {
                foreach ($element as $elem2)
                {
                    $newContents[]= $elem2["name"];
                }
            }
        }   
        //$newContents[]= "medical";


    if (isNewContent($family))
        {
            $newContents[]= "family";
            foreach($child->getfamilyContent() as $element)
            {
                foreach ($element as $elem2)
                {
                    $newContents[]= $elem2["name"];
                }
            }
        } 
        //$newContents[]= "family";
    
    return $newContents;
}
 
$childDao = new ChildDAO(DynamoDbClientBuilder::get());
if(!empty($_GET['email']))
$email = $_GET['email'];
//echo $email;
$child = $childDao->get($email);
$contentsMedical = $child->getContentByType("doctor");
$contentsFamilial = $child->getContentByType("family");
$contentsPedagogique = $child->getContentByType("teacher");
echo '["';
if(count($contentsMedical)>0)
{
    echo 'medical:';
    foreach ($contentsMedical as $contentM)
    {
        echo $contentM['name'].'&';
    }
}
if(count($contentsFamilial)>0)
{
    echo 'family:';
    foreach ($contentsFamilial as $contentF)
    {
        echo $contentF['name'].'&';
    }
}
if(count($contentsPedagogique)>0)
{
    echo 'teaching:';
    foreach ($contentsPedagogique as $contentP)
    {
        echo $contentP['name'].'&';
    }
}
echo '"]';
/*
$contents = getNewContentAvailable($child);
header('Content-Type: application/json');
$response = json_encode($contents);
echo $response;
*/
?>


