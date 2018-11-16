<?php // Li: Falta terminar, revisar codigo
namespace dao;

class ListCalendar extends SingletonDAO implements \interfaces\Idao{

  private $calendars;


  function __construct(){
    if(!isset($_SESSION['calendars'])){
      $_SESSION['calendars'] = array();
      $id = (isset($_SESSION['idsCalendars'])) ? $_SESSION['idsCalendars'] : 0;
      $_SESSION['idsCalendars'] = $id;
    }
    $this->calendars = $_SESSION['calendars'];
  }

  public function add($obj){
    $check = true;
    $this->calendars = $_SESSION['calendars'];
    foreach ($this->calendars as $key => $value) {
      if($value->getName() == $obj->getName()){
        $check = false;
      }
    }
    if($check){
      $id = $_SESSION['idsCalendars'];
      $obj->setId(++$id);
      $_SESSION['idsCalendars'] = $id;
      $this->calendars[] = $obj;
      $_SESSION['calendars'] = $this->calendars;
    }
  }

  public function retrieveByName($name){
    $artistsReturn = null;
    foreach ($this->calendars as $key => $value) {
      if($name == $value->getName()){
        if($artistsReturn == null){
          $artistsReturn = array();
        }
        $artistsReturn[] = $value;
      }
    }
    return $artistsReturn;
  }

  public function retrieveById($id){
    $artistReturn = null;
    foreach ($this->calendars as $key => $value) {
      if($id == $value->getId()){

        $artistReturn = $value;
      }
    }
    return $artistReturn;
  }

  public function update($obj){
    $this->calendars = $_SESSION['seattypes'];
    if(isset($this->calendars[$obj->getId()])){
      $this->calendars[$obj->getId()] = $obj;
    }
  }

  public function delete($id){
    $calendars = $_SESSION['calendars'];
    foreach ($this->seattypes as $key => $value) {
      if($value->getId() == $id){
        unset($calendars[$key]);
        $_SESSION['calendars'] = $calendars;
      }
    }
  }

  public function getAll(){
    $this->calendars = $_SESSION['calendars'];
    return $this->calendars;
  }
}
