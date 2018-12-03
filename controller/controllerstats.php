<?php
namespace controller;

use Dao\db\CategoryDb as D_Category;
use Dao\db\EventDb as D_Event;
use Dao\db\TicketDb as D_Ticket;

class ControllerStats{

    private $daoCategories;
    private $daoEvent;
    private $daoTicket;

    public function __construct(){
        $this->daoCategories = D_Category::getInstance();
        $this->daoEvent = D_Event::getInstance();
        $this->daoTicket = D_Ticket::getInstance();
    }

    public function index(){

        $moreMoney = $this->daoEvent->rankingMostMoneyEarned();
        $lessMoney = $this->daoEvent->rankingLessMoneyEarned();
        $categories = $this->daoCategories->moneyEarnedPerCategory();
        $totalSold = $this->daoTicket->getTotalTickets();
        $totalBilled = array_sum($categories['total']);
      /*  echo "<pre>";
        var_dump($lessMoney);
        var_dump($moreMoney);
        die;*/
        include(ROOT.'views/stats.php');
    }

    public function getAmounts(){

        $seats = $this->daoSeat->retrieveSeatsByDate($from,$to);
        $totalBilled = 0;
        $totalSold = 0;
        foreach ($seats as $key => $value) {
            echo "para este seat quantity: ".$value->getQuantity()." , remaining: ".$value->getRemaining()." y price: ".$value->getPrice();
            $totalSold += ($value->getQuantity() - $value->getRemaining());
            $totalBilled += ($value->getQuantity() - $value->getRemaining()) * $value->getPrice();
        }
        echo " totalSold: $totalSold <br> totalBilled: $totalBilled";

        $this->index($stats);
    }


}
