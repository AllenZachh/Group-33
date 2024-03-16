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
require_once 'FPDF/fpdf.php';
require_once 'connection.php';
$sql = //select row from table;
$data = mysqli_query($con, $sql);

if(isset($_POST['btn_pdf']))

{
  $pdf = new FPDF('p','mm','a4');
  $pdf -> SetFont('arial', 'b', '12');
  $pdf -> cell('40','10','Product','1','0','C');

  while ($row = mysqli_fetch_assoc($data))

  {
    $pdf -> cell('40','10',row['Product'],'1','0','C');
  }

  $pdf -> Output();
}
