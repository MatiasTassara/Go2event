<?php
namespace controller;

use Model\Calendar as M_Calendar;
use Model\Seat as M_Seat;
use DAO\ArtistsPerCalendarDb as D_Artist_Calendar;
use DAO\CalendarDb as D_Calendar;
use DAO\VenueDb as D_Venue;
use DAO\EventDb as D_Event;
use DAO\ArtistDb as D_Artist;
use DAO\SeattypeDb as D_SeatType;
use DAO\SeatDb as D_Seat;

class  ControllerHome{
  private $daoCalendar;
  private $daoEvent;
  private $daoArtist;
  private $daoVenue;
  private $daoArtistPerCalendar;
  private $daoSeat;
  private $daoSeatType;

  public function __construct()
  {
    $this->daoCalendar = D_Calendar::getInstance();
    $this->daoEvent = D_Event::getInstance();
    $this->daoArtist = D_Artist::getInstance();
    $this->daoVenue = D_Venue::getInstance();
    $this->daoArtistPerCalendar = D_Artist_Calendar::getInstance();
    $this->daoSeatType = D_SeatType::getInstance();
    $this->daoSeat = D_Seat::getInstance();
  }
  public function index(){
    $calendars = $this->daoCalendar->getAll();
    $events = $this->daoEvent->getAll();
    $artists = $this->daoArtist->getAll();
    $venues = $this->daoVenue->getAll();
    $seattypes = $this->daoSeatType->getAll();
    include(ROOT.'views/index.php');
  }
  public function login(){
    include(ROOT.'views/login-register.php');

  }


}


?>
