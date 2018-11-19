<?php
namespace controller;

use Model\Seat as M_Seat;
//use Dao\db\ListSeat as D_Seat;
use Dao\db\SeatDb as D_Seat;

class ControllerSeat{
  private $daoSeat;

  public function __construct(){

    $this->daoSeat = D_Seat::getInstance();

  }
  function index(){
    $seats = $this->daoSeats->getAll();
    include(ROOT.'views/seats.php');
  }

  function addSeats($quant, $price, $remaining, $seatType,$calendar){
    $objSeat = new M_Seat($quant, $price,$remaining,$seatType,$calendar);
    $this->daoSeat->add($objSeat);
    $this->index();
  }



}
