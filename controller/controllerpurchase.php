<?php
namespace controller;

use Model\Seat as M_Seat;
use Dao\db\SeatDb as D_Seat;
use Model\Purchase as M_Purchase;
use Dao\db\PurchaseDb as D_Purchase;
use Model\PurchaseItem as M_PurchaseItem;
use Dao\db\PurchaseItemDb as D_PurchaseItem;




class ControllerPurchase{
    private $daoSeat;
    private $daoPurchase;
    private $daoPurchaseItem;

    public function __construct(){
        $this->daoSeat = D_Seat::getInstance();
        $this->daoPurchase = D_Purchase::getInstance();
        $this->daoPurchaseItem = D_PurchaseItem::getInstance();
    }

    public function index(){
        include(ROOT.'views/cart.php');
    }

    public function addToCart($arrQuant,$arrIdsSeats){
        $i = 0;
        $everythingOk = true;
        // Chequea que la cantidad total de asientos este disponible para ese Calendar
        while ($i < count($arrIdsSeats) && $everythingOk) {
            $seat = $this->daoSeat->retrieveById($arrIdsSeats[i]);
            if($arrQuant[i] > $seat->getRemaining()){
                $everythingOk = false;
            }
        }
        if($everythingOk){
            // Creamos la compra y luego las lineas de compra
            $user = $_SESSION['user'];
            $date = $getDate();
            $purchase = new M_Purchase($date,$user);
            $_SESSION['purchase'] = $purchase; 
            while ($i < count($arrIdsSeats)) {
                $seat = $this->daoSeat->retrieveById($arrIdsSeats[i]);
                $purchaseItem = new M_PurchaseItem($value,$seat->getPrice(),$purchase);
                $_SESSION['purchaseItem'][$i] = $purchaseItem;
            }
        }
        if(!$everythingOk){
            $errorMessage = "No hay disponibilidad para la cantidad entradas ingresada";
        }else{
            $this->index();
        }
    }

}