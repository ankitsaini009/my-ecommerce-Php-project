<?php require('../../config.php');
$pagename = "Pages";
$id = ($_GET['id']);
$bannersql = $conn->query("select * from pages where id='".$id."'");
$bannerdata = $bannersql->fetch_assoc();

if($conn->query("Delete from pages where id='".$id."'")){
	unlink('../../uploads/banners/'.$bannerdata['image']);
	$_SESSION['success_msg'] = 'Pages delete successfully.';
	header("location:".SITEADMIN.'pages');
}