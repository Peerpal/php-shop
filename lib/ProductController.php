<?php


class ProductController
{

    /**
     * @var Product
     */
    private $product;

    public function __construct()
    {
        $this->product = new Product();
    }

    /** return a product entity
     * @param $product
     * @return mixed
     */
    public function getProduct($product)
    {
        return $this->product->getProduct($product);
    }

    /** return product collection
     * @return array
     */
    public function getProducts()
    {
        return $this->product->getProducts();
    }

}