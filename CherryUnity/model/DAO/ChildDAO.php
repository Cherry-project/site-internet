<?php


class ChildDAO extends UserDAO {
    
    public function __construct ($client) {
        parent::__construct($client);
    }
    
    protected function getArrayWithUserData ($child) {
        $array = parent::getArrayWithUserData($child);
        $arrayTeaching = $child->getTeachingContent();
        $arrayMedical = $child->getMedicalContent();
        $arrayFamily = $child->getfamilyContent();
        if (!empty($arrayTeaching)) {$array['teachingContent'] = array('L' => $arrayTeaching);}
        if (!empty($arrayMedical)) {$array['medicalContent'] = array('L' => $arrayMedical);}
        if (!empty($arrayFamily)) {$array['familyContent'] = array('L' => $arrayFamily);}
        return $array;
    } 
    
    public function getChildren($emailAdult){
        try {
            $result = $this->client->scan([
                'TableName' => 'Users',
                'ExpressionAttributeValues' => [
                    ':val1' => ['S' => $emailAdult]
                ],    
                'FilterExpression' => '(:val1=familyId) or (:val1=doctorId) or (:val1=teacherId) ',
            ]);
        } catch (Exception $e) {
            echo '<p>Exception reçue : ',  $e->getMessage(), "\n</p>";
        }
        
        $childrenDTO = $result['Items'];
        $children = array();
        foreach($childrenDTO as $childDTO) {
            $child = new Child();
            $child->setEmail($childDTO['email']['S']);
            $child->setFirstname($childDTO['firstname']['S']);
            $child->setLastname($childDTO['lastname']['S']);
            array_push($children, $child);
        }
        return $children;
    }
    
    
    protected function getUser () {
        return new Child();
    }
    
    protected function fillUserAttributes ($childDTO, $child) {
        parent::fillUserAttributes($childDTO, $child);
        $child->setTeachingContent($childDTO['Item']['teachingContent']['L']);
        $child->setMedicalContent($childDTO['Item']['medicalContent']['L']);
        $child->setFamilyContent($childDTO['Item']['familyContent']['L']);
    }
}

