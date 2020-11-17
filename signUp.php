<?php
  session_start();
  include 'configs.php';

  if(isset($_POST['Register'])){
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $pass = isset($_POST['password']) ? $_POST['password'] : '';
    $re_pass = isset($_POST['re_password']) ? $_POST['re_password'] : '';

    $ck_mail = "SELECT * FROM user WHERE email = '$email'";
    $re_ck = mysqli_query($conn, $ck_mail);
    $num_row = mysqli_num_rows($re_ck);
    var_dump($num_row); die();
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <title>Sign Up</title>
  </head>
  <body>
    <div class="main">
      <div class="bg">
        <figure class="space-bg position-absolute m-0 p-0">
          <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1921 273">
            <polygon fill="#fff" points="0,273 1921,273 1921,0 "></polygon>
          </svg>
        </figure>
      </div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 col-lg-5 my-5">
            <a href="" class="d-flex justify-content-center mb-4"><img src="assets/images/logo.svg" alt="" style="width: 8rem"></a>
            <div class="card p-4">
              <form method="POST">
                <div class="text-center">
                  <div class="form-head mb-4">
                    <h2>Create your account</h2>
                    <p>Already have an account? <a href="">Sign in here</a></p>
                  </div>
                  <a href="" class="btn btn-lg btn-block btn-white mb-4">
                    <span><img class="img-fluid mr-2" src="assets/images/gg.png" alt="" style="width: 1rem">Sign up with Google</span>
                  </a>
                  <span class="divider mb-4 position-relative d-flex align-items-center">OR</span>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputFirst">First name</label>
                    <input type="text" class="form-control form-control-lg" id="inputFirst" placeholder="Mark" name="first_name">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputLast">Name </label>
                    <input type="text" class="form-control form-control-lg" id="inputLast" placeholder="Williams" name="name">
                  </div>
                </div>
                <div class="form-group mb-4">
                  <label for="inputEmail">Your email</label>
                  <input type="email" class="form-control form-control-lg" id="inputEmail" aria-describedby="emailHelp" placeholder="email@address.com" name="email" required>
                </div>
                <div class="form-group mb-4">
                  <label for="inputPassword">Password</label>
                  <input type="password" class="form-control form-control-lg" id="inputPassword" placeholder="8+ characters required" name="password">
                </div>
                <div class="form-group mb-4">
                  <label for="confirmPassword">Confirm password</label>
                  <input type="password" class="form-control form-control-lg" id="confirmPassword" placeholder="8+ characters required" name="re_password">
                </div>
                <div class="form-check mb-4">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">I accept the <a href="">Terms and Conditions</a></label>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block" name="Register">Submit</button>
              </form>
            </div>
            <div class="content-buttom text-center mt-4">
              <p class="text-uppercase">Trusted by the world's best teams</p>
              <div class="row list-logo">
                <div class="col">
                  <a href=""> <img class="img-fluid" src="assets/images/gitlab-gray.svg"></a>
                </div>
                <div class="col">
                  <a href=""> <img class="img-fluid" src="assets/images/fitbit-gray.svg"></a>
                </div>
                <div class="col">
                  <a href=""> <img class="img-fluid" src="assets/images/flow-xo-gray.svg"></a>
                </div>
                <div class="col">
                  <a href=""> <img class="img-fluid" src="assets/images/layar-gray.svg"></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>
  </body>
</html>