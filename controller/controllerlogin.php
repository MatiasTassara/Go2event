<?php
namespace controller;

use Model\User as M_User;
use DAO\UserDb as D_User;

class ControllerLogin extends ControllerArtist{
    
    private $daoUser;

    public function __construct(){
        $this->daoUser = D_User::getInstance();
    }

    public function index(){
        include(ROOT .'views/login-register.php');
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
            $usersArray = $this->daoUser->getAll();
            $check = false;
            if($usersArray != NULL){
                foreach ($usersArray as $key => $value) {
                    if($value->getEmail() == $email){
                        if(password_verify($pass,$value->getPass())){               
                            $check = true;
                            if(session_status() != 2){
                                session_start();
                            }
                            $_SESSION['loggedin'] = true;
                            $_SESSION['email'] = $email;
                            $_SESSION['name'] = $value->getName();
                            $_SESSION['surname'] = $value->getSurname();
                            $_SESSION['pass'] = $pass;
                            $_SESSION['isAdmin'] = $value->getIsAdmin();  // esto me parece absolutamente inseguro, creo que seria mejor usar la contraseña para verificar
                            $_SESSION['id']= $value->getId();            // armé un stored procedure que te dice si es o no admin segun el hash de la contraseña
                                                                           // preguntarle a maru si podria accederse a ese valor devuelto. El procedure es  call isAdmin(IN hashedPass, OUT isAdmin)
                            include(ROOT.'views/index.php');                            
                        }
                    }
                }
            }else echo "<br> Puede que no haya usuarios cargados en la base de datos, or maybe you just fucked it up somewhere";
            if(!$check){
                $alert = '*Los datos ingresados son incorrectos';
                $this->index($alert);
            }            
        }
    }
    
    public function logout(){
        session_unset();
        session_destroy();
    }
}
