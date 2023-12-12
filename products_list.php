<?php
session_start();
require_once("connectdb.php");
$items = $db->prepare("SELECT * FROM product WHERE (productid, productTypeid) IN (SELECT MIN(productid) as min_productid, productTypeid FROM product GROUP BY productTypeid ) LIMIT 20");
$items->execute();
$products = $items->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/styleAwais.css">        
        <title>Products | Glacier Guys</title>
    </head>

    <?php require_once("navbar.php"); navbar("productList"); ?>
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Coats, Hats...">
            <button class="custom-button" onclick="search()">Search</button>
        </div>


    </div>
        <body>
            <div class="products">
                <h1>Products</h1>
                <div class="product">
                    <?php foreach ($products as $product): ?>
                        <?php
                            $typeid = $product["productTypeid"];
                            $item_specifics = $db->prepare("SELECT * FROM producttype WHERE producttypeid=$typeid ");
                            $item_specifics->execute();
                            $spec = $item_specifics->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <a href="product_page.php?select_product=<?=$product["productid"]?>" class="single-prod">
                            <img src="<?=$product["imageFilePath"]?>" alt="<?=$spec["name"]?>" width="50" height="50">
                            <span class="name" style="color:beige"><?=$spec["name"]?></span>
                            <span class="price" style="color:beige">£<?=$spec["price"]?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </body>
    <footer>
        <a class="socialmedia" href="https://www.instagram.com/" target="_blank">
            <ion-icon size="large" name="logo-instagram"></ion-icon>
        </a>
        <a class="socialmedia" href="https://twitter.com/" target="_blank">
            <ion-icon size="large" name="logo-twitter"></ion-icon>
        </a>
    </footer>
</php>
