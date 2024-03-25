<?php

session_start();
require_once('connectdb.php');

$query= "SELECT * FROM `orderitems` WHERE orderItemsid = ".$_GET['orderitems_id'];
$row = $db->query($query);
$row = $row->fetch();

$query= "SELECT * FROM `order` WHERE orderid = ".$row['orderid'];
$order = $db->query($query);
$order = $order->fetch();

$query= "SELECT productTypeid FROM `product` WHERE productid = ".$row['productid'];
$prod = $db->query($query);
$prod = $prod->fetch();

$query= "SELECT price FROM `productType` WHERE productTypeid = ".$prod['productTypeid'];
$price = $db->query($query);
$price = $price->fetch();

$newPrice = $order['totalPrice']-$price[0];

if ($_SESSION['userid'] == $order['userid']){
    $stat = $db->prepare('UPDATE `order` SET totalPrice = ? WHERE orderid = ?');
    $stat->execute(array($newPrice, $row['orderid']));

    //$stat = $db->prepare('DELETE FROM `orderitems` WHERE orderItemsid = ?');
    //$stat->execute(array($_GET['orderitems_id']));

    header('Location: orders.php');
    exit();
}