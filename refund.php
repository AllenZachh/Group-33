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
</head>

<?php require_once("navbar.php");
navbar("productList"); ?>

<body>
    <h1>Return this item</h1>
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
        <div class="orderCardRefundOptions">
            <h5>Why are you returning this item?</h5>
        <form>
                <select name="reasons" class="reason" id="reason">
                    <option class="reasons" value="damage">Product damaged</option>
                    <option class="reasons" value="late">Order missed delivery date</option>
                    <option class="reasons" value="alternative">Found better price elsewhere</option>
                    <option class="reasons" value="accident">Accidental purchase</option>
                    <option class="reasons" value="accurate">Not accurate to website</option>
                    <option class="reasons" value="poor">Poor quality</option>
                    <option class="reasons" value="missing">Missing parts or accessories</option>

                </select>
                <br><br>
                <input type="submit" class  = "submit"value="Submit">
            </form>
        </div>
    </div>
</body>
