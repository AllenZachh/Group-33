<?php

  function register(){
    if (isset($_POST["submitted"])){

      require_once('connectdb.php'); 
    
      $username=isset($_POST["username"])?$_POST["username"]:false; // set variable username to entered username
      $email=isset($_POST["email"])?$_POST["email"]:false; // set variable email to entered email
      
      //compare passwords to make sure theyre the same, then set variable password to the hashed entered password
      if ($_POST['password']==$_POST['password_2']){
        $password=isset($_POST["password"])?password_hash($_POST['password'],PASSWORD_DEFAULT):false;
      } else {
        return "Error creating account - passwords do not match";
      }

      // catch emtpy variables
      if (!($username)){
        return "Error creating account - no username given";
      }
      if (!($email)){
        return "Error creating account - no email given";
      }
      if (!($password)){
        return "Error creating account - no password given";
      }

      // Try to query the database, catch is theres an error connecting to the database
      try{
      if (!isset($db)){return "<p style='color:red'>Failed to connect to the database</p>";}

      // Make sure the username is not already in use
      $stmt = $db->prepare("SELECT username FROM user WHERE username = :username");
      $stmt->execute(['username' => $username]);
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
      if (!empty($user)){
        return '<p>Username already taken!<p>';
      }

      // Make sure the email is not already in use
      $stmt = $db->prepare("SELECT email FROM user WHERE email = :email");
      $stmt->execute(['email' => $email]);
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
      if (!empty($user)){
        return "<h3 style='color:red; font-size: 15px'>Emails don't match</h3>";
      }

      // Try to add the new user entry into the database

        $stat = $db->prepare('INSERT INTO `user` (`userid`, `username`, `password`, `email`, `accountType`) VALUES (NULL, ?, ?, ?, "user")');
			  $stat->execute(array($username, $password, $email));
        $created = True;
        header("Location:login.php");

      } catch (PDOexception $ex){
        $error = TRUE;
      }

      if ($created == TRUE){
        return "<p>Sign-Up Sucessful!</p>";
      }
      if ($error == TRUE){
        return "<p style='color:red'>Failed to connect to the database</p>";
      }

    }
  } 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleAwais.css">
    <title>Register | Glacier Guys</title>
    <?php require_once("navbar.php"); navbar("login"); ?>
</head>
<body class="bgimg">

        <div class="lgrcontainer">
          <img src="images/logo.jpg"/>
          <h1>Welcome to Glacier Guy's Gear!!!</h1>
          <p>Please fill in this form to create an account and join the family.</p>
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
          <?php echo register(); ?>
          <p>Already have an account? <a href="login.php">Sign in</a>.</p>

        </div>
      </form>
</body>
</html>
