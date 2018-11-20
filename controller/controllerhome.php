<?php
namespace controller;

use Model\Calendar as M_Calendar;
use Model\Seat as M_Seat;
use Dao\db\ArtistsPerCalendarDb as D_Artist_Calendar;
use Dao\db\CalendarDb as D_Calendar;
use Dao\db\VenueDb as D_Venue;
use Dao\db\EventDb as D_Event;
use Dao\db\ArtistDb as D_Artist;
use Dao\db\SeattypeDb as D_SeatType;
use Dao\db\SeatDb as D_Seat;

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
    $events = $this->daoCalendar->retrieveUpcomingEvents();
    include(ROOT.'views/index.php');
  }
  public function login(){
    include(ROOT.'views/login-register.php');

  }

  public function eventInfo($id)
  {
    $event = $this->daoEvent->retrieveById($id);
    $calendars = $this->daoCalendar->retrieveByIdEvent($id);
    //$artists = $this->daoArtistPerCalendar->retrieveArtistsByIdCalendar($);

    foreach ($calendars as $key => $value) {
      $artistsPerCalendar[$value->getId()] = $this->daoArtistPerCalendar->retrieveArtistsByIdCalendar($value->getId());
    }

    //Si no tenemos un array de artistas (Como plantea el modelo que nos dieron)
    //tengo que hacer un foreach por cada fecha de un evento*/
    include(ROOT.'views/event-info.php');

  }


}


?>
