<?php

class Child extends User {
    private $familyId;
    private $doctorId;
    private $teacherId;
    private $familyContent;
    private $medicalContent;
    private $teachingContent;
    
    public function __construct() {
        $this->type = "child";
    }
    
    function getFamilyId() {
        return $this->familyId;
    }

    function getDoctorId() {
        return $this->doctorId;
    }

    function getTeacherId() {
        return $this->teacherId;
    }

    function setFamilyId($familyId) {
        $this->familyId = $familyId;
    }

    function setDoctorId($doctorId) {
        $this->doctorId = $doctorId;
    }

    function setTeacherId($teacherId) {
        $this->teacherId = $teacherId;
    }
    
    function getFamilyContent() {
        return $this->familyContent;
    }

    function getMedicalContent() {
        return $this->medicalContent;
    }

    function getTeachingContent() {
        return $this->teachingContent;
    }

    function setFamilyContent($familyContent) {
        $this->familyContent = $familyContent;
    }

    function setMedicalContent($medicalContent) {
        $this->medicalContent = $medicalContent;
    }

    function setTeachingContent($teachingContent) {
        $this->teachingContent = $teachingContent;
    }
    
    function addContentByType($keyOfFile, $date, $type) {
        $elt = array ('L' => array ( 
                    array ('S' => $keyOfFile),
                    array ('S' => $date) 
                ));
        if ($type == "medical") {
            array_push($this->medicalContent, $elt);
        } else if ($type == "teaching") {
            array_push($this->teachingContent, $elt);
        } else if ($type == "family") {
            array_push($this->familyContent, $elt);
        }
    }
    
    function getContentByType($type) {
        if ($type == "medical") {
            return $this->medicalContent;
        } else if ($type == "teaching") {
            return $this->teachingContent;
        } else if ($type == "family") {
            return $this->familyContent;
        }
    }
}
