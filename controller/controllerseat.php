<?php
namespace controller;

use Model\Seat as M_Seat;
//use DAO\ListSeat as D_Seat;
use DAO\SeatDb as D_Seat;

class ControllerSeat{
  private $daoSeat;

  public function __construct(){

    $this->daoSeat = D_Seat::getInstance();

  }
  function index(){
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
      $seats = $this->daoSeats->getAll();
      include(ROOT.'views/seats.php');
    }else include(ROOT.'views/index.php');
  }

  function addSeats($quant, $price, $remaining, $seatType,$calendar){
    $objSeat = new M_Seat($quant, $price,$remaining,$seatType,$calendar);
    $this->daoSeat->add($objSeat);
    $this->index();
    }



}
