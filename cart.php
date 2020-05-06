<?php

include_once "config/init.php";
require_once "entities/Product.php";
require_once "entities/shoppingCart.php";

session_start();

$view = new View("views/cart.php");

$view->title = "Cart";

$productController = new Product();

$cart = new ShoppingCartController();


if (isset($_GET))
    // determine the action to be performed [add, remove]
    switch ($_GET['action'])
    {
        case 'add':
            $cart->addToCart($_GET['product_id'], $_GET['quantity']);

            echo $cart->template();

            break;
        case 'remove':
            $cart->removeItem($_GET['product_id'], $_GET['quantity']);

            echo $cart->template();

            break;
        default:

    }

if (isset($_GET['get-cart']))
{
    echo $cart->template();
}
echo $view;
