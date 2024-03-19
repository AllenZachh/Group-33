<?php
    session_start();
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
        if (isset($_SESSION['accountType'])){
            if ($_SESSION['accountType'] == "admin"){
                echo <<< EOT
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
    <title>Products</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
    <div class="table-container">
        <table class="stock-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>ID</th>
                    <th>Colour</th>
                    <th>Size</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="productTableBody">
            </tbody>
        </table>
    </div>
    <div class="form-container">
        <h2>Add Product</h2>
            <form id="addProductForm">
                <input type="text" id="productName" placeholder="Product Name" required>
                <input type="text" id="productDescription" placeholder="Product Description" required>
                <input type="number" id="productStock" placeholder="Stock" required>
                <input type="text" id="productSize" placeholder="Size" required>
                <input type="text" id="productImageURL" placeholder="Image URL">
                <button type="submit">Add Product</button>
            </form>

         </div>
    </body>
</html>


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
EOT;}} else {
    echo <<< EOT

    <h1>Sorry Nothing Here!!!</h1>

EOT;
}
 ?>