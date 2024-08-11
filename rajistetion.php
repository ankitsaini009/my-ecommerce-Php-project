<?php
include("config.php");
if (isset($_POST['name'])) {
  $retundata = array();
  $retundata['status'] = 1;
  $retundata['message'] = '';
  $errors = array();
  $isvelid = 1;
  if (empty($_POST['name'])) {
    $isvelid = 0;
    $errors['name'] = '*Plese enter your name';
  }
  if (empty($_POST['email'])) {
    $isvelid = 0;
    $errors['email'] = '*Plese enter your email';
  } else {
    $checkemail = $conn->query("select * from users where email='" . $_POST['email'] . "'");
    if ($checkemail->num_rows > 0) {
      $isvelid = 0;
      $errors['email'] = '*Email address allready taken.';
    }
  }
  if (empty($_POST['password'])) {
    $isvelid = 0;
    $errors['password'] = '*Plese enter your password';
  }
  if (empty($_POST['phone'])) {
    $isvelid = 0;
    $errors['phone'] = '*Plese enter your phone';
  }
  if ($isvelid == 1) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $phone = $_POST['phone'];
    $indata = $conn->query("INSERT INTO `users`( `name`, `email`, `password`,`mobile_no`,`created_at`, `updated_at`) VALUES ('" . $name . "','" . $email . "','" . $pass . "','" . $phone . "','" . date('Y-m-d H:i;s') . "','" . date('Y-m-d H:i;s') . "')");
    $retundata['status'] = 1;
    $retundata['redirecturl'] = SITEURL . "login.php";
    $retundata['message'] = 'Register Success.';
    echo json_encode($retundata);
    exit;
  } else {
    $retundata['status'] = 0;
    $retundata['message'] = $errors;
    echo json_encode($retundata);
    exit;
  }
}
include('includes/header.php');
?>
<div class="site-wrap">
  <div class="content">
    <!-- Breadcrumb Section Begin -->
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
              <h4>Create Account</h4>
              <div class="breadcrumb__links">
                <a href="index-2.html">Home</a>
                <span>Create Account</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Breadcrumb Section End -->
    <section class="register-page spad-70">
      <h2 class="text-danger">REGISTER WITH Ankit_Saini </h2>
      <div class="container">
        <form id="registerform" action="" method="post" enctype="multipart/form-data" onsubmit="return myvelidetion();">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Full Name</label>
                <input type="text" class="form-control" name="name" placeholder="Full Name" id="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>" />
                <p class="text-danger" id="nameerr"><?php echo isset($nameerr) ? $nameerr : '' ?></p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Your Email Address </label>
                <input type="email" class="form-control" name="email" placeholder="Enter email" id="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" />
                <p class="text-danger" id="emailerr"><?php echo isset($emailerr) ? $emailerr : '' ?></p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Your Password</label>
                <input type="password" class="form-control" name="password" placeholder="Enter Password" id="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>" />
                <p class="text-danger" id="passworderr"><?php echo isset($passworderr) ? $passworderr : '' ?></p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Your Phone No</label>
                <input type="number" class="form-control" name="phone" placeholder="Enter Phone No" id="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : '' ?>" />
                <p class="text-danger" id="phoneerr"><?php echo isset($phoneerr) ? $phoneerr : '' ?></p>
              </div>
            </div>
          </div>
      </div>
      <button type="submit" class="btn product__btn signin_btn">Create an account</button>
      <div class="already-btnRegisterPage text-center">
        <p>Already have an account? <a href="<?php echo SITEURL; ?>login.php">Sign in</a></p>
      </div>
      </form>
  </div>
</div>
</div>
</section>
</div>
<?php include('includes/footer.php'); ?>

<script>
  function myvelidetion() {
    $('.text-danger').text('');
    $.ajax({
      url: "rajistetion.php",
      type: "POST",
      dataType: 'json',
      data: $('#registerform').serialize(),

      success: function(data) {
        if (data.status == 0) {
          jQuery.each(data.message, function(index, item) {
            $('#' + index + 'err').text(item);
          });
        } else {
          window.location.href = data.redirecturl;
        }
      }
    });
    return false;
  }
  // function myvelidetion() {
  //   let velid = 1;
  //   name = document.getElementById('name').value;
  //   if (name == '') {
  //     document.getElementById('nameerr').innerHTML = '*Plese enter your name';
  //     document.getElementById('name').focus();
  //     velid = 0;
  //   } else {
  //     document.getElementById('nameerr').innerHTML = '';
  //   }

  //   email = document.getElementById('email').value;
  //   if (email == '') {
  //     document.getElementById('emailerr').innerHTML = '*Plese enter your email';
  //     document.getElementById('email').focus();
  //     velid = 0;
  //   } else {
  //     document.getElementById('emailerr').innerHTML = '';
  //   }

  //   password = document.getElementById('password').value;
  //   if (password == '') {
  //     document.getElementById('passworderr').innerHTML = '*Plese enter your password';
  //     document.getElementById('password').focus();
  //     velid = 0;
  //   } else {
  //     document.getElementById('passworderr').innerHTML = '';
  //   }
  //   phone = document.getElementById('phone').value;
  //   if (phone == '') {
  //     document.getElementById('phoneerr').innerHTML = '*Plese enter your phone';
  //     document.getElementById('phone').focus();
  //     velid = 0;
  //   } else {
  //     document.getElementById('phoneerr').innerHTML = '';
  //   }

  //   if (velid == 0) {

  //     return false;
  //   }else{

  //       $.ajax({
  //         url: "rajistetion.php",
  //         type: "POST",
  //         data: $('#registerform').serialize(),
  //         success: function(data) {
  //           //$('Submit successfully').html(data);
  //         }
  //       });
  //       return false;
  //   }
  // }
</script>