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
    if (!isset($_SESSION['accountType']) OR $_SESSION['accountType'] != "admin"){
        echo '<h1>Sorry Nothing Here!!!</h1>';
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
            <li><a href="IMAnalytics.php">
                <i class="fas fa-chart-bar"></i>
                <span>Analytics</span>
            </a>
            </li>
        </ul>
        </nav>
    </div>
   
    <?php
try{

    if (isset($_GET["q"])){
        $query="SELECT * FROM product WHERE keywords LIKE '%".$_GET['q']."%'";
        $rows = $db->query($query);
    } else {
      $query="SELECT * FROM producttype";
      $rows = $db->query($query);
    }
    $query="SELECT * FROM product";
    $types = $db->query($query);
    $types =  $types->fetchAll(PDO::FETCH_ASSOC);

    if ($rows && $rows->rowCount()>0){

    ?>
    <div class="table-container">
  <table class = "stock-table">
  <tr><th align='left'><b>Image</b></th ><th align='left'><b>Name</b></th> <th align='left'><b>Description</b></th><th align='left'>Action</th></tr>
  <?php
    while  ($row =  $rows->fetch())	{
        $img = $db->query("SELECT imageFilePath FROM product WHERE productTypeid = ".$row['productTypeid']." AND size = 'M' LIMIT 1");
        $img = $img->fetch(PDO::FETCH_ASSOC);
        echo  " <form method='post' action='editProduct.php?select=".$row['productTypeid']."'>
                <tr><td align='left'><img src = '" . $img['imageFilePath'] . "' height = '200'></img></td>
                <td align='left'>" . $row['name'] . "</td>
                <td align='left'>". $row['description'] . "</td>";
      
        echo "<td align='left'>
          <button value='edit' class='tbl_btn'>Edit</button>
          <input type='hidden' name='edit' />
        </form>
        </td></tr>\n";

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
    <div class="addbtn"><input type="button" onclick="location.href='addProduct.php';" value="Add New Product"><br></div>
    <div class="addbtn2"><input type="button" onclick="location.href='addProductColour.php';" value="Add Colour Variant of Existing Product"></div>
    <footer>
        <a class="socialmedia" href="https://www.instagram.com/" target="_blank">
            <ion-icon size="large" name="logo-instagram"></ion-icon>
        </a>
        <a class="socialmedia" href="https://twitter.com/" target="_blank">
            <ion-icon size="large" name="logo-twitter"></ion-icon>
        </a>
        
    </footer>



</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>