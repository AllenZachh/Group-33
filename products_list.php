<?php
session_start();
require_once("connectdb.php");
$items = $db->prepare("SELECT * FROM product WHERE (productid, productTypeid) IN (SELECT MIN(productid) as min_productid, productTypeid FROM product GROUP BY productTypeid ) LIMIT 20");
$items->execute();
$products = $items->fetchAll(PDO::FETCH_ASSOC);
if (isset($_GET["select"])){
  $_GET['q'] = htmlspecialchars($_GET["select"]);
}
if (isset($_GET['q'])){
  $prods = $products;
  $products = array();
  $srch = $db->prepare("SELECT productTypeid FROM producttype WHERE keywords LIKE '%".$_GET['q']."%'");
  $srch->execute();
  $productTypes = $srch->fetchAll(PDO::FETCH_ASSOC);

  foreach ($prods as $prod){
    foreach($productTypes as $prodType)
    if (in_array($prod['productTypeid'], $prodType)){
      array_push($products, $prod);
    }
  }
}
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
          <form method="get" action="products_list.php" class="search-bar">
          <input type="text" placeholder="Search..." name="q" id="search">
          <button type="submit"><img src="./images/search-icon-free-vector.jpg"></button>
          <input type="hidden" name="submitted" value="true">
        </div>


    </div>
        <body>
        <div class="pagerow">
          <div class="pagecolumn left">
            <h2>Sort</h2>
            <input type="radio" id="popular" name="sortby" value="Most Popular">
            <label for="popular">Most Popular</label><br>

            <input type="radio" id="priceLH" name="sortby" value="Price ()">
            <label for="priceLH">Price(Lowest to Highest)</label><br>

            <input type="radio" id="priceHL" name="sortby" value="Price">
            <label for="priceHL">Price(Highest to Lowest)</label>

            <input type="radio" id="a2z" name="sortby" value="A2Z">
            <label for="a2z">A-Z</label>

            <h2>Category</h2>
            <input type="checkbox" id="category1" name="category1" value="category1">
            <label for="category1">category1</label><br>
            <input type="checkbox" id="category2" name="category2" value="category2">
            <label for="category2">category2</label><br>
            <input type="checkbox" id="category3" name="category3" value="category3">
            <label for="category3">category3</label><br>

            <h2>Size</h2>
            <input type="checkbox" id="xs" name="xs" value="xs">
            <label for="xs">XS</label><br>
            <input type="checkbox" id="s" name="s" value="s">
            <label for="s">S</label><br>
            <input type="checkbox" id="m" name="m" value="m">
            <label for="m">M</label><br>
            <input type="checkbox" id="l" name="l" value="l">
            <label for="l">L</label><br>
            <input type="checkbox" id="xl" name="xl" value="xl">
            <label for="xl">XL</label><br>

            <h2>Colour</h2>
            <input type="checkbox" id="red" name="red" value="red">
            <label for="red"></label>red</label><br>
            <input type="checkbox" id="blue" name="blue" value="blue">
            <label for="blue">blue</label><br>
            <input type="checkbox" id="green" name="green" value="green">
            <label for="green">green</label><br>

            <h2>Price</h2>
            <span class="multi-range-price">
              <input type="range" min="0" max="1000" value="0" id="lower">
              <input type="range" min="0" max="1000" value="1000" id="upper">
            </span>
            <p>Lowest Price: £<span id="lowerValue">
              <p>Highest Price: £<span id="upperValue"></span>
              </span>
              <p></p>
              <button id = "makeChanges" type = "buton">Confirm</button>
            </div>
            <div class="pagecolumn right">
                <h1>Products</h1>
<div id = "productcontainer">
                <div class="product">
                    <?php foreach ($products as $product): ?>
                        <?php
                            $typeid = $product["productTypeid"];
                            $item_specifics = $db->prepare("SELECT * FROM producttype WHERE producttypeid=$typeid  ");
                            $item_specifics->execute();
                            $spec = $item_specifics->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <div class = "img-container">
                        <a href="product_page.php?select_product=<?=$product["productid"]?>" class="single-prod">
                            <img src="<?=$product["imageFilePath"]?>" alt="<?=$spec["name"]?>" width="50" height="50">
                        </a> </div>
                    <?php endforeach; ?>
                </div>
                    </div>
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

<script>

var slider = document.getElementById("lower");
var output = document.getElementById("lowerValue");
var slider2 = document.getElementById("upper");
var output2 = document.getElementById("upperValue");


lowerValue.innerHTML = lower.value;
upperValue.innerHTML = upper.value;


slider.oninput = function() {
  output.innerHTML = this.value;
  if (lowerValue > upperValue){
    lowerValue.innerHTML = upper.value - 1;

  }
}
slider2.oninput = function() {
  output2.innerHTML = this.value;
}



</script>

<style>
    .pagerow {
  display: flex;
  flex: 1;
}
.pagecolumn {
  float: left;
}

.left {
  width: 25%;
}

.right {
  width: 75%;
}

.product img {
  size: 200px;
  
}

.gh p {
  font-size: large;
}

.product {
    width: 50%;
    float: left;
    padding: 20px;

  font-family: 'Times New Roman', Times, serif;
}

.product img {
    width: 50%;
    height:70%;
}

.productcontainer {
    border: 3px solid #fff;
    padding: 20px;
    text-align: center;
}

.img-container{
}

</style>
