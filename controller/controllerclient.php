<?php
namespace controller;

use Model\User as M_User;
use DAO\UserDb as D_User;

class ControllerClient{
  private $daoUser;

  public function __construct(){
    $this->daoUser = D_User::getInstance();
  }

  public function index(){
    if(session_status() != 2){
      $this->daoUser->retrieveByname($_SESSION['user']);
      include(ROOT.'views/client.php');
    }
    else{
      include(ROOT.'views/login.php');
    }
  }

  public function modifyUser($mail,$name,$surname,$pass,$newPass){
    $obj = $this->daoUser->retrieveById($id);
    if(password_verify($pass,$value->getPass())){
      $obj->setName($name);
      $obj->setSurname($surname);
      if($newPass != ""){ //ver como llega cuando la contreaseña nueva no se completa (queda la anterior)
        $hashedPass = password_hash($newPass,PASSWORD_BCRYPT);
        $obj->setPass($hashedPass);
      }
      $this->daoUser->update($obj);
    }else{
      //     arning contraseña incorrecta
    }
    $this->index();
  }
  public function deleteUser($id){
    $this->daoUser->delete($id);
    $this->index();
  }


}
