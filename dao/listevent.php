<?php
namespace dao;

class ListEvent extends SingletonDAO implements \interfaces\Idao{

  private $events;

  public function __construct(){

    if(!isset($_SESSION['events'])){
      $_SESSION['events'] = array();

      $id = (isset($_SESSION['idsEvents'])) ? $_SESSION['idsEvents'] : 0;

      $_SESSION['idsEvents'] = $id;
    }
    $this->events = $_SESSION['events'];

  }

  public function add($obj){

    $check = true;
    $this->events = $_SESSION['events'];
    foreach ($this->events as $key => $value) {
      if($value->getName() == $obj->getName()){
        $check = false;
      }
    }
    if($check){

      $id = $_SESSION['idsEvents'];
      $obj->setId(++$id);
      $_SESSION['idsEvents'] = $id;
      $this->events[] = $obj;
      $_SESSION['events'] = $this->events;

    }
  }

  public function retrieveByName($name){

    $eventsReturn = null;
    foreach ($this->events as $key => $value) {
      if($name == $value->getName()){
        if($eventsReturn == null){

          $eventsReturn = array();
        }

        $eventsReturn[] = $value;
      }
    }
    return $eventsReturn;
  }
  public function retrieveById($id){

    $eventReturn = null;
    foreach ($this->events as $key => $value) {
      if($id == $value->getId()){

        $eventReturn = $value;
      }
    }
    return $eventReturn;
  }




  public function update($obj){

    $this->events = $_SESSION['events'];
    if(isset($this->events[$obj->getId()])){

      $this->events[$obj->getId()] = $obj;
    }

  }


  public function delete($id){

    $events = $_SESSION['events'];
    foreach ($this->events as $key => $value) {
      if($value->getId() == $id){
        unset($events[$key]);
        $_SESSION['events'] = $events;

      }
    }
  }

  public function getAll(){
    $this->events = $_SESSION['events'];
    return $this->events;
  }
}







?>
