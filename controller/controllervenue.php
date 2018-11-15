<?php
namespace controller;

use Model\Venue as M_Venue;
//use DAO\ListVenue as D_Venue;
use DAO\VenueDb as D_Venue;

class ControllerVenue{

    private $daoVenue;

    public function __construct(){
        $this->daoVenue = D_Venue::getInstance();
    }

    public function index(){
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            $venues = $this->daoVenue->getAll();
            include(ROOT.'views/venues.php');
        }else include(ROOT.'views/index.php');
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
