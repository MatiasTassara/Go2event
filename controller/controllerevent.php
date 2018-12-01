<?php
namespace controller;

use Controller\ControllerHome as C_Home;
use Model\Event as M_Event;
//use Dao\listt\ListEvent as D_Event;
use Dao\db\EventDb as D_Event;
use Model\Category as M_Category;

use Dao\db\CategoryDb as D_Category;


class controllerEvent{

  private $daoEvent;
  private $daoCategory;
  private $cHome;

  public function __construct(){
    $this->daoEvent = D_Event::getInstance();
    $this->daoCategory = D_Category::getInstance();
    $this->cHome = new C_Home();

  }

  public function index($alert = null){
    if(isset($_SESSION["user"]) && $_SESSION["user"]->isAdmin() == 1)
    {
      $events = $this->daoEvent->getAll();
      $categories = $this->daoCategory->getAll();
      include(ROOT.'views/events.php'); 
    }else {
      $this->cHome->index("Usted no es un administrador");
    }
  }



  public function addEvent($name,$idCategory,$desc, $fileTopload){
    $imgRoute = basename($_FILES["fileToUpload"]["name"]);

    $objCategory = $this->daoCategory->retrieveById($idCategory);
    $objEvent = new M_Event($name,$desc,$imgRoute,$objCategory);

    $fileController = new ControllerFile();
    $this->daoEvent->add($objEvent);
    $fileController->upload($objEvent->getImgPath(), 'images');

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
    if($this->daoEvent->eventHasTicket($idEvent)){
      $this->daoEvent->delete($idEvent);
      $this->index('Atención! Se borró un evento para el cual habia entradas vendidas');
    }else if($this->daoEvent->eventHasCalendar($idEvent)){
        $this->daoEvent->delete($idEvent);
        $this->index('Atención! Se borró un evento sin entrdas vendidas pero con fechas cargadas');
    }else{
      $this->daoEvent->delete($idEvent);
      $this->index('El evento se borró exitosamente');
    }
  }
}


?>
