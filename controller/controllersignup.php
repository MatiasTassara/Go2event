<?php
namespace controller;

use Model\User as M_User;
use Dao\db\ClientDb as D_Client;

class ControllerSignUp{
  private $daoClient;
  public function __construct(){
    $this->daoClient = D_Client::getInstance();

  }
  public function index(){
    include(ROOT.'views/login-register.php');
  }
  public function addUser($mail,$pass,$name,$surname){
    $hashedPass = password_hash($pass,PASSWORD_BCRYPT);
    $objClient = new M_User($mail,$name,$surname,$hashedPass,$isAdmin = false);
    $this->daoClient->add($objClient);
    include(ROOT.'views/login-register.php');
  }
  public function addAdmin($mail,$pass,$name,$surname){
    $hashedPass = password_hash($pass,PASSWORD_BCRYPT);
    $objClient = new M_User($mail,$name,$surname,$hashedPass,$isAdmin = true);
    $this->daoClient->add($objClient);
    include(ROOT.'views/Artist.php');
  }
  public function modifyUser($id,$name){
    //echo "<br>id = $id y name= $name<br>"; //borrable
    $obj = $this->daoClient->retrieveById($id);
    $obj->setName($name);
    $this->daoClient->update($obj);
    $this->index();
  }
  public function deleteUser($id){
    $this->daoClient->delete($id);
    $this->index();
  }
}
