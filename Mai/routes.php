<?php

$controller = ucwords($controller);
$action = ucwords($action);
$checkexist = array(
    'Home' => ['Index', 'Error', 'Login','AddCart', 'DelItemCart', 'UpdateCart', 'CheckOut', 'Thanhtoan'],
    'Profile' => ['Index','Update','SignIn', 'SignUp', 'SignOut','NextOrders','OrderDetail'],
    'Product' => ['ProductById','Index', 'GetById', 'LoadToEdit', 'AddProduct','AddType','FilterByType', 'DeleteProduct','Update', 'FilterByTypeHome','SearchProduct']
);
if (!array_key_exists($controller, $checkexist) || !in_array($action, $checkexist[$controller])) {
    $controller = "Home";
    $action = "Error";
}
$file = "Controllers/" . $controller . "_Controller.php";
require_once $file;
$temp = new $controller;
$temp->$action();
