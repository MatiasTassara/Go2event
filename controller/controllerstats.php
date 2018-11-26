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
        include(ROOT.'views/stats.php');
    }

    public function getAmounts($from,$to){

        
        $seats = $this->daoSeat->retrieveSeatsByDate($from,$to);
        //echo "<pre>";
        //var_dump($seats);
        
        $totalBilled = 0;
        $totalSold = 0;
        foreach ($seats as $key => $value) {
            echo "para este seat quantity: ".$value->getQuantity()." , remaining: ".$value->getRemaining()." y price: ".$value->getPrice();
            $totalSold += ($value->getQuantity() - $value->getRemaining());
            $totalBilled += ($value->getQuantity() - $value->getRemaining()) * $value->getPrice();
        }
        echo "<pre> totalSold: $totalSold <br> totalBilled: $totalBilled";
        $stats = [];
        $stats[] = $totalSold;
        $stats[] = $totalBilled;
        $this->index();
    }
 

}
