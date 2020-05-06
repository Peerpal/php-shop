<?php


class ProductRatingController
{

    /**
     * @var ProductRating
     */
    private $rating;

    public function __construct()
    {
        $this->rating = new ProductRating();
    }

    /** Apply rating to a product
     * @param $uuid
     * @param $product_id
     * @param $rating
     * @return bool
     */
    public function rate($uuid, $product_id, $rating)
    {
        $params = [
            $uuid,
            $product_id,
            $rating
        ];

        $this->rating->rateProduct($params);

        return true;
    }

    /** get the average rating for a product
     * @param $product_id
     * @return false|float
     */
    public function averageRating($product_id)
    {
        return round($this->rating->getProductAverageRating($product_id)->average, 2);
    }

    /** return user product rating
     * @param $uuid
     * @param $product_id
     * @return mixed
     */
    public function userProductRating($uuid, $product_id)
    {
        return $this->rating->getUserProductRating($uuid, $product_id)->rating;
    }
}