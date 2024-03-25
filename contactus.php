<?php

    session_start();
    if (isset($_POST)){

        require_once('connectdb.php'); 
      
        $name=isset($_POST["name"])?$_POST["name"]:false;
        $email=isset($_POST["email"])?$_POST["email"]:false;
        $comment=isset($_POST["comments"])?$_POST["comments"]:false;

        $stat = $db->prepare('INSERT INTO complaints (complaintid, name, email, comment, date) VALUES (NULL, ?, ?, ?, ?)');
		$stat->execute(array($name, $email, $comment, date("Y-m-d")));

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/castyles.css">
    <link rel="stylesheet" href="css/hf.css">
    <title>Contact Us</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <style>
        body {
            background-image: url('./images/contact.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed; 
            color: #000000; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }
    
        @media only screen and (max-width: 768px) {
            body {
                background-attachment: scroll;
            }
        }
    </style>
</head>
<body>
   
    <ul class="navigation">
        <li><a href="home.php">Home</a></li>
        <li><a href="product_list.php">Products</a></li>
        <li><a href="contactus.php">Contact Us</a></li>
        <li><a href="aboutus.php">About Us</a></li>
        <li><img src="./images/Glacier Guys.png" alt="Logo" class="logo"></li>
    </ul>

    <div class="contact-details">
        <h2>Company's Contact Details:</h2>
        <div class="company-contact">
            <p>Email: info@example.com</p>
            <p>Phone: +1 (123) 456-7890</p>
        </div>
    </div>
    
    <form action="contactus.php" method="post">
        <p>Feel free to express your concerns in the form below, and we'll reach out to you shortly!</p>
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="comments">Comments:</label><br>
        <textarea id="comments" name="comments" maxlength="250" required oninput="updateCharCount()"></textarea><br>
        <span id="charCount">250 characters remaining</span><br>
        <input type="submit" value="Submit">
    </form>
    
    <script>
        function updateCharCount() {
            var maxLength = 250;
            var currentLength = document.getElementById('comments').value.length;
            var remaining = maxLength - currentLength;
            var charCountElement = document.getElementById('charCount');
            charCountElement.textContent = remaining + ' character' + (remaining !== 1 ? 's' : '') + ' remaining';
        }
    </script>

<footer>
    <div class="social-icons">
        <a href="https://www.facebook.com" target="_blank"><img src="./images/fb.jpg" alt="Facebook"></a>
        <a href="https://www.linkedin.com" target="_blank"><img src="./images/lkin.jpg" alt="LinkedIn"></a>
        <a href="https://www.instagram.com" target="_blank"><img src="./images/insta.jpg" alt="Instagram"></a>
        <a href="https://www.twitter.com" target="_blank"><img src="./images/x.jpeg" alt="Twitter"></a>
    </div>
    <p>&copy; 2023 Glacier Guys</p>
</footer>

</body>
</html>
