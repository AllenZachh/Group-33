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

<?php require_once("navbar.php");
navbar("productList"); ?>

<body>
    <h1>View and change your details</h1>

    <div id = "changeDetails">
            <form class = "lgrcontainer"  action="">
                <label for="aname">Account name:</label>
                <input type="text" id="aname" name="aname" value = "name" readonly><br><br>
        
                <label for="address">Address</label>  
                <input type="text" id="address" name="address" value="address" readonly><br><br>
        
                <label for="apass">Password</label>  
                <input type="text" id="apass" name="apass" value="password" readonly><br><br>
        
                <label id = "acpasslabel" for="acpass" hidden> Confirm Password</label>  
                <input type="text" id="acpass" name="acpass" value="password" hidden ><br><br>
                <input id = "submit" class = "submit" type="submit" value="Submit" hidden>

        
              </form>
              <button id = "changeD">Change Details</button>

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
