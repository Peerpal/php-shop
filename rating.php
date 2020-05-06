<?php

include_once "config/init.php";
require_once "database/connector.php";
require_once "entities/ProductRating.php";
require_once "entities/Product.php";

session_start();

/*
 * Handle the product rating process
 */
if (isset($_GET['rating']))
{

    $rating = new ProductRatingController();

    if ($rating->userProductRating($_SESSION['uuid'], $_GET['product_id']))
    {
        echo 'rated';
    } else
        {
        $rating->rate($_SESSION['uuid'], $_GET['product_id'], $_GET['rating']);
        echo 'done';
    }
}