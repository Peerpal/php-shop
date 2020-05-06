<?php


class ShoppingCart
{

    /**
     * @var array
     */
    private $items;

    public function __construct()
    {
        $this->items = $_SESSION['cart'];
    }

    /** return items in cart
     * @return array|mixed
     */
    public function getCartItems()
    {
        return $this->items;
    }

    /** Add a product to cart
     * @param $product
     * @param $quantity
     */
    public function addToCart($product, $quantity)
    {
        if (is_array($this->items))
        {
            // check if product is already in cart
            if ($this->productIsInCart($product))
            {
                $this->increaseProductQuantity($product, $quantity);
            }

            else {
                $this->addProductToCart($product, $quantity);
            }
        }
        else {
            $this->items = [];
            $this->addProductToCart($product, $quantity);
        }
    }

    /** check if a product is already in the cart
     * @param $product
     * @return array
     */
    public function productIsInCart($product)
    {
        return array_filter($this->items, function ($item) use ($product)
        {
            return $item['product_id'] == $product->id;
        });
    }

    /** increase the quantity of a product in the cart
     * @param $product
     */
    public function increaseProductQuantity($product, $quantity)
    {
        $cartItem = $this->productIsInCart($product);

        $this->items[key($cartItem)]['quantity'] += $quantity;

        $this->items[key($cartItem)]['cost'] = $this->items[key($cartItem)]['unit_cost'] * $this->items[key($cartItem)]['quantity'];

        $this->updateSessionCart();
    }

    /** decrease the quantity of a product in the cart
     * @param $cartItem
     */
    public function decreaseCartProductQuantity($cartItem, $quantity)
    {
        $this->items[key($cartItem)]['quantity'] -= $quantity;
        $this->items[key($cartItem)]['cost'] -= ($this->items[key($cartItem)]['unit_cost'] * $quantity);

        $this->updateSessionCart();
    }

    /**
     * update the session cart
     */
    private function updateSessionCart()
    {
        $_SESSION['cart'] = $this->items;
    }

    /** Add product to cart
     * @param $product
     * @param $quantity
     */
    private function addProductToCart($product, $quantity)
    {
        if (is_array($this->items))
        {
            array_push($this->items,
                [
                    'product_id' => $product->id,
                    'unit_cost' => $product->price,
                    'quantity' => $quantity,
                    'cost' => $product->price * $quantity
            ]);
        }

        else
        {
            $this->items =
                [
                    [
                        'product_id' => $product->id,
                        'unit_cost' => $product->price,
                        'quantity' => $quantity,
                        'cost' => $product->price * $quantity
                    ],
            ];
        }

        $this->updateSessionCart();
    }

    /** remove product from the cart
     * @param $product
     * @param $quantity
     */
    public function removeFromCart($product, $quantity)
    {
        if ($cartItem = $this->productIsInCart($product))
        {
            if ($this->items[key($cartItem)]['quantity'] > $quantity)
            {
                $this->decreaseCartProductQuantity($cartItem, $quantity);
            }
            else {
                unset($this->items[key($cartItem)]);
            }

            $this->updateSessionCart();
        }
    }
}