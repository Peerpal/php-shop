<section class="content mt-8 px-8 flex items-start">
    <div class="w-3/4 flex items-start">
        <?php foreach ($orders->getOrders($_SESSION['uuid']) as $order) {

            ?>
            <div class="w-1/4 bg-white shadow px-4 py-3 mr-4">
                <div class="product-image">
                    <img class="w-full h-64 object-contain" src="<?php echo $order->image ?>" alt="">
                </div>
                <div class="flex items-start justify-between">
                    <div>
                        <div class="capitalize text-blue-900 text-lg font-semibold">
                            <?php echo $order->name ?>
                        </div>
                        <div class="text-blue-900 text-sm">
                            <?php echo $order->quantity ?> x $<?php echo $order->price ?>
                        </div>
                    </div>
                    <div class="text-red-400 text-xl font-semibold">
                        $<?php echo $order->amount ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="flex-grow italic">
        <div class="bg-white shadow px-4 py-4">
            <div class="border-dashed text-sm border-b-2 border-gray-600 py-3">
                <div class="flex justify-between mb-2">
                    <div>Current Balance: </div>
                    <div class="currency" id="cart-total"><?php echo $_SESSION['balance'] ?></div>
                </div>

                <div class="flex justify-between mb-2" id="shipping-method">
                    <div>Previous Balance: </div>
                    <div class="currency"><?php echo $_SESSION['previous_balance'] ?></div>
                </div>

                <div class="flex justify-between my-2">
                    <div>Current Purchase: </div>
                    <div class="currency" id="total-price"><?php echo $_SESSION['current_purchase'] ?></div>
                </div>

            </div>

        </div>

    </div>
</section>
