<?php
namespace controller;

use Model\User as M_User;
use DAO\UserDb as D_User;

class ControllerLogin{
    private $daoUser;

    public function __construct(){
        $this->daoUser = D_User::getInstance();
        
    }
    public function index(){
        include(ROOT .'views/login.php');
    }

    public function login($email,$pass){
        
        if(empty($email)){
                $alert = "*Ingresa tu email";
                $this->index($alert);
        }
        else if(empty($pass)){
            $alert = "*no olvides ingresar la contraseña";
            $this->index($alert);
        }
        else{
            $usersArray = $this->daoUser->retrieveAll();
            
            $check = false;
            foreach ($usersArray as $key => $value) {
                if($value->getEmail() == $email){
                    if(password_verify($pass,$value->getPass())){               
                        $check = true;
                        if(session_status() != 2){
                            session_start();
                        }
                        $_SESSION['email'] = $email;
                        $_SESSION['pass'] = $pass;
                        //print_r($_SESSION);
                        // echo'entra a la vista equivocada';
                        if($isAdmin){
                            $userArray = $this->daoUser->retrieveAll();
                            include(ROOT.'views/admin.php'); //ver el nombre de la vista admin
                        }
                        else{
                            include(ROOT.'views/client.php');//ver nombre de vista clientes
                        }
                        
                    }
                }
            }
            if(!$check){
                $alert = '*Los datos ingresados son incorrectos';
                $this->index($alert);
            }            
        }
    }}