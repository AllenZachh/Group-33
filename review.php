<?php
session_start();
require_once('connectdb.php');
$result = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleAwais.css?v=<?php echo time(); ?>">
</head>
<body>
<?php require_once("navbar.php");
navbar("productList"); ?>

  <form class="lgrcontainer" action="">
  <h1>Review this item</h1>
  <img src = "Images/Boot2.png"/>
  <label for="name">Name</label><br>
  <input type="text" id="name" name="name"><br>
  <div class="rating">
    <input type="radio" id="star5" name="rating" value="5" />
    <label for="star5" title="text">★ </label>
    <input type="radio" id="star4" name="rating" value="4" />
    <label for="star4" title="text">★ </label>
    <input type="radio" id="star3" name="rating" value="3" />
    <label for="star3" title="text">★ </label>
    <input type="radio" id="star2" name="rating" value="2" />
    <label for="star2" title="text">★ </label>
    <input type="radio" id="star1" name="rating" value="1" />
    <label for="star1" title="text">★ </label>
  </div>
  <label for="desc">Write a review</label><br>
  <textarea class = "desc" type="text" id="desc" name="desc"></textarea><br>
  <input class = "submit" type="submit" value="Submit">
  </form>
</body>

</html>
</body>
