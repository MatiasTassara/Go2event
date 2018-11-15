<?php
namespace controller;

use Model\Artist as M_Artist;
//use DAO\ListArtist as D_Artist;
use DAO\ArtistDb as D_Artist;

class ControllerArtist{
  private $daoArtist;

  public function __construct(){

    $this->daoArtist = D_Artist::getInstance();

  }
  function index(){
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
      $artists = $this->daoArtist->getAll();
    include(ROOT.'views/artists.php');
    }else include(ROOT.'views/index.php');
  }

  function addArtist($name, $desc = ''){
    $objArtist = new M_Artist($name, $desc);
    $this->daoArtist->add($objArtist);
    $this->index();


  }
  public function modifyArtist($id,$name, $desc) {

    $obj = $this->daoArtist->retrieveById($id);

    $obj->setName($name);
    $obj->setDesc($desc);

    $this->daoArtist->update($obj);
    $this->index();
  }

  public function deleteArtist($idArtist) {
    $this->daoArtist->delete($idArtist);
    $this->index();
  }

}



 ?>
