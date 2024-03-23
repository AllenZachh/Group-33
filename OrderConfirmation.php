<?php
    session_start();
    require_once('connectdb.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation | Glacier Guys</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <style>
        .confirmation-section {
            background-color: #ffffff;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-top: 50px;
        }
        .order-details {
            background-color: #f8f8f8;
            padding: 15px;
            border: 1px solid #eee;
            border-radius: 5px;
        }
        .order-details li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; navbar("OrderConfirmation"); ?>

    <!-- Order Confirmation -->
    <section class="py-5">
        <div class="container">
            <h1 class="text-center mb-5"style="color: #ffffff;">Order Confirmed</h1>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="confirmation-section">
                        <p class="text-center">Thank you for your order!</p>
                        <div class="order-details">
                            <ul class="list-unstyled">
                                <li><strong>Order Number:</strong> #123456</li>
                                <li><strong>Date:</strong> <?= date("jS F Y") ?></li>
                                <li><strong>Total Amount:</strong> £55.00</li>
                            </ul>
                        </div>
                        <p>Your item(s) will be shipped to the following address:</p>
                        <div class="order-details">
                            <address>
                                Username <br>
                                Address Line 1 <br>
                                Country & City <br>
                                Postcode
                            </address>
                        </div>
                        <p>If you have any questions or concerns, please <a href="contactus.php">contact us</a>.</p>
                        <div class="text-center mt-4">
                            <a href="products_list.php" class="btn btn-primary">Continue Shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap's JavaScript, jQuery and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
