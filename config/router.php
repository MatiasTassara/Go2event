<?php
namespace config;
class Router {
  /**
  * Se encarga de direccionar a la pagina solicitada
  * @param Request
  */
  public function __construct(){

  }
  public static function direct (Request $request){

    $controller = "Controller".$request->getController();
    $method = $request->getMethod();
    $params = $request->getParams();


    $obj = "Controller\\". $controller;
    $controller = new $obj();


    if(!isset($params)){
      call_user_func(array($controller, $method));
    } else{
      call_user_func_array(array($controller, $method),$params);
    }
  }
}
?>
