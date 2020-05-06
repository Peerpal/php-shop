<?php

include_once "config/init.php";
require_once "database/connector.php";
require_once "entities/Order.php";

session_start();

// initialize the view
$view = new View('views/orders.php');

$view->orders = new OrderController();


include_once 'views/layouts/header.php';
echo $view;
include_once 'views/layouts/footer.php';
