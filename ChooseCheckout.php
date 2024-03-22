<?php

    session_start();
    require_once('connectdb.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Checkout | Glacier Guys</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>
<body>
    <?php include 'navbar.php'; navbar("chooseCheckout"); ?>

    <div class="container mt-5">
    <div class="row justify-content-center">
         <div class="col-md-5 text-center border py-4 mx-2" style="background-color: rgb(179, 218, 241, 0.6)">
            <h2 class="mb-3">Check out as a Returning Customer</h2>
            <p class="mb-4">Log in with your Glacier Guys account for a quick and easy checkout.</p>
            <a href="login.php" class="btn btn-primary btn-lg mb-2 w-75">Log in</a>
            <br>
            <a href="register.php" class="btn btn-secondary btn-lg w-75">Sign Up</a>
        </div>
        <div class="col-md-5 text-center border py-4 mx-2"style="background-color: rgb(179, 218, 241, 0.6)">>
            <h2 class="mb-3">Check Out as Guest</h2>
            <p class="mb-4">No account? No problem. You can check out as a guest and create a Glacier Guys account later if you wish.</p>
            <a href="GuestCheckout.php" class="btn btn-primary btn-lg w-75">Guest Checkout</a>
        </div>
    </div>
</div>
</body>
</html>
