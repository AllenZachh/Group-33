<?php
    session_start();
    require_once('connectdb.php');

    if (isset($_SESSION['username'])){
        $sql = "SELECT * FROM user WHERE username = '".$_SESSION['username']."'";
        $info = $db->query($sql);
        $info = $info->fetch();
        $fulnm = $info["fullName"];
        $email = $info["email"];
        $phnum = $info["phoneNum"];
        $adrln1 = $info["address1"];
        $adrln2 = $info["address2"];
        $country = $info["country"];
        $postcode = $info["postcode"];

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Checkout | Glacier Guys</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <style>
        .checkout-form {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }
        .summary-card {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }
        .summary-item {
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .img-thumbnail {
            max-width: 100px;
            height: auto;
        }
        .btn-block {
            max-width: 200px;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; navbar("UserCheckout"); ?>

    <div class="container mt-5">
        <div class="row">
            <!-- User Information -->
            <div class="col-md-6">
                <div class="checkout-form">
                    <h2 class="text-center mb-4">User Checkout</h2>
                    <form id="checkout-form" method="post">
                        <div class="form-group">
                            <label for="full-name">Full Name:</label>
                            <input type="text" class="form-control" id="full-name" name="full-name" value="<?php echo$fulnm;  ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo$email;  ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number:</label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo$phnum;  ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="address-line">Address Line:</label>
                            <input type="text" class="form-control" id="address-line" name="address-line" value="<?php echo$adrln1;  ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="city-country">City, Country:</label>
                            <input type="text" class="form-control" id="city-country" name="city-country" value="<?php echo$country;  ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="postcode">Postcode:</label>
                            <input type="text" class="form-control" id="postcode" name="postcode" value="<?php echo$postcode;  ?>" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Place Order</button>
                    </form>
                </div>
            </div>


            <!-- Order Summary -->
            <div class="col-md-6">
                <div class="summary-card">
                    <div class="card-header bg-white">
                        <h4 class="text-center">Basket</h4>
                    </div>
                    <div class="card-body">
                        <!-- N/A to be replaced with actual data from database -->
                        <div class="summary-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p>Subtotal: £50.00</p>
                                    <p>Delivery: £5.00</p>
                                    <p>Total: £55.00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap's JavaScript, jQuery and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('checkout-form').addEventListener('submit', function(event) {
            // This will be replaced by backend logic to process the order
            alert('Your order has been placed.');
            window.location.href = 'OrderConfirmation.php';
            event.preventDefault();
        });
    </script>
</body>
</html>
