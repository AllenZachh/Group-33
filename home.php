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
            <a href="products_list.php?select=Coat"><img src="./images/White_Parka.jpg" style="width:100%; height:100%;" alt="Slider Image 1"></a>
            <div class="slide-content">
                <h1 class="slide-text" style="color:Black;">Coats</h1>
            </div>
        </div>
        <div class="slide">
            <img src="images/slider-image2.png" alt="Slider Image 2">
            <div class="slide-content">
                <p class="slide-text">Complete Your Look</p>
                <p class="additional-slide-text">Explore our range of stylish hats and beanies, perfect for chilly days and nights.</p>
            </div>
        </div>
        <div class="slide">
            <img src="images/slider-image3.png" alt="Slider Image 3">
            <div class="slide-content">
                <p class="slide-text">Essential Winter Accessories</p>
                <p class="additional-slide-text">Accessorize with our scarves and shawls to add flair to your winter outfit.</p>
            </div>
        </div>
        <div class="slide">
            <img src="images/slider-image4.png" alt="Slider Image 4">
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
                                            <p class="coat-text">'.$row["name"].'</p>
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
                <div class="hat-item">
                    <img src="images/Hat1.png" alt="Hat1" class="original-img">
                    <img src="images/Hat1-hover.png" alt="Hat1 Hover" class="hover-img">
                    <p class="coat-text">Beige Beanie £20</p>
                    
                </div>
                <div class="hat-item">
                    <img src="images/Hat2.png" alt="Hat1" class="original-img">
                    <img src="images/Hat2-hover.png" alt="Hat1 Hover" class="hover-img">
                    <p class="coat-text">Grey Beanie £20</p>
                </div>
                <div class="hat-item">            
                    <img src="images/Hat3.png" alt="Hat1" class="original-img">
                    <img src="images/Hat3-hover.png" alt="Hat1 Hover" class="hover-img">
                    <p class="coat-text">Blue Beanie £20</p>
                </div>                 
                <div class="hat-item">
                    <img src="images/Hat4.png" alt="Hat1" class="original-img">
                    <img src="images/Hat4-hover.png" alt="Hat1 Hover" class="hover-img">
                    <p class="coat-text">Trapper Hat £30</p>
                </div>                
                <div class="hat-item">
                    <img src="images/Hat5.png" alt="Hat1" class="original-img">
                    <img src="images/Hat5-hover.png" alt="Hat1 Hover" class="hover-img">
                    <p class="coat-text">Bobble Hat £27</p>
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
                    <p class="boot-text">Dark Brown £110</p>
                </div>
                <div class="boot-item">
                    <img src="images/Boot2.png" alt="Boot" class="original-img">
                    <img src="images/Boot2-hover.png" alt="Boot Hover" class="hover-img">
                    <p class="boot-text">Light Brown £100</p>
                </div>
                <div class="boot-item">
                    <img src="images/Boot3.png" alt="Boot" class="original-img">
                    <img src="images/Boot3-hover.png" alt="Boot Hover" class="hover-img">
                    <p class="boot-text">Brown with Red Laces £145</p>
                </div>                
                <div class="boot-item">
                    <img src="images/Boot4.png" alt="Boot" class="original-img">
                    <img src="images/Boot4-hover.png" alt="Boot Hover" class="hover-img">
                    <p class="boot-text">Black £150</p>
                </div>                
                <div class="boot-item">
                    <img src="images/Boot5.png" alt="Boot" class="original-img">
                    <img src="images/Boot5-hover.png" alt="Boot Hover" class="hover-img">
                    <p class="boot-text">Bland and Orange £70/p>
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
                    <p class="glove-text">Green Fleece Gloves £30</p>
                </div>
                <div class="glove-item">
                    <img src="images/Glove2.png" alt="Glove" class="original-img">
                    <img src="images/Glove2-hover.png" alt="Glove Hover" class="hover-img">
                    <p class="glove-text">Black Gloves £45</p>
                </div>
                <div class="glove-item">
                    <img src="images/Glove3.png" alt="Glove" class="original-img">
                    <img src="images/Glove3-hover.png" alt="Glove Hover" class="hover-img">
                    <p class="glove-text">Breathable Black Gloves $35</p>
                </div>
                <div class="glove-item">
                    <img src="images/Glove4.png" alt="Glove" class="original-img">
                    <img src="images/Glove4-hover.png" alt="Glove Hover" class="hover-img">
                    <p class="glove-text">Inside Fur Black Gloves £45</p>
                </div>
                <div class="glove-item">
                    <img src="images/Glove5.png" alt="Glove" class="original-img">
                    <img src="images/Glove5-hover.png" alt="Glove Hover" class="hover-img">
                    <p class="glove-text">Fingerless Grey Gloves £30</p>
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
                <p class="accessory-text">Green and Blue Scarf £24</p>
            </div>
            <div class="accessory-item">
                <img src="images/Accessory2.png" alt="Accessory" class="original-img">
                <img src="images/Accessory2-hover.png" alt="Accessory Hover" class="hover-img">
                <p class="accessory-text">Green and Blue Ski Goggles £90</p>
            </div>
            <div class="accessory-item">
                <img src="images/Accessory3.png" alt="Accessory" class="original-img">
                <img src="images/Accessory3-hover.png" alt="Accessory Hover" class="hover-img">
                <p class="accessory-text">Red Scarf £32</p>
            </div>
            <div class="accessory-item">
                <img src="images/Accessory4.png" alt="Accessory" class="original-img">
                <img src="images/Accessory4-hover.png" alt="Accessory Hover" class="hover-img">
                <p class="accessory-text">Grey Neck Warmer £18</p>
            </div>
            <div class="accessory-item">
                <img src="images/Accessory5.png" alt="Accessory" class="original-img">
                <img src="images/Accessory5-hover.png" alt="Accessory Hover" class="hover-img">
                <p class="accessory-text">Black and Grey Ski Goggles £102</p>
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
