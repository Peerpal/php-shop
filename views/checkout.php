<section class="content mt-8 px-8 flex items-start text-blue-900 font-semibold">
    <div class="w-2/3 bg-red mr-4">
        <div class="text-red-400 font-semibold text-2xl mb-3">Your Cart</div>
        <div class="cart-list">
            <?php foreach ($shoppingCart->getCartItems() as $cartItem) {
                $cartProduct = $shoppingCart->cartProduct($cartItem['product_id']);
                ?>
                <div class="bg-white shadow px-4 py-3 mb-3">
                    <div class="flex items-center justify-start">
                        <div class="w-16 mr-4">
                            <img class="h-24 w-full object-contain" src="<?php echo $cartProduct->image ?>" alt="">
                        </div>
                        <div class="flex-1 flex-col">
                            <div class="mb-1"><?php echo $cartProduct->name ?> x <?php echo $cartItem['quantity'] ?>
                                <div>Item Cost: $<?php echo $cartItem['unit_cost'] ?></div>
                                <div>total Cost: $<?php echo $cartItem['cost'] ?></div>
                            </div>
                        </div>

                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="flex-grow italic">
        <div class="bg-white shadow px-4 py-4">
            <div class="border-dashed text-sm border-b-2 border-gray-600 py-3">
                <div class="flex justify-between mb-2">
                    <div>Items Price: </div>
                    <div class="currency" id="cart-total" data-total="<?php echo $shoppingCart->getCartTotal() ?>"><?php echo $shoppingCart->getCartTotal() ?></div>
                </div>
                <?php if (!empty($shoppingCart->getCartItems())) { ?>
                <div class="flex justify-between mb-2" id="shipping-method">
                    <div>Shipping Method: </div>
                    <div id="shipping-mode">Free</div>
                </div>

                <div class="flex justify-between mb-2">
                    <div>Choose Shipping Method: </div>
                    <div class="relative">
                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="shipping-options">
                            <option value="none">Choose</option>
                            <option value="0">Pickup ($0)</option>
                            <option value="5">UPS ($5)</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-between my-2">
                <div>Total Price: </div>
                <div class="currency" id="total-price"><?php echo $shoppingCart->getCartTotal() ?></div>
            </div>
            <div class="text-center pt-4">
                <button id="checkout" class="px-6 py-3 bg-red-400 rounded text-white hover:bg-red-500">Order Now</button>
            </div>

            <?php } ?>
        </div>

    </div>
</section>