<?php
    session_start();
    require_once('connectdb.php');

    $query="SELECT * FROM complaints";
    $rows = $db->query($query);
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
            <li><a href="complaints.php">
            <i class="fas fa-hand-point-up"></i>
                <span>Complaints</span>
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
 <h1 style = "text-align:center;">Complaints</h1>
    <div class="table-container">
  <table class = "stock-table">
  <tr><th align='left'><b>Name</b></th ><th align='left'><b>Email</b></th> <th align='left'><b>Comment</b></th> <th align='left'><b>Date</b></th ></tr>
  <?php
    while  ($row =  $rows->fetch())	{
        echo  " <tr><td align='left'>" . $row["name"] . "</td>
                <td align='left'>". $row["email"] . "</td>
                <td align='left'>". $row["comment"] ."</input></td>
                <td align='left'>" . $row['date'] . "</td>";
      


  }
?>
    </body>
</html>

</body>
