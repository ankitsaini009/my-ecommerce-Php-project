
<?php
require('../config.php');

if (isset($_SESSION['id']) && !empty([$_SESSION['id']])) {
  header("location:" . SITEADMIN."dashboard.php");
}

if (isset($_POST['email'])) {
  $isvalid = 1;

  if (empty($_POST['email'])) {
    $isvalid = 0;
    $emailerr = 'Plese inter your email';
  }
  if (empty($_POST['password'])) {
    $isvalid = 0;
    $passworderr = 'Plese inter your password';
  }

  if ($isvalid == 1) {
    $chackemail = $conn->query("select * from users where email = '" . $_POST['email'] . "' && password = '" . $_POST['password']. "' && user_type = 'backend'  && dstatus=0");
    $emaildata = $chackemail->fetch_assoc();

    if ($chackemail->num_rows > 0) {
      if ($emaildata['status'] == 1) {
        $_SESSION['type'] = $emaildata['user_type'];
        $_SESSION['id'] = $emaildata['id'];
        $_SESSION['success_msg'] = "Login successfully";
        header("location:" . SITEADMIN . "dashboard.php");
      } else {
        $emailerr = "Your account currently not active.";
      }
    } else {
      $emailerr = "invailid detiails";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo SITENAME; ?> | Login </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo SITEURL; ?>assets/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo SITEURL; ?>assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo SITEURL; ?>assets/admin/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b><?php echo SITENAME; ?> </b>Admin</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="" method="post">
          <label style="font-weight: bold;">Your Email</label>
          <div class="input-group mb-3">
            <input name="email" type="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <p class="text-danger"><?php echo isset($emailerr) ? $emailerr : '' ?></p>

          <label style="font-weight: bold;">Your Password</label>
          <div class="input-group mb-3">
            <input name="password" type="password" class="form-control" placeholder="Password"><br>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <p class="text-danger"><?php echo isset($passworderr) ? $passworderr : '' ?></p>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <!--  <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
        <!-- /.social-auth-links -->

        <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?php echo SITEURL; ?>assets/admin/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo SITEURL; ?>assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo SITEURL; ?>assets/admin/dist/js/adminlte.min.js"></script>
</body>

</html>