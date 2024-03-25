<?php
session_start();
require_once('connectdb.php');
$taken='';

if (isset($_POST["submittedPass"])){

    if ($_POST['newPass']==$_POST['newPass2']){
        $password=isset($_POST["newPass"])?password_hash($_POST['newPass'],PASSWORD_DEFAULT):false;

        $stmt = $db->prepare("SELECT password FROM user WHERE userid = ".$_SESSION['userid']);
        $stmt->execute();
        $pass = $stmt->fetch(PDO::FETCH_ASSOC);

        $oldpass = password_hash($_POST['oldPass'],PASSWORD_DEFAULT);

        if ($oldpass = $pass['password']){

            $stat = $db->prepare('UPDATE user SET password=? WHERE userid = '.$_SESSION['userid']);
	        $stat->execute(array($password));

        } else {
            $taken='<p>Old password incorrect!<p>';
        }

      } else {
        $taken='<p>Passwords dont match!<p>';
      }
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

    <div id = "changeDetails">
        
            <form class = "lgrcontainer" method="post" action="changePassword.php">
            <h1>Change Password</h1>

                <label for="oldPass">Current Password:</label>
                <input type="text" id="oldPass" name="oldPass" required><br>

                <label for="newPass">New Password:</label>
                <input type="text" id="newPass" name="newPass" required><br>

                <label for="newPass2">Repeat New Password:</label>
                <input type="text" id="newPass2" name="newPass2" required><br>
                
                <?= $taken?><br>
                <button type="submit" class="saveDetails">Change Password</button>
                <input type="hidden" name="submittedPass" value="true">

        
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
