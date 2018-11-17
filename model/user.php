<?php
namespace model;

class User{
    
    private $email;
    private $name;
    private $surname;
    private $pass;
    private $role;
    private $id;
    

    public function __construct($email,$name,$surname,$pass,$role,$id=''){    
        $this->email = $email;
        $this->name = $name;
        $this->surname = $surname;
        $this->pass = $pass;
        $this->role = $role;
        $this->id = $id;
    }

    public function isAdmin(){
        if($this->role->getName() == "admin"){
            return true;
        }else return false;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getName(){
        return $this->name;
    }
    public function getSurname(){
        return $this->surname;
    }
    public function getRole(){
        return $this->role;
    }
    public function getPass(){
        return $this->pass;
    }
    public function getId(){
        return $this->id;
    }
    public function setEmail($email){
        $this->email = $email;
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
    public function setId($id){
        $this->id = $id;
    }
}
