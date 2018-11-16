<?php
namespace config;

class Autoload
{
  public static function Start(){

    spl_autoload_register(function($instance){
      //  print_r($instance.'<br>');
      $route=ROOT.strtolower(str_replace("\\","/",$instance)).".php";
      include_once($route);
      //  print_r($route.'<br>');
      //print_r($instance);
    });
  }
}
?>
