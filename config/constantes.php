<?php
namespace config;
define('ROOT', str_replace('\\','/',dirname(__DIR__) . "/"));
define('FRONT_ROOT', '/Go2Event/');

$base=explode($_SERVER['DOCUMENT_ROOT'],ROOT);
  define("BASE",$base[1]);
  define('HOST',"localhost");
  define('USER',"root");
  define('PASS',"");

  define('DB_HOST',"localhost");
  define('DB_USER',"root");
  define('DB_PASS',"");
  define('DB_NAME',"go2event_db");

  $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
  $urlToArray = explode("/", $url);
  $arrayUrl = array_filter($urlToArray);
  if(empty($arrayUrl)) {
      $controller = '';
  } else {
      $controller = array_shift($arrayUrl);
  }
  define("ACTIVE",$controller);


?>
