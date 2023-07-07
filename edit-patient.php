<?php
include "config/config.php";
include "header.php";
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    // fetch category from the database
    $query = "SELECT * FROM patients WHERE id = $id";
    $query_result = mysqli_query($dbconnection, $query);
    $patients = mysqli_fetch_assoc($query_result);
} else {
    header('location: ' . ROOT_URL);
}

?>
<!-- Page Header Start -- home page -->
<div class="container-fluid page-header-home mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center px-2 pt-lg-2" style="min-height: 100px">
        <h4 class="mb-3 mt-0 mt-lg-2 text-uppercase font-weight-bold">EDIT PATIENT DETAILS </h4>
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
                            <h1>edit patient details</h1>
                        </div>
                        <div class="card-body p-5 pt-3">

                            <form method="post" action="edit-patient-script.php" enctype="multipart/form-data">

                                <?php
                                if (isset($_SESSION['edit-patient'])) : ?>
                                    <div class="alert__message error">
                                        <p> <?= $_SESSION['edit-patient'];
                                            unset($_SESSION['edit-patient']);
                                            ?> </p>
                                    </div>
                                <?php endif ?>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example1cg">Patient Name</label>
                                    <input value="<?= $patients['patient_name'] ?>" required type="text" id="form3Example1cg" name="patient_name" class="form-control form-control-lg" />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example3cg">Patient email:</label>
                                    <input required type="text" id="form3Example3cg" value="<?= $patients['patient_email'] ?>" name="patient_email" class="form-control form-control-lg" />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example3cg">Phone:</label>
                                    <input required type="text" id="form3Example3cg" value="<?= $patients['patient_phone'] ?>" name="patient_phone" class="form-control form-control-lg" />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example3cg">Date of birth:</label>
                                    <input value="<?= $patients['dob'] ?>" required type="date" id="form3Example3cg" name="dob" class="form-control form-control-lg" />
                                </div>


                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example3cg">Weight:</label>
                                    <input required value="<?= $patients['weight'] ?>" type="number" id="form3Example3cg" name="weight" class="form-control form-control-lg" />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example3cg">Gender:</label>
                                    <select class="form-control form-control-lg" name="gender" id="">
                                        <option class="form-control form-control-lg" value="male" selected>Male</option>
                                        <option class="form-control form-control-lg" value="female">Female</option>
                                    </select>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example3cg">Blood type:</label>
                                    <select value="<?= $patients['blood_type'] ?>" class="form-control form-control-lg" name="blood_type" id="">
                                        <option class="form-control form-control-lg" value="B+" selected>B+</option>
                                        <option class="form-control form-control-lg" value="A">A</option>
                                        <option class="form-control form-control-lg" value="A+">A+</option>
                                    </select>
                                </div>


                                <div class="d-flex justify-content-center">
                                    <button type="submit" name="edit_patient" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">EDIT Patient</button>
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