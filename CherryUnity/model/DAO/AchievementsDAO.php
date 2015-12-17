<?php


class AchievementsDAO {
    public static $TABLE_NAME = 'Achievements';
    protected $client;
        
    public function __construct ($client) {
        $this->client = $client;
    }
    
    public function getTutorial($email){
        $dto = $this->getAchievementDTO($email);
        //print_r($dto);
        return $dto['isTutoFinished']['N'];
    }
    public function getAvatar($email){
        $dto = getAchievementDTO($email);
        print_r($dto);
        return $dto['isAvatarMale']['N'];
    }
    
    public function updateTutorial($email,$value){
        echo 'value' .$value;
        $result = $this->client->updateItem([
    'TableName' => 'Achievements',
    'Key' => array(
                'email' => array('S' => $email)
            ),
    'ExpressionAttributeValues' =>  [
        ':val1' => [ 'N' => $value]  
       
    ] ,
    'UpdateExpression' => 'set isTutoFinished = :val1 '
]);
        print_r($result);
    }
    
    public function getAchievementDTO($email){
        $result = $this->client->getItem(array(
            'ConsistentRead' => true,
            'TableName' => AchievementsDAO::$TABLE_NAME,
            'Key' => array(
                'email' => array('S' => $email)
            )
        ));
        //print_r($result['Item']);
        return $result['Item'];
    }
   
}
