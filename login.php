<?php 

  session_start();

  function login(){
   if (isset($_POST["submitted"])){

    require_once('connectdb.php');

    // Attempt to login, if unable to connect to db catch error and report
    try{
      $stat = $db->prepare('SELECT password FROM user WHERE username = ?');
			$stat->execute(array($_POST['username']));
    
      // Checks if theres a user with entered username, otherwise tells user
      if ($stat->rowCount()>0){
        $row=$stat->fetch();

        // Checks if the entered password matches with the username, if so starts session, otherwise tells user
        if (password_verify($_POST["password"], $row["password"])){

          $_SESSION["username"]=$_POST["username"];
          return "Logged in!";

        } else {
          return "<h3 style='color:red; font-size: 15px'>Password does not match</h3>";
        }

      } else {
        return "<h3 style='color:red; font-size: 15px'>Username not found</h3>";
      }

    } catch (PDOException $ex) {
      return "<h3 style='color:red; font-size: 15px'>Failed to connect to the database</h3>";
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
    <title>Log-in | Glacier Guys</title>
    <?php require_once("navbar.php"); navbar("login"); ?>
</head>
<body class="bgimg">
      <div class="lgrcontainer">
        <img src = "./images/Glacier Guys.png"/>

        <h1>Welcome back!!!</h1>
        <hr>
        <form method="post" action="login.php">
          <label for="email"><b>Username</b></label>
          <input type="text" placeholder="Enter Username" name="username" id="username" required>
      
          <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="password" id="psw" required>

      
          <button type="submit" class="registerbtn">Login</button>
          <input type="hidden" name="submitted" value="true">
        </form>
        <?php echo login(); ?>
        <p>Don't have an account?<a href="register.php">Register Now!</a>.</p>

          
        <?php

          if (isset($_SESSION["username"])){ 
            $addPage = '"'.'addproject.php'.'"';
            echo "<br><br><br><form method='post'>
              <button value='logout' class='tbl_btn'>Logout</button>
              <input type='hidden' name='logout' value='true' />
              </form></td></tr>\n";
          }
          
          if (isset($_POST["logout"])){ 
            session_destroy();
            header("Location:home.php");
            exit();
          }
  
        ?>

      </div>
</body>
</html>
