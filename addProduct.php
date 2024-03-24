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

<div class="table-container">
<table class = "stock-table">
<tr><th align='left'><b>Image</b></th ><th align='left'><b>Name</b></th> <th align='left'><b>Description</b></th><th align='left'><b>Price (£)</b></th><th align='left'><b>Keywords<br>Make sure to add the type of item!<br>e.g. 'Coat' or 'Hat'</b></tr>

<?php
echo "<br><br><h1 class='IMTitle'>Add a product!</h1>";

echo '<form method="post" action="addProduct.php" enctype="multipart/form-data"><tr>
<td><label for="img">Please Upload Hover Image</label><input name="fileToUpload" id="fileToUpload" type="file" accept="img/*"></label></td>
<td><input type="textbox" name="name" required/></td>
<td><input type="textbox" name="description" required/></td>
<td><input type="number" name="price" required/></td>
<td><input type="textbox" name="keywords" required/></td>
</tr></table></div>';

  ?>
  <div class="table-container">
  <table class = "stock-table">
  <tr><th align='left'><b>Size</b></th ><th align='left'><b>Stock</b></th> <th align='left'><b>Colour</b></th></tr>

  <?php
  $sizes = array('XS', 'S', 'M', 'L', 'XL');
  foreach($sizes as $size){
  echo'<tr>
  <td>'.$size.'</td>
  <td><input type="number" name="stock'.$size.'" required/></td>';
  if ($size == "XS"){
    echo '<td><input type="textbox" name="colour" required/></td>';
  } else{
    echo'<td></td>';
  }
  echo '</div></td></tr>';
  }
  echo '<td><label for="img">Please select an image for this product:<input name="fileToUpload2" id="fileToUpload2" type="file" accept="img/*"></td>
  <div class="submit"><td></td><td>
  <input type="submit" value="Add" class="tbl_btn"> <input type="hidden" name="addproduct" value="true"></form>';

if (isset($_POST["addproduct"])){

$name=isset($_POST["name"])?$_POST["name"]:false;
$description=isset($_POST["description"])?$_POST["description"]:false;
$keywords=isset($_POST["keywords"])?$_POST["keywords"]:false;
$price=isset($_POST["price"])?$_POST["price"]:false;

$colour=isset($_POST["colour"])?$_POST["colour"]:false;

include('uploadFile.php');

try{

  $stat = $db->prepare('INSERT INTO producttype (productTypeid, name, keywords, price, description, hoverImageFilePath) VALUES (NULL, ?, ?, ?, ?, ?)');
  $stat->execute(array($name, $keywords, $price, $description, $target_file));
  
  $stmt = $db->prepare('SELECT productTypeid FROM producttype WHERE hoverImageFilePath = "'.$target_file.'" LIMIT 1');
  $stmt->execute();
  $id = $stmt->fetch();

  foreach($sizes as $size){
    $stock=isset($_POST["stock".$size])?$_POST["stock".$size]:false;
    $stat = $db->prepare('INSERT INTO product (productid, productTypeid, stock, colour, size, imageFilePath) VALUES (NULL, ?, ?, ?, ?, ?)');
    $stat->execute(array($id['productTypeid'], $stock, $colour, $size, $target_file2));
  }
  header("Location:IMProducts.php");

} catch (PDOexception $ex){
  $error = TRUE;
}

}

    ?>

</body>
<?php require_once("footer.php"); ?>