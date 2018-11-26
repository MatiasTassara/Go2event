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


class ControllerProfile{
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
    if(isset($_SESSION["user"])){
      $this->showProfile();

    }
    else{
      $this->cHome->index("Usted no esta logueado");
    }
  }

  public function showProfile(){
    $user = $_SESSION['user'];
    $tickets = $this->daoTicket->retrieveTicketsByIdUser($user->getId());
    // Armamos array con todo lo que le queremos pasar a la vista

    foreach ($tickets as $key => $value) {
      $arrProfileInfo['purchaseDates'] = $value->getPurchaseItem()->getPurchase()->getDate();
      $arrProfileInfo['eventNames'] = $value->getPurchaseItem()->getSeat()->getCalendar()->getEvent()->getName();
      $arrProfileInfo['eventDates'] = $value->getPurchaseItem()->getSeat()->getCalendar()->getDateFront();
      $arrProfileInfo['seatTypes'] = $value->getPurchaseItem()->getSeat()->getSeattype()->getName();
      $arrProfileInfo['prices']= $value->getPurchaseItem()->getSeat()->getPrice();
      $arrProfileInfo['qrImgPaths'] = 0;
      $arrayTickets[] = $arrProfileInfo;//ROOT."images/tempQR/tempQR-".$key;
      QRcode::png($value->getQr(),ROOT."images/tempQR/tempQR-".$key);
    }
    include(ROOT.'views/profile.php');
  }


}
?>
