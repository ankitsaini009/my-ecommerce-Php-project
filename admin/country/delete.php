<?php require('../../config.php');
$pagename = "Supply country";
$id = ($_GET['id']);
$bannersql = $conn->query("select * from country where id='".$id."'");
$bannerdata = $bannersql->fetch_assoc();

if($conn->query("Delete from country where id='".$id."'")){
	$_SESSION['success_msg'] = 'Country delete successfully.';
	header("location:".SITEADMIN.'country');
}