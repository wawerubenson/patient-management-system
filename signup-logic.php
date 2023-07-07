

<?php

require "config/config.php";
// Getting form data from the user

if(isset($_POST['register'])){
    $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $role = filter_var($_POST['role'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cpassword = filter_var($_POST['cpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   
    $profile_photo = $_FILES['profile_photo'];

    // validate values
    if(!$first_name) {
        $_SESSION["register-user"] = "Name is required";
    }elseif (!$last_name) {
        $_SESSION["register-user"] = "Last name is required";
    }elseif (!$email) {
        $_SESSION["register-user"] = "Email is required";
    }elseif (!$role) {
        $_SESSION["register-user"] = "Enter role";
    }elseif (strlen($password) < 4 || strlen($cpassword) < 4) {
        $_SESSION["register-user"] = "Password must be 4 characters or more";
    }elseif($password !== $cpassword) {
        $_SESSION["register-user"] = "Passwords did not match";
    } else {
        // work on avatar
                // rename avatar
                // var_dump($profile_photo);
                $time = time(); //make image name unique
                $photo_name = $time . $profile_photo['name'];
                $photo_tmp_name = $profile_photo['tmp_name'];
                $uploading_folder = 'users_profile/' . $photo_name;
                    if($profile_photo['size'] < 5000000) {
                        // upload image
                        
                    } else {
                        $_SESSION["register-user"] = "Image must be less than 2 mb";
                    }

    }

    $select_query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $select_query_result = mysqli_query($dbconnection,$select_query);
    if(mysqli_num_rows($select_query_result) > 0) {
        $_SESSION['register-user'] = "User already exists";
    }

    // redirect back to signup in case of any errors
    if (isset($_SESSION["register-user"])) {
        // pass data back to form
        $_SESSION['register-data'] = $_POST;
        header('Location: ' . ROOT_URL . 'signup.php');
        die();
    }else {

        $hashed = password_hash($cpassword,PASSWORD_DEFAULT);
        $insert_query = "INSERT INTO users (first_name,last_name,email,role,password,profile_photo,is_admin) VALUES  ('$first_name','$last_name','$email','$role','$hashed','$photo_name',2)";

        $query_result = mysqli_query($dbconnection,$insert_query);

        if(!mysqli_error($dbconnection)) {
            $_SESSION['signup-success'] = "$first_name registered successfully";
            // redirect to login page with success message
            move_uploaded_file($photo_tmp_name,$uploading_folder);
            header('Location: login.php');
            die();

        }
    }

}else {
    // if button wasnt clicked... return user to signup

    header('Location: ' . ROOT_URL . 'signup.php');
}
