<?php
  session_start();
  include 'configs.php';


  if (isset($_POST['Login'])) {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $pass = isset($_POST['password']) ? $_POST['password'] : '';

    $er = [];
    $er_email = [];
    $er_pass = [];
    if ($email == '') { $er_email[] = 'Email không được để trống'; }
    if ($pass == '') { $er_pass[] = 'Password không được để trống'; }
    if (!preg_match("/^[a-zA-Z0-9.-]+@[a-zA-Z0-9]+\.[a-zA-Z.]{2,5}$/", $email)) {
      $er_email[] = 'Định dạng email không hợp lệ';
    }
    if (preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,}$/", $pass)) {
      $er_pass[] = 'Password gồm 8 kí tự bao gồm kí tự hoa và kí tự đặc biệt';
    }

    if(!count($er_email)>0 && !count($er_pass) > 0){
      $sql = "SELECT * FROM user";
      $query = mysqli_query($conn, $sql);
      While($row = mysqli_fetch_assoc($query)){
        if($row['email'] == $email || $row['username'] == $email && $row['password'] == $pass){
          if($row['status'] == 0){
            if($row['role'] == 0){
              $_SESSION['log_Admin'] = $email;
              header('Location:backend/user.php');
              break;
            }else{
              $_SESSION['log_User'] = $email;
              header('Location:frontend/account.php');
              break;
            }
          }else{
            $er[] = 'Tài khoản chưa được kích hoạt, vui lòng kiểm tra lại.';
          }
        }else{
          $er[] = 'Thông tin đăng nhập không hợp lệ';
        }
      }
    }
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

    <title>Sign In</title>
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
                    <h2>Sign in</h2>
                    <p>Don't have an account yet? <a href="signUp.php">Sign up here</a></p>
                  </div>
                  <a href="" class="btn btn-lg btn-block btn-white mb-4">
                    <span><img class="img-fluid mr-2" src="assets/images/gg.png" alt="" style="width: 1rem">Sign in with Google</span>
                  </a>
                  <span class="divider mb-4 position-relative d-flex align-items-center">OR</span>
                </div>
                <?php if (isset($er))
                  foreach ($er as $key => $value) {
                ?>
                  <div class="alert alert-danger" role="alert"><?php echo $value; ?></div>
                <?php } ?>
                <div class="form-group mb-4">
                  <label for="inputEmail">Your email</label>
                  <input type="email" class="form-control form-control-lg" id="inputEmail" name="email" placeholder="email@address.com" required>
                </div>

                <?php if (isset($er_email))
                  foreach ($er_email as $key => $value) {
                ?>
                  <div class="alert alert-danger" role="alert"><?php echo $value; ?></div>
                <?php } ?>

                <div class="form-group mb-4">
                  <label for="inputPassword">Password</label>
                  <input type="password" class="form-control form-control-lg" id="inputPassword" name="password" placeholder="8+ characters required" required>
                </div>
                <?php if (isset($er_pass))
                  foreach ($er_pass as $key => $value) {
                ?>
                  <div class="alert alert-danger" role="alert"><?php echo $value; ?></div>
                <?php } ?>
                <div class="form-check mb-4">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block" name="Login">Submit</button>
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