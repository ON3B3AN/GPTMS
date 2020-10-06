<?php

Class Profile {
    
    private $fName, $lName, $phone, $email, $pwd; 
    
    function __construct($fName, $lName, $phone, $email, $pwd) {
        $this->fName = $fName;
        $this->lName = $lName;
        $this->phone = $phone;
        $this->email = $email;
        $this->pwd = $pwd;
    }

    function getFName() {
        return $this->fName;
    }

    function getLName() {
        return $this->lName;
    }

    function getPhone() {
        return $this->phone;
    }

    function getEmail() {
        return $this->email;
    }

    function getPwd() {
        return $this->pwd;
    }

    function setFName($fName) {
        $this->fName = $fName;
    }

    function setLName($lName) {
        $this->lName = $lName;
    }

    function setPhone($phone) {
        $this->phone = $phone;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPwd($pwd) {
        $this->pwd = $pwd;
    }
}
