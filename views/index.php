<section class="content mt-8 px-8">
    <div class="mr-4">
        <div class="text-red-400 font-semibold text-2xl mb-3">Products</div>

        <div class="flex items-start justify-between">
            <div class="products-list w-2/3 mr-4">
                <div class="flex items-center">
                    <?php foreach ($productController->getProducts() as $product) {
                        $userProductRating = $ratingController->userProductRating($user_id, $product->id)
                        ?>
                        <div class="w-1/4 mr-4">
                            <div class="mb-4 w-full">
                                <img src="<?php echo $product->image ?>"
                                     alt="product-image" class="object-contain h-48 w-full ">
                            </div>
                            <div class="text-center mb-4">
                                <div class="mb-2 font-semi-bold text-lg capitalize">
                                    <?php echo $product->name ?>
                                </div>
                                <div class="mb-4 font-semi-bold text-lg">
                                    $<?php echo $product->price ?>
                                </div>

                                <div class="flex flex-col">
                                    <input value="1" type="number" placeholder="quantity" class="quantity w-full px-4 py-2 rounded mb-2 bg-gray-200">
                                    <button class="add-to-cart-button px-6 py-2 bg-red-400 text-white mb-2 hover:bg-red-500"
                                            data-product="<?php echo $product->id ?>">Add to Cart
                                    </button>
                                    <button class="remove-from-cart-button px-6 py-2 bg-red-400 text-white mb-2 hover:bg-red-500" data-product="<?php echo $product->id ?>">Remove Item</button>
                                    <div class="flex items-center justify-between">
                                        <div class='rating-stars text-center'>
                                            <ul id='stars' data-product="<?php echo $product->id ?>">
                                                <li class='star<?php echo ($userProductRating >= 1) ?  ' selected' : '' ?>' title='Poor' data-value='1'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star<?php echo ($userProductRating >= 2) ?  ' selected' : '' ?>' title='Fair' data-value='2'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star<?php echo ($userProductRating >= 3) ?  ' selected' : '' ?>' title='Good' data-value='3'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star<?php echo ($userProductRating >= 4) ?  ' selected' : '' ?>' title='Excellent' data-value='4'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star<?php echo ($userProductRating >= 5) ?  ' selected' : '' ?>' title='WOW!!!' data-value='5'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="text-red-400 text-xs">(<?php echo($ratingController->averageRating($product->id)); ?>)</div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="flex-grow italic bg-blue-400">
                <div class="bg-gray-300 px-4 py-4">
                    <div class="section-header text-blue-900 text-xl font-semibold">Your Cart</div>
                    <div class="cart-details my-3 text-sm text-blue-900 font-semibold">
                        <div class="cart-items border-dashed text-sm border-b-4 border-gray-600 pb-3">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>
