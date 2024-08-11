<?php require('../../config.php');
$pagename = "Sub Category";
$id = ($_GET['id']);
//prd(("update sub_category set dstatus=1 where id='".$id."'"));
if($conn->query("update sub_category set dstatus=1 where id='".$id."'")){
	//unlink('../../uploads/banners/'.$bannerdata['image']);
	$_SESSION['success_msg'] = 'sub_category delete successfully.';
	header("location:".SITEADMIN.'sub_category');
}