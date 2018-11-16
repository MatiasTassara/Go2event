<?php
namespace dao;

/**
*
*/
class ListSeatType extends SingletonDAO implements \interfaces\Idao{

  private $seattypes;
  private static $id;

  function __construct(){
    if(!isset($_SESSION['seattypes'])){
      $_SESSION['seattypes'] = array();

      $id = (isset($_SESSION['idsSeattypes'])) ? $_SESSION['idsSeattypes'] : 0;

      $_SESSION['idsSeattypes'] = $id;
    }
    $this->seattypes = $_SESSION['seattypes'];


  }
  /* La funcion add lo que hace es agregar si no
  existe y si existe ese nombre de seattype no lo agrega
  */
  public function add($obj){


    $check = true;
    $this->seattypes = $_SESSION['seattypes'];
    foreach ($this->seattypes as $key => $value) {
      if($value->getName() == $obj->getName()){
        $check = false;
      }
    }

    if($check){
      $id = $_SESSION['idsSeattypes'];
      $obj->setId(++$id);
      $_SESSION['idsSeattypes'] = $id;
      $this->seattypes[] = $obj;
      $_SESSION['seattypes'] = $this->seattypes;
    }
  }

  public function retrieveByName($name){

    $seatTypesReturn = null;
    foreach ($this->seattypes as $key => $value) {
      if($name === $value->getName()){
        if($seatTypesReturn == null){

          $seatTypesReturn = array();
        }

        $seatTypesReturn[] = $value;
      }
    }
    return $seatTypesReturn;
  }
  public function retrieveById($id){

    $seatTypeReturn = null;
    foreach ($this->seattypes as $key => $value) {
      if($id === $value->getId()){

        $seatTypeReturn = $value;
      }
    }
    return $seatTypeReturn;
  }

  public function update($obj){

    $seattypes = $_SESSION['seattypes'];
    if(isset($seattypes[$obj->getId()])){

      $seattypes[$obj->getId()] = $obj;
    }

  }




  public function delete($id){

    $seattypes = $_SESSION['seattypes'];
    foreach ($this->seattypes as $key => $value) {
      if($value->getId() === $id){
        unset($seattypes[$key]);
        $_SESSION['seattypes'] = $seattypes;

      }
    }
  }


  public function getAll(){
    $this->seattypes = $_SESSION['seattypes'];
    return $this->seattypes;
  }
}



?>
