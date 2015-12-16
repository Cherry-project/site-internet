<?php


class AchievementsDAO {
    public static $TABLE_NAME = 'Achievements';
    protected $client;
        
    public function __construct ($client) {
        $this->client = $client;
    }
    
    public function getTutorial($email){
        $dto = getAchievementDTO($email);
        return $dto['isTutoFinished']['N'];
    }
    public function getAvatar($email){
        $dto = getAchievementDTO($email);
        return $dto['isAvatarMale']['N'];
    }
    
    public function updateTutorial($email,$value){
        $result = $this->client->updateItem([
    'TableName' => AchievementsDAO::$TABLE_NAME,
    'Key' => [
        'email' => [ 'S' => $email ]
    ],
    'ExpressionAttributeValues' =>  [
        ':val1' => [
            'N' => $value
           ]
    ] ,
    'UpdateExpression' => 'set isTutoFinished = :val1'
]);
    }
    
    public function getAchievementDTO($email){
        $result = $this->client->getItem(array(
            'ConsistentRead' => true,
            'TableName' => AchievementsDAO::$TABLE_NAME,
            'Key' => array(
                'email' => array('S' => $email)
            )
        ));
        return $result['Item'];
    }
   
}
