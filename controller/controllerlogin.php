<?php
namespace controller;
use Model\User as M_Client;
use Dao\db\UserDb as D_Client;
use Model\User as M_Admin;
use Dao\db\UserDb as D_Admin;
use Controller\ControllerHome as C_Home;
class ControllerLogin extends ControllerArtist{

  private $daoClient;
  private $daoAdmin;
  private $cHome;

  public function __construct(){
    $this->daoClient = D_Client::getInstance();
    $this->daoAdmin = D_Admin::getInstance();
    $this->cHome = new C_Home();
  }
  public function index(){
    include(ROOT .'views/login-register.php');
  }
  public function login($email,$pass){

      $user = $this->daoClient->retrieveByEmail($email);
      if($user == null)
      {
        $user = $this->daoAdmin->retrieveByEmail($email);
      }
      if($user != NULL){
            if(password_verify($pass,$user->getPass())){
                session_destroy();
                session_start();
                $_SESSION['Client'] = $user;
                $_SESSION['loggedin'] = true;
                $this->cHome->index();
              }
      }else $this->index();
  }



  public function logout(){
    session_unset();
    session_destroy();
    $this->cHome->index();
    }

}
