<?php
namespace controller;

use Controller\ControllerHome as C_Home;
use Model\Artist as M_Artist;
//use Dao\db\ListArtist as D_Artist;
use Dao\db\ArtistDb as D_Artist;

class ControllerArtist{
  private $daoArtist;
  private $cHome;

  public function __construct(){

    $this->daoArtist = D_Artist::getInstance();
    $this->cHome = new C_Home();

  }
  function index(){
    if(isset($_SESSION["user"]) && $_SESSION["user"]->isAdmin() == 1)
    {
      $artists = $this->daoArtist->getAll();
      include(ROOT.'views/artists.php');
    }
    else {
      $this->cHome->index();
    }
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
    try{
    $this->daoArtist->delete($idArtist);
    }
    catch (\PDOException $exe){
      if($exe->getCode() == 23000){
        $crashToView = "Imposible borrar un artista que posea fechas cargadas";
      }
      else {
        $crashToView = "Hubo un error en la base de datos. Error = ".$exe->getCode();
      }
    }
    $this->index();
  }

}



?>
