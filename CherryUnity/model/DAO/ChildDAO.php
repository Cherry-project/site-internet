<?php


class ChildDAO extends UserDAO {
    
    public function __construct ($client) {
        parent::__construct($client);
    }
    
    public function getArrayWithUserData ($child) {
        $array = parent::getArrayWithUserData($child);
        $array['teachingContent'] = array ('L' => $child.getTeachingContent()); 
        return $array;
    } 
}
