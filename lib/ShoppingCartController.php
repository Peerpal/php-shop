<?php


class ShoppingCartController
{


    /**
     * @var Product
     */
    private $product;

    /**
     * @var ShoppingCart
     */
    private $cart;

    /**
     * @var array
     */
    private $products;

    public function __construct()
    {
        $this->product = new Product();
        $this->cart = new ShoppingCart();
        $this->products = [];
    }

    /** Add a product to cart
     * @param $product_id
     */
    public function addToCart($product_id, $quantity)
    {
        $product = $this->product->getProduct($product_id);

        $this->cart->addToCart($product, $quantity);
    }


    /** returns list of items currently in the cart
     * @return mixed
     */
    public function getCartItems()
    {
        return $this->cart->getCartItems();
    }

    /** returns the product details for a particular cart item
     * @param $product_id
     * @return mixed
     */
    public function cartProduct($product_id)
    {
        return $this->product->getProduct($product_id);
    }

    /** server response template
     * @return string
     */
    public function template()
    {
        $items = [];
        foreach ($this->getCartItems() as $cartItem) {
            $cartProduct = $this->cartProduct($cartItem['product_id']);

            $item = '
            <div class="flex justify-between mb-2">
                <div class="capitalize">' . $cartProduct->name . ' ' . $cartItem["quantity"] . '</div>
                <div class="float-right w-auto item-cost">' . $cartProduct->price * $cartItem["quantity"] . '</div>
            </div>
            ';

            array_push($items, $item);
        }
            $details = '
            
            <div class="flex justify-between mb-2 hidden" id="shipping-option">
                <div>Shipping: </div>
                <div id="shipping-option">Free</div>
            </div>
            
            '.!count($this->getCartItems()) ? '<div class="order-detail py-3">
                <div class="flex justify-between mb-2">
                    <div>Total Price: </div>
                    <div>$'.$this->getCartTotal().'</div>
                </div>
                
                <div class="text-center pt-4">
                    <a href="checkout.php" class="px-6 py-3 bg-red-400 rounded text-white hover:bg-red-500">Checkout Now</a>
                </div>
                 
            </div>' : ''.'
            
           
            
            
            ';

            return implode($items) . ' '.$details;
    }

    /** calculate the total cost for items in the cart
     * @return float|int
     */
    public function getCartTotal()
    {
        return array_sum(array_map(function ($item) {
            return $item['cost'];
        }, $this->getCartItems()));
    }

    /**
     * reset the cart to default state
     */
    public function clearCart()
    {
        $_SESSION['cart'] = [];
    }

    /** remove an item from the cart
     * @param $product_id
     * @param $quantity
     */
    public function removeItem($product_id, $quantity)
    {
        $product = $this->product->getProduct($product_id);

        $this->cart->removeFromCart($product, $quantity);
    }

}