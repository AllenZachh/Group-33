<?php

$servername = 'localhost';
$db_name = 'glacier_guys';
$username = 'root';
$password = '';

  # Attemp to connect to database, otherwise catch and report error
  try{
    $db = new PDO("mysql:dbname=$db_name;host=$db_host", $username, $password);
} catch(PDOException $ex){
    return("Failed to connect to the database.<br>");
    //echo($ex->getMessage());
}


$sql = "SELECT * FROM orderitems WHERE orderid = 1";
$result = $db -> query ($sql) ;
$result = $result -> fetchAll();

//update stock of selected product 
foreach ($result as $row ) {
    
    $sql = $db -> prepare("UPDATE product SET stock = stock - ".$row['quantity']." WHERE productid = ".$row['productid']);
    $sql -> execute();
}




?>

?>



