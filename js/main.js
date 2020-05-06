$(document).ready(function () {
    // addToCart();
    getCart();

    $(".add-to-cart-button").click(function () {
        let product_id = parseInt($(this).data('product'), 10);
        let quantity = parseInt($(this).parent().children('input.quantity').val(), 10);
        if (quantity > 0)addToCart(product_id, quantity);

    });

    $(".remove-from-cart-button").click(function () {
        let product_id = parseInt($(this).data('product'), 10);
        let quantity = parseInt($(this).parent().children('input.quantity').val(), 10);
        removeFromCart(product_id, quantity);

    });

// setup listener for the shipping options
    $('#shipping-options').change(function () {
        let result = $('#shipping-mode');

        switch (this.value) {
            case 'none':
                result.text('Pick an option');
                break;
            case '0':
                result.text("Free");
                calculateTotal(0);
                break;
            case '5':
                result.text("$5");
                calculateTotal(5);
                break;
            default:
                result.text("Free");
        }
    });

    $('#checkout').click(function () {
        checkout();
    });

    /* 1. display hover effect for rating stars */
    $('#stars li').on('mouseover', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

        // Now highlight all the stars that's not after the current hovered star
        $(this).parent().children('li.star').each(function(e){
            if (e < onStar) {
                $(this).addClass('hover');
            }
            else {
                $(this).removeClass('hover');
            }
        });

    }).on('mouseout', function(){
        $(this).parent().children('li.star').each(function(e){
            $(this).removeClass('hover');
        });
    });


    /* 2. Action to perform on click and rate product */
    $('#stars li').on('click', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently selected
        var stars = $(this).parent().children('li.star');
        let product_id = parseInt($(this).parent().data('product'), 10);

        for (i = 0; i < onStar; i++) {
            if($(stars[i]).hasClass('selected')) {
                alert('You have already stared this product');
                return;
            }
        }

        $.ajax({
            url: 'rating.php?rating='+onStar+'&product_id='+product_id,
            method: 'GET',
            success: function () {
                alert("product rated successfully");
                window.location.href = '/';
            }
        })
    });
});

/*
    Send Ajax request to add product to cart
 */
function addToCart(product, quantity) {
    $.ajax({
            url: 'cart.php?action=add&product_id=' + product+'&quantity='+quantity,
            method: "GET",
            success: function (data) {
                $('.cart-items').html(data);
            }
        })
}

/*
    Send Ajax request to remove product to cart
 */
function removeFromCart(product, quantity) {

    $.ajax({
        url: 'cart.php?action=remove&product_id=' + product+'&quantity='+quantity,
        method: "GET",
        success: function (data) {
            $('.cart-items').html(data);
        }
    })
}

/*
    retrieve cart details from server
 */
function getCart() {
    $.ajax({
        url: 'cart.php?get-cart=true',
        method: "GET",
        success: function (result) {
            $('.cart-items').html(result);
        }
    })
}

/*
    calculate total for cart items plus shipping charges
 */
function calculateTotal(number) {
    let c = $('#cart-total').data('total');

    let total = parseFloat(c) + parseFloat(number);

    $('#total-price').text(total);

    return total;

}

/*
    check customers current account balance and determine if it can purchase
 */
function customerCanPurchase() {
    let balance = $('#balance').text();
    let total = $('#total-price').text();

    return parseFloat(total) <= parseFloat(balance);
}

/*
    this method handles the checkout process
 */
function checkout() {
    let shippingOption = checkShippingMethod();
    if (shippingOption === 'none') {
        alert("Please select a shipping method for your order");
    } else {
        // verify user is eligible to buy
        if (customerCanPurchase()) {
            $.ajax({
                url: 'process_checkout.php',
                method: 'POST',
                data: {
                    amount: $('#total-price').text()
                },
                success: function () {
                    alert("Order Placed successfully");
                    window.location.href = "orders.php"
                }
            })
        } else {
            alert("Insufficient Funds To Place Order");
        }

    }
}

/*
    return the shipping method selected by the user

 */
function checkShippingMethod() {
    return $('#shipping-options option:selected').val();

}