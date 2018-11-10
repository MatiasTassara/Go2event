<?php
namespace dao;

class ListSeat extends SingletonDAO implements \interfaces\Idao{

    private $seats;

    public function __construct(){

        if(!isset($_SESSION['seats'])){
                  $_SESSION['seats'] = array();

                  $id = (isset($_SESSION['idsSeats'])) ? $_SESSION['idsSeats'] : 0;

                  $_SESSION['idsSeats'] = $id;
          }
          $this->seats = $_SESSION['seats'];

    }

    public function add($obj){

        $check = true;
        $this->seats = $_SESSION['seats'];
        foreach ($this->seats as $key => $value) {
          if($value->getName() == $obj->getName()){
              $check = false;
          }
        }
        if($check){

          $id = $_SESSION['idsSeats'];
          $obj->setId(++$id);
          $_SESSION['idsSeats'] = $id;
          $this->seats[] = $obj;
          $_SESSION['seats'] = $this->seats;

        }
    }

  
    public function retrieveById($id){

        $seatReturn = null;
        foreach ($this->seats as $key => $value) {
            if($id == $value->getId()){

                $seatReturn = $value;
            }
        }
        return $seatReturn;
    }

    public function retrieveSeats($ids){
        $seatsReturn = array();
        $seats = $_SESSION['seats'];
        foreach ($ids as $keyIds => $valueIds) {
            foreach ($seats as $keySeats => $valueSeats) {
                if($ids[$valueIds] == $valueSeats->getId()){
                    $seatsReturn[] = $valueSeats;
                }
            }
        }
        return $seatsReturn;
    }




    public function update($obj){

      $this->seats = $_SESSION['seats'];
      if(isset($this->seats[$obj->getId()])){

        $this->seats[$obj->getId()] = $obj;
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
