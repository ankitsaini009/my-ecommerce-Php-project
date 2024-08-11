<?php
include('../config.php');
if (isset($_POST['opass'])) {
  $redata = array();
  $redata["status"] = 1;
  $redata['massage'] = '';
  $error = array();
  $velid = 1;
  if (empty($_POST['opass'])) {
    $velid = 0;
    $error['opass'] = "Plese Enter Old Password";
  }
  if (empty($_POST['npass'])) {
    $velid = 0;
    $error['npass'] = "Plese Enter New Password";
  }
  if (empty($_POST['cpass'])) {
    $velid = 0;
    $error['cpass'] = "Plese Enter Confrom Password";
  }
  if ($_POST['npass'] !== $_POST['cpass']) {
    $velid = 0;
    $error['cpass'] = "New Password And Confrom Password Not Match";
  }
  if ($velid == 1) {
    $chackpass = $conn->query("select * from users  where password='" . $_POST['opass'] . "' && id='" . $_SESSION['login_user_id'] . "'");
    if ($chackpass->num_rows > 0) {
      $updatpass = $conn->query("update users  set `password` = '" . $_POST['npass'] . "' where id='" . $_SESSION['login_user_id'] . "'");
      $redata['status'] = 1;
      $redata['redirecturl'] = SITEURL . 'profile.php';
      $redata['message'] = "Password Change Successfully";
      echo json_encode($redata);
    }
  } else {
    $redata['status'] = 0;
    $redata['message'] = $error;
    echo json_encode($redata);
  }
};
