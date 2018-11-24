<?php
namespace Model;
class Ticket{
  private $id;
  private $number;
  private $qr;
  private $purchaseItem;
  public function __construct($number,$qr, $purchItem, $id = ''){
    $this->id = $id;
    $this->number = $number;
    $this->qr = $qr;
    $this->purchaseItem = $purchItem;
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
  public function getPurchaseItem(){
    return $this->purchaseItem;
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