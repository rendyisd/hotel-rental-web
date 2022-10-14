<?php
    session_start();
    
    require_once 'connect.php';

    if(!isset($_POST['email'], $_POST['password'])){
        exit('Please fill both the email and password fields!');
    }

    $stmt = $db -> prepare('SELECT id, username, email, password FROM accounts WHERE email = ?');

    if($stmt){
        $stmt->bind_param('s', $_POST['email']);
        $stmt->execute();
        $stmt->store_result();

        // This runs if a username given by the user matches with the one or more in our database
        if($stmt->num_rows > 0){
            $stmt->bind_result($id, $username, $email, $password);
            $stmt->fetch();

            // Note: passwords are stored in their hashed form
            // This runs if the password match
            if(password_verify($_POST['password'], $password)){
                session_regenerate_id();
                $_SESSION['failedLogin'] = FALSE;

                $_SESSION['loggedin'] = TRUE;
                $_SESSION['id_user'] = $id;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;

                header('Location: index.php');
            }
            else{
                $_SESSION['failedLogin'] = TRUE;
            }
        }
        else{
            $_SESSION['failedLogin'] = TRUE;
        }
        header('Location: index.php');

        $stmt->close();
    }
?>