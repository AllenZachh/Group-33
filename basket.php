<?php
session_start();
require_once("connectdb.php");

// Checks if user is signed in, if not it will check if there a cookie set
if (isset($_SESSION['username'])){
    $query="SELECT basket FROM user WHERE username = '".$_SESSION["username"]."'";
    $items = array();
    $array = json_decode(($db->query($query))->fetch()[0]);
    foreach ($array as $product) {
        array_push($items, $product);
    }
} elseif (isset($_COOKIE["basket"])) {
    $items = array();
    $array = json_decode($_COOKIE["basket"], true);
    foreach ($array as $product) {
        array_push($items, $product);
    }}

// Deletes items from basket using POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["remove"])) {
        if (isset($_SESSION['username'])){
            if (($key = array_search($_POST["remove"], $array)) !== false) {
                array_splice($array, $key, 1);
                $array = json_encode($array);
                $stat = $db->prepare('UPDATE user SET basket = ? WHERE username = "'.$_SESSION['username'].'"');
			    $stat->execute(array($array));
            }

        } else {
            $array = json_decode($_COOKIE["basket"], true);
            if (($key = array_search($_POST["remove"], $array)) !== false) {
                unset($array[$key]);
                $array = json_encode($array);
                setcookie('basket', $array, time()+3600);
            }}
            header("Location:basket.php");
    }}

include 'navbar.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Basket | Glacier Guys</title>
</head>
<body>

    <?php navbar("basket"); ?>

    <div class="container py-5">
        <h2 class="mb-4 text-center">Your Basket</h2>
        <?php if (empty($items)): ?>
            <div class="alert alert-info text-center">Your basket is empty.</div>
        <?php else: ?>
            <div class="row">
                <div class="col-lg-8">
                    <ul class="list-group mb-3">
                        <?php
                        $totalprice = 0;
                        foreach ($items as $singleitem) {
                            $stmt = $db->prepare("SELECT p.*, pt.price, pt.name FROM product p JOIN producttype pt ON p.productTypeid = pt.productTypeid WHERE p.productid = ?");
                            $stmt->execute([$singleitem]);
                            $product = $stmt->fetch();
                            $totalprice += $product['price'];
                        ?>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="<?= htmlspecialchars($product['imageFilePath']) ?>" class="img-fluid" alt="<?= htmlspecialchars($product['name']) ?>">
                                    </div>
                                    <div class="col-md-5">
                                        <h4 class="mt-2"><?= htmlspecialchars($product['name']) ?></h4>
                                        <h5>Size: <?= htmlspecialchars($product['size']) ?></h5>
                                        <h5>Price: £<?= htmlspecialchars($product['price']) ?></h5>
                                    </div>
                                    <div class="col-md-3 d-flex align-items-center">
                                        <form action="basket.php" method="post">
                                            <button type="submit" name="remove" value="<?= $singleitem ?>" class="btn btn-danger">Remove</button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Summary</h4>
                            <p class="card-text">Subtotal: £<?= number_format($totalprice, 2) ?></p>
                            <p class="card-text">Delivery: £5.00</p>
                            <h4>Total: £<?= number_format($totalprice + 5, 2) ?></h4>
                            <?php if (isset($_SESSION['username'])): ?>
                                <!-- IF user is logged in, direct them straight to UserCheckout.php -->
                                <form action="UserCheckout.php" method="post">
                                    <button class="btn btn-primary btn-lg btn-block mt-4" type="submit">Proceed to Checkout</button>
                                </form>
                            <?php else: ?>
                                <!-- If user isn't logged in, direct them to ChooseCheckout.php-->
                                <form action="ChooseCheckout.php" method="post">
                                    <button class="btn btn-primary btn-lg btn-block mt-4" type="submit">Proceed to Checkout</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    
    <!-- Bootstrap's JavaScript, jQuery and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="script.js"></script>

</body>
</html>




