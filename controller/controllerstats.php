<?php
namespace controller;

use Model\Seat as M_Seat;
use Dao\db\SeatDb as D_Seat; 

class ControllerStats{

    private $daoSeat;

    public function __construct(){
        $this->daoSeat = D_Seat::getInstance();
    }

    public function index(){
        include(ROOT.'views/stats');
    }

    public function getAmountBilled

}
