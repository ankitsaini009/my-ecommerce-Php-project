<?php require('../../config.php');
$pagename = "state";
$id = ($_GET['id']);
$bannersql = $conn->query("select * from state where id='".$id."'");
$bannerdata = $bannersql->fetch_assoc();

if($conn->query("Delete from state where id='".$id."'")){
	$_SESSION['success_msg'] = 'state delete successfully.';
	header("location:".SITEADMIN.'state');
}