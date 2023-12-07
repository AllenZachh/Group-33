<?php

    session_start();
    require_once('connectdb.php');

    // Selects the product and prodcutType from table using the html attribute, aswell as every type of the productType
    $product = htmlspecialchars($_GET["select_product"]);
    $query="SELECT * FROM product WHERE productid = $product";
        $rows = $db->query($query);
        $product = $rows->fetch();
    $query="SELECT * FROM producttype WHERE productTypeid = ".$product["productTypeid"];
        $rows = $db->query($query);
        $productType = $rows->fetch();
    $query="SELECT * FROM product WHERE productTypeid = ".$product["productTypeid"];
        $rows = $db->query($query);
        $productRows = $rows->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleAwais.css">
    <title>Document</title>
</head>
<body>
    <div class="logo">
    <h1>Glacier Gear</h1>
    <img src = "./images/logo.jpg">
    </div>
    <div class="navigation">
    <ul>
        <li><a href="home.php">Home</a></li>
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
            <h2 id = " " class="pprice">£<?php echo $productType['price']; ?></h3>

            <h5 id = "productid" class="productid"></h3>
            <h5 id = " " class="pdesc"><?php echo $productType['description']; ?></h5>

            <h3>Select your color style:</h3>
            <div  id= "colors" class = "colors">

                <?php

                    // Display colour options for that item
                    $colours = array();
                    foreach ($productRows as $row){
                        $row = $db->query("SELECT * FROM product WHERE colour = '".$row['colour']."' AND size = '".$product['size']."'")->fetch();
                        if (!in_array($row['colour'], $colours)){
                            if ($row['productid'] == $product['productid']){
                                $st = 'checked="checked"';
                            } else {
                                $st = "" ;
                            }
                            echo '  <input type="radio" id="'.$row["colour"].'" name="colours" value="'.$row["colour"].'" class="colour" '.$st.'>
                                    <label for="'.$row["colour"].'">
                                        <a href="product_page.php?select_product='.$row["productid"].'"> <img src = "'.$row["imageFilePath"].'"/> </a>
                                    </label><br>';
                            array_push($colours, $row['colour']);
                        }
                    }        

                ?>

</div>
<h3>Select your size:</h3>

            <div  class = "size">  

                <?php

                    $order = array("XS" => 0, "S" => 1, "M" => 2, "L" => 3, "XL" => 4);                
                    $sizes = array(null, null, null, null, null);

                    // Rearange the sizes into predefined order os "XS, S, M, L, XL"
                    foreach ($productRows as $row){
                        if ($row['colour'] == $product['colour']){
                            $productRows[$order[$row['size']]] = $row;
                        }
                    }

                    // Display size options for that item
                    foreach ($productRows as $row){
                        if ($row['colour'] == $product['colour']){
                            $row = $db->query("SELECT * FROM product WHERE colour = '".$product['colour']."' AND size = '".$row['size']."'")->fetch();
                            if ($row['stock'] <= 0){
                                $st = 'disabled';
                            } else {
                                $st = "" ;
                            }
                            if (!in_array($row['size'], $sizes)){
                                echo '  <input type="radio" id="'.$row["size"].'" name="size" value="'.$row["size"].'" class="size" '.$st.'>
                                        <label for="'.$row["size"].'">'.$row["size"].'</label><br>';
                                array_push($sizes, $row['size']);
                            }
                        }
                    }       
                    

                ?>

</div>
<label for="quantity">Quantity</label>
<input type="number" onclick="finalprice()" id="quantity" name="quantity" min="1" max="<?php echo $product['stock']; ?>">
</form>
<div class = bottom>
    <h5 id = "productid" class="productid"></h3>
    <h5 id = " " class="pstock"><?php echo $product['stock']; ?> Left in Stock!</h5>

</div>
<div class="cart">

    <button  onclick = "checkradio()" class = "cartbutton">Add to Cart</button>
</div>
<h1 id = "price"></h1>
<h2 id = "result"></h2>
</div>
</div>
</div>

</div>
</div>

<script>
    function finalprice() {
        var input = document.getElementById("quantity");
        var temp = input.value * <?php echo $productType['price'];  ?>;
        var sign = "£";
        document.getElementById("price").innerHTML =sign.concat(temp) ; 
        }
    
    
        function expandImg(image){
           var expandImg = document.getElementById("expandedImg");
           expandImg.src = image.src;
          
        }

        function checkradio() {

            var sizeSelect = document.querySelector('.size:checked').value;
            var colourSelect = document.querySelector('.colour:checked').value;
            var quantityCheck = document.getElementById("quantity");


            var sizeSelected = false;
            var colorSelected = false;

            console.log(colourSelect)
            console.log(sizeSelect)

            if (sizeSelect) {
                sizeSelected = true;         
            }

            if (colourSelect) {
                colorSelected = true;         
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
