<?php

    session_start();
    require_once('connectdb.php');
    $product = htmlspecialchars($_GET["select_product"]);
    $query="SELECT * FROM product WHERE productid = $product";
        $rows = $db->query($query);
        $product = $rows->fetch();
    $query="SELECT * FROM producttype WHERE productTypeid = ".$product["productTypeid"];
        $rows = $db->query($query);
        $productType = $rows->fetch();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="logo">
    <h1>Glacier Gear</h1>
    <img src = "logo.jpg">
    </div>
    <div class="navigation">
    <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="products.html">Products</a></li>
        <li><a href="contact.html">Contact Us</a></li>
        <li><a href="about.asp">About Us</a></li>
        <div class="navright">
            <li><a href = "search.html">Search</a></li>
            <li><a href="accountpage.html">Account</a></li>
            <li><a href="basket.html">Basket</a></li>
          </div>
      </ul>
    </div>
      <div w3-include-html="/header.html"></div>
      
      
      
      
<div class="productcontainer">
    <div class="pcbox">
        <div class="pcbrow">
            <div class ="productimage">
                <img src = "test.jpg">
                <!--    <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>
                  
                    <img id="expandedImg" style >  
                -->          
                </div>
            <div class = "productinfo">
            <h2 class="pname"><?php echo $productType['name'];  ?></h2>
            <h2 class="pprice"><?php echo $productType['price'];  ?></h3>
            <h5 class="pdesc"><?php echo $productType['description'];  ?></h5>
            <h3>Select your color style:</h3>
            <div  class = "colors">     
                <input type="radio" id="purple" name="colors" value="purple" >
                <label for="purple">
                    <img src = "./images/purple.jpg" onclick="expandImg(this);"/>
                </label><br>
                <input type="radio" id="orange" name="colors" value="orange">
                <label for="orange">
                        <img src = "./images/orange.jpg"  onclick="expandImg(this);"/>
                    </label><br>
                <input type="radio" id="grey" name="colors" value="grey">
                <label for="grey">
                        <img src = "./images/grey.jpg" onclick="expandImg(this);"/>
                    </label><br>
                <input type="radio" id="blue" name="colors" value="blue">
                <label for="blue">
                        <img src = "./images/blue.jpg" onclick="expandImg(this);"/>
                    </label><br>

</div>
<h3>Select your size:</h3>

            <div  class = "size">     
                <input type="radio" id="xsmall" name="size" value="xsmall">
                <label for="xsmall">XS</label><br>
                <input type="radio" id="small" name="size" value="small">
                <label for="small">S</label><br>
                <input type="radio" id="medium" name="size" value="medium">
                <label for="medium">M</label><br>
                <input type="radio" id="large" name="size" value="large">
                <label for="large">L</label>
                <input type="radio" id="xlarge" name="size" value="xlarge">
                <label for="xlarge">XL</label>
</div>
<label for="quantity">Quantity</label>
<input type="number" onclick="finalprice()" id="quantity" name="quantity" min="1" max="100">
<script>
function finalprice() {
    var input = document.getElementById("quantity");
    var temp = input.value * 70;
    var sign = "£"
    document.getElementById("price").innerHTML =sign.concat(temp) ; 
    }

    </script>
<div class = bottom>

</div>
<div class="cart">
<a href="checkout.html">
    <button>Add to Cart</button>
</a>
</div>
<h1 id = "price"</h1>
</div>
</div>
</div>

</div>
</div>

<!--<script>
    function finalprice() {
        var input = document.getElementById("quantity");
        var temp = input.value * 70;
        var sign = "£"
        document.getElementById("price").innerHTML =sign.concat(temp) ; 
        }
    
        function expandImg(image){
           var expandImg = document.getElementById("expandedImg");
           expandImg.src = image.src;
          
        }
        </script>
    -->
</body>
</html>