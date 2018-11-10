<?php
namespace model;

class Calendar{
  private $id;
  //private $artists; // clase artista array
  private $venue; 
  private $date;
  private $event;
  private $imgPath;


  function __construct(/*$artists,*/ $venue, $event, $date,$imgPath,$id=''){
    $this->id = $id;
    //$this->artists = $artists;
    $this->venue = $venue;
    $this->event = $event;
    $this->date = $date;
    $this->Path = $imgPath; //ruta de la imagen

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
    return $this->date;
  }
  public function getEvent(){
    return $this->event;
  }
  public function getImgPath(){
    return $this->imgPath;
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
  public function setImgPath($imgPath){
    $this->imgPath = $imgPath;
  }





}



 ?>
