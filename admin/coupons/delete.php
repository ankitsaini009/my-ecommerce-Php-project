<?php require('../../config.php');
$pagename = "coupons";
$id = ($_GET['id']);
$bannersql = $conn->query("select * from coupons where id='".$id."'");
$bannerdata = $bannersql->fetch_assoc();

if($conn->query("Delete from coupons where id='".$id."'")){
	$_SESSION['success_msg'] = 'Coupons delete successfully.';
	header("location:".SITEADMIN.'coupons');
}