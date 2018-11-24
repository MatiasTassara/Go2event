<?php
namespace dao\listt;

class ListVenue extends SingletonDao implements \interfaces\Idao{

  private $venues;
  private static $id;

  public function __construct(){

    if(!isset($_SESSION['venues'])){
      $_SESSION['venues'] = array();

      $id = (isset($_SESSION['idsVenues'])) ? $_SESSION['idsVenues'] : 0;

      $_SESSION['idsVenues'] = $id;
    }
    $this->venues = $_SESSION['venues'];
  }

  public function add($obj){
    $check = true;
    foreach ($this->venues as $key => $value) {
      if($obj->getName() === $value->getName()){
        $check = false;
      }
    }
    if($check){
      $id = $_SESSION['idsVenues'];
      $obj->setId(++$id);
      $_SESSION['idsVenues'] = $id;
      $this->venues[] = $obj;
      $_SESSION['venues'] = $this->venues;

    }

  }
  public function retrieveByName($name){

    $venuesReturn = null;
    foreach ($this->venues as $key => $value) {
      if($name === $value->getName()){
        if($venuesReturn == null){

          $venuesReturn = array();
        }

        $venuesReturn[] = $value;
      }
    }
    return $venuesReturn;
  }
  public function retrieveById($id){

    $venueReturn = null;
    foreach ($this->venues as $key => $value) {
      if($id === $value->getId()){

        $venueReturn = $value;
      }
    }
    return $venueReturn;
  }


  public function update($obj){

    $venues = $_SESSION['venues'];
    if(isset($venues[$obj->getId()])){
      $venues[$obj->getId()] = $obj;
    }

  }


  public function delete($id){
    $venues = $_SESSION['venues'];
    foreach ($venues as $key => $value) {
      if($value->getId() ===  $id ){
        unset ($venues[$key]);
        $_SESSION['venues'] = $venues;
      }
    }
  }
  public function getAll(){
    $this->venues = $_SESSION['venues'];
    return $this->venues;
  }
}


?>
