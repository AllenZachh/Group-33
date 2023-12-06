<?php
    $servername = "localhost";
    $username = "root";
    $password = ""; 
    $dbname = "tp33";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $comments = $_POST['comments'];

    $sql = "INSERT INTO contact_form (name, email, comments) VALUES ('$name', '$email', '$comments')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Thanks for reaching out. We will contact you as soon as possible.");window.location.href = "contact.html"; </script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
?>
