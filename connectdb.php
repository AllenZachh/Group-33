<?php

    $db_host = 'localhost';
    $db_name = 'u_220136264_glacier_guys';
    $username = 'u-220136264';
    $password = 'nblCSkWM51PO69M';


    # Attemp to connect to database, otherwise catch and report error
    try{
        $db = new PDO("mysql:dbname=$db_name;host=$db_host", $username, $password);
    } catch(PDOException $ex){
        echo("Failed to connect to the database.<br>");
        echo($ex->getMessage());
        exit;
    }

?>