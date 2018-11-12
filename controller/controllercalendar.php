<?php
namespace controller;



use Model\Calendar as M_Calendar;

use DAO\ArtistsPerCalendarDb as D_Artist_Calendar;
use DAO\CalendarDb as D_Calendar;
use DAO\VenueDb as D_Venue;
use DAO\EventDb as D_Event;
use DAO\ArtistDb as D_Artist;
use DAO\SeattypeDb as D_SeatType;

class ControllerCalendar{
  private $daoCalendar;
  private $daoEvent;
  private $daoArtist;
  private $daoVenue;
  private $daoArtistPerCalendar;


  public function __construct(){
    $this->daoCalendar = D_Calendar::getInstance();
    $this->daoEvent = D_Event::getInstance();
    $this->daoArtist = D_Artist::getInstance();
    $this->daoVenue = D_Venue::getInstance();
    $this->daoArtistPerCalendar = D_Artist_Calendar::getInstance();
    $this->daoSeatType = D_SeatType::getInstance();

  }
  function index(){
    $calendars = $this->daoCalendar->getAll();
    $events = $this->daoEvent->getAll();
    $artists = $this->daoArtist->getAll();
    $venues = $this->daoVenue->getAll();
    $seattypes = $this->daoSeatType->getAll();
    include(ROOT.'views/calendars.php');
  }

    public function addCalendar ($idsArtist, $idVenue, $idEvent, $date, $imgPath ){ //idsartist es arreglo de ids
    $event = $this->daoEvent->retrieveById($idEvent);
    $venue = $this->daoVenue->retrieveById($idVenue);

    $artists = null;
    foreach ($idsArtist as $key => $value) {
      if($this->daoArtist->retrieveById($value) != null){
         $artists[] = $this->daoArtist->retrieveById($value);
      }
    }
    //hasta este punto tenemos evento,lugar y array de artistas....
    $objCalendar = new M_Calendar(/*$artists,*/ $venue, $event, $date, $imgPath);
    $calendarLastId = $this->daoCalendar->add($objCalendar);
    $this->daoArtistPerCalendar->add($calendarLastId,$artists);//incluir los daos y cargar la plaza
    $calendar = $this->daoCalendar->retrieveById($calendarLastId);
    $this->index();
  }
  public function addSeats($arrQuant, $arrPrice, $arrRemaining, $arrIdsSeatType,$idCalendar){
    $calendar = $this->daoCalendar->retrieveById($idCalendar);
    $seatTypes = null;//ver si hay que usar la funcion array()
    foreach ($arrIdsSeattype as $key => $value) {
      if($this->daoSeatType->retrieveById($value) != null){
         $seatTypes[] = $this->daoSeatTypes->retrieveById($value);
      }
    }

    while(!isempty($arrQuant)){
      $quant= array_shift($arrQuant);

      $prize = array_shift($arrPrice);
      $remaining = array_shift($arrRemaining);
      $seatType = $this->daoSeatType->retrieveById(array_shift($arrIdsSeatType));
      $seatobj = new M_Seat($quant,$prize,$remaining,$seatType,$calendar);
      $this->daoSeat->add($seatobj);
    }
  }

  public function modifyCalendar($id,$artists, $venue, $event, $date,$imgPath) {

    $obj = $this->daoCalendar->retrieveById($id);
    $obj->setArtists($artists);
    $obj->setVenue($venue);
    $obj->setEvent($event);
    $obj->setDate($date);
    $obj->setImgPath($imgPath);
    $this->daoCalendar->update($obj);
    $this->index();
  }

  public function deleteCalendar($idCalendar) {
    $this->daoCalendar->delete($idCalendar);
    $this->index();
  }

}



 ?>
