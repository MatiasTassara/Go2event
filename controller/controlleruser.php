<?php
namespace controller;

use Model\User as M_User;
use Dao\db\UserDb as D_User;
use Dao\db\RoleDb as D_Role;
use Model\Ticket as M_Ticket;
use Dao\db\TicketDb as D_Ticket;
use Model\Seat as M_Seat;
use Dao\db\SeatDb as D_Seat;
use Model\Purchase as M_Purchase;
use Dao\db\PurchaseDb as D_Purchase;
use Model\PurchaseItem as M_PurchaseItem;
use Dao\db\PurchaseItemDb as D_PurchaseItem;


class ControllerUser{
  private $daoUser;
  private $daoRole;
  private $daoTicket;
  private $daoSeat;
  private $daoPurchase;
  private $daoPurchaseItem;


  public function __construct(){
    $this->daoUser = D_User::getInstance();
    $this->daoRole = D_Role::getInstance();
    $this->daoTicket = D_Ticket::getInstance();
    $this->daoSeat = D_Seat::getInstance();
    $this->daoPurchase = D_Purchase::getInstance();
    $this->daoPurchaseItem = D_PurchaseItem::getInstance();
    $this->daoTicket = D_Ticket::getInstance();


  }

  public function index($alert = null){
    if(isset($_SESSION["user"]) && $_SESSION["user"]->isAdmin() == 1){
      $users = $this->daoUser->getAll();
      include(ROOT.'views/users.php');
    }
    else{
      $this->cHome->index("Usted no es un administrador");
    }
  }

  public function makeAdmin($id){
    $user = $this->daoUser->retrieveById($id);
    $user->setRole($this->daoRole->retrieveById(1));
    $this->daoUser->update($user);
    $this->index();
  }
  public function makeClient($id){
    $user = $this->daoUser->retrieveById($id);
    $user->setRole($this->daoRole->retrieveById(2));
    $this->daoUser->update($user);
    $this->index();
  }
  public function unsuscribe($id){
    $user = $this->daoUser->retrieveById($id);
    $user->setRole($this->daoRole->retrieveById(3));
    $this->daoUser->update($user);
    $this->index();
  }

  public function showProfile(){
    $user = $_SESSION['user'];
    /* (Yendo a contracorriente del modelo) desde el usuario vamos a obtener: 
                                                                            ArrFecha de la compra @Purchase
                                                                            ArrNombre del evento @Calendar                                    
                                                                            ArrFecha del evento @Calendar
                                                                            ArrNombre del seattype @seatType
                                                                            ArrPrecio del Seat @seat
                                                                            ArrQrPath generado 

    */
    // Vamos desde Users hasta Tickets y Seats cargando los arreglos necesarios
    $purchArray = $this->daoPurchase->retrieveByUser($user->getMail());
    $purchaseItems = [];
    foreach ($purchArray as $key => $value) {
      $idPurchase = $value->getId();
      $purchaseItems[] = $this->daoPurchaseItem->retrieveByPurchaseId($idPurchase);
    }
    $seats = [];
    $tickets = [];
    foreach ($purchaseItems as $key => $value) {
      $seats[] = $value->getSeat;
      $idPurchaseItem = $value->getId();
      foreach ($value as $key => $value) {
        $tickets[] = $this->daoTicket->retrieveByPurchaseItemId($idPurchaseItem);
      }
    }

    // Armamos array con todo lo que le queremos pasar a la vista
    $arrProfileInfo = array('purchaseDates','eventNames','eventDates','seatTypes','pricesImg','qrPaths');       
    foreach ($tickets as $key => $value) {
      $arrProfileInfo['purchaseDates'][] = $value->getPurchaseItem()->getPurchase()->getDate();
      $arrProfileInfo['eventNames'][] = $value->getPurchaseItem()->getSeat()->getCalendar()->getEvent()->getName();
      $arrProfileInfo['eventDates'][] = $value->getPurchaseItem()->getSeat()->getCalendar()->getEvent()->getDate();
      $arrProfileInfo['seatTypes'][] = $value->getPurchaseItem()->getSeat()->getSeattype()->getName();
      $arrProfileInfo['prices'][] = $value->getPurchaseItem()->getSeat()->getPrice();
      $arrProfileInfo['qrImgPaths'][] = ROOT."images/tempQR/tempQR-".$key;
      QRcode::png($value->getQr(),ROOT."images/tempQR/tempQR-".$key);
    }

  }

}
