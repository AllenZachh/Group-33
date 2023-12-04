<?php

$servername = "localhost";
$username = "username";
$password = "password";

$conn = new mysqli_connect($servername, $username, $password);
if (!$conn) {
    die('connection failed'. mysql_error());
}
echo 'connected';

$sql = SELECT productTypeid, name , price , description FROM producttype;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Name</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["productTypeid"]. "</td><td>" . $row["name"]. " " . $row["price"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>

?>


