




<?php
include "config/config.php";


if (!isset($_SESSION['user-id'])) {
    header('Location: login.php');
    die();
} else {
    $current_user = $_SESSION['user-id'];
    $select_user = "SELECT * FROM users WHERE id = $current_user";
    $select_user_result = mysqli_query($dbconnection, $select_user);
    $select_array = mysqli_fetch_assoc($select_user_result);
    $current = $select_array['first_name'];
}




    // require "config/config.php";
    // Getting form data from the user

    if (isset($_POST['edit_patient'])) {
        $patient_name = filter_var($_POST['patient_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $patient_email = filter_var($_POST['patient_email'], FILTER_VALIDATE_EMAIL);
        $weight = filter_var($_POST['weight'], FILTER_SANITIZE_NUMBER_INT);

        $phone = filter_var($_POST['patient_phone'], FILTER_SANITIZE_NUMBER_INT);
        $dob = filter_var($_POST['dob'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $gender = filter_var($_POST['gender'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $blood_type = filter_var($_POST['blood_type'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // validate values
        if (!$patient_name || !$patient_email || !$weight || !$phone || !$dob || !$gender || !$blood_type) {
            $_SESSION["edit-patient"] = "Invalid input";
        } 


        // redirect back to signup in case of any errors
        if (isset($_SESSION["edit-patient"])) {
            // pass data back to form
            $_SESSION['edit-patient-data'] = $_POST;
            header('Location: ' . ROOT_URL . 'edit-patient.php');
            die();
        } else {
            // insert new users
            $insert_query = "UPDATE patients SET patient_name = '$patient_name',patient_email = '$patient_email',patient_phone = '$phone',dob = '$dob',weight = $weight,gender = '$gender',blood_type='$blood_type' LIMIT 1";
            
            $insert = mysqli_query($dbconnection, $insert_query);

            if (!mysqli_error($dbconnection)) {
                // echo "hello";
                // redirect to login page with success message
                $_SESSION["edit-patient-success"] = "Patient $patient_name edited successfully";
                header('Location: ' . ROOT_URL);
            }
        }
    } else {
        // if button wasnt clicked... return user to signup
        header('Location: ' . ROOT_URL . 'edit-patient.php');
        die();
    }

