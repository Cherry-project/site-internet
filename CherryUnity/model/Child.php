<?php

class Child extends User {
    private $famillyId;
    private $doctorId;
    private $teacherId;
    private $famillyContent;
    private $medicalContent;
    //private $educationalContent;
    
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
}
