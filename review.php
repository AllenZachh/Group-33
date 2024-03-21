<?php
session_start();
require_once('connectdb.php');


//review function
if (isset($_GET['product_id'])) {
  if (isset($_POST['review'], $_POST['name'], $_POST['rating'])) {
    $review = $db->prepare('INSERT INTO reviews (product_id, name, review, rating, review_date) VALUES (?, ?, ?, ?, NOW())');
    $review->execute([$_GET['product_id'], $_POST['name'], $_POST['review'], $_POST['rating']]);
    header('Location: review.php?product_id='. ($_GET['product_id']). '');
    exit('Review submitted');
  }
  $stmt = $db->prepare('SELECT * FROM product WHERE productid = ?');
  $stmt->execute([$_GET['product_id']]);
  $product = $stmt->fetch();


  $reviews = $db->prepare('SELECT * FROM reviews WHERE product_id = ? ORDER BY review_date DESC');
  $reviews->execute([$_GET['product_id']]);
  $reviewlist = $reviews->fetchAll();

  $info = $db->prepare('SELECT AVG(rating) AS overall_rating, COUNT(*) AS review_num FROM reviews WHERE product_id = ?');
  $info->execute([$_GET['product_id']]);
  $reviewinfo = $info->fetch();
} else {
  header('Location: review.php?product_id='. ($_GET['product_id']). '');
  exit('Please provide the page ID.');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleAwais.css?v=<?php echo time(); ?>">
</head>
<body>
<?php require_once("navbar.php"); navbar("productList"); ?>
<div class="overall_rating">
  <span class="num"><?=number_format($reviewinfo['overall_rating'], 1)?></span>
  <span class="rating"><?=str_repeat('&#9733;', round($reviewinfo['overall_rating']))?></span>
  <span class="total"><?=$reviewinfo['review_num']?> Reviews</span>
</div>
<div class="write_review">
  <form class="lgrcontainer" action="" method="post">
    <h1>Review this item</h1>
    <img src = "<?= $product['imageFilePath'] ?>"/>
    <label for="name">Name</label><br>
    <input name="name" type="text" placeholder="Your Name" required><br>
    <label for="rating">Rating</label><br>
    <input name="rating" type="number" min="1" max="5" placeholder="Rating (1-5)" required>
    <label for="desc">Write a review</label><br>
    <textarea name="review" placeholder="Write your review here..." required></textarea><br>
    <button type="submit">Submit Review</button>
  </form>
</div>
<?php foreach ($reviewlist as $review): ?>
<div class="review">
    <h3 class="name"><?=htmlspecialchars($review['name'], ENT_QUOTES)?></h3>
    <div>
        <span class="rating"><?=str_repeat('&#9733;', $review['rating'])?></span>
    </div>
    <p class="content"><?=htmlspecialchars($review['review'], ENT_QUOTES)?></p>
</div>
<?php endforeach ?>
</body>
</html>
</body>
