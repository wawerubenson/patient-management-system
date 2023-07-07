


<?php include "config/config.php";

if(!isset($_SESSION['user-id'])) {
    header('Location: login.php');
    die();
}


$patient_name = $_SESSION['patient-data']['patient_name'] ?? null;
$patient_email = $_SESSION['patient-data']['patient_email'] ?? null;
$phone = $_SESSION['patient-data']['phone'] ?? null;
$weight = $_SESSION['patient-data']['weight'] ?? null;
$dob = $_SESSION['patient-data']['dob'] ?? null;

unset($_SESSION['post-data']);


?>
<?php include "header.php"; ?>

     <!-- Page Header Start -- home page -->
     <div class="container-fluid page-header-home mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-2" style="min-height: 100px">
            <h4 class="mb-3 mt-0 mt-lg-2 text-uppercase font-weight-900">ADD NEW PATIENT</h4>

            <p>
               Add new patient with their details.
            </p>
          
        </div>
    </div>
<!-- Page Header End -->
        
<section class="vh-100 bg-image mt-4"
style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
<div class="mask d-flex align-items-center h-100 gradient-custom-3">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-9 col-lg-7 col-xl-6">
        <div class="card" style="border-radius: 15px;">

          <div class="card-body p-5 pt-3">

            <form method="post" action="add-patient-logic.php" enctype="multipart/form-data">

            <?php
               if(isset($_SESSION['add-patient'])): ?>
                <div class="alert__message error">
                <p> <?= $_SESSION['add-patient']; 
                unset($_SESSION['add-patient']);
                ?> </p>
                </div>
                <?php endif ?>   

              <div class="form-outline mb-4">
              <label class="form-label" for="form3Example1cg">Patient Name</label>
                <input value = "<?= $patient_name ?>" placeholder="enter patient name ..." required type="text" id="form3Example1cg" name="patient_name" class="form-control form-control-lg" />
                
              </div>

              <div class="form-outline mb-4">
              <label class="form-label" for="form3Example3cg">Patient email:</label>
                <input required type="email" id="form3Example3cg" value = "<?= $patient_email ?>" name="patient_email" class="form-control form-control-lg" />
              </div>

              <div class="form-outline mb-4">
              <label class="form-label" for="form3Example3cg">Patient number:</label>
                <input value = "<?= $phone ?>" required type="number" id="form3Example3cg" name="phone" class="form-control form-control-lg" />
              </div>

              <div class="form-outline mb-4">
              <label class="form-label" for="form3Example3cg">Date of birth:</label>
                <input value = "<?= $dob ?>" required type="date" id="form3Example3cg" name="dob" class="form-control form-control-lg" />
              </div>

              <div class="form-outline mb-4">
              <label class="form-label" for="form3Example3cg">weight:</label>
                <input value = "<?= $weight ?>" required type="number" id="form3Example3cg" name="weight" class="form-control form-control-lg" />
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
                <select class="form-control form-control-lg" name="blood_type" id="">
                  <option class="form-control form-control-lg" value="B+" selected>B+</option>
                  <option class="form-control form-control-lg" value="A">A</option>
                  <option class="form-control form-control-lg" value="A+">A+</option>
                </select>
                </div>

            

              <div class="d-flex justify-content-center">
                <button type="submit" name="add_patient" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Add  Patient</button>
              </div>

              <p class="text-center text-muted mt-5 mb-0">Have an account? <a href="#!"
                  class="fw-bold text-body"><u><a href="login.php">Login here</a></u></a></p>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>


<?php include "footer.php" ?>