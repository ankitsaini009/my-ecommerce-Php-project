<?php
require('../config.php');
$pagename = "Logout";
unset($_SESSION['id']);
$_SESSION['succcess_msg'] = "logout successfully";
header("location:".SITEADMIN);




?>