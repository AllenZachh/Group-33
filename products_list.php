<?php
session_start();
require_once("connectdb.php");

$items = $db->prepare("SELECT * FROM product WHERE (productid, productTypeid) IN (SELECT MIN(productid) as min_productid, productTypeid FROM product GROUP BY productTypeid) LIMIT 20");
$items->execute();
$products = $items->fetchAll(PDO::FETCH_ASSOC);
$sort = isset($_GET["sort_by"]) ? htmlspecialchars($_GET["sort_by"]) : NULL;
if (isset($_GET["select"])){
  $_GET['q'] = htmlspecialchars($_GET["select"]);
}
if (isset($_GET['q'])){
  $prods = $products;
  $products = array();
  if (isset($_GET['sort_by'])){
    if ($sort == "PriceLH"){
      $srch = $db->prepare("SELECT productTypeid FROM producttype WHERE keywords LIKE '%".$_GET['q']."%' ORDER BY price ASC");
    } if ($sort == "PriceHL"){
      $srch = $db->prepare("SELECT productTypeid FROM producttype WHERE keywords LIKE '%".$_GET['q']."%' ORDER BY price DESC");
    } if ($sort == "A2Z"){
      $srch = $db->prepare("SELECT productTypeid FROM producttype WHERE keywords LIKE '%".$_GET['q']."%' ORDER BY name ASC");
    }
  } else {
    $srch = $db->prepare("SELECT productTypeid FROM producttype WHERE keywords LIKE '%".$_GET['q']."%'");
  }
  $srch->execute();
  $productTypes = $srch->fetchAll(PDO::FETCH_ASSOC);

  foreach ($productTypes as $prodType){
    foreach($prods as $prod)
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
    <body>
    <?php require_once("navbar.php"); navbar("productList"); ?>
        <div class="search-container">
          <form method="get" action="products_list.php" class="search-bar">
          <input type="text" placeholder="Search..." name="q" id="search">
          <button type="submit"><img src="./images/search-icon-free-vector.jpg"></button>
          <input type="hidden" name="submitted" value="true">
        </div>
          <div class="pagerow">
            <h2>Sort</h2>

                <input type="radio" id="priceLH" name="sort_by" value="PriceLH">
                <label for="priceLH">Price(Lowest to Highest)</label>

                <input type="radio" id="priceHL" name="sort_by" value="PriceHL">
                <label for="priceHL">Price(Highest to Lowest)</label>

                <input type="radio" id="a2z" name="sort_by" value="A2Z">
                <label for="a2z">A-Z</label>

              <button id = "makeChanges" type = "buton">Confirm</button>
            </form>
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
                          <a href="product_page.php?select_product=<?=$product["productid"]?>" class="single-prod">
                              <img src="<?=$product["imageFilePath"]?>" alt="<?=$spec["name"]?>" width="50" height="50">
                          </a> 
                    <?php endforeach; ?>
                </div>
                    </div>
            </div>
        </div>
        </body>
    <footer>
      <?php require_once("footer.php"); ?>
    </footer>

<style>
      .pagerow {
  display: inline-block;
}

.pagecolumn {
  float: left;
}

.left {
  width: 25%;
}

.right {
  width: 100%;
}

.product img {
  size: 200px;
  
}

.gh p {
  font-size: large;
}

.product {
    width: 99%;
  margin: 1rem;
  text-align: center;

  font-family: 'Times New Roman', Times, serif;
}

.product img {
  padding: 3%;
    width: 400px;
    height:500px;
    float: left;
    object-fit:initial ;
}

.productcontainer {
  width: 50%;
    border: 3px solid #fff;
    padding: 30px;
    text-align: center;
}

.img-container{
  display: inline-block;
  border: 1px solid red;
  padding: 1rem 1rem;
  vertical-align: middle;
}
</style>