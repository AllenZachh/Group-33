<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";

$conn = new mysqli_connect($servername, $username, $password);
if (!$conn) {
    die('connection failed'. mysql_error());
}
echo 'connected';

$sql = SELECT productTypeid, name , price , description FROM producttype;
$result = $conn->query($sql);


$conn->close();
?>

?>


