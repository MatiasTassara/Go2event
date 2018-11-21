<?php
namespace model;

class Calendar{
  private $id;
  private $venue;
  private $date;
  private $event;

  function __construct( $venue, $event, $date,$id=''){
    $this->id = $id;
    $this->venue = $venue;
    $this->event = $event;
    $this->date = $date;

  }

  public function getId(){
    return $this->id;
  }

  public function getVenue(){
    return $this->venue;
  }

  public function getDate(){
    return $this->date;
  }
  public function getEvent(){
    return $this->event;
  }

  public function setVenue($venue){
    $this->venue = $venue;
  }

  public function setDate($date){
    $this->date = $date;
  }
  public function setEvent($event){
    $this->event = $event;
  }






}



 ?>
