


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

if(isset($_POST['add_patient'])){
    $patient_name = filter_var($_POST['patient_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $patient_email = filter_var($_POST['patient_email'], FILTER_VALIDATE_EMAIL);
    $weight = filter_var($_POST['weight'],FILTER_SANITIZE_NUMBER_INT );

    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
    $dob = filter_var($_POST['dob'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $gender = filter_var($_POST['gender'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $blood_type = filter_var($_POST['blood_type'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    // validate values
    if(!$patient_name) {
        $_SESSION["add-patient"] = "Please enter patient name";
    }elseif (!$patient_email) {
        $_SESSION["add-patient"] = "Please enter patient email";
    } elseif(!$phone) {
        $_SESSION["add-patient"] = "Enter patient number.";
    } elseif (!$dob) {
        $_SESSION["add-patient"] = "Date is required";
    }elseif (!$gender) {
        $_SESSION["add-patient"] = "Add gender";
    }elseif (!$blood_type) {
        $_SESSION["add-patient"] = "Select blood type";
    } elseif(!$weight) {
        $_SESSION["add-patient"] = "Enter patient weight";
    } else {
            $user_check_query = "SELECT * FROM patients WHERE patient_email = '$patient_email' ";

            $user_check_result = mysqli_query($dbconnection,$user_check_query);
            if(mysqli_num_rows($user_check_result) > 0) {
                $_SESSION["add-patient"] = " Patient with such email already exists";
            }
        }
    

    // redirect back to signup in case of any errors
    if (isset($_SESSION["add-patient"])) {
        // pass data back to form
        $_SESSION['patient-data'] = $_POST;
        header('Location: ' . ROOT_URL . 'add-patient.php');
        die();
    }else {
        // insert new users
        $insert_query = "INSERT INTO patients (patient_name,patient_email,patient_phone,dob,weight,gender,blood_type,author_name)
        VALUES  ('$patient_name','$patient_email',$phone,'$dob',$weight,'$gender','$blood_type','$current')";
        $insert = mysqli_query($dbconnection,$insert_query);

        if(!mysqli_error($dbconnection)) {
            echo "hello";
            // redirect to login page with success message
            $_SESSION["add-patient-success"] = "Patient $patient_name added successfully";
            header('Location: ' . ROOT_URL );
        }
    }

}else {
    // if button wasnt clicked... return user to signup
    header('Location: ' . ROOT_URL . 'add-patient.php');
    die();
}
