<?php


class ProductRating
{

    /**
     * @var Product
     */
    private $product;
    /**
     * @var DatabaseConnector
     */
    private $database;

    public function __construct()
    {
        $this->product = new Product();
        $this->database = new DatabaseConnector();

    }

    /** Save Product Rating to database
     * @param $params
     */
    public function rateProduct($params)
    {
        $query = "INSERT INTO ratings (uuid, product_id, rating) values (?, ?, ?)";

        $this->database->query($query)->insert($params);
    }

    /** calculate the average rating for a product
     * @param $product_id
     * @return mixed
     */
    public function getProductAverageRating($product_id)
    {
        $query = "SELECT AVG(rating) AS average FROM ratings WHERE product_id = :id";

        return $this->database->query($query)
            ->bind("id", $product_id)
            ->fetchOne();
    }

    /** get the user rating for a product
     * @param $uuid
     * @param $product_id
     * @return mixed
     */
    public function getUserProductRating($uuid, $product_id)
    {
        $query = "SELECT rating FROM ratings where uuid = :uuid AND product_id = :product_id";

        return $this->database->query($query)
            ->bind("uuid", $uuid)
            ->bind("product_id", $product_id)
            ->fetchOne();

    }
}