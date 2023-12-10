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

    <div class="topnav">
        <div id="searchResults"></div>
        <?php
                if (isset($_SESSION["username"])){ 
                    echo "<a>Logged in as ".$_SESSION['username']."</a>";
                  }
            ?>
        <a href="aboutus.html">About Us
            <ion-icon name="person-circle-outline"></ion-icon>
        </a>
        <a href="login.php">Log In
            <ion-icon name="log-in-outline"></ion-icon>
        </a>
        <a href="basket.html">View Basket
            <ion-icon name="basket-outline"></ion-icon>
        </a>
        <a href="contactus.html">Contact Us
            <ion-icon name="call-outline"></ion-icon>
        </a>
        <a href="products.html">Products
            <ion-icon name="shirt-outline"></ion-icon>
        </a>
        <a class="active" href="home.html">Home
            <ion-icon name="home"></ion-icon>
        </a>
        <div class="imgtopnav"></div>
        <div class="glacier-guys">Glacier Guys</div> 
        <div class="subtitle">"Stay Warm, Embrace Style: Elevating Winter for the Modern Man!"</div>
        <img src="images/Glacier Guys.png" alt="pic">
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Coats, Hats...">
            <button class="custom-button" onclick="search()">Search</button>
        </div>


    </div>
   <div class="slider">
    <input type="radio" name="slide-btn" id="radio1" checked>
    <input type="radio" name="slide-btn" id="radio2">
    <input type="radio" name="slide-btn" id="radio3">
    <input type="radio" name="slide-btn" id="radio4">

    <div class="slides">
        <div class="slide">
            <a href="products_list.php?select=Coat"><img src="./images/White_Parka.jpg" style="width:100%; height:100%;" alt="Slider Image 1"></a>
            <div class="slide-content">
                <h1 class="slide-text" style="color:Black;">Coats</h1>
            </div>
        </div>
        <div class="slide">
            <img src="images/slider-image2.png" alt="Slider Image 2">
            <div class="slide-content">
                <p class="slide-text">Slide 2 Text</p>
            </div>
        </div>
        <div class="slide">
            <img src="images/slider-image3.png" alt="Slider Image 3">
            <div class="slide-content">
                <p class="slide-text">Slide 3 Text</p>
            </div>
        </div>
        <div class="slide">
            <img src="images/slider-image4.png" alt="Slider Image 4">
            <div class="slide-content">
                <p class="slide-text">Slide 4 Text</p>
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
                                            <p class="coat-text">'.$row["name"].'</p>
                                        </div>"';
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
                <div class="hat-item">
                    <img src="images/Hat1.png" alt="Hat1" class="original-img">
                    <img src="images/Hat1-hover.png" alt="Hat1 Hover" class="hover-img">
                    <p class="coat-text">Text for Hat 1</p>
                    
                </div>
                <div class="hat-item">
                    <img src="images/Hat2.png" alt="Hat1" class="original-img">
                    <img src="images/Hat2-hover.png" alt="Hat1 Hover" class="hover-img">
                    <p class="coat-text">Text for Hat 2</p>
                </div>
                <div class="hat-item">            
                    <img src="images/Hat3.png" alt="Hat1" class="original-img">
                    <img src="images/Hat3-hover.png" alt="Hat1 Hover" class="hover-img">
                    <p class="coat-text">Text for Hat 3</p>
                </div>                 
                <div class="hat-item">
                    <img src="images/Hat4.png" alt="Hat1" class="original-img">
                    <img src="images/Hat4-hover.png" alt="Hat1 Hover" class="hover-img">
                    <p class="coat-text">Text for Hat 4</p>
                </div>                
                <div class="hat-item">
                    <img src="images/Hat5.png" alt="Hat1" class="original-img">
                    <img src="images/Hat5-hover.png" alt="Hat1 Hover" class="hover-img">
                    <p class="coat-text">Text for Hat 5</p>
                </div>            
            </div>
        </div>
    </div>
    <div class="Boots" id="Boots">
        <div class="boots-section">
            <h2>Boots</h2>
            <div class="images-container">
                <div class="boot-item">
                    <img src="images/Boot1.png" alt="Boot" class="original-img">
                    <img src="images/Boot1-hover.png" alt="Boot Hover" class="hover-img">
                    <p class="boot-text">Text for Boot 1</p>
                </div>
                <div class="boot-item">
                    <img src="images/Boot2.png" alt="Boot" class="original-img">
                    <img src="images/Boot2-hover.png" alt="Boot Hover" class="hover-img">
                    <p class="boot-text">Text for Boot 2</p>
                </div>
                <div class="boot-item">
                    <img src="images/Boot3.png" alt="Boot" class="original-img">
                    <img src="images/Boot3-hover.png" alt="Boot Hover" class="hover-img">
                    <p class="boot-text">Text for Boot 3</p>
                </div>                
                <div class="boot-item">
                    <img src="images/Boot4.png" alt="Boot" class="original-img">
                    <img src="images/Boot4-hover.png" alt="Boot Hover" class="hover-img">
                    <p class="boot-text">Text for Boot 4</p>
                </div>                
                <div class="boot-item">
                    <img src="images/Boot5.png" alt="Boot" class="original-img">
                    <img src="images/Boot5-hover.png" alt="Boot Hover" class="hover-img">
                    <p class="boot-text">Text for Boot 5</p>
                </div>            
            </div>
        </div>
    </div>
    <div class="Gloves" id="Gloves">
        <div class="gloves-section">
            <h2>Gloves</h2>
            <div class="images-container">
                <div class="glove-item">
                    <img src="images/Glove1.png" alt="Glove" class="original-img">
                    <img src="images/Glove1-hover.png" alt="Glove Hover" class="hover-img">
                    <p class="glove-text">Text for Glove 1</p>
                </div>
                <div class="glove-item">
                    <img src="images/Glove2.png" alt="Glove" class="original-img">
                    <img src="images/Glove2-hover.png" alt="Glove Hover" class="hover-img">
                    <p class="glove-text">Text for Glove 2</p>
                </div>
                <div class="glove-item">
                    <img src="images/Glove3.png" alt="Glove" class="original-img">
                    <img src="images/Glove3-hover.png" alt="Glove Hover" class="hover-img">
                    <p class="glove-text">Text for Glove 3</p>
                </div>
                <div class="glove-item">
                    <img src="images/Glove4.png" alt="Glove" class="original-img">
                    <img src="images/Glove4-hover.png" alt="Glove Hover" class="hover-img">
                    <p class="glove-text">Text for Glove 4</p>
                </div>
                <div class="glove-item">
                    <img src="images/Glove5.png" alt="Glove" class="original-img">
                    <img src="images/Glove5-hover.png" alt="Glove Hover" class="hover-img">
                    <p class="glove-text">Text for Glove 5</p>
                </div>
            </div>
        </div>
    </div>
