<?php require('../../config.php');
$pagename = "Size";
$id = ($_GET['id']);
$bannersql = $conn->query("select * from size where size_id='".$id."'");
$bannerdata = $bannersql->fetch_assoc();

if($conn->query("Delete from size where size_id='".$id."'")){
	$_SESSION['success_msg'] = 'size delete successfully.';
	header("location:".SITEADMIN.'size');
}