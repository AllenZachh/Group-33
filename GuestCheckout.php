<?php
    session_start();
    require_once('connectdb.php');
    if (isset($_COOKIE["basket"])) {
        $items = array();
        $array = json_decode($_COOKIE["basket"], true);
        foreach ($array as $product) {
            array_push($items, $product);
        }
        $totalprice = 0;
        foreach ($items as $singleitem) {
            $stmt = $db->prepare("SELECT p.*, pt.price, pt.name FROM product p JOIN producttype pt ON p.productTypeid = pt.productTypeid WHERE p.productid = ?");
            $stmt->execute([$singleitem]);
            $product = $stmt->fetch();
            $totalprice += $product['price'];
    }
}
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

            <!-- Delivery Details -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-white">
                        <h4 class="text-center">Delivery Options</h4>
                    </div>
                    <div class="card-body">
                        <form id="checkout-form" method="post" action="createOrderGuest.php">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" name="fullname" placeholder="Full-name* " required>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email*" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="confirm-email" placeholder="Confirm Email*" required>
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control" name="phnum" placeholder="Phone Number*" required>
                            </div>
                            <div class="drop-down">
                                <select name="country" name="country">
                                    <option class="uk" value="UK">UK</option>
                                    <option class="usa" value="USA">USA</option>
                                    <option class="france" value="France">France</option>
                                    <option class="germany" value="Germany">Germany</option>
                                </select>
                            </div><br>
                            <div class="form-group">
                                <input type="text" class="form-control" name="city" placeholder="City*" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="adrln" placeholder="Address Line*" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="postcode" placeholder="Postcode*" required>
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
                        <h4 class="text-center">Basket</h4>
                    </div>
                    <div class="card-body">
                        <!-- N/A to be replaced with actual data from database -->
                        <div class="summary-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p>Subtotal: £<?php echo$totalprice; ?></p>
                                    <p>Delivery: £5.00</p>
                                    <p>Total: £<?= number_format($totalprice + 5, 2);  ?></p>
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
            var email = document.getElementById('email').value;
            var confirmEmail = document.getElementById('confirm-email').value;
            
            if (email !== confirmEmail) {
                alert('Error: Email addresses do not match.');
                event.preventDefault();
            }
        });
    </script>