<div class="Accessories" id="Accessories">
    <div class="accessories-section">
        <h2>Accessories</h2>
        <div class="images-container">
            <div class="accessory-item">
                <img src="images/Accessory1.png" alt="Accessory" class="original-img">
                <img src="images/Accessory1-hover.png" alt="Accessory Hover" class="hover-img">
                <p class="accessory-text">Text for Accessory 1</p>
            </div>
            <div class="accessory-item">
                <img src="images/Accessory2.png" alt="Accessory" class="original-img">
                <img src="images/Accessory2-hover.png" alt="Accessory Hover" class="hover-img">
                <p class="accessory-text">Text for Accessory 2</p>
            </div>
            <div class="accessory-item">
                <img src="images/Accessory3.png" alt="Accessory" class="original-img">
                <img src="images/Accessory3-hover.png" alt="Accessory Hover" class="hover-img">
                <p class="accessory-text">Text for Accessory 3</p>
            </div>
            <div class="accessory-item">
                <img src="images/Accessory4.png" alt="Accessory" class="original-img">
                <img src="images/Accessory4-hover.png" alt="Accessory Hover" class="hover-img">
                <p class="accessory-text">Text for Accessory 4</p>
            </div>
            <div class="accessory-item">
                <img src="images/Accessory5.png" alt="Accessory" class="original-img">
                <img src="images/Accessory5-hover.png" alt="Accessory Hover" class="hover-img">
                <p class="accessory-text">Text for Accessory 5</p>
            </div>
        </div>
    </div>
</div>


    


<footer>
    <a class="socialmedia" href="https://www.instagram.com/" target="_blank">
        <ion-icon size="large" name="logo-instagram"></ion-icon>
    </a>
    <a class="socialmedia" href="https://twitter.com/" target="_blank">
        <ion-icon size="large" name="logo-twitter"></ion-icon>
    </a>
</footer>


    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
