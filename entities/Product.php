<?php

require_once "database/connector.php";
class Product
{

    protected $primaryKey = "id";
    /**
     * @var DatabaseConnector
     */
    private $database;
    /**
     * @var array
     */
    private $products;

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->database = new DatabaseConnector();
        $this->products = array();
    }

    /** return product array
     * @return array
     */
    public function getProducts()
    {
        return $this->queryProducts();
    }

    /** send database query and retrieve products
     * @return array
     */
    private function queryProducts()
    {
        $query = "SELECT * FROM products";

        $results = $this->database->query($query)->fetchResults();

        foreach ($results as $result) {
            $this->makeProduct($result);
        }

        return $this->products;
    }

    private function makeProduct($result)
    {
        array_push($this->products, $result);
    }

    /** returns a product entity
     * @param $product
     * @return mixed
     */
    public function getProduct($product)
    {
        $query = "SELECT * FROM products WHERE id = :product";

        return $this->database->query($query)
            ->bind("product", $product)
            ->fetchOne();
    }

    /** find products with given parameters
     * @param $query
     * @param $params
     * @return mixed
     */
    public function findProducts($query, $params)
    {
        $statement = $this->database->query($query);

        foreach ($params as $param) {
            $statement->bind($this->primaryKey, $param);
        }

        return $statement->fetchResults();

    }
}