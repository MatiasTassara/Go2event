<?php
namespace controller;

use Model\Role as M_Role;
use Model\User as M_User;
use Dao\db\UserDb as D_User;

class ControllerSignUp{
  private $daoUser;
  public function __construct(){
    $this->daoUser = D_User::getInstance();

  }
  public function index(){
    include(ROOT.'views/login-register.php');
  }
  public function addUser($mail,$pass,$name,$surname){
    $hashedPass = password_hash($pass,PASSWORD_BCRYPT);
    $objUser = new M_User($mail,$name,$surname,$hashedPass);
    $this->daoUser->add($objUser);
    include(ROOT.'views/login-register.php');
  }
  public function addAdmin($mail,$pass,$name,$surname){
    $hashedPass = password_hash($pass,PASSWORD_BCRYPT);
    $objUser = new M_User($mail,$name,$surname,$hashedPass);
    $this->daoUser->add($objUser);
    include(ROOT.'views/Artist.php');
  }
  public function modifyUser($id,$name){
    //echo "<br>id = $id y name= $name<br>"; //borrable
    $obj = $this->daoUser->retrieveById($id);
    $obj->setName($name);
    $this->daoUser->update($obj);
    $this->index();
  }
  public function deleteUser($id){
    $this->daoUser->delete($id);
    $this->index();
  }
}
