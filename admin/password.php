<?php
$pagename = "Password";
require('../config.php');
if (isset($_POST['Password'])) {
  $isvalid = 1;

  if (empty($_POST['Password'])) {
    $isvalid = 0;
    $oldpass = 'Enter your old Password';
  }
  if (empty($_POST['nPassword'])) {
    $isvalid = 0;
    $newpass = 'Enter your new Password';
  }
  if (empty($_POST['cPassword'])) {
    $isvalid = 0;
    $cnewpass = 'Enter your conform Password';
  }
  if ($_POST['nPassword'] != $_POST['cPassword']) {
    $isvalid = 0;
    $cnewpass = 'Password and confirm password do not match.';
  }

  if ($isvalid = 1) {
    $chackpass = $conn->query("select * from users  where password='" . md5($_POST['Password']) . "' && id='" . $_SESSION['id'] . "'");
    if ($chackpass->num_rows > 0) {
      $updatpass = $conn->query("update users  set password='" . md5($_POST['nPassword']) . "' where id='" . $_SESSION['id'] . "'");
      //prd($updatepass);die;
      $_SESSION['success_msg'] = "Password updated successfully";
      header("location:dashboard.php");
    } else {
      $oldpass = 'Invalid old  Password';
    }
  }
}
require("includes/header.php");

?>
<div class="col-md-12" style="margin-left: 300px;">
	<form action="" method="POST" enctype="multipart/form-data" style="margin: 150px; margin-left:400px; ">
	<h1 style="font-weight: bold;" >Change Your Password</h1>
		<div class=" col-md-6 col-md-5 offset-md-3 mt-4 ">
		</div>
		<div class="col-md-6 ">
			<b>Old Password</b>
			<input class=" form-control" type="Password" name="Password" placeholder="Enter your old password" value="<?php echo isset($_POST['Password']) ? $_POST['Password'] : '' ?>">
			<p class="text-danger"><?php echo isset($oPassworderr) ? $oPassworderr : '' ?></p>
		</div>
		<div class="col-md-6  ">
			<b>New Password</b>
			<input class=" form-control" type="Password" name="nPassword" placeholder="Enter your new password" value="<?php echo isset($_POST['nPassword']) ? $_POST['nPassword'] : '' ?>">
			<p class="text-danger"><?php echo isset($nPassworderr) ? $nPassworderr : '' ?></p>
		</div>
		<div class="col-md-6 ">
			<b>Conform New Password</b>
			<input class=" form-control" type="Password" name="cPassword" placeholder="Enter Conform new password" value="<?php echo isset($_POST['cPassword']) ? $_POST['cPassword'] : '' ?>">
			<p class="text-danger"><?php echo isset($cPassworderr) ? $cPassworderr : '' ?></p>

		</div>

		<div class="col-md-10 ">
			<input class=" rounded text-white bg-success col-md-2 p-2 mt-2" type="submit" name="Register">
		</div>


	</form>
</div>
<?php require('includes/footer.php'); ?>