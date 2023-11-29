<?php

  if (isset($_POST["submitted"])){

    require_once('connectdb.php');

    $username=isset($_POST["username"])?$_POST["username"]:false;
    $email=isset($_POST["email"])?$_POST["email"]:false;
    if ($_POST['password']==$_POST['password_2']){
      $password=isset($_POST["password"])?password_hash($_POST['password'],PASSWORD_DEFAULT):false;
    } else {
      echo "Error creating account - passwords do not match";
    }

    if (!($username)){
      echo "Error creating account - no username given";
      exit;
    }
    if (!($email)){
      echo "Error creating account - no email given";
      exit;
    }
    if (!($password)){
      echo "Error creating account - no password given";
      exit;
    }

    try{

      $stat = $db->prepare('INSERT INTO `user` (`userid`, `username`, `password`, `email`) VALUES (NULL, ?, ?, ?)');
			$stat->execute(array($username, $password, $email));
      //header("Location:login.php");

    } catch (PDOexception $ex){
      $error = TRUE;
    }

  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body class="bgimg">

        <div class="lgrcontainer">
          <img src="images/logo.jpg"/>
          <h1>Welcome to Glacier Guy's Gear!!!</h1>
          <p>Please fill in this form to create an account and join the family.</p>
          <?php 
            global $created, $error;
            if ($created == TRUE){
              echo "<h3>Sign-Up Sucessful!</h3>";
            }
            if ($error == TRUE){
              echo "<h3 style='color:red'>Failed to connect to the database</h3>";
            }
            echo "<br>"
          ?>
          <form method='post' action='register.php'>
            <label for="email"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" id="username" required>
      
            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Enter Email" name="email" id="email" required>
      
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" id="psw" required>
      
            <label for="psw-repeat"><b>Repeat Password</b></label>
            <input type="password" placeholder="Repeat Password" name="password_2" id="psw-repeat" required>
            <p>By creating an account you agree to our <a href="#">Terms & Conditions?</a>.</p>
      
            <button type="submit" class="registerbtn">Register</button>
            <input type="hidden" name="submitted" value="true">
          </form>
          <p>Already have an account? <a href="login.php">Sign in</a>.</p>
          <p><a href="home.html">Go back to the homepage</a>.<p>

        </div>
      </form>
</body>
</html>