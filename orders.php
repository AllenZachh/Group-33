<?php
session_start();
require_once('connectdb.php');

$query= "SELECT * FROM `order` WHERE userid = ".$_SESSION['userid'];
$rows = $db->query($query);
$rows = $rows->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleAwais.css?v=<?php echo time(); ?>">


    <title>Products | Glacier Guys</title>
</head>

<?php require_once("navbar.php"); navbar("account"); ?>

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
                <h1>Hello <?= $_SESSION['username']?></h1>
                <h1>These are your orders</h1>
            </div>
        </div>
        <?php foreach ($rows as $row): 
            $query= "SELECT * FROM `orderitems` WHERE orderid = ".$row["orderid"];
            $items = $db->query($query);
            $items = $items->fetchAll();
        ?>
        <h2>Order Number: #<?= $row['orderid']?></h2>
        <h2>Order Price: £<?= $row['totalPrice']?></h2>
        <?php
            foreach ($items as $item):

            $query= "SELECT * FROM `product` WHERE productid = ".$item["productid"];
            $indivItems = $db->query($query);
            $indivItems = $indivItems->fetchAll();

            foreach ($indivItems as $indivItem):

            $query= "SELECT * FROM `producttype` WHERE productTypeid = ".$indivItems[0]["productTypeid"];
            $productType = $db->query($query);
            $productType = $productType->fetch();
        ?>
        <div class="orderCard">
            <div class="orderCardImg">
                <img src="<?=  $indivItems[0]["imageFilePath"]?>">
            </div>
            <div class="orderCardInfo">
                <h4><?=  $productType["name"]?></h4>
                <h4>Price: £<?=  $productType["price"]?></h4>
                <h4>Size: <?=  $indivItems[0]["size"]?></h4>
                <h4>Quantity: <?=  $item["quantity"]?></h4>
                <h4 id="status">Not Delivered</h4>
            </div>
            <div class="orderCardButtons">
               <a href = "refund.php?orderitems_id=<?= $item['orderItemsid']?>" 
               <button class = "rButton" id="refundButton" type="button">Refund this</button></a>
                <p></p>
                <a href = "review.php?product_id=<?= $indivItem['productid']?>.php" 
                <button class = "rButton" id="reviewButton" type="button">Review this item!!</button></a>
            </div>
        </div><br>
        <?php endforeach;endforeach;echo"<br><br>";endforeach; ?>
    </div>

</body>

</html>