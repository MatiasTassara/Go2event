<?php
namespace controller;

use Model\Event as M_Event;
//use DAO\ListEvent as D_Event;
use DAO\EventDb as D_Event;
use Model\Category as M_Category;
//use DAO\ListCategory as D_Category;
use DAO\CategoryDb as D_Category;


class controllerEvent{

    private $daoEvent;
    private $daoCategory;

    public function __construct(){
        $this->daoEvent = D_Event::getInstance();
        $this->daoCategory = D_Category::getInstance();
    }

    public function index(){
    $events = $this->daoEvent->getAll();

    $categories = $this->daoCategory->getAll();
    include(ROOT.'views/events.php'); //ver nombre de la vista
    }



    public function addEvent($name,$idCategory,$desc,$imgRoute){
        $objCategory = $this->daoCategory->retrieveById($idCategory);
        $objEvent = new M_Event($name,$desc,$imgRoute,$objCategory);

        $this->daoEvent->add($objEvent);
        $this->index();
    }

    function modifyEvent($id,$name,$imgRoute,$category) {

        $obj = $this->daoEvent->retrieveById($id);

        $obj->setName($name);
        $obj->setDesc($imgRoute);
        $obj->setCategory($category);
        $this->daoEvent->update($obj);
        $this->index();
      }

      function deleteEvent($idEvent) {
        $this->daoEvent->delete($idEvent);
        $this->index();
      }

}


?>
