<?php
session_start();
require_once('connectdb.php');

$query= "SELECT * FROM `orderitems` WHERE orderItemsid = ".$_GET['orderitems_id'];
$row = $db->query($query);
$row = $row->fetch();

$query= "SELECT * FROM `product` WHERE productid = ".$row["productid"];
$indivItem = $db->query($query);
$indivItem = $indivItem->fetch();

$query= "SELECT * FROM `producttype` WHERE productTypeid = ".$indivItem["productTypeid"];
$productType = $db->query($query);
$productType = $productType->fetch();
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
            <img src="<?=  $indivItem["imageFilePath"]?>">
        </div>
        <div class="orderCardInfo">
            <h4><?=  $productType["name"]?></h4>
            <h4>Price: £<?=  $productType["price"]?></h4>
            <h4>Size: <?=  $indivItem["size"]?></h4>
        </div>
        <div class="orderCardRefundOptions">
            <h5>Why are you returning this item?</h5>
        <form method="get" action="refundItem.php?orderitems_id<?= $row['orderItemsid']?>">
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
                <button type="submit" class="submit">Refund</button>
            <input type="hidden" name="orderitems_id" value="<?= $row['orderItemsid']?>">
            </form>
        </div>
    </div>
</body>
