<?php
namespace model;

class User{
    
    private $mail;
    private $name;
    private $surname;
    private $pass;
    private $isAdmin;
    

    public function __construct($mail,$name,$surname,$pass,$isAdmin){    
        $this->mail = $mail;
        $this->name = $name;
        $this->surname = $surname;
        $this->pass = $pass;
        $this->isAdmin = $isAdmin;
    }

   
    public function getMail(){
        return $this->mail;
    }
    public function getName(){
        return $this->name;
    }
    public function getSurname(){
        return $this->surname;
    }
    public function getIsAdmin(){
        return $this->isAdmin;
    }
    public function getPass(){
        return $this->pass;
    }
    public function setMail($mail){
        $this->mail = $mail;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function setSurname($surname){
        $this->surname = $surname;
    }
    public function setPass($pass){
        $this->pass = $pass;
    }
}
