<?php

require_once('connectdb.php');

$sql = "SELECT * FROM orderitems WHERE orderid = 1";
$result = $db -> query ($sql) ;
$result = $result -> fetchAll();

foreach ($result as $row ) {
    
    $sql = $db -> prepare("UPDATE product SET stock = stock - ".$row['quantity']." WHERE productid = ".$row['productid']);
    $sql -> execute();
}

?>
