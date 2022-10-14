<?php
    session_start();

    $_SESSION['name'] = $_POST['hotel-name'];
    $_SESSION['country'] = $_POST['hotel-country'];
    $_SESSION['city'] = $_POST['hotel-city'];
    $_SESSION['price'] = $_POST['hotel-price'];
    $_SESSION['id'] = $_POST['hotel-id'];
    echo "<meta http-equiv='refresh' content='0; url=../index.php?p=book'>";
?>