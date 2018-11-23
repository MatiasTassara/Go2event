<?php
namespace dao\listt;

class ListArtist extends SingletonDAO implements \interfaces\Idao{

  private $artists;



  function __construct(){

    if(!isset($_SESSION['artists'])){
      $_SESSION['artists'] = array();

      $id = (isset($_SESSION['idsArtists'])) ? $_SESSION['idsArtists'] : 0;

      $_SESSION['idsArtists'] = $id;
    }
    $this->artists = $_SESSION['artists'];



  }

  public function add($obj){


    $check = true;
    $this->artists = $_SESSION['artists'];
    foreach ($this->artists as $key => $value) {
      if($value->getName() == $obj->getName()){
        $check = false;
      }
    }

    if($check){

      $id = $_SESSION['idsArtists'];
      $obj->setId(++$id);
      $_SESSION['idsArtists'] = $id;
      $this->artists[] = $obj;
      $_SESSION['artists'] = $this->artists;

    }
  }
  public function retrieveByName($name){

    $artistsReturn = null;
    foreach ($this->artists as $key => $value) {
      if($name === $value->getName()){
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
    foreach ($this->artists as $key => $value) {
      if($id === $value->getId()){

        $artistReturn = $value;
      }
    }
    return $artistReturn;
  }




  public function update($obj){

    $this->artists = $_SESSION['seattypes'];
    if(isset($this->artists[$obj->getId()])){

      $this->artists[$obj->getId()] = $obj;
    }

  }


  public function delete($id){

    $artists = $_SESSION['artists'];
    foreach ($this->seattypes as $key => $value) {
      if($value->getId() === $id){
        unset($artists[$key]);
        $_SESSION['artists'] = $artists;

      }
    }
  }

  public function getAll(){
    $this->artists = $_SESSION['artists'];
    return $this->artists;
  }
}


?>
