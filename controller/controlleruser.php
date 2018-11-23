<?php
namespace controller;

use Model\User as M_User;
use Dao\db\UserDb as D_User;
use Dao\db\RoleDb as D_Role;

class ControllerUser{
  private $daoUser;
  private $daoRole;

  public function __construct(){
    $this->daoUser = D_User::getInstance();
    $this->daoRole = D_Role::getInstance();
  }

  public function index(){
    if(isset($_SESSION["user"]) && $_SESSION["user"]->isAdmin() == 1)
		{
      $users = $this->daoUser->getAll();
      include(ROOT.'views/users.php');
    }
    else{
      include(ROOT.'views/index.php');
    }
  }

  public function addAdmin($id)
  {
    $user = $this->daoUser->retrieveById($id);
    $user->setRole($this->daoRole->retrieveById(1));
    $this->daoUser->update($user);
    $this->index();
  }
  public function unsuscribe($id)
  {
    $user = $this->daoUser->retrieveById($id);
    $user->setRole($this->daoRole->retrieveById(3));
    $this->daoUser->update($user);
    $this->index();
  }

}
