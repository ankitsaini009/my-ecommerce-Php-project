<?php require('../../config.php');
$pagename = "city";
$id = ($_GET['id']);
$bannersql = $conn->query("select * from city where id='".$id."'");
$bannerdata = $bannersql->fetch_assoc();

if($conn->query("Delete from city where id='".$id."'")){
	$_SESSION['success_msg'] = 'city delete successfully.';
	header("location:".SITEADMIN.'city');
}