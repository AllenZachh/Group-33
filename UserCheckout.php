<?php

    session_start();
    require_once('connectdb.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Glacier Guys</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <style>
        .checkout-form {
            background-color: #ffffff;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-top: 50px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
        .card {
            border: none;
        }
        .card-header {
            background-color: #fff;
            border-bottom: none;
        }
        .img-thumbnail {
            max-width: 80px;
            height: auto;
        }
        .summary-item {
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; navbar("UserCheckout"); ?>

    <div class="container mt-5">
        <div class="row">
            <!-- User Information -->
            <div class="col-lg-6 mb-4">
                <div class="checkout-form">
                    <h2 class="text-center mb-4">User Checkout</h2>
                    <form id="checkout-form" method="post">
                <div class="form-group">
                    <label for="full-name">Full Name:</label>
                    <input type="text" class="form-control" id="full-name" name="full-name" value="User1" readonly>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="User1@hotmail.com" readonly>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="tel" class="form-control" id="phone" name="phone" value="123-456-7890" readonly>
                </div>
                <div class="form-group">
                    <label for="address">Shipping Address:</label>
                    <textarea class="form-control" id="address" name="address" rows="3" readonly>123 Street, City, Country</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Place Order</button>
                </div>
            </form>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">In Your Bag</h4>
                    </div>
                    <div class="card-body">
                        <div class="summary-item">
                            <p>Item: N/A</p>
                            <p>Size: N/A</p>
                            <p>Colour: N/A</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="item-details">
                                    <p>Subtotal: £50.00</p>
                                    <p>Delivery: £5.00</p>
                                    <p>Total: £55.00</p>
                                </div>
                                <img src="path-to-item-image.jpg" alt="Item Image" class="img-thumbnail">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('checkout-form').addEventListener('submit', function(event) {
            window.location.href = 'OrderConfirmation.html';
            event.preventDefault();
        });
    </script>
</body>
</html>
