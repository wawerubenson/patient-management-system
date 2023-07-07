<?php

include "config/config.php";

if (!isset($_GET['id'])) {
    header('Location: prescriptions.php');
    die();
}

$current_user = $_SESSION['user-id'];
$select_user = "SELECT * FROM users WHERE id = $current_user";
$select_user_result = mysqli_query($dbconnection, $select_user);
$select_array = mysqli_fetch_assoc($select_user_result);
$current = $select_array['first_name'];

// echo $current;
$presc_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
// $presc_id = $_GET['id'];
echo $presc_id;
$query = "SELECT * FROM prescriptions WHERE id = $presc_id";
$query_ress = mysqli_query($dbconnection, $query);
$ress_array = mysqli_fetch_assoc($query_ress);

$pat_id = $ress_array['patient_id'];

echo $pat_id;

$patient_query = "SELECT * FROM patients WHERE id = $pat_id LIMIT 1";
$patient_re = mysqli_query($dbconnection, $patient_query);
$patient_query_ress = mysqli_fetch_assoc($patient_re);
$pre_id = $patient_query_ress['id'];

$patient_name = $patient_query_ress['patient_name'];
$patient_email = $patient_query_ress['patient_email'];
$patient_phone = $patient_query_ress['patient_phone'];
$weight = $patient_query_ress['patient_phone'];
$blood_type = $patient_query_ress['blood_type'];
$gender = $patient_query_ress['gender'];
$adm_date = $patient_query_ress['reg_time'];
$patient_id = $patient_query_ress['id'];


$insert_patient = "INSERT INTO served_patients (patient_name,patient_id,patient_email,patient_phone,patient_weight,blood_type,gender,adm_date)
VALUES ('$patient_name', '$patient_id' , '$patient_email', $patient_phone, '$weight', '$blood_type', '$gender', '$adm_date')";
$ress = mysqli_query($dbconnection, $insert_patient);

if (!mysqli_errno($dbconnection)) {
    $delete_query = "DELETE FROM prescriptions WHERE id = $presc_id LIMIT 1";
    $delete_ress = mysqli_query($dbconnection, $delete_query);
    $_SESSION['clear-patient-success'] = "Patient $patient_name cleared successfully";
    header('Location: served_patients.php');
    die();
}
