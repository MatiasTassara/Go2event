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
  public function index($alert = null){
    $events = $this->daoCalendar->retrieveUpcomingEvents();
    $mostSold = $this->daoEvent->retrieveMostSoldForIndex();
    include(ROOT.'views/index.php');
  }
  public function login(){
    include(ROOT.'views/login-register.php');

  }

  public function eventInfo($id,$alert = null)
  {
    $event = $this->daoEvent->retrieveById($id);
    $calendars = $this->daoCalendar->retrieveByIdEvent($id);
    foreach ($calendars as $key => $value) {
      $artistsPerCalendar[$value->getId()] = $this->daoArtistPerCalendar->retrieveArtistsByIdCalendar($value->getId());
      $seats[$value->getId()] = $this->daoSeat->retrieveSeatsByIdCalendar($value->getId());
    }

     include(ROOT.'views/event-info.php');
  }

  public function upcomingEvents(){
    $title = 'Proximos';
    $events = $this->daoCalendar->retrieveAllEvents();
    if(isset($events) && sizeof($events) > 1)
    {
      include(ROOT.'views/list-events.php');
    }
    else if(isset($events) && sizeof($events) == 1)
    {
      $this->eventInfo($events[0]->getId());
    }
    else if(!isset($events) || sizeof($events) == 0)
    {
      $this->index("No hay eventos con fechas disponibles");
    }
  }
  public function search($text)
  {
    $eventsByName = $this->daoCalendar->retrieveEventsByName($text);
    $eventsByCategory = $this->daoCalendar->retrieveEventsByCategory($text);
    $eventsByArtist = $this->daoCalendar->retrieveEventsByArtist($text);
    if(sizeof($eventsByName) > 0 || sizeof($eventsByCategory) > 0 || sizeof($eventsByArtist) > 0)
    {
      include(ROOT.'views/list-events.php');
    }
    else
    {
      $this->index("No se econtró ningun resultado para: \"".$text."\".");
    }

  }

  public function mostSoldEvents(){
    $title = 'Mas Vendidos';
    $events = $this->daoEvent->rankingMostSold();
    if(isset($events) && sizeof($events) > 1)
    {
      include(ROOT.'views/list-events.php');
    }
    else if(isset($events) && sizeof($events) == 1)
    {
      $this->eventInfo($events[0]->getId());
    }
    else if(!isset($events) || sizeof($events) == 0)
    {
      $this->index("No hay eventos con fechas disponibles");
    }
  }


}


?>
