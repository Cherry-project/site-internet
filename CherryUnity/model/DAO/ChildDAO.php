<?php


class ChildDAO extends UserDAO {
    
    public function __construct ($client) {
        parent::__construct($client);
    }
    
    protected function getArrayWithUserData ($child) {
        $array = parent::getArrayWithUserData($child);
        $array['teachingContent'] = array('L' => $child->getTeachingContent());
        $array['medicalContent'] = array('L' => $child->getMedicalContent());
        $array['familyContent'] = array('L' => $child->getfamilyContent());
        
        return $array;
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
