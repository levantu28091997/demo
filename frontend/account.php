<?php
  session_start();
  include '../configs.php';

  if(!isset($_SESSION['log_User']) && !isset($_SESSION['log_Admin'])){
    header('Location:../signIn.php');
  }

  if (isset($_POST['Logout'])) {
    session_unset();
    header('Location:../signIn.php');
  }
  // var_dump($_SESSION['log_User']); die();

  if(isset($_SESSION['log_User'])){
    $email = $_SESSION['log_User'];
    $sql = "SELECT * FROM user WHERE email = '$email' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);


    if(isset($_POST['editUser'])){
      $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
      $name = isset($_POST['name']) ? $_POST['name'] : '';
      $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
      $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
      $bio = isset($_POST['bio']) ? $_POST['bio'] : '';

      $er = [];
      $su = [];
      $sql = "UPDATE user
              SET first_name = '$first_name', name = '$name', phone = '$phone', gender = '$gender', bio = '$bio'
              WHERE email = '$email';";
      if(mysqli_query($conn, $sql)){
        $su[] = 'Cập nhật thông tin thành công';
      }else{
        $er[] = 'Cập nhật thông tin thất bại';
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
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <script type="text/javascript" src="../assets/ckeditor/ckeditor.js"></script>

    <title>Account</title>
  </head>
  <body>
    <div class="main">
      <div class="bg-navy">
        <div class="container">
          <div class="row align-items-center">
            <div class="col my-5">
              <div class="d-lg-block">
                <h1>Personal info</h1>
              </div>
              <ol class="breadcrumb p-0">
                <li class="breadcrumb-item">Account</li>
                <li class="breadcrumb-item">Personal info</li>
              </ol>
            </div>
            <div class="col-auto">
              <form action="" method="POST">
                <input type="submit" name="Logout" value="Logout" class="btn btn-secondary">
              </form>
              <!-- <a href="" class="btn btn-secondary">Logout</a> -->
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-5 col-lg-9 my-5">
            <?php
            if(isset($er)){
              if(count($er) > 0){
                foreach ($er as $key => $value) { ?>
                  <div class="alert alert-danger" role="alert"><?php echo $value; ?></div>
                <?php
                }
              }
            }
            ?>
            <?php
            if(isset($er)){
              if(count($su) > 0){
                foreach ($su as $key => $value) { ?>
                  <div class="alert alert-success" role="alert"><?php echo $value; ?></div>
                <?php
                }
              }
            }
            ?>
            <div class="card mb-5">
              <form method="POST">
                <div class="card-header font-weight-bold">Basic info</div>

                <div class="card-body p-4">
                  <div class="form-group row">
                    <label for="inputProfile" class="col-sm-3 col-form-label">Profile photo</label>
                    <div class="col-sm-9 d-flex align-items-center">
                      <label class="avatar-xl mr-4"><img src="../assets/images/avatar.jpg" alt=""></label>
                      <div class="btn btn-primary position-relative mr-2">Upload Photo<input type="file" class="file-attachment" id="inputProfile"></div>
                      <a href="" class="btn btn-secondary">Delete</a>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputFirst" class="col-sm-3 col-form-label">Full name</label>
                    <div class="col-sm-9 d-flex align-items-center">
                      <input type="text" class="form-control form-control-lg bd-r" id="inputFirst" placeholder="Natalie" name="first_name" value="<?php echo $row["first_name"]; ?>">
                      <input type="text" class="form-control form-control-lg bd-l" id="inputLast" placeholder="Curtis" name="name" value="<?php echo $row["name"]; ?>">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9 d-flex align-items-center">
                      <input type="email" class="form-control form-control-lg" id="inputEmail" placeholder="email@address.com" name="email" value='<?php echo $row["email"]; ?>' disabled>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputPhone" class="col-sm-3 col-form-label">Phone <span class="text-muted">(Optional)</span></label>
                    <div class="col-sm-9 d-flex align-items-center">
                      <input type="text" class="form-control form-control-lg" id="inputPhone" placeholder="+84(0)914-731-527" name="phone" value='<?php echo $row["phone"]; ?>' required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputFirst" class="col-sm-3 col-form-label">Gender</label>
                    <div class="col-sm-9 d-flex align-items-center">
                      <div class="form-control form-control-lg bd-r">
                        <input type="radio" class="" value="male" name="gender" id="Male" <?php if($row['gender'] == 'male') echo 'checked'; ?> >
                        <label class="control-label" for="Male">Male</label>
                      </div>
                      <div class="form-control form-control-lg rounded-0">
                        <input type="radio" class="" value="female" name="gender" id="Female" <?php if($row['gender'] == 'female') echo 'checked'; ?>>
                        <label class="control-label" for="Female">Female</label>
                      </div>
                      <div class="form-control form-control-lg bd-l">
                        <input type="radio" class="" value="other" name="gender" id="Other" <?php if($row['gender'] == 'other') echo 'checked'; ?>>
                        <label class="control-label" for="Other">Other</label>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputBio" class="col-sm-3 col-form-label">BIO</label>
                    <div class="col-sm-9 d-flex align-items-center">
                      <textarea class="editor1" id="editor1" rows="10" name="bio" cols="80"><?php echo $row["bio"]; ?></textarea>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputDisads" class="col-sm-3 col-form-label">Disable ads</label>
                    <div class="col-sm-9 d-flex align-items-center">
                      <input type="checkbox" class="form-check-input" id="inputDisads"> With your Pro account, you can disable ads across the site.
                    </div>
                  </div>
                </div>

                <div class="card-footer text-right">
                  <button type="" class="btn btn-white btn-lg">Cacel</button>
                  <button type="submit" class="btn btn-primary btn-lg" name="editUser">Save Changes</button>
                </div>
              </form>
            </div>

            <div class="card mb-5">
              <form>
                <div class="card-header font-weight-bold">Address</div>

                <div class="card-body p-4">
                  <div class="form-group row">
                    <label for="inputLocation" class="col-sm-3 col-form-label">Location</label>
                    <div class="col-sm-9 d-flex align-items-center">
                      <input type="text" class="form-control form-control-lg bd-r" id="inputLocation" placeholder="London">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputAddressln1" class="col-sm-3 col-form-label">Address line 1</label>
                    <div class="col-sm-9 d-flex align-items-center">
                      <input type="text" class="form-control form-control-lg bd-r" id="inputAddressln1" placeholder="45 Roker Terrace, Latheronwheel">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputAddressln2" class="col-sm-3 col-form-label">Address line 2</label>
                    <div class="col-sm-9 d-flex align-items-center">
                      <input type="text" class="form-control form-control-lg bd-r" id="inputAddressln2" placeholder="Your address">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputAddressln2" class="col-sm-3 col-form-label">Zip code</label>
                    <div class="col-sm-9 d-flex align-items-center">
                      <input type="text" class="form-control form-control-lg bd-r" id="inputAddressln2" placeholder="KW5 8NW">
                    </div>
                  </div>
                </div>

                <div class="card-footer text-right">
                  <button type="" class="btn btn-white btn-lg">Cacel</button>
                  <button type="submit" class="btn btn-primary btn-lg">Save Changes</button>
                </div>
              </form>
            </div>

            <div class="card mb-5">
              <form>
                <div class="card-header font-weight-bold">Privacy</div>
                <div class="card-body p-4">
                  <div class="form-group row">
                    <label for="inputLocation" class="col-sm-3 col-form-label">Who can see your profile photo?</label>
                    <div class="col-sm-9 d-flex align-items-center">
                      <select class="form-control form-control-lg">
                        <option>Anyone</option>
                        <option>Only you</option>
                      </select>
                    </div>
                  </div>
                </div>
              </form>
            </div>

            <div class="card mb-5">
              <form>
                <div class="card-header font-weight-bold">Delete your account</div>

                <div class="card-body p-4">
                  <div class="form-group row">
                    <p>When you delete your account, you lose access to Front account services, and we permanently delete your personal data. You can cancel the deletion for 14 days.</p>
                    <div class="col-sm-12 d-flex align-items-center">
                      <input type="checkbox" class="mr-2" id="inputConfirm"> <span for="inputConfirm">Confirm that I want to delete my account.</span>
                    </div>
                  </div>
                </div>

                <div class="card-footer text-right">
                  <button type="submit" class="btn btn-danger btn-lg">Delete</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <footer>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-10">
              <div class="footer text-center mx-3 my-5">
                <p class="copyright mb-3">© Front. 2020 Htmlstream. All rights reserved.</p>
                <span class="copyright-info">When you visit or interact with our sites, services or tools, we or our authorised service providers may use cookies for storing information to help provide you with a better, faster and safer experience and for marketing purposes.</span>
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
      CKEDITOR.replace( 'editor1' );
    </script>
    <script type="text/javascript" src="../assets/js/main.js"></script>
  </body>
</html>