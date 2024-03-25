<?php
    session_start();
    require_once('connectdb.php');

    if (isset($_POST['stock'])){
        $stmt = $db->prepare('UPDATE product SET stock = ? WHERE productid = ?');
        $stmt->execute(array($_POST['stock'], htmlspecialchars($_GET["select"])));
    }
?>
        
<!DOCTYPE html>
<link rel="stylesheet" href="./css/style.css">
<script src="./js/script.js"></script>

<head>
    <script src="https://kit.fontawesome.com/de49bed1ab.js" crossorigin="anonymous"></script>
    <?php require_once("navbar.php"); navbar("stockManage"); ?>
</head>

<?php

require_once('connectdb.php');

$var1 = $db->prepare("SELECT * FROM `product`");
$var1->execute();

$result1 = $var1->fetchAll(PDO::FETCH_ASSOC);
if (!isset($_SESSION['accountType']) or $_SESSION['accountType'] != "admin"){
    echo "<h1>Sorry Nothing Here!!!</h1>";
    exit();
}
    
    ?>
    <button onclick="scrollToTop()" id="scrollToTopBtn" title="Go to top">Top</button>

    
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
            <li><a href="IMStock.php">
                <i class="fas fa-warehouse"></i>
                <span>Stock</span>
            </a></li>
        </ul>
        </nav>
    </div>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="script.js" defer></script>
</head>
<body>
 
<?php
try{

    $query="SELECT * FROM product";
    $rows = $db->query($query);
    $query="SELECT * FROM producttype";
    $types = $db->query($query);
    $types =  $types->fetchAll(PDO::FETCH_ASSOC);

    if ($rows && $rows->rowCount()>0){

    ?>
    <div class="table-container">
  <table class = "stock-table">
  <tr><th align='left'><b>Image</b></th ><th align='left'><b>Name</b></th> <th align='left'><b>Description</b></th> <th align='left'><b>Stock</b></th ><th align='left'><b>Size</b></th ><th align='left'>Action</th></tr>
  <?php
    while  ($row =  $rows->fetch())	{
      try{
        echo  " <form method='post' action='IMStock.php?select=".$row['productid']."'>
                <tr><td align='left'><img src = '" . $row['imageFilePath'] . "' height = '200'></img></td>
                <td align='left'>" . $types[$row['productTypeid']-1]['name'] . "</td>
                <td align='left'>". $types[$row['productTypeid']-1]['description'] . "</td>
                <td align='left'><input type = 'number' name = 'stock' value = '" . $row['stock'] . "'></input></td>
                <td align='left'>" . $row['size'] . "</td>";
      
        echo "<td align='left'>
          <button value='edit' class='tbl_btn'>Save</button>
          <input type='hidden' name='edit' />
        </form>
        </td></tr>\n";
      } catch (TypeError){
        echo"item not found";
      }

          }
          echo  '</table></div>';
  } else {
    echo "<p>No Products</p>";
  }
} catch (PDOException $ex) {
  $dbEr = TRUE;
  //echo($ex->getMessage());
}
?>
    </body>
</html>

</body>
