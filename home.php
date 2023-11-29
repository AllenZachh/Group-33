<?php

    session_start();
    require_once('connectdb.php');

?>

<!DOCTYPE html>
<link rel="stylesheet" href="./css/style.css" >
<script src="./js/script.js"></script>

<head>

</head>
<body>

        <div class="topnav">
   
              <div id="searchResults"></div>
            <a href="basket.html">View Basket
                <ion-icon name="basket-outline"></ion-icon>
            </a>
            <a href="contactus.html">Contact Us
                <ion-icon name="call-outline"></ion-icon>
            </a>    
            <a class="active" href="home.html">Home
                <ion-icon name="home"></ion-icon>
            </a>
            <?php
                if (isset($_SESSION["username"])){ 
                    echo "<a>Logged in as ".$_SESSION['username']."</a>";
                  }
            ?>
            <div class="imgtopnav"></div>
            <img src="images/Glacier Guys.png" alt="pic">
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Coats, Hats...">
                <button onclick="search()">Search</button>
                
            </div>
             </div>
             <div class="Coats">
                <h2>Coats</h2>
                <div id="Coats" class="center">
                  <?php

                    // Prints image for all products containing the keyword "Coat"
                    $query="SELECT imageFilePath FROM product WHERE keywords LIKE '%Coat%'";
                    $rows = $db->query($query);
                    $rows = $rows->fetchAll();
                    while (current($rows)) {
                        echo "<img src='".current($rows)['imageFilePath']."' class='center'>";
                        next($rows);
                    }
                  ?>
                  
                </div>


          </div>
          
    

    <footer>

            <a class="socialmedia" href="https://www.instagram.com/" target="_blank"> 
            <ion-icon size="large" name="logo-instagram"></ion-icon> </a>
            <a class="socialmedia" href="https://twitter.com/" target="_blank">
            <ion-icon size="large" name="logo-twitter"></ion-icon> </a>

    </footer>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>


