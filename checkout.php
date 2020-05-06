<?php

include_once "config/init.php";
require_once "entities/Product.php";
require_once "entities/shoppingCart.php";

session_start();

// initialize the view
$view = new View('views/checkout.php');

$view->balance = $_SESSION['balance'];

$view->shoppingCart = new ShoppingCartController();

include_once 'views/layouts/header.php';
echo $view;
include_once 'views/layouts/footer.php';