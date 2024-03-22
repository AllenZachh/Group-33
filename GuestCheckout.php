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
    <title>Guest Checkout | Glacier Guys</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php include 'navbar.php'; navbar("GuestCheckout"); ?>

    <div class="container mt-5">
        <div class="row">

            <!-- Delivery Options -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-white">
                        <h4 class="text-center">Delivery Options</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-4">
                        </div>
                        <form id="checkout-form">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" id="first-name" placeholder="First Name*" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" id="last-name" placeholder="Last Name*" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" id="email" placeholder="Email*" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" id="confirm-email" placeholder="Confirm Email*" required>
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control" id="phone-number" placeholder="Phone Number*" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Save & Continue</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-white">
                        <h4 class="text-center">In Your Bag</h4>
                    </div>
                    <div class="card-body">
                        <p>Item: N/A</p>
                        <p>Size: N/A</p>
                        <p>Colour: N/A</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p>Subtotal: £50.00</p>
                                <p>Delivery: £5.00</p>
                                <p>Total: £55.00</p>
                            </div>
                            <img src="path-to-shoe-image.jpg" alt="Clothes Image" class="img-thumbnail" style="width:100px; height:auto;">
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
            var email = document.getElementById('email').value;
            var confirmEmail = document.getElementById('confirm-email').value;
            
            if (email !== confirmEmail) {
                alert('Error: Email addresses do not match.');
                event.preventDefault();
            } else {
                window.location.href = 'OrderConfirmation.php';
                event.preventDefault();
            }
        });
    </script>




  
