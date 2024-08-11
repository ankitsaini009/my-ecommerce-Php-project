<?php require('../../config.php');
$pagename = "delete";
$id = ($_GET['id']);
if ($conn->query("update prdoucts set dstatus=1 where id='" . $id . "'")) {
	$_SESSION['success_msg'] = 'prdoucts delete successfully.';
	header("location:" . SITEADMIN . 'prdoucts');
}
