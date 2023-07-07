<?php

require "config/config.php";

if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
    // echo $id;
    $query = "SELECT * FROM patients WHERE id = $id";
    $query_result = mysqli_query($dbconnection,$query);
    $user = mysqli_fetch_assoc($query_result);

    // delete the user
    $query_delete = "DELETE FROM patients WHERE id=$id LIMIT 1";
    $delete_result = mysqli_query($dbconnection,$query_delete);
    if(mysqli_errno($dbconnection)) {
        $_SESSION['delete-patient-error'] = "Could not delete '{$user['patient_name']}' ";
    } else {
        $_SESSION['delete-patient-success'] = "'{$user['patient_name']}' deleted successfully";
    }
}

header('location: ' . ROOT_URL . 'index.php');
die();