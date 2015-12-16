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
                        'date' => array ('S' => $date) // ,
                        // 'notified' => array ('N' => 0)
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
    
    public function deleteContent($name, $owner, $type) {
        $contents = $this->getContentByType($type);
        $i = 0;
        foreach($contents as $content) {
            if ($content['M']['name']['S'] == $name &&
                $content['M']['owner']['S'] == $owner) {
                // delete content from array
                unset($contents[$i]);
                break;
            }
            $i++;
        }
        // index array correctly after use of unset function
        $contents = array_values($contents);
        $this->setContentByType($contents, $type);        
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
                    // $array[$i]['M']['notified']['N'] = 0;
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
        if ($type == "doctor") {
            return $this->medicalContent;
        } else if ($type == "teacher") {
            return $this->teachingContent;
        } else if ($type == "family") {
            return $this->familyContent;
        }
    }
    
    function setContentByType($list_contents, $type) {
        if ($type == "doctor") {
            $this->medicalContent = $list_contents;
        } else if ($type == "teacher") {
            $this->teachingContent = $list_contents;
        } else if ($type == "family") {
            $this->familyContent = $list_contents;
        }
    }
}
