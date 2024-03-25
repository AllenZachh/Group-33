<?php
session_start();
require_once('connectdb.php');
$taken='';

if (isset($_POST["submittedDetails"])){

    $stmt = $db->prepare("SELECT username FROM user WHERE username = ? AND userid <> ".$_SESSION['userid']);
    $stmt->execute(array($_POST["username"]));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!empty($user)){
      $taken='<p>Username already taken!<p>';
    } else {
    $stat = $db->prepare('UPDATE user SET username=?, phoneNum=?, address1=?, address2=?, postcode=?, country=?, fullName=?, city=? WHERE userid = '.$_SESSION['userid']);
	$stat->execute(array($_POST['username'], $_POST['phnum'], $_POST['address1'], $_POST['address2'], $_POST['postcode'], $_POST['country'], $_POST['name'], $_POST['city']));
    }
}

if (isset($_SESSION['username'])){
    $sql = "SELECT * FROM user WHERE userid = '".$_SESSION['userid']."'";
    $info = $db->query($sql);
    $info = $info->fetch();
    $username = $info["username"];
    $fulnm = $info["fullName"];
    $phnum = $info["phoneNum"];
    $adrln1 = $info["address1"];
    $adrln2 = $info["address2"];
    $country = $info["country"];
    $postcode = $info["postcode"];
    $city = $info["city"];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleAwais.css?v=<?php echo time(); ?>">
</head>

<?php require_once("navbar.php"); navbar("account"); ?>

<body> 
    <div class="accountNav">
                <ul>
                    <li><a href="viewDetails.php">View Details</a></li>
                    <li><a href="orders.php">View Orders</a></li>
                </ul>
            </div>
    <h1>View and change your details</h1>

    <div id = "changeDetails">
            <form class = "lgrcontainer" method="post" action="viewDetails.php">

                <label for="aname">Username:</label>
                <input type="text" id="username" name="username" value = "<?=$username?>"><br>

                <label for="aname">Full-name:</label>
                <input type="text" id="name" name="name" value = "<?=$fulnm?>"><br>

                <label for="aname">Phone Number:</label>
                <input type="text" id="phnum" name="phnum" value = "<?=$phnum?>"><br>

                <label for="country">Country:</label>  
                <div class="drop-down">
                    <select name="country" id="country">
                        <option class="uk" value="UK" <?php if ($country == "UK"){echo"selected='selected'";} ?>>UK</option>
                        <option class="usa" value="USA" <?php if ($country == "USA"){echo"selected='selected'";} ?>>USA</option>
                        <option class="france" value="France" <?php if ($country == "France"){echo"selected='selected'";} ?>>France</option>
                        <option class="germany" value="Germany" <?php if ($country == "Germany"){echo"selected='selected'";} ?>>Germany</option>
                    </select>
                </div><br>
        
                <label for="address">City:</label>  
                <input type="text" id="city" name="city" value="<?=$city?>"><br>

                <label for="address">Address line 1:</label>  
                <input type="text" id="address1" name="address1" value="<?=$adrln1?>"><br>

                <label for="address">Address line 2:</label>  
                <input type="text" id="address2" name="address2" value="<?=$adrln2?>"><br>
                
                <label for="address">Postcode:</label>  
                <input type="text" id="postcode" name="postcode" value="<?=$postcode?>"><br>

                <?= $taken?>
                <button type="submit" class="saveDetails">Save Details</button>
                <input type="hidden" name="submittedDetails" value="true">

        
              </form>

            </div>
    </div>
</body>
</html>

<script>
    document.getElementById('changeD').onclick = function() {
        document.getElementById('aname').removeAttribute('readonly');
        document.getElementById('apass').removeAttribute('readonly');
        document.getElementById('address').removeAttribute('readonly');  
        document.getElementById('acpasslabel').removeAttribute('hidden');  
        document.getElementById('acpass').removeAttribute('hidden');  
        document.getElementById('submit').removeAttribute('hidden');  


    };

</script>
