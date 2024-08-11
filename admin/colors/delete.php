<?php require('../../config.php');
$pagename = "Color";
$id = ($_GET['id']);
$bannersql = $conn->query("select * from color where color_id='".$id."'");
//prd(("select * from color where color_id='".$id."'"));
$bannerdata = $bannersql->fetch_assoc();

if($conn->query("Delete from color where color_id='".$id."'")){
	$_SESSION['success_msg'] = 'color delete successfully.';
	header("location:".SITEADMIN.'colors');
}