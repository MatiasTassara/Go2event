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

    public function getAmounts($from,$to){

        $seats = $this->daoSeat->retrieveSeatsByDate($from,$to);
        $totalBilled = 0;
        $totalSold = 0;
        foreach ($seats as $key => $value) {
            $totalSold += ($value->getQuantity() - $value->getRemaining());
            $totalBilled += ($value->getQuantity() - $value->getRemaining()) * $value->getPrice();
        }
        $this->index();
    }
 

}
