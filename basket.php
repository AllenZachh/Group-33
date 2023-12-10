<?php
session_start();
require_once("connectdb.php");
if (isset($_POST["productid"]) && is_numeric($_POST["productid"]) && isset($_POST["productTypeid"]) && is_numeric($_POST["productTypeid"]) && isset($_POST["quantity"]) && is_numeric($_POST["quantity"]) && isset($_POST["size"])) {
    $prodid = $_POST["productid"];
    $typeid= $_POST["productTypeid"];
    $quantity = $_POST["quantity"];
    $size = $_POST["size"];
    $item = $db->prepare("SELECT * FROM product WHERE producttypeid=$typeid AND 'size'='$size'");
    $item->execute();
    $product = $item->fetch(PDO::FETCH_ASSOC);
    if ($product && $quantity > 0) {
        if(isset($_SESSION["basket"]) && is_array($_SESSION["basket"])) {
            if (array_key_exists($product["productid"], $_SESSION["basket"])){
                $_SESSION["basket"][$product["productid"]] += $quantity;
            } else {
                $_SESSION["basket"][$product["productid"]] = $quantity;
            }
        } else {
            $_SESSION["basket"]= array($product["productid"] => $quantity);
        }
    }
    header("location: basket.php");
    exit;
}
if (isset($_GET["remove"]) && isset($_SESSION["basket"])  && is_numeric($_GET["remove"]) && isset($_SESSION["basket"][$_GET["remove"]])) {
    unset($_SESSION["basket"][$_GET["remove"]]);
}

if (isset($_POST["update"]) && isset($_SESSION["basket"])) {
    foreach($_POST as $a => $b) {
         if (is_numeric($b) && strpos($a, "quantity") !== false ) {
            $pid = str_replace("quantity-", "", $a);
            $pidquantity = (int)$b;
            if ($pidquantity>0 && is_numeric($pid) && isset($_SESSION["basket"][$pid])) {
                $_SESSION["basket"][$pid] = $pidquantity;
            }
         }
    }
    header("location: basket.php");
    exit;
}

if (isset($_POST["checkout"]) && isset($_SESSION["basket"]) && !empty($_SESSION["basket"])) {
    header("Location: ChooseCheckout.html");
    exit;
}

$items = array();
$basketitems = isset($_SESSION["basket"]) ? $_SESSION["basket"] : array();
$totalprice = 0.00;

if($basketitems) {
    $atqm = implode(",", array_fill(0, count($basketitems), "?"));
    $allitems = $db->prepare("SELECT * FROM product WHERE productid IN (". $atqm .") ");
    $allitems->execute(array_keys($basketitems));
    $items = $allitems->fetchAll(PDO::FETCH_ASSOC);
    foreach($items as $singleitem) {
        $prodtypeid = $singleitem["productTypeid"];
        $item_specifics = $db->prepare("SELECT * FROM producttype WHERE productTypeid= $prodtypeid ");
        $item_specifics->execute();
        $spec = $item_specifics->fetch(PDO::FETCH_ASSOC);
        $totalprice += (float)$spec["price"] * (int)$basketitems[$singleitem["productid"] ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <script src="script.js"></script>
    <title>Basket | Glacier Guys</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./css/style.css">
    
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
                <?php foreach($items as $singleitem): ?>
                    <?php
                    $prodtypeid = $singleitem["productTypeid"];
                    $item_specifics = $db->prepare("SELECT * FROM producttype WHERE productTypeid= $prodtypeid ");
                    $item_specifics->execute();
                    $spec = $item_specifics->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow rounded">
                            <a href="product_page.php?id=<?=$singleitem["productid"]?>">
                                <img src="<?=$singleitem["imageFilePath"]?>" width="200" height="200" alt="<?=$spec["name"]?>">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title text-dark"><?=$spec["name"]?></h5>
                                <p class="card-text">Size: <?=$singleitem["size"]?></p>
                                <p class="card-text">Price: £<?=$spec["price"]?></p>
                                <div class="row justify-content-end">
                                    <a href="basket.php?remove=<?=$singleitem["productid"]?>" class="remove">Remove</a>
                                    <input type="number" name="quantity-<?=$singleitem["productid"]?>" value="<?=$basketitems[$singleitem["productid"]]?>" min="1" placeholder="Enter quantity" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                <?php endforeach; ?>
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
                                    <h4 id="subtotalAmount">£<?=$totalprice?></h4>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <h4>Total</h4>
                                <h4 id="totalAmount">£<?=$totalprice?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <!-- Proceed to Checkout button -->
        <div class="row justify-content-end">
            <div class="col-lg-1 mb-8">
                <input type="submit" value="Checkout" name="checkout">
            </div>
            <div class="col-lg-1 mb-8">
                <input type="submit" value="Update" name="update">
            </div>
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


