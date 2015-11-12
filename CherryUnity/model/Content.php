<?php

class Content {
    private $name;
    private $emailOwner;
    private $url;
    private $type;
    
    public function __construct() {}

    function getName() {
        return $this->name;
    }

    function getUrl() {
        return $this->url;
    }

    function getEmailOwner() {
        return $this->email_owner;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setUrl($url) {
        $this->url = $url;
    }

    function setEmailOwner($email_owner) {
        $this->email_owner = $email_owner;
    }

    function getType() {
        return $this->type;
    }

    function setType($type) {
        $this->type = $type;
    }
}
