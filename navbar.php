<?php 

function navbar($currentPage){
    if (isset($_SESSION["username"])){ 
        $loggedIn = "<a>Logged in as ".$_SESSION['username']."</a>";
    }

    echo '<div class="topnav">
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
        <div class="imgtopnav"></div>
            <div class="glacier-guys">Glacier Guys</div> 
            <div class="subtitle">"Stay Warm, Embrace Style: Elevating Winter for the Modern Man!"</div>
            <img src="images/Glacier Guys.png" alt="pic">
        </div>


    </div>';
}
?>