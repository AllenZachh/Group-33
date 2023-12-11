<?php
session_start();
require_once("connectdb.php");

// Checks if 'basket' cookie is set 
if (isset($_COOKIE["basket"])) {
    $items = array();
    $array = json_decode($_COOKIE["basket"], true);
    foreach ($array as $product) {
        array_push($items, $product);
    }}

// Deletes items from POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["remove"])) {
        $array = json_decode($_COOKIE["basket"], true);
        if (($key = array_search($_POST["remove"], $array)) !== false) {
            unset($array[$key]);
            $array = json_encode($array);
            setcookie('basket', $array, time()+3600);
            header("Location:basket.php");
        }
    }}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <script src="script.js"></script>
    <title>Basket | Glacier Guys</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
    <!-- Additional CSS -->
    <style>
        .image {
            width: 220px;
            height: 150px;
        }
        .btn_Remove {
            border: none;
            background-color: inherit;
            padding: 14px 28px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <?php require_once("navbar.php"); navbar("basket"); ?>


    <!-- Title -->
    <section class="Checkout_Title">
        <div style="padding-top: 80px;" class="container-title">
            <h2 class="text-center mb-5">Basket</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                </div>
            </div>
        </div>
    </section>

    <form action="basket.php" method="post">
        <!-- Items -->
        <section class="Items">
            <div class="container-items">
                <h2 class="text-lg-left text-center">Items</h2>
                <?php if(empty($items)): ?>
                    <div class="col-md-3 mb-3">
                        <p style="text-align:center;"> No items in basket </p>
                    </div>
                <?php else: ?>
                <?php $totalprice = 0; foreach($items as $singleitem): ?>
                    <?php

                    $item = $db->query("SELECT * FROM product WHERE productid = ". $singleitem);
                    $selectProduct = $item->fetch();
                    $itemType = $db->query("SELECT * FROM producttype WHERE productTypeid = ". $selectProduct["productTypeid"]);
                    $selectProductType = $itemType->fetch();
                    ?>
                    <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow rounded">
                            <a href="product_page.php?id=<?=$singleitem?>">
                                <img src="<?=$selectProduct["imageFilePath"]?>" width="200" height="200" alt="<?=$selectProductType["name"]?>">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title text-dark"><?=$selectProductType["name"]?></h5>
                                <p class="card-text">Size: <?=$selectProduct["size"]?></p>
                                <p class="card-text">Price: £<?=$selectProductType["price"]?></p>
                                <div class="row justify-content-end">
                                    <button name="remove" value="<?=$selectProduct["productid"]?>" class="btn_Remove" method="POST">Remove</a>
                                    <input type="hidden" name="submitted" value="true">
                                    <!-- <input type="number" name="quantity-<?=$selectProduct["productid"]?>" value="" min="1" placeholder="Enter quantity" required/> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                <?php $totalprice += $selectProductType["price"]; endforeach; ?>
                <?php endif; ?>
            </div>
        </section>

        <!-- Total section -->
        <section class="Total">
            <div class="container-total">
                <div class="row justify-content-end">
                    <div class="col-lg-3">
                        <h2 class="mb-3 total text-left">Total</h2>
                        <div class="mb-5">
                            <div class="d-flex justify-content-between mb-5">
                                <div>
                                    <h4 id="subtotal">Sub-total</h4>
                                    <h4>Delivery</h4>
                                </div>
                                <div>
                                <h4 id="subtotal"><?php if (isset($totalprice)){echo '£'.$totalprice;}?></h4>
                                    <h4 id="delivery">£5</h4>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <h4>Total</h4>
                                <h4 id="totalAmount"><?php if (isset($totalprice)){echo '£'.$totalprice+5;}?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <!-- Proceed to Checkout button -->
        <div class="row justify-content-end">
            <div class="col-lg-1 mb-8">
                <button class="btn btn-primary btn-proceed-to-checkout">Proceed to Checkout</button>
            </div>
            <!-- <div class="col-lg-1 mb-8">
                <input type="submit" value="Update" name="update">
            </div> -->
        </div>
        </section>
        </form>
    <footer>
        <a class="socialmedia" href="https://www.instagram.com/" target="_blank">
            <ion-icon size="large" name="logo-instagram"></ion-icon>
        </a>
        <a class="socialmedia" href="https://twitter.com/" target="_blank">
            <ion-icon size="large" name="logo-twitter"></ion-icon>
        </a>
    </footer>
    <!-- <script>
        // Sample product details
        const productPrice = 59.99;
        let basketItems = [
            { id: 1, quantity: 1 },
        ];

        function removeItemFromBasket(itemId) {
            const indexToRemove = basketItems.findIndex(item => item.id === parseInt(itemId));
            // If the item is found, remove it from the array
            if (indexToRemove !== -1) {
                basketItems.splice(indexToRemove, 1);
            }

            console.log('Removed item with ID:', itemId);
            console.log('Updated basket:', basketItems);

            updateSubtotal();
        }

        function updateQuantityInBasket(newQuantity, itemId) {
            const indexToUpdate = basketItems.findIndex(item => item.id === parseInt(itemId));
            // If the item is found, update its quantity
            if (indexToUpdate !== -1) {
                basketItems[indexToUpdate].quantity = newQuantity;
            }

            console.log('Updated quantity to:', newQuantity, 'for item with ID:', itemId);
            console.log('Updated basket:', basketItems);

            updateSubtotal();
        }

        function updateSubtotal() {
            const subtotal = basketItems.reduce((acc, item) => acc + (productPrice * item.quantity), 0);
            document.getElementById('subtotalAmount').textContent = `£${subtotal.toFixed(2)}`;
            updateTotal(subtotal);
        }

        function updateTotal(subtotal) {
            const deliveryCost = 3.00;
            const total = subtotal + deliveryCost;
            document.getElementById('totalAmount').textContent = `£${total.toFixed(2)}`;
        }


        document.querySelectorAll('.btn_Remove').forEach(function(button) {
            button.addEventListener('click', function() {
                var itemId = this.getAttribute('data-item-id');
                removeItemFromBasket(itemId);
            });
        });

        document.querySelectorAll('.quantity-input').forEach(function(input) {
            input.addEventListener('input', function() {
                var newQuantity = parseInt(this.value);
                var itemId = this.parentElement.querySelector('.btn_Remove').getAttribute('data-item-id');
                updateQuantityInBasket(newQuantity, itemId);
            });
        });

        document.querySelector('.btn-proceed-to-checkout').addEventListener('click', function() {
        window.location.href = 'ChooseCheckout.html';
        });
            
        updateSubtotal();
    </script> -->
</body>
</html>


