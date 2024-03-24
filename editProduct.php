<?php
    session_start();
    require_once('connectdb.php');
?>
        
<!DOCTYPE html>
<link rel="stylesheet" href="./css/style.css">
<script src="./js/script.js"></script>

<head>
    <script src="https://kit.fontawesome.com/de49bed1ab.js" crossorigin="anonymous"></script>
    <?php require_once("navbar.php"); navbar("stockManage"); ?>
</head>

<body>
    <?php
        if (!isset($_SESSION['accountType']) or $_SESSION['accountType'] != "admin"){
            echo "<h1>Sorry Nothing Here!!!</h1>";
            exit();
        }
    
    ?>
    <button onclick="scrollToTop()" id="scrollToTopBtn" name="Go to top">Top</button>

    
    <div class="sidebar">
        <nav>
        <ul>
            <li><a href="IMProducts.php">
              <i class="fas fa-shirt"></i>
              <span class="nav-item">Products</span>
            </a></li>
            <li><a href="IMReport.php">
                <i class="fas fa-newspaper"></i>
                <span class="nav-item">Report</span> 
            </a></li>
            <li><a href="ImStock.php">
                <i class="fas fa-warehouse"></i>
                <span>Stock</span>
            </a></li>
            <li><a href="IMAnalytics.php">
                <i class="fas fa-chart-bar"></i>
                <span>Analytics</span>
            </a>
            </li>
        </ul>
        </nav>
    </div>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <script src="script.js" defer></script>
</head>
<body>

    <?php

$productToChange =  $db->query("SELECT * FROM productType WHERE productTypeid ='".$_GET['select']."'")->fetch();
$name = $productToChange["name"];
$description = $productToChange["description"];
$price = $productToChange["price"];

?>
<div class="table-container">
<table class = "stock-table">
<tr><th align='left'><b>Image</b></th ><th align='left'><b>Name</b></th> <th align='left'><b>Description</b></th><th align='left'>Price</th></tr>

<?php
$query="SELECT * FROM product WHERE productTypeid = ".$productToChange['productTypeid'];
$types = $db->query($query);
$types =  $types->fetchAll(PDO::FETCH_ASSOC);
echo "<br><br><h1 class='IMTitle'>Edit your product!</h1>";

echo '<form method="post" action="editproduct.php?select='.$productToChange['productTypeid'].'"><tr>
<td><img src="'. $types[0]['imageFilePath'] . '"/></label></td>
<td><input type="textbox" name="name" value ="' . $productToChange['name'] . '" required/></td>
<td><input type="textbox" name="description" value ="' . $productToChange['description'] . '" required/></td>
<td><input type="number" name="price" value ="' . $productToChange['price'] . '" required/></td>
<td><div class="submit">
  <input type="submit" value="Save" class="tbl_btn"> <input type="hidden" name="changeproduct" value="true"></td></tr>';

if (isset($_POST["changeproduct"])){

$name=isset($_POST["name"])?$_POST["name"]:false;
$description=isset($_POST["description"])?$_POST["description"]:false;

if (isset($_FILES['img'])){
    move_uploaded_file($file['tmp_name'], 'images/' . $file['name']);
}

try{

  $stat = $db->prepare('UPDATE productType SET name=?, description=?, price=? WHERE productTypeid = '.$productToChange['productTypeid']);
  $stat->execute(array($name, $description, $price));
  header("Location:IMProducts.php");

} catch (PDOexception $ex){
  $error = TRUE;
}

}

    ?>

</body>