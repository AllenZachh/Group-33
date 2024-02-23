<?php 

function navbar($currentPage){
    if (isset($_SESSION["username"])){ 
        $loggedIn = "<a>Logged in as ".$_SESSION['username']."</a>";
    } else {
        $loggedIn = "";
    }

    echo '<div class="topnav">
    <link rel ="stylesheet" href = "./css/navbarStyle.css">
    <div id="searchResults"></div>'.$loggedIn.'
        <a href="aboutus.php">About Us
            <ion-icon name="person-circle-outline"></ion-icon>
        </a>';

    if ($currentPage == "login"){
        $current = 'class="active"';
    } else {
        $current = '';
    }
    echo '<a '.$current.' href="login.php">Log In
            <ion-icon name="log-in-outline"></ion-icon>
        </a>';

    if ($currentPage == "basket"){
        $current = 'class="active"';
    } else {
        $current = '';
    }
    echo '<a '.$current.' href="basket.php">View Basket
            <ion-icon name="basket-outline"></ion-icon>
        </a>';

    if ($currentPage == "contactUs"){
        $current = 'class="active"';
    } else {
        $current = '';
    }
    echo '<a '.$current.' href="contactus.php">Contact Us
            <ion-icon name="call-outline"></ion-icon>
        </a>';

    if ($currentPage == "productList"){
        $current = 'class="active"';
    } else {
        $current = '';
    }
    echo '<a '.$current.' href="products_list.php">Products
            <ion-icon name="shirt-outline"></ion-icon>
        </a>';

    if ($currentPage == "home"){
        $current = 'class="active"';
    } else {
        $current = '';
    }
    echo '<a '.$current.' href="home.php">Home
            <ion-icon name="home"></ion-icon>
        </a>
        <img src="images/Glacier Guys.png" alt="pic" style="max-width: 10%; height: auto;">
        <div class="imgtopnav"></div>
            <div class="glacier-guys">Glacier Guys</div> 
            <div class="subtitle">"Stay Warm, Embrace Style: Elevating Winter for the Modern Man!"</div>
            <br/>
        </div>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    </div>';
}
?>