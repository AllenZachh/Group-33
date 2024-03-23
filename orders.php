<?php
session_start();
require_once('connectdb.php');
$result = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleAwais.css?v=<?php echo time(); ?>">


    <title>Products | Glacier Guys</title>
</head>

<?php require_once("navbar.php");
navbar("productList"); ?>

<body>

    <div class="accountContainer">
        <div class="accountTop">

            <div class="accountNav">
                <ul>
                    <li><a href="viewDetails.php">View Details</a></li>
                    <li><a href="orders.php">View Orders</a></li>
                </ul>
            </div>
            <div class="accountWelcome">
                <h1>Hello Name</h1>
                <h1>These are your orders</h1>
            </div>
        </div>
        <h2>Order Number</h2>
        <h2>Order Price</h2>
        <div class="orderCard">
            <div class="orderCardImg">
                <img src="Images/Boot2.png">
            </div>
            <div class="orderCardInfo">
                <h4>Item</h4>
                <h4>Item Price</h4>
                <h4>Item Size</h4>
                <h4 id="status">Delivered</h4>
            </div>
            <div class="orderCardButtons">
               <a href = "refund.php" 
               <button class = "rButton" id="refundButton" type="button">Refund this</button></a>
                <p></p>
                <a href = "review.php" 
                <button class = "rButton" id="reviewButton" type="button">Review this item!!</button></a>
            </div>
        </div>
    </div>

</body>

</html>
