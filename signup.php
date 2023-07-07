
<?php include "config/config.php";


$first_name = $_SESSION['register-data']['first_name'] ?? null;
$last_name = $_SESSION['register-data']['last_name'] ?? null;
$email = $_SESSION['register-data']['email'] ?? null;
$password = $_SESSION['register-data']['password'] ?? null;
$cpassword = $_SESSION['register-data']['cpassword'] ?? null;

unset($_SESSION['post-data']);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="css/style.css">

    <script src="https://use.fontawesome.com/577ccac0e9.js"></script>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
        
<section class="vh-100 bg-image mt-4"
style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
<div class="mask d-flex align-items-center h-100 gradient-custom-3">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-9 col-lg-7 col-xl-6">
        <div class="card" style="border-radius: 15px;">

            <div class="form-header">
                <h1>PMS REGISTER</h1>
            </div>
          <div class="card-body p-5 pt-3">

            <form method="post" action="signup-logic.php" enctype="multipart/form-data">

            <?php
               if(isset($_SESSION['register-user'])): ?>
                <div class="alert__message error">
                <p> <?= $_SESSION['register-user']; 
                unset($_SESSION['register-user']);
                ?> </p>
                </div>
                <?php endif ?>   

              <div class="form-outline mb-4">
              <label class="form-label" for="form3Example1cg">First Name</label>
                <input value = "<?= $first_name ?>" required type="text" id="form3Example1cg" name="first_name" class="form-control form-control-lg" />
                
              </div>

              <div class="form-outline mb-4">
              <label class="form-label" for="form3Example3cg">Last Name:</label>
                <input required type="text" id="form3Example3cg" value = "<?= $last_name ?>" name="last_name" class="form-control form-control-lg" />
              </div>

              <div class="form-outline mb-4">
              <label class="form-label" for="form3Example3cg">Email:</label>
                <input value = "<?= $email ?>" required type="text" id="form3Example3cg" name="email" class="form-control form-control-lg" />
              </div>

              <div class="form-outline mb-4">
                <label class="form-label" for="form3Example3cg">Role:</label>
                <select class="form-control form-control-lg" name="role" id="">
                  <option class="form-control form-control-lg" value="doctor" selected>Doctor</option>
                  <option class="form-control form-control-lg" value="pharmacist">Pharmacist</option>
                </select>
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example3cg">Profile Photo(optional):</label>
                      <input type="file" id="form3Example3cg" name="profile_photo" class="form-control form-control-lg" />
                    </div>

              <div class="form-outline mb-4">
              <label class="form-label" for="form3Example4cg">Password</label>
                <input value = "<?= $password ?>" required name="password" type="password" id="form3Example4cg" class="form-control form-control-lg" />
                
              </div>

              <div class="form-outline mb-4">
              <label class="form-label" for="form3Example4cdg">Repeat your password</label>
                <input value = "<?= $cpassword ?>" required type="password" name="cpassword" id="form3Example4cdg" class="form-control form-control-lg" />
                
              </div>

            

              <div class="d-flex justify-content-center">
                <button type="submit" name="register" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
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


<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- <script src="script.js"> -->
</body>
</html>