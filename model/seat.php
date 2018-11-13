<?php
namespace Model;

class Seat{
  private $id;
  private $quant;
  private $remaining;
  private $price;
  private $seatType;
  private $calendar;

  function __construct($quant, $price, $remaining, $seatType,$calendar, $id = ''){
    $this->id = $id;
    $this->quant = $quant;
    $this->remaining = $remaining;
    $this->price = $price;
    $this->seatType = $seatType;
    $this->calendar = $calendar;
  }

  public function getId(){
    return $this->id;
  }

  public function getQuantity(){
    return $this->quant;
  }

  public function getPrice(){
    return $this->price;
  }

  public function getRemaining(){
    return $this->remaining;
  }

  public function getSeatType(){
    return $this->seatType;
  }
  public function getCalendar(){
    return $this->calendar;
  }
  public function setQuant($quant){
    $this->quant = $quant;
  }
  public function setPrice($price){
    $this->price = $price;
  }
  public function setRemaining($remaining){
    $this->remaining = $remaining;
  }
  public function setSeatType($seatType){
    $this->seatType = $seatType;
  }
  public function setCalendar($calendar){
    $this->calendar = $calendar;
  }
}




 ?>
