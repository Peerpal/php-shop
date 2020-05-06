<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ABC STORE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.2.0/tailwind.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">

    <style>
        .currency:before {
            content: "$";
        }
        /* Rating Star Style */
        .rating-stars ul {
            list-style-type:none;
            padding:0;

            -moz-user-select:none;
            -webkit-user-select:none;
        }
        .rating-stars ul > li.star {
            display:inline-block;

        }

        /* Idle State of the stars */
        .rating-stars ul > li.star > i.fa {
            font-size:16px; /* Change the size of the stars */
            color:#ccc; /* Color on idle state */
        }

        /* Hover state of the stars */
        .rating-stars ul > li.star.hover > i.fa {
            color:#FFCC36;
        }

        /* Selected state of the stars */
        .rating-stars ul > li.star.selected > i.fa {
            color:#FF912C;
        }

    </style>
</head>
<body class="bg-gray-100">
<div class="container mx-auto h-100">
    <div class="py-8">
        <section class="header bg-white flex justify-between mx-4 mb-4 shadow-md px-4 py-3">
            <div class="text-center text-red-400 font-semi-bold text-lg"><a href="/">ABC STORES</a></div>
            <div class="balance flex items-center justify-between text-red-400 font-semi-bold text-md">
                <div class="mr-6"><a href="orders.php">Orders</a></div>
               <div>
                   Balance:  $<span id="balance"><?php echo $_SESSION['balance'] ?></span>
               </div>
            </div>
        </section>
