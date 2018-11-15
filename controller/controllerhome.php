<?php
namespace controller;

class  ControllerHome{

  public function index(){
    //session_destroy(); //para limpiar session
    include(ROOT.'views/index.php');
  }

  public function login(){
    include(ROOT.'views/login-register.php');
  }


}


 ?>
