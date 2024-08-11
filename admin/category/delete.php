<?php require('../../config.php');
$pagename = "Category";
$id = ($_GET['id']);
if($conn->query("UPDATE `category` SET dstatus=1 where id='".$id."'" )){
	$_SESSION['success_msg'] = 'category delete successfully.';
	header("location:".SITEADMIN.'category');
}