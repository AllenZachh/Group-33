<?php

    session_start();
    require_once('connectdb.php');
    $result = "";

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

    //Checks if the page was loaded with POST method, then checks if everything was entered, then updates the basket cookie
    if (isset($_POST["size"])) {
        $productSize = $_POST["size"];
        $rows = $db->query("SELECT productid FROM product WHERE size = '".$productSize."' AND colour = '".$product["colour"]."' AND productTypeid = '".$product["productTypeid"]."'");
        $selectProduct = $rows->fetch();
        $prod = $selectProduct[0];
        $array = array();

        if (isset($_SESSION["username"])){
            $query="SELECT basket FROM user WHERE username = '".$_SESSION["username"]."'";
            try{
                $array = json_decode(($db->query($query))->fetch()[0]);
                array_push($array, $prod);
            } catch (TypeError){
                $array = [];
                array_push($array, $prod);
            }
            $array = json_encode($array, true);

            $stat = $db->prepare('UPDATE user SET basket = ? WHERE username = "'.$_SESSION['username'].'"');
			$stat->execute(array($array));

        } else {
            if (isset($_COOKIE["basket"]) && $_COOKIE["basket"] != 'null') {
                $array = json_decode($_COOKIE["basket"], true);
            }
            array_push($array, $prod);
            $array = json_encode($array, true);
            setcookie('basket', $array, time()+3600);
        }


        $result = "Item added to basket";
    } else {
        $result = "Please select a colour and size";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleAwais.css">
    <title>Document</title>
    <?php require_once("navbar.php"); navbar("productList"); ?>
</head>
<body>
      
      
      
<div class="productcontainer">
            <div class ="productimage">
                   <img id="expandedImg" src = "<?php echo $product['imageFilePath'] ?>"> 
            </div>

            <div class = "productinfo">
            <h2 id=""  class="pname"> <?php echo $productType['name']; ?> </h2>
            <h2 id = " " class="pprice">£<?php echo $productType['price']; ?></h3>

            <h5 id = "productid" class="productid"></h3>
            <h5 id = " " class="pdesc"><?php echo $productType['description']; ?></h5>
            <form action="<?php echo $_SERVER['PHP_SELF'].'?select_product='.$product['productid'];?>" method="POST">

            <h3>Select your color style:</h3>
            <div  id= "colors" class = "colors">

                <?php

                    // Display colour options for that item
                    $colours = array();
                    foreach ($productRows as $row){
                        $row = $db->query("SELECT * FROM product WHERE colour = '".$row['colour']."' AND productTypeid = '".$product['productTypeid']."'")->fetch();
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
                                        <label for="'.$row["size"].'">'.$row["size"].'<br><br>'.strval($row["stock"]).'</label><br>';
                                array_push($sizes, $row['size']);
                            }
                        }
                    }       
                    

                ?>

</div>
<!-- <label for="quantity">Quantity</label>
<input type="number" onclick="finalprice()" id="quantity" name="quantity" min="1" max="<?php echo $product['stock']; ?>"> -->
<button  onclick = "checkradio()" class = "cartbutton">Add to Cart</button>
<input type="hidden" name="submitted" value="true">
</form>

<!-- Button to send to review page-->
<form action="review.php" method="get">
    <input type="hidden" id="product_id" name="product_id" value="<?php echo $product['productid']?>">
    <input class = "reviewbutton" type="submit" value="Reviews!">
</form>

<div class = bottom>
    <h5 id = "productid" class="productid"></h3>
    <h3><?=$result?> </h3>

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
    
        </script>

<footer>
    
</footer>
</body>
</html>
