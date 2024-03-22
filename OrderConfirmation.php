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
    <?php include 'navbar.php'; navbar("OrderConfirmation"); ?>

    <!-- Order Confirmation -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Order Confirmed</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <p>Thank you for your order!</p>
                    <ul>
                        <li><strong>Order Number:</strong> #123456</li>
                        <li><strong>Date:</strong> 22nd March 2024</li>
                        <li><strong>Total Amount:</strong> £55.00</li>
                    </ul>
                    <p>Your items will be shipped to the following address:</p>
                    <p>
                        User1<br>
                        My Street<br>
                        Birmingham, England<br>
                        Postocde: B11 111
                    </p>
                    <p>If you have any questions or concerns, please <a href="contactus.php">contact us</a>.</p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
