<?php
include "config/config.php";
include "header.php";

if (isset($_GET['id'])) {
    $current_user = $_SESSION['user-id'];
    $select_user = "SELECT * FROM users WHERE id = $current_user";
    $select_user_ress = mysqli_query($dbconnection, $select_user);
    $current = mysqli_fetch_assoc($select_user_ress);

    $prescription_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    // fetch category from the database
    $query = "SELECT * FROM prescriptions WHERE id = $prescription_id";
    $query_result = mysqli_query($dbconnection, $query);
    $prescription = mysqli_fetch_assoc($query_result);

    $pat = $prescription['patient_id'];

    $patient_query = "SELECT * FROM patients WHERE id = $pat";
    $query_result = mysqli_query($dbconnection, $query);
    $patient_curr = mysqli_fetch_assoc($query_result);
} else {
    header('location: ' . ROOT_URL);
}

?>
<!-- Page Header Start -- home page -->
<div class="container-fluid page-header-home mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center px-2 pt-lg-2" style="min-height: 100px">
        <h4 class="mb-3 mt-0 mt-lg-2 text-uppercase font-weight-bold"> EDIT PATIENT PRESCRIPTION </h4>
    </div>
</div>
<!-- Page Header End -->


<section class="vh-100 bg-image mt-4" style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">

                        <div class="form-header">
                            <h1>edit prescription</h1>
                        </div>
                        <div class="card-body p-5 pt-3">

                            <form method="post" action="edit-prescription-logic.php" enctype="multipart/form-data">

                                <?php
                                if (isset($_SESSION['add-prescription'])) : ?>
                                    <div class="alert__message error">
                                        <p> <?= $_SESSION['add-prescription'];
                                            unset($_SESSION['add-prescription']);
                                            ?> </p>
                                    </div>
                                <?php endif ?>

                                <input type="hidden" name="p_id" value="<?= $prescription['id'] ?>">

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example1cg">Patient name:</label>
                                    <input value="<?= $patient_curr['patient_name'] ?>" required type="text" readonly id="form3Example1cg" name="patient_name" class="form-control form-control-lg" />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example3cg">Symptoms</label>
                                    <textarea  class="form-control form-control-lg" placeholder="Enter sysmptoms in point form" name="symptoms" id="" cols="30" rows="5"><?= $prescription['symptoms'] ?></textarea>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example3cg">Drugs prescription:</label>
                                    <textarea value="" class="form-control form-control-lg" placeholder="Enter drug prescription with dosage" name="drugs" id="" cols="20" rows="5"><?= $prescription['drugs'] ?> </textarea>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example3cg">Doctor:</label>
                                    <input readonly value="<?= $current['first_name'] ?>" required type="text" id="form3Example3cg" name="doctor" class="form-control form-control-lg" />
                                </div>


                                <div class="d-flex justify-content-center">
                                    <button type="submit" name="edit_prescription" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">EDIT PRESCRIPTION</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<!-- Footer Starts Here -->

<?php include "footer.php"; ?>