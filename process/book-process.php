<?php
    session_start();
    require_once '../connect.php';

    if(!isset($_SESSION['loggedin'])){
        echo "<script>alert('You must login first before a reservation can be made!');</script>";
        header("Location: ../index.php");
    }
    
    $checkInDate = mysqli_real_escape_string($db, $_POST['check-in-date']);
    $checkOutDate = mysqli_real_escape_string($db, $_POST['check-out-date']);
    $finalPrice = mysqli_real_escape_string($db, $_POST['final-price']);
    $guestCount = mysqli_real_escape_string($db, $_POST['guest']);
    $userID = $_SESSION['id_user'];
    $hotelID = $_SESSION['id'];

    $sql = "INSERT INTO book_history (CheckInDate, CheckOutDate, TotalPrice, GuestCount, id, HotelID) VALUES ('$checkInDate', '$checkOutDate', '$finalPrice', '$guestCount', $userID, $hotelID)";

    $query = mysqli_query($db, $sql);

    if(!$query){
        header("Location: ../index.php");
    }

    echo "<meta http-equiv='refresh' content='0; url=../index.php?p=profile'>";

?>