<?php
namespace Model;

class Ticket{
  private $id;
  private $number;
  private $qr;

  public function __construct($number,$qr, $id = ''){
    $this->id = $id;
    $this->number = $number;
    $this->qr = $qr;
  }

  public function getId(){
    return $this->id;
  }
  public function getNumber(){
    return $this->number;
  }
  public function getQr(){
    return $this->qr;
  }
  public function setId($id){
    $this->id = $id;
  }
  public function setNumber($number){
    $this->number = $number;
  }
  public function setQr($qr){
    $this->qr = $qr;
  }

}