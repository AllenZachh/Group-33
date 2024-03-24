<?php

    session_start();
    require_once('connectdb.php');

?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./css/style.css">
<script src="./js/script.js"></script>

<head>
    <title>Home | Glacier Guys</title>
</head>

<body>
    <button onclick="scrollToTop()" id="scrollToTopBtn" title="Go to top">Top</button>

    <?php require_once("navbar.php"); navbar("home"); ?>
    <div class="search-container">
                <input type="text" id="searchInput" placeholder="Coats, Hats...">
                <button class="custom-button" onclick="search()">Search</button>

    </div>
   <div class="slider">
    <input type="radio" name="slide-btn" id="radio1" checked>
    <input type="radio" name="slide-btn" id="radio2">
    <input type="radio" name="slide-btn" id="radio3">
    <input type="radio" name="slide-btn" id="radio4">

    <div class="slides">
        <div class="slide">
            <a href="products_list.php?select=Coat"><img src="./images/man-in-coat.png" style="width:100%; height:100%;" alt="Slider Image 1"></a>
                <div class="slide-content">
                <p class="slide-text">Coats</p>
                    <p class="additional-slide-text">An extensive range of top of the market coats for you winter adventures.</p>
            </div>
        </div>
        <div class="slide">
        <a href="products_list.php?select=Hat"><img src="./images/man-in-hat.png" style="width:100%; height:100%;" alt="Slider Image 1"></a>
            <div class="slide-content">
                <p class="slide-text">Complete Your Look</p>
                <p class="additional-slide-text">Explore our range of stylish hats and beanies, perfect for chilly days and nights.</p>
            </div>
        </div>
        <div class="slide">
        <a href="products_list.php?select=Accessory"><img src="./images/man-with-goggles.png" style="width:100%; height:100%;" alt="Slider Image 1"></a>
            <div class="slide-content">
                <p class="slide-text">Essential Winter Accessories</p>
                <p class="additional-slide-text">Accessorize with our scarves and shawls to add flair to your winter outfit.</p>
            </div>
        </div>
        <div class="slide">
            <a href="products_list.php?select=Boot,Glove"><img src="./images/man-with-gloves.jpg" style="width:100%; height:100%;" alt="Slider Image 1"></a>
            <div class="slide-content">
                <p class="slide-text">Gear Up for Winter Adventures</p>
                <p class="additional-slide-text">Discover our range of boots and gloves designed for durability and warmth in the toughest conditions.</p>
            </div>
        </div>
    </div>

    <div class="navigation-auto">
        <div class="auto-btn1"></div>
        <div class="auto-btn2"></div>
        <div class="auto-btn3"></div>
        <div class="auto-btn4"></div>
    </div>

    <div class="navigation-manual">
        <label for="radio1" class="manual-btn"></label>
        <label for="radio2" class="manual-btn"></label>
        <label for="radio3" class="manual-btn"></label>
        <label for="radio4" class="manual-btn"></label>
    </div>
