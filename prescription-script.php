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

if(isset($_POST['add_prescription'])){
    $patient_name = filter_var($_POST['patient_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $patient_id = filter_var($_POST['patient_id'], FILTER_SANITIZE_NUMBER_INT);
    $symptoms = filter_var($_POST['symptoms'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $prescriptions = filter_var($_POST['drugs'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $doctor = filter_var($_POST['doctor'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    
    // validate values
    if(!$patient_name) {
        $_SESSION["add-prescription"] = "Please enter patient name";
    }elseif (!$symptoms) {
        $_SESSION["add-prescription"] = "Enter patient prescriptions";
    } elseif(!$prescriptions) {
        $_SESSION["add-prescription"] = "Enter patient prescritions.";
    } 
    

    // redirect back to signup in case of any errors
    if (isset($_SESSION["add-prescription"])) {
        // pass data back to form
        $_SESSION['patient-data'] = $_POST;
        header('Location: ' . ROOT_URL . 'add-patient.php');
        die();
    }else {
        // insert new users
        $insert_query = "INSERT INTO prescriptions (patient_name,patient_id,symptoms,drugs,doctor_name)
        VALUES  ('$patient_name',$patient_id,'$symptoms','$prescriptions','$doctor')";
        $insert = mysqli_query($dbconnection,$insert_query);

        if(!mysqli_error($dbconnection)) {
            echo "hello";
            // redirect to login page with success message
            $_SESSION["add-prescription-success"] = "Prescription for $patient_name added successfully";
            header('Location: prescriptions.php');
        }
    }

}else {
    // if button wasnt clicked... return user to signup
    header('Location: ' . ROOT_URL . 'patient-prescription.php');
    die();
}
