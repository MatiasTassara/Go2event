<?php
namespace controller;

use Controller\ControllerHome as C_Home;
use Model\Calendar as M_Calendar;
use Model\Seat as M_Seat;
use Dao\db\ArtistsPerCalendarDb as D_Artist_Calendar;
use Dao\db\CalendarDb as D_Calendar;
use Dao\db\VenueDb as D_Venue;
use Dao\db\EventDb as D_Event;
use Dao\db\ArtistDb as D_Artist;
use Dao\db\SeattypeDb as D_SeatType;
use Dao\db\SeatDb as D_Seat;

class ControllerCalendar{
  private $daoCalendar;
  private $daoEvent;
  private $daoArtist;
  private $daoVenue;
  private $daoArtistPerCalendar;
  private $daoSeat;
  private $daoSeatType;
  private $cHome;

  public function __construct(){
    $this->daoCalendar = D_Calendar::getInstance();
    $this->daoEvent = D_Event::getInstance();
    $this->daoArtist = D_Artist::getInstance();
    $this->daoVenue = D_Venue::getInstance();
    $this->daoArtistPerCalendar = D_Artist_Calendar::getInstance();
    $this->daoSeatType = D_SeatType::getInstance();
    $this->daoSeat = D_Seat::getInstance();
    $this->cHome = new C_Home();
  }
  function index(){
    if(isset($_SESSION["user"]) && $_SESSION["user"]->isAdmin() == 1){
      $calendars = $this->daoCalendar->getAll();
      $events = $this->daoEvent->getAll();
      $artists = $this->daoArtist->getAll();
      $venues = $this->daoVenue->getAll();
      $seattypes = $this->daoSeatType->getAll();
      include(ROOT.'views/calendars.php');
    }
    else {
      $this->cHome->index();
    }
  }

  public function addCalendar ( $idEvent, $idVenue, $idsArtist, $date, $arrIdsSeatType, $arrQuant, $arrPrice ){ //idsartist es arreglo de ids
    // echo '<br><br>'. var_dump($date) .'<br>';

    $event = $this->daoEvent->retrieveById($idEvent);
    $venue = $this->daoVenue->retrieveById($idVenue);

    $artists = null;
    foreach ($idsArtist as $key => $value) {
      if($this->daoArtist->retrieveById($value) != null){
        $artists[] = $this->daoArtist->retrieveById($value);
      }
    }
    //hasta este punto tenemos evento,lugar y array de artistas....
    $objCalendar = new M_Calendar ($venue, $event, $date);
    $calendarLastId = $this->daoCalendar->add($objCalendar);
    $calendar = $this->daoCalendar->getLastCalendar();

    // echo "<pre>";
    //var_dump($calendar);
    foreach ($artists as $key => $value) {
      $this->daoArtistPerCalendar->addArtistPerCalendar($calendar,$value);//incluir los daos y cargar la plaza
    }
    $this->addSeats($arrQuant, $arrPrice, $arrIdsSeatType,$calendar);
  }
  public function addSeats($arrQuant, $arrPrice, $arrIdsSeatType,$calendar){

    $seatTypes = null;//ver si hay que usar la funcion array()
    foreach ($arrIdsSeatType as $key => $value) {
      if($this->daoSeatType->retrieveById($value) != null){
        $seatTypes[] = $this->daoSeatType->retrieveById($value);
      }
    }

    while(!empty($arrQuant)){
      $quant = array_shift($arrQuant);
      $prize = array_shift($arrPrice);
      $remaining = $quant;
      if($quant != 0)
      {
        $seatType = $this->daoSeatType->retrieveById(array_shift($arrIdsSeatType));
        $seatobj = new M_Seat($quant,$prize,$remaining,$seatType,$calendar);
        $this->daoSeat->add($seatobj);
      }
    }
    $this->index();
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

  public function filterEvents(){
    $calendarArray = $this->daoCalendar->getAll();
    $viewArray = [];
    foreach ($calendarArray as $key => $value) {
      $check = true;
      for($i = 0;$i <= sizeof($viewArray) && $check;$i++){
        if($viewArray[sizeof($viewArray)]->getName() == $value->getEvent()->getName()){
          $check = false;
        }
      }
      if($check){
        array_push($viewArray,$value->getEvent());
      }
    }

  }

}


?>
