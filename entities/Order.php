<?php


class Order
{
    /**
     * @var DatabaseConnector
     */
    private $database;
    /**
     * @var array
     */
    private $orders;

    /**
     * Order constructor.
     */
    public function __construct()
    {
        $this->database = new DatabaseConnector();
        $this->orders = array();
    }


    /** create an order for a user
     * @param $params
     * @return bool
     */
    public function createOrder($params)
    {
        $query = "INSERT INTO orders (uuid, product_id, quantity, amount) VALUES (?,?,?,?)";

        $this->database->query($query)->insert($params);

        return true;

    }

    /** query database for all user orders;
     * @param $id
     * @return mixed
     */
    public function getOrders($id)
    {
        $query = "
            select orders.*, products.id,products.name,products.image, products.price from orders, products where orders.uuid = :id and orders.product_id = products.id order by orders.created_at DESC
        ";

        return $this->database->query($query)
            ->bind('id', $id)
            ->fetchResults();
    }
}