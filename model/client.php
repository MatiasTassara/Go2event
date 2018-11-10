<?php
namespace model;

class Client{
    private $user;
    private $pass;
    private $role;
    private $avatarPath;

    public function __construct($user,$pass,$role,$avatarPath,$id =''){
        $this->user = $user;
        $this->pass = $pass;
        $this->role = $role;
        $this->avatarPath = $avatarPath;
        $this->id = $id;
    }

    
}