<?php
include "config/config.php";


if(!isset($_SESSION['user-id'])) {
    header('Location: login.php');
    die();
  }else {
    $current_user = $_SESSION['user-id'];
    $select_user = "SELECT * FROM users WHERE id = $current_user";
    $select_user_result = mysqli_query($dbconnection,$select_user);
    $select_array = mysqli_fetch_assoc($select_user_result);
    $current = $select_array['first_name'];
  }

// require "config/config.php";
// Getting form data from the user

if(isset($_POST['edit_prescription'])){
    $pid = filter_var($_POST['p_id'],FILTER_SANITIZE_NUMBER_INT);
    $patient_name = filter_var($_POST['patient_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $symptoms = filter_var($_POST['symptoms'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $drugs = filter_var($_POST['drugs'],FILTER_SANITIZE_FULL_SPECIAL_CHARS );
    
    // validate values
    if(!$patient_name || !$symptoms || !$drugs) {
        $_SESSION["edit-data-error"] = "Enter valid data";
    } 
    

    // redirect back to signup in case of any errors
    if (isset($_SESSION["edit-data-error"])) {
        // pass data back to form
        $_SESSION['prescription-data'] = $_POST;
        header('Location: ' . ROOT_URL . 'edit-prescription.php');
        die();
    }else {
        // insert new users
        $insert_query = "UPDATE prescriptions SET symptoms='$symptoms', drugs = '$drugs' WHERE id = '$pid' LIMIT 1";
        $insert = mysqli_query($dbconnection,$insert_query);

        if(!mysqli_error($dbconnection)) {
            // echo "hello";
            // redirect to login page with success message
            $_SESSION["edit-prescription-success"] = "Prescription for $patient_name edited successfully";
            header('Location: prescriptions.php');
        }
    }

}else {
    // if button wasnt clicked... return user to signup
    header('Location: ' . ROOT_URL . 'edit-prescription.php');
    die();
}
