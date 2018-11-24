<?php
namespace controller;

use Controller\ControllerHome as C_Home;
use Model\Venue as M_Venue;
//use Dao\db\ListVenue as D_Venue;
use Dao\db\VenueDb as D_Venue;

class ControllerVenue{

  private $daoVenue;
    private $cHome;

  public function __construct(){
    $this->daoVenue = D_Venue::getInstance();
    $this->cHome = new C_Home();
  }

  public function index($alert = null){
    if(isset($_SESSION["user"]) && $_SESSION["user"]->isAdmin() == 1)
    {
      $venues = $this->daoVenue->getAll();
      include(ROOT.'views/venues.php');
    }else {
      $this->cHome->index("Usted no es un administrador");
    }
  }

  public function addVenue($name,$capacity,$city,$address){
    $venueToAdd = new M_Venue($name,$address,$city,$capacity);
    $this->daoVenue->add($venueToAdd);
    $this->index();

  }
  function modifyVenue($id,$name, $address,$city,$capacity) {

    $obj = $this->daoVenue->retrieveById($id);

    $obj->setName($name);
    $obj->setDesc($address);
    $obj->setDesc($city);
    $obj->setDesc($capacity);

    $this->daoArtist->update($obj);
    $this->index();
  }

  function deleteVenue($idVenue) {
    $this->daoVenue->delete($idVenue);
    $this->index();
  }
}
?>
