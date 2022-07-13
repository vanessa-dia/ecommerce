<?php

session_start();
if(!isset($_SESSION)){
  session_start();
}
if(!isset($_GET['url'])){
  $controller = 'home';
  $action = 'index';
}
else {
  $url = explode('/',rtrim($_GET['url'],'/'));
  $controller = $url[0];
  if(count($url) > 1){
    $action = $url[1];
  } else {
    $action = "index";
  }
}
require_once("routes.php");
?>