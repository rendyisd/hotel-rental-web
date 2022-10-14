<?php
    require_once 'connect.php';

    if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
        header('Location: index.php');
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        header('Location: index.php');
    }

    if ($stmt = $db->prepare('SELECT * FROM accounts WHERE email = ?')) {
        $stmt->bind_param('s', $_POST['email']);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo '<script language="javascript">';
            echo 'alert("An account with this email address already exists!")';
            echo '</script>';
        }
        else {
            if ($stmt = $db->prepare('INSERT INTO accounts (username, password, email) VALUES (?, ?, ?)')) {
                // Hash the password
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
                $stmt->execute();
            }
        }
        $stmt->close();
    }

    header('Location: index.php');

?>