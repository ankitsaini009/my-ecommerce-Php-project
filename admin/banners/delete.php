<?php require('../../config.php');
$pagename = "Banners";
$id = ($_GET['id']);
$bannersql = $conn->query("select * from banners where id='".$id."'");
$bannerdata = $bannersql->fetch_assoc();

if($conn->query("Delete from banners where id='".$id."'")){
	unlink('../../uploads/banners/'.$bannerdata['image']);
	$_SESSION['success_msg'] = 'Banner delete successfully.';
	header("location:".SITEADMIN.'banners');
}