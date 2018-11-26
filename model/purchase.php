<?php
namespace Model;

class Purchase{
  private $id;
  private $date;
  private $user;

  public function __construct($date,$user, $id = ''){
    $this->id = $id;
    $this->date = $date;
    $this->user = $user;
  }
  public function getId(){
    return $this->id;
  }
  public function getDate(){
    return $this->date;
  }
  public function getUser(){
    return $this->user;
  }
  public function setId($id){
    $this->id = $id;
  }
  public function setDate($date){
    $this->date = $date;
  }
  public function setUser($user){
    $this->user = $user;
  }

}




 ?>
