<?php
    $DB_HOST = "localhost";
    $DB_USER = "root";
    $DB_PASS = "";
    $DB_NAME = "dbhotel";

    $db = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    if(!$db){
        exit("Failed to connect to database: ".mysqli_connect_error());
    }
?>