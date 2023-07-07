

<?php include "config/config.php";
include "header.php";

?>

        
<section class="vh-100 bg-image"
style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
<div class="mask d-flex align-items-center h-100 gradient-custom-3">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-9 col-lg-7 col-xl-6">
        <div class="card" style="border-radius: 15px;">

            <div class="form-header">
                <h1>PMS LOGIN</h1>
            </div>
          <div class="card-body p-5 pt-3">

            <form method="post" action="login-logic.php">

            <?php
               if(isset($_SESSION['signin'])): ?>
                <div class="alert__message error">
                <p> <?= $_SESSION['signin']; 
                unset($_SESSION['signin']);
                ?> </p>
                </div>

                <?php elseif(isset($_SESSION['signup-success'])) : ?>
                  <p>
                    <?= $_SESSION['signup-success']; unset($_SESSION['signup-success']) ?>
                  </p>
                <?php endif ?>   



              <div class="form-outline mb-4">
              <label class="form-label" for="form3Example3cg">Email:</label>
                <input required type="text" id="form3Example3cg" name="email" class="form-control form-control-lg" />
              </div>


              <div class="form-outline mb-4">
              <label class="form-label" for="form3Example4cg">Password</label>
                <input required name="password" type="password" id="form3Example4cg" class="form-control form-control-lg" />
              </div>


        
              <div class="d-flex justify-content-center">
                <button type="submit" name="login" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Login</button>
              </div>

              <p class="text-center text-muted mt-5 mb-0">Dont have an account? <a href="#!"
                  class="fw-bold text-body"><u><a href="signup.php">signup here</a></u></a></p>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<?php include "footer.php"; ?>