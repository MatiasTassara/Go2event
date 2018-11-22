<?php
namespace model;

class Calendar{
  private $id;
  //private $artists; // clase artista array
  private $venue;
  private $date;
  private $event;

  function __construct(/*$artists,*/ $venue, $event, $date,$id=''){
    $this->id = $id;
   // $artists = $artists;
    $this->venue = $venue;
    $this->event = $event;
    $this->date = $date;

  }

  public function getId(){
    return $this->id;
  }
/*
  public function getArtists(){
    return $this->$artists;
  }
*/
  public function getVenue(){
    return $this->venue;
  }

  public function getDate(){
    $date = date("d/m/Y",strtotime($this->date));
    return $date;
  }
  public function getEvent(){
    return $this->event;
  }

/*
  public function setArtists($artists){
    $this->artists = $artists;
  }*/
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
