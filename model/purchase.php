<?php
namespace Model;

class Purchase{
  private $id;
  private $date;
  private $client;

  public function __construct($date,$client, $id = ''){
    $this->id = $id;
    $this->date = $date;
    $this->client = $client;
  }
  public function getId(){
    return $this->id;
  }
  public function getDate(){
    return $this->date;
  }
  public function getClient(){
    return $this->client;
  }
  public function setId($id){
    $this->id = $id;
  }
  public function setDate($date){
    $this->date = $date;
  }
  public function setClient($client){
    $this->client = $client;
  }

}




 ?>
