<?php

session_start();
require_once('connectdb.php');

if (isset($_COOKIE["basket"])) {
    $basket = json_decode($_COOKIE["basket"], true);
    sort($basket);

    $items = array();
    $array = json_decode($_COOKIE["basket"], true);
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

    $fulnm = $_POST['fullname'];
    $email = $_POST['email'];
    $phonenum = $_POST['phnum'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $adrln = $_POST['adrln'];
    $postcode = $_POST['postcode'];
}

$createOrder = $db->prepare("INSERT INTO `order` (`orderid`, `userid`, `datePlaced`, `totalPrice`, `fullName`, `email`, `phoneNumber`, `country`, `city`, `address`, `postcode`) VALUES (NULL, NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$createOrder->execute(array(date("Y-m-d"), $totalprice, $fulnm, $email, $phonenum, $country, $city, $adrln, $postcode)); //Create order

$sql = "SELECT `orderid` FROM `order` WHERE `userid` IS NULL ORDER BY `orderid` DESC LIMIT 1";
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

$array = json_encode(array());
setcookie('basket', $array, time()+3600);

header("Location:OrderConfirmationGuest.php");
