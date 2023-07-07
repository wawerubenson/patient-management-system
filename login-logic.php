



<?php
require "config/config.php";

if(isset($_POST['login'])) {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if(!$email) {
        $_SESSION['signin'] = "Enter user email";
    } elseif (!$password) {
        $_SESSION['signin'] = "Enter password";
    } else {
        // fetch users from db
        $fetch_user = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $fetch_user_result = mysqli_query($dbconnection,$fetch_user);

        if(mysqli_num_rows($fetch_user_result) == 1) {
            // convert record into assoc array
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['password'];
            // compare password
            if(password_verify($password, $db_password)) {
                // set session for access control
                $_SESSION['user-id'] = $user_record['id'];
                // check if user is admin or not
                if($user_record['is_admin'] == 1) {
                    $_SESSION['user_is_admin'] = true;
                }
                // login user
                header('Location: ' . ROOT_URL );
            } else {
                $_SESSION['signin'] = "Check your password";
            }
        } else {
            $_SESSION['signin'] = "User not found. Try again";
        }
    }
    // redirect to signin page
    if(isset($_SESSION['signin'])) {
        $_SESSION['signin-data'] = $_POST;
        header('Location: ' . ROOT_URL . 'login.php');
        die();
    }

} else {
    header('Location: ' . ROOT_URL . 'login.php');
}