</div>

    </div>

    <div class="Coats" id="Coats">
        <div class="coats-section">
            <h2>Coats</h2>
            <div class="images-container">
                <?php

                    // Queries the database to find all productTypes with the keyword "Coat", Then displays each type once
                        $query= "SELECT * FROM producttype WHERE keywords LIKE '%Coat%'";
                        $rows = $db->query($query);
                        $rows = $rows->fetchAll();
                        foreach ($rows as $row){
                            $query= "SELECT * FROM product WHERE productTypeid = ".$row['productTypeid']." AND size = 'M' LIMIT 1";
                            $rows = $db->query($query);
                            $rows = $rows->fetchAll();
                            while (current($rows)) {
                                echo '  <div class="coat-item">
                                            <a href="product_page.php?select_product='.current($rows)['productid'].'"> <img src="'.current($rows)['imageFilePath'].'" alt="Coat" class="original-img"> </a>
                                            <a href="product_page.php?select_product='.current($rows)['productid'].'"> <img src="'.$row['hoverImageFilePath'].'" alt="Coat Hover" class="hover-img"> </a>
                                            <p class="coat-text">'.$row["name"]." £".$row['price'].'</p>
                                        </div>';
                                next($rows);
                            }
                        }
                    ?>
                </div>            
            </div>
        </div>
    </div>
     
    <div class="Hats" id="Hats">
        <div class="hats-section">
            <h2>Hats</h2>
            <div class="images-container">
                <?php

                    // Queries the database to find all productTypes with the keyword "Coat", Then displays each type once
                        $query= "SELECT * FROM producttype WHERE keywords LIKE '%Hat%'";
                        $rows = $db->query($query);
                        $rows = $rows->fetchAll();
                        foreach ($rows as $row){
                            $query= "SELECT * FROM product WHERE productTypeid = ".$row['productTypeid']." AND size = 'M' LIMIT 1";
                            $rows = $db->query($query);
                            $rows = $rows->fetchAll();
                            while (current($rows)) {
                                echo '  <div class="hat-item">
                                            <a href="product_page.php?select_product='.current($rows)['productid'].'"> <img src="'.current($rows)['imageFilePath'].'" alt="Coat" class="original-img"> </a>
                                            <a href="product_page.php?select_product='.current($rows)['productid'].'"> <img src="'.$row['hoverImageFilePath'].'" alt="Coat Hover" class="hover-img"> </a>
                                            <p class="hat-text">'.$row["name"]." £".$row['price'].'</p>
                                        </div>';
                                next($rows);
                            }
                        }
                    ?>
                </div>            
            </div>
        </div>
    </div>

    <div class="Boots" id="Boots">
        <div class="boots-section">
            <h2>Boots</h2>
            <div class="images-container">
                <?php

                    // Queries the database to find all productTypes with the keyword "Coat", Then displays each type once
                        $query= "SELECT * FROM producttype WHERE keywords LIKE '%Boot%'";
                        $rows = $db->query($query);
                        $rows = $rows->fetchAll();
                        foreach ($rows as $row){
                            $query= "SELECT * FROM product WHERE productTypeid = ".$row['productTypeid']." AND size = 'M' LIMIT 1";
                            $rows = $db->query($query);
                            $rows = $rows->fetchAll();
                            while (current($rows)) {
                                echo '  <div class="boot-item">
                                            <a href="product_page.php?select_product='.current($rows)['productid'].'"> <img src="'.current($rows)['imageFilePath'].'" alt="Coat" class="original-img"> </a>
                                            <a href="product_page.php?select_product='.current($rows)['productid'].'"> <img src="'.$row['hoverImageFilePath'].'" alt="Coat Hover" class="hover-img"> </a>
                                            <p class="boot-text">'.$row["name"]." £".$row['price'].'</p>
                                        </div>';
                                next($rows);
                            }
                        }
                    ?>
                </div>            
            </div>
        </div>
    </div>

    <div class="Gloves" id="Gloves">
        <div class="gloves-section">
            <h2>Gloves</h2>
            <div class="images-container">
                <?php

                    // Queries the database to find all productTypes with the keyword "Coat", Then displays each type once
                        $query= "SELECT * FROM producttype WHERE keywords LIKE '%Glove%'";
                        $rows = $db->query($query);
                        $rows = $rows->fetchAll();
                        foreach ($rows as $row){
                            $query= "SELECT * FROM product WHERE productTypeid = ".$row['productTypeid']." AND size = 'M' LIMIT 1";
                            $rows = $db->query($query);
                            $rows = $rows->fetchAll();
                            while (current($rows)) {
                                echo '  <div class="glove-item">
                                            <a href="product_page.php?select_product='.current($rows)['productid'].'"> <img src="'.current($rows)['imageFilePath'].'" alt="Coat" class="original-img"> </a>
                                            <a href="product_page.php?select_product='.current($rows)['productid'].'"> <img src="'.$row['hoverImageFilePath'].'" alt="Coat Hover" class="hover-img"> </a>
                                            <p class="glove-text">'.$row["name"]." £".$row['price'].'</p>
                                        </div>';
                                next($rows);
                            }
                        }
                    ?>
                </div>            
            </div>
        </div>
    </div>

    <div class="Accessories" id="Accessories">
        <div class="accessories-section">
            <h2>Accessorys</h2>
            <div class="images-container">
                <?php

                    // Queries the database to find all productTypes with the keyword "Coat", Then displays each type once
                        $query= "SELECT * FROM producttype WHERE keywords LIKE '%Accessory%'";
                        $rows = $db->query($query);
                        $rows = $rows->fetchAll();
                        foreach ($rows as $row){
                            $query= "SELECT * FROM product WHERE productTypeid = ".$row['productTypeid']." AND size = 'M' LIMIT 1";
                            $rows = $db->query($query);
                            $rows = $rows->fetchAll();
                            while (current($rows)) {
                                echo '  <div class="accessory-item">
                                            <a href="product_page.php?select_product='.current($rows)['productid'].'"> <img src="'.current($rows)['imageFilePath'].'" alt="Coat" class="original-img"> </a>
                                            <a href="product_page.php?select_product='.current($rows)['productid'].'"> <img src="'.$row['hoverImageFilePath'].'" alt="Coat Hover" class="hover-img"> </a>
                                            <p class="accessory-text">'.$row["name"]." £".$row['price'].'</p>
                                        </div>';
                                next($rows);
                            }
                        }
                    ?>
                </div>            
            </div>
        </div>
    </div>


    


<footer>
    <?php require_once("footer.php"); ?>
</footer>


    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
