<?php
namespace controller;

use Model\Seat as M_Seat;
use Dao\db\SeatDb as D_Seat;
use Model\Purchase as M_Purchase;
use Dao\db\PurchaseDb as D_Purchase;
use Model\PurchaseItem as M_PurchaseItem;
use Dao\db\PurchaseItemDb as D_PurchaseItem;
use Controller\ControllerHome as C_Home;




class ControllerPurchase{
    private $daoSeat;
    private $daoPurchase;
    private $daoPurchaseItem;
    private $controllerHome;

    public function __construct(){
        $this->daoSeat = D_Seat::getInstance();
        $this->daoPurchase = D_Purchase::getInstance();
        $this->daoPurchaseItem = D_PurchaseItem::getInstance();
        $this->controllerHome = new C_Home();
    }

    public function index(){
        include(ROOT.'views/cart.php');
    }
/*
    public function addToCart($arrQuant,$arrIdsSeats){
        $i = 0;
        $everythingOk = true;
        // Chequea que la cantidad total de asientos este disponible para ese Calendar
        while ($i < count($arrIdsSeats) && $everythingOk) {
            $seat = $this->daoSeat->retrieveById($arrIdsSeats[$i]);
            if($arrQuant[$i] > $seat->getRemaining()){
                $everythingOk = false;
            }
        }
        if($everythingOk){
            // Creamos la compra y luego las lineas de compra
            
            $purchase = $_SESSION['purchase']; 
            while ($i < count($arrIdsSeats)) {
                $seat = $this->daoSeat->retrieveById($arrIdsSeats[i]);
                $purchaseItem = new M_PurchaseItem($value,$seat->getPrice(),$purchase);
                $_SESSION['purchaseItem'][] = $purchaseItem;
                $i++;
            }
           
        }
        if(!$everythingOk){
            $errorMessage = "No hay disponibilidad para la cantidad entradas ingresada";
        }else{
            var_dump($_SESSION);
            $this->index();
        }
    }*/

    public function addToCart($idSeat,$quant){
         // Chequea que la cantidad total de asientos este disponible para ese Calendar
        
            $seat = $this->daoSeat->retrieveById($idSeat);
            if($quant <= $seat->getRemaining()){
                
                $purchase = $_SESSION['purchase']; 
                $purchaseItem = new M_PurchaseItem($quant,($seat->getPrice() * $quant),$purchase,$seat);
                $_SESSION['purchaseItems'][] = $purchaseItem;
                
                $this->index();
            }
            else{
                $alert = "No hay disponibilidad para la cantidad entradas ingresada";
                $this->controllerHome->index($alert);
            }
    }

    public function removeFromCart($itemKey){
        print_r($_SESSION['purchaseItems'][$itemKey]);
        //unset($_SESSION['purchaseItems'][$itemKey]);
        //$this->index();
    }


    //cuando se efectue la compra hacer unset de session[purchase] y session[purchaseitem]
    public function placeOrder($nameAsOnCard,$expirationDate,$cardNumber,$securityCode){
        //parametros extra para a futuro usar api de tarjeta de credito
      
        $purchase = $_SESSION['purchase'];
        $purchaseItems[] = $_SESSION['purchaseItems'];
        if(is_valid_luhn($cardNumber) == true){
            $this->daoPurchase->add($purchase);
            foreach ($purchaseItems as $key => $value) {
                $this->$daoPurchaseItem->add($value);
               //actualizamos el remaining del seat para cada plaza segun cantidad de entradas por linea
                $seat = $this->daoSeat->retrieveById($value->getSeat()->getId());
                $seat->setRemaining($seat->getRemaining() - $value->getQuantity());
                $this->daoSeat->update($seat); 
            }
            unset($_SESSION['purchase']);
            unset($_SESSION['purchaseItems']);
        }
    }
    


    private function is_valid_luhn($number) {
        settype($number, 'string');
        $sumTable = array(
          array(0,1,2,3,4,5,6,7,8,9),
          array(0,2,4,6,8,1,3,5,7,9));
        $sum = 0;
        $flip = 0;
        for ($i = strlen($number) - 1; $i >= 0; $i--) {
          $sum += $sumTable[$flip++ & 0x1][$number[$i]];
        }
        return $sum % 10 == 0;
    }
    private function sendMail($mail){
        $from = '<matiastassara59@gmail.com>';
        $to      = $mail;
        $subject = '¡Gracias por comprar en GoToEvent!';
        $msg = "Hola, como estas? aca estan el/los codigos QR";
        
        $headers = array(
            'From' => $from,
            'To' => $to,
            'Subject' => $subject
        );

        $smtp = Mail::factory('smtp', array(
                'host' => 'ssl://smtp.gmail.com',
                'port' => '465',
                'auth' => true,
                'username' => 'johndoe@gmail.com',
                'password' => 'iuy34WEFsef_=-'
            ));

        $mail = $smtp->send($to, $headers, $msg);

        if (PEAR::isError($mail)) {
            echo('<p>' . $mail->getMessage() . '</p>');
        } else {
            echo('<p>Message successfully sent!</p>');
        }
    }

    
}