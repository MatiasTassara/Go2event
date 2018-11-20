<?php
namespace controller;
use Model\User as M_User;
use Dao\db\UserDb as D_User;
use Controller\ControllerHome as C_Home;
class ControllerLogin extends ControllerArtist{

  private $daoUser;
  private $cHome;

  public function __construct(){
    $this->daoUser = D_User::getInstance();
    $this->cHome = new C_Home();
  }
  public function index(){
    include(ROOT .'views/login-register.php');
  }
  public function login($email,$pass){
      $user = $this->daoUser->retrieveByEmail($email);
      if($user != NULL){
            if(password_verify($pass,$user->getPass())){
                session_destroy();
                session_start();
                $_SESSION['user'] = $user;
                $this->cHome->index(); 
              }else $this->index();
      }else $this->index();
  }



  public function logout(){
    session_unset();
    session_destroy();
    $this->cHome->index();
    }

}
