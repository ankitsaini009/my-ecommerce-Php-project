<?php 
include('config.php');
unset($_SESSION['login_user_id']);
header("location:".SITEURL."login.php");

?>