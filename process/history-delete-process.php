<?php
    require_once '../connect.php';

    $sql = "DELETE FROM book_history WHERE BookID = ".$_POST['history-id'];

    $query = mysqli_query($db, $sql);

    if(!$query){
        header('Location: ../index.php');
    }

    echo "<meta http-equiv='refresh' content='0; url=../index.php?p=profile'>";
?>