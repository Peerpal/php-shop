<?php

include_once "config/init.php";
require_once "entities/Product.php";
require_once "entities/ProductRating.php";
require_once "entities/shoppingCart.php";

session_start();

$_SESSION['cart'] = [];
// assign session parameters
if (!$_SESSION['uuid']) {
    $_SESSION['uuid'] = rand(1, 100);
    $_SESSION['balance'] = 100;
    $_SESSION['previous_balance'] = $_SESSION['balance'];
    $_SESSION['current_purchase'] = 0;
}



//$_SESSION['cart'] = [];
//var_dump($_SESSION['cart']);
$view = new View("views/index.php");



$view->productController = new ProductController();

$view->cartController = new ShoppingCartController();

$view->ratingController = new ProductRatingController();

$view->user_id = $_SESSION['uuid'];

include_once 'views/layouts/header.php';
echo $view;
include_once 'views/layouts/footer.php';
