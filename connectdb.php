<?php

    $db_host = 'localhost';
    $db_name = 'glacier_guys';
    $username = 'root';
    $password = '';


    # Attemp to connect to database, otherwise catch and report error
    try{
        $db = new PDO("mysql:dbname=$db_name;host=$db_host", $username, $password);
    } catch(PDOException $ex){
        return("Failed to connect to the database.<br>");
        //echo($ex->getMessage());
    }

?>