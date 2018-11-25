<?php
namespace controller;
use Model\User as M_User;
use Dao\db\UserDb as D_User;
use Controller\ControllerHome as C_Home;
use Model\Purchase as M_Purchase;
use Dao\db\PurchaseDb as D_Purchase;
class ControllerLogin extends ControllerArtist{

  private $daoUser;
  private $cHome;

  public function __construct(){
    $this->daoUser = D_User::getInstance();
    $this->daoPurchase = D_Purchase::getInstance();
    $this->cHome = new C_Home();
  }
  public function index($alert = null){

    include(ROOT .'views/login-register.php');
  }
  public function login($email,$pass){
      $user = $this->daoUser->retrieveByEmail($email);
      if($user != NULL){
            if(password_verify($pass,$user->getPass())){
                session_destroy();
                session_start();
                $_SESSION['user'] = $user;
                $date = getDate();
                $purchase = new M_Purchase($date,$user);
                $_SESSION['purchase'] = $purchase;
                $_SESSION['purchaseItems'] = array(); 
                $this->cHome->index();
              }else $this->index("Contraseña incorrecta");
      }else $this->index("Usuario inexistente");
  }



  public function logout(){
    session_unset();
    session_destroy();
    $this->cHome->index();
    }

}
