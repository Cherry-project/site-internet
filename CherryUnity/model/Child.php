<?php

class Child extends User {
    private $famillyId;
    private $doctorId;
    private $teacherId;
    private $famillyContent;
    private $medicalContent;
    private $teachingContent;
    
    function getFamillyId() {
        return $this->famillyId;
    }

    function getDoctorId() {
        return $this->doctorId;
    }

    function getTeacherId() {
        return $this->teacherId;
    }

    function setFamillyId($famillyId) {
        $this->famillyId = $famillyId;
    }

    function setDoctorId($doctorId) {
        $this->doctorId = $doctorId;
    }

    function setTeacherId($teacherId) {
        $this->teacherId = $teacherId;
    }
    
    function getFamillyContent() {
        return $this->famillyContent;
    }

    function getMedicalContent() {
        return $this->medicalContent;
    }

    function getTeachingContent() {
        return $this->teachingContent;
    }

    function setFamillyContent($famillyContent) {
        $this->famillyContent = $famillyContent;
    }

    function setMedicalContent($medicalContent) {
        $this->medicalContent = $medicalContent;
    }

    function setTeachingContent($teachingContent) {
        $this->teachingContent = $teachingContent;
    }
}
