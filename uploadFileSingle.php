<?php
$target_dir = "./images/";

$_POST['name'] = $_POST['productType'].$_POST['colour'];
if (str_contains($_FILES["fileToUpload2"]["name"], '.jpg')){
    $target_file2 = $target_dir . basename($_POST['name'].'.jpg');
} elseif (str_contains($_FILES["fileToUpload2"]["name"], '.png')) {
    $target_file2 = $target_dir . basename($_POST['name'].'.png');
} elseif (str_contains($_FILES["fileToUpload2"]["name"], '.jpeg')) {
    $target_file2 = $target_dir . basename($_POST['name'].'.jpeg');
} elseif (str_contains($_FILES["fileToUpload2"]["name"], '.gif')) {
    $target_file2 = $target_dir . basename($_POST['name'].'.gif');
} else {
    $target_file2 = $target_dir . basename($_FILES["fileToUpload2"]["name"]);
}
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload2"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file2)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_file2)) {
    //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload2"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>