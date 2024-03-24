<?php

session_start();
require_once('connectdb.php');
if (isset($_SESSION['username'])){
    // Select info about user inc basket
    $sql = "SELECT userid, basket FROM user WHERE username = '".$_SESSION['username']."'";
    $info = $db->query($sql);
    $info = $info->fetch();
    $userid = $info["userid"];
    $basket = json_decode($info["basket"]);
    sort($basket);

    $query="SELECT basket FROM user WHERE username = '".$_SESSION["username"]."'";
        $items = array();
        $array = json_decode(($db->query($query))->fetch()[0]);
        foreach ($array as $product) {
            array_push($items, $product);
        }
        $totalprice = 5;
        foreach ($items as $singleitem) {
            $stmt = $db->prepare("SELECT p.*, pt.price, pt.name FROM product p JOIN producttype pt ON p.productTypeid = pt.productTypeid WHERE p.productid = ?");
            $stmt->execute([$singleitem]);
            $product = $stmt->fetch();
            $totalprice += $product['price'];
        }

}


$createOrder = $db->prepare("INSERT INTO `order` (`orderid`, `userid`, `datePlaced`, `totalPrice`) VALUES (NULL, ?, ?, ?)");
$createOrder->execute(array($userid, date("Y-m-d"), $totalprice)); //Create order

$sql = "SELECT `orderid` FROM `order` WHERE `userid` = ".$userid." ORDER BY `orderid` DESC LIMIT 1";
$info = $db->query($sql);
$info = $info->fetch(); //Select the order that was just created

$i = $basket[0];
$temp = $basket[0];
$quantity = 0;
foreach ($basket as $item){
    // go through each item in basket, for each item that is duplicated, add 1 to quantity, otherwise add to orderItem with value quantity
    if ($item != $i){
        $i = $item;

        $createOrderItem = $db->prepare("INSERT INTO `orderitems` (`orderItemsid`, `orderid`, `productid`, `quantity`) VALUES (NULL, ?, ?, ?)");
        $createOrderItem->execute(array($info["orderid"], $temp, $quantity));

        $sql = $db -> prepare("UPDATE product SET stock = stock - ".$quantity." WHERE productid = '".$temp."'");
        $sql -> execute();

        $quantity = 0;
    }
    $quantity += 1;
    $temp = $item;
}
$createOrderItem = $db->prepare("INSERT INTO orderitems (orderItemsid, orderid, productid, quantity) VALUES (NULL, ?, ?, ?)");
$createOrderItem->execute(array($info["orderid"], $temp, $quantity));

$rmvBasket = $db->prepare("UPDATE user SET basket = NULL WHERE userid = ".$userid);
$rmvBasket->execute();

header("Location:OrderConfirmation.php");
