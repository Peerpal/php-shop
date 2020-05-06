<?php

include_once "config/init.php";
require_once "entities/Order.php";
require_once "entities/Product.php";
require_once "entities/shoppingCart.php";

session_start();

if (isset($_POST)) {
    processCheckout();
}

/*
 * Process the checkout
 */
function processCheckout()
{
    $shoppingCart = new ShoppingCartController();

    $order = new OrderController();

    foreach ($shoppingCart->getCartItems() as $cartItem) {
        // make the order
        $order->processOrder($cartItem);
    }
    /*
     *  Reassign session values after successful purchase
     */
    $_SESSION['previous_balance'] = $_SESSION['balance'];
    $_SESSION['balance'] = floatval($_SESSION['balance']) - floatval($_POST['amount']);
    $_SESSION['current_purchase'] =  floatval($_POST['amount']);

    $shoppingCart->clearCart();

    echo "successful";
}