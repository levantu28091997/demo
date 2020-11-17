<?php
  session_start();
  if(!isset($_SESSION['log_User']) && !isset($_SESSION['log_Admin'])){
    header('Location:../signIn.php');
  }
  include "../configs.php";

  $sql = "SELECT * FROM user";
  $result = mysqli_query($conn, $sql);
  // $row = mysqli_fetch_assoc($result);


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
      <header class="ad-header d-flex align-items-center px-5">
        <div class="search ">
          <form>
            <input class="form-control" type="search" name="search" placeholder="Search user">
          </form>
        </div>
        <div class="setting-user ml-auto position-relative">
          <a href="javascript:void(0)"><div class="setting-user-avatar"><img src="../assets/images/avatar.jpg" alt=""></div></a>
          <ul class="setting-user-list position-absolute p-3">
            <li class="item"><a href="">Settings</a></li>
            <li class="item"><a href="">Edit profile</a></li>
            <li class="item"><a href="">Logout</a></li>
          </ul>
        </div>
      </header>
      <aside class="ad-aside">
        <div class="p-4">
          <div class="d-flex my-4"><a href=""><img src="../assets/images/logo.svg" alt="" style="width: 6.5rem"></a></div>
          <div class="navbar-content">
            <ul>
              <li><a href="">User</a></li>
              <li><a href="">User</a></li>
              <li><a href="">User</a></li>
            </ul>
          </div>
        </div>
      </aside>
      <main class="ad-main">
        <div class="">
          <div class="main-content py-3 px-5">
            <div class="main-header">
              <div class="container-fluid ">
                <div class="row align-items-center">
                  <div class="col my-5 p-0">
                    <ol class="breadcrumb p-0 bg-transparent">
                      <li class="breadcrumb-item">Pages</li>
                      <li class="breadcrumb-item">User</li>
                    </ol>
                    <div class="d-lg-block">
                      <h1>Users</h1>
                    </div>
                  </div>
                  <div class="col-auto">
                    <a href="" class="btn btn-primary">+ Add user</a>
                  </div>
                </div>
              </div>
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Full name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Phone</th>
                  <th scope="col">Gender</th>
                  <th scope="col">Bio</th>
                  <th scope="col">Status</th>
                  <th scope="col">Role</th>
                  <th scope="col">Active</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $stt = 0;
                  while ($row = mysqli_fetch_assoc($result)) {
                  $stt ++;
                ?>
                <tr>
                  <th scope="row"><?php echo $stt; ?></th>
                  <td><?php echo $row['first_name'] .' '. $row['name']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><?php echo $row['phone']; ?></td>
                  <td><?php echo $row['gender']; ?></td>
                  <td><?php echo substr($row['bio'], 0, 50) . '...'; ?></td>
                  <td><?php if ($row['status'] == 0) { echo 'Active'; }else{ echo 'Deactive'; } ?></td>
                  <td><?php if ($row['role'] == 0) { echo 'Admin'; }else{ echo 'User'; } ?></td>
                  <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $row['id']?>">Edit</button></td>
                  <!-- modal -->
                  <div class="modal fade" id="exampleModal<?php echo $row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['id']?>">
                            <div class="form-group">
                              <label for="Firstname" class="col-form-label">First name</label>
                              <input type="text" class="form-control" id="Firstname" value="<?php echo $row['first_name']?>">
                            </div>
                            <div class="form-group">
                              <label for="Name" class="col-form-label">Name</label>
                              <input type="text" name="name" class="form-control" id="Name" value="<?php echo $row['name']?>">
                            </div>
                            <div class="form-group">
                              <label for="Password" class="col-form-label">Password</label>
                              <input type="password" name="password" class="form-control" id="Password" value="<?php echo $row['password']?>">
                            </div>
                            <div class="form-group">
                              <label for="message-text" class="col-form-label">Bio:</label>
                              <textarea  name="bio" class="form-control" id="message-text" rows="5"><?php echo $row['bio']?></textarea>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Edit</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </main>
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