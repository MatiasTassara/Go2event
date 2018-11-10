<?php
namespace config;
define('ROOT', str_replace('\\','/',dirname(__DIR__) . "/"));
define('FRONT_ROOT', 'http://localhost/Go2Event/');

$base=explode($_SERVER['DOCUMENT_ROOT'],ROOT);
  define("BASE",$base[1]);
  define('DB_HOST',"localhost");
  define('DB_USER',"root");
  define('DB_PASS',"");
  define('DB_NAME',"go2event_db");
?>
