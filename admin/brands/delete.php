<?php require('../../config.php');
$pagename = "Brands";
$id = ($_GET['id']);
$bannersql = $conn->query("select * from brands where id='".$id."'");
$bannerdata = $bannersql->fetch_assoc();

if($conn->query("Delete from brands where id='".$id."'")){
	unlink('../../uploads/banners/'.$bannerdata['image']);
	$_SESSION['success_msg'] = 'brands delete successfully.';
	header("location:".SITEADMIN.'brands');
}