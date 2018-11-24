<?php
namespace Model;

class PurchaseItem{
  private $id;
  private $quantity;
  private $price;
  private $purchase;

  public function __construct($quant,$price,$purchase, $id = ''){
    $this->id = $id;
    $this->quantity = $quant;
    $this->price = $price;
    $this->purchase = $purchase;
  }

  public function getId(){
    return $this->id;
  }
  public function getQuantity(){
    return $this->quantity;
  }
  public function getPrice(){
    return $this->price;
  }
  public function getPurchase(){
    return $this->purchase;
  }
  public function setId($id){
    $this->id = $id;
  }
  public function setQuantity($quant){
    $this->quantity = $quant;
  }
  public function setPrice($price){
    $this->price = $price;
  }
  public function setPurchase($purchase){
    $this->purchase = $purchase;
  }

}