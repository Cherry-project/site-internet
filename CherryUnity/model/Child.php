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
    
    public function addContent($content, $date) {
        $elt = array ('M' => array (
                        'name' => array ('S' => $content->getName()),
                        'owner' => array ('S' => $content->getEmailOwner()),
                        'date' => array ('S' => $date) 
                    ));
        $type = $content->getType();
        if ($type == "doctor") {
            $this->addContentIfMissing($this->medicalContent, $elt);
        } else if ($type == "teacher") {
            $this->addContentIfMissing($this->teachingContent, $elt);
        } else if ($type == "family") {
            $this->addContentIfMissing($this->familyContent, $elt);
        }
    }
    
    private function addContentIfMissing (&$array, $elt) {
        echo 'Add content!!!!!</br>';
        $eltIsInArray = false;
        $length = count($array);
        if ($length == 0) {
            echo 'length == 0</br>';
            $array = array($elt);
            return;
        }
        for ($i = 0; $i < $length; $i++) {
            $e = $array[$i];
            if ($e['M']['name']['S'] == $elt['M']['name']['S'] &&
                $e['M']['owner']['S'] == $elt['M']['owner']['S']) {
                
                if ($e['M']['date']['S'] != $elt['M']['date']['S']) {
                    // l'element est deja dans le tableau il faut juste changer la date
                    $array[$i]['M']['date']['S'] = $elt['M']['date']['S'];
                }
                echo 'elt deja present</br>';
                $eltIsInArray = true;
                break;
            }
        }
        if (!$eltIsInArray) {
            echo 'AJOUT ELEMENT</br>';
            array_push($array, $elt);
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
