<?php
include('config.php');
$pagename = 'cpass';
include('includes/header.php');
?>
<section class="register-page spad-70">
  <div class="container">
    <div class="row">
      <?php include('sidebar.php') ?>
      <div class="col-sm-12 mt-4 mt-md-0 col-md-12 col-lg-9">
        <form id="signinform" action="" method="post">
          <div class="form-group">
            <label>OLD PASSWORD</label>
            <input type="password" id="email_main" class="form-control" name="opass" placeholder="Enter OLD Password" id="opass" />
            <p class="text-danger" id="opasserr"></p>
          </div>
          <div class="form-group">
            <label>NEW PASSWORD</label>
            <input type="password" id="password_main" class="form-control" name="npass" placeholder="Enter New Password" id="npass" autocomplete="off" />
            <p class="text-danger" id="npasserr"></p>
          </div>
          <div class="form-group">
            <label>CONFORM PASSWORD</label>
            <input type="password" id="password_main" class="form-control" name="cpass" placeholder="Enter Conform Password" id="cpass" autocomplete="off" />
            <p class="text-danger" id="cpasserr"></p>
          </div>
          <a type="submit" class="btn product__btn signin_btn ankit" onclick="return cpass()">SUBMIT</a>
          <div class="already-btnRegisterPage text-center">
            <p>Don't have an account? <a href="<?php echo SITEURL; ?>login.php">Sign In</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
</div>
<?php include('includes/footer.php'); ?>
<script>
  function cpass() {
    $('.text-danger').text('');
    $.ajax({
      url: "ajax/cpass.php",
      type: "POST",
      dataType: 'json',
      data: $('#signinform').serialize(),
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
  };
</script>