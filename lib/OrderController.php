<?php


class OrderController
{
    /**
     * @var Order
     */
    private $order;

    public function __construct()
    {
        $this->order = new Order();
    }

    /** method to insert an order detail to the database
     * @param $cartItem
     */
    public function processOrder($cartItem)
    {
        $data = [
            $_SESSION['uuid'],
            $cartItem['product_id'],
            $cartItem['quantity'],
            $cartItem['cost']
        ];

        // create the order
        $this->order->createOrder($data);
    }

    /** return collection of orders
     * @param $uuid
     * @return mixed
     */
    public function getOrders($uuid)
    {
        return $this->order->getOrders($uuid);
    }
}