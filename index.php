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
}
?>
<?php include "header.php"; ?>

<div class="container-static">
  <aside>

    <div class="top">
      <div class="logo">

        <h2>P. M. S.</h2>
      </div>
      <div class="close" id="close-btn">
        <span><img src="images/cancel.png" height="20" width="20" alt="" /></span>
      </div>
    </div>

    <div class="side-bar">
      <a class="active" href="">
        <span><i class="fa fa-tachometer" aria-hidden="true"></i></span>
        <h3>Patients</h3>
      </a>
      <?php if ($select_array['role'] == 'doctor'): ?>
        <a href="add-patient.php">
          <span><span><i class="fa fa-puzzle-piece" aria-hidden="true"></i></span></span>
          <h3>Add Patient</h3>
        </a>
      <?php elseif ($select_array['role'] == 'pharmacist'): ?>
        <!-- <p></p> -->
      <?php endif ?>
      <a href="prescriptions.php">
        <span><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
        </span>
        <h3>Prescriptions</h3>
      </a>
      <a href="served_patients.php">
        <span><i class="fa fa-commenting" aria-hidden="true"></i>
        </span>
        <h3>Served Patients</h3>
        <!-- <span class="message-count">34</span> -->
      </a>
      <a href="users.php">
        <span><i class="fa fa-address-book" aria-hidden="true"></i>
        </span>
        <h3>Users</h3>
      </a>

      <a href="logout.php">
        <span><i class="fa fa-sign-out" aria-hidden="true"></i>
        </span>
        <h3>Logout</h3>
      </a>
    </div>
  </aside>

  <main>

    <div class="admin-header ">
      <div class="admin-logo">
        <h3>Patient Management System</h3>
      </div>

      <div class="profile">
        <p>Logged in as
          <?= $select_array['first_name'] ?>
        </p>
        <img src="users_profile/<?= $select_array['profile_photo'] ?>" height="50px" width="50px" alt="">
        <p>
          <?= $select_array['role'] ?>
        </p>
      </div>
    </div>


    <?php

    $count_patients_query = "SELECT * FROM patients";
    $count_patients_query_ress = mysqli_query($dbconnection, $count_patients_query);
    $patients_count = mysqli_num_rows($count_patients_query_ress);

    $count_prescription_query = "SELECT * FROM prescriptions";
    $count_prescription_query_ress = mysqli_query($dbconnection, $count_prescription_query);
    $prescriptions_count = mysqli_num_rows($count_prescription_query_ress);

    $count_doctor_query = "SELECT * FROM users";
    $count_doctor_query_ress = mysqli_query($dbconnection, $count_doctor_query);
    $doctor_count = mysqli_num_rows($count_doctor_query_ress);

    $count_served_query = "SELECT * FROM served_patients";
    $count_served_query_ress = mysqli_query($dbconnection, $count_served_query);
    $served_count = mysqli_num_rows($count_served_query_ress);
    ?>

    <div class="insights container d-flex">

      <div class="products col-md-3">
        <!-- <span class="fa fa-diamond" aria-hidden="true"></span> -->
        <div class="middle">
          <div class="left">
            <h1>
              <?= $patients_count ?>
            </h1>
            <h3>
              <?php if ($patients_count == 1) {
                echo "Current Patient";
              } else {
                echo "Current Patients";
              } ?>
            </h3>
          </div>
        </div>
      </div>
      <!-- end of sales -->

      <div class="bids col-md-3">
        <!-- <span class="fa fa-area-chart" aria-hidden="true"></span> -->
        <div class="middle">
          <div class="left">
            <h1>
              <?= $doctor_count ?>
            </h1>
            <h3>
              <?php if ($prescriptions_count == 1) {
                echo "Attendant";
              } else {
                echo "Attendants";
              } ?>
            </h3>
          </div>
        </div>
      </div>

      <!-- end of bids -->

      <div class="users col-md-3">
        <!-- <i class="fa fa-user-circle" aria-hidden="true"></i> -->
        <div class="middle">
          <div class="left">
            <h1>
              <?= $prescriptions_count ?>
            </h1>
            <h3>
              <?php if ($prescriptions_count == 1) {
                echo "Prescription";
              } else {
                echo "Prescriptions";
              } ?>
            </h3>
          </div>
        </div>
      </div>

      <div class="users col-md-3">
        <!-- <i class="fa fa-user-circle" aria-hidden="true"></i> -->
        <div class="middle">
          <div class="left">
            <h1>
              <?= $served_count ?>
            </h1>
            <h3>
              <?php if ($served_count == 1) {
                echo "Served Patient";
              } else {
                echo "Served Patients";
              } ?>
            </h3>
          </div>
        </div>
      </div>

    </div>

    <?php
    $select_patients = "SELECT * FROM patients order by reg_time desc";
    $select_patients_result = mysqli_query($dbconnection, $select_patients);
    ?>
    <div class="recent-order">
      <?php if (isset($_SESSION['edit-patient-success'])): ?>
        <!-- <div class="alert__message success container-static"> -->
        <small class="success">
          <?= $_SESSION['edit-patient-success'];
          unset($_SESSION['edit-patient-success']); ?>
        </small>

      <?php elseif (isset($_SESSION['delete-patient-success'])): ?>
        <!-- <div class="alert__message success container-static"> -->
        <small style="font-size: 14px;" class="success">
          <?= $_SESSION['delete-patient-success'];
          unset($_SESSION['delete-patient-success']); ?>
        </small>

      <?php elseif (isset($_SESSION['add-patient-success'])): ?>
        <!-- <div class="alert__message success container-static"> -->
        <small style="font-size: 14px;" class="success">
          <?= $_SESSION['add-patient-success'];
          unset($_SESSION['add-patient-success']); ?>
        </small>

      <?php elseif (isset($_SESSION['doctor-error'])): ?>
        <!-- <div class="alert__message success container-static"> -->
        <small style="font-size: 14px;" class="success">
          <?= $_SESSION['doctor-error'];
          unset($_SESSION['doctor-error']); ?>
        </small>

      <?php endif ?>
      <h2>Patients Records</h2>

      <?php if (mysqli_num_rows($select_patients_result) > 0): ?>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Phone</th>
              <th>Time in</th>
              <th>Gender</th>
              <?php if ($select_array['role'] == 'doctor'): ?>
                <th>Edit</th>
                <th>Delete</th>
              <?php elseif ($select_array['role'] == 'pharmacist'): ?>
                <p></p>
              <?php endif ?>

              <th>prescribe</th>
            </tr>
          </thead>

          <tbody>


            <?php while ($patient = mysqli_fetch_assoc($select_patients_result)): ?>
              <?php
              $patient_id = $patient['id'];
              $date = date_create($patient['reg_time']); ?>
              <?php
              $select_query = "SELECT * FROM served_patients WHERE patient_id = $patient_id";
              $select_ress = mysqli_query($dbconnection, $select_query);
              $select_query_array = mysqli_fetch_assoc($select_ress);
              ?>

              <tr class="table-btn">
                <td>
                  <?= $patient['id'] ?>
                </td>
                <td>
                  <?= $patient['patient_name'] ?>
                </td>
                <td>
                  <?= $patient['patient_phone'] ?>
                </td>
                <td>
                  <?= date_format($date, "jS M, H:i") ?>
                </td>
                <td>
                  <?= $patient['gender'] ?>
                </td>

                <?php if ($select_array['role'] == 'doctor'): ?>
                  <td><a href="<?= ROOT_URL ?>edit-patient.php?id=<?= $patient['id'] ?>" class="edit-btn">edit</a></td>
                  <td><a href="<?= ROOT_URL ?>delete-patient.php?id=<?= $patient['id'] ?>" class="delete-btn">delete</a></td>
                <?php elseif ($select_array['role'] == 'pharmacist'): ?>
                  <p></p>
                <?php endif ?>

                <?php if (mysqli_num_rows($select_ress) == 0): ?>
                  <td><a href="<?= ROOT_URL ?>patient-presctiption.php?id=<?= $patient['id'] ?>" class="delete-btn">presc</a>
                  </td>
                <?php else: ?>
                  <td><button class="btn btn-warning">cleared</button></td>
                <?php endif ?>
              </tr>

            <?php endwhile ?>
          </tbody>
        </table>

      <?php else: ?>
        <p>No patients found;</p>
      <?php endif ?>

      <?php if (mysqli_num_rows($select_patients_result) > 6): ?>
        <a href="">Show all</a>
      <?php endif ?>
    </div>
  </main>

</div>

<?php include "footer.php" ?>