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
    <link rel="stylesheet" href="css/styleAwais.css">
    <title>Document</title>
</head>
<body>
    <div class="logo">
    <h1>Glacier Gear</h1>
    <img src = "logo.jpg">
    </div>
    <div class="navigation">
    <ul>
        <li><a href="home.html">Home</a></li>
        <li><a href="products_list.html">Products</a></li>
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
            <div class ="productimage">
                   <img id="expandedImg" src = "<?php echo $product['imageFilePath'] ?>"> 
            </div>

            <div class = "productinfo">
                <form action="/basket.php" method="post"></form>
            <h2 id=""  class="pname"> <?php echo $productType['name']; ?> </h2>
            <h2 id = " " class="pprice"><?php echo $productType['price']; ?></h3>

            <h5 id = "productid" class="productid"></h3>
            <h5 id = " " class="pdesc"><?php echo $productType['description']; ?></h5>

            <h3>Select your color style:</h3>
            <div  id= "colors" class = "colors">

                <?php
                    
                    $query="SELECT * FROM product WHERE productTypeid = ".$product["productTypeid"];
                        $rows = $db->query($query);
                        $rows = $rows->fetchAll();

                    $colours = array();
                    foreach ($rows as $row){
                        if (!in_array($row["colour"], $colours)){
                            echo '  <input type="radio" id="'.$row["imageFilePath"].'" name="colors" value="'.$row["imageFilePath"].'">
                                    <label for="'.$row["imageFilePath"].'">
                                        <img src = "'.$row["imageFilePath"].'" onclick="expandImg(this);"/>
                                    </label><br>';
                            array_push($colours, $row['colour']);
                        }
                    }        

                ?>

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
</form>
<div class = bottom>

</div>
<div class="cart">

    <button  onclick = "checkradio()" class = "cartbutton">Add to Cart</button>
</div>
<h1 id = "price"</h1>
<h2 id = "result"></h2>
</div>
</div>
</div>

</div>
</div>

<script>
    function finalprice() {
        var input = document.getElementById("quantity");
        var temp = input.value * 70;
        var sign = "£";
        document.getElementById("price").innerHTML =sign.concat(temp) ; 
        }
    
    
        function expandImg(image){
           var expandImg = document.getElementById("expandedImg");
           expandImg.src = image.src;
          
        }

        function checkradio() {

            var sizeSelect = document.getElementsByName("size");
            var colorSelect = document.getElementsByName("colors");
            var quantityCheck = document.getElementById("quantity");


            var sizeSelected = false;
            var colorSelected = false;

            for (var i = 0, len = sizeSelect.length; i < len; i++) {
                if (sizeSelect[i].checked === true) {
                    sizeSelected = true;         
                }
            }

            for (var j = 0, len2 = colorSelect.length; j < len2; j++) {
                if (colorSelect[j].checked === true) {
                    colorSelected = true;         
                }
            }



            if (colorSelected === true && sizeSelected  === true && quantityCheck > 0){
                var productname = document.getElementById("pname");
                var sentence = " has been added to your basket";
                document.getElementById("result").innerHTML = productname.concat(sentence);
                }
                else{
                    var incorrect = "You need to select your style, size  and quantity for this product to add to the cart";
                    document.getElementById("result").innerHTML = incorrect;

                }
          
        }
    
        </script>

<footer>
    
</footer>
</body>
</html>
