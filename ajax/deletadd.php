<?php require('../config.php');
$id = ($_GET['id']);
if($conn->query("DELETE FROM `user_address` WHERE ld = '".$id."'")){
echo 1;exit;
}
?>