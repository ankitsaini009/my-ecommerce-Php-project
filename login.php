<?php
include('config.php');
if (isset($_GET['redirect']) && !empty($_GET['redirect'])) {
  $_SESSION['redirect'] =  $_GET['redirect'];
}
if (isset($_POST['email'])) {
  $redata = array();
  $redata['status'] = 1;
  $isvelid = 1;
  $myerr = array();
  if (empty($_POST['email'])) {
    $isvelid = 0;
    $myerr['email'] = '*Plese enter your email';
  }
  if (empty($_POST['password'])) {
    $isvelid = 0;
    $myerr['password'] = '*Plese enter your password';
  }
  if ($isvelid = 1) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $checkemail = $conn->query("select * from users where email = '" . $email . "' && password = '" . $pass . "' && user_type = 'frontend' && dstatus = 0 ");
    $emaildata = $checkemail->fetch_assoc();
    if ($checkemail->num_rows > 0) {
      if ($emaildata['status'] == 1) {
        $_SESSION['login_user_id'] = $emaildata['id'];
        $redata['status'] = 1;
        if (isset($_SESSION['redirect']) && !empty($_SESSION['redirect'])) {
          $redirecturl = $_SESSION['redirect'];
          unset($_SESSION['redirect']);
          $redata['redirecturl'] = $redirecturl;
        } else {
          $redata['redirecturl'] = SITEURL;
        }
        $redata['massage'] = 'Login successfully';
        echo json_encode($redata);
        exit;
      }
    } else {
      $myerr['email'] = '*Invelid Email Detalis';
      $redata['status'] = 0;
      $redata['massage'] = $myerr;
      echo json_encode($redata);
      exit;
    }
  }
}
include('includes/header.php');
?>
<div class="site-wrap">
  <div class="content">
    <section class="breadcrumb-option">
      <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
      </ul>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcrumb__text">
              <h4>Login</h4>
              <div class="breadcrumb__links">
                <a href="index.html">Home</a>
                <span>Login</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="register-page spad-70">
      <div class="container">
        <div class="row create-an-account">
          <div class="col-md-12">
            <form id="signinform" action="" method="post">
              <h2>Sign IN</h2>
              <div class="form-group">
                <label>Your Email Address </label>
                <input type="email" id="email_main" class="form-control" name="email" placeholder="Enter email" id="email" />
                <p class="text-danger" id="emailerr"><?php echo isset($myerr['email']) ? $myerr['email'] : '' ?></p>
              </div>
              <div class="form-group">
                <label>Your Password</label>
                <input type="password" id="password_main" class="form-control" name="password" placeholder="Enter Password" id="password" autocomplete="off" />
                <p class="text-danger" id="passworderr"><?php echo isset($myerr['password']) ? $myerr['password'] : '' ?></p>
              </div>
              <a type="submit" class="btn product__btn signin_btn ankit">Sign IN</a>
              <div class="already-btnRegisterPage text-center">
                <p>Don't have an account? <a href="<?php echo SITEURL; ?>rajistetion.php">Sign up</a></p>
              </div>

            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php include('includes/footer.php'); ?>
  <script>
    $(document).on('click', '.ankit', function() {
      Swal.fire({
        title: "Login",
        text: "Login successfully.",
        icon: "success"
      }).then(function(isconfirm) {
        if (isconfirm) {
          $.ajax({
            url: 'login.php',
            type: 'POST',
            dataType: 'json',
            data: $('#signinform').serialize(),
            success: function(data) {
              if (data.status == 0) {
                jQuery.each(data.massage, function(index, item) {
                  $('#' + index + 'err').text(item);
                });
              } else {
                window.location.href = data.redirecturl;
              }
            }
          });
        }
      });
    });
  </script>